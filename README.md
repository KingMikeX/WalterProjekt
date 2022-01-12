# PLS Run ./install.sh
# symfony5mike

## Description 
Mikes first symfony prject

## Getting Started

```
# start local docker environment
make up

# alternatively as single commands
docker-sync start
docker-compose up --build


# connect to php docker container
make run

# alternatively as single commands
docker-compose exec --user=deploy php /bin/bash

# install composer and frontend packages
composer install
yarn install
yarn encore dev
```

## Setup

To create first time initialization with token replacement on many configuration files start the setup command.
The manifest.yml files will be generated as well as a little helper shell-script to create the needed cloudfoundry services.
```
# connect to php docker container
make run

# alternatively as single commands
docker-compose exec --user=deploy php /bin/bash

# execute setup command to replace tokens and create setup.sh
bin/console project:setup
```

## Finally

- The docker-sync.yml and docker-compose.yml were modified
- To get changes in effect the former docker setup has to be removed
- Kill all containers beginning with base-symfony-cloud
- Remove the docker-sync
- Restart docker environment
- If everything works add the remote of your new azure devops repo and push the code