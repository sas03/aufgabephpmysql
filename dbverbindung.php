<?php
/**
 * Created by Atom.
 * User: sumo stephane
 * Date: 16/09/2019
 * Time: 17:30
 */
?>

<?php
//session_start();
error_reporting(E_ALL);
ini_set('display_errors',1);
//Database Verbindung
$dsn = 'mysql:dbname=aufgabe;host=127.0.0.1;charset=utf8';
$hote = 'localhost';
$user = 'root';
$password = '';
try{
    $titre = "Verbindung";
    $dbh = new PDO($dsn,$user,$password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    echo 'Die Verbindung ist fehlgeschlagen : ' . $e->getMessage();
}
?>
