<?php
class URLRewrite {
    var $_query_string;
    /**
     * 构造函数
     *
     */
    function URLRewrite() {
        $this->_query_string = str_replace('.html', '', $_SERVER["QUERY_STRING"]);
    }
    /**
     * 返回模拟 Rewirte 形态页面传递字符串
     *
     */
    function GetRewriteString() {
        if (!strpos($this->_query_string, '&')) return $this->_query_string;
        $URLArray = explode('&', $this->_query_string);
        for ($i=0; $i<count($URLArray); $i++) {
            if (strpos($URLArray[$i], '=')+1 != strlen($URLArray[$i]))
                $ParaArray[] = str_replace('=', '/', $URLArray[$i]);
        }
        return implode('/', $ParaArray);
    }
    /**
     * 返回模拟 Rewirte 形态的 URL 地址
     *
     */
    function GetRewriteUrl() {
        return $_SERVER['PHP_SELF'] . '?' . $this->GetRewriteString() . '.html';
    }
    /**
     * 返回原始形态页面传递字符串
     *
     */
    function GetOriginalString() {
        if (!strpos($this->_query_string, '/')) return $this->_query_string;
        $URLArray = explode('/', $this->GetRewriteString($this->_query_string));
        for ($i=0; $i<count($URLArray); $i=$i+2) {
            if ($URLArray[$i] && $URLArray[$i+1])
                $ParaArray[] = $URLArray[$i] . '=' . $URLArray[$i+1];
        }
        return implode('&', $ParaArray);
    }
    /**
     * 返回原始形态的 URL 地址
     *
     */
    function GetOriginalUrl() {
        return $_SERVER['PHP_SELF'] . '?' . $this->GetOriginalString();
    }
    /**
     * 将解析的参数写入到 $_GET 预定义变量
     *
     */
    function ParseUrl() {
        $URLArray = explode('/', $this->GetRewriteString());
        $_GET = '';
        for ($i=0; $i<count($URLArray); $i=$i+2) {
            $_GET[$URLArray[$i]] = $URLArray[$i+1];
        }
        $_SERVER["QUERY_STRING"] = $this->GetOriginalString();
        $_SERVER["R_QUERY_STRING"] = $this->GetRewriteString();
    }
}
?>