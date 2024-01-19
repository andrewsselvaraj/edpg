<?php
// Connect to the MySQL database
//$mysqli = new mysqli("localhost", "root", "", "election_db_v_three");
$mysqli = new mysqli("localhost", "root", "Admin@123#", "election_db_v_one");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Fetch data from the MySQL table
$query = "SELECT * FROM test_table";
$result = $mysqli->query($query);

if ($result === false) {
    die("Error in SQL query: " . $mysqli->error);
}

$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$mysqli->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
