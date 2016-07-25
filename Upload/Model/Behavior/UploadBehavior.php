<?php
/**
 * Application Upload Thumbnails
 *
 * @copyright     Copyright (c) Erland Muchasaj
 * @link          http://erlandmuchasaj.com - Web Developer
 * @email         erlandi_20@hotmail.com
 * @version	  v. 1.0
 */
/* We create a behaviour that we will use to all models that support file upload with the same logic.*/
class UploadBehavior extends ModelBehavior {

	private $WATERMARK_IMAGE = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAH0AAACACAYAAAAmjGbiAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAB3pJREFUeNrsncty3EQUhtWOKShzqWHBjsB4ySrDE2TyABTOE0TZwIKFHapYZ3iC8TobmSew8wSarFhR4x0sKMYsgOU4FwqoBER3qlXVlrtb3VJLOpL+v0o1id3Tt6/P6XNa8kwUQRAEQRAEQRAEQRAEQRAEQRAEQRAEQRBUFMMU9EM/Pvti7lj0/JP3Hl3aCuyObfKyLIv5yyG/7jDGLgPXOcsnnl+P+XUcog0OPOEvsQtwMS5Y+nU4iTpBdaDw+ib8JVVgayHUacMXeJmVC+2MFHgkQaUSXFUlFuB5G6eUgI/G0jXAa1sjr1MAXTsWv8vrP6MAfBSWXgK8jsUfeJT9nArwwUN3AF4H/MceZadUgA8augfwquB/9aj7kgrwwUKvALwK+AuPep9QAT7IQK4GcO/gjre1cXDdoo59W11tAh+cpQcC7mPxdx1c931KwAcF3QO4mLwHIcBzmPkJ2Mrg/u/YUrUugA/GvXsCf+22q7ynpA9TxdVfygURUQM+COh14IUGTyktGyz0ENDaBt818F5DDwmrLfAUgPcWehOQmgZPBXgvoTcJp6m6KQHvHfQ23HDoNqgB7xX0NgOuUG1RBN4b6F2kVnXbpAq8F9C7yqXrtE0ZOHnoXQKv2oefnn+5pAycNHQKwH378ttfjy6fv/phQhk4WeiUgLv26Y+/T6KnL7+PqAMnCZ0i8LK+9Qk4OeiUgZv62DfgpKD3AXixr30ETgZ6n4Dn+uXFIv3nv9/nZeXe2rkZvfPGbP+DNz+7oGJgDMD95ZqHC+Af7X0d7bA9Mn3vHPpIgJMbAwPwVoCTGgsD8NaAkxnTDoCHA36DvX1RAlwoxF/L9gf6kIGLPv+b/fkpB37foWyn4BmAhwGu5uHUx8oAPCzwPoyZAXh44NTHzgC8GeCU52CnQeBHYwf+2qoYO+EvpII71hBwr8kbKnCqFs8AvL1n2qiAZwDe7kOMFMAzAG//IcauwTMAbxc4BfAMwNsH3jV4BuDdAO8SPAPw7oB3BZ4BeLfAuwDPGgQudMyvp10D//nFN7deZc9KP8tVPADx4d5Xx7vs/a76LD5DdtY0eNYgcBJyfUzZ4YkXaqoMngF4L4HXAs8AvLfAK4NnAN5r4JXAMwDvPXBv8AzAByUn8LsG4CK9mUb6D7olqe3LlRPwG+zd6Obe4RCB53oYuX3gMQRBEARBEARBEARBEARBEDVlWTaXX8XVa1V5XEr8gd1MXuLfF+JijK0c3qNKvOciRHmPvud91unc4bvXMv7yLS+3GNMqP83M2oo7cyZL4D9PNeUnhrJL17KeY0gzu8rGIDQa4Enmp1hTx1ROqqpTw+Iq6iDQOAT0tWyjeB3IxbaV13y00B2sw6SFpq4jG1BhzeKbigu/XwYeS1q2fcmFsS1a/Ciga9xsJqHEubuVFrzQWLHWQjVbxFapa6lpa9ImdGVMmfxghfFAF0GPBmLiYCFXoBnKXXPzBrc+b8BrpVXLDgX6ruV3h4X/r3jUavwYDflNxeJrpTdKhCwsJpYfwaGWE/Wo+7nwCEXAx8WMQFr9kezLqgSaiCsmvNxxS0Yi2rulZB0i03hs+yrtQlYh5uC28t4n/DozZRTyPfeU9s5le6s6g9hWsTrp6q3BmkNwuC6xwI3DvnzNKj3ce+6NFi6WrsQh67wNZf5SS5YyUba7rfLe3GOmJdvuVtNeUhX4tLjv1tgWNpYBbwzQZ5b6D0wZQmHhXUvzPKDnC7I0kJPj0KZ5igEsSgJGU7ZzZImJjiyB8rIK9OL+mnq+/4os5U4NgeKkpP6NyRsoVpr47OlykmMlW4lDpGwS7NpirTOfLcRxwWfeJ4dtQFcsVqel4+DnPoN2TD/Xpq2sIvRFcQ5M24/jAnLxVFtb3aZArnjc6bMaZyV15QGZbe8RbsoYlIjAkP9ePOorrmIZEdycWI5sxc+/0/x8FeKo11H5ojrzmNf8aNrl8eZzJSikEchp3HqqsUKrm1f2r7nGA0zrpmy+lq6c6OVjSeRcJBpLX9i2PUfvW6a0SsomVqG6d+isSrcai6ne4+LkyPREVZ4KrtV0L7I/uH8if39P6ddDmea0Ya3qmFNphWcy1cp128dLOuqBtOQyXVYZTPDDGcPBzMLiJaweRt2/lRhhHuJwxtXSpSVvLN5Ft6cf+AZxSvvLpldx0GNYjVtfG4IVJzevRuqO5+pNQLcGZCZXbsowSto/DX00bZuo2jdcDDdbZgE8TKIsuHkH0Lcl/VsaoC8c0q+JYV9PPIPpSoOtdWvVcFt16REMGm+vKgdJ65Bn757uPZN9nhRceGrbphTPl6igpAeLDfcuYiW1jAttzvLbw6EsvvJDFL6RucHNax+kUFZ/3BH0icUbJnJR5idva8vpoXMELse8sXCw5v+NPy5V9dEnuXimZe+Trm7Of77veobAy55XXfimvsu658qcrPJycg5i2faxKeUr3KxZOcyR2mYUOdyI6r0U1x5H0DiUp0uYifEAn47qQUXoSqo2wWzAyiEIgiAIgiAIgiAIgiAIgiAIgiAIgiAIgiAIgiBI6H8BBgC8/lG1idPdSQAAAABJRU5ErkJggg==";

	//////////////////////////////////////////////////////
	/**
	** variables for images
	**/
	private $ALLOWED_EXTENTIONS = array('jpg', 'jpeg', 'png');
	private $XSMALL_THUMBNAIL = 150;
	private $SMALL_THUMBNAIL  = 300;
	private $MEDIUM_THUMBNAIL = 600;
	private $LARGE_THUMBNAIL  = 1024;
	private $XLARGE_THUMBNAIL = 2048;
	private $FILE_LIMIT    = 5242880;  // 5*1024*1024 = 5MB;
	private $USE_THUMBNAIL = false;
	private $USE_WATERMARK = false;
	private $MEMORY_TO_ALLOCATE = '256M';

	/////////////////////////////////////////////////////////
	/*
	* Here we set default value of the model.
	*/
	private $defaultOptions = array('fields' => array(),'use_thumbnails'=>false, 'watermark'=>false);
	private $options = array();


	public function setup(Model $model, $config = array()){
		$this->options[$model->name] = array_merge($this->defaultOptions, $config);
	}

	public function fileExtension(Model $model, $check, $extensions, $allowEmpty = true){
		$file = current($check);
		if ($allowEmpty && empty($file['tmp_name'])){
			return true;
		} 
		$extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));	
		return in_array($extension, $extensions);
	}

	public function fileMaxSize(Model $model, $check, $fileSize, $allowEmpty = true){
		$file = current($check);
		if ($allowEmpty && empty($file['tmp_name'])){
			return true;
		} 
		$currentFilesize = $file['size'];	
		return $currentFilesize<=$fileSize;
	}
	
/*****************************************************
* 		PROCESS MEDIA UPLOAD FOR AVATAR
******************************************************/
	public function processMediaUpload(Model $model, $mediacheck = array()) {	
		$directory 	  = IMAGES . $model->name . DS;
		$directoryXSm = IMAGES . $model->name . DS .'xsmall'.DS;
		$directorySm  = IMAGES . $model->name . DS .'small' .DS;
		$directoryMd  = IMAGES . $model->name . DS .'medium'.DS;
		$directoryLg  = IMAGES . $model->name . DS .'large' .DS;
		$directoryXLg = IMAGES . $model->name . DS .'xlarge'.DS;
		foreach ($this->options[$model->name]['fields'] as $field => $path) {
			if (!isset($mediacheck[$field]['name']) || empty($mediacheck[$field]['name'])) {
				$model->invalidate($field, __('You must upload a file before you continue!'));  
				return false;
			}
			
			if(!is_uploaded_file($mediacheck[$field]['tmp_name'])) {
				$model->invalidate($field, __('You must upload a file before you continue!'));	
				return false; 
			} 
			
			if (($mediacheck[$field]['size'] > $this->FILE_LIMIT)) {
				$model->invalidate($field, __('File is biger then the limit! %s',  $this->__humanFileSize($this->FILE_LIMIT)));	
				return false; 
			}

			$extension = mb_strtolower(pathinfo($mediacheck[$field]['name'], PATHINFO_EXTENSION),'UTF-8');	
			if(!in_array($extension, $this->ALLOWED_EXTENTIONS)){
				$model->invalidate($field, __('Invalid file format!'));	
				return false;
			}	
			$phpFileUploadErrors = array(
				0 => 'There is no error, the file uploaded with success',
				1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
				2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
				3 => 'The uploaded file was only partially uploaded',
				4 => 'No file was uploaded',
				6 => 'Missing a temporary folder',
				7 => 'Failed to write file to disk.',
				8 => 'A PHP extension stopped the file upload.',
			);
			if ($mediacheck[$field]["error"] > 0) {
				$index = $mediacheck[$field]["error"];
				$explain = $phpFileUploadErrors[$index];  
				$model->invalidate($field, $explain);
				return false;  
			}
			
			$this->__makeDirectory($directory);
			if ($this->options[$model->name]['use_thumbnails']==true) {
				$this->__makeDirectory($directorySm);
				$this->__makeDirectory($directoryMd);
				$this->__makeDirectory($directoryLg);
			}

			if (file_exists($directory.$mediacheck[$field]['name']) && is_file($directory.$mediacheck[$field]['name'])) { 
				$model->invalidate($field, __('File allredy exists!'));
				return false;
			}
		}
		return true; 
	}	

/*****************************************************
* 		BEFORE SAVE
******************************************************/
	private  $oldFile;	
	public function beforeSave(Model $model, $options = array()) {
		$directory    = IMAGES . $model->name . DS; 
		$directoryXSm = IMAGES . $model->name . DS .'xsmall'.DS;
		$directorySm  = IMAGES . $model->name . DS .'small' .DS;
		$directoryMd  = IMAGES . $model->name . DS .'medium'.DS;
		$directoryLg  = IMAGES . $model->name . DS .'large' .DS;
		$directoryXLg = IMAGES . $model->name . DS .'xlarge'.DS;
		foreach ($this->options[$model->name]['fields'] as $field => $path) {
			if (isset($model->id) && !empty($model->id)) {
				$model->oldFile = $model->field($field);
				/*$model->oldFile = $model->find('first', array('conditions' => array($model->name.'.id' => $model->id)));*/
				/*And we can accsess it like $model->oldFile[$model->name][$field]*/
			}
			if (isset($model->data[$model->name][$field]) && !empty($model->data[$model->name][$field]['tmp_name'])) {
				/*=================================================*/
				$file		=	$model->data[$model->name][$field];
				$filename	=	stripslashes($file['name']);
				$file_name	=	preg_replace('/\s+/', '_', trim($filename));
				$file_name	=	$this->__sanitizeFilename($file_name);
				$timestamp	=	time() . "_"; 
				$full_name	=	$timestamp.$file_name;
				$mainFile	=	$directory.$full_name;
				if (move_uploaded_file($file['tmp_name'], $mainFile)) {
					if ($this->options[$model->name]['use_thumbnails']===true) {
						$this->__createThumbnailUpload($full_name, $this->SMALL_THUMBNAIL, $directory, $directorySm);
						$this->__createThumbnailUpload($full_name, $this->MEDIUM_THUMBNAIL, $directory, $directoryMd);
						$this->__createThumbnailUpload($full_name, $this->LARGE_THUMBNAIL,  $directory, $directoryLg);
					}
					if ($this->options[$model->name]['watermark']===true) {
						$this->__addWatermark($directory, $full_name);
						$this->__addWatermark($directorySm, $full_name);
						$this->__addWatermark($directoryMd, $full_name);
						$this->__addWatermark($directoryLg, $full_name);
					}
					
					$model->data[$model->name][$field] = $full_name;
					return true;
				} else {
					$model->invalidate($field, __('File did not Upload succesfully, Please try again!'));
					return false;
				}
				/*=================================================*/
			}
		}		
		return true;
	}

/*****************************************************
* 		AFTER SAVE
******************************************************/
	public function afterSave(Model $model, $created, $options = array()) {
		$directory    = IMAGES . $model->name . DS;
		$directoryXSm = IMAGES . $model->name . DS .'xsmall'.DS;
		$directorySm  = IMAGES . $model->name . DS .'small' .DS;
		$directoryMd  = IMAGES . $model->name . DS .'medium'.DS;
		$directoryLg  = IMAGES . $model->name . DS .'large' .DS;
		$directoryXLg = IMAGES . $model->name . DS .'xlarge'.DS;
		foreach ($this->options[$model->name]['fields'] as $field => $path) {
			if (isset($model->data[$model->name][$field]) && !empty($model->data[$model->name][$field])) {
				if (isset($model->oldFile) && !empty($model->oldFile)) {
					$file_to_deleteORG = $directory.$model->oldFile;
					$this->__deleteFile($file_to_deleteORG);
					if ($this->options[$model->name]['use_thumbnails']==true) {
						$file_to_deleteXSM = $directoryXSm.$model->oldFile;
						$file_to_deleteSM  = $directorySm .$model->oldFile;
						$file_to_deleteMD  = $directoryMd .$model->oldFile;
						$file_to_deleteLG  = $directoryLg .$model->oldFile;
						$file_to_deleteXLG = $directoryXLg.$model->oldFile;
						/*====================================*/
						$this->__deleteFile($file_to_deleteSM);
						$this->__deleteFile($file_to_deleteMD);
						$this->__deleteFile($file_to_deleteLG);
					}
				}
			} else {  $model->data[$model->name][$field] = $model->oldFile; }
		}		
	   return true;
	}

/*****************************************************
* 		BEFORE DELETE
******************************************************/	
	private  $fileName;	
	public function beforeDelete(Model $model, $cascade = true) {
		foreach ($this->options[$model->name]['fields'] as $field => $path) {
			if (isset($model->id) && !empty($model->id)) {
				$model->fileName = $model->field($field);
			}
			// $model->fileName = $model->field($field);
		}
		return true;
	}

/*****************************************************
* 		AFTER DELETE
******************************************************/        
	public function afterDelete(Model $model) {
		$directory    = IMAGES . $model->name . DS;
		$directoryXSm = IMAGES . $model->name . DS .'xsmall'.DS;
		$directorySm  = IMAGES . $model->name . DS .'small' .DS;
		$directoryMd  = IMAGES . $model->name . DS .'medium'.DS;
		$directoryLg  = IMAGES . $model->name . DS .'large' .DS;
		$directoryXLg = IMAGES . $model->name . DS .'xlarge'.DS;
		foreach ($this->options[$model->name]['fields'] as $field => $path) {
			if (isset($model->fileName) && !empty($model->fileName)) {
				$file_to_deleteORG = $directory . $model->fileName;
				$this->__deleteFile($file_to_deleteORG);
				if ($this->options[$model->name]['use_thumbnails']==true) {
					$file_to_deleteXSM = $directoryXSm . $model->fileName;
					$file_to_deleteSM  = $directorySm  . $model->fileName;
					$file_to_deleteMD  = $directoryMd  . $model->fileName;
					$file_to_deleteLG  = $directoryLg  . $model->fileName;
					$file_to_deleteXLG = $directoryXLg . $model->fileName;
					/*====================================*/
					$this->__deleteFile($file_to_deleteSM);
					$this->__deleteFile($file_to_deleteMD);
					$this->__deleteFile($file_to_deleteLG);
				}
			}
		}
		return true;
	}

/*****************************************************
* 		BEFORE VALIDATE
******************************************************/  
	public function beforeValidate(Model $model, $options = array()){
		if(empty($model->data[$model->name]['id'])) {
			return true;
		}  else   {
			foreach ($this->options[$model->name]['fields'] as $field => $path) {
				if(empty($model->data[$model->name][$field]["name"])){
					unset($model->data[$model->name][$field]);
				}
			}	    	
			return true; //this is required, otherwise validation will always fail
		}
	}

////////////////////////////////////////////////////////////////////////////////////	
/**
 * Normalize the data 
 * Replace Special character from filename 
 * Sanitize filename 
 * @param string $filename
 * @return string
 */	
	public function __sanitizeFilename($filename = '') {
		// a combination of various methods
		// we don't want to convert html entities, or do any url encoding
		// we want to retain the "essence" of the original file name, if possible
		// char replace table found at:
		// http://www.php.net/manual/en/function.strtr.php#98669
		$replace = array(
			'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'Ae', 'Å'=>'A', 'Æ'=>'A', 'Ă'=>'A', 'Ą' => 'A', 'ą' => 'a',
			'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'ae', 'å'=>'a', 'ă'=>'a', 'æ'=>'ae',
			'þ'=>'b', 'Þ'=>'B',
			'Ç'=>'C', 'ç'=>'c', 'Ć' => 'C', 'ć' => 'c',
			'Ð'=>'Dj', 
			'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ę' => 'E', 'ę' => 'e',
			'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e',
			'ƒ'=>'f', 
			'Ğ'=>'G', 'ğ'=>'g',
			'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'İ'=>'I', 'ı'=>'i', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i',
			'Ł' => 'L', 'ł' => 'l',
			'Ñ'=>'N', 'Ń' => 'N', 'ń' => 'n',
			'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'Oe', 'Ø'=>'O', 'ö'=>'oe', 'ø'=>'o',
			'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
			'Š'=>'S', 'š'=>'s', 'Ş'=>'S', 'ș'=>'s', 'Ș'=>'S', 'ş'=>'s', 'ß'=>'ss', 'Ś' => 'S', 'ś' => 's',
			'ț'=>'t', 'Ț'=>'T',
			'Ù'=>'U', 'Ú'=>'U', 'Û'=>'U', 'Ü'=>'Ue',
			'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ü'=>'ue', 
			'Ý'=>'Y',
			'ý'=>'y', 'ý'=>'y', 'ÿ'=>'y',
			'Ž'=>'Z', 'ž'=>'z', 'Ż' => 'Z', 'ż' => 'z', 'Ź' => 'Z', 'ź' => 'z'
		);

		$search = array(
			'@<script[^>]*?>.*?</script>@si',   /* strip out javascript */
			'@<[\/\!]*?[^<>]*?>@si',            /* strip out HTML tags */
			'@<style[^>]*?>.*?</style>@siU',    /* strip style tags properly */
			'@<![\s\S]*?--[ \t\n\r]*>@'         /* strip multi-line comments */
		);
				

		$cyr = array('ж', 'ч', 'щ',  'ш', 'ю',  'а', 'б', 'в', 'г', 'д', 'е', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ъ', 'ь', 'я', 'Ж',  'Ч',  'Щ',   'Ш',  'Ю',  'А', 'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ъ', 'Ь', 'Я');

		$lat = array("l", "s", 'zh', 'ch', 'sht', 'sh', 'yu', 'a', 'b', 'v', 'g', 'd', 'e', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'y', 'x', 'q', 'Zh', 'Ch', 'Sht', 'Sh', 'Yu', 'A', 'B', 'V', 'G', 'D', 'E', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'c', 'Y', 'X', 'Q');

		
		$filename = str_replace($cyr, $lat, $filename);
		$filename = strtr($filename, $replace);
		$filename = preg_replace($search, '', $filename);	/* Replace these elements with empty */
	
		// convert & to "and", @ to "at", and # to "number"
		$filename = preg_replace(array('/[\&]/', '/[\@]/', '/[\#]/'), array('-and-', '-at-', '-number-'), $filename);
		$filename = preg_replace('/[^(\x20-\x7F)]*/','', $filename); // removes any special chars we missed
		$filename = str_replace(' ', '-', $filename); // convert space to hyphen 
		$filename = str_replace('\'', '', $filename); // removes apostrophes
		$filename = preg_replace('/[^\w\-\.]+/', '', $filename); // remove non-word chars (leaving hyphens and periods)
		$filename = preg_replace('/[\-]+/', '-', $filename); // converts groups of hyphens into one
		$filename = trim($filename, '-'); // remove hyphen from begining or end of the string

		//return strtolower($filename);
		return mb_strtolower($filename,'UTF-8');
	}

/**
 * Create Thumbnails
 *
 * @throws NotFoundException
 * @param string $filename, number $width, string $originalDirectory, string $thumbnailDirectory
 * @return Image created 
 */
	public function __createThumbnailUpload($filename, $width, $originalDirectory, $thumbnailDirectory, $compression=7){
		ini_set('memory_limit', $this->MEMORY_TO_ALLOCATE);
		$imageData = getimagesize($originalDirectory.$filename);
		if (!isset($imageData) || empty($imageData) || !is_array($imageData)) {
			return false;
		}

		if ($compression < 1 ) {
			$compression = 1;
		}
		if ($compression > 9 ) {
			$compression = 9;
		}
		$compressionArray = array(1=>90, 2=>80, 3=>70, 4=>60, 5=>50, 6=>40, 7=>30, 8=> 20, 9=> 10);		
		switch($imageData['mime']){
			case 'image/png':  
				$img = 'png';  $blending = false; 
				break;
			case 'image/gif':  
				$img = 'gif';  $blending = true;  
				break;
			case 'image/jpeg':
			case 'image/pjpeg':
				$img = 'jpeg';
				$compression = $compressionArray[$compression];
				break;
			default: 
				$img = false;
		}

		if (!$img) {
			return false;
		}

		$imagecreate= "imagecreatefrom{$img}";
		$imagesave  = "image{$img}";
		$SrcImage 	= $imagecreate($originalDirectory.$filename);

		$ox = imagesx($SrcImage);
		$oy = imagesy($SrcImage);
		
		$nx = $width;
		$ny = floor($oy * ($width / $ox));		
		$NewImage = imagecreatetruecolor($nx, $ny);
		// preserve transparency for PNG and GIF images
		if ($img == 'png' || $img == 'gif'){
			// allocate a color for thumbnail
			$background = imagecolorallocate($NewImage, 255, 255, 255);
			// define a color as transparent
			imagecolortransparent($NewImage, $background);
			// set the blending mode for thumbnail
			imagealphablending($NewImage, $blending);
			// set the flag to save alpha channel
			$alfa = !$blending;
			imagesavealpha($NewImage, true);
		}

		$this->__makeDirectory($thumbnailDirectory);
		$DestFolder = $thumbnailDirectory.$filename;
		if(imagecopyresampled($NewImage, $SrcImage, 0, 0, 0, 0, $nx, $ny, $ox, $oy)){
			$imagesave($NewImage, $DestFolder, $compression);
			if(is_resource($NewImage)) { 
				imagedestroy($NewImage); 
			} 
		}

		if(is_resource($SrcImage)){
			imagedestroy($SrcImage);
		}
		return true;
	}

/**
 * Create watermark
 *
 * @throws NotFoundException
 * @param string $filename, number $x, number $y, string $imageDirectory
 * @return Image create watermark 
 */
	// $this->__addWatermark($directory, $imagename);
	public function __addWatermark($imageDirectory, $filename, $x = 0, $y = 0){
		$watermark = WWW_ROOT.'img'.DS.'general'.DS.'static'.DS.'watermark.png';
		$sourceImage = $imageDirectory.$filename;
		// $watermark = $this->WATERMARK_IMAGE;
		if(file_exists($watermark) && is_file($watermark)) {
			if(file_exists($sourceImage) && is_file($sourceImage)) {
				
				$image_extension = @end(explode(".", $filename));
				$imageSize = getimagesize($sourceImage);
				if (!isset($imageSize) || empty($imageSize) || !is_array($imageSize)) {
					return false;
				}
				$imgtype = image_type_to_mime_type($imageSize[2]);
				switch($imgtype) {
					case 'image/jpeg':
						$im = imagecreatefromjpeg($sourceImage);
						$img = 'jpeg';
						break;
					case 'image/gif': 
						$im = imagecreatefromgif($sourceImage);
						$img = 'gif';
						$blending = true;  
						break;
					case 'image/png':
						$im = imagecreatefrompng($sourceImage);
						$img = 'png';
						$blending = false; 
						break;
					default:
						$im = false;
				}

				if (!$im) {
					return false;
				}

				if ($img == 'png' || $img == 'gif'){
					// allocate a color for thumbnail
					$background = imagecolorallocate($im, 255, 255, 255);
					// define a color as transparent
					imagecolortransparent($im, $background);
					// set the blending mode for thumbnail
					imagealphablending($im, $blending);
					// set the flag to save alpha channel
					$alfa = !$blending;
					imagesavealpha($im, $alfa);
				}

				// watermark Creation
				$stamp = @imagecreatefrompng($watermark);
				// margin attributes
				$marge_right  = 0;
				$marge_bottom = 0;	
				// watermark dimensions
				$watermark_o_width = imagesx($stamp);
				$watermark_o_height = imagesy($stamp);	
				// watermark position on image
				$dest_x = ($imageSize[0] - $watermark_o_width) / 2 - $marge_right;
				$dest_y = ($imageSize[1] - $watermark_o_height) / 2 - $marge_bottom;
				imagealphablending($stamp, true);
				imagecopy($im, $stamp, $dest_x, $dest_y, 0, 0, $watermark_o_width, $watermark_o_height);

				// WATERMARK CORNER IMAGE
				// $newWidth = $imageSize[0]/4;  
				// $newHeight = $watermark_o_height * $newWidth / $watermark_o_width; 
				// $dest_x = ($imageSize[0] - $newWidth) / 2 - $marge_right;
				// $dest_y = ($imageSize[1] - $newHeight) / 2 - $marge_bottom;
				// imagecopy($im, $stamp, $dest_x, $dest_y, 0, 0, $newWidth, $newHeight);

				switch($image_extension) {
					case "jpg": 
						header('Content-type: image/jpeg');
						imagejpeg($im, $sourceImage, 100);
						break;
					case "jpeg":
						header('Content-type: image/jpeg');
						imagejpeg($im, $sourceImage, 100);
						break;
					case "png":
						header('Content-type: image/png');
						imagepng($im, $sourceImage);
						break;
					case "gif":
						header('Content-type: image/gif');
						imagegif($im, $sourceImage);
						break;
				}

				imagedestroy($im);
				imagedestroy($stamp);
			}
		}
		return true;
	}



/**
 * Get file extention
 *
 * @param string $file,
 * @return string 
 */
    public function __getExt($filename) {
        return mb_strtolower(trim(mb_strrchr($file, '.'), '.'));
        //return mb_strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    }

/**
 * check if a file is image
 *
 * @param string $path,
 * @return boolean 
 */
	private function __isImage($path = null) {
		if(is_null($path)) {
			return false; 
		}

		if (!isset($path) || empty($path)) {
			return false; 
		}

		if(!file_exists($path) || !is_file($path)) {	
			return false;
		}

		$a = getimagesize($path);
		if (!isset($a) || empty($a) || !is_array($a)) {
			return false;
		}
		$image_type = $a[2];
		if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP))){
			return true;
		}
		return false;
	}

/**
 * check if a file is image of any type
 *
 * @param string $path,
 * @return boolean 
 */
    private function __imageTypeToExtension($imagetype) {
    	if(is_null($imagetype)) {
			return false; 
		}

		if (!isset($imagetype) || empty($imagetype)) {
			return false; 
		}
        switch($imagetype) {
            case IMAGETYPE_GIF      : return 'gif';
            case IMAGETYPE_JPEG     : return 'jpg';
            case IMAGETYPE_PNG      : return 'png';
            case IMAGETYPE_SWF      : return 'swf';
            case IMAGETYPE_PSD      : return 'psd';
            case IMAGETYPE_BMP      : return 'bmp';
            case IMAGETYPE_TIFF_II  : return 'tiff';
            case IMAGETYPE_TIFF_MM  : return 'tiff';
            case IMAGETYPE_JPC      : return 'jpc';
            case IMAGETYPE_JP2      : return 'jp2';
            case IMAGETYPE_JPX      : return 'jpf';
            case IMAGETYPE_JB2      : return 'jb2';
            case IMAGETYPE_SWC      : return 'swc';
            case IMAGETYPE_IFF      : return 'aiff';
            case IMAGETYPE_WBMP     : return 'wbmp';
            case IMAGETYPE_XBM      : return 'xbm';
            default                 : return false;
        }
    }

/**
 * Return Size of a type file 
 *
 * @param int $bytes,
 * @return string 
 */
	private function __humanFileSize($bytes, $decimals = 0) {
		$sz = 'BKMGTP';
		$factor = floor((strlen($bytes) - 1) / 3);
		return sprintf("%.{$decimals}f", $bytes / pow(1000, $factor)) . @$sz[$factor] . 'B';
	}

/**
 * Create Directory
 *
 * @param string $targetdir,
 * @return boolean 
 */
    private function __makeDirectory($targetdir) {
        if(!file_exists($targetdir) || !is_dir($targetdir)) {
            App::uses('Folder', 'Utility');
            $dir = new Folder($targetdir, true, 0777);
            if(!$dir) {
                return false;
            }
        }
        return true;
    }

/**
 * delete a file
 *
 * @param string $filename,
 * @return boolean 
 */
	// $this->__deleteFile$($full_filename);
	private function __deleteFile($filename = null) {
		if(is_null($filename)) {
			return true; 
		}

		if (!isset($filename) || empty($filename)) {
			return true; 
		}

		if(file_exists($filename) && is_file($filename)) {	
			if(unlink($filename)) {
				return true;
			}
		}
		return true;
	}

	private function deleteAll($directory, $empty = false) {
		if(substr($directory,-1) == "/") {
			$directory = substr($directory,0,-1);
		}
		if(!file_exists($directory) || !is_dir($directory)) {
			return false;
		} elseif(!is_readable($directory)) {
			return false;
		} else {
			$directoryHandle = opendir($directory);
			while ($contents = readdir($directoryHandle)) {
				if($contents != '.' && $contents != '..') {
					$path = $directory . "/" . $contents;
				   
					if(is_dir($path)) {
						deleteAll($path);
					} else {
						unlink($path);
					}
				}
			}
			closedir($directoryHandle);
			if($empty == false) {
				if(!rmdir($directory)) {
					return false;
				}
			}
			return true;
		}
	}

	// Helper stuff
	public function removeDir($path){
		if (file_exists($path) && is_dir($path)) {
			$dirHandle = opendir($path);
			while (false !== ($file = readdir($dirHandle))) {
				if ($file!='.' && $file!='..') {
					$tmpPath=$path.'/'.$file;
					chmod($tmpPath, 0777);
					if (is_dir($tmpPath)) {
						$this->removeDir($tmpPath);
					} else {
						if (file_exists($tmpPath)) {
							@unlink($tmpPath);
						}
					}
				}
			}
			closedir($dirHandle);
			if (file_exists($path)) {
				@rmdir($path);
			}
		}
	}

	public function copyDir($source, $dest, $overwrite = false){
		if (!is_dir($dest)) {
			mkdir($dest);
		}
		if ($handle = opendir($source)) {
			while (false !== ($file = readdir($handle))) {
				if ($file != '.' && $file != '..') {
					$path = $source . '/' . $file;

					if (is_file($path)) {
						if (!is_file($dest . '/' . $file) || $overwrite) {
							$ext = pathinfo($file, PATHINFO_EXTENSION);
							//if ('php' != $ext) {
								if (!@copy($path, $dest . '/' . $file)) {
								}
							//}
						}
					} elseif (is_dir($path)) {

						if (!is_dir($dest . '/' . $file)) {
							mkdir($dest . '/' . $file);
						}

						$this->copyDir($path, $dest . '/' . $file, $overwrite);
					}
				}
			}
			closedir($handle);
		}
	}
}
