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

## Local Development
For the most part, you will just need to write code and then write tests for it, which can be done with
`phing develop`

For testing against the full build, see the next section

## Build
1. local build (no linting, docs, tests)

```
$ phing build-local -D buildDir=/home/vagrant/build && cp src/.htaccess /home/vagrant/build/
```

2. production build 

```
$ phing build
```

You can test from the VM using cURL
`curl localhost/api/events`

Or the browser / POSTman against your host machine
`localhost:4567/api/events`

## API Documenation
To generate API documentation run
`$ phing clean`
`$ phing docs`

and open _{path/to/repo/in/your/filesystem}/reports/docs/index.html_ in your browser

## Testing
PHPunit is used for unit testing
`phing test`

To see code coverage, open _{path/to/repo/in/your/filesystem}/reports/coverage_result/index.html_ in your browser

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

## Creating a new resource / endpoint (/events, /artists, etc )
1. Copy paste an existing resource (like Artists)
2. Update $name, $tableName, $requiredParams, $updateParams, $optionalParams  
3. Update method params (getFoo, getFooById, etc)
4. Add new case in src/resources/ResfulResourceBuilder
5. Copy paste an existing test (like Artists in tests/resources) and update for all CRUD operations
6. Test each CRUD operation one at a time using `phing test`
7. Add resource name to $resources array
8. Add a "route" case in controller.php
9. Create a route file in /routes, to match your resource name and route case
10. Test all endpoints in POSTman