
<ul class="nav">
    <li><a href="manage_accounts_book.php?wshop=<?php echo $wshop;?>&amp;Opt=diarypage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="每日的傳票交易內容" data-toggle="tooltip" data-placement="right"><i class="fas fa-book"></i><span id="Step_View">日記帳</span></a></li>
    <li><a href="manage_accounts_book.php?wshop=<?php echo $wshop;?>&amp;Opt=cashpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="查詢現金科目異動的相關傳票內容" data-toggle="tooltip" data-placement="right"><i class="fas fa-book"></i><span id="Step_View">現金簿</span></a></li>
    <li><a href="manage_accounts_book.php?wshop=<?php echo $wshop;?>&amp;Opt=generalledgerpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="用來檢視各會計總帳項目的借貸統計情形" data-toggle="tooltip" data-placement="right"><i class="fas fa-book"></i><span id="Step_View">總分類帳</span></a></li> 
    <li><a href="manage_accounts_book.php?wshop=<?php echo $wshop;?>&amp;Opt=detailledgerpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="用來檢視明細科目的借貸金額及統計資料，總合金額為總帳項目的金額，明細科目依會計人員需求設置，一般若需查詢詳細帳務內容會增設，通常會下設明細的項目為銀行存款(by銀行增設明細項目)、應收帳款\票據(by客戶增設明細項目)、應付帳款\票據(by廠商增設明細項目)等…" data-toggle="tooltip" data-placement="right"><i class="fas fa-book"></i><span id="Step_View">明細分類帳</span></a></li>
    <li><a href="manage_accounts_book.php?wshop=<?php echo $wshop;?>&amp;Opt=settingpage&amp;lang=<?php echo $_SESSION['lang']; ?>" data-original-title="設定收入和支出傳票的對方科目及年度結轉的對應科目" data-toggle="tooltip" data-placement="right"><i class="fas fa-cog"></i><span id="Step_View">現金與損益設定</span></a></li> 
</ul>


