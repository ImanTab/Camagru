<?php
include 'database.php';
// DROP DATABASE
try {
        $bdd = new PDO($DB_DSN_LIGHT, $DB_USER, $DB_PASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DROP DATABASE `".$DB_NAME."`";
        $bdd->exec($sql);
        echo "Database droped successfully\n";
    } catch (PDOException $e) {
        echo "ERROR DROPING DB: \n".$e->getMessage()."\n";
    }
?>
