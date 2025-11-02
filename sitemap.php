<?php require_once('Connections/DB_Conn.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  Global $DB_Conn;
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = mysqli_real_escape_string($DB_Conn, $theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<link rel="stylesheet" type="text/css" media="screen, print" href="css/slickmap.css" />
<div class="sitemap">
        <ul id="primaryNav" class="col6">
        <li id="home"><a href="http://sitetitle.com">Home</a></li>
    <?php require("leftmenu_dftype.php"); ?>
</ul>
</div>
<div class="sitemap">
		

		<ul id="primaryNav" class="col4">
			<li id="home"><a href="http://sitetitle.com">Home</a></li>
			<li><a href="/about">About Us</a>
				<ul>
					<li><a href="/history">Our History</a></li>
					<li><a href="/mission">Mission Statement</a></li>
					<li><a href="/principals">Principals</a></li>
				</ul>
			</li>
			<li><a href="/services">Services</a>
				<ul>
					<li><a href="/services/design">Graphic Design</a></li>
					<li><a href="/services/development">Web Development</a></li>
					<li><a href="/services/marketing">Internet Marketing</a>
						<ul>
							<li><a href="/social-media">Social Media</a></li>
							<li><a href="/optimization">Search Optimization</a></li>
							<li><a href="/adwords">Google AdWords</a></li>
						</ul>
					</li>
					<li><a href="/services/copywriting">Copywriting</a></li>
					<li><a href="/services/photography">Photography</a></li>
				</ul>
			</li>
			<li><a href="/projects">Projects</a>
				<ul>
					<li><a href="/projects/finance">Finance</a></li>
					<li><a href="/projects/medical">Medical</a></li>
					<li><a href="/projects/education">Education</a></li>
					<li><a href="/projects/professional">Professional</a></li>
					<li><a href="/projects/industrial">Industrial</a></li>
					<li><a href="/projects/commercial">Commercial</a></li>	
					<li><a href="/projects/energy">Energy</a></li>
				</ul>
			</li>
			<li><a href="/contact">Contact</a>
				<ul>
					<li><a href="/contact/offices">Offices</a>
						<ul>
							<li><a href="contact/map">Map</a></li>
							<li><a href="contact/form">Contact Form</a></li>
						</ul>
					</li>
				</ul>
			</li>	
		</ul>

	</div>
