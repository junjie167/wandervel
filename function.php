<?php 
		session_start();
		
        $config = parse_ini_file($_SERVER["DOCUMENT_ROOT"].'/../private/db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
        // Check connection    
        if ($conn->connect_error)    {        
            $errorMsg = "Connection failed: " . $conn->connect_error;        
            $success = false;    

        }
        
$result = mysqli_query($conn, "SELECT user_id FROM user WHERE email=" .$_SESSION['email'] . "");
//$user_id = mysqli_fetch_assoc($result)['user_id'];
                
		$user_id = 4;
        $errorMsg = "";
        //$post_id = 90;
        $post_id = $_GET["id"];
        date_default_timezone_set('Asia/Singapore');
        
	// connect to database
        
        // get post with id from database
	$post_query_result = mysqli_query($conn, "SELECT * FROM post WHERE post_id=". $post_id ."" );
	$post = mysqli_fetch_assoc($post_query_result);

	// Get all comments from database
	$comments_query_result = mysqli_query($conn, "SELECT * FROM comment WHERE post_id=" . $post_id . " ORDER BY comment_date DESC");
	$comments = mysqli_fetch_all($comments_query_result, MYSQLI_ASSOC);
	
	// Receives a user id and returns the username
	function getUsernameById($id)
	{
		global $conn;
		$result = mysqli_query($conn, "SELECT name FROM user WHERE user_id=" . $id . " LIMIT 1");
		// return the username
		return mysqli_fetch_assoc($result)['name'];
	}
        
        function getCommentsCountByPostId($post_id)
	{
		global $db;
		$result = mysqli_query($db, "SELECT COUNT(*) AS total FROM comment");
		$data = mysqli_fetch_assoc($result);
		return $data['total'];
	}
        
        //Get Comment user pic
        function getCUserPicById($id)
	{
		global $conn;
		$result = mysqli_query($conn, "SELECT profile_picture FROM user u INNER JOIN comment c on u.user_id = c.user_id WHERE comment_id=" . $id . "");
		// return the username
		return mysqli_fetch_assoc($result)['profile_picture'];
	}
        
        //Get reply user pic
        function getRUserPicById($id)
	{
		global $conn;
		$result = mysqli_query($conn, "SELECT profile_picture FROM user u INNER JOIN replies r on u.user_id = r.user_id WHERE reply_id=" . $id . "");
		// return the username
		return mysqli_fetch_assoc($result)['profile_picture'];
	}
        
	// Receives a comment id and returns the username
	function getRepliesByCommentId($id)
	{
		global $conn;
		$result = mysqli_query($conn, "SELECT * FROM replies WHERE comment_id=" .$id."");
		$replies = mysqli_fetch_all($result, MYSQLI_ASSOC);
		return $replies;
	}
        
        // If the user clicked submit on comment form...
if (isset($_POST['comment_posted'])) {
	global $conn;
	// grab the comment that was submitted through Ajax call
	$comment_text = $_POST['comment_text'];
        $today = date("F j, Y, g:i a");
	// insert comment into database
		$p_id = $_POST['id'];
        $stmt = $conn->prepare("INSERT INTO comment (post_id, user_id, comment, comment_date) VALUES (?, ?, ?, ?)");           
		$stmt->bind_param("isss", $p_id, $user_id, $comment_text, $today);
		
        
	// if insert was successful, get that same comment from the database and return it
        if (!$stmt->execute()) {
			echo "Unable to insert to db in function";    
			// echo "hello";
            exit(); 
        } else{
            $res = mysqli_query($conn, "SELECT * FROM comment ORDER BY comment_id DESC LIMIT 1");
            $inserted_comment = mysqli_fetch_assoc($res);
            $comment = "<div class='comment clearfix'>
					<img src=". getCUserPicById($inserted_comment['comment_id']) . " alt='' class='profile_pic'>
					<div class='comment-details'>
						<span class='comment-name'>" . getUsernameById($inserted_comment['user_id']) . "</span>
						<span class='comment-date'>" . date('F j, Y, g:i a', strtotime($inserted_comment['comment_date'])) . "</span>
						<p>" . $inserted_comment['comment'] . "</p>
						<a class='reply-btn' href='#' data-id='" . $inserted_comment['comment_id'] . "'>reply</a>
					</div>
					<!-- reply form -->
					<form action='post_details.php' class='reply_form clearfix' id='comment_reply_form_" . $inserted_comment['comment_id'] . "' data-id='" . $inserted_comment['comment_id'] . "'>
						<textarea class='form-control' name='reply_text' id='reply_text' cols='30' rows='2'></textarea>
						<button class='btn btn-primary btn-xs pull-right submit-reply'>Submit reply</button>
					</form>
				</div>";
		$comment_info = array(
			'comment' => $comment,
			'comments_count' => getCommentsCountByPostId($post_id)
		);
		echo json_encode($comment_info);
                
		exit();
        }
		
	
}
// If the user clicked submit on reply form...
if (isset($_POST['reply_posted'])) {
	global $conn;
	// grab the reply that was submitted through Ajax call
	$reply_text = $_POST['reply_text']; 
	$comment_id = $_POST['comment_id']; 
        $today = date("F j, Y, g:i a");
	// insert reply into database
        $stmt = $conn->prepare("INSERT INTO replies (user_id, comment_id, reply, reply_date) VALUES (?, ?, ?, ?)");           
        $stmt->bind_param("ssss", $user_id, $comment_id, $reply_text, $today);
	// if insert was successful, get that same reply from the database and return it
	if (!$stmt->execute()) {
		echo "error";
		exit();
        } else{
            $res = mysqli_query($conn, "SELECT * FROM replies ORDER BY reply_id DESC LIMIT 1");
            $inserted_reply = mysqli_fetch_assoc($res);
            $reply = "<div class='comment reply clearfix'>
					<img src='". getRUserPicById($inserted_reply['reply_id']) . "' alt='' class='profile_pic'>
					<div class='comment-details'>
						<span class='comment-name'>" . getUsernameById($inserted_reply['user_id']) . "</span>
						<span class='comment-date'>" . date('F j, Y, g:i a', strtotime($inserted_reply['reply_date'])) . "</span>
						<p>" . $inserted_reply['reply'] . "</p>
						
					</div>
				</div>";
		echo $reply;
                //$("comment_reply_form_" + comment_id) "hide";
		exit();
        }
		
	
}