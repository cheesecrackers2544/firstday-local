<?php
// Set the directory path where your PHP files are located
$directoryPath = 'C:/xampp/htdocs/Firstday/';

// Use glob() to get all PHP files in the directory
$files = glob($directoryPath . '*.php');
$combinedContent = '';

// Iterate over each file and append its contents to the combinedContent string
foreach ($files as $file) {
    $combinedContent .= file_get_contents($file) . "\n"; // Added newline for readability
}

// Specify the path and filename for the combined file
$combinedFilePath = $directoryPath . 'combined.php';

// Write the combined contents to the new file
file_put_contents($combinedFilePath, $combinedContent);

// Echo a success message
echo "The files have been combined into " . $combinedFilePath;
?>