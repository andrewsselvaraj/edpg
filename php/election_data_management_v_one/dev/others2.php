asdasdas
<?php
echo "1";
require 'vendor/autoload.php';
echo "2";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
echo "3";
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');
echo "4";
$writer = new Xlsx($spreadsheet);
$writer->save('hello_world.xlsx');
echo "sssu";
?>

<?php
require 'vendor/autoload.php'; // Load Composer's autoloader

use PhpOffice\PhpSpreadsheet\IOFactory;

$inputFileName = 'path/to/your/excel/file.xlsx';

try {
    $spreadsheet = IOFactory::load($inputFileName);
    $sheet = $spreadsheet->getActiveSheet();

    // Get the highest row and column numbers referenced in the worksheet
    $highestRow = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();

    // Loop through each row of the worksheet
    for ($row = 1; $row <= $highestRow; ++$row) {
        // Read a specific cell
        $cellValue = $sheet->getCellByColumnAndRow(1, $row)->getValue();
        // Process the cell value as needed
        echo "Row $row: $cellValue\n";
    }
} catch (Exception $e) {
    echo 'Error loading file: ', $e->getMessage();
}
?>

