<?php
// Database connection or any other method to get states based on the country
// For simplicity, let's use a simple associative array here

$states = array(
    'usa' => array('New York', 'California', 'Texas'),
    'canada' => array('Ontario', 'Quebec', 'British Columbia')
);

$country = $_POST['country'];

if (isset($states[$country])) {
    $stateOptions = "";
    foreach ($states[$country] as $state) {
        $stateOptions .= "<option value='$state'>$state</option>";
    }
    echo $stateOptions;
} else {
    echo "<option value=''>No states available</option>";
}
?>
