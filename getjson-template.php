<?php
/**
	Template Name: getjson
*/

$lang =  wpm_get_language();
$data = file_get_contents(get_site_url()."/wp-content/export/hatecrimes.".$lang.".js");
header('Content-Type: application/json');
echo $data;

?>