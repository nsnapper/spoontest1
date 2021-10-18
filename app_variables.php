<?php

// This is an environment variable in the Apache config file to set
// the root.  This keeps the source code from changing.
//
// $app_root_dir = ''; // Production root
// $app_root_dir = '/~bill/spoontest'; // Bill Devel Server
$app_root_dir = getenv("SPOONTIQUES_APP_ROOT");

// $storage_file_dir_path - is the file system's root path to the external
//    storate system.  For example, /mnt/storage/spoontiques represents a
//    file store mounted to the "/mnt/storage" space in the file system.
//    This is used for file manipulation (i.e. upload, delete, etc)
$storage_file_dir_path = getenv("EXT_STORAGE_ROOT_PATH");

// $storage_web_app_root - is the file system path to the root of where 
//  uploaded files reside.  This includes PDFs, JPGs, PNGs, etc.  All files
//  that are dynamic in nature related to products and catalogs and other
//  documents.  This is the root used in "<img src=.../>" view pages and
//  NOT the upload path.  These COULD be the same but the distinction is
//  made for flexibility in the app server.
//
// Example: "/ddocs" would represent a URL root relative location where the
//        Dynamic Docs are stored in external storage.
//
// NOTE: This SHOULD NOT include website collateral images used for logos,
//    headings, buttons, etc.  Those SHOULD be stored in the git repo.
//
$storage_web_app_root = getenv('STORAGE_WEB_APP_ROOT');

// This is the path where the PDF files and thumbnail images live under
// the external storage root directory
// $pdf_file_dir_path = "pages/pdfs/docs";
$pdf_file_dir_path = "pdf_catalogs";

// Example Usages:
//
// Displaying an Image or link to a PDF - this would be web page relative 
// image access
// <img src="$storage_web_app_root/$pdf_file_dir_path/Accessories.jpg" />
//
// <a href="$storage_web_app_root/$pdf_file_dir_path/Accessories.pdf">Accessories</a>
//
// Uploading a file to /mnt/storage/spoontiques/ddocs/pages/pdfs/docs
// move_uploaded_file($pdf_image_temp,"$storage_file_dir_path/$storage_web_app_root/$pdf_file_dir_path/$pdf_image");
// where:
//  $storage_file_dir_path = /mnt/storage/spoontiques
//  $storage_web_app_root = /ddocs
//  $pdf_file_dir_path = pages/pdfs/docs
//  $pdf_image - this could be Accessories.pdf

// Path to the CMS Images residing in external storage under ddocs. If
// $storage_web_app_root = /ddocs then the $cms_images would be:
// /ddocs/cms_images
$cms_images = "$app_root_dir/$storage_web_app_root/cms_images";

// Path to pass to the move_uploaded_file PHP function to upload a file to the
// cms_images folder in external storage.
$cms_images_upload = "$storage_file_dir_path/$storage_web_app_root/cms_images";

const DEBUG_LEVEL = 0;
const INFO_LEVEL = 1;
const WARN_LEVEL = 2;
const ERROR_LEVEL = 3;

$log_level = INFO_LEVEL;

?>
