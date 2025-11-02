<?php
if ( $HomeSelect == '1' && $OptionModuleSelect['Home'] == '1' ) { // 如果樣板選擇有首頁則跳轉
  $Tp_Page = "Home"; // 目前頁面所使用之分類(tp)
  $Tp_MdName = strtolower( $Tp_Page );
  require_once( $Lang_GeneralPath ); /* 通用語系檔連結 */
  require_once( 'app/meta/meta_' . $Tp_MdName . '.php' ); // 此頁面標題
  require_once( 'dftype_home_select.php' ); /* 抓取homeType的值 */

  if ( $tplname == "mobile_smarty" ) {
    // 手機板
    switch ( $HomeStyle ) /*  判斷要使用的首頁版型 */ {
      case "homeboard001":
        include( $TplPath . "/main.php" );
        break;
      case "homeboard002":
        //include($TplPath . "/main_free.php");
        include( $TplPath . "/main_single.php" );
        break;
      case "homeboard003":
      case "homeboard004":
      case "homeboard005":
      case "homeboard006":
        include( $TplPath . "/main.php" );
        break;
      case "homeboard007":
      case "homeboard008":
      case "homeboard009":
      case "homeboard010":
      case "homeboard011":
      case "homeboard012":
      case "homeboard013":
        include( $TplPath . "/main_mod.php" );
        break;
      case "homeboard014":
      case "homeboard015":
      case "homeboard016":
      case "homeboard017":
      case "homeboard018":
      case "homeboard019":
      case "homeboard020":
        include( $TplPath . "/main_mod_muti.php" );
        break;
      case "homeboard021":
        include( $TplPath . "/main_image_fullscreen.php" );
        break;
      default:
        include( $TplPath . "/main.php" );
        break;
    }
  } else {
    // 電腦版
    switch ( $HomeStyle ) /*  判斷要使用的首頁版型 */ {
      case "homeboard001":
        include( $TplPath . "/main.php" );
        break;
      case "homeboard002":
        //include($TplPath . "/main_free.php");
        include( $TplPath . "/main_single.php" );
        break;
      case "homeboard003":
        include( $TplPath . "/main_image.php" );
        break;
      case "homeboard004":
        include( $TplPath . "/main_single_free.php" );
        break;
      case "homeboard005":
        include( $TplPath . "/main_single_free_nobanner.php" );
        break;
      case "homeboard006":
        include( $TplPath . "/main_image_full.php" );
        break;
      case "homeboard007":
      case "homeboard008":
      case "homeboard009":
      case "homeboard010":
      case "homeboard011":
      case "homeboard012":
      case "homeboard013":
        include( $TplPath . "/main_mod.php" );
        break;
      case "homeboard014":
      case "homeboard015":
      case "homeboard016":
      case "homeboard017":
      case "homeboard018":
      case "homeboard019":
      case "homeboard020":
        include( $TplPath . "/main_mod_muti.php" );
        break;
      case "homeboard021":
        include( $TplPath . "/main_image_fullscreen.php" );
        break;
      default:
        include( $TplPath . "/main.php" );
        break;
    }
  }

} else {
  if ( $HomeType == '' ) { // 如果未設定首頁 預設跳到About
    $Tp_Page = "About"; // 目前頁面所使用之分類(tp)
    $Tp_MdName = strtolower( $Tp_Page );
    require_once( $Lang_GeneralPath );
    require_once( 'app/counter/require_count.php' );
    require_once( 'app/meta/meta_' . $Tp_MdName . '.php' ); // 此頁面標題
    require_once( $TplPath . '/' . $Tp_MdName . '.php' );
  } else {
    require_once( "dftype_home_select.php" ); // 抓取homeType的值
    $Tp_Page = $HomeType;
    $Tp_MdName = strtolower( $HomeType );
    require_once( $Lang_GeneralPath ); // 通用語系檔連結
  if ( $Tp_MdName == "home" ) {
    $Tp_MdName = "main";
    require_once( 'app/meta/meta_' . $Tp_MdName . '.php' ); // 此頁面標題
    require_once( $TplPath . '/' . $Tp_MdName . '.php' );
  } else if ( $Tp_MdName == "cart_note" ) {
    require_once( 'app/meta/meta_' . $Tp_MdName . '.php' ); // 此頁面標題
    include( $Tp_MdName . "/cart.php" );
  } else if ( $Tp_MdName == "cart_pay" ) {
    require_once( 'app/meta/meta_' . $Tp_MdName . '.php' ); // 此頁面標題
    include( $Tp_MdName . "/cart.php" );
  } else {
    require_once( 'app/meta/meta_' . $Tp_MdName . '.php' ); // 此頁面標題
    require_once( $TplPath . '/' . $Tp_MdName . '.php' );
  }
  }
}
?>