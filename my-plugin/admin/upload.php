<?php
require_once __DIR__ . '/../vendor/autoload.php';

// Use PhpSpreadsheet classes
if (!class_exists('PhpOffice\PhpSpreadsheet\IOFactory')) {
    // echo "Autoloader did not load PhpSpreadsheet classes.";
    // exit;
}
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

require 'G:\xampp\htdocs\vedant\wp-content\plugins\my-plugin\vendor\autoload.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['excel_file'])) {
    // Get the uploaded file
    $file = $_FILES['excel_file'];

    // Check if the uploaded file is an Excel file
    $allowed_extensions = ['xls', 'xlsx', 'ods'];
    $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);

    if (!in_array($file_extension, $allowed_extensions)) {
        echo "Invalid file type. Please upload an Excel file.";
        exit;
    }

    // Load the Excel file
    try {

        $spreadsheet = IOFactory::load($file['tmp_name']);
    } catch (Exception $e) {
        die('Error loading file: ' . $e->getMessage());
    }

    // Iterate through each sheet in the Excel file
    $sheetData = [];
    foreach ($spreadsheet->getSheetNames() as $sheetName) {
        $sheet = $spreadsheet->getSheetByName($sheetName);
        $sheetData[$sheetName] = [];

        // Read data from each row and store in array
        $rows = $sheet->toArray(null, true, true, true);
        foreach ($rows as $row) {
            $sheetData[$sheetName][] = $row;
        }
    }

   //Display the data from each sheet
   echo "<div class='container mt-5'>";
    echo "<h1>Excel Data</h1>";
    echo "<pre>";
    print_r($sheetData);
    echo "</pre>";

    

    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Excel File</title>
    
</head>
<body>
    <h1>Upload Excel File</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="excel_file">Choose an Excel file:</label>
        <input type="file" name="excel_file" id="excel_file" accept=".xls,.xlsx" required>
        <button type="submit">Upload and Process</button>
        
        
    </form>
</body>
</html>
