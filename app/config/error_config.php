<?php
// ERROR REPORTING LOGS | CHECK "PUBLIC" FOLDER FOR ERROR LOGS
error_reporting(E_ALL);
ini_set("display_errors", 0);

function errorHandler($errno, $errstr, $errfile, $errline)
{
   $message = "[".date("Y-M-d H:ia") . "] Error: [$errno] $errstr ->> $errfile on line $errline". PHP_EOL . "--------------------------------------------------------------------------------------------------------";
   error_log($message . PHP_EOL, 3, "error_log.txt");
   $file = fopen("error_log.txt", "a") or die("Unable to create file");
   fclose($file);
}

set_error_handler("errorHandler");
