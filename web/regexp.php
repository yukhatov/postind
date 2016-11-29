<?php
/**
 * Created by PhpStorm.
 * User: artur
 * Date: 29.11.16
 * Time: 13:10
 */

$names = getNamesFromDir(__DIR__ . '/datafiles');

echo "<pre>";
print_r($names);

/**
 * @param $dir
 * @return array
 */
function getNamesFromDir($dir){
    $names = array();

    foreach (new DirectoryIterator($dir) as $file) {
        if ($file->isFile() and preg_match('/[0-9 a-z A-Z]*.txt/', $file->getFilename())) {
            $names[] = $file->getFilename();
        }
    }

    sort($names);

    return $names;
}
