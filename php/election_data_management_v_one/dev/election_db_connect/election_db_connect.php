<?php

//$conn=new mysqli('localhost','root','','election_db_v_three');
$conn=new mysqli('localhost','admin','Admin@123#','election_db_v_one');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>