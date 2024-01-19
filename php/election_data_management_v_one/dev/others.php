<?php 

session_start();
if($_SESSION['login_election_user_name'])
{
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">

    <title>Election Data | Coimbatore</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   
   
   
   <style>
div.card {

  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  text-align: center;
}


div.container {
  padding: 10px;
}

.hidden-th {
            display: none;
        }

</style>

</head>

<!--Navbar start -->
<?php include('includes/navbar.php'); ?>
<!-- Navbar end -->


<body>
    
    <div class = "container">
    <div ng-app="myApp" ng-controller="myCtrl">
        <h2>Coimbatore:</h2>
        <p>Logged in user: <b><font color="#D81159"><?php echo $_SESSION['login_election_user_name']; ?> </font></b> </p>
    </div>
</center>
       
<br>


        <div style="overflow-x:auto;">

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="sqlQuery">Enter SQL Query:</label><br>
        <textarea name="sqlQuery" rows="4" cols="50"></textarea><br><br>
        <input type="submit" value="Execute Query">
    </form>

    <?php
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the user-entered SQL query
        $sqlQuery = $_POST["sqlQuery"];

        // Validate and sanitize the SQL query (you may want to implement more robust validation)
        $sqlQuery = trim($sqlQuery);
        if (empty($sqlQuery)) {
            echo "Please enter a valid SQL query.";
        } else {
            // Database connection parameters
	include('election_db_connect/election_db_connect.php'); 

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Execute the SQL query
            $result = $conn->query($sqlQuery);

            // Display the result in a table
            if ($result->num_rows > 0) {
                echo "<h3>Query Result:</h3>";
                echo "<table>";
                // Display table headers
                echo "<tr>";
                while ($fieldInfo = $result->fetch_field()) {
                    echo "<th>{$fieldInfo->name}</th>";
                }
                echo "</tr>";

                // Display table data
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>{$value}</td>";
                    }
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "No records found.";
            }

            // Close the database connection
            $conn->close();
        }
    }
    ?>
</div>

    </div>



</div>





</body>
</html>

<?php


}
else
{
   
    echo "<h1>Redirecting...Please wait..!</h1>";
    echo "<script> alert('Please login to continue..!')</script>";
    echo "<script> location.href='index.php'</script>";
}
?>


