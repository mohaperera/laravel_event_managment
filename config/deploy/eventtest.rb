set :branch, "master"
set :domain, "eventtest.inwizards.com"
set :deploy_to, "/var/www/#{domain}"

role :web, "eventtest.inwizards.com"
