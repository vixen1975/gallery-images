<?php 
class GalleryImage extends CustomImage {
		private static $db = array(
			'Title' => 'Text',
			'SortOrder' => 'Int'
		);
		
		public static $has_one = array(
			'Page' => 'Page'
		);
			
		private static $default_sort='SortOrder';
		
		private static $summary_fields = array( 
			'Thumbnail' => 'Thumbnail', 
			'Title' => 'Title'
		 );
		
		public function getThumbnail() { 
		   return $this->Image()->CMSThumbnail();
		}
					
		public function getCMSFields(){
			return new FieldList(
				new TextField('Title'),
				new UploadField('Image')
				);
		}
		
		
		
		
}