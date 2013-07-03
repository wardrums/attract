# Attract 1.0
Attract was developed during the production of [Tears of Steel](http://www.tearsofsteel.org/) and since then has been slowly improving to serve as a decent GTD application for CG/VFX movie makers. With Attract you can keep track of the shots of your production, group them in scenes, assign them to users and generate some useful stats about how many seconds of the film are complete or in progress.

## Requirements
In order to use and install Attract you need to satisfy some basic requirements:

* Apache server
* PHP 5.1
* MySQL

## Install and Configure
Set the Apache DocumentRoot to the folder containing attract (the folder where this readme file is).
Once this is done visit the localhost domain with the browser, and get informed that Attract is not installed (missing db.php file). Click on the link go get redirected to the install page. In order to install Attract successfully you should have a database called `attract` in you MySQL.

## First steps
When starting with a new project there are a couple of thing to keep in mind. Click on the Manage button and do the following operations:

* Create a user, otherwise the shots will be assigned to None
* Create a scene, otherwise the creation of shots will not be possible
* Create a shot
* Authors and Contributors

Attract was originally developed by Francesco Siddi ([@fsiddi](https://github.com/fsiddi)). Any contributor willing to help out and improve the software is welcome!

## Licensing
Attract is release under the [GPL2](http://www.gnu.org/licenses/gpl-2.0.txt) License. You are welcome to write about any use case.

## Support or Contact
Having trouble with Attract? Check out the issue tracker on GitHub for old issues, but please do not report new issues. This version of Attract is no longer maintained and a new, better version is being developed on the same repository.

For more info visit the [attract-app.org](http://attract-app.org/) website.
