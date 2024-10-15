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

// Fetch all alumni records in descending order by ID
$sql = "SELECT * FROM alumni ORDER BY id DESC";
$result = $conn->query($sql);

// Handle approval/rejection updates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $action = $_POST['action']; // 'approve' or 'reject'

    // Update the approved column based on the action
    if ($action === 'approve') {
        $update_sql = "UPDATE alumni SET approved = 'approved' WHERE id = $id";
    } elseif ($action === 'reject') {
        $update_sql = "UPDATE alumni SET approved = 'rejected' WHERE id = $id";
    }

    if ($conn->query($update_sql) === TRUE) {
        echo "Record updated successfully!";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Fetch data again after update to show updated status
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve/Reject Alumni</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <h1 class="text-2xl font-bold mb-4">Alumni Approval System</h1>
    <table class="min-w-full bg-white shadow-md rounded mb-4">
        <thead>
            <tr>
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Profile Image</th>
                <th class="border px-4 py-2">Name</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Actions</th>
                <th class="border px-4 py-2">Bio</th>
                <th class="border px-4 py-2">Educational Background</th>
                <th class="border px-4 py-2">University</th>
                <th class="border px-4 py-2">Job Title</th>
                <th class="border px-4 py-2">Position</th>
                <th class="border px-4 py-2">Blood Group</th>
                <th class="border px-4 py-2">Facebook</th>
                <th class="border px-4 py-2">Instagram</th>
                <th class="border px-4 py-2">LinkedIn</th>
                <th class="border px-4 py-2">GitHub</th>
                <th class="border px-4 py-2">Twitter</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php 
                $rowIndex = 0; // To track row index for alternating colors
                while ($row = $result->fetch_assoc()): 
                    // Set background color and text color based on approval status
                    if (is_null($row['approved'])) {
                        $rowClass = 'bg-yellow-200'; // Pending status
                    } else {
                        // Alternate row colors for approved/rejected statuses
                        $rowClass = ($rowIndex % 2 === 0) ? 'bg-gray-100' : 'bg-white';
                    }

                    // Change text color to red if rejected
                    if ($row['approved'] === 'rejected') {
                        $textColorClass = 'text-red-500'; // Red text for rejected status
                    } else {
                        $textColorClass = 'text-black'; // Default text color
                    }
                    ?>
                    <tr class="<?php echo $rowClass; ?> <?php echo $textColorClass; ?>">
                        <td class="border px-4 py-2"><?php echo $row['id']; ?></td>
                        <td class="border px-4 py-2">
                            <?php if (!empty($row['profile_image'])): ?>
                                <img src="<?php echo htmlspecialchars($row['profile_image']); ?>" alt="Profile Image" class="h-12 w-12 rounded-full">
                            <?php else: ?>
                                <span>No Image</span>
                            <?php endif; ?>
                        </td>
                        <td class="border px-4 py-2"><?php echo htmlspecialchars($row['name']); ?></td>
                        <td class="border px-4 py-2">
                            <?php 
                            if ($row['approved'] === 'approved') {
                                echo 'Approved';
                            } elseif ($row['approved'] === 'rejected') {
                                echo 'Rejected';
                            } else {
                                echo 'Pending';
                            }
                            ?>
                        </td>
                        <td class="border px-4 py-2">
                            <?php if (is_null($row['approved'])): ?>
                                <form action="" method="POST" class="inline-block">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button name="action" value="approve" class="bg-green-500 text-white px-3 py-1 rounded">
                                        Approve
                                    </button>
                                </form>
                                <form action="" method="POST" class="inline-block ml-2">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button name="action" value="reject" class="bg-red-500 text-white px-3 py-1 rounded">
                                        Reject
                                    </button>
                                </form>
                            <?php elseif ($row['approved'] === 'approved'): ?>
                                <form action="" method="POST" class="inline-block">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button name="action" value="reject" class="bg-red-500 text-white px-3 py-1 rounded">
                                        Reject
                                    </button>
                                </form>
                            <?php elseif ($row['approved'] === 'rejected'): ?>
                                <form action="" method="POST" class="inline-block">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button name="action" value="approve" class="bg-green-500 text-white px-3 py-1 rounded">
                                        Approve
                                    </button>
                                </form>
                            <?php endif; ?>
                        </td>
                        <td class="border px-4 py-2"><?php echo $row['bio']; ?></td>
                        <td class="border px-4 py-2"><?php echo $row['educational_background']; ?></td>
                        <td class="border px-4 py-2"><?php echo $row['university']; ?></td>
                        <td class="border px-4 py-2"><?php echo $row['job_title']; ?></td>
                        <td class="border px-4 py-2"><?php echo $row['position']; ?></td>
                        <td class="border px-4 py-2"><?php echo $row['blood_group']; ?></td>
                        <td class="border px-4 py-2"><?php echo $row['facebook_link']; ?></td>
                        <td class="border px-4 py-2"><?php echo $row['instagram_link']; ?></td>
                        <td class="border px-4 py-2"><?php echo $row['linkedin_link']; ?></td>
                        <td class="border px-4 py-2"><?php echo $row['github_link']; ?></td>
                        <td class="border px-4 py-2"><?php echo $row['twitter_link']; ?></td>
                    </tr>
                    <?php 
                    // Increment the row index for alternating colors
                    if (!is_null($row['approved'])) {
                        $rowIndex++;
                    }
                    ?>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="16" class="border px-4 py-2">No alumni records found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
