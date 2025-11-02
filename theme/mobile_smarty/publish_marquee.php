<style type="text/css">
div#abgne_marquee{position:relative; overflow:hidden; width:100%; height:25px; border:0px solid #CCC; margin-top:5px; margin-bottom:5px; text-align:left}
div#abgne_marquee ul, div#abgne_marquee li{margin:0; padding:0; list-style:none}
div#abgne_marquee ul{position:absolute; left:30px; right:30px}
div#abgne_marquee ul li a{display:block; overflow:hidden; height:25px; line-height:25px; padding-left:0px; text-decoration:none}
div#abgne_marquee ul li.b1 a{background-position:5px 5px}
div#abgne_marquee ul li.b2 a{background-position:5px -15px}
div#abgne_marquee ul li.b3 a{background-position:5px -35px}
div#abgne_marquee div.marquee_btn{position:absolute; cursor:pointer}
div#abgne_marquee div#marquee_next_btn{left:5px}
div#abgne_marquee div#marquee_prev_btn{right:5px}
</style>
<script type="text/javascript">
$(function(){function g(){e=!e;var d=c.position().top/a,d=(k?d-h+b.length:d+h)%b.length;c.animate({top:d*a},l,function(){d+h>=2*(b.length/3)?c.css("top",b.length/3*a-a*(2*(b.length/3)-d)):d<b.length/3&&c.css("top",b.length/3*a+a*d);e=!e});f=setTimeout(g,j)}var c=$("div#abgne_marquee ul"),m=c.html(),a=-1*$("div#abgne_marquee").height(),l=600,f,j=3E3+l,k=0,e=!1,h=1;$("div#abgne_marquee").css("height",-1*a);$("div#abgne_marquee div.marquee_btn").css("top",-0*a/2);if(!(1>=c.children("li").length)){var b=
c.append(m+m).children();c.css("top",b.length/3*a);b.hover(function(){clearTimeout(f)},function(){f=setTimeout(g,j)});$("div#abgne_marquee .marquee_btn").click(function(){e||(clearTimeout(f),k="marquee_next_btn"==$(this).attr("id")?0:1,g())});f=setTimeout(g,j);$("a").focus(function(){this.blur()})}});
</script>
	
<div id="abgne_marquee">
		<div class="marquee_btn" id="marquee_next_btn"><i class="fa fa-chevron-circle-down" style="line-height:25px; font-size:24px"></i></div>
		<ul>
			<?php do { ?>
			<li><a href="<?php echo $SiteBaseUrl . url_rewrite("publish",array('wshop'=>$_GET['wshop'],'lang'=>$_SESSION['lang'],'Opt'=>'detailed','id'=>$row_RecordPublishMarquee['id']),'',$UrlWriteEnable);?>"><?php 
		  #
		  # ============== [if] ============== #
		  #
		  # 判斷是否顯示分類項目
 		  if($row_RecordPublishMarquee['type'] != "" && isset($_GET['searchkey'])) { 
		  ?>
          <span class="TipTypeStyle">[<?php echo highLight($row_RecordPublishMarquee['type'], @$_GET['searchkey'], $HighlightSelect); ?>]</span> 
     	  <?php 
		  } 
		  #
		  # ============== [/if] ============== #
		  ?><?php echo $row_RecordPublishMarquee['title']; ?></a></li>
			<?php } while ($row_RecordPublishMarquee = mysqli_fetch_assoc($RecordPublishMarquee)); ?>
</ul>
		<div class="marquee_btn" id="marquee_prev_btn"><i class="fa fa-chevron-circle-up" style="line-height:25px; font-size:24px"></i></div>
	</div>
