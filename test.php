<?php
/**
 * Plugin Name: test
 * Description: Thhis plugin is develope by codexpart.io
 * Plugin URI: https://codexpert.io
 * Author: Codexpert, Inc
 * Author URI: https://codexpert.io
 * Version: 0.1.0
 * Text Domain: learndash-plus
 * Domain Path: /languages
 *
 */
/**
 * Register a custom menu page.
 */

// Register Main Plugin

function my_custom_menu_page() {
	add_menu_page(
		__( 'Testing', 'textdomain' ),
		'Testing For Masum',
		'manage_options',
		'testing',
		'test_function',
		'dashicons-dashboard',
		6
	);
	
}
add_action( 'admin_menu', 'my_custom_menu_page' );

function test_function(){
	
	?>	
	<div class="container mt-5">
		<div class="row">
			<div class="col-md-6">

				<?php
				$content = "";
				$editor_id = "e_id";
				$editor_settings = array(
                         // 'teeny' => true,
                         'editor_height' => 200,
                         'quicktags' => array( 'buttons' => 'strong,em,del,close' ),
                         // 'media_buttons' => true
                          ); 
				$html = wp_editor(  $content, $editor_id ,   $editor_settings );

				$html .= '
				<form>
				  <div class="form-group">
				    <label for="exampleFormControlInput1">Email address</label>
				    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
				  </div>
				 <!-- <div class="form-group"> -->
				    <label for="exampleFormControlSelect2">Example multiple select</label>
				    <select class="form-control" id="exampleFormControlSelect2">
				      <option disabled>Select Your Option</option>
				      <option>1</option>
				      <option>2</option>
				      <option>3</option>
				      <option>4</option>
				      <option>5</option>
				    </select>
				  <!-- </div> -->
				  <div class="form-group">
				    <label for="exampleFormControlTextarea1">Example textarea</label>
				    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>				    
				  
				';

				
				$html .= '<button id="test-submit" class="btn btn-primary">Submit</button> </div>
							  
				</form>';

				echo $html;
				 ?>

								
			</div>
		</div>	
	</div>	
	<?php
}


// Enqueue Js File
function test_js_file(){
	wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css');
	wp_enqueue_style('toster_css', 'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css');

	wp_enqueue_script( 'test_js', plugin_dir_url( __FILE__ ) . 'test.js', array( 'jquery' ), time(), true );
	wp_enqueue_script( 'toster_js', 'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js', array( 'jquery' ), time(), true );

	 wp_localize_script( 'test_js', 'TEST_AJAX', array( 
	 	'ajaxurl' => admin_url( 'admin-ajax.php' ),
	 	'_wpnonce'	=> wp_create_nonce(),
	 )
	);

	}
add_action( 'admin_enqueue_scripts', 'test_js_file' );


// Save Data To Data Base With Ajax

add_action( 'wp_ajax_test_ajax', 'save_form_data' );

function save_form_data(){

	$response = [];

    if( !wp_verify_nonce( $_POST['nonce'] ) ) {

        $response['status']		= 0;
        $response['message'] 	= __( 'Unauthorized!', 'textdomain' );
        wp_send_json( $response );
    }

	// $title 	= $_POST['title']; 
	// $body 	= $_POST['body']; 
	// $desc 	= $_POST['desc'];
	// $editor = $_POST['editor'];

		update_option( 'test_email', $_POST['email'] );
		update_option( 'test_select', $_POST['select'] );
		update_option( 'test_text', $_POST['text'] );
		update_option( 'test_editor', $_POST['editor'] );


	$response['status']		= 1;
    $response['message'] 	= __( 'Authorized!', 'textdomain' );
    wp_send_json( $response );
      
	
}
// Get Data form Database


add_shortcode( 'test-data', 'get_data' );

function get_data( ){
	$title 		= get_option( 'test_email' ) ? : '';
	$how_many 	= get_option( 'test_select' )? : '';
	$desc 		= get_option( 'test_text' )? : '';
	$editor		= get_option( 'test_editor' )? : '';
	echo $title;
	echo "<br>";
	echo $how_many;
	echo "<br>";
	echo $desc;
	echo "<br>";
	echo $editor;
}





