<?php

/*
 * Config Parser Class
 * This class is used to work with application configuration file, contained in 'app/config/config.json'
 */

namespace framework;


class ConfigParser
{
    /** @var string Content of config file in string format */
    private $configFile;

    /**
     * ConfigParser constructor.
     */
    function __construct()
    {
        $this->configFile = file_get_contents('../app/config/config.json');
    }

    /**
     * @return array
     */
    public function getConfigArray() {
        return json_decode($this->configFile, true);
    }
}