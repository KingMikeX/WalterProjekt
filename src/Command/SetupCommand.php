<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\ConfirmationQuestion;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Uid\Uuid;

class SetupCommand extends Command
{
    protected array $files = [
        './.env',
        './.env.dev',
        './.env.dev.php',
        './.env.dist',
        './.env.prod',
        './.env.qa',
        './.env.test',
        './.npmrc.dist',
        './auth.json',
        './auth.json.dist',
        './composer.json',
        './composer.json.dist',
        './package.json',
        './pipelines/build-pipeline.yml',
        './pipelines/release-test-stage-pipeline.yml',
        './pipelines/release-qa-stage-pipeline.yml',
        './pipelines/release-prod-stage-pipeline.yml',
        './docker-sync.yml',
        './docker-compose.yml',
        './README.md',
        './Makefile',
    ];

    protected static $defaultName = 'project:setup';
    protected static $defaultDescription = 'This command starts a questionnaire followed by an automatic variable replacement.';
    protected static $defaultHelp = '
        This command starts a questionnaire in the first step where all your cloudfoundry (aka stack it appcloud) related 
        project settings are captured. The second step will execute a variable replacement throughout many project related
        configuration files and generate a shell script. The last step is to execute the shell script which creates your
        cloudfoundry services and automatically pushes an initial version of your cloud-application.
    ';

    protected function configure()
    {
        $this
            ->setName(self::$defaultName)
            ->setDescription(self::$defaultDescription)
            ->setHelp(self::$defaultHelp)
            ->addOption('cf-org', 'o', InputOption::VALUE_OPTIONAL, 'Pass name of your cloudfoundry organisation as parameter', 'base');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        /**
         * Variable Overview
         * -------------------
         * #{{cf_org}}#
         * #{{cf_org_ado}}#
         * #{{cf_space}}#
         * #{{cf_endpoint}}#
         * #{{cf_domain_suffix}}#
         * #{{project_secret}}#
         * #{{project_name_short}}#
         * #{{project_name_long}}#
         * #{{project_description}}#
         * #{{project_version}}#
         * #{{developer_name}}#
         * #{{developer_email}}#
         *
         * TODO:
         * -------------------
         * => CF Endpoint splitten um Domain aus cf_org und cf stack zusammensetzen zu können
         * => Basis Entities hinzufügen?
         * => Create ADO User
         * => logging für die mysql und co
         * => loging automatisieren
         * => auto start scriptyarn
         *
         *
         * IDEEN:
         * Frage Wie Große Die instanzen sein Sollen
         * Info wie credentails rotiert werden müssen
         * info kein DEV env
         * Description
         */
        $console = new SymfonyStyle($input, $output);
        $systemStyle = new OutputFormatterStyle('default', 'blue');
        $console->getFormatter()->setStyle('system', $systemStyle);
        $formatter = $this->getHelper('formatter');

        $console->title('Interactive setup to prepare cloud-ready project based on azure-devops and cloudfoundry');

        $cfOrg = null;
        $cfSpaces = [];
        $cfEndPoint = null;
        $cfAddSpace = true;
        $appNameLong = null;
        $appNameShort = null;
        $appVersion = "0.1.0";
        $userFullName = null;
        $userEmail = null;
        $azureDevopsProject = "no";
        $cfApplicationEndPoint = "";
        $cfConsoleEndPoint = "";
        $cfApiEndPoint = "";

        $helper = $this->getHelper('question');
        $console->section('Please answer the following questions to setup this package to the needs of your project');
        $console->writeln([
            'Each step will provide useful information how to proceed and get prepared.',
            'If you answer a question with "No" the command will exit. You can restart the command later on.',
        ]);
        $console->newLine(2);
        $console->section('Cloudfoundry command-line-tools');
        // Basic questions
        $console->writeln([
            'In order to able to use the cloudfoundry command-line-tools (cli) locally in your project-root please confirm',
            'that if you have them already installed. Otherwise please follow the instructions of this manual:',
            '',
            'https://www.secrz.de/confluence/display/CPHP/Cloud+Foundry+im+Detail#CloudFoundryimDetail-setup',
            '',
            'If you got brew installed run:',
            '<fg=blue>brew install cloudfoundry/tap/cf-cli@7</>',
        ]);
        $console->newLine(1);

        $questionCFInstall = new ConfirmationQuestion('<comment>Do you have already installed the cloudfoundry command-line-tools?</comment> (y/N) ', false, '/^(y|j)/i');
        $questionCfInstance = new ConfirmationQuestion('<comment>Do you already have a cloudfoundry instance with org and spaces?</comment> (y/N) ', false, '/^(y|j)/i');
        $questionAzure = new ConfirmationQuestion('<comment>Is your git repository located in an azure devops project?</comment> (y/N) ', false, '/^(y|j)/i');
        $questionConfirmCorrectness = new ConfirmationQuestion('<comment>Are the displayed settings correct and you want to proceed?</comment> (y/N) ', false, '/^(y|j)/i');
        $questionAddSpace = new ConfirmationQuestion('<comment>Do you want to add another space?</comment> (y/N) ', false, '/^(y|j)/i');

        // Project related
        $questionCfDefaultSpaces = new ConfirmationQuestion('<comment>Do you want to use the default spaces [test|qa|prod]?</comment> (y/N) ', false, '/^(y|j)/i');
        $questionCfOrg = new Question('<comment>What is the title of the organisation?</comment> ');
        $questionCfSpace = new Question('<comment>What is the title of the space that should be added?</comment> ');
        $questionProjectNameLong = new Question('<comment>The long name of your application is?</comment> ');
        $questionProjectNameShort = new Question('<comment>The short name or abbrevation of your application is (4-8 characters)?</comment> ');
        $questionProjectDescription = new Question('<comment>Please provide a description of your project (40-150 characters)?</comment> ');
        $questionDevFullName = new Question('<comment>The full name of the developer (e.g. John Doe)?</comment> ');
        $questionDevEmail = new Question('<comment>The email of the developer (e.g. john.doe@mail.schwarz)?</comment> ');

        // Define cf services
        $questionDatabaseMysql = new ConfirmationQuestion('<comment>Add database service MySQL? (y/N) ', false, '/^(y|j)/i');
        $questionDatabasePostGreSql = new ConfirmationQuestion('<comment>Add database service PostGreSQL? (y/N) ', false, '/^(y|j)/i');
        $questionMongoDb = new ConfirmationQuestion('<comment>Add database service MongoDB? (y/N) ', false, '/^(y|j)/i');
        $questionRedis = new ConfirmationQuestion('<comment>Add key-value-store service Redis? (y/N) ', false, '/^(y|j)/i');
        $questionRabbitMQ = new ConfirmationQuestion('<comment>Add message-queue service RabbitMQ? (y/N) ', false, '/^(y|j)/i');
        $questionElasticsearch = new ConfirmationQuestion('<comment>Add database service ElasticSearch? (y/N) ', false, '/^(y|j)/i');
        $questionLogging = new ConfirmationQuestion('<comment>Add elk-stack service LogMe [recommended]? (y/N) ', true, '/^(y|j)/i');
        $questionAutoScaler = new ConfirmationQuestion('<comment>Add rule-based-scaling service a AutoScaler [recommended]? (y/N) ', true, '/^(y|j)/i');

        // Choose
        $QuestionCfEndpoint = new ChoiceQuestion('Which cloudfoundry endpoint do you use?', ['External', 'Internal', 'Staging']);

        // ckeck cf cli
        if ($helper->ask($input, $output, $questionCFInstall)) {
            $console->newLine(1);
            $console->section('Cloudfoundry org and spaces');
            $console->writeln([
                'To set up your ckoudfoundry instance just visit the Stack IT portal and create an new project.',
                'If you actually dont have a psp-element for billing you can use in the start phase: SIT-Innovation',
                '',
                'https://portal.stackit.cloud',
                '',
                'The organisation in a cloudfoundry instance is always the short title of your project:',
                '',
                'Organisation examples:',
                '- mylinks',
                '- stores',
                '- pre-zero',
                '',
                'Spaces can be seen as equivalent to stages!',
                '',
                'The default spaces are:',
                '- test',
                '- qa',
                '- prod',
                '',
                'Please rename the suggested default space <fg=blue>dev</> to <fg=blue>test</> in Stack IT portal, because it will collide with dev-mode of symfony.',
            ]);
        } else {
            $console->writeln($formatter->formatBlock(['[EXIT] Please install cloudfoundry command-line-tools and restart this command afterwards.'], 'system', true));

            return Command::FAILURE;
        }
        $console->newLine(1);

        // ckeck cf space and org
        if ($helper->ask($input, $output, $questionCfInstance)) {
            $console->newLine(1);
            $console->section('Cloudfoundry organisation');
            $console->writeln([
                'The organisation in a cloudfoundry instance is always the short title of your project:',
                '',
                'Organisation examples:',
                '- mylinks',
                '- stores',
                '- pre-zero',
            ]);
            $console->newLine(1);
            $cfOrg = str_replace("_", "-", strtolower($helper->ask($input, $output, $questionCfOrg)));
            $cfOrgAdo = str_replace("-", "_", $cfOrg);
            $console->newLine(1);
            $console->section('Cloudfoundry spaces');
            if ($helper->ask($input, $output, $questionCfDefaultSpaces)) {
                $cfSpaces = ['test', 'qa', 'prod'];
            } else {
                $console->writeln([
                    'You have decided to provide the needed spaces on your own. Spaces can be seen as equivalent to stages.',
                    'The minimum should be [test|prod]. You can now add as many spaces as you want in a loop.',
                ]);
                $console->newLine(1);
                while ($cfAddSpace) {
                    $cfSpaces[] = strtolower($helper->ask($input, $output, $questionCfSpace));
                    $cfAddSpace = $helper->ask($input, $output, $questionAddSpace);
                }
            }
            $console->newLine(1);
            $console->section('Cloudfoundry endpoint');
            $console->writeln([
                'Actually there are 3 valid endpoints you can choose from in Stack IT AppCloud:',
                '',
                '- <fg=yellow>External</> [01.cf.eu01.stackit.cloud] => <fg=blue>free reachable from the internet</>',
                '- <fg=yellow>Internal</> [02.cf.eu01.stackit.schwarz] => <fg=blue>only inside the company network accessible</>',
                '- <fg=yellow>Staging</> [00.cf.eu01.stackit.schwarz] => <fg=blue>used to test updates to the internal and external platform</>',
            ]);
            $console->newLine(1);
            $cfEndPoint = $helper->ask($input, $output, $QuestionCfEndpoint);
        } else {
            $console->writeln($formatter->formatBlock(['[EXIT] Please set up a project with cloudfoundry instance on: https://portal.stackit.cloud'], 'system', true));

            return Command::FAILURE;
        }

        switch ($cfEndPoint) {
            case 'External':
                $cfApiEndPoint = 'https://api.system.01.cf.eu01.stackit.cloud';
                $cfConsoleEndPoint = 'https://console.apps.01.cf.eu01.stackit.cloud';
                $cfApplicationEndPoint = 'apps.01.cf.eu01.stackit.cloud';
                break;
            case 'Internal':
                $cfApiEndPoint = 'https://api.system.02.cf.eu01.stackit.schwarz';
                $cfConsoleEndPoint = 'https://console.apps.02.cf.eu01.stackit.schwarz';
                $cfApplicationEndPoint = 'apps.02.cf.eu01.stackit.schwarz';
                break;
            case 'Staging':
                $cfApiEndPoint = 'https://api.system.00.cf.eu01.stackit.schwarz';
                $cfConsoleEndPoint = 'https://console.apps.00.cf.eu01.stackit.schwarz';
                $cfApplicationEndPoint = 'apps.00.cf.eu01.stackit.schwarz';
                break;
        }

        $console->newLine(1);
        $console->section('Azure devops project');
        $console->writeln([
            'In order to be able to deploy to your application to your cloudfoundry instance it is recommended to base',
            'your complete project on azure devops, because it works seamlessly with cloudfoundry and artifactory.',
            '',
            'Please set up your azure devops project easily with:',
            'https://dss.schwarz',
            '',
            'Azure devops instance of Schwarz IT:',
            'https://dev.azure.com/schwarzit',
        ]);
        $console->newLine(1);
        if ($helper->ask($input, $output, $questionAzure)) {
            $azureDevopsProject = 'yes';
            $console->newLine(1);
            $console->writeln([
                'The main location of our companies azure devops instance is located here:',
                'https://dev.azure.com/schwarzit',
                '',
                'Please ensure others can access your azure devops project by creating an IT4You ticket.',
                'Dont forget to request access with permission <fg=blue>read</> for group <fg=blue>schwarzit-php-chapter</>.',
            ]);
            $console->newLine(1);
        } else {
            $console->writeln($formatter->formatBlock(['[EXIT] Please change the hosting of your project code-base to azure devops: https://dev.azure.com/schwarzit'], 'system', true));

            return Command::FAILURE;
        }

        $console->newLine(1);
        $console->section('Basic project infos');
        $console->writeln([
            'The following questions will ask for basic information and naming of your projects.',
            'Your answers will be used to automatically replace placeholders to important project files.',
            '',
            'Example for project-naming:',
            '',
            'Long project names:',
            '- kaufland-giftcard',
            '- e-charging-station',
            '',
            'Corresponding short project names:',
            '- kl-gcard',
            '- echarger',
        ]);
        $console->newLine(1);
        $appNameLong = strtolower($helper->ask($input, $output, $questionProjectNameLong));
        $appNameShort = strtolower($helper->ask($input, $output, $questionProjectNameShort));
        $appDescription = $helper->ask($input, $output, $questionProjectDescription);
        $userFullName = $helper->ask($input, $output, $questionDevFullName);
        $userEmail = strtolower($helper->ask($input, $output, $questionDevEmail));

        $console->newLine(1);
        $console->section('Service configuration');
        $console->writeln([
            'The following questions will ask you for the needed services to run your application.',
            'This command will gererate a shell-script, which will automatically add the needed services to each space.',
            'This is only for convenience and you can add more services later on with the cloudfoundry command-line-tools.',
            '',
            'Prices for the services can be found here:',
            'https://app4you.schwarz/services/STACKIT_Portal/SitePages/unsere_preise.aspx',
            '',
            'You can login into your cloudfoundry instance and take a look at the marketplace for all available services.',
            'Each service consists of a different amount of plans, which represent the size (e.g. small, big, cluster)',
            '',
            'External: https://console.apps.01.cf.eu01.stackit.cloud/marketplace',
            'Internal: https://console.apps.02.cf.eu01.stackit.schwarz/marketplace',
        ]);
        $console->newLine(1);
        $console->section('Select your desired database service');
        $serviceMySql = $helper->ask($input, $output, $questionDatabaseMysql);
        $servicePostGreSql = $helper->ask($input, $output, $questionDatabasePostGreSql);
        $serviceMongoDb = $helper->ask($input, $output, $questionMongoDb);
        $console->newLine(1);
        $console->section('Select your desired performance related services');
        $serviceRedis = $helper->ask($input, $output, $questionRedis);
        $serviceRabbitMQ = $helper->ask($input, $output, $questionRabbitMQ);
        $serviceElasticSearch = $helper->ask($input, $output, $questionElasticsearch);
        $console->newLine(1);
        $console->section('Select your desired additional services');
        $serviceAutoScaler = $helper->ask($input, $output, $questionAutoScaler);
        $serviceLogging = $helper->ask($input, $output, $questionLogging);

        $console->newLine(1);
        $console->section('Overview selected configuration');
        $console->writeln([
            '<info>Summary:</info>',
            '   <info>Basic info:</info>',
            '       <info>Developer full name:</info> '.$userFullName,
            '       <info>Developer email:</info> '.$userEmail,
            '       <info>Long application name:</info> '.$appNameLong,
            '       <info>Short application name:</info> '.$appNameShort,
            '   <info>Cloudfoundry instance:</info>',
            '       <info>Cloudfoundry organisation:</info> '.$cfOrg,
            '       <info>Cloudfoundry spaces:</info> '.implode(', ', $cfSpaces),
            '       <info>Cloudfoundry endpoint:</info> '.$cfEndPoint,
            '       <info>Cloudfoundry application endpoint:</info> '.$cfApplicationEndPoint,
            '   <info>Azure Devops:</info>',
            '       <info>Existent project:</info> '.$azureDevopsProject,
            '   <info>Selected services:</info>',
            '       <info>Add service MySQL:</info> '.(empty($serviceMySql) ? 'no' : 'yes'),
            '       <info>Add service PostGreSQL:</info> '.(empty($servicePostGreSql) ? 'no' : 'yes'),
            '       <info>Add service MongoDB:</info> '.(empty($serviceMongoDb) ? 'no' : 'yes'),
            '       <info>Add service Redis:</info> '.(empty($serviceRedis) ? 'no' : 'yes'),
            '       <info>Add service RabbitMQ:</info> '.(empty($serviceRabbitMQ) ? 'no' : 'yes'),
            '       <info>Add service ElasticSearch:</info> '.(empty($serviceElasticSearch) ? 'no' : 'yes'),
            '       <info>Add service AutoScaler:</info> '.(empty($serviceAutoScaler) ? 'no' : 'yes'),
            '       <info>Add service Logging:</info> '.(empty($serviceLogging) ? 'no' : 'yes'),
        ]);
        $console->newLine(1);

        if ($helper->ask($input, $output, $questionConfirmCorrectness)) {
            $data = [
                'projectSecret' => md5(Uuid::v4()),
                'userEmail' => $userEmail,
                'userFullName' => $userFullName,
                'appVersion' => $appVersion,
                'appNameLong' => $appNameLong,
                'appNameShort' => $appNameShort,
                'appDescription' => $appDescription,
                'cfOrg' => $cfOrg,
                'cfOrgAdo' => $cfOrgAdo,
                'cfSpaces' => $cfSpaces,
                'cfApiEndPoint' => $cfApiEndPoint,
                'cfApplicationEndPoint' => $cfApplicationEndPoint,
                'serviceMySql' => $serviceMySql,
                'servicePostGreSql' => $servicePostGreSql,
                'serviceMongoDb' => $serviceMongoDb,
                'serviceLogging' => $serviceLogging,
                'serviceRedis' => $serviceRedis,
                'serviceAutoScaler' => $serviceAutoScaler,
                'serviceElasticSearch' => $serviceElasticSearch,
                'serviceRabbitMQ' => $serviceRabbitMQ,
            ];
            $this->replaceAllPlaceholdersInFiles($data);
            $this->generateNewFiles($data);
        } else {
            $console->writeln($formatter->formatBlock(['[EXIT] Command was terminated without generating or changing files.'], 'system', true));

            return Command::FAILURE;
        }

        $console->newLine(1);
        $console->section('Finish and final instructions');
        $console->writeln('<info>The file of this command may be deleted later on:</info> ./src/Command/SetupCommand.php');
        $console->newLine(1);
        $console->writeln([
            '<info>Please fill the following files with actual passwords or copy them from a running project:</info>',
            '- auth.json => needed by composer.json to connect to artifactory',
            '- ..npmrc => needed by npm or yarn to connect to artifactory',
        ]);
        $console->newLine(1);
        $console->writeln('<info>Execute the following line outside the container:</info> chmod +x ./setup.sh && ./setup.sh');
        $console->newLine(1);
        $console->writeln('<info>When the shell-script has finished visit your console endpoint:</info> ' . $cfConsoleEndPoint);
        $console->newLine(1);
        $console->success('You have successfully set up your application to run in cloudfoundry');

        return Command::SUCCESS;
    }

    private function replaceAllPlaceholdersInFiles(array $data): void
    {
        foreach ($this->files as $file) {
            $content = file_get_contents($file);
            $replaceMap = [
                '#{{cf_org}}#' => $data['cfOrg'],
                '#{{cf_org_ado}}#' => $data['cfOrgAdo'],
                '#{{cf_endpoint}}#' => $data['cfApplicationEndPoint'],
                '#{{project_secret}}#' => $data['projectSecret'],
                '#{{project_version}}#' => $data['appVersion'],
                '#{{project_host_url}}#' => "https://" . $data['appNameLong']. "." .$data['cfApplicationEndPoint'],
                '#{{project_description}}#' => $data['appDescription'],
                '#{{project_name_long}}#' => $data['appNameLong'],
                '#{{project_name_short}}#' => $data['appNameShort'],
                '#{{developer_email}}#' => $data['userEmail'],
                '#{{developer_name}}#' => $data['userFullName'],
                'initialsetup' => $data['appNameShort']
            ];

            file_put_contents($file, strtr($content, $replaceMap));
        }
    }

    private function generateNewFiles(array $data): void
    {
        $filesystem = new Filesystem();

        $setupScript = "";
        $setupScriptLast = "";
        $setupScript .= "cf login -a ". $data['cfApiEndPoint'] . " --sso \n";

        // create pairs of manifest-files for blue-green-deployment
        foreach ($data['cfSpaces'] as $cfSpace) {
            $setupScript .= "cf target -o " . $data['cfOrg'] . " -s " . $cfSpace . " \n";

            $manifestFile         = "manifest." . $cfSpace . ".yml";
            $manifestGreenFile    = "manifest." . $cfSpace . ".temp.yml";
            $manifestAppName      = $data['cfOrg'] . "-" . $cfSpace;
            $manifestGreenAppName = $data['cfOrg'] . "-temp-" . $cfSpace;
            $manifestFileInput    = "applications: \n";
            $manifestFileInput    .= "  - name: " . $manifestAppName . " \n";
            $manifestFileInput    .= "    buildpacks: \n";
            $manifestFileInput    .= "      - https://github.com/cloudfoundry/php-buildpack \n";
            $manifestFileInput    .= "    memory: 2GB \n";
            $manifestFileInput    .= "    disk_quota: 4GB \n";
            $manifestFileInput    .= "    instances: 1 \n";
            $manifestFileInput    .= "    env: \n";
            $manifestFileInput    .= "      SYMFONY_ENV: " . $cfSpace . " \n";
            $manifestFileInput    .= "      APP_ENV: " . $cfSpace . " \n";
            $manifestFileInput    .= "      TZ: Europe/Berlin \n";
            $manifestFileInput    .= "    routes: \n";
            $manifestFileInput    .= "      - route: https://" . $manifestAppName . "." . $data['cfApplicationEndPoint'] . "\n";
            $manifestFileInput    .= "    services: \n";

            $filesystem->dumpFile($manifestFile, $manifestFileInput);

            // add service lines to manifest.yml and setup shell-script
            if ($data['serviceMySql']) {
                $setupScript .= "cf create-service a9s-mysql101 mysql-single-small " . $data['cfOrg'] . "-mysql-" . $cfSpace . " \n";
                $filesystem->appendToFile($manifestFile, "        - " . $data['cfOrg'] . "-mysql-" . $cfSpace . " \n");
            }
            if ($data['servicePostGreSql']) {
                $setupScript .= "cf create-service a9s-postgresql11 postgresql-single-small-ssl " . $data['cfOrg'] . "-postgresql-" . $cfSpace . " \n";
                $filesystem->appendToFile($manifestFile, "        - " . $data['cfOrg'] . "-postgresql-" . $cfSpace . " \n");
            }
            if ($data['serviceMongoDb']) {
                $setupScript .= "cf create-service stackit-mongodb stackit-mongodb-small-single-instance-qc " . $data['cfOrg'] . "-mongodb-" . $cfSpace . " \n";
                $filesystem->appendToFile($manifestFile, "        - " . $data['cfOrg'] . "-mongodb-" . $cfSpace . " \n");
            }
            if ($data['serviceLogging']) {
                $setupScript .= "cf create-service a9s-logme logme-single-small " . $data['cfOrg'] . "-logging-" . $cfSpace . " \n";
                $filesystem->appendToFile($manifestFile, "        - " . $data['cfOrg'] . "-logging-" . $cfSpace . " \n");
            }
            if ($data['serviceRedis']) {
                $setupScript .= "cf create-service a9s-redis50 redis-single-small " . $data['cfOrg'] . "-redis-" . $cfSpace . " \n";
                $filesystem->appendToFile($manifestFile, "        - " . $data['cfOrg'] . "-redis-" . $cfSpace . " \n");
            }
            if ($data['serviceAutoScaler']) {
                $setupScript .= "cf create-service autoscaler autoscaler-free-plan " . $data['cfOrg'] . "-autoscaler-" . $cfSpace . " \n";
                $filesystem->appendToFile($manifestFile, "        - " . $data['cfOrg'] . "-autoscaler-" . $cfSpace . " \n");
            }
            if ($data['servicePostGreSql']) {
                $setupScript .= "cf create-service a9s-elasticsearch6 elasticsearch-single-small-ssl " . $data['cfOrg'] . "-elasticsearch-" . $cfSpace . " \n";
                $filesystem->appendToFile($manifestFile, "        - " . $data['cfOrg'] . "-elasticsearch-" . $cfSpace . " \n");
            }
            if ($data['serviceRabbitMQ']) {
                $setupScript .= "cf create-service a9s-rabbitmq37 rabbitmq-single-medium-ssl " . $data['cfOrg'] . "-rabbitmq-" . $cfSpace . " \n";
                $filesystem->appendToFile($manifestFile, "        - " . $data['cfOrg'] . "-rabbitmq-" . $cfSpace . " \n");
            }
            // create space-scoped service accounts and create service-key for user credentials
            $setupScript .= "cf create-service space-scoped-service-account space-deployer " . $data['cfOrg'] . "-space-deployer-" . $cfSpace . " \n";
            $setupScript .= "cf create-service-key " . $data['cfOrg'] . "-space-deployer-" . $cfSpace . " space-deployer " . $data['cfOrg'] . "-space-deployer-" . $cfSpace . "-servicekey \n";
            $setupScript .= "echo \"Create a new service-connection: azure devops > schwarzit.projectname > settings > service connections\"\n";
            $setupScript .= "echo \"Service-connection server-url: " . $data['cfApiEndPoint'] . "\"\n";
            $setupScript .= "echo \"Use the following credentials for the service-connection of space " . $cfSpace . "\"\n";
            $setupScript .= "cf service-key " . $data['cfOrg'] . "-space-deployer-" . $cfSpace . " space-deployer " . $data['cfOrg'] . "-space-deployer-" . $cfSpace . "-servicekey \n";
            $setupScript .= "echo \"Service-connection name corresponding to pipeline: CloudFoundry Connection " . ucfirst($cfSpace) . "\"\n";
            $setupScript .= "echo \"Check \"Grant access permission to all pipelines\" and save new service-connection.\"\n";

            // duplicate manifest.yml and prepare for blue/green deployment in pipelines
            $filesystem->copy($manifestFile, $manifestGreenFile);
            $content = file_get_contents($manifestGreenFile);
            $replaceMap = [
                $manifestAppName => $manifestGreenAppName,
            ];
            file_put_contents($manifestGreenFile, strtr($content, $replaceMap));

            $setupScriptLast .= "cf push " . $data['cfOrg'] . "-" . $cfSpace . " --docker-image nginxdemos/hello  --no-manifest  \n";
            $setupScript .= "echo \"Waiting 60 seconds for services to be generated \"\n";
            $setupScript .= $setupScriptLast;
        }


        $filesystem->dumpFile('setup.sh', $setupScript);
        $filesystem->copy('composer.json.dist', 'composer.json');
    }
}
