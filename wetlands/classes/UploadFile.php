<?php

class UploadFile
{
	protected $destination;
	protected $messages = array();
	protected $_db;
	protected $_data = array();
	protected $permittedTypes = array(
			'image/jpeg',
			'image/pjpeg',
			'image/gif',
			'image/png',
			'image/webp'
	);
	protected $newName;
	protected $typeCheckingOn = true;
	protected $notTrusted = array('bin', 'cgi', 'exe', 'js', 'pl', 'php', 'py', 'sh');
	protected $suffix = '.upload';
	protected $renameDuplicates; 
	
	
	public function __construct($uploadFolder)
	{
		$this->_db = DB::getInstance();
		if (!is_dir($uploadFolder) || !is_writable($uploadFolder)) {
			throw new \Exception("$uploadFolder must be a valid, writable folder.");
		}
		if ($uploadFolder[strlen($uploadFolder)-1] != '/') {
			$uploadFolder .= '/';
		}
		$this->destination = $uploadFolder;
	}
	
       
	public function upload($renameDuplicates = true)
	{
		$this->renameDuplicates = $renameDuplicates;
		$uploaded = current($_FILES);
		if (is_array($uploaded['name'])) {
			foreach ($uploaded['name'] as $key => $value) {
				$currentFile['name'] = $uploaded['name'][$key];
				$currentFile['type'] = $uploaded['type'][$key];
				$currentFile['tmp_name'] = $uploaded['tmp_name'][$key];
				$currentFile['error'] = $uploaded['error'][$key];
				$currentFile['size'] = $uploaded['size'][$key];
				
				if ($this->checkFile($currentFile)) {
				
					$this->moveFile($currentFile);
				}
			}
		} else {
			if ($this->checkFile($uploaded)) {
			
				$this->moveFile($uploaded);
				
				
			}
		}
	}
	
	
	
	
	
	public function getMessages()
	{
		return $this->messages;
	}
	
	protected function checkFile($file)
	{
		if ($file['error'] != 0) {
			$this->getErrorMessage($file);
			return false;
		}
		if ($this->typeCheckingOn) {
		    if (!$this->checkType($file)) {
			    return false;
			}
		}
		$this->checkName($file);
		return true;
	}
	
	protected function getErrorMessage($file)
	{
		switch($file['error']) {
			case 1:
			case 2:
				$this->messages[] = $file['name'] . ' is too big: (max: ' . 
				self::convertFromBytes($this->maxSize) . ').';
				break;
			case 3:
				$this->messages[] = $file['name'] . ' was only partially uploaded.';
				break;
			case 4:
				$this->messages[] = 'No file submitted.';
				break;
			default:
				$this->messages[] = 'Sorry, there was a problem uploading ' . $file['name'];
				break;
		}
	}
	
	
	
	protected function checkType($file) 
	{
		if (in_array($file['type'], $this->permittedTypes)) {
			return true;
		} else {
			$this->messages[] = $file['name'] . ' is not permitted type of file.';
			return false;
		}
	}
	
	protected function checkName($file)
	{
		$this->newName = null;
		$nospaces = str_replace(' ', '_', $file['name']);
		if ($nospaces != $file['name']) {
			$this->newName = $nospaces;
		}
		$nameparts = pathinfo($nospaces);
		$extension = isset($nameparts['extension']) ? $nameparts['extension'] : '';
		if (!$this->typeCheckingOn && !empty($this->suffix)) {
			if (in_array($extension, $this->notTrusted) || empty($extension)) {
				$this->newName = $nospaces . $this->suffix;
			}
		}
		if ($this->renameDuplicates) {
			$name = isset($this->newName) ? $this->newName : $file['name'];
			$existing = scandir($this->destination);
			if (in_array($name, $existing)) {
				$i = 1;
				do {
					$this->newName = $nameparts['filename'] . '_' . $i++;
					if (!empty($extension)) {
						$this->newName .= ".$extension";
					}
					if (in_array($extension, $this->notTrusted)) {
						$this->newName .= $this->suffix;
					}
				} while (in_array($this->newName, $existing));
			}
		}
	}
	
	
	public function created($fields = array()) {

		if(!$this->_db->insert('file', $fields))
		{
			throw new Exception('There was a problem uploading.');
		}
	}
	
	
	
	protected function moveFile($file)
	{
		$filename = isset($this->newName) ? $this->newName : $file['name'];
		$success = move_uploaded_file($file['tmp_name'], $this->destination . $filename);
		if ($success) {
		$fields = array( 
					'userID' => ($_SESSION['user']),
					'filename' => ($filename),
					'uploaded' => (date('Y-m-d H:i:s'))
				);
		$this->created($fields);
	
			$result = $file['name'] . ' was uploaded successfully';
			
			if (!is_null($this->newName)) {	
			}
			$this->messages[] = $result;
		} else {
			$this->messages[] = 'Could not upload ' . $file['name'];
		}
	}
}