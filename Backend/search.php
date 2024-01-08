<?php
//search.php
// Database connection details
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'firstdaydb');

// Connect to the database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check for database connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the search query is set
if (isset($_GET['query'])) {
    $searchTerm = $conn->real_escape_string($_GET['query']);

    // SQL query to search the address field in the Listings table
    // Replace 'address_column', 'title_column', 'phone_column', 'email_column' with your actual column names
    $sql = "SELECT title_column, phone_column, email_column FROM Listings WHERE address_column LIKE '%$searchTerm%'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<p>Title: " . htmlspecialchars($row['title_column']) . "<br>";
            echo "Phone: " . htmlspecialchars($row['phone_column']) . "<br>";
            echo "Email: " . htmlspecialchars($row['email_column']) . "<br>";
            // Placeholder for the link, you'll need to replace 'link_column' with your actual column or logic for the link
            echo "<a href='view-listing.php?id=" . urlencode($row['id_column']) . "'>View Listing</a></p>";
        }
    } else {
        echo "No results found.";
    }
} else {
    echo "No search term provided.";
}

// Close the database connection
$conn->close();
?>
