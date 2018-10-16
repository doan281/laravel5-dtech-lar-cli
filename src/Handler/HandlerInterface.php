<?php

namespace DtechLarCLI\CLI\Handler;

interface HandlerInterface
{
    public function readData($fileName);

    public function handleData($type, $data);

    public function bindData($path, $data);
}