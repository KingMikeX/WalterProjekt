## Makefile for testing purposes and basic startup

.PHONY: help
help: ## display list of all available commands
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_\-\.]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

.PHONY: cs
cs: ## execute cs fixer from tools folder
	docker-compose exec --user=deploy php /var/www/html/tools/php-cs-fixer.phar fix --config=/var/www/html/.php_cs --diff --verbose

.PHONY: stan
stan: ## execute phpstan from tools folder
	docker-compose exec --user=deploy php /var/www/html/tools/phpstan.phar analyze --configuration=phpstan.neon --memory-limit=2G

.PHONY: unit
unit: ## execute unittests from tools folder
	docker-compose exec --user=deploy php /var/www/html/tools/phpunit.phar --configuration=phpunit.xml.dist

.PHONY: up
up: ## start up local docker-environment
	docker-sync start
	docker-compose up --build

.PHONY: down
down: ## shut down local docker-environment
	docker-compose down
	docker-sync clean

.PHONY: run
run: ## connect to cli of the php docker container
	docker-compose exec --user=deploy php /bin/bash

.PHONY: env-info
env-info: ## show all .env variables recognized by symfony
	bin/console debug:container --env-vars

.PHONY: cf-login
cf-login: ## login to cloud-foundry for this project
	cf login -a https://api.system.02.cf.eu01.stackit.schwarz --sso

.PHONY: code
cf-code: ## generate ssh code for ide connection
	cf ssh-code

.PHONY: cf-db
cf-db: ## establish ssh tunnel for database (add parameter: stage=test)
ifndef stage
	$(error Parameter stage is not set [stage=test|qa|prod])
endif
	cf target -s $(stage)
ifeq ($(stage), test)
	cf ssh -L 63306:msd97e985.service.dc1.a9ssvc:3306 symfony5mike-$(stage)
endif
ifeq ($(stage), qa)
	cf ssh -L 63306:msd903e32.service.dc1.a9ssvc:3306 symfony5mike-$(stage)
endif
ifeq ($(stage), prod)
	cf ssh -L 63306:msd97bcb0.service.dc1.a9ssvc:3306 symfony5mike-$(stage)
endif

.PHONY: cf-redis
cf-redis: ## establish ssh tunnel for redis (add parameter: stage=test). Connect with: redis-cli -h 127.0.0.1 -p 63379 -a REDIS_PASSWORD
ifndef stage
	$(error Parameter stage is not set [stage=test|qa|prod])
endif
	cf target -s $(stage)
	echo "Connect with => redis-cli -h 127.0.0.1 -p 63379 -a REDIS_PASSWORD"
ifeq ($(stage), test)
	cf ssh -L 63379:red8aa12-master.service.dc1.a9ssvc:6379 symfony5mike-$(stage)
endif
ifeq ($(stage), qa)
	cf ssh -L 63379:red259f34-master.service.dc1.a9ssvc:6379 symfony5mike-$(stage)
endif
ifeq ($(stage), prod)
	cf ssh -L 63379:red979aef-master.service.dc1.a9ssvc:6379 symfony5mike-$(stage)
endif

.PHONY: cf-ssh
cf-ssh: ## establish ssh tunnel to stage (add parameter: stage=test)
ifndef stage
	$(error Parameter stage is not set [stage=test|qa|prod])
endif
	cf target -s $(stage)
	cf ssh symfony5mike-$(stage)

.PHONY: tests
tests: cs stan unit ## execute all tests sequentially (cs fixer, phpstan, unit-tests)
.setup: