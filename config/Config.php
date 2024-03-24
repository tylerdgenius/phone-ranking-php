<?php 

// General constants
define("APP_ROOT", dirname(dirname(__FILE__)) . "/");
define("API_ROOT", dirname(dirname(__FILE__)) . "/api/");

// Client based constants
define("CLIENT", dirname(dirname(__FILE__)) . "/app/");
define("CLIENT_COMMON_FILES", dirname(dirname(__FILE__)) . "/app/Views/Common/");
define("CLIENT_HELPERS", dirname(dirname(__FILE__)) . "/app/Helpers/");
define("CLIENT_LIBRARIES",  dirname(dirname(__FILE__)) . "/app/Libraries/");
define("CLIENT_PAGES", dirname(dirname(__FILE__)) . "/app/Views/Pages/");
define("CLIENT_VIEW_RESOURCES", dirname(dirname(__FILE__)) . "/app/Resources/");
define("CLIENT_CONTROLLERS", dirname(dirname(__FILE__)) . "/app/Controllers/");
define("CLIENT_LAYOUT", dirname(dirname(__FILE__)) . "/app/Layout/");
define("PUBLIC_FOLDER", dirname(dirname(__FILE__)) . '/public/');

// Api based constants
define("API", dirname(dirname(__FILE__)) . "/api/app/");
define("API_CONTROLLERS", dirname(dirname(__FILE__)) . "/api/app/Controllers/");
define("API_HELPERS", dirname(dirname(__FILE__)) . "/api/app/Helpers/");
define("API_INTERFACES", dirname(dirname(__FILE__)) . "/api/app/Interfaces/");
define("API_MODELS", dirname(dirname(__FILE__)) . "/api/app/Models/");

//Public files
define("MAIN_PUBLIC", getcwd() . "/public/");
