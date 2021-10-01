<?php

// TODO: Change app_root_dir to come from a server environment variable.
//      This will make it easier to use in dev / production.
// $app_root_dir = ''; // Production root
// $app_root_dir = '/~bill/spoontest'; // Bill Devel Server

// Chose to set an environment variable in the Apache config file to set
// the root.  This keeps the source code from changing.
$app_root_dir = getenv("SPOONTIQUES_APP_ROOT");

$pdf_file_dir_path = "pages/pdfs/docs";
$pdf_file_dir = "$app_root_dir/$pdf_file_dir_path";
?>
