set :application, "Event Management System"
set :repository, "git@codebasehq.com:inwizards-inc/event-management-system/events.git"
set :scm, :git
set :git_enable_submodules, 1
set :deploy_via, :remote_cache

set :default_stage, "eventtest"
set :stages, %w(eventtest)
require 'capistrano/ext/multistage'

set :user, "ubuntu"
set :group, "www-data"
set :use_sudo, true

set :keep_releases, 3

default_run_options[:pty] = true
set :ssh_options, {:user => 'ubuntu'}
set :ssh_options, {:forward_agent => true}
set :ssh_options, {:keys => "~/.ssh/personera.pem"}

namespace :deploy do
    task :create_symlinks do
        run "ln -nfs #{release_path}/app/config/stages/database.#{stage}.php #{release_path}/app/config/database.php"
        run "ln -nfs #{release_path}/app/config/stages/tms.#{stage}.php #{release_path}/app/config/tms.php"
        run "ln -nfs /mnt/tmstest/assets #{release_path}/public/assets"
        run "ln -nfs /mnt/tmstest/uploads #{release_path}/uploads"
    end

    task :set_permissions do
        run "sudo chown -R ubuntu:www-data #{release_path}"
        run "sudo chmod -R 775 #{release_path}/app/storage/"
    end

    task :post_install do
        run "cd #{release_path}; composer dump-autoload"
        run "cd #{release_path}; composer install > /dev/null"
        run "cd #{release_path}; bower install > /dev/null"

        run "sudo chmod 754 #{release_path}/artisan"
        run "cd #{release_path}; ./artisan migrate:refresh"
        run "cd #{release_path}; ./artisan db:seed"
    end

    task :finalize_update do
    end

    after 'deploy:update_code', 'deploy:create_symlinks', 'deploy:post_install', 'deploy:set_permissions'
    after 'deploy', 'deploy:cleanup'
end
