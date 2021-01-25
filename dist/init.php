<?php 

    /**
     * autoload all classes
     * ***** the files name must be the same name of class
     */
    spl_autoload_register(function ($class) {

        require "classes/" . $class . ".php";

    });

    /**
     * routes
     * 
     */

    // dir
    define("root", __DIR__);

    // layout
    define("layout", "layout/");
    
    // components
    define("components", "components/");

    // templates
    define("templates", "templates/");

    // uploads
    define("uploads", "uploads/");

    // functions
    define("functions", "functions/");

    /**
     * includes all functions form functions directory
     * v1.0.0
     */
    
    $functions = glob(functions . "*.php", GLOB_BRACE);

    foreach($functions as $func) {

        require_once $func;

    }

    require_once templates . "head.php";

?>