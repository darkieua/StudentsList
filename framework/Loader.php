<?php

/*
 * Loader Class
 * Used to autoload classes from application and framework folders
 */

namespace framework;

class Loader
{
    /**
     * Used to register realization of __autoload method
     */
    public function autoload () {
        spl_autoload_register( function($name) {
            $file = '../' . $name . '.php';
            if (is_file($file)) {
                include $file;
            }
        });
    }
}