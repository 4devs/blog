server 'vps.4devs.io', :app, :web, :primary => true

set :user,        "4devs"
set :deploy_to,   "/var/www/4devs/blog"
set :branch,      "master"

set :symfony_env_prod, "prod"


# logger.level = Logger::MAX_LEVEL
