<?php
include('../election_db_connect/election_db_connect.php'); 
$query = "SELECT DISTINCT Election FROM `cbe_mp_consituency_result_2019`";
$result = mysqli_query($conn, $query);

$elections = array();
while ($row = mysqli_fetch_assoc($result)) {
    $elections[] = $row['Election'];
}

echo json_encode($elections);
?>
