<?php
ini_set('display_errors', 'Off');

//const DB_SERVER = 'plazma.rs';
//const DB_USER = 'plazmars_plazmau';
//const DB_PASS = 'plazma2017HugeMedia';
//const DB_NAME = 'plazmars_plazma';
/*
const DB_SERVER = 'localhost';
const DB_USER = 'uniada_admin';
const DB_PASS = 'weareawesome2018';
const DB_NAME = 'uniada_website';
*/
const DB_SERVER = 'mysql687.loopia.se';
const DB_USER = 'doublemp@c44005';
const DB_PASS = 'Devil0312DoubleMP';
const DB_NAME = 'cryptoinvestment_rs';
try {
    $db= new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Greska!");
}
