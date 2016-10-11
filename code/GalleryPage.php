<?php
class GalleryPage extends Page {
	
	private static $has_one = array(
		'GalleryThumb' => 'Image'
	);

	private static $has_many = array(
		'GalleryImages' => 'GalleryImage',
		'ImportFolder' => 'File'
	);
	
	public function ImageFolders(){
		$do = File::get()->filter(array('ClassName' => 'Folder', 'Title:not' => 'Uploads'));
		return $do->map('ID', 'Title');
	}
	
	public function onAfterWrite(){
		parent::onAfterWrite();
		if($this->ImportFolderID && $this->ImportFolderID > 0){
			$parent = $this->ImportFolderID;
			$do = File::get()->filter(array('ClassName' => 'Image', 'ParentID' => $parent));
			if(count($do) > 0){
				foreach($do as $file){
					$title = $file->Title;
					$img = GalleryImage::create(array(
						'Title' => $title,
						'ImageID' => $file->ID,
						'BelongToPageID' => $this->ID,
						'PageID' => $this->ID
					));
				
					$this->GalleryImages()->add($img);
				}
			}
		}
	}
	
	public function getCMSFields(){
		$fields = parent::getCMSFields();
		$fields->addFieldToTab('Root.Gallery', new LiteralField('', '<p>Importing a folder will bring <strong>ALL</strong> images into the gallery. Which may result in <strong>duplicate images</strong>.</p>'));
		$dd = new DropdownField('ImportFolderID', 'Select folder to import from', $this->ImageFolders());
		$dd->setEmptyString('Please select');
		$fields->addFieldToTab('Root.Gallery', $dd);
		$fields->addFieldToTab('Root.Gallery', new UploadField('GalleryThumb', 'Thumbnail for Gallery'));
		$conf=GridFieldConfig_RelationEditor::create(10);
        $conf->addComponent(new GridFieldSortableRows('SortOrder'));
		$gridField = new GridField("GalleryImages", "Gallery Image", $this->GalleryImages(), $conf);
		$fields->addFieldToTab("Root.Gallery", $gridField);
		return $fields;
		
		
	}

}
class GalleryPage_Controller extends Page_Controller {

	

}
