<?php require_once('../Connections/DB_Conn.php'); ?>
<?php 
//initialize the session
if (!isset($_SESSION)) {
  session_start();
}
?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form_Webuser")) {
  $updateSQL = sprintf("UPDATE demo_admin SET tmpagree=%s WHERE id=%s",
                       GetSQLValueString($_POST['tmpagree'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  //mysqli_select_db($database_DB_Conn, $DB_Conn);
  $Result1 = mysqli_query($DB_Conn, $updateSQL) or die(mysqli_error($DB_Conn));

  $_SESSION['DB_Edit'] = "Success";
  
  $updateGoTo = "manage_tmp.php?Opt=viewpage&lang=" . $_POST['lang'];
  /*if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }*/
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_RecordWebuser = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_RecordWebuser = $_SESSION['MM_Username'];
}
//mysqli_select_db($database_DB_Conn, $DB_Conn);
$query_RecordWebuser = sprintf("SELECT * FROM demo_admin WHERE account = %s", GetSQLValueString($colname_RecordWebuser, "text"));
$RecordWebuser = mysqli_query($DB_Conn, $query_RecordWebuser) or die(mysqli_error($DB_Conn));
$row_RecordWebuser = mysqli_fetch_assoc($RecordWebuser);
$totalRows_RecordWebuser = mysqli_num_rows($RecordWebuser);
?>

<div class="card bg-silver-lighter" style="overflow:hidden">
  <div class="card-block">
    <h4 class="card-title m-0"><i class="far fa-bookmark"></i> 版型設計 <small>使用條款</small> <?php require("require_lang_show.php"); ?></h4>
  </div>
</div>

<!-- begin panel -->
<div class="panel panel-inverse bg-white-transparent-9"> 
  <!-- begin panel-heading -->
  <div class="panel-heading">
    <div class="panel-heading-btn"> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a> <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a> </div>
    <h4 class="panel-title"><i class="fa fa-edit"></i> 聲明條款</h4>
  </div>
  <!-- end panel-heading --> 
  <!-- begin panel-body -->
  <div class="panel-body p-0">
  
  
  <form action="<?php echo $editFormAction;?>"  class="form-horizontal form-bordered" data-parsley-validate="" method="post">
   
      <div class="form-group row">

          <div class="col-md-12">
          <div class="table-responsive">
                <p><strong>除我們在本網站另有訂明外，或我們另外給予特許外，閣下不得以任何形式及方式，下載、翻印、複製、發佈、傳送、分發或轉售本網站任何圖片。如需徵求我們同意／特許，以使用我們的圖片。</strong></p><p><strong>閣下一經使用本功能，即受本文件所載的使用條款約束。</strong></p><p><span style="color:#B22222;"><strong>1.設計功能使用條件</strong></span><br/>此功能<span style="color:#008080;"><strong>僅提供租用本公司之主機客戶提供之優惠功能</strong></span>，<em><strong>由於本站所有設計之圖片及客戶提供之圖片皆放於本公司主機之下，若拷貝出去將有客戶資料外洩之問題</strong></em>，另若需替換使用之圖片將受該圖片公司之政策條款規範所限制，因此再將網站轉移之後將不提供此模組所有設計之功能，僅以外連方式提供圖片之讀取，若不再使用本公司之空間，轉移出去後請先確認您的網站資料是否正確。<br/><br/><span style="color:#B22222;"><strong>2.資料</strong></span><br/>本網站提供有形或無形的資料、數據、內容、照片、圖片、視聽材料及其他材料與物品﹙統稱為「該等資料」﹚。如我們同意讓閣下使用本網站，有關特許使用，應是非獨家的、不可轉讓的和有限制的，須受該等使用條款規限。</p><p><span style="color:#B22222;"><strong>3.更改使用條款</strong></span><br/>我們<em>可不時全權酌情修改、增添或刪除該等使用條款而不先行通知閣下或向閣下負責</em>。該等使用條款經修改後，如閣下繼續使用本網站，即代表閣下同意受該等修訂約束。</p><p><span style="color:#B22222;"><strong>4.更改網站</strong></span><br/>我們可隨時全權酌情及不先行通知閣下而增減或修改本網站任何材料，或改變本網站的展示方式、實質內容或功用。</p><p><span style="color:#B22222;"><strong>5.本網站使用人的行為操守</strong></span></p><p>閣下使用本網站的條件之一，是不得：</p><table border="0"cellpadding="0"cellspacing="0"width="100%"><tbody><tr><td>﹙a﹚</td><td><span style="color:#008080;">擅自入侵、訪問</span>、使用或試圖入侵、訪問或使用我們的伺服器的任何其他部份以及／或任何數據區；</td></tr><tr><td>﹙b﹚</td><td>限制或阻止任何其他使用人使用及享用本網站；</td></tr><tr><td>﹙c﹚</td><td><span style="color:#008080;">張貼或傳送任何違法的、欺詐的、誹謗的、淫褻的、不雅的、色情的、褻瀆的、具有恐嚇成份的、污穢的、仇視的、敵意的或其他不良或不合情理的資料</span>，包括但不只限於任何構成或鼓勵傳送的行徑，其會構成刑事罪行者，或產生民事責任者，又或觸犯任何地方、州、國家或涉外法例者，或侵犯其他人士的任何知識產權、專有權利或保密責任者；</td></tr><tr><td>﹙d﹚</td><td>張貼或傳送任何廣告、招攬訊息、連鎖信、層壓式推銷計劃、投資機會或計劃或其他不請自來的商業通訊，或作出鋪天蓋地式的廣告宣傳；</td></tr><tr><td>﹙e﹚</td><td>張貼或傳送的<span style="color:#008080;">任何資料或軟件，含有病毒、特洛伊木馬、電腦蟲或其他有害元件</span>；</td></tr><tr><td>﹙f﹚</td><td>未得我們書面批准﹙除非我們在本網站中另有訂明，或我們另外給予特許﹚而張貼、發佈、傳送、複製、分發或以任何方式利用從本網站獲得的任何資料作商業用途；</td></tr><tr><td>﹙g﹚</td><td>未得我們書面批准﹙除非我們在本網站中另有訂明，或我們另外給予特許﹚而上載、張貼、發佈、傳送、複製或以任何方式分發本網站任何元件或通過本網站取得的任何受版權或其他專利權保障的資料，或創立衍生作品；</td></tr></tbody></table><p>閣下對該等資料並不擁有任何權利，除該等使用條款所允許者外，以及／或除我們另外給予特許外，閣下不得另外使用該等資料。</p><p><span style="color:#B22222;"><strong>6.第三者資料</strong></span><br/>該等資料可能含有第三者提供的資料，或我們從商業資料來源及其他參考途徑或來源獲得的資料。<br/><br/>如任何該等資料已過時，我們無須負責。我們不會獨立查核第三者或代理人提供的資料，因此，閣下必須注意該等資料是否可靠準確。對任何該等資料，我們不承擔任何責任。如閣下使用或信賴該等資料，風險由閣下自負。</p><p><span style="color:#B22222;"><strong>7.阻止使用</strong></span><br/>我們有權酌情﹙a﹚暫停本網站以提升或修改本網站，以及／或﹙b﹚限制閣下使用本網站，如我們認為有此合理需要以運作本網站。如因本網站暫停使用，或閣下被限制使用本網站，以致閣下蒙受任何損失或損害，我們無須負責。<br/><br/>我們保留權利，在不先行通知下，隨時立即禁止閣下使用本網站或其任何部份，如我們認為閣下已違反任何該等使用條款，或我們全權酌情認為禁止閣下使用本網站是恰當的、適宜的或必需的。</p><p><span style="color:#B22222;"><strong>8.連結網站</strong></span><br/>本網站的連線可通到其他網站，閣下明白及同意，對該等連結網站所提供的資料是否準確，或是否提供資料，我們無須負責。<br/><br/><span style="color:#008080;">對其他網站的連線，不代表我們認可或推薦該等網站或當中所提供的資料、產品、廣告或其他材料</span>。</p><p><span style="color:#B22222;"><strong>9.嵌入式內容</strong></span><br/>本網站上的篏入式內容（包括嵌入式文字、圖像、錄音及影片），直接來自Facebook、Twitter、YouTube、新浪微博或Instagram等第三者網站或社群媒體。<span style="color:#008080;">嵌入式內容受其所屬網站或網站經營者的條款約束</span>，我們毋須負責。閣下必須遵守相關條款，方可利用或連結至該等內容，並自行承擔一切後果及責任。</p><p><span style="color:#B22222;"><strong>10.使用者原創內容</strong></span><br/>本網站可能具有<span style="color:#008080;">支援及發表使用者原創內容的功能，例如圖片、文章等資料，只有版權擁有人或獲授權代表擁有人行事的代理人方可提出有關要求，同時亦應一併提交有效的擁有權證明</span>。我們保留權利，可在無須通知的情況下，因任何理由酌情修改、編輯或移除任何接獲侵權通知的內容。閣下同意，如我們接獲涉及閣下賬戶侵權行為的通知多於兩次，則我們可終止閣下的賬戶。</p><p><span style="color:#B22222;"><strong>11.知識產權</strong></span><br/>本網站所存在的一切知識產權，屬於我們所有，或已合法地特許給我們在本網站上使用。由適用法例所授予的一切權利，茲在此予以保留。儘管閣下可從本網站，下載或印製材料，供作個人非商業用途。<br/><br/>除非我們在本網站中另有訂明，或我們另外給予特許，否則閣下不得上載、下載、張貼、發佈、複製、傳送或以任何方式分發本網站任何元件或或創立衍生作品，因本網站獲得適用法例的版權保障。<br/><br/>閣下同意，我們可自由使用、披露、採用及修改閣下就本網站向我們提供的一切及任何構思、概念、專門知識、建議、提議、評論及其他通訊及資料﹙「反饋」﹚，而無須向閣下支付任何費用。閣下茲放棄及同意放棄就我們使用、披露、採用及／或修改閣下的任何或一切反饋，提出任何關於代價、費用、專利權費、收費及／或其他付款的一切及任何權利及提出申索。</p><p><span style="color:#B22222;"><strong>12.有限責任及保證</strong></span><br/>一切資料只供閣下作一般性參考，或作我們另外特許的用途。對該等資料，我們不承擔任何責任。<br/><br/><strong>閣下覽閱及使用本網站，風險由閣下自負，該等資料是「照原樣」提供。本網站只供閣下個人使用，我們不作出任何種類的明示或默示陳述或保證，包括但不只限於用本網站所宣傳或買賣的產品，或任何適銷保證或適合作任何特定用途。本網站提述任何第三者產品、事件或服務，並不構成或暗示我們作出任何種類的認可或推薦。</strong><br/><br/>在不限制該等使用條款訂明的免責聲明外，在任何情況下，我們對任何人擅自使用本網站或違反本網站保安程序所招致的任何成本、損害賠償或責任概不負責。</p><p>對下述各項，我們並不給予保證或承擔責任，而閣下確認我們並無作出陳述或保證：</p><table border="0"cellpadding="0"cellspacing="0"width="100%"><tbody><tr><td>﹙a﹚</td><td>本網站的資料屬於準確、充份、現行或可靠者，或該等資料可供作的用途超出一般參考用途或我們另外特許的用途；</td></tr><tr><td>﹙b﹚</td><td>本網站的資料，並無任何缺陷、錯誤、遺漏、病毒等，可能改變、抹除、增加或損壞閣下的軟件、數據或設備。</td></tr><tr><td>﹙c﹚</td><td>通過互聯網發送的訊息，不受到攔截、破壞或沒有遺失；</td></tr><tr><td>﹙d﹚</td><td>本網站將可供使用或不會中斷；或</td></tr><tr><td>﹙e﹚</td><td><p>本網站的缺陷將可糾正。</p></td></tr></tbody></table><p>在任何情況下，因使用或未能使用本網站，或本網站或該等資料有任何錯誤或遺漏，以致閣下或任何其他人士蒙受任何直接的、間接的、附帶的、特殊的、懲罰性的或從屬的損害賠償，包括失去業務或利潤，即使我們已獲悉有可能出現該等損害賠償，我們無須向閣下或任何其他人士承擔責任﹙不論是根據侵權法或合約等﹚。<br/><br/>閣下在使用本網站或使用或解釋該等資料上，須行使及完全依賴本身的技能和判斷力。閣下須確保，在使用本網站及該等資料時，符合一切適用的法律規定。<br/><br/>該等條款所載的有限責任條文，至法律允許的最大限度上將告適用。</p>
          </div>
          </div>
      </div>
      
      <div class="form-group row">
          <label class="col-md-2 col-form-label">是否同意<span class="text-red">*</span></label>
          <div class="col-md-10">
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordWebuser['tmpagree'],"1"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpagree" id="tmpagree_1" value="1" />
                <label for="tmpagree_1">是</label>
            </div>
            <div class="radio radio-css radio-inline">
                <input <?php if (!(strcmp($row_RecordWebuser['tmpagree'],"0"))) {echo "checked=\"checked\"";} ?> type="radio" name="tmpagree" id="tmpagree_2" value="0" />
                <label for="tmpagree_2">否</label>
            </div>
          </div>
      </div>
     
      <div class="form-group row">
        <div class="col-md-12">
          <button type="submit" class="btn btn btn-primary btn-block" onclick="return CheckFields();">送出</button>
            <input name="id" type="hidden" id="id" value="<?php echo $row_RecordWebuser['id']; ?>" />
            <input name="lang" type="hidden" id="lang" value="<?php echo $row_RecordWebuser['lang']; ?>" />
            <input name="Operate" type="hidden" id="Operate" value="editSuccess" />
          </div>
      </div>
      <input type="hidden" name="MM_update" value="form_Webuser" />
  </form>
  </div>
  <!-- end panel-body --> 
</div>
<!-- end panel -->


<?php
mysqli_free_result($RecordWebuser);
?>
