<?php
include('election_db_connect/election_db_connect.php'); 


$sql = "SELECT Polling_Station_No, Candidate_Name, No_of_Votes, Party_Name, Constituency FROM cbe_mp_consituency_result_2019";

$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
  
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
