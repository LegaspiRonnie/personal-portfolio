<?php
$path = require_once 'initialize.php';
require_once $path['db'] . '/Database.php';

$db = new Database();
$conn = $db->connect();