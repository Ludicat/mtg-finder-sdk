FROM php:8.2-cli

ARG PHP_CONTAINER_NAME
ARG GITHUB_TOKEN
ARG GITLAB_TOKEN
ARG GIT_EMAIL
ARG GIT_NAME

RUN apt-get update && apt-get upgrade -y
RUN apt-get update && apt-get install -y apt-transport-https

# PHP extensions and tools
RUN apt-get install -y --fix-missing libzip-dev zlib1g zlib1g-dev \
 && docker-php-ext-configure zip \
 && docker-php-ext-install zip \
 && docker-php-ext-enable zip
RUN apt-get install -y --fix-missing jpegoptim optipng
RUN apt-get install -y --fix-missing libonig-dev \
 && docker-php-ext-install exif mbstring opcache \
 && docker-php-ext-enable exif mbstring opcache

# Add know hosts
RUN mkdir ~/.ssh
RUN ssh-keyscan github.com >> ~/.ssh/known_hosts

# Add sudo
RUN apt-get install -y --fix-missing sudo

COPY php.ini /usr/local/etc/php/

# Composer
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN echo "export PATH=$HOME/.composer/vendor/bin:$PATH" >> /root/.bashrc

# Install tools
RUN apt-get install -y --fix-missing \
    sudo \
    nano \
    wget \
    xdg-utils

WORKDIR /var/www/html

RUN mkdir /etc/skel/.composer
RUN addgroup --gid 1000 docker
RUN useradd --uid 1000 --gid 1000 -md /home/docker -s /bin/bash docker
RUN adduser docker www-data
COPY php.ini /usr/local/etc/php/
COPY sudo_docker /etc/sudoers.d/docker

# Custom prompt
COPY .bashrc_root /root/.bashrc
COPY .bashrc_docker /home/docker/.bashrc
RUN echo 'PS1="🐳  \[\033[1;34m\]${PHP_CONTAINER_NAME} \[\033[0m\](\h) \[\033[1;36m\]\W\[\033[0;35m\] \[\033[0m\]# \[\033[0m\]"' >> /root/.bashrc
RUN echo 'PS1="🐳  \[\033[1;34m\]${PHP_CONTAINER_NAME} \[\033[0m\](\h) \[\033[1;36m\]\W\[\033[0;35m\] \[\033[0m\]# \[\033[0m\]"' >> /home/docker/.bashrc

# Configure composer tokens
RUN sudo -u docker composer config -g github-oauth.github.com ${GITHUB_TOKEN}
RUN sudo -u docker composer config -g gitlab-domains [gitlab.com]
RUN sudo -u docker composer config -g gitlab-token.gitlab.com ${GITLAB_TOKEN}
RUN wget https://get.symfony.com/cli/installer -O - | bash
RUN cp /root/.symfony5/bin/symfony /usr/local/bin/symfony

RUN sudo -u docker git config --global user.email "${GIT_EMAIL}"
RUN sudo -u docker git config --global user.name "${GIT_NAME}"

# Clean
RUN apt-get purge -y \
&& apt-get autoremove -y \
&& apt-get clean \
&& rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
