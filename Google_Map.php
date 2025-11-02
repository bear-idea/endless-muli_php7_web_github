<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<style type="text/css">
  html { width: 100%; height: 100% }
  body { width: 100%; height: 100%; margin: 0px; padding: 0px }
  #box { border: 1px solid black; background: yellow; padding: 5px; }
</style>
<script src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyAjbbFSB0Zy0viOY_EXHJh66v63f7FWfGg"
type="text/javascript"></script>
    <title>Google Map</title>
    <!--Google Map 顯示的位置，可自由決定大小-->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<div id="mymap1" style="width: 100%; height: 100%"></div>

<!--以下為控制Google Maps的JavaScript-->
<script type="text/javascript">
    var map1 = new GMap(document.getElementById("mymap1"));

    //設定要顯示的控制項
    map1.addControl(new GSmallMapControl());
    map1.addControl(new GMapTypeControl());

    //決定你 Google 地圖的中心點位置和縮放大小
    map1.setCenter(new GLatLng(22.620149, 120.311866), 15);

    //標記在 Google 地圖上的經緯度
    var point1 = new GLatLng(22.620149, 120.311866);
    var marker1 = new GMarker(point1);
    map1.addOverlay(marker1);

    //在地圖上放置標點說明
    var html1 = "四維行政大樓增修案<br/>地點:高雄市政府<br/>期程:2012/01/01~2012/12/31";
    map1.openInfoWindowHtml(point1, html1);

    GEvent.addListener(marker1, "click", function () {
        marker1.openInfoWindowHtml(html1);  
    });


    //標記在 Google 地圖上的經緯度
    var point2 = new GLatLng(22.623721, 120.298419);
    var marker2 = new GMarker(point2);
    map1.addOverlay(marker2);

    //在地圖上放置標點說明
    var html2 = "左營區都市規劃新建案<br/>地點:高雄市政府工務局<br/>期程:2012/02/01~2013/01/31";
    GEvent.addListener(marker2, "click", function () {
        marker2.openInfoWindowHtml(html2);
    });

    //標記在 Google 地圖上的經緯度
    var point3 = new GLatLng(22.613682, 120.307559);
    var marker3 = new GMarker(point3);
    map1.addOverlay(marker3);

    //在地圖上放置標點說明
    var html3 = "高速公路九如交流道維護案<br/>地點:高雄市政府交通局<br/>期程:2012/03/01~2013/03/31";

    GEvent.addListener(marker3, "click", function () {
        marker3.openInfoWindowHtml(html3);
    });
</script>
</head>

<body>
<?php
$ch = curl_init();
$address="台中火車站";
curl_setopt($ch, CURLOPT_URL, "http://maps.google.com/maps/geo?q=$address&output=csv");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$output=explode(',',curl_exec($ch));
curl_close($ch);
echo "Latitude: $output[2]
Longitude: $output[3]
"; 
?>
<div id="div1" style="width: 100%; height: 100%"></div>
</body>
</html>