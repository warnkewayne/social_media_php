<?php

require 'db.php';
$db = new DB();

$result = $db->queryOne("SELECT * FROM posts ORDER BY id DESC LIMIT 1");

echo json_encode($result);
