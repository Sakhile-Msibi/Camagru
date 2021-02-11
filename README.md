## Camagru
<p align="center">
  <img src="./montage/images/camagru.png" width="90%"/>
</p>

The aim of this project is to create a web application that allow users to make basic photo and video editing using a webcam and some predefined images.
Application users should be able to select an image in a list of superposable images, take a picture with his/her webcam and admire the result that should be mixing
both pictures.

## Table of contents
* [General info](#general-info)
* [Technologies](#technologies)
* [Installation](#installation)
* [App structure](#app-structure)

## General info
Camagru is one of the web based project that software engineering trainees do at WeThinkCode_. PHP language must be used to create the server-side, with just
the standard library. Every framework, micro-framework or library that you don’t create are totally
forbidden, except for CSS frameworks that doesn’t need forbidden JavaScript. All forms must have correct validations and the whole website must be secure.

## Technologies
Technologies are used in this project:
* PHP
* JavaScript
* HTML
* CSS
* Windows, Apache, MySQL and PHP (WAMP)

## Installation
To run this project locally, go to WAMP/apache2/htdocs then clone the git repository
```
$ git clone https://github.com/Sakhile-Msibi/Matcha.git
$ cd Matcha
$ npm install
$ npm start
```
Make sure that the correct credentials are written in the files in the config directory to be able to the apache2 web server and MySQL database.

## App structure
* Config - files used to configure the database
    * conn.js
    * database.js
* Public - CSS directory, images directory
* routes
    * block_user.js
    * catfish.js
    * chat.js
    * confirmation.js
    * forgot_password.js
    * home.js
    * index.js
    * loginchecker.js
    * message.js
    * notice.js
    * password_reset.js
    * profile_edit.js
    * profile.js
    * register.js
    * search_user.js
    * signin.js
    * signout.js
    * unblock_user.js
    * user.js
* views
    * chat.ejs
    * footer.js
    * forgot_password.ejs
    * header.ejs
    * home.ejs
    * index.ejs
    * message.ejs
    * notice.ejs
    * password_reset.ejs
    * profile_edit.ejs
    * profile.ejs
    * search_user.ejs
    * signin.ejs
    * user.ejs
* app.js
