<!DOCTYPE html>

<style>
    .posts-cont {
        width: 100%;
        height: auto;
    }

    .posts-cont > div {
        width: auto;
        height: auto;
        background-color: rgb(245, 145, 10);
        box-shadow: 0.2em 0.2em 0.3em rgb(80, 80, 80);
        padding: 0.5em;
        margin: 0.5em;
        border-radius: 0.7em;
    }

    .posts-cont h2 {
        text-align: center;
    }

    .posts-cont h5 {
        text-align: center;
    }

    .posts-cont p {
        font-size: 12;
        text-align: center;
    }
</style>

<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>About</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- fonts -->
      <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Righteous&display=swap" rel="stylesheet">
      <!-- owl stylesheets --> 
      <link rel="stylesheet" href="css/owl.carousel.min.css">
      <link rel="stylesheet" href="css/owl.theme.default.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
         <div class="header_main">
            <div class="mobile_menu">
               <nav class="navbar navbar-expand-lg navbar-light bg-light">
                  <!-- <div class="logo_mobile"><a href="index.html"><img src="images/logo.png"></a></div> -->
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                     <ul class="navbar-nav">
                     <li class="nav-item">
                           <a class="nav-link" href="index.html">Home</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="about.html">About</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="viewposts_formatted.php">View Posts</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="createpost_formatted.php">Make Post</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="search_formatted.php">Search</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link " href="contact.html">Contact</a>
                        </li>
                     </ul>
                  </div>
               </nav>
            </div>
            <div class="container-fluid">
               <!-- <div class="logo"><a href="index.html"><img src="images/logo.png"></a></div> -->
               <div class="menu_main">
                  <ul>
                  <li class="active"><a href="index.html">Home</a></li>
                     <li><a href="about.html">About</a></li>
                     <li><a href="viewposts_formatted.php">View Posts</a></li>
                     <li><a href="createpost_formatted.php">Make Post</a></li>
                     <li><a href="search_formatted.php">Search</a></li>
                     <li><a href="contact.html">Contact us</a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <!-- header section end -->
      <!-- about section start -->
      <div class="about_section layout_padding">
         <div class="container">
            <h1 class="contact_taital">Search for Post</h1>
               <!-- <iframe style='padding-left:35%; padding-top=20%'; src="http://localhost:8080/search.php" style ="border:0px #fff none," name = "Rishabh's Frame" scrolling="no" frameborder="0" marginheight="0px" marginwidth="0px" height="50px" width="100%" allowfullscreen></iframe> -->
               <form action="search.php" method="GET" style="padding-left:19%">
                  <input type="text" name="columns" placeholder="'Author', 'Title', or 'Description'", style="width:300px">
			         <input type="text" name="query" placeholder="Query", style="width:300px">
			         <input type="submit" value="Search" style="width: 100px">
		         </form>
         </div>
            <div class="posts-cont">
                <h1 style="text-align: center; padding-top:2%;"><?php $posts=0; echo $posts != 0 ? "" : "No posts available"; ?></h1>
                <?php 
                    if(count($_GET) > 0) {			
                        include 'dbconnection.php';
                        $connec = connectPostsDB();

                        $sql_query = "SELECT * FROM posts WHERE " . $_GET["columns"] . " like '%" . $_GET["query"] . "%'";
                        $res = $connec->query($sql_query);

                        $posts_arr[] = (object) array();

                        if ($res->num_rows > 0) {
                            $i = 0;
                            while($row = $res->fetch_assoc()) {
                                $posts_obj = new stdClass();
                            
                                $posts_obj->id = $row["post_id"];
                                $posts_obj->title = $row["title"];
                                $posts_obj->author = $row["author"];

                                $posts_arr[$i] = $posts_obj;

                                $i++;
                            }
                        } else $posts_arr = 0;

                        $connec->close();
                            
                        $i = 0;

                        if($posts_arr != 0) {
                            echo "<h1>Results for posts with the " . $_GET["columns"] . " of \"" . $_GET["query"] . "\"</h1>";
                            echo "<div class='post-list-container'>";
                            while($i < count($posts_arr)) {
                                echo "<div class='post-card'>";
                                echo "<h2>{$posts_arr[$i]->title}</h2>";
                                echo "<h3 style=\"display: none\">{$posts_arr[$i]->id}</h3>";
                                echo "<div><p><strong>Title:</strong> {$posts_arr[$i]->title}</p>";
                                echo "<p>{$posts_arr[$i]->content}</p>";
                                echo "<p><strong>Author:</strong> {$posts_arr[$i]->author}</p></div>";				
                                $i++;
                            }
                            echo "</div>";
                        } else {
                            echo "<h1>No posts with the ". $_GET["columns"] . " of \"" . $_GET["query"] . "\"</h1>";
                        }
                    }
                ?>
            </div>
        </div>
      <!-- about section end -->
      <!-- footer section start -->
      <div class="footer_section layout_padding">
         <div class="container">
            <div class="input_btn_main">
               <input type="text" class="mail_text" placeholder="Enter your email" name="Enter your email">
               <div class="subscribe_bt"><a href="#">Subscribe</a></div>
            </div>
            <div class="location_main">
               <div class="call_text"><img src="images/call-icon.png"></div>
               <div class="call_text"><a href="#">Call +01 1234567890</a></div>
               <div class="call_text"><img src="images/mail-icon.png"></div>
               <div class="call_text"><a href="#">postit@gmail.com</a></div>
            </div>
            <div class="social_icon">
               <ul>
                  <li><a href="#"><img src="images/fb-icon.png"></a></li>
                  <li><a href="#"><img src="images/twitter-icon.png"></a></li>
                  <li><a href="#"><img src="images/linkedin-icon.png"></a></li>
                  <li><a href="#"><img src="images/instagram-icon.png"></a></li>
               </ul>
            </div>
         </div>
      </div>
      <!-- footer section end -->
      <!-- copyright section start -->
      <div class="copyright_section">
         <div class="container">
            <p class="copyright_text">2020 All Rights Reserved. Design by <a href="https://html.design">Free html  Templates</a></p>
         </div>
      </div>
      <!-- copyright section end -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/plugin.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <!-- javascript --> 
      <script src="js/owl.carousel.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>    
   </body>
</html>