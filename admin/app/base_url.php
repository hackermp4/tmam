<?php
$subdir = 'tmam/';
$base_url = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == 'on' ? 'https://' . $_SERVER["HTTP_HOST"] . '/' . $subdir : 'http://' . $_SERVER["HTTP_HOST"] . '/' .$subdir;

define('SITE_URL', $base_url );
