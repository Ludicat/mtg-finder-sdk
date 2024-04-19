OS = $(shell uname)

DOT_ENV = .env
include $(DOT_ENV)
ifneq ("$(wildcard .env.local)","")
	DOT_ENV = .env.local
	include $(DOT_ENV)
endif
export

IS_DOCKER := $(shell docker info > /dev/null 2>&1 && echo 1)
DOCKER_PARAM = --env-file $(DOT_ENV) -f ".docker/env/$(APP_ENV).yml"

# Determine the executable name based on availability
EXECUTABLE :=
ifeq ($(shell command -v docker-compose 2>/dev/null),)
    ifeq ($(shell command -v docker 2>/dev/null),)
        $(error Neither docker-compose nor docker is installed. Please install either one.)
    else
        EXECUTABLE := docker compose
    endif
else
    EXECUTABLE := docker-compose
endif

DOCKER_TOOLBOX_CONTAINER_NAME = $(CLI_CONTAINER_NAME)

STEP = "\\n\\r**************************************************\\n"

help:
	@echo "-- build: builds the docker images required to run this project"; \
	echo "-- build-force: Force rebuilds the docker images required to run this project"; \
	echo "-- start: starts the project"; \
	echo "-- restart: restart the project"; \
	echo "-- stop: stops the project"; \
	echo "-- setup: setup the project (to run the first time you wan to launch the project)"; \
	echo "-- update: updates the project dependencies and DB (to run each time you pull the project)"; \
	echo "-- composer: updates the project dependencies only (to run WITHOUT SUDO each time you pull the project)"; \
	echo "-- down: stops and removes containers used for this project (can generate data loss)"; \
	echo "-- ssh: enters TOOLBOX container CLI"; \
	echo "-- root-ssh: enters TOOLBOX container CLI as root"; \
	echo "-- logs: displays real time logs of containers used for this project"; \
	echo "-- test: prepare test DB and run PhpUnit test suite"; \
	echo "-- purge: Delete all container and images"; \

build: do-init do-build do-finish
do-build:
	@eval $$(cat .docker-config); \
	echo "$(STEP) Building images... $(STEP)"; \
	$(EXECUTABLE) $(DOCKER_PARAM) build;

build-force: do-init do-build-force do-finish
do-build-force:
	@echo "$(STEP) Building images... $(STEP)"
	$(EXECUTABLE) $(DOCKER_PARAM) build --no-cache

start: do-init do-start do-finish
do-start:
	@eval $$(cat .docker-config); \
	echo "$(STEP) Starting up containers... $(STEP)"; \
	$(EXECUTABLE) $(DOCKER_PARAM) up -d; \

restart: do-init do-stop do-start do-finish

update: do-init do-update do-finish
do-update:
	@eval $$(cat .docker-config); \
	echo "$(STEP) Running full update... $(STEP)"; \
	./docker/update.sh
	docker exec -u docker $(DOCKER_TOOLBOX_CONTAINER_NAME) php app/console doctrine:schema:update --force;

test: do-init do-test do-finish
do-test:
	@echo "$(STEP) Cli Bash $(DOCKER_TOOLBOX_CONTAINER_NAME)... $(STEP)"; \
	docker exec -ti -u docker $(DOCKER_TOOLBOX_CONTAINER_NAME) /bin/bash ./.script/test.sh;

composer: do-init do-composer do-finish
do-composer:
	@eval $$(cat .docker-config); \
	echo "$(STEP) Update composer libs... $(STEP)"; \
	docker exec -u docker $(DOCKER_TOOLBOX_CONTAINER_NAME) composer update

stop: do-init do-stop do-finish
do-stop:
	@eval $$(cat .docker-config); \
	echo "$(STEP) Stopping containers... $(STEP)"; \
	$(EXECUTABLE) $(DOCKER_PARAM) stop;

down: do-init do-down do-finish
do-down:
	@eval $$(cat .docker-config); \
	echo "$(STEP) Stopping and removing containers... $(STEP)"; \
	$(EXECUTABLE) $(DOCKER_PARAM) down;

ssh: do-init do-ssh
do-ssh:
	@eval $$(cat .docker-config); \
	echo "$(STEP) Cli Bash $(DOCKER_TOOLBOX_CONTAINER_NAME)... $(STEP)"; \
	docker exec -ti -u docker $(DOCKER_TOOLBOX_CONTAINER_NAME) /bin/bash;

root-ssh: do-init do-root-ssh
do-root-ssh:
	@eval $$(cat .docker-config); \
	echo "$(STEP) Cli Bash $(DOCKER_TOOLBOX_CONTAINER_NAME)... $(STEP)"; \
	docker exec -ti $(DOCKER_TOOLBOX_CONTAINER_NAME) /bin/bash;

logs: do-init do-logs do-finish
do-logs:
	@eval $$(cat .docker-config); \
	echo "$(STEP) Displaying logs... $(STEP)"; \
	$(EXECUTABLE) $(DOCKER_PARAM) logs -f;

purge: do-init do-purge do-finish
do-purge:
	@eval $$(cat .docker-config); \
	echo "$(STEP) Kill all containers $(STEP)"; \
	docker kill $(docker ps -q)
	echo "$(STEP) Delete all containers $(STEP)"; \
	docker rm $(docker ps -a -q)
	echo "$(STEP) Delete all images $(STEP)"; \
	docker rmi $(docker images -q)


do-init:
	@touch .docker-config;
ifeq ($(OS),Darwin)
	@echo $$(docker-machine env default) >> .docker-config;
endif

do-finish:
	@rm .docker-config;
