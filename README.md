Sqwiki's goal is to be the easiest wiki software in the world to use.

You can find the source code on [GitHub](http://https://github.com/Dynamictivity/sqwiki)

# Demo
You can access a demo of Sqwiki at [http://sqwiki.dynamictivity.com](http://sqwiki.dynamictivity.com)

# Static Code Analysis
[https://codeclimate.com/github/Dynamictivity/sqwiki](https://codeclimate.com/github/Dynamictivity/sqwiki)

# Features
1. Markdown with a powerful WYSIWYG markup editor
2. HTML which gets [purified](http://htmlpurifier.org/)
3. Themeable with [jQueryUI](https://jqueryui.com/)
4. Moderation Queue
5. Access Levels (Admin/Member/Editor/Banned)
6. Protected pages based on role level (Admin, Editor, Member, Public)
7. Talk pages
8. Diff (Difference) viewing

Here is an example of the diff view:
![](https://dl.dropboxusercontent.com/u/5765310/Screen%20Shot%202016-06-02%20at%202.10.25%20PM.png)

# Todo
- [http://gitlab.dynamictivity.com/sqwiki/sqwiki/issues](http://gitlab.dynamictivity.com/sqwiki/sqwiki/issues)

# Quick deployment instructions
These instructions will get you up and running quickly.

## Inside a VM
[Vagrant](https://www.vagrantup.com/) and [Virtualbox](https://www.virtualbox.org/wiki/Downloads) installations are required before you perform these steps.

1. `# git clone https://github.com/Dynamictivity/sqwiki.git` -- Clone the source-code repository
2. `# cd sqwiki` -- Change directory into the sqwiki source
3. `# vagrant up` -- Bring up the Vagrant dev environment
4. `# vagrant ssh` -- Login to the Vagrant dev environment
5. `# cd /vagrant` -- Change into the work tree
6. `# ./init-docker` -- Bring up the application docker container cluster

## Docker
A [Docker](http://https://www.docker.com/) and [Docker Compose](https://docs.docker.com/compose/install/) installations are required for these steps.
1. `# mkdir sqwiki`
2. `# wget https://raw.githubusercontent.com/Dynamictivity/sqwiki/master/docker-compose.yml`
3. `# docker-compose up`

## Configuration
Simply modify the `docker-compose.yml` with your desired settings, here is an example:
```
    environment:
      SQWIKI_TITLE: 'Sqwiki'
      SQWIKI_SLOGAN: 'the squeaky clean wiki'
      SQWIKI_AUTO_ACTIVATE_PENDING_REVISIONS: 'true'
      SQWIKI_ALLOW_USER_THEME_SWITCHING: 'true'
      SQWIKI_ENABLE_ACCOUNT_REGISTRATION=true
      SQWIKI_DEFAULT_THEME: 'redmond'
      SQWIKI_GOOGLE_ANALYTICS_ID: 'UA-5187184-27'
      SQWIKI_URL: 'http://sqwiki.io'
      SQWIKI_DEBUG_LEVEL: '2'
      SQWIKI_EMAIL_TRANSPORT: 'debug'
      SQWIKI_ADMIN_EMAIL: 'support@dynamictivity.com'
      SQWIKI_ADMIN_EMAIL_HOST: 'mail.dynamictivity.com'
      SQWIKI_ADMIN_EMAIL_PORT: '465'
      SQWIKI_ADMIN_EMAIL_TLS: 'true'
      SQWIKI_ADMIN_EMAIL_PASSWORD: 'password'
      SQWIKI_OWNER_EMAIL: 'sock.puppet@dynamictivity.com'
      SQWIKI_OWNER_USERNAME: 'sockpuppet'
      SQWIKI_DATABASE_HOST: 'mysql'
      SQWIKI_DATABASE_USERNAME: 'root'
      SQWIKI_DATABASE_PASSWORD: 'sqwiki'
      SQWIKI_DATABASE_DATABASE: 'sqwiki'
      SQWIKI_DATABASE_PREFIX: ''
```

# Development Instructions
These instructions will allow you to make live updates to the files without having to rebuild the docker container.

1. `# vagrant up` -- Bring up the Vagrant dev environment
2. `# vagrant ssh` -- Login to the Vagrant dev environment
3. `# cd /vagrant` -- Change into the work tree
4. `# composer install` -- Install required packages
5. `# ./init-docker-dev.sh` -- Bring up the application docker container cluster
6. `# sudo ./sync.sh` -- Sync the changed files to the running docker container
    * _NOTE:_ You must do this every time you make changes to the files and you don't even need to restart the docker container
