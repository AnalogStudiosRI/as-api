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

## Deploying

The application expects that the .phar file, .htaccess, and controller.php to be in the webroot.  It is highly recommended
that the config-{env}.ini file be located outside the webroot, for this reason the path is fixed to be one level up.
It should also be called `config.ini`


## TODO
add to vagrant file for phar support

1. `sudo vim /etc/php5/apache2/php.ini`  //phar.readOnly

2. `sudo vim /etc/php5/cli/php.ini`  //phar.readOnly

3. `sudo /etc/init.d/apache2 restart`
