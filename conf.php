<?php
$settings = array();

// Please sort critical and non critical settings in ascending order
// All new vars should be added like this:
// $settings['varName'] = value

// Critical settings
$settings['dataFileName'] = "job.json"; // name of the JSON file

// Non-critical settings
$settings['allowOneTimeImport'] = true; // allow importing media from a link only once. (Frequency = -1)
$settings['allowConstantRefresh'] = true; // allow the the imported media to be rechecked every time the script is run. (Frequency = 0)
$settings['maxRefreshTime'] = 744; // maximum amount of time (in hours) allowed to delay a refresh for.
?>
