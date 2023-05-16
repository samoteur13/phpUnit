DOCKER=docker compose
COMPOSER=symfony composer

.DEFAULT_GOAL := docker-install

help: ## Outputs this help screen
	@grep -E '(^[a-zA-Z0-9_-]+:.*?## .*$$)|(^## )' Makefile | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'

composer-install:
	$(COMPOSER) install

clean: ## restet your symfony project
	rm -Rf bin config migrations public src tests translations var vendor .env .env.test .gitignore composer.* symfony.lock phpunit* templates .env.local

docker-install: Dockerfile docker-compose.yaml clean docker-down docker-build docker-up docker-ps docker-logs ## Reset and install your environment

docker-up: docker-down ## Start the docker container
	$(DOCKER) up -d

docker-logs: ## List the docker containers
	$(DOCKER) logs -f

docker-ps: ## List the docker containers
	$(DOCKER) ps -a

docker-build: ## Build the docker container
	$(DOCKER) build

docker-down: ## down the stack
	$(DOCKER) down --remove-orphans

docker-sh: ## Connect to the docker container
	$(DOCKER) exec -it api zsh
