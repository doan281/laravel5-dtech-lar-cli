<?php

namespace DtechLarCLI\CLI\Clear;

class Clear implements ClearInterface
{
    public function clear($path)
    {
        if (is_dir($path)) {
            $objects = scandir($path);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($path . "/" . $object) == "dir") {
                        $this->clear($path . "/" . $object);
                    } else {
                        unlink($path . "/" . $object);
                    }
                }
            }
            reset($objects);
        }
    }
}