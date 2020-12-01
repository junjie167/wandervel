
$(document).ready(function(){
	// When user clicks on submit comment to add comment under post
	$(document).on('click', '#submit_comment', function(e) {
		e.preventDefault();
		var comment_text = $('#comment_text').val();
		var id = $(this).attr("data-id");
		console.log(id);
                var count = parseInt($('#comments_count').text());
                count = count + 1;
		//var url = $('#comment_form').attr('action');
		// Stop executing if not value is entered
		console.log(count);
				if (comment_text === "" ) return;
		
		$.ajax({
			url: "function.php",
			type: "POST",
			data: {
				id: id,
				comment_text: comment_text,
				comment_posted: 1
			},      
			success: function(data){
				console.log(data);
				var response = JSON.parse(data);
                                console.log(comment_text);
				if (data === "error") {
					alert('There was an error adding comment. Please try again');
				} else {
					$('#comments-wrapper').prepend(response.comment);
					$('#comments_count').text(count); 
					$('#comment_text').val('');
                                        
				}
			}
                        
                 });       
	});
        var cId;
	// When user clicks on submit reply to add reply under comment
	$(document).on('click', '.reply-btn', function(e){
		e.preventDefault();
		// Get the comment id from the reply button's data-id attribute
		var comment_id = $(this).data('id');
                cId = comment_id;
                 console.log("Comment ID: " + comment_id);
                       console.log(cId);
		// show/hide the appropriate reply form (from the reply-btn (this), go to the parent element (comment-details)
		// and then its siblings which is a form element with id comment_reply_form_ + comment_id)
		$(this).parent().siblings('form#comment_reply_form_' + comment_id).toggle(500);
		$(document).on('click', '.submit-reply', function(e){
			e.stopImmediatePropagation();
                        e.preventDefault();
			// elements
			var reply_textarea = $(this).siblings('textarea'); // reply textarea element
			//var reply_text = $(this).siblings('textarea').val();
                        console.log("Comment2 ID: " + cId);
                        
                        var reply_text = $(this).siblings('textarea#reply_text_' + cId).val();
                        if(reply_text == ""){
                            alert('Please input your reply');
                            return false;
                        }
			//var url = $(this).parent().attr('action');
                        console.log(reply_text);
			$.ajax({
				url: "function.php",
				type: "POST",
				data: {
					comment_id: cId,
					reply_text: reply_text,
					reply_posted: 1
				},
				success: function(data){
					if (data === "error") {
						//alert('There was an error adding reply. Please try again');
					} else {
						$('.replies_wrapper_' + cId).append(data);
						//reply_textarea.val('');
                                                console.log(cId);
                                                console.log(data);
                                                $('#reply_text_' + cId).val("");
                                                $('#comment_reply_form_' + cId).toggle(500);
                                                //$('#reply_text_' + comment_id).();
                                                //$('#comment_reply_form_' + comment_id).hide();
					}
				}
			});
		});
	});
        
        
});



