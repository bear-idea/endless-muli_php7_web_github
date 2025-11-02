<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
</head>

<body>
	<link href="assets/plugins/font-awesome/5.6/css/fontawesome-all.min.css" rel="stylesheet" />
	<script src="assets/plugins/jquery/jquery-3.3.1.min.js"></script>
	
	<div class="widget-body">  
    <div class="clone_main">           
        <div class="form-group">  
            <label class="col-sm-3 control-label no-padding-right"> </label>  
            <div class="col-sm-9">  
                <span class="input-icon">  
                    <select id="switch_t_language" name="tl">  
                        <option value="en">English</option>           
                        <option value="zh-CN">Chinese(Simplified)</option>    
                        <option value="zh-TW">Chinese(Traditional)</option>        
                        <option value="ja">Japanese</option>         
                        <option value="ko">Korean</option>           
                    </select>  
                </span>  
                <span class="input-icon">                                               
                    <i class="icon-comment green"></i>  
                    <input type="text" id="message" name="message" style="width:500px;" placeholder="Send Messages...">  
                </span>  
                <a href="javascript:;" class="btn btn-link dictpush-plus" >  
                    <i class="fa fa-plus green"></i>  
                </a>  
                <span id="message_span"></span>  
            </div>  
        </div>  
    </div>  
</div>  

<script>
	$(function(){         
    //add row  
    $(".dictpush-plus").click(function(){  
        if($(this).hasClass("dictpush-plus")){//这个是添加一组元素的  
            $(this).parents(".form-group").clone(true).appendTo($(".clone_main"));  
            $(this).children().removeClass("fa-plus").removeClass("green").addClass("fa-minus").addClass("red");  
            $(this).removeClass("dictpush-plus").addClass("dictpush-minus");  
        }else if($(this).hasClass("dictpush-minus")){//这个判断是为了删除元素用的，不能用bind或者click的方法，试了都不行  
            $(this).parents(".form-group").remove();  
        }  
    });  
});  

 
	</script>
	
	
	
</body>
</html>