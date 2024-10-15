<?php
// Database credentials
$servername = "localhost";
$username = "onukromx_admin";
$password = "Muin@3.1416"; // Replace with your actual password
$dbname = "onukromx_aldb"; // Database name

// Create a connection to MySQL using PDO
try {
    $pdo = new PDO("mysql:host=$servername", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create the database with the correct character set and collation
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE $dbname");

    echo "Database '$dbname' created or exists already.<br>";
    
    // Create the Alumni table with a profile_image column for file upload
    $tableQuery = "
    CREATE TABLE IF NOT EXISTS alumni (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        bio TEXT,
        educational_background TEXT,
        university VARCHAR(100),
        program_subject VARCHAR(100),
        job_title VARCHAR(100),
        position VARCHAR(100),
        blood_group VARCHAR(5),
        profile_image VARCHAR(255) DEFAULT NULL,  -- Column to store the uploaded image path
        facebook_link VARCHAR(255) DEFAULT NULL,
        instagram_link VARCHAR(255) DEFAULT NULL,
        linkedin_link VARCHAR(255) DEFAULT NULL,
        github_link VARCHAR(255) DEFAULT NULL,
        twitter_link VARCHAR(255) DEFAULT NULL
    ) ENGINE=InnoDB;
    ";
    $pdo->exec($tableQuery);
    echo "Table 'alumni' created or exists already.<br>";

} catch (PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}

// Close connection
$pdo = null;
?>
