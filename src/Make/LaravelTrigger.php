<?php

namespace DtechLarCLI\CLI\Make;

use DtechLarCLI\CLI\Handler\LaravelHandler;

/**
 * Class LaravelTrigger
 * @package DtechLarCLI\CLI\Make
 */
class LaravelTrigger
{
    /**
     * Contain LaravelHandler instance Object
     *
     * @var LaravelHandler
     */
    private $handle;

    /**
     * Base folder for application
     *
     * @var string
     */
    private $baseFolder = 'database/migrations/';

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->handle = new LaravelHandler();
    }

    /**
     * Create file
     *
     * @param $name
     */
    public function create($name, $table=null)
    {
        $this->handle->make('trigger', $this->baseFolder . $name, $table);
    }
}
