<?php

use Dtech\LaravelCLI\Make\LaravelController;
use Dtech\LaravelCLI\Make\LaravelModel;
use Dtech\LaravelCLI\Make\LaravelRepository;
use Dtech\LaravelCLI\Make\LaravelRequest;
use Dtech\LaravelCLI\Make\LaravelTrait;
use Dtech\LaravelCLI\Clear\Clear;

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
                        $classAction = "Controller";
                        break;
                    case 'model':
                        $instance = new LaravelModel();
                        $classAction = "Model";
                        break;
                    case 'repository':
                        $instance = new LaravelRepository();
                        $classAction = "Repository";
                        break;
                    case 'request':
                        $instance = new LaravelRequest();
                        $classAction = "Request";
                        break;
                    case 'trait':
                        $instance = new LaravelTrait();
                        $classAction = "Trait";
                        break;

                    default:
                        echo $code[1] . " not defined! \n";
                        die();
                }

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
        echo "make:controller \t Create controller \n make:model \t\t Create model \n make:eloquent \t\t Create model extends eloquent \n make:helper \t\t Create helper \n make:library \t\t Create library";
    }
}

echo "\n";