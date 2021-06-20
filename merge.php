<?php
require('./vendor/autoload.php');

use phpGPX\phpGPX;

$gpx = new phpGPX();

// Creating sample link object for metadata
$link = new \phpGPX\Models\Link();
$link->href = "https://sibyx.github.io/phpgpx";
$link->text = 'phpGPX Docs';

// GpxFile contains data and handles serialization of objects
$gpx_file = new \phpGPX\Models\GpxFile();

// Creating sample Metadata object
$gpx_file->metadata = new \phpGPX\Models\Metadata();

// Time attribute is always \DateTime object!
$gpx_file->metadata->time = new \DateTime();

// Description of GPX file
$gpx_file->metadata->description = "My pretty awesome GPX file, created using phpGPX library!";

// Adding link created before to links array of metadata
// Metadata of GPX file can contain more than one link
$gpx_file->metadata->links[] = $link;

$handle = opendir('gpx');
while (false !== ($fileName = readdir($handle))) {
    if (substr($fileName, -4) === '.gpx') {
        $file = $gpx->load('gpx/' . $fileName);

        echo $fileName . ": " . count($file->tracks) . "\n";

        foreach ($file->tracks as $track) {
            $gpx_file->tracks[] = $track;
        }
    }
}

// GPX output
$gpx_file->save('out/merged.gpx', \phpGPX\phpGPX::XML_FORMAT);