server '4devs.io', :app, :web, :primary => true

set :domain,      "4devs.io"
set :user,        "andrey"
set :deploy_to,   "/var/www/#{domain}"
set :branch,      "develop"

set :symfony_env_prod, "dev"
