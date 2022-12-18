<style>
    .posts-cont {
        width: 100%;
        height: auto;
    }

    .posts-cont > div {
        width: auto;
        height: auto;
        background-color: rgb(190, 190, 190);
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
        font-size: 0.3em;
        text-align: center;
    }
</style>

<?php
include 'dbconnection.php';
$connec = connectPostsDB();

$sql_query = "SELECT * FROM posts";
		$response = $connec->query($sql_query);

		$posts[] = (object) array();

		if ($response->num_rows > 0) {
			$i = 0;
			while($row = $response->fetch_assoc()) {
				// echo "id: " . $row["movie_id"]. " - title: " . $row["title"] . " - genre: " . $row["genre"]. "<br />";
				$post_obj = new stdClass();
			
				$post_obj->id = $row["post_id"];
				$post_obj->title = $row["title"];
				$post_obj->content = $row["content"];
				$post_obj->author = $row["author"];

				$posts[$i] = $post_obj;

				$i++;
			}
} else
    $posts = 0;

		$connec->close();
?>

<div class="posts-cont">
    <h1 style="text-align: center;"><?php echo $posts != 0 ? "Posts: " : "No posts available"; ?></h1>
    <?php 
        $j = 0;
        if($posts != 0) {
            while($j < count($posts)) {
                echo "<div>";
                echo "<h2>{$posts[$j]->title}</h2>";
                echo "<h3 style=\"display: none\">{$posts[$j]->id}</h3>";
                echo "<h5>{$posts[$j]->content}</h5>";
                echo "<p>By: {$posts[$j]->author}</p>";
                echo "</div>";
                // echo "<br/>";
    
                $j++;
            }
        }
    ?>
</div>
