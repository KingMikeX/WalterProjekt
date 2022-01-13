#!/bin/zsh
RED="\e[31m"
ENDCOLOR="\e[0m"
docker-sync clean
docker-sync start
docker-compose up -d
echo -e "${RED} Runing install command${ENDCOLOR}"
docker-compose exec php /bin/bash -c "composer install && php bin/console project:setup"
chmod +x ./setup.sh && ./setup.sh
echo -e "${RED} Done ${ENDCOLOR}"