<?php

namespace DtechLarCLI\CLI\Handler;

class LaravelHandler implements HandlerInterface
{
    /**
     * Type suported
     *
     * @var array
     */
    private $type = ['controller', 'function', 'model', 'procedure', 'repository', 'request', 'scope', 'trait', 'trigger'];

    /**
     * String suport
     *
     * @var string
     */
    private $stringSuport = 'controller, function, model, procedure, repository, request, scope, trait, trigger';

    /**
     * Read data form template folder
     *
     * @param $pathFilename
     * @return mixed
     * @throws \ErrorException
     */
    public function readData($pathFilename)
    {
        $pathFilename = ucfirst($pathFilename);

        $pathFilename = realpath(__DIR__) . "/../Template/Laravel/{$pathFilename}.template";

        $file = fopen($pathFilename, 'r');

        if ($data = fread($file, filesize($pathFilename))) {
            return str_replace('<\?php', '<?php', $data);
        } else {
            throw new \ErrorException(realpath(__DIR__) . "/../Template/Laravel/{$pathFilename}.template not Found");
        }
    }

    /**
     * Get file
     *
     * @param $data
     * @return mixed
     */
    public function handleData($type, $data)
    {

        if (strpbrk('/', $data) !== false) {
            $folder = $this->getFolder($data);

            $this->createFolder($folder);
        }

        return ucfirst(camel_case($this->getFile($type, $data)));
    }

    /**
     * Bind data into template
     *
     * @param $path
     * @param $data
     * @return mixed
     */
    public function bindData($path, $data, $table=null)
    {
        $datafromRead = $this->readData($path);

        return str_replace(
            [
                '{$class_name}',
                '{$namespace}',
                '{$table_name}',
                '{$store_name}',
                '{$trigger_table}'
            ],
            [
                $this->handleData($path, $data),
                $this->getNamespace($data),
                $this->getTableName($data),
                $this->createStoreName($path, $data),
                (empty($table) ? 'users' : $table)
            ],
            $datafromRead
        );
    }

    /**
     * Make file
     *
     * @param $type
     * @param $name
     * @return bool|int
     */
    public function make($type, $name, $table=null)
    {
        if (!in_array(strtolower($type), $this->type)) {
            echo "{$type} must is {$this->stringSuport}";
            return false;
        }

        $data = $this->bindData($type, $name, $table);

        if (in_array(strtolower($type), ['function', 'model', 'procedure', 'trigger'])) {
            $suffixFilename = '';
            /* 2018_10_18_000809_trigger_before_insert_users */
            if (strtolower($type) != 'model') {
                if (count(explode('/', $name)) == 3) {
                    if (preg_match("/^[a-zA-Z\_\/]+$/", $name)) {
                        $name = $this->createStoreFileName($type, $name);
                    } else {
                        die(ucfirst($type) . " name (a-z, A-Z, _) is invalid!\n");
                    }
                } else {
                    die(ucfirst($type) . " name is invalid! Remove '/' character!\n");
                }
            }
        } else {
            $suffixFilename = ucfirst(strtolower($type));
        }

        $file = @fopen($name . $suffixFilename . '.php', 'w+');

        if ($file) {
            return fwrite($file, $data);

        } else {
            die("permission error!\n");
        }
    }

    /**
     * Get name of file
     *
     * @param $path
     * @return mixed
     */
    private function getFile($type, $path)
    {
        $items = explode('/', $path);

        if (in_array(strtolower($type), ['function', 'procedure', 'trigger'])) {
            return snake_case(strtolower($type) . '_' . trim($items[count($items) - 1]));
        } else {
            return trim($items[count($items) - 1]);
        }
    }

    /**
     * Get folder
     *
     * @param $path
     * @return string
     */
    private function getFolder($path)
    {
        $array = explode('/', $path);
        $array = array_map('trim', $array);
        unset($array[count($array) - 1]);

        return implode('/', $array);
    }

    /**
     * Create folder if folder not exist
     *
     * @param $arrayPath
     * @return bool
     */
    private function createFolder($arrayPath)
    {
        try {
            $items = explode('/', $arrayPath);
            if (count($items) >= 2) {
                /* Create base folder */
                for($i=1; $i < count($items); $i++){
                    $basePath = $items[0];
                    for($j=1; $j <= $i; $j++) {
                        $basePath .= '/' . $items[$j];
                    }
                    if (!is_dir($basePath)) {
                        mkdir($basePath);
                    }
                }

                /* Create sub folder */
                if (!is_dir($arrayPath)) {
                    mkdir($arrayPath);
                }

                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get namespace
     *
     * $data = App/Models/Admin/User
     * @param $data
     * @return string
     */
    private function getNamespace($data)
    {
        $items = explode('/', $data);

        if(count($items) > 0){
            if(count($items) > 1){
                unset($items[count($items) - 1]);
            }

            $namespace = array_map('trim', $items);
            $namespace = array_map('ucfirst', $namespace);

            return implode("\\", $namespace);
        } else {
            return 'App';
        }

    }

    /**
     * Get default table name
     *
     * $data = App/Models/Admin/User
     * @param $data
     * @return string
     */
    private function getTableName($data)
    {
        $items = explode('/', $data);
        $table_name = snake_case($items[count($items) - 1]);

        /*$array_name = explode('_', $table_name);
        if (count($array_name) > 1) {
            return $table_name . '/' . $table_name . 's';
        }*/

        return $table_name .'s';

    }

    /**
     * Get store name in mysql
     *
     * @param $type
     * @param $name
     * @return mixed
     */
    private function createStoreName($type, $name)
    {
        if (in_array(strtolower($type), ['function', 'procedure', 'trigger'])) {
            return $this->getFile($type, $name);
        } else {
            return $type;
        }
    }

    /**
     * Get store file name in database/migrations folder
     *
     * @param $type
     * @param $name
     * @return string
     */
    private function createStoreFileName($type, $name)
    {
        $items = explode('/', $name);

        if (in_array(strtolower($type), ['function', 'procedure', 'trigger'])) {
            return $items[0] . '/' . $items[1] . '/' . date('Y_m_d_His_') . $this->createStoreName($type, $name);
        } else {
            return $type;
        }

    }
}
