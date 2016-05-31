## Quick-Start
1. `# vagrant up` -- Bring up the Vagrant dev environment
2. `# vagrant ssh` -- Login to the Vagrant dev environment
3. `# cd /vagrant` -- Change into the work tree
4. `# ./init-docker` -- Bring up the application docker container cluster
5. `# ./sync.sh` -- Sync the changed files to the running docker container
    * _NOTE:_ You can do this every time you make changes to the files and you don't even need to restart the docker container

## Notes
- Admin password will be displayed in the docker log right after you bring up the cluster, it is also stored in the following location inside the running docker container: `/app/tmp/admin-password`
- It is recommended that you change the admin password after you first login and use a stronger password

## TODO
1. Implement parsedown (https://github.com/erusev/parsedown)
