<?php 
class CustomImage extends DataObject {
	public static $has_one = array (
			'Image' => 'Image',
			'BelongToPage' => 'Page',
			'SortOrder' => 'Int'
	);
	
	public function getCMSFields(){
		$fields = new FieldList();
		$fields->push(new UploadField('Image')); 
		return $fields;
	}
}

