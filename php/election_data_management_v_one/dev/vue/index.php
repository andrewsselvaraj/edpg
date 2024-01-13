<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if($_SESSION['login_election_user_name'])
{

include('../election_db_connect/election_db_connect.php'); 


//$query = "SELECT * FROM cbe_mp_consituency_result_2019";
//$query = "SELECT cbe1.Election, cbe1.Constituency, cbe1.MP_AC, cbe1.State_AC, cbe1.Polling_Station_No, cbe1.Candidate_Name, cbe1.Party_Name, cbe1.No_of_Votes, cbe1.state_name, cbe1.MP_Constituency, cbe2.Polling_areas FROM cbe_mp_consituency_result_2019 cbe1 JOIN coimbatore_polling_areas cbe2 ON cbe1.Polling_Station_No = cbe2.Polling_Station_No LIMIT 40000";

$query = "SELECT cbe1.Election, cbe1.state_name, cbe1.MP_Constituency, cbe1.Constituency, cbe1.MP_AC, cbe1.State_AC, cbe1.Polling_Station_No, cbe1.Candidate_Name, cbe1.Party_Name, cbe1.No_of_Votes, cbe2.Polling_areas, cbe2.Election, cbe2.state_name, cbe2.MP_Constituency, cbe2.Constituency, cbe2.MP_AC, cbe2.State_AC, cbe2.Polling_Station_No, cbe1.Candidate_Name, cbe1.Party_Name, cbe1.No_of_Votes FROM cbe_mp_consituency_result_2019 cbe1 , coimbatore_polling_areas cbe2 where cbe1.Election = cbe2.Election AND cbe1.state_code = cbe2.state_code AND cbe1.MP_AC=cbe2.MP_AC AND cbe1.State_AC=cbe2.State_AC AND cbe1.state_name = cbe2.state_name AND cbe1.MP_Constituency = cbe2.MP_Constituency AND cbe1.Polling_Station_No = cbe2.Polling_Station_No ORDER BY cbe1.Constituency, cbe1.Polling_Station_No";

$result = $conn->query($query);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vue Election Results</title>
    <!-- <script src="https://unpkg.com/vue@next"></script> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css">
</head>

<body>
    <div id="app" class="container mx-auto my-8">
        <!-- Vue.js app will mount here -->
    </div>
    <script>
    var phpData = <?php echo json_encode($data); ?>;
    </script>
    <script type="module" src="./app.js"></script> <!-- Vue.js application script -->
</body>

</html>
<?php

//end
}
else
{
   
    echo "<h1>Redirecting...Please wait..!</h1>";
    echo "<script> alert('Please login to continue..!')</script>";
    echo "<script> location.href='index.php'</script>";
}
?>