<?php

require 'database.php';

try {
        // Connect to Mysql server
        $bdd = new PDO($DB_DSN_LIGHT, $DB_USER, $DB_PASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE IF NOT EXISTS `camagru`";
        $bdd->exec($sql);
        // echo "Database created successfully\n";
    } catch (PDOException $e) {
        echo "ERROR CREATING DB: \n".$e->getMessage()."\nAborting process\n";
        // exit(-1);
    }

try {
        // Connect to DATABASE previously created
        $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE IF NOT EXISTS `users` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `pseudo` varchar(20) DEFAULT NULL,
          `password` varchar(40) NOT NULL,
          `email` varchar(255) NOT NULL,
          `cle` varchar(255) DEFAULT NULL,
          `actif` varchar(4) DEFAULT NULL,
          PRIMARY KEY (id)
        )";
        $bdd->exec($sql);
        // echo "Table users created successfully\n";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
    }

?>
