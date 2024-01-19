<?php
if (isset($_POST['submit'])) {
    //require 'vendor/autoload.php';
    require 'vendor/phpoffice/phpspreadsheet/src/PhpSpreadsheet/IOFactory.php';
    //$conn = new mysqli('localhost', 'root', '', 'user_management');
    $conn = new mysqli('localhost', 'root', 'Admin@123#', 'user_management');
    if ($conn->connect_errno) {
        echo $conn->connect_error;
        echo "Database not connected";
        die();
    } else {
        echo "Database connected";
    }
   
    echo "check condition";
    //echo phpinfo();

    if ($_FILES['file']['error'] == UPLOAD_ERR_OK) {
        echo "Coming in";
        $fileName = $_FILES['file']['name'];
        echo "checkpoint1";
        $fileTmpName = $_FILES['file']['tmp_name'];
        echo "checkpoint2";
        $uploadFolder = 'uploads/'; // Create this folder in the same directory as your script
        $destinationPath = $uploadFolder . $fileName;
        move_uploaded_file($fileTmpName, $destinationPath); // Uncomment this line
        echo "checkpoint3";

if (file_exists($destinationPath)) {

try {


        require 'vendor/autoload.php';

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fileName);
        //$spreadsheet = \vendor\phpoffice\phpspreadsheet\src\PhpSpreadsheet\IOFactory::load($fileName);
        echo "checkpoint4";
        $sheet = $spreadsheet->getActiveSheet(); 
        echo "chechpoint5";

        // Debug: Display the header row of the spreadsheet
    $headerRow = $sheet->getRowIterator()->current();
    foreach ($headerRow->getCellIterator() as $cell) {
        echo $cell->getValue() . ' | ';
    }
    echo "<br>";

        foreach ($sheet->getRowIterator() as $row) {

            // Debug: Display the values in each row
        foreach ($row->getCellIterator() as $cell) {
            echo $cell->getValue() . ' | ';
        }
        echo "<br>";

            $usm_user_org_id = $sheet->getCellByColumnAndRow(1, $row->getRowIndex())->getValue(); 
            $usm_user_id = $sheet->getCellByColumnAndRow(2, $row->getRowIndex())->getValue(); 
            $usm_user_name = $sheet->getCellByColumnAndRow(3, $row->getRowIndex())->getValue(); 
            $usm_user_email = $sheet->getCellByColumnAndRow(4, $row->getRowIndex())->getValue(); 
            $usm_user_password = $sheet->getCellByColumnAndRow(5, $row->getRowIndex())->getValue(); 
            $usm_user_mobile = $sheet->getCellByColumnAndRow(6, $row->getRowIndex())->getValue(); 
            $usm_user_state = $sheet->getCellByColumnAndRow(7, $row->getRowIndex())->getValue(); 
            $usm_user_city = $sheet->getCellByColumnAndRow(8, $row->getRowIndex())->getValue(); 
            $usm_user_address = $sheet->getCellByColumnAndRow(9, $row->getRowIndex())->getValue(); 
            $usm_user_pincode = $sheet->getCellByColumnAndRow(10, $row->getRowIndex())->getValue(); 
            $usm_user_geolocation = $sheet->getCellByColumnAndRow(11, $row->getRowIndex())->getValue(); 
            $usm_user_profession = $sheet->getCellByColumnAndRow(12, $row->getRowIndex())->getValue(); 
            $usm_user_speciallization = $sheet->getCellByColumnAndRow(13, $row->getRowIndex())->getValue(); 
            $usm_user_role = $sheet->getCellByColumnAndRow(14, $row->getRowIndex())->getValue(); 
            $usm_user_updated_by = $sheet->getCellByColumnAndRow(15, $row->getRowIndex())->getValue(); 
            //$sql = "INSERT INTO contact (name, age) VALUES ('$name', '$age')";
            $sql = "INSERT INTO `usm_users`(`usm_user_org_id`, `usm_user_id`, `usm_user_name`, `usm_user_email`, `usm_user_password`, `usm_user_mobile`, `usm_user_state`, `usm_user_city`, `usm_user_address`, `usm_user_pincode`, `usm_user_geolocation`, `usm_user_profession`, `usm_user_speciallization`, `usm_user_role`, `usm_user_updated_by`) VALUES ('$usm_user_org_id','$usm_user_id','$usm_user_name','$usm_user_email','$usm_user_password','$usm_user_mobile','$usm_user_state','$usm_user_city','$usm_user_address','$usm_user_pincode','$usm_user_geolocation','$usm_user_profession','$usm_user_speciallization','$usm_user_role','$usm_user_updated_by')";
           echo "printing sql";
            echo $sql;
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die("Error: " . mysqli_error($conn));
            }
        }
        mysqli_close($conn);
        unlink($fileName);
        echo "Loading...";
        echo "<script>alert('Data inserted successfully!')</script>";
       // echo "<script>location.href='index.html'</script>";
    } catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
        echo 'Error loading spreadsheet: ', $e->getMessage();
    }

} else {
    echo 'File not found: ', $destinationPath;
}

    } else {
        echo "Loading...";
        echo "<script>alert('Error uploading file!')</script>";
        //echo "<script>location.href='index.html'</script>";
    }
}
?>
