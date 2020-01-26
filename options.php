<?php
if(isset($_POST["submit"]) && wp_verify_nonce($_POST['sbtt_nonce'], plugin_basename(__FILE__)))
{ 
	// Check whether the array is empty or not
    if(!empty($_FILES['sbtt_attachment']['name'])) 
	{
        // Setup the array of supported file types, in this case only jpeg or png is accepted.
        $supported_types = array('image/jpeg', 'image/png');
		
        // Get the file type of the upload
        $arr_file_type = wp_check_filetype(basename($_FILES['sbtt_attachment']['name']));
        $uploaded_type = $arr_file_type['type'];
         
        // Check whether the type is supported or not.
        if(in_array($uploaded_type, $supported_types)) 
		{
 			$upload = wp_upload_bits($_FILES['sbtt_attachment']['name'], null, file_get_contents($_FILES['sbtt_attachment']['tmp_name']));
     
            if(isset($upload['error']) && $upload['error'] != 0) 
			{
				$msg	= '<div id="error" align="center" class="error">There was an error uploading your file. Hope this error can help you to debug: ' . $upload['error'].'</div>';
            } 
			else 
			{
				if(! empty($upload['url']) )
				{
					$sbtt_options	=	array(
								'sbtt_image'	=>  $upload['url']
							);
					update_option('sbtt_options', $sbtt_options);
					$msg	= '<div id="success" align="center" class="update-nag">Scroll To Top Options has been Updated. Please reload the page</div>';
				}
            } 
 
        } 
		else 
		{
            $msg	= '<div id="error" align="center" class="error">Please Upload jpeg or png files</div>';
        } 
         
    } 
}

$sbtt_info	= get_option('sbtt_options');
?>
<div id="sbttwrap">
    <?php screen_icon(); ?>
    <?php echo $msg; ?>
    <h2>Choose your own image for scroll icon!!!!</h2>
    <br />
   <div>
    <fieldset>
        <form id="sbttform" method="post" action="" enctype="multipart/form-data"> 
        <label>Upload An Image</label>
            <input type="file" name="sbtt_attachment">
            <br /><br />
            <p>
            <img src="<?php echo $sbtt_info['sbtt_image'];?>" />
            </p>
            <p>
           <?php  wp_nonce_field(plugin_basename(__FILE__), 'sbtt_nonce');?>
            <input type="submit" value="Upload" class="button button-primary" name="submit" />
            </p>
        </form>
	</fieldset>   
	 </div>

   
    
