
set :stages,        %w(prod develop staging)
set :default_stage, "develop"
set :stage_dir,     "app/config/deploy"
require 'capistrano/ext/multistage'

ssh_options[:forward_agent] = true

set :application, "4devs"
set :domain,      "#{application}.io"
# set :deploy_to,   "/var/www/#{domain}"
set :app_path,    "app"
set :bin_path,    "bin"
set :var_path,    "var"
set :web_path,    "web"
set :symfony_env_prod, "prod"
set :symfony_console,       bin_path + "/console"
set :log_path,              var_path + "/logs"
set :cache_path,            var_path + "/cache"

set :shared_files,      ["app/config/parameters.yml"]
set :shared_children,     [var_path + "/logs", var_path + "/dump", var_path + "/spool", "vendor", web_path + "/uploads"]

set :writable_dirs, [var_path + "/cache", var_path + "/dump", var_path + "/spool", var_path + "/logs"]
set :webserver_user,    "nginx"
set :permission_method, :acl
set :use_set_permissions,   true

set :use_composer, true
# set :update_vendors, true
set :dump_assetic_assets, true

set :repository,  "git@github.com:4devs/blog.git"
set :scm,         :git

set :use_composer, true
set :dump_assetic_assets, true


#role :web,        domain                         # Your HTTP server, Apache/etc
#role :app,        domain, :primary => true       # This may be the same as your `Web` server

set  :keep_releases,  3
set  :use_sudo,      false

# Be more verbose by uncommenting the following line
# logger.level = Logger::MAX_LEVEL
