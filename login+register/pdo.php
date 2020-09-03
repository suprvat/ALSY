<?php

try {
   $pdo = new PDO('mysql:host=localhost;dbname=olx', 
   'root', 'root');
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $ex ) { 
   echo("Internal error, please contact support");
   error_log("pdo.php, SQL error=".$ex->getMessage());
   return;
}
