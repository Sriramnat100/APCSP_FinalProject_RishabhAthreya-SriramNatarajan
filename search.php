<div>
	<h3>Posts</h3>
	</div>
	<ul>
		<li>Post</li>
		<li>Search</li>
	</ul>
</nav>
<h1 class="title">Search for Post</h1>
<div class="form-container">
	<form action="search.php" method="GET">
		<select name="columns">
			<option value="title">Title</option>
			<option value="content">Description</option>
			<option value="author">Author</option>
		</select>
		<input type="text" name="query" placeholder="Query">
		<input type="submit" value="Search">
	</form>
</div>

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
