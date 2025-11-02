<?php
// --- Pure PHP Upload Add On Pack ----------------------------------------------
// Copyright 2003 (c) George Petrov, Patrick Woldberg, www.DMXzone.com
//
// Version: 1.0.5
// ------------------------------------------------------------------------------

// Delete the file before updating the database record
class deleteFileBeforeUpdate extends pureUploadAddon
{
	var $version = "105";
	var $debugger = false;

	var $pathThumb;
	var $naming;
	var $suffix;

	var $sqldata;
	
	function deleteFileBeforeUpdate(&$upload) {
		global $DMX_debug;
		parent::pureUploadAddon($upload);
		$this->upload->registerAddOn($this);
		$this->debugger = $DMX_debug;
		$this->debug("<br/><font color=\"#009900\"><b>在刪除之前更新版本 ".$this->version."</b></font><br/><br/>");
	}
	
	// Check if version is uptodate
	function checkVersion($version) {
		$version = str_replace(".", "", $version);
		if ($version > $this->version) {
			$this->error('version');
		}
	}
	
	// The delete function
	function deleteFile() {
		global $HTTP_SERVER_VARS,$HTTP_POST_VARS;

		$this->debug("PHP 版本(<font color=\"#990000\">".phpversion()."</font>)<br/>");
		$this->debug("naming(<font color=\"#990000\">".$this->naming."</font>)<br/>");
		$this->debug("suffix(<font color=\"#990000\">".$this->suffix."</font>)<br/>");
		$this->debug("pathThumb(<font color=\"#990000\">".$this->pathThumb."</font>)<br/>");

		// Go thrue all files
		foreach ($this->upload->uploadedFiles as $file) {
			if ($file->fileName != "") {
				// Check if database entree exist
				if (isset($this->sqldata[$file->field])) {
					// Get filename from the database
					$fileName = $this->sqldata[$file->field];
					$this->debug("檔案名稱 = <font color=\"#000099\"><b>".$fileName."</b></font><br/>");
					// Extract name/extension from filename
					$pos = strrpos($fileName, "/");
					$name = substr($fileName, $pos, strrpos($fileName,".")-$pos);
					// get thumbname created from filename
					if ($this->naming == "suffix") {
						$thumbName = $name.$this->suffix.".jpg";
					} else {
						$thumbName = $this->suffix.$name.".jpg";
					}
					$this->debug("縮圖名稱 = <font color=\"#000099\"><b>".$thumbName."</b></font><br/>");
					
					// If storeType is path
					if ($this->upload->storeType == 'path') {
						// Create an absolute path
						$absPath = $HTTP_SERVER_VARS['PATH_TRANSLATED'];
						$this->debug("absPath1 = <font color=\"#000099\"><b>".$absPath."</b></font><br/>");
						$absPath = eregi_replace('[\\]', '/', $absPath);
						$this->debug("absPath2 = <font color=\"#000099\"><b>".$absPath."</b></font><br/>");
						$absPath = eregi_replace('//', '/', $absPath);
						$this->debug("absPath3 = <font color=\"#000099\"><b>".$absPath."</b></font><br/>");
						$absPath = eregi_replace($HTTP_SERVER_VARS['PHP_SELF'], '', $absPath);
						$this->debug("PHPSELF = <font color=\"#000099\"><b>".$HTTP_SERVER_VARS['PHP_SELF']."</b></font><br/>");
						$this->debug("absPath4 = <font color=\"#000099\"><b>".$absPath."</b></font><br/>");
						$absPath = $absPath.'/'.substr($fileName, 1, strrpos($fileName, '/'));
						$this->debug("absPath = <font color=\"#000099\"><b>".$absPath."</b></font><br/>");
						
						// Extract filename from the path that was stored in the database
						$fileName = substr($fileName, strrpos($fileName, '/')+1);
						$this->debug("檔案名稱 = <font color=\"#000099\"><b>".$fileName."</b></font><br/>");
						
						// Check if file exists and delete the file
						$this->debug("如果檢查 <b>".$absPath.$fileName."</b> 存在<br/>");
						if (file_exists($absPath.$fileName) && $fileName <> '') {
							$this->debug("刪除 <b>".$absPath.$fileName."</b><br/>");
							if (!@unlink($absPath.$fileName)) {
								$this->error('delete', $absPath.$fileName." - ".$file->field." - ".$HTTP_POST_VARS[$file->field]);
							}
						}
						// Check if thumbnail exists and delete the thumbnail
						if ($this->pathThumb !== "") {
							$absPath = $this->pathThumb."/";
						}
						$this->debug("縮圖路徑 = <font color=\"#000099\"><b>".$absPath."</b></font><br/>");
						$this->debug("如果檢查 <b>".$absPath.$thumbName."</b> 存在<br/>");
						if (file_exists($absPath.$thumbName) && $thumbName <> '') {
							$this->debug("刪除 <b>".$absPath.$thumbName."</b><br/>");
							if (!@unlink($absPath.$thumbName)) {
								$this->error('delete', $absPath.$thumbName);
							}
						}
					} else {
						$absPath = $this->upload->path;
						$this->debug("absPath = <font color=\"#000099\"><b>".$absPath."</b></font><br/>");
						$this->debug("檔名 = <font color=\"#000099\"><b>".$fileName."</b></font><br/>");
						// Check if file exists and delete the file
						$this->debug("如果檢查 <b>".$absPath."/".$fileName."</b> 存在<br/>");
						if (file_exists($absPath.'/'.$fileName) && $fileName <> '') {
							$this->debug("刪除 <b>".$absPath."/".$fileName."</b><br/>");
							if (!@unlink($absPath.'/'.$fileName)) {
								$this->error('delete', $absPath.'/'.$fileName." - ".$HTTP_POST_VARS[$file->field]);
							}
						}
						// Check if thumbnail exists and delete the thumbnail
						if ($this->pathThumb !== "") {
							$absPath = $this->pathThumb;
						}
						$this->debug("縮圖路徑 = <font color=\"#000099\"><b>".$absPath."</b></font><br/>");
						$this->debug("縮圖 = <font color=\"#000099\"><b>".$thumbName."</b></font><br/>");
						$this->debug("如果檢查 <b>".$absPath."/".$thumbName."</b> 存在<br/>");
						if (file_exists($absPath.'/'.$thumbName) && $thumbName <> '') {
							$this->debug("刪除 <b>".$absPath."/".$thumbName."</b><br/>");
							if (!@unlink($absPath.'/'.$thumbName)) {
								$this->error('delete', $absPath.'/'.$thumbName);
							}
						}
					}
				}
			}
		}
	}

	// Debugger
	function debug($info) {
		if ($this->debugger) {
			echo "<font face=\"新細明體\" size=\"2\">".$info."</font>";
		}
	}
	
	function error($error, $extra="") {
		// Display error
		echo "<b>刪除檔案發生錯誤</b><br/><br/>";

		switch ($error) {
		// Error renaming the file
		case 'delete':
			echo "刪除函數產生了一個錯誤的檔案 ".$extra."<br/>";
			break;
		case 'version':
			echo "請上傳最新版本的 incPUAddOn.php";
			break;
		}
		
		// Allow to go back and stop the script
		echo "請改正並且 <a href=\"javascript:history.back(1)\">重新嘗試一次</a>";
		$this->upload->failUpload();
		exit;
	}

	function cleanUp() {
	}
}

// Rename the uploaded files with an mask
class renameUploadedFiles extends pureUploadAddon
{
	var $version = "105";
	var $debugger = false;

	var $renameMask;
	
	function renameUploadedFiles(&$upload) {
		global $DMX_debug;
		parent::pureUploadAddon($upload);
		$this->upload->registerAddOn($this);
		$this->debugger = $DMX_debug;
		$this->debug("<br/><font color=\"#009900\"><b>重新命名上傳檔案的版本 ".$this->version."</b></font><br/><br/>");
	}
	
	// Check if version is uptodate
	function checkVersion($version) {
		$version = str_replace(".", "", $version);
		if ($version > $this->version) {
			$this->error('version');
		}
	}
	
	// The actual rename function
	function doRename() {
		$this->debug("PHP version(<font color=\"#990000\">".phpversion()."</font>)<br/>");
		$this->debug("renameMask(<font color=\"#990000\">".$this->renameMask."</font>)<br/>");

		// Go thrue all the files
		foreach ($this->upload->uploadedFiles as $file) {
			if ($file->fileName != "") {
				$this->debug("開始重新命名文件 <b>".$file->fileName."</b><br/>");
				// Generate the new filename
				$this->debug("##name## = <font color=\"#000099\"><b>".$file->name."</b></font><br/>");
				$this->debug("##ext## = <font color=\"#000099\"><b>".$file->extension."</b></font><br/>");
				$this->debug("##size## = <font color=\"#000099\"><b>".$file->fileSize."</b></font><br/>");
				$this->debug("##width## = <font color=\"#000099\"><b>".$file->imageWidth."</b></font><br/>");
				$this->debug("##height## = <font color=\"#000099\"><b>".$file->imageHeight."</b></font><br/>");
				$rename = $this->renameMask;
				$rename = eregi_replace('##name##', $file->name, $rename);
				$rename = eregi_replace('##ext##', $file->extension, $rename);
				$rename = eregi_replace('##size##', "".$file->fileSize, $rename);
				$rename = eregi_replace('##width##', "".$file->imageWidth, $rename);
				$rename = eregi_replace('##height##', "".$file->imageHeight, $rename);
				$this->debug("新的檔名 = <font color=\"#000099\"><b>".$rename."</b></font><br/>");
	
				// Check if filename exists
				$this->debug("如果檢查 <b>".$this->upload->path."/".$rename."</b> 存在<br/>");
				if (file_exists($this->upload->path.'/'.$rename)) {
					// What to do if filename exists
					switch ($this->upload->nameConflict) {
					// Overwrite the file
					case 'over':
						$this->debug("覆蓋 <b>".$this->upload->path."/".$rename."</b><br/>");
						unlink($this->upload->path.'/'.$rename);
						if (!rename($this->upload->path.'/'.$file->fileName, $this->upload->path.'/'.$rename)) {
							$this->error('rename', $rename);
						}
						break;
					// Give error message
					case 'error':
						$this->error('exist', $rename);
						break;
					// Skip renaming and delete the uploaded file
					case 'skip':
						$this->debug("略過 <b>".$this->upload->path."/".$rename."</b><br/>");
						unlink($this->upload->path.'/'.$file->fileName);
						break;
					// Make an unique name
					case 'uniq':
						$this->debug("建立一個新名稱於 <b>".$this->upload->path."/".$rename."</b><br/>");
						$rename = $this->upload->createUniqName($rename);
						$this->debug("重新命名於 <b>".$this->upload->path."/".$rename."</b><br/>");
						if (!rename($this->upload->path.'/'.$file->fileName, $this->upload->path.'/'.$rename)) {
							$this->error('rename', $rename);
						}
						break;
					}
				} else {
					// If filename does not exist
					$this->debug("重新命名到 <b>".$this->upload->path."/".$rename."</b><br/>");
					if (!rename($this->upload->path.'/'.$file->fileName, $this->upload->path.'/'.$rename)) {
						$this->error('rename', $rename);
					}
				}
				
				// Update the name in the fileinfo
				$this->debug("更新 FileInfo<br/>");
				$file->setFileName($rename);
			}
		}
	}

	// Debugger
	function debug($info) {
		if ($this->debugger) {
			echo "<font face=\"新細明體\" size=\"2\">".$info."</font>";
		}
	}
	
	function error($error, $extra="") {
		// Display error
		echo "<b>上傳時更新名稱錯誤</b><br/><br/>";

		switch ($error) {
		// Error renaming the file
		case 'rename':
			echo "更新名稱時產生一個錯誤檔案 ".$extra."<br/>";
			break;
		// Error renaming the file
		case 'exist':
			echo "此檔案 ".$extra." 已經存在<br/>";
			break;
		case 'version':
			echo "請上傳一個新版的 incPUAddOn.php";
			break;
		}
		// Allow to go back and stop the script
		echo "請改正並且 <a href=\"javascript:history.back(1)\">重新嘗試一次</a>";
		$this->upload->failUpload();
		exit;
	}
	
	function cleanUp() {
	}
}

// Mail the uploaded files
class mailUploadedFiles extends pureUploadAddon
{
	var $version = "105";
	var $debugger = false;

	var $fromName;
	var $fromEmail;
	var $toName;
	var $toEmail;
	var $bccEmail;
	var $mailType;
	var $subject;
	var $body;
	var $errors;
	var $html;
	var $deleteFiles;
	var $smtpServer;
	var $smtpUserName;
	var $smtpPassword;
	
	// Include other classes
	var $mail;
	
	function mailUploadedFiles(&$upload) {
		global $DMX_debug;
		parent::pureUploadAddon($upload);
		$this->upload->registerAddOn($this);
		include(dirname(__FILE__) . "/htmlMimeMail.php");
		$this->mail = new htmlMimeMail();
		$this->debugger = $DMX_debug;
		$this->debug("<br/><font color=\"#009900\"><b>Mail Uploaded Files 版本 ".$this->version."</b></font><br/><br/>");
	}
	
	// Check if version is uptodate
	function checkVersion($version) {
		$version = str_replace(".", "", $version);
		if ($version > $this->version) {
			$this->error('version');
		}
	}
	
	function sendMail() {
		global $HTTP_POST_VARS, $HTTP_SERVER_VARS;
		
		$this->debug("PHP version(<font color=\"#990000\">".phpversion()."</font>)<br/>");
		$this->debug("fromName(<font color=\"#990000\">".$this->fromName."</font>)<br/>");
		$this->debug("fromEmail(<font color=\"#990000\">".$this->fromEmail."</font>)<br/>");
		$this->debug("toName(<font color=\"#990000\">".$this->toName."</font>)<br/>");
		$this->debug("toEmail(<font color=\"#990000\">".$this->toEmail."</font>)<br/>");
		$this->debug("bccEmail(<font color=\"#990000\">".$this->bccEmail."</font>)<br/>");
		$this->debug("mailType(<font color=\"#990000\">".$this->mailType."</font>)<br/>");
		$this->debug("subject(<font color=\"#990000\">".$this->subject."</font>)<br/>");
		$this->debug("body(<font color=\"#990000\">".$this->body."</font>)<br/>");
		$this->debug("errors(<font color=\"#990000\">".$this->errors."</font>)<br/>");
		$this->debug("html(<font color=\"#990000\">".$this->html."</font>)<br/>");
		$this->debug("deleteFiles(<font color=\"#990000\">".$this->deleteFiles."</font>)<br/>");
		$this->debug("smtpServer(<font color=\"#990000\">".$this->smtpServer."</font>)<br/>");

		// Must body be html or plain text
		if ($this->html) {
			$this->debug("Setting mail up as html<br/>");
			$this->mail->setHtml(nl2br($this->body));
		} else {
			$this->debug("Setting mail up as text<br/>");
			$this->mail->setText($this->body);
		}
		
		// Attach the uploaded files
		foreach ($this->upload->uploadedFiles as $key => $file) {
			$this->debug("加入 <b>".$this->upload->path."/".$file->fileName."</b> 到附件<br/>");
			$attachment = $this->mail->getfile($this->upload->path.'/'.$file->fileName);
			$this->mail->addAttachment($attachment, $file->fileName);
		}
		
		// Set some parameters
		$this->debug("設置參數<br/>");
		$this->mail->setFrom($this->fromName.' <'.$this->fromEmail.'>');
		$this->mail->setBcc($this->bccEmail);
		$this->mail->setSubject($this->subject);
		
		// Set smtpServer (if empty use localhost)
		if ($this->smtpServer <> '') {
			$this->debug("設定 SMTP-伺服器<br/>");
			$auth = ($this->smtpUserName != "") ? true : false;
			$this->mail->setSMTPParams($this->smtpServer, 25, NULL, $auth, $this->smtpUserName, $this->smtpPassword);
		}

		// Mutiple receivers
		if (strchr($this->toEmail,";")) {
			$sendTo = array();
			$toEmails = split(";", $this->toEmail);
			$toNames = split(";", $this->toName);
			for ($i=0; $i<count($toEmails); $i++) {
				array_push($sendTo, $toNames[$i].' <'.$toEmails[$i].'>');
			}
		} else {
			$sendTo = array($this->toName.' <'.$this->toEmail.'>');
		}
		
		// Send the email depending on mailType
		$this->debug("發送郵件<br/>");
		if ($this->mailType=='smtp') {
			$result = $this->mail->send($sendTo, 'smtp');
			if (!$result) {
				$this->error('smtp');
			}
		} else {
			$result = $this->mail->send($sendTo);
			if (!$result) {
				$this->error('sendmail');
			}
		}

		if ($this->deleteFiles==true) {
			if (isset($this->upload->uploadedFiles)) {
				if (count($this->upload->uploadedFiles) > 0) {
					foreach ($this->upload->uploadedFiles as $file) {
						// Delete the file
						$this->debug("刪除 <b>".$this->upload->path."/".$file->fileName."</b><br/>");
						unlink($this->upload->path.'/'.$file->fileName);
					}
				}
			}
		}
	}
	
	// Debugger
	function debug($info) {
		if ($this->debugger) {
			echo "<font face=\"新細明體\" size=\"2\">".$info."</font>";
		}
	}

	function error($error) {
		// Display error
		echo "<b>發送郵件時發生錯誤</b><br/><br/>";

		switch ($error) {
		// Error sending email thrue smtp
		case 'smtp':
			foreach ($this->mail->errors as $smtperror) {
				echo $smtperror."<br/>";
			}
			break;
		// Error sending email thrue sendmail
		case 'sendmail';
			echo "發送郵件時產生了錯誤<br/>";
			break;
		case 'version':
			echo "請更新 incPUAddOn.php";
			break;
		}
		
		// Allow to go back and stop the script
		echo "請改正並且 <a href=\"javascript:history.back(1)\">在嘗試一次</a>";
		$this->upload->failUpload();
		exit;
	}
	
	function cleanUp() {
	}
}

?>