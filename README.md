## Quick-Start
1. `# vagrant up` -- Bring up the Vagrant dev environment
2. `# vagrant ssh` -- Login to the Vagrant dev environment
3. `# cd /vagrant` -- Change into the work tree
4. `# docker-compose up -d` -- Bring up the application docker container cluster
5. `# ./init-db.sh` -- Initialize the database
6. `# ./sync.sh` -- Sync the changed files to the running docker container (You can do this every time you make changes to the files and you don't even need to restart the docker container)

## TODO
1. Implement parsedown (https://github.com/erusev/parsedown)