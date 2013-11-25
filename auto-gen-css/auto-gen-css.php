<?php 
/*
Plugin Name: Auto gen css file
Description: Auto genarate css file when active plugin.
Version: 0.0.1
Author: Sonpham
Author URI: http://ituts.org/
*/

function my_plugin_activate() {

  add_option( 'Activated_Plugin', 'Plugin-Slug' );
  
  	for($i=1; $i<=3; $i++){
  		switch ($i) {
  			case 1:
  				$fileName = 'osw_do';
  				break;
  			case 2:
  				$fileName = 'osw_duy';
  				break;
  			case 3:
  				$fileName = 'osw_hung';
  				break;  			
  		}
  		/* gen css file */
  		$templatePath = get_template_directory();
		$ourFileName = $templatePath."/".$fileName.".css";			
		$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
		fwrite($ourFileHandle, $content);						
		fclose($ourFileHandle);	
	}//end for
	
}
register_activation_hook( __FILE__, 'my_plugin_activate' );

function load_plugin() {

    if ( is_admin() && get_option( 'Activated_Plugin' ) == 'Plugin-Slug' ) {
        delete_option( 'Activated_Plugin' );
        /* do stuff once right after activation */
        // example: add_action( 'init', 'my_init_function' );
    }
}
function my_styles(){
	//open folder css
	$templatePath = get_template_directory();		
	$filelist = glob($templatePath."/css/osw_*.css");		
	$listLenght = count($filelist);
	$f = array();	
	//get list file name
	for($i=0; $i<$listLenght; $i++){
		$file =  explode('/', $filelist[$i]);		
		$f[$i] = $file[10];	
	}	
	//add style when load site
	for($i=0; $i<count($f); $i++){		
		$cssFile = $f[$i];		
		wp_register_style( 'my_style_'.$i, THEME_CSS.'/'.$cssFile."");
		wp_enqueue_style( 'my_style_'.$i);
	}	

}
add_action( 'wp_head', 'my_styles' );
add_action( 'admin_init', 'load_plugin' );
?>