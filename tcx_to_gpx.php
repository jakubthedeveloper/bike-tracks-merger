<?php

require('./vendor/autoload.php');

$handle = opendir('tcx/fixed');
while (false !== ($fileName = readdir($handle))) {
    $outPath = 'gpx/converted_from_tcx_' . substr($fileName, 0, -4) . '.gpx';
    if (substr($fileName, -4) === '.tcx' && !file_exists($outPath)) {
        $parser = new \Waddle\Parsers\TCXParser();
        $activity = $parser->parse("tcx/fixed/{$fileName}");

        $track = new \phpGPX\Models\Track();
        $segment = new \phpGPX\Models\Segment();
        $segment->points = [];
        foreach ($activity->getLaps() as $lap) {
            /** @var \Waddle\TrackPoint $trackPoint */
            foreach ($lap->getTrackPoints() as $trackPoint) {
                $point = new \phpGPX\Models\Point(\phpGPX\Models\Point::TRACKPOINT);
                $point->latitude = $trackPoint->getPosition('lat');
                $point->longitude = $trackPoint->getPosition('lon');
                $point->time = new DateTime($trackPoint->getTime(DATE_ATOM));

                $segment->points[] = $point;
            }

            $track->segments[] = $segment;
        }

        $gpx_file = new \phpGPX\Models\GpxFile();
        $gpx_file->tracks[] = $track;
        $gpx_file->save($outPath, \phpGPX\phpGPX::XML_FORMAT);
    }
}