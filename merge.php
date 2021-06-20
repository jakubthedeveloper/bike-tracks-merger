<?php
require('./vendor/autoload.php');

use phpGPX\phpGPX;

$gpx = new phpGPX();
$gpxFile = new \phpGPX\Models\GpxFile();
$gpxFile->metadata = new \phpGPX\Models\Metadata();
$gpxFile->metadata->time = new \DateTime();
$gpxFile->metadata->description = "Merged GPXes.";

$totalDistance = 0;

$handle = opendir('gpx');
while (false !== ($fileName = readdir($handle))) {
    if (substr($fileName, -4) === '.gpx') {
        $file = $gpx->load('gpx/' . $fileName);

        echo "Merging {$fileName}\n";

        foreach ($file->tracks as $track) {
            $track->recalculateStats();
            $totalDistance += $track->stats->distance;
            $gpxFile->tracks[] = $track;
        }
    }
}

// GPX output
$gpxFile->save('out/merged.gpx', \phpGPX\phpGPX::XML_FORMAT);

echo "Total distance: " . number_format($totalDistance / 1000, 2) . "km\n";
