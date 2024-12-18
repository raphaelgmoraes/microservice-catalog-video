############################################
# Base Image
############################################
FROM serversideup/php:8.4-fpm-nginx

USER root
# Reference: https://github.com/mlocati/docker-php-extension-installer
RUN install-php-extensions @composer gd xdebug intl bcmath sockets
COPY --chmod=755 ./entrypoint.d/ /etc/entrypoint.d/
# Switch to root so we can do root things
USER root

# Save the build arguments as a variable
ARG USER_ID
ARG GROUP_ID

# Use the build arguments to change the UID
# and GID of www-data while also changing
# the file permissions for NGINX
RUN docker-php-serversideup-set-id www-data $USER_ID:$GROUP_ID && \
    \
    # Update the file permissions for our NGINX service to match the new UID/GID
    docker-php-serversideup-set-file-permissions --owner $USER_ID:$GROUP_ID --service nginx

# Drop back to our unprivileged user
USER www-data

WORKDIR /var/www/html
