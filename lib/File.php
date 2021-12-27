<?php

class File {
    
public static function build_path($path_array) {
    $DS = DIRECTORY_SEPARATOR;
    return __DIR__ . $DS . ".." . $DS . join('/', $path_array);
    }
}


?>
