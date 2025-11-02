<?php
// --- Smart Image Processor ----------------------------------------------------
// Copyright 2003 - 2004 (c) George Petrov, Patrick Woldberg, www.DMXzone.com
//
// Version: 1.0.4
// ------------------------------------------------------------------------------

class resizeUploadedFiles extends pureUploadAddon
{
	var $version = "1.0.4";
	var $debugger = false;
	
	var $component; //GD, GD2 of NetPBM?
	var $resizeImages;
	var $aspectImages;
	var $maxWidth;
	var $maxHeight;
	var $quality;
	var $makeThumb;
	var $aspectThumb;
	var $pathThumb; // if empty use from ppu
	var $naming; // prefix or suffix
	var $suffix;
	var $maxWidthThumb;
	var $maxHeightThumb;
	var $qualityThumb;
	
	var $orgFileName;
	var $newWidth;
	var $newHeight;
	
	function resizeUploadedFiles(&$upload) {
		global $DMX_debug;
		parent::pureUploadAddon($upload);
		$this->upload->registerAddOn($this);
		$this->debugger = $DMX_debug;
		$this->debug("<br/><font color=\"#009900\"><b>Smart Image Processor version ".$this->version."</b></font><br/><br/>");
		if ($this->upload->version < "2.1.3") {
			$this->error("uploadversion", "2.1.3");
		}
	}

	// Check if version is uptodate
	function checkVersion($version) {
		if ($version < $this->version) {
			$this->error('version');
		}
	}
	
	function doResize() {
		$this->debug("PHP version(<font color=\"#990000\">".phpversion()."</font>)<br/>");
		$this->debug("resizeImages(<font color=\"#990000\">".$this->resizeImages."</font>)<br/>");
		$this->debug("aspectImages(<font color=\"#990000\">".$this->aspectImages."</font>)<br/>");
		$this->debug("maxWidth(<font color=\"#990000\">".$this->maxWidth."</font>)<br/>");
		$this->debug("maxHeight(<font color=\"#990000\">".$this->maxHeight."</font>)<br/>");
		$this->debug("quality(<font color=\"#990000\">".$this->quality."</font>)<br/>");
		$this->debug("makeThumb(<font color=\"#990000\">".$this->makeThumb."</font>)<br/>");
		$this->debug("aspectThumb(<font color=\"#990000\">".$this->aspectThumb."</font>)<br/>");
		$this->debug("pathThumb(<font color=\"#990000\">".$this->pathThumb."</font>)<br/>");
		$this->debug("maxWidthThumb(<font color=\"#990000\">".$this->maxWidthThumb."</font>)<br/>");
		$this->debug("maxHeightThumb(<font color=\"#990000\">".$this->maxHeightThumb."</font>)<br/>");
		$this->debug("qualityThumb(<font color=\"#990000\">".$this->qualityThumb."</font>)<br/>");
		$this->debug("naming(<font color=\"#990000\">".$this->naming."</font>)<br/>");
		$this->debug("suffix(<font color=\"#990000\">".$this->suffix."</font>)<br/>");
		$this->debug("<b>Starting the Resize function</b><br/>");
		if ($this->maxWidth == "") { $this->maxWidth = 100000; }
		if ($this->maxHeight == "") { $this->maxHeight = 100000; }
		if ($this->maxWidthThumb == "") { $this->maxWidthThumb = 100000; }
		if ($this->maxHeightThumb == "") { $this->maxHeightThumb = 100000; }
		
		// Check if directory exists and create if needed
		$this->checkDir($this->pathThumb);
		
		$this->resize();
		if (!isset($this->upload->debugger) && $this->debugger == true) {
			exit();
		}
	}
	
	// Check if directory exist and create if needed
	function checkDir($dir) {
		$this->debug("<b>檢查路徑</b><br/>");
		if (!is_dir($dir)) {
			$this->debug("路徑不存在<br/>");
			// Break directory apart
			$dirs = explode('/', $dir);
			$tempDir = $dirs[0];
			$check = false;
			
			for ($i = 1; $i < count($dirs); $i++) {
				$this->debug("檢查 ".$tempDir."<br/>");
				if (is_writeable($tempDir)) {
					$check = true;
				} else {
					$error = $tempDir;
				}
				
				$tempDir .= '/'.$dirs[$i];
				// Check if directory exist
				if (!is_dir($tempDir)) {
					if ($check) {
						// Create directory
						$this->debug("Creating ".$tempDir."<br/>");
						@mkdir($tempDir, 0777);
						@chmod($tempDir, 0777);
					} else {
						// Not enough permissions
						$this->error('權限', $error);
					}
				}
			}
		}
	}
	
	function calculateSize($imgWidth, $imgHeight, $create) {
		$this->debug("計算尺寸<br/>");
		$aspect = true;
		if ($create == "image") {
			$maxWidth = $this->maxWidth;
			$maxHeight = $this->maxHeight;
			if ($this->aspectImages == "false") {
				$aspect = false;
			}
		} else {
			$maxWidth = $this->maxWidthThumb;
			$maxHeight = $this->maxHeightThumb;
			if ($this->aspectThumb == "false") {
				$aspect = false;
			}
		}
		$this->debug("最大寬度 = <font color=\"#000099\"><b>".$maxWidth."</b></font><br/>");
		$this->debug("最大高度 = <font color=\"#000099\"><b>".$maxHeight."</b></font><br/>");
		if (($maxWidth < $imgWidth || $maxHeight < $imgHeight) && $aspect) {
			if ($maxWidth >= $maxHeight) {
				$this->newWidth = round($maxHeight*($imgWidth/$imgHeight), 0);
				$this->newHeight = round($maxHeight, 0);
			} else {
				$this->newWidth = round($maxWidth, 0);
				$this->newHeight = round($maxWidth*($imgHeight/$imgWidth), 0);
			}
			if ($this->newWidth > $maxWidth) {
				$this->newWidth = round($maxWidth, 0);
				$this->newHeight = round($maxWidth*($imgHeight/$imgWidth), 0);
			}
			if ($this->newHeight > $maxHeight) {
				$this->newWidth = round($maxHeight*($imgWidth/$imgHeight), 0);
				$this->newHeight = round($maxHeight, 0);
			}
		} else {
			if ($aspect) {
				$this->newWidth = round($imgWidth, 0);
				$this->newHeight = round($imgHeight, 0);
			} else {
				$this->newWidth = round($maxWidth, 0);
				$this->newHeight = round($maxHeight, 0);
			}
		}
		$this->debug("修改後寬度 = <font color=\"#000099\"><b>".$this->newWidth."</b></font><br/>");
		$this->debug("修改後高度 = <font color=\"#000099\"><b>".$this->newHeight."</b></font><br/>");
	}
	
	function resize() {
		global $_POST;
		if ($this->component == "GD" || $this->component == "GD2"){
			$this->debug("使用 GD 套件縮放 <br/>");
			if (!extension_loaded('gd')) {
				$this->debug("<font color=\"#FF0000\"><b>GD 插件未安裝</b></font><br/>");
    		if (!dl('gd.so')) {
					$this->debug("<font color=\"#FF0000\"><b>無法載入 GD</b></font><br/>");
	   		 	$this->error('gdinstall');
	   		}
    	}
		} else {
		  $this->debug("使用 NetPBM 套件縮放<br/>");
		}
		
		foreach ($this->upload->uploadedFiles as $file) {
			if ($file->fileName != "") {
			$this->imageInfo = @getimagesize($this->upload->path.'/'.$file->fileName);
				if (($this->imageInfo[2] > 0 & $this->imageInfo[2] < 4 )|| $this->imageInfo[2] == 15 || $this->imageInfo[2] == 16){
					$this->debug("開始縮放在 <font color=\"#000099\"><b>".$file->fileName."</b></font><br/>");
					$this->orgFileName = $file->fileName;
					if ($this->makeThumb == "true") {
							$this->debug("<b>建立縮圖</b><br/>");
							$this->calculateSize($file->imageWidth, $file->imageHeight, "thumb");
							if ($this->component == "GD" || $this->component == "GD2"){	
								if ($this->resize_file_GD($file, "thumb")){
									$file->setThumbSize($this->newWidth, $this->newHeight);
								}
							} else {
								if ($this->resize_file_NetPBM($file, "thumb")){
									$file->setThumbSize($this->newWidth, $this->newWidth);
								}
							}
					}
					if ($this->resizeImages == "true") {
						$this->debug("<b>縮放原始圖片</b><br/>");
						$this->calculateSize($file->imageWidth, $file->imageHeight, "image");
							if ($this->component == "GD" || $this->component == "GD2"){	
								if ($this->resize_file_GD($file, "image")) {
									$file->setImageSize($this->newWidth, $this->newHeight);
									$_POST[$this->upload->saveWidth] = $this->newWidth;
									$_POST[$this->upload->saveHeight] = $this->newHeight;
									$_POST[$this->upload->saveWidth] = $this->newWidth;
									$_POST[$this->upload->saveHeight] = $this->newHeight;
								}
							} else {
								if ($this->resize_file_NetPBM($file, "image")){
									$_POST[$this->upload->saveWidth] = $this->newWidth;
									$_POST[$this->upload->saveHeight] = $this->newHeight;
									$_POST[$this->upload->saveWidth] = $this->newWidth;
									$_POST[$this->upload->saveHeight] = $this->newHeight;
								}
				  		}
					}
				}
			}
		}
	}
	
	function resize_file_GD(&$file, $create) {
		$gdfuncs = get_extension_funcs("gd");
		$this->debug("目前圖片尺寸為 (<font color=\"#000099\"><b>".$this->imageInfo[0]."x".$this->imageInfo[1]."</b></font>)<br/>");
		switch ($this->imageInfo[2]) {
		case 1:
		  // tot GD Library 1.6
			$this->debug("圖片種類為 <font color=\"#000099\"><b>GIF</b></font><br/>");
		  if (!array_search("imagecreatefromgif", $gdfuncs)) {
				$this->debug("<font color=\"#FF0000\"><b>imagecreatefromgif 函數不被支援</b></font><br/>");
				//$this->error('gdinvalid', 'gif');
				return(false);
			}
		  $src_img = @imagecreatefromgif($this->upload->path.'/'.$this->orgFileName);
		  break;
		case 2:
		  // vanaf PHP 3.0.16
			$this->debug("圖片種類為 <font color=\"#000099\"><b>JPEG</b></font><br/>");
		  if (!array_search("imagecreatefromjpeg", $gdfuncs)) {
				$this->debug("<font color=\"#FF0000\"><b>imagecreatefromjpeg 函數不被支援</b></font><br/>");
				//$this->error('gdinvalid', 'jpeg');
				return(false);
			}
		  $src_img = @imagecreatefromjpeg($this->upload->path.'/'.$this->orgFileName);
		  break;
		case 3:
		  // vanaf PHP 3.0.13
			$this->debug("圖片種類為 <font color=\"#000099\"><b>PNG</b></font><br/>");
		  if (!array_search("imagecreatefrompng", $gdfuncs)) {
				$this->debug("<font color=\"#FF0000\"><b>imagecreatefrompng 函數不被支援</b></font><br/>");
				//$this->error('gdinvalid', 'png');
				return(false);
			}
		  $src_img = @imagecreatefrompng($this->upload->path.'/'.$this->orgFileName);
		  break;
		case 15:
		  // vanaf PHP 4.0.1
			$this->debug("圖片種類為 <font color=\"#000099\"><b>WBMP</b></font><br/>");
		  if (!array_search("imagecreatefromwbmp", $gdfuncs)) {
				$this->debug("<font color=\"#FF0000\"><b>imagecreatefromwbmp 函數不被支援</b></font><br/>");
				//$this->error('gdinvalid', 'wbmp');
				return(false);
			}
			$src_img = @imagecreatefromwbmp($this->upload->path.'/'.$this->orgFileName);
			break;
		case 16:
		  // vanaf PHP 4.0.1
			$this->debug("圖片種類為 <font color=\"#000099\"><b>XBM</b></font><br/>");
		  if (!array_search("imagecreatefromxbm", $gdfuncs)) {
				$this->debug("<font color=\"#FF0000\"><b>imagecreatefromxbm 函數不被支援</b></font><br/>");
				//$this->error('gdinvalid', 'xbm');
				return(false);
			}
			$src_img = @imagecreatefromxbm($this->upload->path.'/'.$this->orgFileName);
		  break;
		default:
		  $this->debug("<font color=\"#FF0000\"><b>不是有效的圖片類型</b></font><br/>");
		  return(false);
		}
		if(!function_exists("gd_info")) {
			$gdinfo = $this->gd_info();
		} else {
			$gdinfo = gd_info();
		}
		$this->debug("GD Version = <font color=\"#000099\"><b>".$gdinfo["GD Version"]."</b></font><br/>");
	  if (array_search("imagecreatetruecolor", $gdfuncs) and array_search("imagecopyresampled", $gdfuncs) and (!stristr($gdinfo["GD Version"],"1.") or $this->component == "GD2")) {
			// Requires GD 2.0.1 or higher
			$this->debug("using imagecreatetruecolor function<br/>");
			if ($dst_img = @imagecreatetruecolor($this->newWidth,$this->newHeight)) {
				$this->debug("imagecreatetruecolor(".$this->newWidth.",".$this->newHeight.")<br/>");
				// 透明背景
				// imagealphablending($image_new, false);
				imagesavealpha($dst_img, true);
				$color = imagecolorallocatealpha($dst_img, 0, 0, 0, 127);
				imagefill($dst_img, 0, 0, $color);
				//imagecopyresampled($image_new, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
				@imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $this->newWidth, $this->newHeight, $file->imageWidth, $file->imageHeight);
			}
			$this->debug("imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, ".$this->newWidth.", ".$this->newHeight.", ".$file->imageWidth.", ".$file->imageHeight.")<br/>");
		}
		if (!$dst_img) {
			$this->debug("using imagecreate function<br/>");
			$dst_img = @imagecreate($this->newWidth,$this->newHeight);
			$this->debug("imagecreate(".$this->newWidth.",".$this->newHeight.")<br/>");
			@imagecopyresized($dst_img, $src_img, 0, 0, 0, 0, $this->newWidth, $this->newHeight, $file->imageWidth, $file->imageHeight);
			$this->debug("imagecopyresized($dst_img, $src_img, 0, 0, 0, 0, ".$this->newWidth.", ".$this->newHeight.", ".$file->imageWidth.", ".$file->imageHeight.")<br/>");
		}
		// Check if exist and create new unique name if needed
		/*if (file_exists($this->upload->path.'/'.$file->name.".jpg") and ($file->name.".jpg" <> $file->fileName) and ($this->upload->nameConflict == "uniq")) {
			$file->setFileName($this->upload->createUniqName($file->name.".jpg"));
		}*/
		if (file_exists($this->upload->path.'/'.$file->name.".".$file->extension) and ($file->name.".".$file->extension <> $file->fileName) and ($this->upload->nameConflict == "uniq")) {
			$file->setFileName($this->upload->createUniqName($file->name.".".$file->extension));
		}
		// Write new image
		if ($create == "image") {
			//$fileName = $file->name.".jpg";
			$this->debug("圖片(大圖) <Font color=\"#000099\"><b>".$file->name . $file->extension."</b></font> 被建立<br/>");
			$fileName = $file->name.".".$file->extension;
			@unlink($this->upload->path.'/'.$this->orgFileName);
			@imagepng($dst_img, $this->upload->path.'/'.$fileName); // vanaf PHP 3.0.16
			$this->debug("imagepng(".$dst_img.", ".$this->upload->path.".'/'.".$fileName.")<br/>");
			$file->setFileName($fileName);
		} else {
			$this->debug("圖片(縮圖) <Font color=\"#000099\"><b>".$file->name . $file->extension."</b></font> 被建立<br/>");
			if ($this->pathThumb == "") {
				$this->pathThumb = $this->upload->path;
			}
			if ($this->naming == "suffix") {
				//$fileName = $file->name.$this->suffix.".jpg";
				$fileName = $file->name.$this->suffix.".".$file->extension;
			} else {
				//$fileName = $this->suffix.$file->name.".jpg";
				$fileName = $this->suffix.$file->name.".".$file->extension;
			}
			@imagepng($dst_img, $this->pathThumb.'/'.$fileName); // vanaf PHP 3.0.16
			$this->debug("imagepng(".$dst_img.", ".$this->pathThumb.".'/'.".$fileName.")<br/>");
			$file->setThumbFileName($fileName, $this->pathThumb, $this->naming, $this->suffix);
		}
		$this->debug("新圖片 <Font color=\"#000099\"><b>".$fileName."</b></font> 被建立<br/>");
		@imagedestroy($src_img);
		@imagedestroy($dst_img);
		return(true);
	}
	
	function resize_file_NetPBM(&$file, $create) {
		$tmpfname = tempnam($this->upload->path, "sip");
		$this->debug("目前圖片此寸為 (<font color=\"#000099\"><b>".$this->imageInfo[0]."x".$this->imageInfo[1]."</b></font>)<br/>");
		switch ($this->imageInfo[2]) {
	  case 1:
		  // GIF
			$this->debug("圖片類型為 <font color=\"#000099\"><b>GIF</b></font><br/>");
			if (!file_exists(dirname(__FILE__)."/giftopnm")) {
				$this->debug("<font color=\"#FF0000\"><b>找不到 giftopnm</b></font><br/>");
			 	//$this->error('giftopnm');
			 	return false;
			} else {
				system(dirname(__FILE__)."/giftopnm ".$this->upload->path."/".$this->orgFileName.">".$tmpfname);
			}
			break;
		case 2:
		  // JPEG
			$this->debug("圖片類型為 <font color=\"#000099\"><b>JPEG</b></font><br/>");
			if (!file_exists(dirname(__FILE__)."/jpegtopnm")) {
				$this->debug("<font color=\"#FF0000\"><b>找不到 jpegtopnm</b></font><br/>");
			 	//$this->error('jpegtopnm');
			 	return false;
			} else {
				system(dirname(__FILE__)."/jpegtopnm ".$this->upload->path.'/'.$this->orgFileName.">".$tmpfname);
			}
		  break;
		case 3:
			// PNG
			$this->debug("圖片類型為 <font color=\"#000099\"><b>PNG</b></font><br/>");
			if (!file_exists(dirname(__FILE__)."/pngtopnm")) {
				$this->debug("<font color=\"#FF0000\"><b>找不到 pngtopnm</b></font><br/>");
			 	//$this->error('pngtopnm');
			 	return false;
			} else {
				system(dirname(__FILE__)."/pngtopnm ".$this->upload->path.'/'.$this->orgFileName.">".$tmpfname);
			}
			break;
		case 15: 
			// WBMP
			$this->debug("圖片類型為 <font color=\"#000099\"><b>WBMP</b></font><br/>");
			if (!file_exists(dirname(__FILE__)."/pngtopnm")) {
				$this->debug("<font color=\"#FF0000\"><b>找不到 wbmptopn</b></font><br/>");
			 	//$this->error('wbmptopnm');
			 	return false;
			} else { 
				system(dirname(__FILE__)."/wbmptopnm ".$this->upload->path.'/'.$this->orgFileName.">".$tmpfname);
			}
			break;
		case 16:
			// XBM
			$this->debug("圖片類型為 <font color=\"#000099\"><b>XBM</b></font><br/>");
			if (!file_exists(dirname(__FILE__)."/xbmtopnm")) {
				$this->debug("<font color=\"#FF0000\"><b>找不到 xbmtopnm</b></font><br/>");
			 	//$this->error('xbmtopnm');
			 	return false;
			} else {
				system(dirname(__FILE__)."/xbmtopnm ".$this->upload->path.'/'.$this->orgFileName.">".$tmpfname);
			}
			break;
		default:
			$this->debug("<font color=\"#FF0000\"><b>不是有效的圖片類型</b></font><br/>");
		    //$this->error('invalid');
		   return false;
		}
		// Check if exist and create new unique name if needed
		if (file_exists($this->upload->path.'/'.$file->name.".jpg") and ($file->name.".jpg" <> $file->fileName) and ($this->upload->nameConflict == "uniq")) {
			$file->setFileName($this->createUniqName($file->name.".jpg"));
		}
		if ($create == "image") {
			$fileName = $file->name.".jpg";
			unlink($this->upload->path.'/'.$this->orgFileName);
			$this->debug("建立新的 jpeg<br/>");
			system(dirname(__FILE__)."/pnmscale -xy ".$this->newWidth." ".$this->newHeight." ".$tmpfname." | ".dirname(__FILE__)."/ppmtojpeg -qual ".$this->quality." >".$this->upload->path.'/'.$fileName); 
			$file->setFileName($fileName);
		} else {
			if ($this->pathThumb == "") {
				$this->pathThumb = $this->upload->path;
			}
			if ($this->naming == "suffix") {
				$fileName = $file->name.$this->suffix.".jpg";
			} else {
				$fileName = $this->suffix.$file->name.".jpg";
			}
			$this->debug("建立縮圖<br/>");
			system(dirname(__FILE__)."/pnmscale -xy ".$this->newWidth." ".$this->newHeight." ".$tmpfname." | ".dirname(__FILE__)."/ppmtojpeg -qual ".$this->quality." >".$this->pathThumb.'/'.$fileName); 
			$file->setThumbFileName($fileName, $this->pathThumb, $this->naming, $this->suffix);
		}
		unlink($tmpfname);
		$this->debug("新圖片 <Font color=\"#000099\"><b>".$fileName."</b></font> 被建立<br/>");
		return true;
	}

	function check_php_version($version) {
    $testVer=intval(str_replace(".", "",$version));
    $curVer=intval(str_replace(".", "",phpversion()));
    if( $curVer < $testVer ){
      return false;
    }
    return true;
  }
	
	function gd_info() {
		$array = Array(
			"GD Version" => "",
			"FreeType Support" => 0,
			"FreeType Support" => 0,
			"FreeType Linkage" => "",
			"T1Lib Support" => 0,
			"GIF Read Support" => 0,
			"GIF Create Support" => 0,
			"JPG Support" => 0,
			"PNG Support" => 0,
			"WBMP Support" => 0,
			"XBM Support" => 0
		);
		$gif_support = 0;
		ob_start();
		eval("phpinfo();");
		$info = ob_get_contents();
		ob_end_clean();
		foreach(explode("\n", $info) as $line) {
			if(strpos($line, "GD Version")!==false) {
				$array["GD Version"] = trim(str_replace("GD Version", "", strip_tags($line)));
			} else {
				$array["GD Version"] = "Unknown, probably 1.x.x";
			}
			if(strpos($line, "FreeType Support")!==false)
				$array["FreeType Support"] = trim(str_replace("FreeType Support", "", strip_tags($line)));
			if(strpos($line, "FreeType Linkage")!==false)
				$array["FreeType Linkage"] = trim(str_replace("FreeType Linkage", "", strip_tags($line)));
			if(strpos($line, "T1Lib Support")!==false)
				$array["T1Lib Support"] = trim(str_replace("T1Lib Support", "", strip_tags($line)));
			if(strpos($line, "GIF Read Support")!==false)
				$array["GIF Read Support"] = trim(str_replace("GIF Read Support", "", strip_tags($line)));
			if(strpos($line, "GIF Create Support")!==false)
				$array["GIF Create Support"] = trim(str_replace("GIF Create Support", "", strip_tags($line)));
			if(strpos($line, "GIF Support")!==false)
				$gif_support = trim(str_replace("GIF Support", "", strip_tags($line)));
			if(strpos($line, "JPG Support")!==false)
				$array["JPG Support"] = trim(str_replace("JPG Support", "", strip_tags($line)));
			if(strpos($line, "PNG Support")!==false)
				$array["PNG Support"] = trim(str_replace("PNG Support", "", strip_tags($line)));
			if(strpos($line, "WBMP Support")!==false)
				$array["WBMP Support"] = trim(str_replace("WBMP Support", "", strip_tags($line)));
			if(strpos($line, "XBM Support")!==false)
				$array["XBM Support"] = trim(str_replace("XBM Support", "", strip_tags($line)));
		}
		if ($gif_support==="enabled") {
			$array["GIF Read Support"]   = 1;
			$array["GIF Create Support"] = 1;
		}
		if ($array["FreeType Support"]==="enabled") {
			$array["FreeType Support"] = 1;
		}
		if($array["T1Lib Support"]==="enabled") {
			$array["T1Lib Support"] = 1;
		}
		if($array["GIF Read Support"]==="enabled") {
			$array["GIF Read Support"] = 1;
		}
		if($array["GIF Create Support"]==="enabled") {
			$array["GIF Create Support"] = 1;
		}
		if($array["JPG Support"]==="enabled") {
			$array["JPG Support"] = 1;
		}
		if($array["PNG Support"]==="enabled") {
			$array["PNG Support"] = 1;
		}
		if($array["WBMP Support"]==="enabled") {
			$array["WBMP Support"] = 1;
		}
		if($array["XBM Support"]==="enabled") {
			$array["XBM Support"] = 1;
		}
		return $array;
	}
	
	function error($error, $extra = "") {
		// Display error
		echo "<b>Smart Image Processor 發生錯誤</b><br/><br/>";

		switch ($error) {
		// Incorrect version
		case 'version':
	    echo "<b>您沒有最新版本的incResize.php上傳在服務器上。</b><br/>";
  	  echo "此 library 在目前頁面是必需的。<br/>";
			break;

		// Needs newer version of Pure PHP Upload
		case 'uploadversion':
			echo "This version of Smart Image Processor requires version ".$extra." or later of Pure PHP Upload<br/>";
			break;

		// Error renaming the file
		case 'invalid':
			echo "上傳的圖片格式是不被支持的<br/>";
			break;

		// Error with netpbm
		case 'netpbm':
			echo "在NetPBM 元件中發生錯誤<br/>";
			break;

		// Error renaming the file
		case 'gdinvalid':
			echo "GD Library 已安裝但並未支援 ".$extra."<br/>";
			break;

		// GD Library is not found
		case 'gdinstall':
			echo "GD Library 未正確安裝<br/>";
			break;
		}
		
		// Allow to go back and stop the script
		echo "請改正並且 <a href=\"javascript:history.back(1)\">重新嘗試一次</a>";
		$this->upload->failUpload();
		exit;
	}
	
	function debug($info) {
		if ($this->debugger) {
			echo "<font face=\"新細明體\" size=\"2\">".$info."</font>";
		}
	}
	
	function cleanUp() {
		foreach ($this->upload->uploadedFiles as $file) {
			$fileName = $file->name.$this->suffix.".jpg";
			$this->debug("<font color=\"#FF0000\"><b>刪除 ".$fileName."</b></font><br/>");
			@unlink($filename);
		}
	}
}

?>