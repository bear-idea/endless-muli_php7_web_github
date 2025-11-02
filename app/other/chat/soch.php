<?php require_once('Connections/DB_Conn.php'); ?>
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

$currentPage = $_SERVER["PHP_SELF"];

$collang_RecordSocialchat = "zh-tw";
if (isset($_GET['lang'])) {
  $collang_RecordSocialchat = $_GET['lang'];
}

$coluserid_RecordSocialchat = "-1";
if (isset($_SESSION['userid'])) {
  $coluserid_RecordSocialchat = $_SESSION['userid'];
}

$query_RecordSocialchat = sprintf("SELECT * FROM demo_socialchat WHERE indicate=1 && (lang = %s) && userid=%s ORDER BY sortid ASC, id ASC", GetSQLValueString($collang_RecordSocialchat, "text"),GetSQLValueString($coluserid_RecordSocialchat, "int"));
$RecordSocialchat = mysqli_query($DB_Conn, $query_RecordSocialchat) or die(mysqli_error($DB_Conn));
$row_RecordSocialchat = mysqli_fetch_assoc($RecordSocialchat);
$totalRows_RecordSocialchat = mysqli_num_rows($RecordSocialchat);

do {
	        switch($row_RecordSocialchat['type'])
			{
				case "Facebook Messenger":
					$Socialchat['Facebook Messenger']['title'][] = $row_RecordSocialchat['title'];
					$Socialchat['Facebook Messenger']['socialnameid'][] = $row_RecordSocialchat['socialnameid'];
					$Socialchat['Facebook Messenger']['pic'][] = $row_RecordSocialchat['pic'];
					$Socialchat['Facebook Messenger']['type'][] = $row_RecordSocialchat['type'];
					$Socialchat['Facebook Messenger']['serviceday1'][] = $row_RecordSocialchat['serviceday1'];
					$Socialchat['Facebook Messenger']['serviceday2'][] = $row_RecordSocialchat['serviceday2'];
					$Socialchat['Facebook Messenger']['serviceday3'][] = $row_RecordSocialchat['serviceday3'];
					$Socialchat['Facebook Messenger']['serviceday4'][] = $row_RecordSocialchat['serviceday4'];
					$Socialchat['Facebook Messenger']['serviceday5'][] = $row_RecordSocialchat['serviceday5'];
					$Socialchat['Facebook Messenger']['serviceday6'][] = $row_RecordSocialchat['serviceday6'];
					$Socialchat['Facebook Messenger']['serviceday7'][] = $row_RecordSocialchat['serviceday7'];	
					break;
				case "Skype":
					$Socialchat['Skype']['title'][] = $row_RecordSocialchat['title'];
					$Socialchat['Skype']['socialnameid'][] = $row_RecordSocialchat['socialnameid'];
					$Socialchat['Skype']['pic'][] = $row_RecordSocialchat['pic'];
					$Socialchat['Skype']['type'][] = $row_RecordSocialchat['type'];
					$Socialchat['Skype']['serviceday1'][] = $row_RecordSocialchat['serviceday1'];
					$Socialchat['Skype']['serviceday2'][] = $row_RecordSocialchat['serviceday2'];
					$Socialchat['Skype']['serviceday3'][] = $row_RecordSocialchat['serviceday3'];
					$Socialchat['Skype']['serviceday4'][] = $row_RecordSocialchat['serviceday4'];
					$Socialchat['Skype']['serviceday5'][] = $row_RecordSocialchat['serviceday5'];
					$Socialchat['Skype']['serviceday6'][] = $row_RecordSocialchat['serviceday6'];
					$Socialchat['Skype']['serviceday7'][] = $row_RecordSocialchat['serviceday7'];			
					break;
				case "LINE":
					$Socialchat['LINE']['title'][] = $row_RecordSocialchat['title'];
					$Socialchat['LINE']['socialnameid'][] = $row_RecordSocialchat['socialnameid'];
					$Socialchat['LINE']['pic'][] = $row_RecordSocialchat['pic'];
					$Socialchat['LINE']['type'][] = $row_RecordSocialchat['type'];
					$Socialchat['LINE']['serviceday1'][] = $row_RecordSocialchat['serviceday1'];
					$Socialchat['LINE']['serviceday2'][] = $row_RecordSocialchat['serviceday2'];
					$Socialchat['LINE']['serviceday3'][] = $row_RecordSocialchat['serviceday3'];
					$Socialchat['LINE']['serviceday4'][] = $row_RecordSocialchat['serviceday4'];
					$Socialchat['LINE']['serviceday5'][] = $row_RecordSocialchat['serviceday5'];
					$Socialchat['LINE']['serviceday6'][] = $row_RecordSocialchat['serviceday6'];
					$Socialchat['LINE']['serviceday7'][] = $row_RecordSocialchat['serviceday7'];			
					break;
				case "Whatsapp":
					$Socialchat['Whatsapp']['title'][] = $row_RecordSocialchat['title'];
					$Socialchat['Whatsapp']['socialnameid'][] = $row_RecordSocialchat['socialnameid'];
					$Socialchat['Whatsapp']['pic'][] = $row_RecordSocialchat['pic'];
					$Socialchat['Whatsapp']['type'][] = $row_RecordSocialchat['type'];
					$Socialchat['Whatsapp']['serviceday1'][] = $row_RecordSocialchat['serviceday1'];
					$Socialchat['Whatsapp']['serviceday2'][] = $row_RecordSocialchat['serviceday2'];
					$Socialchat['Whatsapp']['serviceday3'][] = $row_RecordSocialchat['serviceday3'];
					$Socialchat['Whatsapp']['serviceday4'][] = $row_RecordSocialchat['serviceday4'];
					$Socialchat['Whatsapp']['serviceday5'][] = $row_RecordSocialchat['serviceday5'];
					$Socialchat['Whatsapp']['serviceday6'][] = $row_RecordSocialchat['serviceday6'];
					$Socialchat['Whatsapp']['serviceday7'][] = $row_RecordSocialchat['serviceday7'];	
					break;
				case "Phone":
					$Socialchat['Phone']['title'][] = $row_RecordSocialchat['title'];
					$Socialchat['Phone']['socialnameid'][] = $row_RecordSocialchat['socialnameid'];
					$Socialchat['Phone']['pic'][] = $row_RecordSocialchat['pic'];
					$Socialchat['Phone']['type'][] = $row_RecordSocialchat['type'];
					$Socialchat['Phone']['serviceday1'][] = $row_RecordSocialchat['serviceday1'];
					$Socialchat['Phone']['serviceday2'][] = $row_RecordSocialchat['serviceday2'];
					$Socialchat['Phone']['serviceday3'][] = $row_RecordSocialchat['serviceday3'];
					$Socialchat['Phone']['serviceday4'][] = $row_RecordSocialchat['serviceday4'];
					$Socialchat['Phone']['serviceday5'][] = $row_RecordSocialchat['serviceday5'];
					$Socialchat['Phone']['serviceday6'][] = $row_RecordSocialchat['serviceday6'];
					$Socialchat['Phone']['serviceday7'][] = $row_RecordSocialchat['serviceday7'];	
					break;
				case "Mail":
					$Socialchat['Mail']['title'][] = $row_RecordSocialchat['title'];
					$Socialchat['Mail']['socialnameid'][] = $row_RecordSocialchat['socialnameid'];
					$Socialchat['Mail']['pic'][] = $row_RecordSocialchat['pic'];
					$Socialchat['Mail']['type'][] = $row_RecordSocialchat['type'];
					$Socialchat['Mail']['serviceday1'][] = $row_RecordSocialchat['serviceday1'];
					$Socialchat['Mail']['serviceday2'][] = $row_RecordSocialchat['serviceday2'];
					$Socialchat['Mail']['serviceday3'][] = $row_RecordSocialchat['serviceday3'];
					$Socialchat['Mail']['serviceday4'][] = $row_RecordSocialchat['serviceday4'];
					$Socialchat['Mail']['serviceday5'][] = $row_RecordSocialchat['serviceday5'];
					$Socialchat['Mail']['serviceday6'][] = $row_RecordSocialchat['serviceday6'];
					$Socialchat['Mail']['serviceday7'][] = $row_RecordSocialchat['serviceday7'];	
					break;
			}
			
} while ($row_RecordSocialchat = mysqli_fetch_assoc($RecordSocialchat));

?>
<?php if($totalRows_RecordSocialchat > 0) { ?>
<div id="sochSection" style="z-index:10">
			<div class="sochIcon skypeIcon">
				<span class="fa fa-comment"></span>
			</div>
			<div class="chatIcons">
                <?php if (isset($Socialchat['Facebook Messenger']['type']) && in_array("Facebook Messenger", $Socialchat['Facebook Messenger']['type'])) { ?>
				<a data-toggle="tooltip" data-placement="top" title="Facebook Messenger"><div id="messengerIcon" class="myIcon" data-show="messengerPopup">
					<span class="fa fa-facebook"></span>
				</div></a>
                <?php } ?>
                <?php if (isset($Socialchat['Whatsapp']['type']) && in_array("Whatsapp", $Socialchat['Whatsapp']['type'])) { ?>
				<a data-toggle="tooltip" data-placement="top" title="Whatsapp"><div id="whatsappIcon" class="myIcon" data-show="whatsappPopup">
					<span class="fa fa-whatsapp"></span>
				</div></a>
                <?php } ?>
                <?php if (isset($Socialchat['Skype']['type']) && in_array("Skype", $Socialchat['Skype']['type'])) { ?>
				<a data-toggle="tooltip" data-placement="top" title="Skype"><div id="skypeIcon" class="myIcon" data-show="skypePopup">
					<span class="fa fa-skype"></span>
				</div></a>
                <?php } ?>
                <?php if (isset($Socialchat['LINE']['type']) && in_array("LINE", $Socialchat['LINE']['type'])) { ?>
                <a data-toggle="tooltip" data-placement="top" title="LINE"><div id="lineIcon" class="myIcon" data-show="linePopup">
					<span class="icon-line"></span>
				</div></a>
                <?php } ?>
                <?php if (isset($Socialchat['Phone']['type']) && in_array("Phone", $Socialchat['Phone']['type'])) { ?>
                <a data-toggle="tooltip" data-placement="top" title="Phone"><div id="phoneIcon" class="myIcon" data-show="phonePopup">
					<span class="fa fa-phone"></span>
				</div></a>
                <?php } ?>
                <?php if (isset($Socialchat['Mail']['type']) && in_array("Mail", $Socialchat['Mail']['type'])) { ?>
                <a data-toggle="tooltip" data-placement="top" title="Mail"><div id="mailIcon" class="myIcon" data-show="mailPopup">
					<span class="fa fa-envelope"></span>
				</div></a>
                <?php } ?>
			</div>
			<div class="chatsPopupsBox">
                <?php if (isset($Socialchat['Skype']['type']) && in_array("Skype", $Socialchat['Skype']['type'])) { ?>
				<div id="skypePopup" class="chatsPopup">
					<div class="chatsPopup-header">
	                    <div class="closePopup">
	                        <a href="javascript:;">
	                            <span class="fa  fa-times"></span>
	                        </a>
	                    </div>
	                    <h2 class="chatsPopup-title text-white"><i class="fa fa-skype"></i> <?php echo $Lang_Social_Title; ?></h2>
	                    <h2 class="chatsPopup-tagline text-white"><?php echo $Lang_Social_Tagline; ?></h2>
	                </div>
	                <div class="chatsPopup-body">
	                    <div class="chatsPopupContent">
	                        <div class="chatsPopupList">
	                            <ul class="list-unstyled">
                                    <?php for($i=0; $i<count($Socialchat['Skype']['type']); $i++) { ?>
	                                <li>
	                                    <div class="chats-button" data-skypename="<?php echo $Socialchat['Skype']['socialnameid'][$i]; ?>" data-available='{"monday":"<?php echo $Socialchat['Skype']['serviceday1'][$i]; ?>", "tuesday":"<?php echo $Socialchat['Skype']['serviceday2'][$i]; ?>", "wednesday":"<?php echo $Socialchat['Skype']['serviceday3'][$i]; ?>", "thursday":"<?php echo $Socialchat['Skype']['serviceday4'][$i]; ?>", "friday":"<?php echo $Socialchat['Skype']['serviceday5'][$i]; ?>","saturday": "<?php echo $Socialchat['Skype']['serviceday6'][$i]; ?>","sunday": "<?php echo $Socialchat['Skype']['serviceday7'][$i]; ?>" }'>
	                                        <div class="chatsUserImg pull-left">
	                                            <img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/socialchat/thumb/small_<?php echo $Socialchat['Skype']['pic'][$i]; ?>" alt="" class="img-fluid">
	                                        </div>
	                                        <div class="chatsUsercontent">
	                                            <h2 class="chatsUserName"><?php echo $Socialchat['Skype']['title'][$i]; ?></h2>
	                                            <h3 class="chatsUserTagline">Support</h3>
	                                            <span class="userStatus">I will back soon.</span>
	                                        </div>
	                                    </div>
	                                </li>   
                                    <?php } ?>
	                            </ul>
	                        </div>
	                    </div>
	                </div>
				</div>
                <?php } ?>
                <?php if (isset($Socialchat['Whatsapp']['type']) && in_array("Whatsapp", $Socialchat['Whatsapp']['type'])) { ?>
				<div id="whatsappPopup" class="chatsPopup">
					<div class="chatsPopup-header">
	                    <div class="closePopup">
	                        <a href="javascript:;">
	                            <span class="fa  fa-times"></span>
	                        </a>
	                    </div>
	                    <h2 class="chatsPopup-title text-white"><i class="fa fa-whatsapp"></i> <?php echo $Lang_Social_Title; ?></h2>
	                    <h2 class="chatsPopup-tagline text-white"><?php echo $Lang_Social_Tagline; ?></h2>
	                </div>
	                <div class="chatsPopup-body">
	                    <div class="chatsPopupContent">
	                        <div class="chatsPopupList">
	                            <ul class="list-unstyled">
                                    <?php for($i=0; $i<count($Socialchat['Whatsapp']['type']); $i++) { ?>
	                                <li>
	                                    <div class="chats-button" data-soch-whatsapp="<?php echo $Socialchat['Whatsapp']['socialnameid'][$i]; ?>" data-available='{"monday":"<?php echo $Socialchat['Whatsapp']['serviceday1'][$i]; ?>", "tuesday":"<?php echo $Socialchat['Whatsapp']['serviceday2'][$i]; ?>", "wednesday":"<?php echo $Socialchat['Whatsapp']['serviceday3'][$i]; ?>", "thursday":"<?php echo $Socialchat['Whatsapp']['serviceday4'][$i]; ?>", "friday":"<?php echo $Socialchat['Whatsapp']['serviceday5'][$i]; ?>","saturday": "<?php echo $Socialchat['Whatsapp']['serviceday6'][$i]; ?>","sunday": "<?php echo $Socialchat['Whatsapp']['serviceday7'][$i]; ?>" }'>
	                                        <div class="chatsUserImg pull-left">
	                                            <img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/socialchat/thumb/small_<?php echo $Socialchat['Whatsapp']['pic'][$i]; ?>" alt="" class="img-fluid">
	                                        </div>
	                                        <div class="chatsUsercontent">
	                                            <h2 class="chatsUserName"><?php echo $Socialchat['Whatsapp']['title'][$i]; ?></h2>
	                                            <h3 class="chatsUserTagline">Support</h3>
	                                            <span class="userStatus">I will back soon.</span>
	                                        </div>
	                                    </div>
	                                </li>
                                    <?php } ?>
	                            </ul>
	                        </div>
	                    </div>
	                </div>
				</div>
                <?php } ?>
                <?php if (isset($Socialchat['Facebook Messenger']['type']) && in_array("Facebook Messenger", $Socialchat['Facebook Messenger']['type'])) { ?>
				<div id="messengerPopup" class="chatsPopup">
					<div class="chatsPopup-header">
	                    <div class="closePopup">
	                        <a href="javascript:;">
	                            <span class="fa fa-times"></span>
	                        </a>
	                    </div>
	                    <h2 class="chatsPopup-title text-white"><i class="fa fa-facebook"></i> <?php echo $Lang_Social_Title; ?></h2>
	                    <h2 class="chatsPopup-tagline text-white"><?php echo $Lang_Social_Tagline; ?></h2>
	                </div>
	                <div class="chatsPopup-body">
	                    <div class="chatsPopupContent">
	                        <div class="chatsPopupList">
	                            <ul class="list-unstyled">
                                    <?php for($i=0; $i<count($Socialchat['Facebook Messenger']['type']); $i++) { ?>
	                                <li>
	                                    <div class="chats-button" data-soch-message="<?php echo $Socialchat['Facebook Messenger']['socialnameid'][$i]; ?>" data-available='{"monday":"<?php echo $Socialchat['Facebook Messenger']['serviceday1'][$i]; ?>", "tuesday":"<?php echo $Socialchat['Facebook Messenger']['serviceday2'][$i]; ?>", "wednesday":"<?php echo $Socialchat['Facebook Messenger']['serviceday3'][$i]; ?>", "thursday":"<?php echo $Socialchat['Facebook Messenger']['serviceday4'][$i]; ?>", "friday":"<?php echo $Socialchat['Facebook Messenger']['serviceday5'][$i]; ?>","saturday": "<?php echo $Socialchat['Facebook Messenger']['serviceday6'][$i]; ?>","sunday": "<?php echo $Socialchat['Facebook Messenger']['serviceday7'][$i]; ?>" }'>
	                                        <div class="chatsUserImg pull-left">
	                                            <img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/socialchat/thumb/small_<?php echo $Socialchat['Facebook Messenger']['pic'][$i]; ?>" alt="" class="img-fluid">
	                                        </div>
	                                        <div class="chatsUsercontent">
	                                            <h2 class="chatsUserName"><?php echo $Socialchat['Facebook Messenger']['title'][$i]; ?></h2>
	                                            <h3 class="chatsUserTagline">Support</h3>
	                                            <span class="userStatus">I will back soon.</span>
	                                        </div>
	                                    </div>
	                                </li>
                                    <?php } ?>
	                            </ul>
	                        </div>
	                    </div>
	                </div>
				</div>
                <?php } ?>
                <?php if (isset($Socialchat['LINE']['type']) && in_array("LINE", $Socialchat['LINE']['type'])) { ?>
                <div id="linePopup" class="chatsPopup">
					<div class="chatsPopup-header">
	                    <div class="closePopup">
	                        <a href="javascript:;">
	                            <span class="fa fa-times"></span>
	                        </a>
	                    </div>
	                    <h2 class="chatsPopup-title text-white"><i class="icon-line"></i> <?php echo $Lang_Social_Title; ?></h2>
	                    <h2 class="chatsPopup-tagline text-white"><?php echo $Lang_Social_Tagline; ?></h2>
	                </div>
	                <div class="chatsPopup-body">
	                    <div class="chatsPopupContent">
	                        <div class="chatsPopupList">
	                            <ul class="list-unstyled">
                                    <?php for($i=0; $i<count($Socialchat['LINE']['type']); $i++) { ?>
	                                <li>
	                                    <div class="chats-button" data-linename="<?php echo $Socialchat['LINE']['socialnameid'][$i]; ?>" data-available='{"monday":"<?php echo $Socialchat['LINE']['serviceday1'][$i]; ?>", "tuesday":"<?php echo $Socialchat['LINE']['serviceday2'][$i]; ?>", "wednesday":"<?php echo $Socialchat['LINE']['serviceday3'][$i]; ?>", "thursday":"<?php echo $Socialchat['LINE']['serviceday4'][$i]; ?>", "friday":"<?php echo $Socialchat['LINE']['serviceday5'][$i]; ?>","saturday": "<?php echo $Socialchat['LINE']['serviceday6'][$i]; ?>","sunday": "<?php echo $Socialchat['LINE']['serviceday7'][$i]; ?>" }'>
	                                        <div class="chatsUserImg pull-left">
	                                            <img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/socialchat/thumb/small_<?php echo $Socialchat['LINE']['pic'][$i]; ?>" alt="" class="img-fluid">
	                                        </div>
	                                        <div class="chatsUsercontent">
	                                            <h2 class="chatsUserName"><?php echo $Socialchat['LINE']['title'][$i]; ?></h2>
	                                            <h3 class="chatsUserTagline">Support</h3>
	                                            <span class="userStatus">I will back soon.</span>
	                                        </div>
	                                    </div>
	                                </li>
                                    <?php } ?>
	                            </ul>
	                        </div>
	                    </div>
	                </div>
				</div>
                <?php } ?>
                <?php if (isset($Socialchat['Phone']['type']) && in_array("Phone", $Socialchat['Phone']['type'])) { ?>
                <div id="phonePopup" class="chatsPopup">
					<div class="chatsPopup-header">
	                    <div class="closePopup">
	                        <a href="javascript:;">
	                            <span class="fa fa-times"></span>
	                        </a>
	                    </div>
	                    <h2 class="chatsPopup-title text-white"><i class="fa fa-phone"></i> <?php echo $Lang_Social_Title; ?></h2>
	                    <h2 class="chatsPopup-tagline text-white"><?php echo $Lang_Social_Tagline; ?></h2>
	                </div>
	                <div class="chatsPopup-body">
	                    <div class="chatsPopupContent">
	                        <div class="chatsPopupList">
	                            <ul class="list-unstyled">
                                    <?php for($i=0; $i<count($Socialchat['Phone']['type']); $i++) { ?>
	                                <li>
	                                    <div class="chats-button" data-soch-phone="<?php echo $Socialchat['Phone']['socialnameid'][$i]; ?>" data-available='{"monday":"<?php echo $Socialchat['LINE']['serviceday1'][$i]; ?>", "tuesday":"<?php echo $Socialchat['Phone']['serviceday2'][$i]; ?>", "wednesday":"<?php echo $Socialchat['Phone']['serviceday3'][$i]; ?>", "thursday":"<?php echo $Socialchat['Phone']['serviceday4'][$i]; ?>", "friday":"<?php echo $Socialchat['Phone']['serviceday5'][$i]; ?>","saturday": "<?php echo $Socialchat['Phone']['serviceday6'][$i]; ?>","sunday": "<?php echo $Socialchat['Phone']['serviceday7'][$i]; ?>" }'>
	                                        <div class="chatsUserImg pull-left">
	                                            <img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/socialchat/thumb/small_<?php echo $Socialchat['Phone']['pic'][$i]; ?>" alt="" class="img-fluid">
	                                        </div>
	                                        <div class="chatsUsercontent">
	                                            <h2 class="chatsUserName"><?php echo $Socialchat['Phone']['title'][$i]; ?></h2>
	                                            <h3 class="chatsUserTagline">Support</h3>
	                                            <span class="userStatus">I will back soon.</span>
	                                        </div>
	                                    </div>
	                                </li>
                                    <?php } ?>
	                            </ul>
	                        </div>
	                    </div>
	                </div>
				</div>
                 <?php } ?>
                 <?php if (isset($Socialchat['Mail']['type']) && in_array("Mail", $Socialchat['Mail']['type'])) { ?>
                <div id="mailPopup" class="chatsPopup">
					<div class="chatsPopup-header">
	                    <div class="closePopup">
	                        <a href="javascript:;">
	                            <span class="fa fa-times"></span>
	                        </a>
	                    </div>
	                    <h2 class="chatsPopup-title text-white"><i class="fa fa-envelope"></i> <?php echo $Lang_Social_Title; ?></h2>
	                    <h2 class="chatsPopup-tagline text-white"><?php echo $Lang_Social_Tagline; ?></h2>
	                </div>
	                <div class="chatsPopup-body">
	                    <div class="chatsPopupContent">
	                        <div class="chatsPopupList">
	                            <ul class="list-unstyled">
                                    <?php for($i=0; $i<count($Socialchat['Mail']['type']); $i++) { ?>
	                                <li>
	                                    <div class="chats-button" data-soch-mail="<?php echo $Socialchat['Mail']['socialnameid'][$i]; ?>" data-available='{"monday":"<?php echo $Socialchat['LINE']['serviceday1'][$i]; ?>", "tuesday":"<?php echo $Socialchat['Mail']['serviceday2'][$i]; ?>", "wednesday":"<?php echo $Socialchat['Mail']['serviceday3'][$i]; ?>", "thursday":"<?php echo $Socialchat['Mail']['serviceday4'][$i]; ?>", "friday":"<?php echo $Socialchat['Mail']['serviceday5'][$i]; ?>","saturday": "<?php echo $Socialchat['Mail']['serviceday6'][$i]; ?>","sunday": "<?php echo $Socialchat['Mail']['serviceday7'][$i]; ?>" }'>
	                                        <div class="chatsUserImg pull-left">
	                                            <img src="<?php echo $SiteImgUrl; ?><?php echo $_GET['wshop']; ?>/image/socialchat/thumb/small_<?php echo $Socialchat['Mail']['pic'][$i]; ?>" alt="" class="img-fluid">
	                                        </div>
	                                        <div class="chatsUsercontent">
	                                            <h2 class="chatsUserName"><?php echo $Socialchat['Mail']['title'][$i]; ?></h2>
	                                            <h3 class="chatsUserTagline">Support</h3>
	                                            <span class="userStatus">I will back soon.</span>
	                                        </div>
	                                    </div>
	                                </li>
                                    <?php } ?>
	                            </ul>
	                        </div>
	                    </div>
	                </div>
				</div>
                 <?php } ?>
			</div>
		</div>
        
<?php } ?>         
<?php
mysqli_free_result($RecordSocialchat);
?>