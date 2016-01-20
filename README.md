# Analog Studios - API Project

Backend API component for Analog Studios 2.0 Redesign

## Install

This project uses Vagrant for local development.  To use it please install

1.  [Vagrant][] >= 1.7.4
2.  [VirtualBox][] >= 5.x and latest available version guest additions (should get prompted during VB installation)
3. Add this entry to your hosts file
```
127.0.0.1       local.analogstudios.thegreenhouse.io
```

4. Add the [EditorConfig][] plugin to your IDE

[phing]: https://www.phing.info/
[composer]: https://getcomposer.org/
[EditorConfig]: http://editorconfig.org/
[php]: http://php.net/
[Vagrant]: https://www.vagrantup.com/
[VirtualBox]: https://www.virtualbox.org/

## Project Layout

- *ini/* - tracked and un-tracked environment based configuration files
- *bin/* - executable scripts for Jenkins, Vagrant, etc
- *sql/* - sql backups
- *src/* - application code
- *src/resources/* - available collections to map to endpoints
- *src/routes/* - map of endpoints to resources
- *src/services/* - helper / utitlity functions, classes not mapped to collectionsgit
- *tests/* - unit and integration tests organized to match the _src_ direectory

## Vagrant
1. Start Vagrant `vagrant up`
2. ssh into the box `vagrant ssh`
3. move to the project root `cd /vagrant`

## Build
*make sure you have ini/config-local.ini file*

1. local build `phing build -D buildDir=/home/vagrant/build`

2. production build `phing build`

You can test from the VM using cURL
`curl localhost/api/events`

Or from the browser in your host machine
`local.analogstudios.thegreenhouse.io:4567/api/events`

### Testing
PHPunit is used for unit testing
`phing test`

## Environment Configuration / Deploying

### App Deployment
The application expects the following files to be deployed to the webroot
* as-api.phar
* .htaccess
* controller.php

### App Config (ini)
`config-bootstrap.ini` contains the initial configuration needed for the application, and should be deployed in the
webroot, configured accordingly, and renamed to `config.ini`.  (This is done automatically when developing locally)
- _env_config_ini_path_  - path to env config for application.


*It is highly recommended that the config-{env}.ini file be located outside the webroot*

### Env Config (ini)
`config-env.ini` path should be configured in `config-bootrap.ini` (see above).  When deployed, the file should be
renamed to `config-env.ini`  (This is done automatically when developing locally)

*Note:* The actual environment specific ini files are not tracked in version control

- _db.host_ - the hostname for the database (i.e. localhost, 127.0.0.1)
- _db.name_ - name of the database for the application
- _db.user_ - the user to connect to the DB as
- _db.password_ - the password for the db user
- _runtime.displayErrors_ - display runtime errors or not (i.e. on or off)
- _session.domain_ - the domain the app is running under (i.e. www.analogstudios.net)

**note: SENSITIVE CREDENTIALS SHOULD NOT BE COMMITTED TO THE REPO!  DB BACKUPS ARE ONLY FOR LOCAL TESTING, RDS SHOULD
PRESERVE ALL BACKUPS***

## Database
The application database is hosted in AWS [RDS].  All the relevant _sql_ backup and patch files are included in the
_src/sql_ directory.  For each release, an incremented sql file is expected such that it can be run on the prod database
for when a schema change is made.  When a release happens, the current production database should be backed (primary
to keep the Vagrant created test databases current with production).

**note: SENSITIVE CREDENTIALS SHOULD NOT BE COMMITTED TO THE REPO!  DB BACKUPS ARE ONLY FOR LOCAL TESTING, RDS SHOULD
PRESERVE ALL BACKUPS***

[RDS]: https://aws.amazon.com/rds/