<?php

namespace DtechLarCLI\CLI\Make;

use DtechLarCLI\CLI\Handler\LaravelHandler;

/**
 * Class LaravelModel
 * @package DtechLarCLI\CLI\Make
 */
class LaravelModel
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
    private $baseFolder = 'app/Models/';

    /**
     * Model constructor.
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
    public function create($name)
    {
        $this->handle->make('model', $this->baseFolder . $name);
    }
}
