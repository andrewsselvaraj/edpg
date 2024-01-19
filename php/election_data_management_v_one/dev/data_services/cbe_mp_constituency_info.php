<?php
include('../election_db_connect/election_db_connect.php'); 
$query = "SELECT DISTINCT MP_Constituency FROM `cbe_mp_consituency_result_2019`";
$result = mysqli_query($conn, $query);

$mp_constituencies = array();
while ($row = mysqli_fetch_assoc($result)) {
    $mp_constituencies[] = $row['MP_Constituency'];
}

echo json_encode($mp_constituencies);
?>
