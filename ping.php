<?php
/**
  +------------------------------------------------------------------------------
 * 通知搜索引擎过来抓去最新发布的内容。秒收不是梦
 * 目前仅支持Google和Baidu
  +------------------------------------------------------------------------------
 */
/*class Ping {
 
    public $method, $callback;
 
    public function __construct($site_name, $site_url, $update_url, $update_rss) {
        $this->method = "
            <?xml version=\"1.0\" encoding=\"UTF-8\"?>
            <methodCall>
                <methodName>weblogUpdates.extendedPing</methodName>
                <params>
                    <param><value><string>{$site_name}</string></value></param>
                    <param><value><string>{$site_url}</string></value></param>
                    <param><value><string>{$update_url}</string></value></param>
                    <param><value><string>{$update_rss}</string></value></param>
                </params>
            </methodCall>";
    }
 
    private function _post($url, $postvar) {
        $ch = curl_init();
        $headers = array(
            "POST " . $url . " HTTP/1.0",
            "Content-type: text/xml;charset=\"utf-8\"",
            "Accept: text/xml",
            "Content-length: " . strlen($postvar)
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postvar);
        $res = curl_exec($ch);
        curl_close($ch);
        return $res;
    }
 
    public function google() {
        $this->callback = $this->_post('http://blogsearch.google.com/ping/RPC2', $this->method);
        return strpos($this->callback, "<boolean>0</boolean>") ? 1 : 0;
    }
 
    public function baidu() {
        $this->callback = $this->_post('http://ping.baidu.com/ping/RPC2', $this->method);
        return strpos($this->callback, "<int>0</int>") ? 1 : 0;
    }
}
$ping = new Ping();
$ping->google();
*/
function ping($server, $xml) {
        $ch = curl_init();
        $headers = array(
                "Content-type: text/xml;charset=\"utf-8\"",
                "Accept: text/xml"
        );
        curl_setopt_array(
                $ch,
                array(
                        CURLOPT_URL => $server,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_POST => true,
                        CURLOPT_HTTPHEADER => $headers,
                        CURLOPT_POSTFIELDS => $xml
                )
        );
        return curl_exec($ch);
}
$xml = '<?xml version="1.0" encoding="UTF-8"?>
<methodCall>
<methodName>weblogUpdates.extendedPing</methodName>
<params>
<param><value>博客名称</value></param>
<param><value>博客地址</value></param>
<param><value>文章地址</value></param>
<param><value>RSS地址</value></param>
</params>
</methodCall>';
$res = ping('http://blogsearch.google.com/ping/RPC2', $xml);
echo $res;
?>