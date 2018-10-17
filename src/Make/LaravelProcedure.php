<?php

namespace DtechLarCLI\CLI\Make;

use DtechLarCLI\CLI\Handler\LaravelHandler;

/**
 * Class LaravelProcedure
 * @package DtechLarCLI\CLI\Make
 */
class LaravelProcedure
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
    public function create($name)
    {
        $this->handle->make('procedure', $this->baseFolder . $name);
    }
}
