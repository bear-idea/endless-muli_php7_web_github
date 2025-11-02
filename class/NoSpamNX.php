<?php
/**
 * 防機器人用 NoSpamNX
 *
 * Original By http://www.svenkubiak.de/nospamnx-en
 */
class NoSpamNX
{
    private $_sessionName;

    /**
     * 建構式
     *
     * @param string $name
     */
    public function __construct($name = 'valueForNoSpamNX')
    {
        if (!isset($_SESSION[$name])) {
            $_SESSION[$name] = $this->generateNames();
        }
        $this->_sessionName = $name;
    }

    /**
     * 建立驗證欄位值
     *
     */
    private function generateNames()
    {
		// generate random names and value for the hidden formfields
		$nospamnx = array(
			'nospamnx-1'		=> md5(uniqid(rand(), true)),
			'nospamnx-2'		=> md5(uniqid(rand(), true)),
			'nospamnx-2-value'	=> md5(uniqid(rand(), true))
		);

		return $nospamnx;
    }

    /**
     * 建立隱藏欄位 HTML；利用隱藏欄位先後順序不同，使用 md5 or sha1 編碼
     * 
     */
    public function addHiddenFields()
    {
        $nospamnx = $_SESSION[$this->_sessionName];

        if (1 === rand(1,2)) {
			return '<input type="text" name="nospamnx['.$nospamnx['nospamnx-1'].']" value="" style="display: none; " /><input type="text" name="nospamnx['.$nospamnx['nospamnx-2'].']" value="'.md5($nospamnx['nospamnx-2-value']).'" style="display: none; " />';
		} else {
			return '<input type="text" name="nospamnx['.$nospamnx['nospamnx-2'].']" value="'.sha1($nospamnx['nospamnx-2-value']).'" style="display: none; " /><input type="text" name="nospamnx['.$nospamnx['nospamnx-1'].']" value="" style="display: none; " />';
		}
	}

	/**
     * 驗證 SESSION 與 POST 的值是否一致
     *
     * @param array $postData
     */
    public function Verify($postData)
    {
        $nospamnx = $_SESSION[$this->_sessionName];

		if (!array_key_exists($nospamnx['nospamnx-1'], $postData)) {
		    return false;
		}

		// check if first hidden field is empty
		if ($postData[$nospamnx['nospamnx-1']] != "") {
			return false;
		}

		// check if second hidden field is in $_POST data
		if (!array_key_exists($nospamnx['nospamnx-2'], $postData)) {
			return false;
		}
	
		// 根據 POST 過來的值順序不同，以 md5 or sha1 判斷
        if ($nospamnx['nospamnx-1'] == current(array_keys($postData))) {
            $encode_value = md5($nospamnx['nospamnx-2-value']);
        } else {
            $encode_value = sha1($nospamnx['nospamnx-2-value']);
        }
        if ($postData[$nospamnx['nospamnx-2']] != $encode_value) {
            return false;
        }

		// 通過檢查即清空 SESSION
	    unset($_SESSION[$this->_sessionName]);
		return true;
    }
}

?>