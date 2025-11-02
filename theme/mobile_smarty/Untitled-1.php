<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/jquery-ui.css" />
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.js"></script>
    <title>Test</title>
   <script type="text/javascript"> 
  var setChecked = function(oThis) {
    setTimeout(function(){
      $(oThis).attr("checked","checked");
     },10);
  };
  $(function() { 
    $("#accordion").accordion({ 
      collapsible: false ,
      change: function(event, ui) { 
        setChecked ($("input",ui.newHeader)); }
    });  
    $("#accordion h3 input").css("margin-left","50px");  
    $("#accordion h3 input").eq(0).attr("checked","checked");
  }); 
  
</script>   
  </head>
  <body>
<div id="accordion"> 
       <h3>
         <input type='radio' name='sel' value='1'  onclick='setChecked (this);' /> Section 1</h3> 
             <div> <p>test 1</p> </div> 
       <h3><input type='radio' name='sel' value='2'  onclick='setChecked (this);'/>Section 2</h3> 
             <div> <p>test 2</p> 
 </div> 

  </body>
</html>