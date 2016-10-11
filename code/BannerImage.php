<?php 
class BannerImage extends CustomImage {
		static $db = array(
			'Title' => 'Text',
			'SortOrder' => 'Int',
			'Content' => 'HTMLText'
			);
		
		static $has_one = array(
			'Page' => 'Page',
			'PageLink' => 'SiteTree'
			);
			
		public static $default_sort='SortOrder';
		
		public static $summary_fields = array( 
			'Thumbnail' => 'Thumbnail', 
			'Title' => 'Title'
		 );
		 
		 public function getThumbnail() { 
		   return $this->Image()->CMSThumbnail();
		}
		
		public function getCMSFields(){
			$uploadField = new UploadField('Image', 'Image');
			$uploadField->setFolderName('Uploads/Banners');
			return new FieldList(
				new TextField('Title', 'Title (note this is just for internal use, it does not show)'),
				new TreeDropdownField('PageLinkID', 'Page to link to', 'SiteTree'),
				$uploadField,
				new HTMLEditorField('Content')			
				);
		}
		
		
		
		
}