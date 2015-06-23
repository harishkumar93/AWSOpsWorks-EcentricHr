<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta http-equiv="X-UA-Compatible" content="IE=9">
<meta name="viewport" content="width=device-width, initial-scale=1.0">  
<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" />
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/fav.png">
<link href="<?php bloginfo('stylesheet_directory'); ?>/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/global.css" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/menu.css">
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/style-1.css" media="screen" />
<link href="<?php bloginfo('stylesheet_directory'); ?>/css/navbar-static-top.css" rel="stylesheet">
<link href="<?php bloginfo('stylesheet_directory'); ?>/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/css/main.css"/>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_directory'); ?>/css/current-openings.css" media="all" />

<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"> </script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/jquery.simpleSlider.js"> </script>
<script type="text/javascript">
	$(document).ready(function() {
		$('#simpleSlider').simpleSlider({
			interval: 2000,
			wantNav: true,
			navContainer: "#sliderContainer",
			pauseOnHover: true
		});
	});
</script>
<script type="text/javascript">
 function validate()
        {
         var text = $('#search').val();
         if($.trim(text) == ''){
          $('#error').html('Search cannot be empty!');
          return false;
         }else{
         $('#search-form').submit();
         }
        }
    </script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/superfish.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/easyaspie.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('nav').easyPie();
    });    
    </script> 

<!-- End HEAD section -->


</head>

<body>
<div id="main">
	<div class="header-wrapper">
        <div class="header-main">
        
        <!--------Header Start------->
          <div class="header">
                <a href="<?php echo get_site_url(); ?>"><div class="logo"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt="" width="123" height="44" border="0" /></div></a>
                <div class="top-textfld">
                  <div class="mail-icon"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/mail-icon.png" alt="" width="17" height="11" /></div>
                    <div class="mail-icon-text"><a style="color:#666666;"href="mailto:info@ecentrichr.com">info@ecentrichr.com</a></div>
<!--<form method="get" id="searchform" action="<?php bloginfo($cap = version_compare('2.2', $wp_version, '<') ? 'url' : 'home'); ?>">
						<p class="srch submit">
							<input type="text" class="srch-txt" value="<?php echo (isset($S)) ? wp_specialchars($s, 1) : ''; ?>" name="s" id="s" size="30" />
							<input type="submit" class="button"class="SE5_btn" id="searchsubmit" value="<?php _e('Search', 'SearchEverything'); ?>" />
						</p>
					</form>-->

<form action="<?php echo get_site_url(); ?>/search/?searchtext=" method="get" name="search-form" id="search-form" class="search">
                  <div class="search"><input class="textfld" type="text" name="search" id="search" value="<?php if(isset($_GET['search'])) echo $_GET['search']?>" style="width:100px;">
     <a href="javascript:void(o);" onclick="return validate();"><span class="search-btn"></span></a>
     </div>
     <span id="error" style="color:#F00;"></span>
                    </form>
                    <!--<div class="search"></div>-->
                </div>
          </div>
        <!--------Header End------->
        </div>
	</div>
    
	<!--------Menu Start------->
    <?php 
	$url = explode("/",$_SERVER['REQUEST_URI']);
//var_dump($url);
	//$r = $_SERVER['REQUEST_URI'];
	//echo $r;
	//echo $url[1];
	?>
    <div class="menu-wrapper">
 <nav class="applePie">
<div class="menubtn">Menu Button</div>
<ul id="nav">
	<li><a href="<?php echo get_site_url(); ?>" <?php if($url[1]==""){?> class="active" <?php } ?> >Home</a>
		
	</li>

	<li><a href="<?php echo get_site_url(); ?>/about-us/" <?php if($url[1]=="about-us"){?> class="active" <?php } ?>>About Us</a>
		<ul>
			<li><a href="<?php echo get_site_url(); ?>/about-us/company-overview/" style="color:#000; padding:10px;">Company Overview</a>
           
            </li>
			<li><a href="<?php echo get_site_url(); ?>/about-us/vision-mission/" style="color:#000; padding:10px;">Vision &amp; Mission</a></li>
			<li><a href="<?php echo get_site_url(); ?>/about-us/value-proposition/" style="color:#000; padding:10px;">Value Proposition</a></li>
            <li><a href="<?php echo get_site_url(); ?>/about-us/leadership/" style="color:#000; padding:10px;">Leadership</a></li>
		</ul>
	</li>

	<li><a href="<?php echo get_site_url(); ?>/services/" <?php if($url[1]=="services"){?> class="active" <?php } ?>>Services</a>
		<ul>
			<li><a href="<?php echo get_site_url(); ?>/services/it-talent-management/" style="color:#000; padding:10px;">IT Talent Management</a></li>
			<li><a href="<?php echo get_site_url(); ?>/services/it-staffing-solutions/" style="color:#000; padding:10px;">IT Staffing Solutions</a></li>
			<li><a href="<?php echo get_site_url(); ?>/services/permanent-recruitment/" style="color:#000; padding:10px;">Permanent Recruitment</a></li>
			<li><a href="<?php echo get_site_url(); ?>/services/general-staffing/" style="color:#000; padding:10px;">General Staffing</a></li>
		</ul>
	</li>
    <li><a href="<?php echo get_site_url(); ?>/careers/" <?php if($url[1]=="careers"){?> class="active" <?php } ?>>Careers</a>
		<ul>
			<li><a href="<?php echo get_site_url(); ?>/careers/our-culture/" style="color:#000; padding:10px;">Our Culture</a></li>
			<li><a href="<?php echo get_site_url(); ?>/careers/why-ecentric/" style="color:#000; padding:10px;">Why eCentric</a></li>
			<li><a href="<?php echo get_site_url(); ?>/careers/find-a-job/" style="color:#000; padding:10px;">Find a Job</a>
			<li><a href="<?php echo get_site_url(); ?>/careers/current-openings/" style="color:#000; padding:10px;">Current Openings</a></li>
		</ul>
	</li>
    <li><a href="<?php echo get_site_url(); ?>/sitemap/" <?php if($url[1]=="sitemap"){?> class="active" <?php } ?>>Sitemap</a></li>
    <li><a href="<?php echo get_site_url(); ?>/contact/" <?php if($url[1]=="contact"){?> class="active" <?php } ?>>Contact</a></li>
</ul>
</nav>
</div>