<?php
/**
	Template Name: getjson
*/

$lang =  qtranxf_getLanguage();
$data = file_get_contents(get_site_url()."/wp-content/export/hatecrimes.".$lang.".js");
header('Content-Type: application/json');
echo $data;

?>