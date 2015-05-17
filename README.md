# Analog Studios - API Project

Backend API component for Analog Studios 2.0 Redesign

## Install

1. Make sure you have [phing][], php >= 5.xx and [composer][] installed. Then,
```
XXX
```
XXX
2. Add this entry to your hosts file
```
127.0.0.1       local.api.analogstuios.thegreenhouse.io
```
3. Add the [EditorConfig][] plugin to your IDE

[phing]: https://www.phing.info/
[composer]: https://getcomposer.org/
[EditorConfig]: http://editorconfig.org/

## Build

//XXX TODO find link to reason why
To build locally use `phing build -D buildDir=/home/vagrant/build`

## Project Layout

- *ini/* - un-tracked environment based configuration files
- *sh/* - shell scripts for Jenkins, Vagrant, etc
- *sql/* - sql backups
- *src/* - application code
- *src/base/* - abstract classes and interfaces
- *src/core/* - concrete
- *src/resources/* - top level site pages and their static assets (JS, CSS, .html); implements angular controllers
- *src/routes/* - API services and non-UI components; implements angular services
- *tests/* - unit / integration tests

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
add to vagrant file for phar support

1. `sudo vim /etc/php5/apache2/php.ini`  //phar.readOnly

2. `sudo vim /etc/php5/cli/php.ini`  //phar.readOnly

3. `sudo /etc/init.d/apache2 restart`
