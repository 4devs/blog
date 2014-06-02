
set :stages,        %w(production develop staging)
set :default_stage, "develop"
set :stage_dir,     "app/config/deploy"
require 'capistrano/ext/multistage'

ssh_options[:forward_agent] = true

set :application, "4devs"
set :domain,      "#{application}.io"
# set :deploy_to,   "/var/www/#{domain}"
set :app_path,    "app"
set :web_path,    "web"

set :shared_files,      ["app/config/parameters.yml"]
set :shared_children,     [app_path + "/logs", "vendor", web_path + "/uploads"]

set :writable_dirs, ["app/cache"]
set :webserver_user,    "apache"
set :permission_method, :acl
set :use_set_permissions,   true

set :use_composer, true
# set :update_vendors, true
set :dump_assetic_assets, true

set :repository,  "git@github.com:4devs/blog.git"
set :scm,         :git
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `subversion`, `mercurial`, `perforce`, or `none`

set :use_composer, true
set :dump_assetic_assets, true


role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

set  :keep_releases,  3
set  :use_sudo,      false

# Be more verbose by uncommenting the following line
# logger.level = Logger::MAX_LEVEL
