<?php

namespace DtechLarCLI\CLI\Make;

use DtechLarCLI\CLI\Handler\LaravelHandler;

/**
 * Class LaravelRepository
 * @package DtechLarCLI\CLI\Make
 */
class LaravelRepository
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
    private $baseFolder = 'app/Repositories/';

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
    public function create($name)
    {
        $this->handle->make('repository', $this->baseFolder . $name);
    }
}
