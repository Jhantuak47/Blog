@push('scripts')
<script type="text/javascript">

	function view_post(id, allPosts){
		post = allPosts.map(function(item, index){
		     	if(item['id'] == id)
		     		return item;
        
    }).filter(function(item){return item;})[0];
		console.log(post);
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
		console.log('inside edit post');
		var id = $("#id").val();
		var title = $("#post_title").text();
		var body = $("#modal_body").text();
		var author = $("#author").text();
		var src =$("#modal_cover_image").attr("src"); 
		$("#modal_cover_image_edit").attr("src", src);
		$("#edit_title").val(title).show();
		$("#modal_body_edit").html("<textarea class=\"form-control\" rows=\"8\">"+body+"</textarea>");
		$("#author_edit").text(author);
		$("#edi_modalbtn").click();
		
	}
	function save_changes(e){
		e.preventDefault();
		console.log('form save changes');
	}

</script>
@endpush