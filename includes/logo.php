<?php

/** 
 * Check that a logo is defined, notify the admin if it's not
 */
add_action( 'admin_notices', 'carid_setup' );
function carid_setup() {
	// Logo
	if(!get_header_image())
		echo '<div class="updated"><p><strong>' . sprintf(__( 'Configure a logo for the website by <a href="%s">uploading/choosing a header image</a>.', 'carid_clone' ), admin_url('themes.php?page=custom-header')) . '</strong></p></div>';
}
