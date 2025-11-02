<?php require_once('Connections/DB_Conn.php'); ?>
<?php if ($MSTMP == 'default') { ?>
<style type="text/css">
.dealer_opt_list{
	padding: 5px;
	width: 400px;
	border: 1px solid #DDD;
	margin-top: 2px;
	margin-right: auto;
	margin-bottom: 2px;
	margin-left: auto;
}
</style>
<div class="columns on-1">
  <div class="container">
            <div class="column">
                <div class="container ct_board">
                <h3><span class="titlesicon"><img src="images/dot_02.jpg" width="15" height="20" /></span>
                <?php echo $Lang_Content_Title_Dealer; // 標題文字 ?></h3>
                </div>
            </div>
        </div>        
</div>
<div class="columns on-1">
        <div class="container board">
          <div class="column">
                <div class="container ct_board" style="min-height:300px;">
                	<br />
					<br />
                    <div class="dealer_opt_list"><strong>請選擇下列功能</strong></div>
                  <div class="dealer_opt_list"><span style="width:150px; display:inline-block;"><a href="dealer.php?Opt=editpage&amp;tp=Dealer&amp;amplang=<?php echo $_SESSION['lang'] ?>">修改會員資料</a></span> <span style="color:#009900;">修改我的會員資料</span></div>
                    <div class="dealer_opt_list"><span style="width:150px; display:inline-block;"><a href="<?php echo $logoutAction ?>">登出</a></span> <span style="color:#009900;">登出系統</span></div>
                  <div class="dealer_opt_list">&nbsp;</div>
                </div>
            </div>
        </div>        
</div>
<?php } else { ?>
<?php include($TplPath . "/dealer_view.php"); ?>
<?php } ?>