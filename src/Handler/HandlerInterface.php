<?php

namespace Dtech\LaravelCLI\Handler;

interface HandlerInterface
{
    public function readData($fileName);

    public function handleData($data);

    public function bindData($path, $data);
}