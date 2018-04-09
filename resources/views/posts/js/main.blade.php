@push('scripts')
<script type="text/javascript">

	function view_post(id, allPosts){
		post = allPosts.map(function(item, index){
		     	if(item['id'] == id)
		     		return item;
        
    }).filter(function(item){return item;})[0];
		console.log(post);
		var uid ='<?php if(!Auth::guest()) echo  Auth::user()->id; else echo "hi" ;?>';
		console.log(uid);
		console.log(post.user_id);
		if(uid == post.user_id){
			$('#delete_post_btn').show();
			$('#edit_post_btn').show();
		}else{
			$('#delete_post_btn').hide();
			$('#edit_post_btn').hide();
		}
		$("#modal_cover_image").attr("src","/storage/cover_images/"+post.image_path);
		$("#post_title").html(post.title);
		$("#modal_body").html(post.body);
		$('#cover_image').hide();
		$("#author").html("Writen on " + post.created_at + ", by-"+  post.user_name);
		$("#id").val(id);
		$('#modalbtn').click();
	}
	function edit_post(e){
		e.preventDefault();
		var id = $("#id").val();
		var title = $("#post_title").text();
		var body = $("#modal_body").text();
		var author = $("#author").text();
		var src =$("#modal_cover_image").attr("src");
		//storring variable in lacal storage for validation purpose

			localStorage.setItem("title", title);
			localStorage.setItem("body", body);
			localStorage.setItem("src", src);
		$('#edit_post_id').val(id);
		$("#modal_cover_image_edit").attr("src", src);
		$("#edit_title").val(title).show();
		$("#modal_body_edit").html("<textarea id = \"modal_body_textarea\" name =\"textarea_body\" class=\"form-control\" rows=\"8\">"+body+"</textarea>");
		$("#author_edit").text(author);
		$("#edit_modalbtn").click();
		
	}
	function save_changes(e){
		e.preventDefault();
		var id = $("#edit_post_id").val();
		//var cover_image = $('#cover_image_edit')[0];
		var formData = new FormData($("#modify_post_edit")[0]);
		var title = $("#edit_title").val();
		var body = $("#modal_body_textarea").val();
		var image = $("#cover_image_edit");
		if(body != "" && title != ""){
			if(title != localStorage.getItem("title") || body !=localStorage.getItem("body") || image[0].files.length > 0){
				$.ajax({
					url: '{{ route('edit_post') }}',
					type: 'POST',
					headers: {
					  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					dataType: 'json',
					cache: false,
					contentType: false,
				    processData: false,
					data:formData,
					//data: {'id':id, 'title': title, 'body':body,'cover_image':cover_image,_token:'{{csrf_token()}}'},
					beforeSend:   function(){$('.loadingDiv').show();},
					success: function(data){
						if(data.status == 'success'){
							// $('#message').html('Post updated !').css('color', 'green');
							// $('#nobtn').click();
							// $('.loadingDiv').hide();
							location.relode();
						}
						  $('#message').html('Fail to updated post, Please try again !').css({"color":"red", "font-size":"150%"});
						  $('#nobtn').click();
						  $('.loadingDiv').hide();
						  setTimeout( function(){$('#message').hide();} , 3000);
					}
				})
				
			}
		}else{
			$("#blank_err").html("field should not be left blank..!!");

		}
	}

</script>
@endpush