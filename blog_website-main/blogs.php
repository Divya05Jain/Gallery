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

// Fetch blog posts for the current page
$sql = "SELECT id, headline, paragraph, images, created_at FROM blogs ORDER BY created_at DESC LIMIT $posts_per_page OFFSET $offset";
$result = $conn->query($sql);

// Fetch the total number of blog posts for pagination
$count_sql = "SELECT COUNT(*) as total FROM blogs";
$count_result = $conn->query($count_sql);
$total_posts = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_posts / $posts_per_page);
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
        overflow-x: hidden;
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

    .create{
        width: 100%;
        position: relative;
        left: 85vw;
        margin-bottom: 30px;
    }
    .create button {
        padding: 5px 10px;
        background-color: #34552f;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 30px;
        transition: all 0.3s ease; 
        font-weight: bold;
    }

    .create button:hover {
        padding: 12px 24px;
        transform: scale(1.15); 
    }

    .create .plus-sign {
        display: inline-block;
        transition: transform 0.3s ease; 
    }

    .create button:hover .plus-sign {
        transform: rotate(90deg); 
    }

    header h1 {
        text-align: center;
        font-size: 4rem;
    }
    header h2{
        font-size: 2rem;
    }

    .grid {
       columns: 2;
       gap: 40px;
    }

    .card {
        background: white;
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
        background-color: #ddd;
    }

    .pagination a:hover {
        background-color: grey;
        color: white;
    }

    .pagination a.active {
        background-color: #007bff;
        color: white;
        border: 1px solid #007bff;
    }

    .card-content .date {
        font-size: 0.9em;
        color: #888;
        margin-top: 5px;
    }
    
    @media (max-width: 430px) {
       .create{
        width: 45%;
        left: 26vw;
        margin: auto;
       }
       header h1{
        font-size: 3rem;
       }
       header h2{
        font-size: 1.5rem;
       }
        .container {
            width: 90%;
            padding: 10px;
        }
        .grid {
            /* grid-template-columns: 1fr; */
            column-count: 1;
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
        $('.image-slider').each(function() {
            var $slider = $(this);

            $slider.slick({
                dots: true,
                infinite: true,
                speed: 300, 
                slidesToShow: 1,
                slidesToScroll: 1,
                adaptiveHeight: true,
                arrows: false, 
                autoplay: false 
            });

            $slider.find("[data-fancybox='gallery']").fancybox({
                loop: true,
                buttons: [
                    'zoom',
                    'slideShow',
                    'thumbs',
                    'close'
                ]
            });
            $slider.on('mouseenter', function() {
                var slick = $slider.slick('getSlick');
                var slideCount = slick.slideCount;
                var currentSlideIndex = slick.currentSlide;

                
                var moveNextSlide = function() {
                    slick.slickNext();

                    if (slick.currentSlide >= slideCount - 1) {
                        slick.slickPause(); 
                    }
                };

                var autoSlideInterval = setInterval(moveNextSlide, 1000);
                $slider.on('mouseleave', function() {
                    clearInterval(autoSlideInterval);
                    slick.slickPause(); 
                });
            });
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
        <div style="display: flex; align-items: center;">
            <img src="earth-removebg-preview.png" style="width: 150px; margin-right: 30px;" alt="">
            <h1>GPSPL</h1>
            <h2>Blogs</h2>
        </div>
    </header>
    <div class="create">
        <button onclick="window.location.href='index.php'" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">
            <span class="plus-sign">+</span> Create New Blog
        </button>
    </div>
    <div class="container">
        <div class="grid">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $headline = htmlspecialchars($row["headline"]);
                    $paragraph = htmlspecialchars($row["paragraph"]);
                    $imageSrcs = json_decode($row["images"], true); 
                    $created_at = htmlspecialchars($row["created_at"]); 

                    echo '<div class="card">';
                    if (is_array($imageSrcs) && !empty($imageSrcs)) {
                        
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

                    
                    echo '<hr class="separator"  >';

                    if (strlen($paragraph) > 50) {
                        echo '<p class="short-paragraph">' . substr($paragraph, 0, 50) . '...</p>'; // Show short text
                        echo '<p class="full-paragraph">' . $paragraph . '</p>';
                        echo '<span class="show-more">Show More</span>';
                    } else {
                        echo '<p>' . $paragraph . '</p>'; 
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
            // Ensure the current page is within bounds
            $current_page = max(1, min($page, $total_pages));
            
            // Determine the start and end page numbers to display
            $start_page = max(1, $current_page - 2);
            $end_page = min($total_pages, $current_page + 2);
            
            // Adjust the start and end pages to ensure we always show 5 pages if possible
            if ($end_page - $start_page < 4) {
                $end_page = min($total_pages, $start_page + 4);
            }
            if ($end_page - $start_page < 4) {
                $start_page = max(1, $end_page - 4);
            }
            
            // Display the "Previous" link
            if ($current_page > 1) {
                echo '<a href="?page=' . ($current_page - 1) . '">&lt;</a>';
            }
            
            // Display the page number links
            for ($i = $start_page; $i <= $end_page; $i++) {
                if ($i == $current_page) {
                    echo '<a href="?page=' . $i . '" class="active">' . $i . '</a>';
                } else {
                    echo '<a href="?page=' . $i . '">' . $i . '</a>';
                }
            }
            
            // Display the "Next" link
            if ($current_page < $total_pages) {
                echo '<a href="?page=' . ($current_page + 1) . '">&gt;</a>';
            }
            ?>
        </div>
    </div>
    <?php $conn->close(); ?>
</body>
</html>