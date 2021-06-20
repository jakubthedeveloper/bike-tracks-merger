<?php

$handle = opendir('tcx');
while (false !== ($fileName = readdir($handle))) {
    if (substr($fileName, -4) === '.tcx' && !file_exists('tcx/fixed' . $fileName)) {
        $fc = file_get_contents('tcx/' . $fileName);
        file_put_contents('tcx/fixed/' . $fileName, trim($fc));
    }
}