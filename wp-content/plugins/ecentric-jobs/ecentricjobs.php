<?php
ob_start();
/*
Plugin Name: Jobs Module
Description: Posting and Showing a Job.
Version: 1.00
Author: Sathish Ravepati @ Taya Technologies Pvt Ltd.
*/

function admin_page()
{
	global $wpdb;
    $action = $_GET['action'];
    if(empty($_POST))
    {
    	if($action=="edit")
    		{
    			$id = $_GET['jobid'];
   				$query = $wpdb->get_results("SELECT * FROM wp_jobs where id=$id AND status!=0 order by id desc");
     		}
     	$title = $query[0]->job_title;
    	$jobType = $query[0]->job_type;     	
     	$expreience = $query[0]->job_experience;
    	$description = $query[0]->job_description;
     	$city = $query[0]->city;
?>
 	<div id="post-body-content">
 		<form method="post" id="job-post">
			<div id="main">
				<div class="spans">Ecentric Jobs</div>
					<div class="span6">
      					<label>Job Title <span style="color:#F00;">*</span></label>
      					<input type="text" name="job_title" id="job_title" class="input-block-level" placeholder="Jobs" value="<?php echo $title;?>">
     				</div>
     				<div class="span6">
						<label>Job Type <span style="color:#F00;">*</span></label>
						<select id="job_type" name="job_type" class="input-block-level">
							<option value="0">Select Job Type</option>
							<option value="1" <?php if(isset($jobType)){ if($jobType==1){ ?> selected="selected" <?php } }?>>Inhouse Jobs</option>
							<option value="2" <?php if(isset($jobType)){ if($jobType==2){ ?> selected="selected" <?php } }?>>Out source job</option>
						</select>
					</div>
                    <div class="span6">
	      				<label>Experience <span style="color:#F00;">*</span></label>
	     				<input type="text" name="job_experience" id="job_experience" class="input-block-level" placeholder="Title" value="<?php echo $expreience;?>">
     				</div>
     				<div class="span6">
					    <label>City <span style="color:#F00;">*</span></label>
					    <input type="text" name="city" id="city" class="input-block-level" placeholder="city" value="<?php echo $city;?>">
     				</div>
                    <div class="span6">
     					<label>Job Description <span style="color:#F00;">*</span></label>
     					<?php
     					$editor_settings = array('media_buttons' => false);
      					wp_editor($description,'job_description',$editor_settings); ?>
     				</div>
                    <div class="span6">
      					<input class="button" type="submit" value="Submit" onclick="return validate();"/>
     				</div>
				</div>
			</div>
    	</form>
	</div>
  	<?php 
  	}
  	else
  	{
   		$title = str_replace(' ','-',strtolower(trim($_POST['job_title'])));
	    if(isset($_GET['action']))
	    {
	    	$id = $_GET['jobid'];
	    	if($action=="edit")
	    	{
	     		$query = $wpdb->update('wp_jobs',
						array('job_title' => trim($_POST['job_title']),'job_type' => $_POST['job_type'],'job_experience' => trim($_POST['job_experience']),'city' => trim($_POST['city']),'job_description' => trim($_POST['job_description']),'permalink' => $title),array( 'id' => $id ));
	      	}
		}
		else
		{
		   $title = str_replace(' ','-',strtolower(trim($_POST['job_title'])));
		   $query = $wpdb->insert('wp_jobs', array('job_title' => trim($_POST['job_title']),'job_type' => $_POST['job_type'],'job_experience' => trim($_POST['job_experience']),'city' => trim($_POST['city']), 'job_description' => trim($_POST['job_description']),'permalink' => $title,'created_date' => date('Y-m-d H:i:s')));
	  	}
/*      echo $lastid = $wpdb->insert_id;
      exit;*/
  		wp_redirect(home_url('/wp-admin/admin.php?page=ecentric-list'));exit;
 	}
  
}
add_action( 'admin_footer', 'my_action_javascript' );

function my_action_javascript() 
{
?>
<script type="text/javascript" >
	jQuery(document).ready(function($) {
	$('.delete').click(function(){
		var conf = confirm('Are You sure want to delete this Job ?');
		if(conf){
		var id = $(this).attr('id');
		var data = {
		'action': 'my_action',
		'job_id': id
 		};
 	// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
 	$.post(ajaxurl, data, function(response) {
	   $('tr#'+id).remove();
	   $('span#deleted').html('Record Deleted Successfully');
 	});
}
else
{
  	return false;
}
 });
});
</script>
<?php
}


add_action( 'wp_ajax_my_action', 'my_action_callback' );

function my_action_callback() 
{
	global $wpdb; // this is how you get access to the database
	$job_id = intval( $_POST['job_id'] );
	$query = $wpdb->update('wp_jobs', array(
    'status' => 0),array( 'id' => $job_id ));
 	echo 'success';
 	die(); // this is required to return a proper result
}

function admin_listing_page()
{
    global $wpdb;
    $posturl = home_url('/wp-admin/admin.php?page=ecentric-jobs');
	$result = $wpdb->get_results("SELECT * FROM wp_jobs where status=1 ORDER BY created_date DESC");
    //var_dump($result);exit;
    if(count($result)!=0)
    {
	    foreach ($result as $key => $value) 
	    {
	    	$url = add_query_arg(array('action'=>'edit','jobid'=>$value->id,'page'=>'ecentric-jobs'));
if($value->job_type == 1){
	$jobtype = 'Inhouse';
}else{
	$jobtype = 'Outhouse';
}
	    	
			$tablerow .= "<tr class='tablerow' id='$value->id'><td class='tables1'>$value->job_title</td><td class='tables1'>$jobtype</td><td class='tables1'>$value->job_experience</td><td class='tables1'><a href='$url'>Edit</a> | <a href='javascript:void(0);' id='$value->id' class='delete'>Delete</a></td></tr>";
	  	}
  	}
  	else
  	{
  		//echo 'dfgdfg';exit;
		$tablerow .= "<tr class='tablerow'><td class='tables1' colspan='3'align='center' style='color:#F00'>No Records</td></tr>";  		
  	}
	    $message = <<<Message
		<div id="main">
			<span id='deleted' style='color:#F00;'></span>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px #f1f1f1 solid;">
				<tr>
	   				<td height="40" colspan="2" class="tables">Jobs<span class="span-class"><a href='$posturl'>Add New</a></span></td>
	    			<td class="tables">&nbsp;</td>
  				</tr>
  				<tr>
   					<td class="tables2">Job Title</td>
   					<td class="tables2">Job Type</td>
    				<td class="tables2">Experience</td>
    				<td class="tables2">Options</td>
  				</tr>
				$tablerow 
			</table>
		</div>
Message;
	echo $message;
}

/*function load_tiny_mce() {
      // The 'mode' and 'editor_selector' options are for adding
      // TinyMCE to any textarea with class="tinymce-textarea"
      wp_tiny_mce(false, array(
          'mode' => 'specific_textareas',
          'editor_selector' => 'tinymce-textarea'
     ));
  }*/

  // Salma code
  // Contact Display Form

  function contact_display_form()
{
	$message = <<<Message
	<div class="ourvalue1-1">
		<ul class="responsive-accordion responsive-accordion-default bm-larger">
			<li>
				<div class="responsive-accordion-head">Contact Us</div>
				<div class="responsive-accordion-panel ecentric_submit_form">
					<form method="post">
                        <label>Name&nbsp;<span style="color:red;">*</span></label>
                        <input type="text" class="lt-text-10" placeholder="* Please enter your name" name="ecentric_contact_name" id="ecentric_contact_name" onblur="this.placeholder='* Please enter your name';" />

                        <label>Email&nbsp;<span style="color:red;">*</span></label>
                        <input type="text" placeholder="* Please enter your email" class="lt-text-10" name="ecentric_contact_email" id="ecentric_contact_email" />

						<label>Comments&nbsp;<span style="color:red;">*</span></label>
                        <textarea class="lt-textarea-10" name="ecentric_contact_comments" id="ecentric_contact_comments" placeholder="* Please give us your comments"></textarea>

						<input type="submit" value="Submit" class="button" id="ecentric_contact_form" />
                    </form>
				</div>

				<div class="responsive-accordion-panel submit_form_success" style="display:none;"></div>
			</li>
		</ul>
	</div>
Message;

	return $message;
}
add_shortcode( contact_form, contact_display_form);

// Contact upload form
function contact_display_upload_form()
{
	$message = <<<Message
	<div class="ourvalue1-1">
		<ul class="responsive-accordion responsive-accordion-default bm-larger">
			<li>
				<div class="responsive-accordion-head">Share your details</div>
				<div class="responsive-accordion-panel ecentric_submit_form">
					<form id="ecentric_data" method="post" enctype="multipart/form-data">
                        <label>Name of the candidate&nbsp;<span style="color:red;">*</span></label>
                        <input type="text" class="lt-text-10" placeholder="* Please enter your name" name="ecentric_contact_name" id="ecentric_contact_name" onblur="this.placeholder='* Please enter your name';" />

                        <label>Location preferred&nbsp;<span style="color:red;">*</span></label>
                        <input type="text" placeholder="* Please enter your Preferred location" class="lt-text-10" name="ecentric_contact_location" id="ecentric_contact_location" />

                        			
						<label>Email&nbsp;<span style="color:red;">*</span></label>
                        <input type="text" placeholder="* Please enter your Email id" class="lt-text-10" name="ecentric_contact_email" id="ecentric_contact_email" />
						
						<label>Mobile&nbsp;<span style="color:red;">*</span></label>
                        <input type="text" placeholder="* Please enter your Mobile number" class="lt-text-10" name="ecentric_contact_mobile" id="ecentric_contact_mobile" />

                        <label>Expected salary</label>
                        <input type="text" placeholder="* Please enter your Expected Salary" class="lt-text-10" name="ecentric_contact_salary" id="ecentric_contact_salary" />

                        <label>Upload Resume</label>
                        <input type="file" name="ecentric_contact_resume" class="lt-text-10" id="ecentric_contact_resume" />

						<label>Your message</label>
                        <textarea class="lt-textarea-10" name="ecentric_contact_comments" id="ecentric_contact_comments" placeholder="* Please enter the message"></textarea>

						<input type="submit" value="Submit" class="button" id="ecentric_contact_upload_form" />
                    </form>
				</div>

				<div class="responsive-accordion-panel submit_form_success" style="display:none;"></div>
			</li>
		</ul>
	</div>
Message;

	return $message;
}

add_shortcode( contact_upload_form, contact_display_upload_form);

// Redirect to Job description page
function job_description()
{
	global $wpdb;
	$url = explode("/",$_SERVER['REQUEST_URI']);
	$id = explode("?",$url[3]);
	$result = $wpdb->get_results("SELECT * FROM wp_jobs where permalink='$id[1]'");
	foreach ($result as $key => $value) 
   	{
		$id = $value->id;
		$job_title = ucfirst($value->job_title); 
		$experience=$value->job_experience;
		$city=ucfirst($value->city); 
		$job_description=ucfirst($value->job_description); 
	}
 	$message = <<<Message
					<div class="contentt-block">
    					<p>
   						<div class="header-text-1">Job Description<a href="javascript:void(0);" onclick="history.go(-1);" id="goback"  style="font-size:12px; padding:0 0 0 315px; font-weight:normal; text-decoration:underline;">View all Jobs</a></div><br />
							<strong>Job Title :</strong> <span id="jobtitle">$job_title</span><br />
							<br />
							<strong>Experience :</strong> $experience <br />
							<br />
							<strong>Job Description :</strong> $job_description<br />
							<br />
							<strong>City :</strong> $city<br />
							<br />
						</div>
						</p>
Message;
return $message;
}
add_shortcode( jobdescription, job_description);

// Current Openeings
function current_openings_outsource()
{
      global $wpdb;
      $result = $wpdb->get_results("SELECT * FROM wp_jobs where status=1 AND job_type=2 order by id desc");
      $cnt = 1;
      if(count($result)!=0){
      foreach ($result as $key => $value) 
      {
          $id = $value->permalink;
          //$url = 'http://localhost/ecen/jobdescription/?jobid='."$id";
          $url = 'http://ecentrichr.com/careers/job/?'."$id";
          $postingdate=$value->created_date;
          //echo $postingdate;exit;
          $date=date('d-M-Y', strtotime($postingdate));
          if($cnt%2!=0){
          	$style='lightgreen';
          }else{
          	$style='';
          }
          $tablerow .= "<tr class='$style'><td width='100' align='center' valign='middle'>$cnt</td><td width='100' align='center' valign='middle'>$date</td><td width='100' align='center' valign='middle'>$value->job_title</td><td width='100' align='center' valign='middle'>$value->job_experience</td><td width='100' align='center' valign='middle'>$value->city</td><td width='100' align='center' valign='middle'><a href='$url'><img src='http://ecentrichr.com/wp-content/uploads/2014/05/icon.gif' width='16' height='16'>&nbsp;</a></td></tr>";
      	  $cnt++;
      }
  	}
  	else
  	{
  		$tablerow .= "<tr class='lightgreen'><td colspan='6'align='center' style='color:#F00'><strong>currently we are not hiring</strong></td></tr>";  		
  	}
          $message = <<<Message
                   <div class="body-block" style="min-height:250px;">
                        <div class="contentt-block" style="margin-top: 12px; min-width: 100% !important;">
                        	<p>
                        	<div class="header-text-1">All Jobs</div>
                        	<table cellspacing="1" cellpadding="0" border="0" class="register-pg">
          <tbody><tr class="headng">
              <th colspan="8" valign="top"><div align="left" style="float:left;">Jobs </div><div align="right"><a href="#" style="color:#FFF">View All</a></div></th>
          </tr> 
           
           <tr>
              <th width="100" align="center" valign="middle">S. No.</th>
             <th width="100" align="center" valign="middle">Posting Date</th>

                  <th width="100" align="center" valign="middle">Job Title </th>
              <th width="100" align="center" valign="middle">Experience (yrs.)</th>
             <th width="100" align="center" valign="middle">City</th>
             <th width="100" align="center" valign="middle">View &amp; Apply</th>
           </tr>

             						$tablerow
                         	</tbody></table> 
                         	</p>
                    </div>  
Message;
    return $message;
}
  
add_shortcode(outsource_openings,current_openings_outsource);

function current_openings_inhouse()
{
      global $wpdb;
      $result = $wpdb->get_results("SELECT * FROM wp_jobs where status=1 AND job_type=1 order by id desc");
      $cnt = 1;
      if(count($result)!=0){
      foreach ($result as $key => $value) 
      {
          $id = $value->permalink;
          //$url = 'http://localhost/ecen/jobdescription/?jobid='."$id";
          $url = 'http://ecentrichr.com/careers/job/?'."$id";
          $postingdate=$value->created_date;
          //echo $postingdate;exit;
          $date=date('d-M-Y', strtotime($postingdate));
          if($cnt%2!=0){
          	$style='lightgreen';
          }else{
          	$style='';
          }
          $tablerow .= "<tr class='$style'><td width='100' align='center' valign='middle'>$cnt</td><td width='100' align='center' valign='middle'>$date</td><td width='100' align='center' valign='middle'>$value->job_title</td><td width='100' align='center' valign='middle'>$value->job_experience</td><td width='100' align='center' valign='middle'>$value->city</td><td width='100' align='center' valign='middle'><a href='$url'><img src='http://ecentrichr.com/wp-content/uploads/2014/05/icon.gif' width='16' height='16'>&nbsp;</a></td></tr>";
      	  $cnt++;
      }
  	}
  	else
  	{
  		$tablerow .= "<tr class='lightgreen'><td colspan='6'align='center' style='color:#F00'><strong>currently we are not hiring</strong></td></tr>";  		
  	}
          $message = <<<Message
                   <div class="body-block" style="min-height:250px;">
                        <div class="contentt-block" style="margin-top: 12px; min-width: 100% !important;">
                        	<p>
                        	<div class="header-text-1">All Jobs</div>
                        	<table cellspacing="1" cellpadding="0" border="0" class="register-pg">
          <tbody><tr class="headng">
              <th colspan="8" valign="top"><div align="left" style="float:left;">Jobs </div><div align="right"><a href="#" style="color:#FFF">View All</a></div></th>
          </tr> 
           
           <tr>
              <th width="100" align="center" valign="middle">S. No.</th>
             <th width="100" align="center" valign="middle">Posting Date</th>

                  <th width="100" align="center" valign="middle">Job Title </th>
              <th width="100" align="center" valign="middle">Experience (yrs.)</th>
             <th width="100" align="center" valign="middle">City</th>
             <th width="100" align="center" valign="middle">View &amp; Apply</th>
           </tr>
             						$tablerow
                         	</tbody></table> 
                         	</p>
                    </div>  
Message;
    return $message;
}

  
add_shortcode(inhouse_openings,current_openings_inhouse);


function new_job()
{
  global $wpdb;
  $result = $wpdb->get_results("SELECT * FROM wp_jobs where status=1 AND job_type=2 order by id desc limit 0,3");
  $cnt = 1;
  if(count($result)!=0)
  { 
    foreach ($result as $key => $value) 
      {
        $id = $value->permalink;
        $url = 'http://ecentrichr.com/careers/job/?'."$id";
        $row .="<li><a href='$url'>$value->job_title</a></li>";
        $cnt++;
      }
  }
  else
  {
    $row .= "<strong align='center' style='color:#F00'>currently we are not hiring</strong>";      
  }
  $message = <<<Message
      <div class="ourvalue">
          <a href="http://ecentrichr.com/careers/current-openings/"><div class="header-text">Current Openings</div></a>
            <div class="ourvalue-text1">
              <ul>
              $row  
              </ul>
            </div><br />
              <br />
              <br />
              <br />
              <br />
              <br />
              <br />
              <a href="http://ecentrichr.com/careers/current-openings/" style="color:#000; padding: 0 0 0 5%;"><img src="http://ecentrichr.com/wp-content/uploads/2014/05/arrow.png">More</a>
       </div>
Message;
return $message;
}
add_shortcode( new_job_list, new_job);

function ecentric_admin_actions() {
	wp_enqueue_style( 'ecentric_stylesheet', plugins_url('css/css.css', __FILE__ ));
	wp_enqueue_style( 'ecentric_stylesheet', plugins_url('css/style.css', __FILE__ ));
	wp_enqueue_script( 'ecentric_script', plugins_url('js/sampletest.js', __FILE__));

    //add_menu_page(__('Ecentric Jobs','menu-test'), __('Ecentric Jobs','menu-test'), 'manage_options', 'ecentric-list', 'admin_listing_page');
    //add_menu_page(__('ecentric-list','menu-test'), __('Ecentric Jobs Post','menu-test'), 'manage_options', 'ecentric-jobs', 'admin_page');

    add_menu_page('Ecentric Jobs', 'Ecentric Jobs', 'manage_options', 'ecentric-list', 'admin_listing_page');
add_submenu_page( 'ecentric-list', 'Ecentric Jobs', 'Post Job', 'manage_options', 'ecentric-jobs', 'admin_page');

 // Register the script first.
//wp_register_script( 'some_handle', 'path/to/myscript.js' );

// Now we can localize the script with our data.
$translation_array = array( 'some_string' => __( site_url() ), 'a_value' => '10' );
wp_localize_script( 'ecentric_script', 'object_name', $translation_array );

// The script can be enqueued now or later.
//wp_enqueue_script( 'ecentric_script' );
}
 
add_action('admin_menu', 'ecentric_admin_actions');
add_shortcode( ecentric_all_jobs, getAllJobs);

/*add_action( 'ecentric-jobs', 'my_second_editor' );
function my_second_editor() {
	// get and set $content somehow...
	wp_editor( $content, 'ecentric-job-description' );
}*/

?>

