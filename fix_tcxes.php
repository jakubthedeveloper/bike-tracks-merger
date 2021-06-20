<?php

$handle = opendir('tcx');
while (false !== ($fileName = readdir($handle))) {
    $outFileName = 'tcx/fixed/' . $fileName;
    if (substr($fileName, -4) === '.tcx' && !file_exists($outFileName)) {
        $fc = file_get_contents('tcx/' . $fileName);
        if (!empty($fc)) {
            file_put_contents($outFileName, trim($fc));
        }
    }
}