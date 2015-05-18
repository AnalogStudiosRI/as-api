# Analog Studios - API Project

Backend API component for Analog Studios 2.0 Redesign

## Install

This project uses Vagrant for local development.  To use it please install

1.  [Vagrant][]

2.  [VirtualMachine][]

3. Add this entry to your hosts file
```
127.0.0.1       local.analogstuios.thegreenhouse.io
```

4. Add the [EditorConfig][] plugin to your IDE

[phing]: https://www.phing.info/
[composer]: https://getcomposer.org/
[EditorConfig]: http://editorconfig.org/
[php]: http://php.net/
[Vagrant]: https://www.vagrantup.com/
[VirtualMachine]: https://www.virtualbox.org/

## Project Layout

- *ini/* - tracked and un-tracked environment based configuration files
- *sh/* - shell scripts for Jenkins, Vagrant, etc
- *sql/* - sql backups
- *src/* - application code
- *src/base/* - abstract classes and interfaces
- *src/config/* - config class
- *src/dao/* - data access class
- *src/resources/* - top level site pages and their static assets (JS, CSS, .html); implements angular controllers
- *src/routes/* - API services and non-UI components; implements angular services
- *tests/* - unit / integration tests

## Development / Building
### Start Vagrant
1. Start Vagrant `vagrant up`

### Development
The build tool for this project is Phing.

1. ssh into the box `vagrant ssh`

2. move to the project root `cd /vagrant`

### Build
1. local build `phing build -D buildDir=/home/vagrant/build`

2. production build `phing build`

You can test from the VM using cURL
`curl localhost/api/events`

Or from the browser in your host machine
`local.analogstuios.thegreenhouse.io:4567/api/events`

### Testing
PHPunit is used for unit testing
`phing test`

## Environment Configuration / Deploying

### App Deployment
The application expects that the as-api.phar, .htaccess, controller.php to be deployed in the webroot.

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

## TODO
[AS-105][]

[AS-105]: https://thegreenhouse.atlassian.net/browse/AS-105