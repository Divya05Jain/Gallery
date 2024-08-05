<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test_db";
$posts_per_page = 10;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the current page number from URL parameters, default to 1 if not set
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $posts_per_page;

$sql = "SELECT id, headline, paragraph, images, created_at FROM blogs ORDER BY created_at DESC LIMIT $posts_per_page OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogs</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"/>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Gupter:wght@400;500;700&family=PT+Serif:ital,wght@0,400;0,700;1,400;1,700&display=swap');

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;    
        background:#c5dfc5;
    }
    header{
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .container {
        width: 60%;
        max-width: 1200px;
        margin: auto;
        padding: 20px;
    }

    header h1 {
        text-align: center;
        font-size: 4rem;
    }

    .grid {
       columns: 2;
       gap: 40px;
    
    }

    .card {
        background: white;
        /* border-radius: 8px; */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: auto;
        max-width: 450px;
        margin-bottom: 40px;
    }
    .card:hover{
    transform: scale(1.005);
    background-color: rgba(255,255,255.0.9);
    transition: ease-out 0.5s ;
    box-shadow: 2px 2px 2px rgba(255,255,255,0.6);
    }

    .card img {
        max-width: 450px;
        width: 100%;
        height: 200px;
        object-fit: cover;
        display: block;
        background-color: #fff;
    }

    .card-content {
        padding: 15px;
    }

    .card-content h2 {
        margin-top: 0;
        color: #333;
    }

    .card-content p {
        color: #666;
        margin: 0;
        padding: 10px 0;
        word-wrap: break-word;
        overflow-wrap: break-word;
        font-family: "Gupter", serif;
    }

    .card-content .short-paragraph {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card-content .full-paragraph {
        display: none;
    }

    .card-content .show-more {
        color: #007bff;
        cursor: pointer;
        margin-top: 10px;
        display: flex;
        justify-content: flex-end;
    }

    .slick-slide img {
        width: 100%;
        height: auto;
        object-fit: cover;
    }

    .pagination {
        text-align: center;
        margin: 20px 0;
    }

    .pagination a {
        color: #007bff;
        text-decoration: none;
        padding: 8px 16px;
        border: 1px solid #ddd;
        margin: 0 4px;
        border-radius: 4px;
    }

    .pagination a:hover {
        background-color: #ddd;
    }

    .card-content .date {
        font-size: 0.9em;
        color: #888;
        margin-top: 5px;
    }
    @media (max-width: 430px) {
        .container {
            width: 90%;
            padding: 10px;
        }
        .grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        .card {
            max-width: 100%;
        }
        .card img{
            max-width: 100%;
        }
    }
  
</style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.image-slider').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                adaptiveHeight: true
            });

            $("[data-fancybox='gallery']").fancybox({
                loop: true,
                buttons: [
                    'zoom',
                    'slideShow',
                    'thumbs',
                    'close'
                ]
            });

            // Show More functionality
            $('.show-more').on('click', function() {
                var $this = $(this);
                var fullParagraph = $this.siblings('.full-paragraph');
                var shortParagraph = $this.siblings('.short-paragraph');
                if (fullParagraph.is(':visible')) {
                    fullParagraph.hide();
                    shortParagraph.show();
                    $this.text('Show More');
                } else {
                    fullParagraph.show();
                    shortParagraph.hide();
                    $this.text('Show Less');
                }
            });
        });
    </script>
</head>
<body>
    <header>
    <img src="earth-removebg-preview.png"  style="width: 150px; margin-right:30px" alt="">

        <h1>GPSPL</h1>
        <h2>Blogs</h2>

</header>
    <div class="container">
        <div class="grid">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $headline = htmlspecialchars($row["headline"]);
                    $paragraph = htmlspecialchars($row["paragraph"]);
                    $imageSrcs = json_decode($row["images"], true); // Decode JSON to array
                    $created_at = htmlspecialchars($row["created_at"]); // Get the created_at field

                    echo '<div class="card">';
                    if (is_array($imageSrcs) && !empty($imageSrcs)) {
                        // Display the images in a slider with Fancybox for full-screen view
                        echo '<div class="image-slider">';
                        foreach ($imageSrcs as $imageSrc) {
                            echo '<div><a href="' . htmlspecialchars($imageSrc) . '" data-fancybox="gallery" data-caption="' . htmlspecialchars($headline) . '">
                                    <img src="' . htmlspecialchars($imageSrc) . '" alt="Blog Image">
                                  </a></div>';
                        }
                        echo '</div>';
                    }
                    echo '<div class="card-content">';
                    echo '<p class="date"> ' . date("F j, Y", strtotime($created_at)) . '</p>';

                    echo '<h2>' . $headline . '</h2>';

                    // Display the date
                    echo '<hr class="separator"  >';

                    // Check if the paragraph is longer than a certain length to decide whether to show "Show More"
                    if (strlen($paragraph) > 50) {
                        echo '<p class="short-paragraph">' . substr($paragraph, 0, 50) . '...</p>'; // Show short text
                        echo '<p class="full-paragraph">' . $paragraph . '</p>'; // Show full text hidden initially
                       
                        // echo '<hr class="separator">';
                        echo '<span class="show-more">Show More</span>';
                    } else {
                        echo '<p>' . $paragraph . '</p>'; // Show full text without "Show More"
                    }

                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "<p>No blogs found.</p>";
            }
            ?>
        </div>
        <div class="pagination">
            <?php
            // Get the total number of blog posts for pagination
            $count_sql = "SELECT COUNT(*) as total FROM blogs";
            $count_result = $conn->query($count_sql);
            $total_posts = $count_result->fetch_assoc()['total'];
            $total_pages = ceil($total_posts / $posts_per_page);

            for ($i = 1; $i <= $total_pages; $i++) {
                echo '<a href="?page=' . $i . '">' . $i . '</a>';
            }
            ?>
        </div>
    </div>
    <?php $conn->close(); ?>
</body>
</html>
