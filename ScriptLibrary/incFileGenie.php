<?php
// --- File Genie ---------------------------------------------------------------
// Copyright 2004 (c) George Petrov, Patrick Woldberg, www.DMXzone.com
//
// Version: 1.01
// ------------------------------------------------------------------------------

class fileGenie
{
	// Set version
	var $version = '101';
	
	var $debugger = false;
	
	// Define variables
	var $files;
	var $path = "";
	var $allowedExtensions = "";
	var $includeFolders = false;
	var $index = 0;
	var $thumbnailsSuffix = "_small";
	var $showThumbnailsOnly = false;
	var $pageRecs = 0;
	var $curRec = 2;
	var $pageCols = 1;
	var $curCol = 1;

	function fileGenie() {
		global $DMX_debug;
		$this->files = array();
		$this->debugger = $DMX_debug;
		//$this->debug("<br/><font color=\"#009900\"><b>File Genie version ".$this->version."</b></font><br/><br/>");
		if (isset($_GET["flOffset"])) {
			$this->index = $_GET["flOffset"];
		}
	}
	
	function setPageRecs($pageRecs) {
		$this->pageRecs = $pageRecs;
		if ($pageRecs > 0) $this->curRec = $pageRecs;
	}

	function setPageCols($pageCols) {
		$this->pageCols = $pageCols;
	}
	
	function canRepeat() {
		if ($this->index < count($this->files) && $this->curRec <> 0) {
			return true;
		} else {
			return false;
		}
	}
	
	function isLastColumn() {
		if ($this->curCol == $this->pageCols && $this->index < count($this->files) && $this->curRec <> 1) {
			$this->curCol = 0;
			return true;
		} else {
			return false;
		}
	}
	
	function moveNext() {
		$this->index++;
		if ($this->pageRecs > 0) {
			$this->curRec--;
		}
		$this->curCol++;
	}
	
	function endRepeater() {
		while ($this->curCol-1 < $this->pageCols) {
			echo "<td>&nbsp;</td>";
			$this->curCol++;
		}
	}
	
	function processFolder() {
		if ($this->path == "") $this->path = ".";
		$handle = opendir($this->path);
		while (false !== ($file = readdir($handle))) {
			if ($file != "." && $file != ".." && is_dir($this->path."/".$file) && $this->includeFolders) {
				$fileObj = new fileObj();
				$fileObj->path = $this->path."/".$file;
				$fileObj->name = $file;
				$fileObj->fileName = $file;
				$fileObj->extension = "";
				$fileObj->thumbnailName = $file;
				$fileObj->thumbnailImage = "";
				$fileObj->type = filetype($this->path."/".$file);
				$fileObj->size = filesize($this->path."/".$file);
				$fileObj->sizeName = $this->getSizeName($fileObj->size);
				$fileObj->dateLastModified = filectime($this->path."/".$file);
				$fileObj->attributes = fileperms($this->path."/".$file);
				array_push($this->files, $fileObj);
			}
		}
		$handle = opendir($this->path);
		while (false !== ($file = readdir($handle))) {
			if (is_file($this->path."/".$file)) {
				$name = $file;
				$extension = "";
				$pos = strrpos($file, ".");
				if ($pos) {
					$name = substr($file, 0, $pos);
					$extension = substr($file, $pos+1);
				}
				if ($this->allowedExtensions == "" || ($this->allowedExtensions != "" && stristr($this->allowedExtensions, $extension))) {
					if (!$this->showThumbnailsOnly) {
						$fileObj = new fileObj();
						$fileObj->path = $this->path."/".$file;
						$fileObj->name = $file;
						$fileObj->fileName = $name;
						$fileObj->extension = $extension;
						$fileObj->thumbnailName = $this->path."/".$this->getThumbnailName($this->thumbnailsSuffix, $file);
						$fileObj->thumbnailImage = "<img src=\"".$this->path."/".$this->getThumbnailName($this->thumbnailsSuffix, $file)."\"/>";
						$fileObj->type = filetype($this->path."/".$file);
						$fileObj->size = filesize($this->path."/".$file);
						$fileObj->sizeName = $this->getSizeName($fileObj->size);
						$fileObj->dateLastModified = filectime($this->path."/".$file);
						$fileObj->attributes = fileperms($this->path."/".$file);
						array_push($this->files, $fileObj);
					} elseif ($this->showThumbnailsOnly && !(strpos(strtoupper($file), strtoupper($this->thumbnailsSuffix)) === false)) {
						$fileObj = new fileObj();
						$realFileName = $this->getRealNameFromThumbnail($this->path, $file);
						$name = $realFileName;
						$extension = "";
						$pos = strrpos($realFileName, ".");
						if ($pos) {
							$name = substr($realFileName, 0, $pos);
							$extension = substr($realFileName, $pos+1);
						}
						if ($realFileName != "") {
							$fileObj->path = $this->path."/".$realFileName;
							$fileObj->name = $realFileName;
							$fileObj->fileName = $name;
							$fileObj->extension = $extension;
							$fileObj->thumbnailName = $this->path."/".$this->getThumbnailName($this->thumbnailsSuffix, $realFileName);
							$fileObj->thumbnailImage = "<img src=\"".$this->path."/".$this->getThumbnailName($this->thumbnailsSuffix, $realFileName)."\"/>";
							$fileObj->type = filetype($this->path."/".$realFileName);
							$fileObj->size = filesize($this->path."/".$realFileName);
							$fileObj->sizeName = $this->getSizeName($fileObj->size);
							$fileObj->dateLastModified = filectime($this->path."/".$realFileName);
							$fileObj->attributes = fileperms($this->path."/".$realFileName);
							array_push($this->files, $fileObj);
						}
					}
				}
			}
		}
	}
	
	function getRealNameFromThumbnail($path, $file) {
		$name = $file;
		$extension = "";
		$pos = strrpos($file, ".");
		if ($pos) {
			$name = substr($file, 0, $pos);
			$extension = substr($file, $pos+1);
		}
		if ($this->naming == "suffix") {
			$name = substr($name, 0, strlen($name)-strlen($this->thumbnailsSuffix));
		} else {
			$name = substr($name, strlen($this->thumbnailsSuffix), strlen($name)-strlen($this->thumbnailsSuffix));
		}
		$full = $path."/".$name;
		if (file_exists($full.".jpg")) {
			return $name.".jpg";
		} elseif (file_exists($full.".gif")) {
			return $name.".gif";
		} elseif (file_exists($full.".png")) {
			return $name.".png";
		} elseif (file_exists($full.".bmp")) {
			return $name.".bmp";
		} elseif (file_exists($full.".tiff")) {
			return $name.".tiff";
		} elseif (file_exists($full.".JPG")) {
			return $name.".JPG";
		} elseif (file_exists($full.".GIF")) {
			return $name.".GIF";
		} elseif (file_exists($full.".PNG")) {
			return $name.".PNG";
		} elseif (file_exists($full.".BMP")) {
			return $name.".BMP";
		} elseif (file_exists($full.".TIFF")) {
			return $name.".TIFF";
		} else {
			return "";
		}
	}
	
	function getFileName($file) {
		$name = $file;
		$pos = strrpos($file, ".");
		if ($pos) {
			$name = substr($file, 0, $pos);
		}
		return $name;
	}
	
	function getFileExtension($file) {
		$extension = "";
		$pos = strrpos($file, ".");
		if ($pos) {
			$extension = substr($file, $pos+1);
		}
		return $extension;
	}
	
	function getSizeName($size) {
		$newSize = "";
		if ($size != 0) {
			if ($size < 1024) {
				$newSize = $size." Bytes";
			} elseif ($size >= 1024 && $size < 1048576) {
				$newSize = round(($size/1024), 0)." KB";
			} elseif ($size >= 1048576) {
				$newSize = round(($size/1048576), 2)." MB";
			}
		}
		return $newSize;
	}
	
	function getThumbnailName($suffix, $file) {
		$newFileName = "";
		if ($file != "") {
			$pos = strrpos($file, ".");
			if (!strpos($file, $this->thumbnailsSuffix.".")) {
				if ($this->naming == "suffix") {
					if ($pos) {
						$newFileName = substr($file, 0, $pos).$this->thumbnailsSuffix.".jpg";
					} else {
						$newFileName = $file.$this->thumbnailsSuffix.".jpg";
					}
				} else {
					if ($pos) {
						$newFileName = $this->thumbnailsSuffix.substr($file, 0, $pos).".jpg";
					} else {
						$newFileName = $this->thumbnailsSuffix.$file.".jpg";
					}
				}
			}
		}
		return $newFileName;
	}
	
	function displayNavigation($navType, $navDelimeter) {
		$navBar = "";
		$count = count($this->files);
		if ($this->pageRecs <> 0) {
			if ($navDelimeter == "") $navDelimeter = "|";
			if ($this->pageRecs > 0) {
				$pageStep = $this->pageRecs;
			} else {
				$pageStep = 1;
			}
			$currentPage = $_SERVER["SCRIPT_NAME"];
			switch($navType) {
				case "1": // List Recs
				for ($i=0; $i<$count; $i=$i+$pageStep) {
					$endPageRec = $i+$pageStep;
					if ($endPageRec > $count) $endPageRec = $count;
					if ($this->index > $i && $this->index <= $endPageRec) {
						$navBar = $navBar."<b>".($i+1)." - ".$endPageRec."</b> ".$navDelimeter." ";
					} else {
						$navBar = $navBar."<a href=\"".$currentPage."?flOffset=".$i."\">".($i+1)." - ".$endPageRec."</a> ".$navDelimeter." ";
					}
				}
				$navBar = substr($navBar, 0, (strlen($navBar)-(strlen($navDelimeter)+2)));
				break;
				case "2": // Page Recs
				$pageNum = 1;
				for ($i=0; $i<$count; $i=$i+$pageStep) {
					if ($this->index > $i && $this->index <= $i+$pageStep) {
						$navBar = $navBar."<b>".$pageNum."</b> ".$navDelimeter." ";
					} else {
						$navBar = $navBar."<a href=\"".$currentPage."?flOffset=".$i."\">".$pageNum."</a> ".$navDelimeter." ";
					}
					$pageNum++;
				}
				$navBar = substr($navBar, 0, (strlen($navBar)-(strlen($navDelimeter)+2)));
			}
			echo $navBar;
		}
	}
	
	function getDeleteLink() {
		$currentPage = $_SERVER["SCRIPT_NAME"];
		return $currentPage."?Action=delete&file=".urlencode($this->files[$this->index]->path)."&suffix=".$this.thumbnailsSuffix."&naming".$this.naming;
	}
	
	function folderList($param) {
		$returnValue = "";
		if (count($this->files) > 0) {
			eval("\$returnValue = \$this->files[\$this->index]->$param;");
		}
		return $returnValue;
	}
}

class fileObj {
	var $path;
	var $name;
	var $fileName;
	var $extension;
	var $thumbnailName;
	var $thumbnailImage;
	var $type;
	var $size;
	var $sizeName;
	var $dateLastModified;
	var $attributes;
}
  
function deleteListedFile() {
	if ($_GET["Action"] == "delete" && $_GET["file"] != "") {
		$currentPage = $_SERVER["SCRIPT_NAME"];
		$file = $_GET["file"];
		$suffix = $_GET["suffix"];
		$naming = $_GET["naming"];
		if (file_exists($file)) {
			@unlink($file);
			if (file_exists(getThumbnailName($suffix, $file, $naming))) {
				@unlink(getThumbnailName($suffix, $file, $naming));
			}
		}
		header("Location: ".$currentPage);
	}
}

function getThumbnailName($suffix, $file, $naming) {
	$newFileName = "";
	if ($file != "") {
		$pos = strrpos($file, ".");
		if (!strpos($file, $suffix.".")) {
			if ($naming == "suffix") {
				if ($pos) {
					$newFileName = substr($file, 0, $pos).$suffix.".jpg";
				} else {
					$newFileName = $file.$suffix.".jpg";
				}
			} else {
				if ($pos) {
					$newFileName = $suffix.substr($file, 0, $pos).".jpg";
				} else {
					$newFileName = $suffix.$file.".jpg";
				}
			}
		}
	}
	return $newFileName;
}
?>
