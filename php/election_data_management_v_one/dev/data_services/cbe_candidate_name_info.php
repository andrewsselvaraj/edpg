<?php
include('../election_db_connect/election_db_connect.php'); 
$query = "SELECT DISTINCT Candidate_Name from cbe_mp_consituency_result_2019";
$result = mysqli_query($conn, $query);

$candidate_names = array();
while ($row = mysqli_fetch_assoc($result)) {
    $candidate_names[] = $row['Candidate_Name'];
}

echo json_encode($candidate_names);
?>
