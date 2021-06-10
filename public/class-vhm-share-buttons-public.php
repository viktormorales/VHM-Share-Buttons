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
	 * Register the CSS & JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function vhmsb_enqueue_scripts() {

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
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/vhm-share-buttons-public.css', false, time(), 'all' );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/vhm-share-buttons-public.js', ['jquery'], time(), true );
		wp_enqueue_script( $this->plugin_name . '-fa', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/all.min.js', false, time(), true );
	}

	public function vhmsb_the_content($post_content)
	{
		global $post;
		
		$display = get_option($this->option_name . '_display');
		switch ($display) {
			case "before_content":
				return do_shortcode('[vhm-share-buttons]') . $post_content;
				break;
			case "after_content":
				return $post_content . do_shortcode('[vhm-share-buttons]');
				break;
			default:
				return $post_content;
				break;
		}
        
	}

	public function vhmsb_get_the_excerpt( $content ) 
	{
		# This avoids "the content" showing the "main title" text in the excerpt
		$main_title = get_option($this->option_name . '_main_title');
		return str_replace($main_title, '', $content);
	}


	/**
	 * Shortcode
	 */
	public function vhmsb_register_shortcodes() {
		add_shortcode( 'vhm-share-buttons', [$this, 'vhm_share_button_sc'] );
	}

	public function vhm_share_button_sc($atts) {
		global $post;
		$active = get_option($this->option_name . '_active');
		$main_title = get_option($this->option_name . '_main_title');
		$applications = get_option($this->option_name . '_applications');
		$icons = get_option($this->option_name . '_icons');
		$source = get_option($this->option_name . '_source');
		
		$output = '';
		
		$show_in_page = get_post_meta($post->ID, '_vhm_share_buttons_show_in_page', true);
		
		if ($active) {
			if (is_array($source) && is_singular($source) && $show_in_page !== 'no') {
			
				$output .= '<div class="vhm-share-buttons" style="clear:both">';
				
				if ($main_title) { 
					$output .= '<div class="vhm-share-buttons-title">' . $main_title . '</div>';
				}
	
				$output .= '<ul id="vhm-share-buttons-list" class="vhm-share-buttons-list">';
	
				/* FACEBOOK */
				if (in_array("facebook", $applications)) 
				{
					$output .= '<li><a id="vhm-share-buttons-facebook" href="https://www.facebook.com/sharer/sharer.php?u=' . get_permalink($post->ID) . '" onclick="javascript:window.open(this.href,\'share\',\'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600\');return false;" title="Facebook">';
	
					if ($icons == 'default') { $output .= '<i class="fab fa-facebook"></i> ' . __('Facebook', $this->plugin_name); }
					elseif ($icons == 'icon') { $output .= '<i class="fab fa-facebook"></i>'; }
					else { $output .=  __('Facebook', $this->plugin_name); }
	
					$output .= '</a></li>';
				}
				/* TWITTER */
				if (in_array("twitter", $applications)) {
					$output .= '<li><a id="vhm-share-buttons-twitter" href="https://twitter.com/share?url='.get_permalink($post->ID).'&text='.get_the_title($post->ID).'" onclick="javascript:window.open(this.href,\'share\',\'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600\');return false;" title="Twitter">';
	
					if ($icons == 'default') { $output .= '<i class="fab fa-twitter"></i> ' . __('Twitter', $this->plugin_name); }
					elseif ($icons == 'icon') { $output .= '<i class="fab fa-twitter"></i>'; }
					else { $output .=  __('Twitter', $this->plugin_name); }
	
					$output .= '</a></li>';
				}
				/* WHATSAPP */
				if (in_array("whatsapp", $applications)) {
					$output .= '<li><a id="vhm-share-buttons-whatsapp" href="https://wa.me/?text='.get_permalink($post->ID).'" data-text="'.get_permalink($post->ID).'" onclick="javascript:window.open(this.href,\'share\',\'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600\');return false;" title="Whatsapp">';
	
					if ($icons == 'default') { $output .= '<i class="fab fa-whatsapp"></i> ' . __('Whatsapp', $this->plugin_name); }
					elseif ($icons == 'icon') { $output .= '<i class="fab fa-whatsapp"></i>'; }
					else { $output .=  __('Whatsapp', $this->plugin_name); }
	
					$output .= '</a></li>';
				}
				/* TELEGRAM */
				if (in_array("telegram", $applications)) {
					$output .= '<li><a id="vhm-share-buttons-telegram" href="https://telegram.me/share/url?url='.get_permalink($post->ID).'&text='.get_the_title($post->ID).'" onclick="javascript:window.open(this.href,\'share\',\'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600\');return false;" title="Telegram">';
	
					if ($icons == 'default') { $output .= '<i class="fab fa-telegram"></i> ' . __('Telegram', $this->plugin_name); }
					elseif ($icons == 'icon') { $output .= '<i class="fab fa-telegram"></i>'; }
					else { $output .=  __('Telegram', $this->plugin_name); }
	
					$output .= '</a></li>';
				}
	
				/* COPY LINK */
				if (in_array("link", $applications)) {
					$output .= '<li><a id="vhm-share-buttons-link" href="'.get_permalink($post->ID).'" title="' . __('Copy link', $this->plugin_name) . '">';
	
					if ($icons == 'default') { $output .= '<i class="fas fa-copy"></i> ' . __('Copy link', $this->plugin_name); }
					elseif ($icons == 'icon') { $output .= '<i class="fas fa-copy"></i>'; }
					else { $output .=  __('Copy link', $this->plugin_name); }
	
					$output .= '</a></li>';
				}
				$output .= '</ul>';
	
				// Android Share API
				$output .= '<a id="vhm-share-buttons-android" style="display:none;" href="javascript:void()" data-title="'.get_the_title($post->ID).'" data-url="'.get_permalink($post->ID).'">' . $main_title . '</a></div>';
	
				
				return $output;
			}
		}
	}

}
