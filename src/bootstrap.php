<?php

use DtechLarCLI\CLI\Make\LaravelController;
use DtechLarCLI\CLI\Make\LaravelModel;
use DtechLarCLI\CLI\Make\LaravelRepository;
use DtechLarCLI\CLI\Make\LaravelRequest;
use DtechLarCLI\CLI\Make\LaravelScope;
use DtechLarCLI\CLI\Make\LaravelTrait;
use DtechLarCLI\CLI\Clear\Clear;

/**
 * Make model:
 * php dtech make:model Product (create file app/Models/Product.php)
 * php dtech make:model UserPermission (create file app/Models/UserPermission.php)
 * php dtech make:model Admin/User (create file app/Models/Admin/User.php)
 * ---------------------------------------------------------------------------------------------------------------------
 * Make controller:
 * php dtech make:controller Product (create file app/Http/Controllers/ProductController.php)
 *
 */
if (isset($_SERVER["argv"][1])) {
    $code = explode(':', $_SERVER["argv"][1]);

    if (count($code) == 2) {
        $instance = null;
        $classAction = null;

        switch ($code[0]) {
            case 'make':
                switch ($code[1]) {
                    case 'controller':
                        $instance = new LaravelController();
                        break;
                    case 'model':
                        $instance = new LaravelModel();
                        break;
                    case 'repository':
                        $instance = new LaravelRepository();
                        break;
                    case 'request':
                        $instance = new LaravelRequest();
                        break;
                    case 'scope':
                        $instance = new LaravelScope();
                        break;
                    case 'trait':
                        $instance = new LaravelTrait();
                        break;

                    default:
                        echo $code[1] . " not defined! \n";
                        die();
                }

                $classAction = ucfirst($code[1]);

                if (!empty($_SERVER['argv'][2])) {
                    if (! in_array(null, explode('/', $_SERVER['argv'][2]))) {
                        $instance->create($_SERVER['argv'][2]);
                        echo "Create sucsessfully " . $classAction . ": {$_SERVER['argv'][2]}\n";
                    } else {
                        echo $classAction . ' name (or ' . $classAction . ' path name) is invalid.' . "\n";
                    }

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
        $cmd = "make:controller \t Create controller in folder app/Http/Controllers/ \n" .
            "make:model \t\t Create model in folder app/Models/ \n" .
            "make:repository \t Create repository in folder app/Repositories/ \n" .
            "make:request \t\t Create request in folder app/Htpp/Requests/ \n" .
            "make:scope \t\t Create scope in folder app/Scopes/ \n" .
            "make:trait \t\t Create trait in folder app/Traits/";
        echo $cmd;
    }
}

echo "\n";