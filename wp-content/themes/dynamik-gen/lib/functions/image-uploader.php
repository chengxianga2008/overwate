<?php
/**
 * Builds the Image Uploader that Dynamik and many other
 * Dynamik Child Themes utilize.
 *
 * @package Dynamik
 */

//IMAGE STORAGE SETTINGS
$dynamik_uploader_settings['uploadpath'] = dynamik_get_stylesheet_location( 'path' ) . 'images/'; // The full size images will be stored here.  Must have forward slash on end.
$dynamik_uploader_settings['realpath'] = dynamik_get_stylesheet_location( 'url' ) . 'images/'; // This is the real URL location of your gallery images, this is used by the admin script to porvide a full URL link to the uploaded images.
$dynamik_uploader_settings['adminthumbpath'] = dynamik_get_stylesheet_location( 'path' ) . 'images/adminthumbnails/'; // Regardless of whether or not you have enabled automatic thumbnail creation above, a 100 pixel wide admin thumbnail is always created for use by the admin panel when listing images.
$dynamik_uploader_settings['adminthumbpath2'] = dynamik_get_stylesheet_location( 'url' ) . 'images/adminthumbnails/';
$dynamik_uploader_settings['filetypes'] = array( 'image/gif', 'image/pjpeg', 'image/jpeg', 'image/x-png', 'image/png' );  // Only these filetypes are allowed to be uploaded.

add_action( 'admin_init', 'dynamik_images_check' );
/**
 * Build image check function to determine which Uploader sub-function to run based on the type of POST.
 *
 * @since 1.0
 */
function dynamik_images_check()
{
	if( !empty( $_GET['fct'] ) )
	{
		switch( $_GET['fct'] )
		{
			case 'upload':
			uploadimage();
			break;
			
			case 'rename':
			renameimage();
			break;
			
			case 'dorename':
			dorename();
			break;
			
			case 'delete':
			deleteimage();
			break;
			
			case 'dodelete':
			dodelete();
			break;
			
			case 'bulkdelete':
			@dobulkdelete(); 
			break;
		}
	}
}

/**
 * Build function to handel the image upload process.
 *
 * @since 1.0
 */
function uploadImage()
{
	global $dynamik_uploader_settings, $message;
 
	$uploadedfile = $_FILES['image']['tmp_name'];	
	
	// Check if an empty upload request has been made and return an error.
	if( !$uploadedfile )
	{	
		$message = '<div class="uploader-error">' . __( 'Please select a file to upload.', 'dynamik' ) . '</div>';
	}
	// Check if the file being uploaded matches the $dynamik_uploader_settings['filetypes'], if so continue, if not return an error.
	elseif( @getimagesize( $uploadedfile ) !== false && in_array( $_FILES['image']['type'], $dynamik_uploader_settings['filetypes'] ) )
	{
		dynamik_folders_open_permissions();
		if( $_FILES['image']['type'] == 'image/pjpeg' || $_FILES['image']['type'] == 'image/jpeg' )
		{
			$src = imagecreatefromjpeg( $uploadedfile );
			// Set image type to jpg.
			$imgType = 'jpeg';
		}
		if( $_FILES['image']['type'] == 'image/x-png' || $_FILES['image']['type'] == 'image/png' )
		{
			$src = imagecreatefrompng( $uploadedfile );
			// Set image type to png.
			$imgType = 'png';
		}
		if( $_FILES['image']['type'] == 'image/gif' )
		{
			$src = imagecreatefromgif( $uploadedfile );
			// Set image type to gif.
			$imgType = 'gif';
		}
		list( $width, $height ) = getimagesize( $uploadedfile );
		
		$tmp = imagecreatetruecolor( $width, $height );
			
		// If the image type is png or gif make temp image transparent.
		if( ( $imgType == 'png' ) || ( $imgType == 'gif' ) )
		{
			imagealphablending( $tmp, false );
			imagesavealpha( $tmp, true );
			$transparent = imagecolorallocatealpha( $tmp, 255, 255, 255, 127 );
			imagefilledrectangle( $tmp, 0, 0, $width, $height, $transparent );
		}

		imagecopy( $tmp, $src, 0, 0, 0, 0, $width, $height );	
		
		$filename = $dynamik_uploader_settings['uploadpath'] . dynamik_clean_filename( $_FILES['image']['name'] );
		
		move_uploaded_file( $uploadedfile, $filename );

		// The below creates the 100 pixel wide thumbnail used only by the admin panel when listing the images.
		$newheight1 = ( $height/$width ) * 100;
		if( $width <= 10 || $height <= 10 ):
		$newwidth = 100;
		$newheight = 100;
		elseif( $width <= 100 && $height <= 100 ):
		$newwidth = $width;
		$newheight = $height;
		elseif( $width > 100 && $newheight1 > 100 ):
		$newwidth = 100;
		$newheight = 100;
		elseif( $width > 100 && $newheight1 <= 100 ):
		$newwidth = 100;
		$newheight = $newheight1 >= 1 ? $newheight1 : 1;
		elseif( $width <= 100 && $newheight1 > 100 ):
		$newwidth = $width;
		$newheight = 100;
		elseif( $width > 100 && $height <= 100 ):
		$newwidth = 100;
		$newheight = $height;
		else:
		$newwidth = 100;
		$newheight = 100;
		endif;
		$tmp = imagecreatetruecolor( $newwidth, $newheight );	
		
		// If the image type is png or gif make temp image transparent.
		if( ( $imgType == 'png' ) || ( $imgType == 'gif' ) )
		{
			imagealphablending( $tmp, false );
			imagesavealpha( $tmp, true );
			$transparent = imagecolorallocatealpha( $tmp, 255, 255, 255, 127 );
			imagefilledrectangle( $tmp, 0, 0, $newwidth, $newheight, $transparent );
		}

		imagecopyresampled( $tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height ); 
	
		$adminthumbname = $dynamik_uploader_settings['adminthumbpath'] . dynamik_clean_filename( $_FILES['image']['name'] );
		
		// Check image type and save accordingly. Gifs are converted to PNG  to ensure graceful resizing.
		switch( $imgType )
		{
			case 'jpeg':
			imagejpeg( $tmp, $adminthumbname );
			break;
			case 'png':
			imagepng( $tmp, $adminthumbname );
			break;
			case 'gif':
			imagepng( $tmp,str_replace( '.gif', '.png', $adminthumbname ) );
			break;
		}

		// The below sets the correct permissions on the uploaded files.
		if( strlen( $_FILES['image']['name'] ) > 0 )
		{
			@chmod( $dynamik_uploader_settings['uploadpath'] . $_FILES['image']['name'], 0644 );
			@chmod( $dynamik_uploader_settings['adminthumbpath'] . $_FILES['image']['name'], 0644 );
		}
		
		// The below destroys the temporary files created by PHP.
		imagedestroy( $src );
		imagedestroy( $tmp );	
		
		dynamik_folders_close_permissions();
		
		//If the upload has been successful, the below is displayed.
		$message = '<div class="success">' . __( 'Your image has been uploaded.', 'dynamik' ) . '</div>';			
	}
	// The below is displayed if the file being uploaded does not match the specified filetypes held in the $dynamik_uploader_settings['filetypes'] array above.	
	else 
	{
		$message = '<div class="uploader-error">' . __( 'This is not a valid filetype.  Valid filetypes are JPG, GIF and PNG.', 'dynamik' ) . '</div>';
	}
}

/**
 * Build the function that lists all the uploaded images in the Image Uploader admin page.
 *
 * @since 1.0
 */
function listimages()
{
	global $dynamik_uploader_settings;
	
	$content = '';
	// Open the upload directory.
	$images_path_broken = false;
	$dir_handle = dynamik_dir_check( $dynamik_uploader_settings['uploadpath'] ) ? opendir( $dynamik_uploader_settings['uploadpath'] ) : $images_path_broken = true;
	
	$file_array = array();
	
	// Read the contents of the upload directory into an array.
	if( false == $images_path_broken )
	{
		while( false !== ( $file = readdir( $dir_handle ) ) )  
		{
			if( !preg_match( '/gif|jpg|jpeg|png|bmp|svg/i' , $file ) )
			{
				continue;
			}
			else
			{
				$file_array[] = $file;
			}			
		}
		// Close the upload directory.
		closedir( $dir_handle );
	}
	else
	{
		$file = array();
	}
	
	//Alphabetize filenames
	if( !empty( $file_array ) )
	{
		sort( $file_array );
	}
	
	// List files
	foreach( $file_array as $file )  
	{
		// Get the width and height of each image.
		list( $width, $height ) = getimagesize( $dynamik_uploader_settings['uploadpath'] . $file );
		
		// Get the file size of each image.
		$file_size = returnFilesize( filesize( $dynamik_uploader_settings['uploadpath'] . $file ) );
		
		if( substr( $file, -3 ) == 'gif' )
		{
			$file_thumb = str_replace( '.gif', '.png', $file );
		}
		else
		{
			$file_thumb = $file;
		}
			
		$content .= '<div class="placeholder2">';
		$content .= '<div class="containercontent">';
		
		$content .= '<div class="imagecontainer"><div class="thumbnaildiv"><img src="' . $dynamik_uploader_settings['adminthumbpath2'] . '' . $file_thumb . '" alt="' . $file . '" class="thumbnail" /></div>';
		
		$content .= '<div class="imagetext">';
		
		$content .= '<p class="imageinfo">' . __( 'Filename:', 'dynamik' ) . '  ' . $file . '</p>';
		
		$content .= '<p class="imagedetails">' . __( 'Width:', 'dynamik' ) . '  ' . $width . ' pixels</p>';
		
		$content .= '<p class="imagedetails">' . __( 'Height:', 'dynamik' ) . '  ' . $height . ' pixels</p>';
		
		$content .= '<p class="imagesize">' . __( 'Filesize:', 'dynamik' ) . '  ' . $file_size . '</p>';
		
		$content .= '<p class="imagelink"><a href="' . $dynamik_uploader_settings['realpath'] . '' . $file . '">' . $dynamik_uploader_settings['realpath'] . '' . $file . '</a></p>';
		$content .= '<p><input type="checkbox" value="' . urlencode( $file ) . '" name="bulk_delete[]" class="image_check">' . __( 'Select this image for Bulk Delete', 'dynamik' ) . '</p>';
		$content .= '</div></div>';
		$content .= '<div class="buttoncontainer"><a href="?page=dynamik-design&activetab=dynamik-design-options-nav-image-uploader&fct=rename&filename=' . urlencode( $file ) . '" class="button">' . __( 'Rename Image', 'dynamik' ) . '</a>';
		$content .= '<a href="?page=dynamik-design&activetab=dynamik-design-options-nav-image-uploader&fct=delete&filename=' . urlencode( $file ) . '" class="button">' . __( 'Delete Image', 'dynamik' ) . '</a></div>'; 				  
		$content .= '</div></div>';
	}
	
	echo $content;	
}

/**
 * Build function that gets the file data ready for renaming.
 *
 * @since 1.0
 */
function renameimage()
{
	global $dynamik_uploader_settings;
	
	$content = '';
	$currentfilename = filename( $_GET['filename'] );
	$currentextension = extension( $_GET['filename'] );
	
	$content .= '<div class="blackout">';
	$content .= '<div class="box"><div class="box-inner"><div class="boxtext"><span class="boxheader">' . __( 'Rename Image', 'dynamik' ) . '</span>';
	$content .= '<form method="post" action="?page=dynamik-design&activetab=dynamik-design-options-nav-image-uploader&fct=dorename" class="emailform">';
	$content .= __( 'Current Filename:', 'dynamik' ) . '<br />';
	$content .= '<input name="currentfilename" type="text" size="31" class="renameinput" value="' . $currentfilename . '.' . $currentextension . '" readonly>';
	$content .= '<br /><br /><br />' . __( 'Rename to:', 'dynamik' ) . '<br />';
	$content .= '<input name="newfilename" type="text" size="21" style="margin-bottom:10px;" class="renameinput"><input name="currentextension" type="text" size="4" class="renameinput" value=".' . $currentextension . '" readonly>';
	$content .= '<div class="buttoncontainer"><input type="submit" name="submit" value="Rename" class="inputbutton button"></input>';
	$content .= '<a href="?page=dynamik-design&activetab=dynamik-design-options-nav-image-uploader" class="cancelbutton button">' . __( 'Cancel', 'dynamik' ) . '</a>';
	$content .= '</form>';
	$content .= '</div></div></div></div></div>';
		
	echo $content;
}

/**
 * Build function that performs the file renaming.
 *
 * @since 1.0
 */
function dorename()
{
	global $dynamik_uploader_settings;
	
	$content = '';
	
	if( $_POST['submit'] == 'Rename' )
	{
		$oldname = $_POST['currentfilename'];
		$newname = $_POST['newfilename'] . $_POST['currentextension'];
		if( substr( $oldname, -3 ) == 'gif' )
		{
			$oldname_thumb = str_replace( '.gif', '.png', $oldname );
			$newname_thumb = str_replace( '.gif', '.png', $newname );
		}
		else
		{
			$oldname_thumb = $oldname;
			$newname_thumb = $newname;
		}
		
		// If an empty filename is attempted to be posted, show below.
		if( !$_POST['newfilename'] )
		{
			$content .= '<div class="blackout">';
			$content .= '<div class="box"><div class="box-inner"><div class="boxtext"><span class="boxheader">' . __( 'Rename Image', 'dynamik' ) . '</span><br />';
			$content .= '<div class="renameerror"></div>';
			$content .= __( 'You did not supply a filename.', 'dynamik' ) . '';
			$content .= '<a style="margin-bottom:10px;" href="?page=dynamik-design&activetab=dynamik-design-options-nav-image-uploader" class="okbutton">' . __( 'OK', 'dynamik' ) . '</a></div></div></div></div>';	
		}
		else
		{
			dynamik_folders_open_permissions();
			// Rename the main image file and the admin thumbnail file(if it exists).
			rename( $dynamik_uploader_settings['uploadpath'] . $oldname, $dynamik_uploader_settings['uploadpath'] . dynamik_clean_filename( $newname ) );
			if( file_exists( $dynamik_uploader_settings['adminthumbpath'] . $oldname_thumb ) )
			{
				rename( $dynamik_uploader_settings['adminthumbpath'] . $oldname_thumb, $dynamik_uploader_settings['adminthumbpath'] . dynamik_clean_filename( $newname_thumb ) );
			}
			dynamik_folders_close_permissions();
		}
	}
	// If function is called with no POST or other data display below.
	else
	{
		$content .= '<div class="blackout">';
		$content .= '<div class="box"><div class="box-inner"><div class="boxtext"><span class="boxheader">' . __( 'Rename Image', 'dynamik' ) . '</span><br />';
		$content .= '<div class="renameerror"></div>';
		$content .= __( 'You did not supply a filename.', 'dynamik' );
		$content .= '<a style="margin-bottom:10px;" href="?page=dynamik-design&activetab=dynamik-design-options-nav-image-uploader" class="okbutton">' . __( 'OK', 'dynamik' ) . '</a></div></div></div></div>';		
	}
	echo $content;
}		

/**
 * Build function that gets the file data ready for deletion.
 *
 * @since 1.0
 */
function deleteimage()
{
	global $dynamik_uploader_settings;
	
	$content = '';
	// If a delete request is received, display a confirmation message.
	$filename = $_GET['filename'];
	if( substr( $filename, -3 ) == 'gif' )
	{
		$file_thumb = str_replace( '.gif', '.png', $filename );
	}
	else
	{
		$file_thumb = $filename;
	}
	$content .= '<div class="blackout">';
	$content .= '<div class="box"><div class="box-inner"><div class="boxtext"><span class="boxheader">' . __( 'Delete Image', 'dynamik' ) . '</span>';
	$content .= '<form method="post" action="?page=dynamik-design&activetab=dynamik-design-options-nav-image-uploader&fct=dodelete" class="emailform">';
	$content .= __( 'Are you sure you want to delete', 'dynamik' ) . ' <strong>'.$filename.'</strong>?<br />';
	$content .= '<img src="' . $dynamik_uploader_settings['adminthumbpath2'] . '' . $file_thumb . '" class="boxthumbnail" alt="' . $filename . '" /><br />';
	$content .= '<div class="buttoncontainer"><input type="submit" name="submit" value="Delete" class="inputbutton button"></input>';
	$content .= '<a href="?page=dynamik-design&activetab=dynamik-design-options-nav-image-uploader" class="cancelbutton button">' . __( 'Cancel', 'dynamik' ) . '</a>';
	$content .= '<input type="hidden" name="deletefile" value="'.$filename.'"></input>';
	$content .= '</form>';
	$content .= '</div></div></div></div></div>';
		
	echo $content;
}

/**
 * Build function that deletes multiple images at the same time.
 *
 * @since 1.0
 */
function dobulkdelete()
{
	global $dynamik_uploader_settings;
	dynamik_folders_open_permissions();
	$bulk_delete = $_POST['bulk_delete'];
	foreach( (array) $bulk_delete as $filename )
	{
		$filename = str_replace( '%40', '@', $filename );

		if( substr( $filename, -3 ) == 'gif' )
		{
			$file_thumb = str_replace( '.gif', '.png', $filename );
		}
		else
		{
			$file_thumb = $filename;
		}
		//Delete the main image file, the admin thumbnail file and the thumbnail file (if it exists)
		unlink( $dynamik_uploader_settings['uploadpath'] . $filename );
		if( file_exists( $dynamik_uploader_settings['adminthumbpath'] . $file_thumb ) )
		{
			unlink( $dynamik_uploader_settings['adminthumbpath'] . $file_thumb );
		}
	}
	dynamik_folders_close_permissions();
}

/**
 * Build function that deletes specific image.
 *
 * @since 1.0
 */
function dodelete()
{
	global $dynamik_uploader_settings;
	
	$content = '';
	
	if( $_POST['submit'] == 'Delete' )
	{
		$filename = $_POST['deletefile'];
		if( substr( $filename, -3 ) == 'gif' )
		{
			$file_thumb = str_replace( '.gif', '.png', $filename );
		}
		else
		{
			$file_thumb = $filename;
		}
		
		// If an empty filename is attempted to be posted, show below.
		if( !$_POST['deletefile'] )
		{
			$content .= '<div class="blackout">';
			$content .= '<div class="box"><div class="box-inner"><div class="boxtext"><span class="boxheader">' . __( 'Delete Image', 'dynamik' ) . '</span><br />';
			$content .= '<div class="renameerror"></div>';
			$content .= __( 'You did not supply a filename.', 'dynamik' );
			$content .= '<a href="?page=dynamik-design&activetab=dynamik-design-options-nav-image-uploader" class="okbutton">' . __( 'OK', 'dynamik' ) . '</a></div></div></div></div>';	
		}
		else
		{
			dynamik_folders_open_permissions();
			// Delete the main image file, the admin thumbnail file and the thumbnail file (if it exists).
			unlink( $dynamik_uploader_settings['uploadpath'] . $filename );
			if( file_exists( $dynamik_uploader_settings['adminthumbpath'] . $file_thumb ) )
			{
				unlink( $dynamik_uploader_settings['adminthumbpath'] . $file_thumb );
			}
			dynamik_folders_close_permissions();
		}
	}
	// If function is called with no POST or other data display below.
	else
	{
		$content .= '<div class="blackout">';
		$content .= '<div class="box"><div class="box-inner"><div class="boxtext"><span class="boxheader">' . __( 'Delete Image', 'dynamik' ) . '</span><br />';
		$content .= '<div class="renameerror"></div>';
		$content .= __( 'You did not supply a filename.', 'dynamik' );
		$content .= '<a href="?page=dynamik-design&activetab=dynamik-design-options-nav-image-uploader" class="okbutton">' . __( 'OK', 'dynamik' ) . '</a></div></div></div></div>';		
	}
	echo $content;
}			

/**
 * Build function that displays the file size.
 *
 * @since 1.0
 * @return the file size.
 */
function returnFilesize( $file_size )
{
	if( $file_size >= 1073741824 ) 
	{
		$show_filesize = number_format( ( $file_size / 1073741824), 2 ) . ' GB';
	} 
	elseif( $file_size >= 1048576 ) 
	{
	$show_filesize = number_format( ( $file_size / 1048576), 2 ) . ' MB';
	} 
	elseif( $file_size >= 1024 ) 
	{
		$show_filesize = number_format( ( $file_size / 1024), 2 ) . ' KB';
	} 
	elseif( $file_size >= 0 ) 
	{
		$show_filesize = $file_size . ' bytes';
	} 
	else 
	{
		$show_filesize = '0 bytes';
	}
	
	return $show_filesize;
}

/**
 * Build function that displays the file name.
 *
 * @since 1.0
 * @return the file name.
 */
function filename( $string )
{
	$file = $string;
	$i = strrpos( $file, '.' );
	$filename = substr( $file, 0, $i );
	return $filename;
}

/**
 * Build function that displays the file extension.
 *
 * @since 1.0
 * @return the file extension.
 */
function extension( $string )
{
	$file = $string;
	$i = strrpos( $file, '.' );
	$extension = substr( $file, $i+1 );
	return $extension;
}

/**
 * Build function that cleans the uploaded filename (convert to lowercase and change spaces into dashes).
 *
 * @since 1.0
 * @return the "cleaned" file name.
 */
function dynamik_clean_filename( $string )
{
	$string = str_replace( ' ', '-', $string );
	$string = str_replace( '-', ' ', $string );
	$string = preg_replace( '/^\s+|\s+$/', '', $string );
	$string = preg_replace( '/\s+/', ' ', $string );
	$string = str_replace( ' ', '-', $string );
	return strtolower( $string );
}
