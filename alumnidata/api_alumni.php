<?php
header("Access-Control-Allow-Origin: *"); // Allows all domains to access this resource
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); // Allowed methods
header("Access-Control-Allow-Headers: Content-Type"); // Allowed headers
header("Content-Type: application/json");

// Database configuration
$servername = "localhost";
$username = "onukromx_admin"; // Replace with your actual username
$password = "Muin@3.1416"; // Replace with your actual password
$dbname = "onukromx_aldb"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(array(
        "status" => false,
        "message" => "Database connection failed: " . $conn->connect_error
    )));
}

// Fetch data
$name = isset($_GET['name']) ? $conn->real_escape_string($_GET['name']) : ''; // Get name parameter and sanitize
$sql = "SELECT * FROM alumni" . ($name ? " WHERE name LIKE '%$name%'" : ''); // Modify the query to filter by name
$result = $conn->query($sql);

$alumni_data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $alumni = array(
            "id" => $row["id"],
            "name" => $row["name"],
            "bio" => $row["bio"],
            "educational_background" => $row["educational_background"],
            "university" => $row["university"],
            "program_subject" => $row["program_subject"],
            "job_title" => $row["job_title"],
            "position" => $row["position"],
            "blood_group" => $row["blood_group"],
            "profile_image" => $row["profile_image"], // Fetch the profile image
            "resume" => $row["resume"], // Fetch the resume field
            "status" => $row["approved"], // Fetch the status field
            "social_media" => array(
                "facebook" => $row["facebook_link"],
                "instagram" => $row["instagram_link"],
                "linkedin" => $row["linkedin_link"],
                "github" => $row["github_link"],
                "twitter" => $row["twitter_link"]
            )
        );
        array_push($alumni_data, $alumni);
    }
    echo json_encode(array(
        "status" => true,
        "message" => "Successfully fetched alumni data",
        "alumni" => $alumni_data
    ));
} else {
    echo json_encode(array(
        "status" => false,
        "message" => "No records found"
    ));
}

$conn->close();
?>
