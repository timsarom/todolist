<?php
// tiek izveidots savienojums ar datu bāzi
$server = 'localhost';
$user = 'root';
$pass = 'root';
$db = 'to_do_list';

$mysqli = new mysqli($server, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Savienojums ar datu bāzi nav izveidojies: " . $mysqli->connect_error);
}
// iekļaujam failu ar "todo" klasi, lai izveidotu jaunu objektu, kam ir piekļuve datubāzei.
include_once 'todolist_class.php';

$toDo = new todo($mysqli);

?>