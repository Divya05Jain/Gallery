<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    if (!empty($_POST['selected_inputs'])) {
        $selected_ids = $_POST['selected_inputs'];
        $stmt = $conn->prepare("SELECT headline, paragraph, images FROM uploads WHERE id = ?");
        $insert_stmt = $conn->prepare("INSERT INTO blogs (headline, paragraph, images) VALUES (?, ?, ?)");
        $delete_stmt = $conn->prepare("DELETE FROM uploads WHERE id = ?");

        foreach ($selected_ids as $id) {
            // Retrieve the headline, paragraph, and image for the current ID
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $headline = $row['headline'];
                $paragraph = $row['paragraph'];
                $image = $row['images'];

                // Insert the headline, paragraph, and image into the blogs table
                $insert_stmt->bind_param("sss", $headline, $paragraph, $image);
                if ($insert_stmt->execute()) {
                    // Delete the inserted data from the uploads table
                    $delete_stmt->bind_param("i", $id);
                    $delete_stmt->execute();
                } else {
                    echo "Error: " . $insert_stmt->error;
                }
            }
        }

        // Close statements
        $stmt->close();
        $insert_stmt->close();
        $delete_stmt->close();

        // Redirect to blogs.php
        header("Location: blogs.php");
        exit(); // Ensure no further code is executed
    } else {
        echo "No inputs were selected.";
    }
} else {
    echo "Form was not submitted.";
}

$conn->close();
?>
