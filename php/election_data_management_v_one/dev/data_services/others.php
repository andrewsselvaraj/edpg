<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Query Executor</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>SQL Query Executor</h2>

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
            $servername = "localhost";
            $username = "admin";
            $password = "Admin@123#";
            $database = "election_db_v_one";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $database);

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

</body>
</html>
=======

<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">

    <title>Election Data Management System</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</head>


<style>
#shadowbox1 {
           border: 1px solid;
           padding: 20px;
           box-shadow: 15px 10px 18px gray;
           background: wheat;
         }

 
 
  .btn-primary {
  color: #fff;
  background-color: #D81159;
  border-color: #D81159;
}
.btn-primary:hover {
  color: #fff;
  background-color: #8F2D56;
  border-color: #8F2D56;
}

  
</style>


<body>

<div class="jumbotron">
  <h1 class="display-4">Hi there!</h1>
  <p class="lead">Welcome to Election Data Management System!</p>
  <hr class="my-4">
  <p  class="lead">Please login to continue</p>

  <div class="row">
  <div class="col-6">
<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');

$writer = new Xlsx($spreadsheet);
$writer->save('hello_world.xlsx');

</div>
<div class="col-6"></div>
</div>
  <!--
  <a class="btn btn-primary btn-lg" href="ramnad.php" role="button">Ramnad</a>
  <a class="btn btn-primary btn-lg" href="thiruvanandhapuram.php" role="button">Thiruvananthapuram</a>
-->
</div>

</body>
</html>
>>>>>>> 3a89cd1bacade0dde2fa5e1f4b65494b0e8298fc
