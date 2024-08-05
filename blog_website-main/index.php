<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width,initial-scale=1">

    <title>Upload Form</title>
    <style>
        .error {
            color: red;
        }

        .disabled {
            background-color: grey;
            cursor: not-allowed;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            text-align: center;
        }

        .close-btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        .close-btn:hover {
            background-color: #45a049;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
        }

        .left,
        .right {
            width: 100%;
            height: auto;
        }

        .left {
            background-color: rgb(65, 119, 165);
            background: url(forests-1440x655\ 1.png);
            background-size: cover;
            color: white;
            border-radius: 0 0 10px 10px;
            padding: 20px;
            text-align: center;
        }

        .left .context {
            font-size: 2rem;
            padding: 10px;
        }

        .left p {
            padding: 10px;
            font-size: 20px;
        }

        .right {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #c5dfc5;
        }

        .card {
            width: 100%;
            max-width: 1000px;
            background-color: #f4f4f6;
            border-radius: 20px;
            text-align: center;
            padding: 20px;
            justify-content: center;
        }

        input[type="text"],
        textarea {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 16px;
            width: 100%;
            font-family: Arial, Helvetica, sans-serif;
        }

        .file-upload-container {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 2px dashed #ddd;
            border-radius: 10px;
            font-size: 16px;
            text-align: center;
            cursor: pointer;
            background-color: white;
        }

        .file-upload-container img {
            display: block;
            margin: auto;
            padding: 10px;
        }

        .file-upload-container input[type='file'] {
            display: none;
        }

        .content {
            width: 65%;
            text-align: left;
            font-family: Arial, Helvetica, sans-serif;
            align-items: center;
            margin: auto;
        }

        .content h1 {
            padding: 10px 0;
        }

        .content h3 {
            padding: 10px 0;
        }

        #submit-button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 16px;
            background-color: #5392F9;
            color: white;
            cursor: pointer;
        }

        .file-upload-container.dragover {
            border-color: #5392F9;
        }
        a {
    display: flex;
    text-decoration: none;
    color: #5392F9;
    margin-left: 70%;
    margin-top: 5px;
    position: relative;
    overflow: hidden;
    padding-right: 20px; 
    font-size: 20px;
}

a::before {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 0;
    height: 2px; 
    background-color: #5392F9;
    transition: width 0.3s ease; 
}

a::after {
    content: '→'; 
    position: absolute;
    right:18px;
    top: 50%;
    transform: translateY(-50%);
    opacity: 0;
    font-size: 20px; 
    font-weight: bold;
    transition: opacity 0.3s ease, transform 0.3s ease; 
}

a:hover::before {
    width: 90%;
}

a:hover::after {
    opacity: 1;
    transform: translateY(-50%) translateX(5px); 
}



        /* Media queries */
        @media (min-width: 768px) {
            .left,
            .right {
                width: 50%;
                height: 100vh;
            }

            .left {
                border-radius: 0 10px 10px 0;
                padding: 60px;
                text-align: left;
            }

            .left .context {
                margin: 60px 0 0 60px;
            }

            .left p {
                margin-left: 60px;
            }

            .right {
                padding: 0;
            }

            .card {
                height: 95%;
            }

            .file-upload-container {
                margin-left: 0;
            }
        }

        @media (min-width: 1200px) {
            .card {
                width: 95%;
            }
        }
    </style>
    <script>
        const maxFileSize = 5000000; // 5MB in bytes
        const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

        function validateFile() {
            const fileInput = document.getElementById('image');
            const files = fileInput.files;
            const submitButton = document.getElementById('submit-button');
            const errorMsg = document.getElementById('error-message');
            let totalSize = 0;
            let valid = true;

            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                totalSize += file.size;
                if (!allowedExtensions.exec(file.name)) {
                    errorMsg.textContent = "One or more files are not images. Please choose images.";
                    valid = false;
                    break;
                }
            }

            if (totalSize > maxFileSize) {
                errorMsg.textContent = "Total file size exceeds 5MB. Please remove some files.";
                valid = false;
            }

            if (valid) {
                errorMsg.textContent = "";
                submitButton.disabled = false;
                submitButton.classList.remove('disabled');
            } else {
                submitButton.disabled = true;
                submitButton.classList.add('disabled');
            }

            return valid;
        }

        function showModal(message) {
            const modal = document.getElementById('myModal');
            const modalMessage = document.getElementById('modal-message');
            modalMessage.textContent = message;
            modal.style.display = "block";
        }

        function closeModal() {
            const modal = document.getElementById('myModal');
            modal.style.display = "none";
        }

        function updateFileUploadText() {
            const fileInput = document.getElementById('image');
            const fileUploadText = document.getElementById('fileUploadText');
            if (fileInput.files.length > 0) {
                fileUploadText.textContent = fileInput.files.length + ' file(s) selected';
            } else {
                fileUploadText.textContent = 'Drag and drop an image or click to select';
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            const fileUploadContainer = document.getElementById('fileUploadContainer');
            const fileInput = document.getElementById('image');

            fileUploadContainer.addEventListener('click', () => fileInput.click());

            fileUploadContainer.addEventListener('dragover', (e) => {
                e.preventDefault();
                fileUploadContainer.classList.add('dragover');
            });

            fileUploadContainer.addEventListener('dragleave', () => {
                fileUploadContainer.classList.remove('dragover');
            });

            fileUploadContainer.addEventListener('drop', (e) => {
                e.preventDefault();
                fileUploadContainer.classList.remove('dragover');
                const droppedFiles = e.dataTransfer.files;
                const totalSize = Array.from(droppedFiles).reduce((acc, file) => acc + file.size, 0);
                if (totalSize + Array.from(fileInput.files).reduce((acc, file) => acc + file.size, 0) > maxFileSize) {
                    showModal("Total file size exceeds 5MB. Please remove some files.");
                } else {
                    fileInput.files = e.dataTransfer.files;
                    validateFile();
                    updateFileUploadText();
                }
            });

            fileInput.addEventListener('change', () => {
                validateFile();
                updateFileUploadText();
            });
        });
    </script>
</head>

<body>
    <div class="container">
        <div class="left">
            <div class="context">
                <h2>Plant a Tree</h2>
                <h2>Shape The Future</h2>
            </div>
            <p><i>Together We Make an Impact</i></p>
        </div>
        <div class="right">
            <div class="card">
                <div class="content">
                    <h1>Create a New Blog Post</h1>
                    <p style="margin-bottom: 50px;">Submit your title, a brief description, and an image to highlight your
                        contributions and inspire
                        others.</p>

                    <form method="post" enctype="multipart/form-data" class="text" onsubmit="return validateFile()">
                        <h3>Headline: </h3>
                        <input type="text" name="headline" placeholder="Enter the title of your blog post" required><br>
                        <h3>Paragraph:</h3>
                        <textarea name="paragraph"
                            placeholder="Provide a brief description or summary of your blog post..."
                            required></textarea><br>
                        <h3> Image: </h3>
                        <div class="file-upload-container" id="fileUploadContainer">
                            <img src="image 1.png" alt="">
                            <span id="fileUploadText">Drag and drop an image or click to select</span>
                            <input type="file" name="image[]" id="image" onchange="validateFile(); updateFileUploadText()"
                                multiple required>
                        </div>
                        <span id="error-message" class="error"></span><br>
                        <button id="submit-button" value="Upload" type="submit" disabled>Submit</button>
                    </form>
                    <a href="blogs.php">View Blogs</a>
                </div>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal">
        <div class="modal-content">
            <p id="modal-message"></p>
            <button class="close-btn" onclick="closeModal()">OK</button>
        </div>
    </div>
    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "<script>showModal('Connection failed: " . $conn->connect_error . "');</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $headline = $_POST['headline'];
    $paragraph = $_POST['paragraph'];
    $images = $_FILES['image'];
    $target_dir = "upload/";
    $uploaded_files = [];

    // Ensure the uploads directory exists
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    for ($i = 0; $i < count($images['name']); $i++) {
        $target_file = $target_dir . basename($images['name'][$i]);
        if (move_uploaded_file($images["tmp_name"][$i], $target_file)) {
            $uploaded_files[] = $target_file;
        } else {
            echo "<script>showModal('Sorry, there was an error uploading your file: " . $images['name'][$i] . "');</script>";
            $conn->close();
            exit();
        }
    }

    $uploaded_files_json = json_encode($uploaded_files);

    $stmt = $conn->prepare("INSERT INTO uploads (headline, paragraph, images) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $headline, $paragraph, $uploaded_files_json);

    if ($stmt->execute() === TRUE) {
        echo "<script>showModal('New record created successfully');</script>";
    } else {
        echo "<script>showModal('Error: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

</body>

</html>
