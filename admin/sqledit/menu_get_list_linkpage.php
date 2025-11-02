<?php
switch($_SESSION['lang'])
{
	case "zh-tw":
		$array['index.php'] =  '首頁 [ index.php ]'; 
 		$array['news.php'] =  '最新訊息 [ news.php ]';	
		$array['publish.php'] =  '公布資訊 [ publish.php ]';	
		$array['activities.php'] =  '活動花絮 [ activities.php ]';	
		$array['sponsor.php'] =  '贊助廠商 [ sponsor.php ]';	
		$array['guestbook.php'] =  '留言訊息 [ guestbook.php ]';	
		$array['member.php'] =  '會員專區 [ member.php ]';	
		$array['careers.php'] =  '求職徵才 [ careers.php ]';	
		$array['product.php'] =  '產品資訊 [ product.php ]';
		$array['about.php'] =  '公司簡介 [about.php ]';
		break;
	case "zh-cn":
		$array['index.php'] = '首页 [ index.php ]';
		$array['news.php'] = '最新讯息 [ news.php ]';
		$array['publish.php'] = '公布资讯 [ publish.php ]';
		$array['activities.php'] = '活动花絮 [ activities.php ]';
		$array['sponsor.php'] = '赞助厂商 [ sponsor.php ]';
		$array['guestbook.php'] = '留言讯息 [ guestbook.php ]';
		$array['member.php'] = '会员专区 [ member.php ]';
		$array['careers.php'] = '求职征才 [ careers.php ]';
		break;
	case "en":
		$array['index.php'] =  'Home [ index.php ]'; 
 		$array['news.php'] =  'News [ news.php ]';	
		$array['publish.php'] =  'Publish [ publish.php ]';	
		$array['activities.php'] =  'Activities [ activities.php ]';	
		$array['sponsor.php'] =  'Sponsor [ sponsor.php ]';	
		$array['guestbook.php'] =  'Guestbook [ guestbook.php ]';	
		$array['member.php'] =  'Member [ member.php ]';	
		$array['careers.php'] =  'Careers [ careers.php ]';	
		break;
	case "jp":
		$array['index.php'] =  'ホーム [ index.php ]'; 
 		$array['news.php'] =  'ニュース [ news.php ]';	
		$array['publish.php'] =  '公開情報 [ publish.php ]';	
		$array['activities.php'] =  '活動 [ activities.php ]';	
		$array['sponsor.php'] =  'スポンサー [ sponsor.php ]';	
		$array['guestbook.php'] =  'ボイスメッセージ [ guestbook.php ]';	
		$array['member.php'] =  'メンバー [ member.php ]';	
		$array['careers.php'] =  '仕事募集 [ careers.php ]';	
		break;
	default:
		$array['index.php'] =  '首頁 [ index.php ]'; 
 		$array['news.php'] =  '最新訊息 [ news.php ]';	
		$array['publish.php'] =  '公布資訊 [ publish.php ]';	
		$array['activities.php'] =  '活動花絮 [ activities.php ]';	
		$array['sponsor.php'] =  '贊助廠商 [ sponsor.php ]';	
		$array['guestbook.php'] =  '留言訊息 [ guestbook.php ]';	
		$array['member.php'] =  '會員專區 [ member.php ]';	
		$array['careers.php'] =  '求職徵才 [ careers.php ]';	
		$array['product.php'] =  '產品資訊 [ product.php ]';
		$array['about.php'] =  '公司簡介 [about.php ]';	
		break;
}
 print json_encode($array);
?>

