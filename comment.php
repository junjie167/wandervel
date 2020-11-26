<?php include('functions.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/comment.css">
</head>
<body>
<div class="container">
	<div class="row">
            <div class="col-md-6 col-md-offset-3 comments-section" id="comment_list">
				<form class="clearfix" action="comment.php" method="post" id="comment_form">
					<textarea name="comment_text" id="comment_text" class="form-control" cols="30" rows="3"></textarea>
					<button class="btn btn-primary btn-sm pull-right" id="submit_comment">Submit comment</button>
				</form>
                        <h2><span id="comments_count"><?php echo count($comments) ?></span> Comment(s)</h2>
			<hr>
			<!-- comments wrapper -->
			<div id="comments-wrapper">
			<?php if (isset($comments)): ?>
				<!-- Display comments -->
				<?php foreach ($comments as $comment): ?>
				<!-- comment -->
				<div class="comment clearfix">
					<img src="<?php echo getCUserPicById($comment['comment_id']) ?>" alt="" class="profile_pic">
					<div class="comment-details">
						<span class="comment-name"><?php echo getUsernameById($comment['user_id']) ?></span>
						<span class="comment-date"><?php echo date("F j, Y, g:i a", strtotime($comment["comment_date"])); ?></span>
						<p><?php echo $comment['comment']; ?></p>
						<a class="reply-btn" href="#" data-id="<?php echo $comment['comment_id']; ?>">reply</a>
					</div>
					<!-- reply form -->
					<form action="comment.php" class="reply_form clearfix" id="comment_reply_form_<?php echo $comment['comment_id'] ?>" data-id="<?php echo $comment['comment_id']; ?>">
						<textarea class="form-control" name="reply_text" id="reply_text" cols="30" rows="2"></textarea>
						<button class="btn btn-primary btn-xs pull-right submit-reply" id="btn_submit" >Submit reply</button>
					</form>

					<!-- GET ALL REPLIES -->
					<?php $replies = getRepliesByCommentId($comment['comment_id']) ?>
					<div class="replies_wrapper_<?php echo $comment['comment_id']; ?>">
						<?php if (isset($replies)): ?>
							<?php foreach ($replies as $reply): ?>
								<!-- reply -->
								<div class="comment reply clearfix">
									<img src="<?php echo getRUserPicById($reply['reply_id']) ?>" alt="" class="profile_pic">
									<div class="comment-details">
										<span class="comment-name"><?php echo getUsernameById($reply['user_id']) ?></span>
										<span class="comment-date"><?php echo date("F j, Y, g:i a", strtotime($reply["reply_date"])); ?></span>
										<p><?php echo $reply['reply']; ?></p>
									</div>
								</div>
							<?php endforeach ?>
						<?php endif ?>
					</div>
				</div>
					<!-- // comment -->
				<?php endforeach ?>
			<?php else: ?>
				<h2>Be the first to comment on this post</h2>
			<?php endif ?>
			</div><!-- comments wrapper -->
		</div><!-- // all comments -->
	</div>
</div>
<!-- Javascripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Bootstrap Javascript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="js/scripts.js"></script>
</body>
</html>