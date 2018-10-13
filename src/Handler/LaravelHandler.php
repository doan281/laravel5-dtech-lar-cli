<?php

namespace DtechLarCLI\CLI\Handler;

class LaravelHandler implements HandlerInterface
{
    /**
     * Type suported
     *
     * @var array
     */
    private $type = ['controller', 'model'];

    /**
     * string suport
     * @var string
     */
    private $stringSuport = 'controller, model';

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
        return (explode('/', $path))[count(explode('/', $path)) - 1];
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

        return str_replace('{$name}', $this->handleData($data), $datafromRead);
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
