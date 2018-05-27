<?php
ini_set('display_errors', 'Off');

//const DB_SERVER = 'plazma.rs';
//const DB_USER = 'plazmars_plazmau';
//const DB_PASS = 'plazma2017HugeMedia';
//const DB_NAME = 'plazmars_plazma';

const DB_SERVER = 'mysql690.loopia.se';
const DB_USER = 'double_mp@d42989';
const DB_PASS = 'DoubleMP2017/';
const DB_NAME = 'doublemp_solutions_com_db_1';

try {
    $db= new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME.';charset=utf8', DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Greska!");
}
