<?php 
// file: uploadfile.php
// author: http://blog.unijimpe.net
// date: 27/02/2010
class Upload {
	var $maxsize = 0;
	var $message = "";
	var $newfile = "";
	var $newpath = "";
	
	var $filesize = 0;
	var $filetype = "";
	var $filename = "";
	var $filetemp;
	var $fileexte;
	
	var $allowed;
	var $blocked;
	var $isimage;
	
	var $isupload;
	
	function Upload() {
		$this->allowed = array("image/bmp","image/gif","image/jpeg","image/pjpeg","image/png","image/x-png","application/xls");
		$this->blocked = array("php","phtml","php3","php4","js","shtml","pl","py");
		$this->message = "";
		$this->isupload = false;
	}
	function setFile($field) {
		$this->filesize = $_FILES[$field]['size'];
		$this->filename = $_FILES[$field]['name'];
		$this->filetemp = $_FILES[$field]['tmp_name'];
		//$this->filetype = mime_content_type($this->filetemp);
		$this->fileexte = substr($this->filename, strrpos($this->filename, '.')+1);
		
		//$this->newfile = substr(md5(uniqid(rand())),0,8).".".$this->fileexte;
		$this->newfile = "testpmi.xls";
	}
	function setPath($value) {
		$this->newpath = $value;
	}
	function setMaxSize($value) {
		$this->maxsize = $value;	
	}
	function isImage($value) {
		$this->isimage = $value;
	}
	function save() {
		if (is_uploaded_file($this->filetemp)) {
			// check if file valid
			if ($this->filename == "") {
				$this->message = "No file upload";
				$this->isupload = false;
				return false;
			}
			// check max size
			if ($this->maxsize != 0) {
				if ($this->filesize > $this->maxsize*1024) {
					$this->message = "Large File Size";
					$this->isupload = false;
					return false;
				}
			}
			/*
			// check if image
			if ($this->isimage) {
				// check dimensions
				if (!getimagesize($this->filetemp)) {
					$this->message = "Invalid Image File";
					$this->isupload = false;
					return false;	
				}
				// check content type
				if (!in_array($this->filetype, $this->allowed)) {
					$this->message = "Invalid Content Type";
					$this->isupload = false;
					return false;
				}
			}
			*/
			// check if file is allowed
			if (in_array($this->fileexte, $this->blocked)) {
				$this->message = "Archivo no permitido - ".$this->fileexte;
				$this->isupload = false;
				return false;
			}
					
			if (move_uploaded_file($this->filetemp, $this->newfile)) {
				$this->message = "El Archivo se cargó exitosamente!";
				$this->isupload = true;
				return true;
			} else {
				$this->message = "File was not uploaded please try again";
				$this->isupload = false;
				return false;
			}
		} else {
			$this->message = "File was not uploaded please try again";
			$this->isupload = false;
			return false;
		}
	}	
}
?>