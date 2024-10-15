<?php
// Database configuration
$servername = "localhost";
$username = "onukromx_admin";
$password = "Muin@3.1416"; // Replace with your actual password
$dbname = "onukromx_aldb"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize and assign input values
$name = mysqli_real_escape_string($conn, $_POST['name']); // Required field
$bio = !empty($_POST['bio']) ? "'" . mysqli_real_escape_string($conn, $_POST['bio']) . "'" : "NULL";
$educational_background = !empty($_POST['educational_background']) ? "'" . mysqli_real_escape_string($conn, $_POST['educational_background']) . "'" : "NULL";
$university = !empty($_POST['university_college']) ? "'" . mysqli_real_escape_string($conn, $_POST['university_college']) . "'" : "NULL";
$program_subject = !empty($_POST['program_subject']) ? "'" . mysqli_real_escape_string($conn, $_POST['program_subject']) . "'" : "NULL";
$job_title = !empty($_POST['job']) ? "'" . mysqli_real_escape_string($conn, $_POST['job']) . "'" : "NULL";
$position = !empty($_POST['position']) ? "'" . mysqli_real_escape_string($conn, $_POST['position']) . "'" : "NULL";
$blood_group = !empty($_POST['blood_group']) ? "'" . mysqli_real_escape_string($conn, $_POST['blood_group']) . "'" : "NULL";
$facebook_link = !empty($_POST['facebook']) ? "'" . mysqli_real_escape_string($conn, $_POST['facebook']) . "'" : "NULL";
$instagram_link = !empty($_POST['instagram']) ? "'" . mysqli_real_escape_string($conn, $_POST['instagram']) . "'" : "NULL";
$linkedin_link = !empty($_POST['linkedin']) ? "'" . mysqli_real_escape_string($conn, $_POST['linkedin']) . "'" : "NULL";
$github_link = !empty($_POST['github']) ? "'" . mysqli_real_escape_string($conn, $_POST['github']) . "'" : "NULL";
$twitter_link = !empty($_POST['twitter']) ? "'" . mysqli_real_escape_string($conn, $_POST['twitter']) . "'" : "NULL";

// Handle profile image upload
$profile_image_path = "NULL"; // Default is NULL if no image is uploaded
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
    $image = $_FILES['profile_image'];
    $image_name = time() . "_" . basename($image['name']);
    $target_directory = 'uploads/profile_images/'; // Updated directory for profile images
    $target_file = $target_directory . $image_name;

    // Ensure the directory exists
    if (!file_exists($target_directory)) {
        mkdir($target_directory, 0755, true);
    }

    // Check if the file is a valid image
    $allowed_file_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (in_array($image['type'], $allowed_file_types)) {
        if (move_uploaded_file($image['tmp_name'], $target_file)) {
            $profile_image_path = "'$target_file'"; // Store the path for the database
        } else {
            die("Error uploading the image.");
        }
    } else {
        die("Invalid file type. Please upload a JPEG, PNG, or GIF image.");
    }
} else {
    die("No profile image uploaded or there was an upload error.");
}

// Handle resume upload
$resume_path = "NULL"; // Default is NULL if no resume is uploaded
if (isset($_FILES['resume']) && $_FILES['resume']['error'] === UPLOAD_ERR_OK) {
    $resume = $_FILES['resume'];
    $resume_name = time() . "_" . basename($resume['name']);
    $target_directory = 'uploads/resumes/'; // Updated directory for resumes
    $target_file = $target_directory . $resume_name;

    // Ensure the directory exists
    if (!file_exists($target_directory)) {
        mkdir($target_directory, 0755, true);
    }

    // Allowed file types for resume (PDF, DOC, DOCX, JPEG, PNG)
    $allowed_file_types = [
        'application/pdf',  // PDF
        'application/msword',  // DOC
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',  // DOCX
        'image/jpeg',  // JPEG image
        'image/png',   // PNG image
        'image/gif'    // GIF image
    ];

    if (in_array($resume['type'], $allowed_file_types)) {
        if (move_uploaded_file($resume['tmp_name'], $target_file)) {
            $resume_path = "'$target_file'"; // Store the path for the database
        } else {
            die("Error uploading the resume.");
        }
    } else {
        die("Invalid file type. Please upload a PDF, DOC/DOCX, or image (JPEG, PNG, GIF) file.");
    }
} else {
    die("No resume uploaded or there was an upload error.");
}

// Debugging: Print the paths
echo "Profile Image Path: $profile_image_path<br>";
echo "Resume Path: $resume_path<br>";

// Construct the SQL query
$sql = "INSERT INTO alumni (name, bio, educational_background, university, program_subject, job_title, position, blood_group, facebook_link, instagram_link, linkedin_link, github_link, twitter_link, profile_image, resume)
        VALUES ('$name', $bio, $educational_background, $university, $program_subject, $job_title, $position, $blood_group, $facebook_link, $instagram_link, $linkedin_link, $github_link, $twitter_link, $profile_image_path, $resume_path)";

// Execute the query and check if successful
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully.";
} else {
    echo "Error: " . $conn->error;
}

// Close the connection
$conn->close();
?>