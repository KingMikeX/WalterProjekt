<?php

namespace App\Command;

use Predis\Client;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class RedisMaintenanceCommand extends Command
{
    private Client $redisClientDoctrine;
    private Client $redisClientSession;
    private Client $redisClientCache;
    private ParameterBagInterface $parameterBag;

    public function __construct(
        Client $redisClientDoctrine,
        Client $redisClientSession,
        Client $redisClientCache,
        ParameterBagInterface $parameterBag
    ) {
        $this->redisClientDoctrine = $redisClientDoctrine;
        $this->redisClientSession = $redisClientSession;
        $this->redisClientCache = $redisClientCache;
        $this->parameterBag = $parameterBag;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setName('project:maintenance:redis')
            ->setDescription('A command for maintenance and deployment tasks concerning redis')
            ->setHelp('A command for maintenance and deployment tasks concerning redis. Select predefined command and redis-client as parameters.')
            ->addOption('maintenance-command', 'm', InputOption::VALUE_OPTIONAL, 'Select command [info | flushdb | keys]', 'info')
            ->addOption('doctrine-client', 'd', InputOption::VALUE_NONE, 'Select doctrine-client and process selected command')
            ->addOption('session-client', 's', InputOption::VALUE_NONE, 'Select session-client and process selected command')
            ->addOption('cache-client', 'c', InputOption::VALUE_NONE, 'Select cache-client and process selected command')
            ->addOption('ignore', 'i', InputOption::VALUE_NONE, 'Azure devops pipeline parameter to ignore a setting');
    }

    protected function interact(InputInterface $input, OutputInterface $output): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): ?int
    {
        $exitCode = null;

        $console = new SymfonyStyle($input, $output);
        $console->title('Executing redis maintenance-task based on passed parameters');

        $systemStyle = new OutputFormatterStyle('default', 'blue');
        $console->getFormatter()->setStyle('system', $systemStyle);
        $formatter = $this->getHelper('formatter');

        if (!$this->lock()) {
            $console->writeln($formatter->formatBlock('[SYSTEM] Aborting execution for the reason that another instance of this command is already running!', 'system', true));

            return $exitCode = 0;
        }

        if (
            false === $input->getOption('doctrine-client') &&
            false === $input->getOption('session-client') &&
            false === $input->getOption('cache-client')
        ) {
            $console->error('No redis-client was selected to execute passed maintenance-command');

            return $exitCode = 1;
        }

        if (null !== $input->getOption('maintenance-command')) {
            $console->writeln('<info>Maintenance command:</info> ' . $input->getOption('maintenance-command'));
            $console->newLine(1);
        }

        if ('info' === $input->getOption('maintenance-command')) {
            $console->section('Redis info');
            $redisInfos = $this->redisClientCache->info();

            foreach ($redisInfos['Server'] as $key => $value) {
                $console->writeln('<info>' . $key . ':</info> ' . $value);
            }
            $console->newLine(1);
        } else {

            if (false !== $input->getOption('doctrine-client')) {
                $console->writeln('<info>Selected client:</info> doctrine-client');
                $console->writeln('<info>Database:</info> ' . $this->parameterBag->get('redis_doctrine_dbindex'));

                switch ($input->getOption('maintenance-command')) {
                    case 'keys':
                        $console->writeln('<info>Listing all keys:</info>');
                        $console->writeln(empty($keys = $this->redisClientDoctrine->keys('*')) ? 'No keys' : $keys);

                        break;
                    case 'flushdb':
                        $console->writeln('Deleting all keys from database');
                        $this->redisClientDoctrine->flushdb();

                        break;
                }
                $console->newLine(1);
            }

            if (false !== $input->getOption('session-client')) {
                $console->writeln('<info>Selected client:</info> session-client');
                $console->writeln('<info>Database:</info> ' . $this->parameterBag->get('redis_session_dbindex'));

                switch ($input->getOption('maintenance-command')) {
                    case 'keys':
                        $console->writeln('<info>Listing all keys:</info>');
                        $console->writeln(empty($keys = $this->redisClientSession->keys('*')) ? 'No keys' : $keys);

                        break;
                    case 'flushdb':
                        $console->writeln('Deleting all keys from database');
                        $this->redisClientSession->flushdb();

                        break;
                }
                $console->newLine(1);
            }

            if (false !== $input->getOption('cache-client')) {
                $console->writeln('<info>Selected client:</info> cache-client');
                $console->writeln('<info>Database:</info> ' . $this->parameterBag->get('redis_cache_dbindex'));

                switch ($input->getOption('maintenance-command')) {
                    case 'keys':
                        $console->writeln('<info>Listing all keys:</info>');
                        $console->writeln(empty($keys = $this->redisClientCache->keys('*')) ? 'No keys' : $keys);

                        break;
                    case 'flushdb':
                        $console->writeln('Deleting all keys from database');
                        $this->redisClientCache->flushdb();

                        break;
                }
                $console->newLine(1);
            }
        }

        $console->newLine(1);
        $console->writeln($formatter->formatBlock('[SYSTEM] Execution of redis maintenance-command completed!', 'system', true));

        return $exitCode = 0;
    }
}
