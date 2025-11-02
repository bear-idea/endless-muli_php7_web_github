<?php
/*********************************************************************
 # 版面框架
 *********************************************************************/
?>
<!-- TemplateBeginEditable name="head" -->
<!-- TemplateEndEditable -->

<div id="wrapper">
  <div id="header">
    <div id="context">
    	<!-- ╭─────────────────────────────────────╮ -->
		<?php include($TplPath . "/header.php"); ?>
        
    </div>
  </div>
  <div id="banner">
  	<div id="context">
    	<!-- ╭─────────────────────────────────────╮ -->
        <?php include($TplPath . "/banner.php"); ?>  
        
    </div>
  </div>
  <div id="Left_column"> 
  	<div id="context">
    	<!-- ╭─────────────────────────────────────╮ -->
		<!-- TemplateBeginEditable name="左選單" -->
   	  	<div style="background-color:#e3e3e3; padding:10px;" class="rounded {6px}"><br />
   	  	    <br />
   	  	    <br />
   	  	    <br />
            <br />
            <br />
   	  	</div>
		<!-- TemplateEndEditable -->
        
    </div>
  </div>
  <div id="Content_containter">
  	<div id="Main_content">
      <div id="context">
      	<!-- ╭─────────────────────────────────────╮ -->
      	<!-- TemplateBeginEditable name="主內容" -->
      	<?php include_once("../require_news.php"); ?>
      	<!-- TemplateEndEditable -->
      	
      </div>
  	</div>
    <div id="Rght_column">
      <div id="context">     
      	<!-- ╭─────────────────────────────────────╮ -->
        <!-- TemplateBeginEditable name="右選單" -->
     	<div style="background-color:#e3e3e3; padding:10px;" class="rounded {6px}">
  			<br /><br /><br /><br /> <br />
	 	</div>
        <!-- TemplateEndEditable --> 
        
      </div>
    </div>
  </div>
  <div id="footer">
  	<div id="context">
    	<!-- ╭─────────────────────────────────────╮ -->
        <?php include($TplPath . "/footer.php"); ?>
    	
    </div>
  </div>
</div>