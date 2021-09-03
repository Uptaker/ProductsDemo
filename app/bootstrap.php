<?php

// Load config
require_once('config/config.php');

// Load the libraries, replaced by autoload (see below)
// require_once('libraries/Core.php');
// require_once('libraries/Controller.php');
// require_once('libraries/Database.php');

// Autoload core libraries
spl_autoload_register(function ($className) {
    require_once('libraries/' . $className . '.php');
});

// Load Helpers
require_once('helpers/url_helper.php');
