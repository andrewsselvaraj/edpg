<?php
include('../election_db_connect/election_db_connect.php'); 
$query = "SELECT DISTINCT Constituency FROM cbe_mp_consituency_result_2019";
$result = mysqli_query($conn, $query);

$constituencies = array();
while ($row = mysqli_fetch_assoc($result)) {
    $constituencies[] = $row['Constituency'];
}

echo json_encode($constituencies);
?>
