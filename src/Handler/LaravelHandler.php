<?php

namespace DtechLarCLI\CLI\Handler;

class LaravelHandler implements HandlerInterface
{
    /**
     * Type suported
     *
     * @var array
     */
    private $type = ['controller', 'model', 'repository', 'request', 'trait'];

    /**
     * string suport
     * @var string
     */
    private $stringSuport = 'controller, model, repository, request, trait';

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
     * get name of file
     * @param $path
     * @return mixed
     */
    private function getFile($path)
    {
        $items = explode('/', $path);
        return trim($items[count($items) - 1]);
    }

    /**
     * get folder
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
     * create folder if folder not exist
     *
     * @param string $arrayPath
     */
    private function createFolder($arrayPath)
    {
        if (!is_dir($arrayPath)) {
            mkdir($arrayPath);
        }
    }

    /**
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
            $namespace = array_map('strtolower', $namespace);
            $namespace = array_map('ucfirst', $namespace);

            return implode("\\", $namespace);
        } else {
            return 'App';
        }

    }

    /**
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

    public function handleData($data)
    {

        if (strpbrk('/', $data) !== false) {
            $folder = $this->getFolder($data);

            $this->createFolder($folder);
        }

        return $this->getFile($data);
    }

    public function bindData($path, $data)
    {
        $datafromRead = $this->readData($path);

        return str_replace(
            [
                '{$class_name}',
                '{$namespace}',
                '{$table_name}'
            ],
            [
                $this->handleData($data),
                $this->getNamespace($data),
                $this->getTableName($data)
            ],
            $datafromRead
        );
    }

    /**
     * make file
     *
     * @param $type
     * @param $name
     * @return bool|int
     */
    public function make($type, $name)
    {
        if (!in_array(strtolower($type), $this->type)) {
            echo "{$type} must is {$this->stringSuport}";
            return false;
        }
        $data = $this->bindData($type, $name);
        $file = @fopen($name . '.php', 'w+');

        if ($file) {
            return fwrite($file, $data);
        } else {
            die("permission error!\n");
        }

    }

}
