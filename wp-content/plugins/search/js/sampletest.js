function validate(){
	//alert('here');
//return false;
	var title = jQuery("#job_title").val();
	var experience = jQuery("#job_experience").val();
	var flag = 0;

	jQuery("#job_title").removeClass('error');
	jQuery("#job_experience").removeClass('error');

	if(jQuery.trim(title)==''){
		jQuery("#job_title").addClass('error');
		flag = 1;
	}else{
		if(jQuery.trim(title).length<6 || jQuery.trim(title).length>200){
			jQuery("#job_title").addClass('error').attr('placeholder','Title should be min 6 characters and max 200 characters').val('');
			flag = 1;
		}
	}

	if(jQuery.trim(experience)==''){
		jQuery("#job_experience").addClass('error');
		flag = 1;
	}else{
		if(jQuery.trim(experience).length<4 || jQuery.trim(experience).length>200){
			jQuery("#job_experience").addClass('error').attr('placeholder','Title should be min 4 characters and max 200 characters').val('');
			flag = 1;
		}
	}
	if(flag==1){
		return false;
	}else{
		document.getElementById('job-post').submit();
	}
}

function edit(value){
	/*action = 'my_edit';
	global $wpdb;
	$result = $wpdb->get_results("SELECT * FROM wp_jobs where status="+value);
	echo "<pre>";
	print_r($result);
	exit;*/
	//var url = '<?php echo site_url();?>';
	//alert(object_name.some_string);
	window.location.href = object_name.some_string+'/wp-admin/admin.php?page=ecentric-jobs?id='+value;
	//header('Location: http://' . $pmr_options['mobile_url']);
	//return false;
}