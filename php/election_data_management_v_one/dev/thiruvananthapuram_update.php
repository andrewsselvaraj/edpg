<?php include('election_db_connect/election_db_connect.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $election_id = $_POST['election_id'];
    $selectedOption = $_POST['selectedOption'];

    // Create and execute the SQL query to update the database table
    $sql = "UPDATE thiruvananthapuram SET voted_status = '$selectedOption', submitted = 1 WHERE election_id = $election_id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}


?>