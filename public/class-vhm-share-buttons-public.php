<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://viktormorales.com
 * @since      1.0.0
 *
 * @package    Vhm_Share_Buttons
 * @subpackage Vhm_Share_Buttons/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Vhm_Share_Buttons
 * @subpackage Vhm_Share_Buttons/public
 * @author     Viktor H. Morales <viktorhugomorales@gmail.com>
 */
class Vhm_Share_Buttons_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The options name to be used in this plugin
	 *
	 * @since  	1.0.0
	 * @access 	private
	 * @var  	string 		$option_name 	Option name of this plugin
	 */
	private $option_name = 'vhm_share_buttons';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Vhm_Share_Buttons_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Vhm_Share_Buttons_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/vhm-share-buttons-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Vhm_Share_Buttons_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Vhm_Share_Buttons_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/vhm-share-buttons-public.js', array( 'jquery' ), $this->version, false );

	}

	public function the_content($post_content)
	{
		global $post;

		$active = get_option($this->option_name . '_active');
		$main_title = get_option($this->option_name . '_main_title');
		$applications = get_option($this->option_name . '_applications');
		$output = '';
		
		if ( is_main_query() && is_singular('post') ) {
			
			if ($main_title)
				$output .= '<h2>'.$main_title.'</h2>';

			$output .= '<ul class="vhm-share-buttons-list">';
			if (in_array("facebook", $applications)) {
				$output .= '<li><a id="vhm-share-buttons-facebook" href="https://www.facebook.com/sharer/sharer.php?u=' . get_permalink($post->ID) . '" onclick="javascript:window.open(this.href,\'share\',\'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600\');return false;">Share on Facebook</a></li>';
			}
			if (in_array("twitter", $applications)) {
				$output .= '<li><a id="vhm-share-buttons-twitter" href="https://twitter.com/share?url='.get_permalink($post->ID).'&text='.get_the_title($post->ID).'" onclick="javascript:window.open(this.href,\'share\',\'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600\');return false;">Share on Twitter</a></li>';
			}
			if (in_array("google", $applications)) {
				$output .= '<li><a id="vhm-share-buttons-google" href="https://plus.google.com/share?url='.get_permalink($post->ID).'" onclick="javascript:window.open(this.href,\'share\',\'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600\');return false;">Share on Google+</a></li>';
			}
			if (in_array("whatsapp", $applications)) {
				$output .= '<li><a id="vhm-share-buttons-whatsapp" href="https://api.whatsapp.com/send?text='.get_permalink($post->ID).'" data-text="'.get_permalink($post->ID).'" onclick="javascript:window.open(this.href,\'share\',\'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600\');return false;">Share on WhatsApp</a></li>';
			}
			if (in_array("telegram", $applications)) {
				$output .= '<li><a id="vhm-share-buttons-telegram" href="https://telegram.me/share/url?url='.get_permalink($post->ID).'&text='.get_the_title($post->ID).'" onclick="javascript:window.open(this.href,\'share\',\'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600\');return false;">Share on Telegram</a></li>';
			}
			if (in_array("link", $applications)) {
				$output .= '<li><a id="vhm-share-buttons-link" href="'.get_permalink($post->ID).'">Copy link</a></li>';
			}
			$output .= '</ul>';

			if ($active)
				$post_content = $post_content . $output;
			
		}
        return $post_content;
	}

}
