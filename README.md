# ApiPlatformDebug
A minimalist config for debugung

Create a database named "app"

launch composer install

php bin/console doctrine:schema:update --force

php bin/console doctrine:fixture:load


grab GET  /tickets.json?project.EAteamUser=2
