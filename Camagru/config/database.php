<?php
require_once 'setup.php';

try
{
  $DB_NAME = "camagru";
  $DB_DSN = "mysql:host=localhost;dbname=".$DB_NAME;
  $DB_DSN_LIGHT = "mysql:host=localhost";
  $DB_USER = "root";
  $DB_PASSWORD = "";

}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}


?>
