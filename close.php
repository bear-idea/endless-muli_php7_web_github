<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title>後台管理系統</title>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src=".js/jquery-ui-1.10.1.custom.min.js"></script>
<script type="text/javascript" src="js/minwt.auto_full_height.mini.js"></script>
<link rel="stylesheet" type="text/css" href="admin/css/stickynotes/styles.css" />
<link rel="stylesheet" type="text/css" href="css/fancybox/jquery.fancybox-1.2.6.css" media="screen" />
<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.2.6.pack.js"></script>
<script type="text/javascript">
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
</script>
<!-- [ reflection End ] -->
<!--[if IE 6]>
<script type="text/javascript" src="js/iepngfix_tilebg.js"></script> 
<![endif]-->

<link href="admin/css/incstyle.css" rel="stylesheet" type="text/css" />
<link href="admin/css/styleless.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body {
	background-image:url(images/home/body-bg.gif);
}
#wrapper {
	background-image: none;
}

#wrapper #header #context{
}
#wrapper #Left_column {
	width: 0px;
	float: left;
}
#wrapper #Content_containter #Main_content #context {
	/*height: 200px;*/
	margin-left: 0px;
}

#wrapper #Content_containter #Main_content #context {
	background-image: none;
}

</style>
</head>
<body class="loginbody">
<div id="wrapper">
  <div id="header">
    <div id="context" _height="none">
    	
         
    </div>
  </div>
  <div id="banner_login">
  	<div id="context">
    	
        
    </div>
  </div>
  <div id="Left_column" style="width:0px;"> 
  	<div id="context" >
    	
	 
	  
    </div>
  </div>
  <div id="Content_containter">
  	<div id="Main_content" _height="auto">
      <div id="context">
      	
		<br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
        <form id="ADlogin" name="ADlogin" method="POST" action="<?php echo $loginFormAction; ?>">
         <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td colspan="4" align="center" valign="middle" class="TipBrowser"><img src="images/closed.png" width="429" height="297" />。</td>
          </tr>
          <tr>
            <td align="center" valign="middle">&nbsp;</td>
            <td width="53">&nbsp;</td>
            <td width="104">&nbsp;</td>
            <td width="80" class="noimpword">&nbsp;</td>
          </tr>
         </table>
        </form>

      </div>
  	</div>
    <div id="Rght_column">
      <div id="context">     
       

      </div>
    </div>
  </div>
  <div id="footer">
  	<div id="context" _height="none">
       <?php //require_once("require_manage_footer.php"); ?>
    </div>
  </div>
</div>
</body>
</html>