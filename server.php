<?php

$server_name = $_SERVER['SERVER_NAME'];
echo "Server name:  " . $server_name . "<br />";

$doc_root = $_SERVER['DOCUMENT_ROOT'];
echo "Document root:  " . $doc_root . "<br />";

$path_name = $_SERVER['PATH_NAME'];
echo "Path name:  " . $path_name . "<br />";

$script_name = $_SERVER['SCRIPT_NAME'];
echo "Script name:  " . $script_name . "<br />";

$host = $_SERVER['HTTP_HOST'];
echo "HTTP host:  " . $host . "<br />";

?>