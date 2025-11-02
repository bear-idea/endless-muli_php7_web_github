<style type="text/css">
.dealer_opt_list{
	padding: 5px;
	width: 100%;
	border: 1px solid #DDD;
	margin-top: 2px;
	margin-right: auto;
	margin-bottom: 2px;
	margin-left: auto;
}
</style>
<h4 class="classic-title"><span><?php echo $ModuleName['Dealer']; // 標題文字 ?></span></h4>

<div class="post-content">
                <br />
					<br />
                    <div class="dealer_opt_list"><strong>請選擇下列功能</strong></div>
                  <div class="dealer_opt_list"><span style="width:150px; display:inline-block;"><a href="dealer.php?wshop=<?php echo $_GET['wshop']; ?>&amp;Opt=accountpage&amp;tp=Dealer&amp;lang=<?php echo $_SESSION['lang'] ?>">修改帳號資料</a></span> <span style="color:#009900;">修改我的帳號資料</span></div>
                  <div class="dealer_opt_list"><span style="width:150px; display:inline-block;"><a href="dealer.php?wshop=<?php echo $_GET['wshop']; ?>&amp;Opt=editpage&amp;tp=Dealer&amp;lang=<?php echo $_SESSION['lang'] ?>">修改會員資料</a></span> <span style="color:#009900;">修改我的會員資料</span></div>
                    <div class="dealer_opt_list"><span style="width:150px; display:inline-block;"><a href="<?php echo $logoutAction ?>">登出</a></span> <span style="color:#009900;">登出系統</span></div>
                  <div class="dealer_opt_list">&nbsp;</div>
       
</div>
