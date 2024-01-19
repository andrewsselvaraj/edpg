<?php
include('../election_db_connect/election_db_connect.php'); 
$query = "SELECT DISTINCT state_name FROM `cbe_mp_consituency_result_2019`";
$result = mysqli_query($conn, $query);

$state_names = array();
while ($row = mysqli_fetch_assoc($result)) {
    $state_names[] = $row['state_name'];
}

echo json_encode($state_names);
?>
