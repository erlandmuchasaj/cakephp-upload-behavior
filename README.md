# cakephp-upload-behavior
A Lightweight Cakephp 2.x Upload Behaviour that simply Works

Installation

1) Drop the file UploadBehaviour inside you project app/Model/Behaviour.

2) Inicialise the script 

	public $actsAs = array(
		'Upload' => array('fields' => array('image_path'=>''),'use_thumbnails'=>true, 'watermark'=>false)
	);

*image_path is the field name of model where the image path is going to be saved and it should look something like this:

	'image_path' => array(
			'fileExtension' => array(
				'rule' => array('fileExtension', array('png','jpg','jpeg')),
				'message' => 'Please supply a valid image (PNG , JPEG, JPG only).',
				'allowEmpty' => true,
				'required' => false,
			),
			'fileMaxSize' => array(
				'rule' => array('fileMaxSize', '5242880'),
				'message' => 'Max file size is exeeded.',
				'allowEmpty' => true,
				'required' => false,
			),
			'extension' => array(
				'rule' => array('extension', array('jpeg', 'png', 'jpg')),
				'message' => 'Please supply a valid image.',
				'allowEmpty' => true,
				'required' => false,
			),
			'fileSize' => array(
				'rule' => array('fileSize', '<=', '5MB'),
				'message' => 'Image must be less than 5MB',
				'allowEmpty' => true,
				'required' => false,
			),		
			'mimeType' => array(
				'rule' => array('mimeType', array('image/jpeg', 'image/png')),
				'message' => 'Invalid mime type.',
				'allowEmpty' => true,
				'required' => false,
			),
			'uploadError' => array(
				'rule' => array('uploadError'),
				'message' => 'Something went wrong with the upload.',
				'allowEmpty' => true,
				'required' => false,
			),
			'processMediaUpload' => array(
				'rule' => 'processMediaUpload',
				'message' => 'Unable to process image upload.',
				'required' => false,
				'allowEmpty' => true,
			),
	),	


3) Now the Upload form should look like this:.

	  $this->Form->create('User', array('type'=>'file', 'url'  => array('controller' => 'users','action' => 'add')));
	  $this->Form->input('image_path',array('type'=>'file','div'=>false, 'label'=>'Avatar'));
	  $this->Form->input(__('Submit'), array('type'=>'submit','class'=>'btn btn-lg btn-green','label'=>false,'div'=>false));

4) Now the Script automaticlly upload the images under the:

  /img/{ModelName}/original.jpg
  /img/{ModelName}/xsmall/original.jpg
  /img/{ModelName}/small/original.jpg
  /img/{ModelName}/medium/original.jpg
  /img/{ModelName}/large/original.jpg
  /img/{ModelName}/xlarge/original.jpg
	
5) to preview the image you just type:
  $this->Html->image('User/'.$user['User']['image_path'], array('alt' => 'avatar'));
