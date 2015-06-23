<?php get_header();  
?>
<div class="content-wrapper">
<div class="content-main">
<?php
$url = explode("/",$_SERVER['REQUEST_URI']);
//echo($url[2] );
//var_dump($url);exit;
if($url[1]!=search)
{
?>
<div class="banner-nner">
 <?php 
the_post_thumbnail();?>
</div>
<div id="breadcrumbMenu">
<div class="breadcrumb">
<?php if ( function_exists('yoast_breadcrumb') ) {
	  yoast_breadcrumb();
	} ?>
</div>
</div>
<?php
}
while ( have_posts() ) : the_post(); ?>
	<?php the_content(); ?>
<?php endwhile; // end of the loop. ?>
</div>
</div>
<script>
$("#ecentric_contact_form").click(function(){
	$("#ecentric_contact_form").attr('disabled',true);
	var flag=0;

	$("#ecentric_contact_name").removeClass('error');
	$("#ecentric_contact_email").removeClass('error');
	$("#ecentric_contact_comments").removeClass('error');

	var name = $("#ecentric_contact_name").val();
	if($.trim(name)==''){
		$("#ecentric_contact_name").addClass('error').val('').attr('placeholder','* Please enter your name');
		flag=1;
	}else{
		var regex = /^([a-zA-Z])/;
  		if(!regex.test(name)){
  			$("#ecentric_contact_name").addClass('error').val('').attr('placeholder','* Please enter a valid name');	
  			flag = 1;
  		}
	}
	

	// email
	var email = $("#ecentric_contact_email").val();
	if($.trim(email)==''){
		$("#ecentric_contact_email").addClass('error');
		flag=1;
	}else{
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  		if(!regex.test(email)){
  			$("#ecentric_contact_email").addClass('error').val('').attr('placeholder','* Please enter a valid email');	
  			flag = 1;
  		}
	}

	var comments = $("#ecentric_contact_comments").val();
	if($.trim(comments)==''){
		$("#ecentric_contact_comments").addClass('error').val('').attr('placeholder','* Please enter your comments');
		flag=1;
	}

	if(flag==1){
		$("#ecentric_contact_form").attr('disabled',false);
		return false;
	}else{
		$.ajax({
        type:"POST",
        url:"http://ecentrichr.com/submitform.php",
        data: {"name":name,"email":email,"comments":comments},
        success: function(data)
        {
        	if(data){
        		$(".ecentric_submit_form").hide();
        		$(".submit_form_success").show().html('Thanks for contacting us, we will reach you soon !');
        	}
        }
      });
		return false;
	}
});

$("form#ecentric_data").submit(function(){
	var flag=0;
	$("#ecentric_contact_upload_form").attr('disabled',true);
	$("#ecentric_contact_name").removeClass('error');
	$("#ecentric_contact_location").removeClass('error');
	$("#ecentric_contact_email").removeClass('error');
	$("#ecentric_contact_mobile").removeClass('error');



	var title=$('#jobtitle').html();
//return false;

	var name = $("#ecentric_contact_name").val();
	if($.trim(name)==''){
		$("#ecentric_contact_name").addClass('error').val('').attr('placeholder','* Please enter your name');
		flag=1;
	}else{
		var regex = /^([a-zA-Z])/;
  		if(!regex.test(name)){
  			$("#ecentric_contact_name").addClass('error').val('').attr('placeholder','* Please enter a valid name');	
  			flag = 1;
  		}
	}



	var location = $("#ecentric_contact_location").val();
	if($.trim(location)==''){
		$("#ecentric_contact_location").addClass('error').val('').attr('placeholder','* Please enter Preferred location');
		flag=1;
	}else{
		var regex = /^([a-zA-Z])/;
  		if(!regex.test(location)){
  			$("#ecentric_contact_location").addClass('error').val('').attr('placeholder','* Please enter a valid location');	
  			flag = 1;
  		}
	}

	
	// email
	var email = $("#ecentric_contact_email").val();
	if($.trim(email)==''){
		$("#ecentric_contact_email").addClass('error');
		flag=1;
	}else{
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  		if(!regex.test(email)){
  			$("#ecentric_contact_email").addClass('error').val('').attr('placeholder','* Please enter a valid email');	
  			flag = 1;
  		}
	}
	
	
	// mobile
	var mobile = $("#ecentric_contact_mobile").val();
	if($.trim(mobile)==''){
		$("#ecentric_contact_mobile").addClass('error');
		flag=1;
	}else if($.trim(mobile).length<10 || $.trim(mobile).length>10){
		$("#ecentric_contact_mobile").addClass('error').attr('placeholder','Please enter a valid mobile number').val('');
		flag = 1;
	}
	else
	{
		var regex =  /^[0-9]+$/;
  		if(!regex.test(mobile)){
  			$("#ecentric_contact_mobile").addClass('error').val('').attr('placeholder','* Please enter a valid mobile number');	
  			flag = 1;
  		}
	}
	
    var formData = new FormData($(this)[0]);
	formData.append('title',title);
	if(flag==1){
		$("#ecentric_contact_upload_form").attr('disabled',false);
		return false;
	}else{
		$.ajax({
	        url:"http://ecentrichr.com/submituploadform.php",
	        type: 'POST',
	        data:formData,
	        async: false,
	        success: function (data) {
	            if(data){
	        		$(".ecentric_submit_form").hide();
	        		$(".submit_form_success").show().html('Thanks for contacting us, we will reach you soon !');
	        	}
	        },
	        cache: false,
	        contentType: false,
	        processData: false
	    });
	}
	    
    return false;
});


</script>
<style>
.error{
	border:1px solid #be4b49 !important; background-color: #FEEAEA;
}
.lt-text-10{
	padding-left: 5px;
	height:30px;
	width: 215px;
	margin-bottom: 10px;
}
.lt-textarea-10{
	padding: 5px;
	height:90px;
	width: 215px;
}
</style>



<?php get_footer(); ?>