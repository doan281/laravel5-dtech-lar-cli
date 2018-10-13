<?php

use DtechLarCLI\CLI\Make\LaravelModel;
use DtechLarCLI\CLI\Clear\Clear;

if (isset($_SERVER["argv"][1])) {
    $code = explode(':', $_SERVER["argv"][1]);

    if (count($code) == 2) {
        $instance = null;
        $classAction = null;

        switch ($code[0]) {
            case 'make':
                switch ($code[1]) {
                    case 'controller':
                        //$instance = new Controller();
                        $classAction = "Controller";

                        break;
                    case 'model':
                        $instance = new LaravelModel();
                        $classAction = "Model";

                        break;

                    default:
                        echo $code[1] . " not defined! \n";
                        die();
                }

                if (!empty($_SERVER['argv'][2])) {
                    $instance->create($_SERVER['argv'][2]);

                    echo "Create sucsessfully " . $classAction . ": {$_SERVER['argv'][2]}\n";

                    die();
                } else {
                    echo "Error, Missing name...n";
                }

                break;
            case 'clear' :
                switch ($code[1]) {
                    case 'cache':
                        $instance = new Clear();

                        break;
                    default:
                        echo "Missing module to clear \n";
                        die();
                }

                $instance->clear('application/cache/');

                break;

            default:
                echo "Error: Action unsuport!\n";
                die();

        }
    } else {
        echo "make:controller \t Create controller \n make:model \t\t Create model \n make:eloquent \t\t Create model extends eloquent \n make:helper \t\t Create helper \n make:library \t\t Create library";
    }
}

echo "\n";