function validate(){
 var title = jQuery("#job_title").val();
 var jobtype = jQuery("#job_type").val();
 var experience = jQuery("#job_experience").val();
 var city = jQuery("#city").val();
 var description = jQuery("#job_description").val();
 var flag = 0;

 jQuery("#job_title").removeClass('error');
 jQuery("#job_type").removeClass('error');
 jQuery("#job_experience").removeClass('error');
 jQuery("#city").removeClass('error');
 jQuery("#job_description").removeClass('error');

 if(jQuery.trim(title)==''){
  jQuery("#job_title").addClass('error').attr('placeholder','Title can not be empty!');;
  flag = 1;
 }else{
  if(jQuery.trim(title).length<6 || jQuery.trim(title).length>100){
   jQuery("#job_title").addClass('error').attr('placeholder','Title should be min 6 characters and max 100 characters').val('');
   flag = 1;
  }
 }
 
 if(jQuery.trim(jobtype)==0){
  jQuery("#job_type").addClass('error');
  flag = 1;
 }

 if(jQuery.trim(experience)==''){
  jQuery("#job_experience").addClass('error').attr('placeholder','Experience can not be empty!');;
  flag = 1;
 }else{
  if(jQuery.trim(experience).length<4 || jQuery.trim(experience).length>50){
   jQuery("#job_experience").addClass('error').attr('placeholder','Experience should be min 4 characters and max 50 characters').val('');
   flag = 1;
  }
 }
 if(jQuery.trim(city)==''){
  jQuery("#city").addClass('error').attr('placeholder','City can not be empty!');
  flag = 1;
 }else{
  if(jQuery.trim(city).length<3 || jQuery.trim(city).length>50){
   jQuery("#city").addClass('error').attr('placeholder','City should be min 3 characters and max 50 characters').val('');
   flag = 1;
  }
 }
 if(jQuery.trim(description)==''){
  jQuery("#job_description").addClass('error').attr('placeholder','Job description can not be empty!');
  flag = 1;
 }else{
  if(jQuery.trim(description).length<10 || jQuery.trim(description).length>1000){
   jQuery("#job_description").addClass('error').attr('placeholder','Job description should be min 10 characters and max 1000 characters').val('');
   flag = 1;
  }
 }
 if(flag==1){
  return false;
 }else{
  document.getElementById('job-post').submit();
 }
}