<?php
session_start();
require_once 'assets/src/config/config.php';
$db = new Database;
$db->regislogin();
require_once 'assets/src/php/index.php';
