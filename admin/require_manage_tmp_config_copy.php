<div>
    <div>
        
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style02">
          <tr>
            <td><h5><strong><font color="#756b5b">樣板複製 [<?php echo $langname; ?>編輯介面]</font></strong></h5></td>
        </tr>
      </table>
      
      
      
      <form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form_Tmp" id="form_Tmp">
              <table width="100%" border="0" cellspacing="0" cellpadding="0" class="TB_General_style01">
                  <tr>
                    <td>
                    <div style="width:100%;">
                    	<div style="width:800px; padding:10px; color:#090;">
                       	  <p>此操作將會以您目前所選取的版面為基礎複製下來。<br />
                       	    複製下來的樣板會抓取原先的設定值。<br />
                       	    另外複製出來的樣板中原先的 <span style="color:#900;">Logo</span> 和 <span style="color:#900;">橫幅部分</span> 並不會複製下來。<br />
                       	    而在複製出來的樣板中，<span style="color:#900;">背景、外框、主選單、側邊裝飾外框、側邊選單</span>皆為獨立的。<br />
                       	    若這些獨立區塊非自己上傳，則原先設計者若有更動則會影響您的版面。<br />
                            但您可以在複製之後替換您所要置換的區塊作修改。
                            <br />
                            此功能僅提供方便修改之用!!
                       	  </p>
                    	</div>
                    </div>
                    </td>
               	  </tr>
                  <tr>
      <td>
        <input type="submit" name="button" id="button" value="送出填寫資料" />
        <input type="reset" name="button2" id="button2" value="重置填寫資料" />
        <input name="tmpbodyselect" type="hidden" id="tmpbodyselect" value="<?php echo $row_RecordTmp['tmpbodyselect']; ?>" />
        <input name="tmpwordcolor" type="hidden" id="hiddenField" value="<?php echo $row_RecordTmp['tmpwordcolor']; ?>" />
        <input name="tmpwordsize" type="hidden" id="hiddenField2" value="<?php echo $row_RecordTmp['tmpwordsize'] ?>" />
        <input name="tmplink" type="hidden" id="tmplink" value="<?php echo $row_RecordTmp['tmplink'] ?>" />
        <input name="tmplinkvisit" type="hidden" id="tmplinkvisit" value="<?php echo $row_RecordTmp['tmplinkvisit'] ?>" />
        <input name="tmplinkhover" type="hidden" id="tmplinkhover" value="<?php echo $row_RecordTmp['tmplinkhover'] ?>" />
        <input name="tmplogomargintop" type="hidden" id="tmplogomargintop" value="<?php echo $row_RecordTmp['tmplogomargintop'] ?>" />
        <input name="tmplogomarginleft" type="hidden" id="tmplogomarginleft" value="<?php echo $row_RecordTmp['tmplogomarginleft'] ?>" />
        <input name="tmpmenuselect" type="hidden" id="tmpmenuselect" value="<?php echo $row_RecordTmp['tmpmenuselect'] ?>" />
        <input name="tmpdfmenucolor" type="hidden" id="tmpdfmenucolor" value="<?php echo $row_RecordTmp['tmpdfmenucolor'] ?>" />
        
        <input name="tmpdftmenu_x" type="hidden" id="tmpdftmenu_x" value="<?php echo $row_RecordTmp['tmpdftmenu_x'] ?>" />
        <input name="tmpdftmenu_y" type="hidden" id="tmpdftmenu_y" value="<?php echo $row_RecordTmp['tmpdftmenu_y'] ?>" />
        <input name="tmppicmenu_x" type="hidden" id="tmppicmenu_x" value="<?php echo $row_RecordTmp['tmppicmenu_x'] ?>" />
        <input name="tmppicmenu_y" type="hidden" id="tmppicmenu_y" value="<?php echo $row_RecordTmp['tmppicmenu_y'] ?>" />
        <input name="tmppicmenu_style" type="hidden" id="tmppicmenu_style" value="<?php echo $row_RecordTmp['tmppicmenu_style'] ?>" />
        <input name="tmpheaderminheight" type="hidden" id="tmpheaderminheight" value="<?php echo $row_RecordTmp['tmpheaderminheight'] ?>" />
        <input name="tmpheaderpaddingtop" type="hidden" id="tmpheaderpaddingtop" value="<?php echo $row_RecordTmp['tmpheaderpaddingtop'] ?>" />
        <input name="tmpheaderpaddingbttom" type="hidden" id="tmpheaderpaddingbttom" value="<?php echo $row_RecordTmp['tmpheaderpaddingbttom'] ?>" />
        <input name="tmpheaderpaddingleft" type="hidden" id="tmpheaderpaddingleft" value="<?php echo $row_RecordTmp['tmpheaderpaddingleft'] ?>" />
        <input name="tmpheaderpaddingright" type="hidden" id="tmpheaderpaddingright" value="<?php echo $row_RecordTmp['tmpheaderpaddingright'] ?>" />
        <input name="tmpbanner" type="hidden" id="tmpbanner" value="<?php echo $row_RecordTmp['tmpbanner'] ?>" />
        <input name="tmpbannerpicwidth" type="hidden" id="tmpbannerpicwidth" value="<?php echo $row_RecordTmp['tmpbannerpicwidth'] ?>" />
        <input name="tmpbannerpicheight" type="hidden" id="tmpbannerpicheight" value="<?php echo $row_RecordTmp['tmpbannerpicheight'] ?>" />
        <input name="tmpbannerpaddingtop" type="hidden" id="tmpbannerpaddingtop" value="<?php echo $row_RecordTmp['tmpbannerpaddingtop'] ?>" />
        <input name="tmpbannerpaddingbttom" type="hidden" id="tmpbannerpaddingbttom" value="<?php echo $row_RecordTmp['tmpbannerpaddingbttom'] ?>" />
        <input name="tmpbannerpaddingleft" type="hidden" id="tmpbannerpaddingleft" value="<?php echo $row_RecordTmp['tmpbannerpaddingleft'] ?>" />
        <input name="tmpbannerpaddingright" type="hidden" id="tmpbannerpaddingright" value="<?php echo $row_RecordTmp['tmpbannerpaddingright'] ?>" />
        
        <input name="tmpshowblockname" type="hidden" id="tmpshowblockname" value="<?php echo $row_RecordTmp['tmpshowblockname'] ?>" />
        <input name="tmpleftpaddingtop" type="hidden" id="tmpleftpaddingtop" value="<?php echo $row_RecordTmp['tmpleftpaddingtop'] ?>" />
        <input name="tmpleftpaddingbttom" type="hidden" id="tmpleftpaddingbttom" value="<?php echo $row_RecordTmp['tmpleftpaddingbttom'] ?>" />
        <input name="tmpleftpaddingleft" type="hidden" id="tmpleftpaddingleft" value="<?php echo $row_RecordTmp['tmpleftpaddingleft'] ?>" />
        <input name="tmpleftpaddingright" type="hidden" id="tmpleftpaddingright" value="<?php echo $row_RecordTmp['tmpleftpaddingright'] ?>" />
        <input name="tmprightminheight" type="hidden" id="tmprightminheight" value="<?php echo $row_RecordTmp['tmprightminheight'] ?>" />
        
        <?php // 獨立區塊 ?>
        <input name="lang" type="hidden" id="lang" value="<?php echo $_SESSION['lang']; ?>" />
        <input name="userid" type="hidden" id="userid" value="<?php echo $w_userid; ?>" />
        <input name="name" type="hidden" id="name" value="<?php echo $row_RecordTmp['name']; ?>" />
        <input name="title" type="hidden" id="title" value="[Copy]<?php echo $row_RecordTmp['title']; ?>" />
        <input name="homeselect" type="hidden" id="homeselect" value="<?php echo $row_RecordTmp['homeselect']; ?>" />
        <input name="tmpwebwidth" type="hidden" id="tmpwebwidth" value="<?php echo $row_RecordTmp['tmpwebwidth']; ?>" />
        <input name="tmpwebwidthunit" type="hidden" id="tmpwebwidthunit" value="<?php echo $row_RecordTmp['tmpwebwidthunit']; ?>" />
        <input name="tmpmenulimit" type="hidden" id="tmpmenulimit" value="<?php echo $row_RecordTmp['tmpmenulimit']; ?>" />
        <input name="type" type="hidden" id="type" value="<?php echo $row_RecordTmp['type']; ?>" />
        <input name="wshop" type="hidden" id="wshop" value="<?php echo $row_RecordTmp['wshop']; ?>" />
        <input name="tmpmainmenu" type="hidden" id="tmpmainmenu" value="<?php echo $row_RecordTmp['tmpmainmenu']; ?>" />
        <input name="tmpleftmenu" type="hidden" id="tmpleftmenu" value="<?php echo $row_RecordTmp['tmpleftmenu']; ?>" />
        <input name="tmpblock" type="hidden" id="tmpblock" value="<?php echo $row_RecordTmp['tmpblock']; ?>" />
        <input name="tmpbodybackground" type="hidden" id="tmpbodybackground" value="<?php echo $row_RecordTmp['tmpbodybackground']; ?>" />
        <input name="tmpanimebackground" type="hidden" id="tmpanimebackground" value="<?php echo $row_RecordTmp['tmpanimebackground']; ?>" />
        <input name="tmpbottombackground" type="hidden" id="tmpbottombackground" value="<?php echo $row_RecordTmp['tmpbottombackground']; ?>" />
        <input name="tmpheaderbackground" type="hidden" id="tmpheaderbackground" value="<?php echo $row_RecordTmp['tmpheaderbackground']; ?>" />
        <input name="tmpwrpbackground" type="hidden" id="tmpwrpbackground" value="<?php echo $row_RecordTmp['tmpwrpbackground']; ?>" />
        <input name="tmpleftbackground" type="hidden" id="tmpleftbackground" value="<?php echo $row_RecordTmp['tmpleftbackground']; ?>" />
        <input name="tmprightbackground" type="hidden" id="tmprightbackground" value="<?php echo $row_RecordTmp['tmprightbackground']; ?>" />
        <input name="tmpmiddlebackground" type="hidden" id="tmpmiddlebackground" value="<?php echo $row_RecordTmp['tmpmiddlebackground']; ?>" />
        <input name="tmpfooterbackground" type="hidden" id="tmpfooterbackground" value="<?php echo $row_RecordTmp['tmpfooterbackground']; ?>" />
        <input name="tmpwrpboard" type="hidden" id="tmpwrpboard" value="<?php echo $row_RecordTmp['tmpwrpboard']; ?>" />
        <input name="tmpbannerboard" type="hidden" id="tmpbannerboard" value="<?php echo $row_RecordTmp['tmpbannerboard']; ?>" />
        <input name="tmpheaderboard" type="hidden" id="tmpheaderboard" value="<?php echo $row_RecordTmp['tmpheaderboard']; ?>" />
        <input name="tmpleftboard" type="hidden" id="tmpleftboard" value="<?php echo $row_RecordTmp['tmpleftboard']; ?>" />
        <input name="tmprightboard" type="hidden" id="tmprightboard" value="<?php echo $row_RecordTmp['tmprightboard']; ?>" />
        <input name="tmptitleboard" type="hidden" id="tmptitleboard" value="<?php echo $row_RecordTmp['tmptitleboard']; ?>" />
        <input name="tmpmiddleboard" type="hidden" id="tmpmiddleboard" value="<?php echo $row_RecordTmp['tmpmiddleboard']; ?>" />
        <input name="tmpfooterboard" type="hidden" id="tmpfooterboard" value="<?php echo $row_RecordTmp['tmpfooterboard']; ?>" />
        <input name="webname" type="hidden" id="webname" value="<?php echo $wshop; ?>" />
        
        </td>
    </tr>
                  
</table>
      <input type="hidden" name="MM_insert" value="form_Tmp" />
	</form>
		

  </div>
</div>
