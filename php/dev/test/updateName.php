<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //$id = isset($_POST["id"]);
    //$name = isset($_POST["name"]);


    $id = isset($_POST["id"]) ? $_POST["id"] : null;
    $name = isset($_POST["name"]) ? $_POST["name"] : null;
/*
 
    error_log("id: " . $_POST["id"]);
error_log("name: " . $_POST["name"]);
*/

    //$mysqli = new mysqli("localhost", "root", "", "election_db_v_three");
    $mysqli = new mysqli("localhost", "root", "Admin@123#", "election_db_v_one");

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    echo $id;
    echo $name;

   
    $stmt = null;

    if ($id !== null && $name !== null) {
        $query = "UPDATE test_table SET name = ? WHERE id = ?";
        $stmt = $mysqli->prepare($query);

        if ($stmt === false) {
            die("Error preparing statement: " . $mysqli->error);
        }

        $stmt->bind_param("si", $name, $id);

        if ($stmt->execute()) {
            echo "Name updated successfully";
        } else {
            echo "Error updating name!!: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Invalid data received-- $id $name";
    }

    $mysqli->close();
} else {
    echo "Invalid request method.";
}
?>