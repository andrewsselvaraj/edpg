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
