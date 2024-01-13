<?php
include('../election_db_connect/election_db_connect.php'); 
$query = "SELECT DISTINCT Party_Name FROM `cbe_mp_consituency_result_2019`";
$result = mysqli_query($conn, $query);

$party_names = array();
while ($row = mysqli_fetch_assoc($result)) {
    $party_names[] = $row['Party_Name'];
}

echo json_encode($party_names);
?>
