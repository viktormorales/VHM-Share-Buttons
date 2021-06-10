<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://viktormorales.com
 * @since      1.0.0
 *
 * @package    Vhm_Share_Buttons
 * @subpackage Vhm_Share_Buttons/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Vhm_Share_Buttons
 * @subpackage Vhm_Share_Buttons/admin
 * @author     Viktor H. Morales <viktorhugomorales@gmail.com>
 */
class Vhm_Share_Buttons_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/vhm-share-buttons-admin.css', false, $this->version, 'all' );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/vhm-share-buttons-admin.js', ['jquery'], $this->version, false );

	}

	/**
	 * Add an options page under the Settings submenu
	 *
	 * @since  1.0.0
	 */
	public function vhmsb_add_options_page() {
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'VHM Share Buttons Settings', $this->plugin_name ),
			__( 'VHM Share Buttons', $this->plugin_name ),
			'manage_options',
			$this->plugin_name,
			array( $this, 'vhmsb_display_options_page' )
		);
	}
	/**
	 * Render the options page for plugin
	 *
	 * @since  1.0.0
	 */
	public function vhmsb_display_options_page() {
		include_once 'partials/'.$this->plugin_name.'-admin-display.php';
	}
	/**
	 * Register all related settings of this plugin
	 *
	 * @since  1.0.0
	 */
	public function vhmsb_register_setting() {
		add_settings_section(
			$this->option_name . '_general',
			__( 'General', $this->plugin_name ),
			array( $this, $this->option_name .'_general_cb' ),
			$this->plugin_name
		);

		add_settings_field(
			$this->option_name . '_active',
			__( 'Active', $this->plugin_name ),
			array( $this, $this->option_name .'_active_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_active' )
		);

		add_settings_field(
			$this->option_name . '_main_title',
			__( 'Title', $this->plugin_name ),
			array( $this, $this->option_name .'_main_title_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_main_title' )
		);

		add_settings_field(
			$this->option_name . '_applications',
			__( 'Applications', $this->plugin_name ),
			array( $this, $this->option_name .'_applications_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_applications' )
		);

		add_settings_field(
			$this->option_name . '_icons',
			__( 'Buttons display', $this->plugin_name ),
			array( $this, $this->option_name .'_icons_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_icons' )
		);

		add_settings_field(
			$this->option_name . '_source',
			__( 'Source', $this->plugin_name ),
			array( $this, $this->option_name .'_source_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_source' )
		);
		add_settings_field(
			$this->option_name . '_display',
			__( 'Display', $this->plugin_name ),
			array( $this, $this->option_name .'_display_cb' ),
			$this->plugin_name,
			$this->option_name . '_general',
			array( 'label_for' => $this->option_name . '_display' )
		);
		
		register_setting( $this->plugin_name, $this->option_name . '_active' );
		register_setting( $this->plugin_name, $this->option_name . '_main_title' );
		register_setting( $this->plugin_name, $this->option_name . '_applications' );
		register_setting( $this->plugin_name, $this->option_name . '_icons' );
		register_setting( $this->plugin_name, $this->option_name . '_source' );
		register_setting( $this->plugin_name, $this->option_name . '_display' );
	}
	/**
	 * Render the text for the general section
	 *
	 * @since  1.0.0
	 */
	public function vhm_share_buttons_general_cb() {
		echo '<p>' . __( 'Display buttons at the end of your content to share in the applications listed below.', $this->plugin_name ) . '</p>';
	}
	/**
	 * Render the "active" checkbox
	 *
	 * @since  1.0.0
	 */
	public function vhm_share_buttons_active_cb() {
		$active = get_option( $this->option_name . '_active' );

		echo '<label><input type="checkbox" name="' . $this->option_name . '_active' . '" id="' . $this->option_name . '_active' . '"';
		echo ($active)? " checked" : false;
		echo '>';
		echo __('Tick the box if you want to display the buttons.', $this->plugin_name) . '</label>';
	}
	/**
	 * Render the "main title" input
	 */
	public function vhm_share_buttons_main_title_cb() {
		$main_title = get_option( $this->option_name . '_main_title' );
		
		echo '<input type="text" name="' . $this->option_name . '_main_title' . '" id="' . $this->option_name . '_main_title' . '" value="' . esc_attr($main_title) . '">';
		echo '<p><span class="description">' . __('The title you want to display to invite users to share your post.', $this->plugin_name) . '</span><br></p>';
	}
	/**
	 * Render "Applications" checkboxes
	 */
	public function vhm_share_buttons_applications_cb() {
		$applications = get_option( $this->option_name . '_applications' );
		
		echo '<fieldset><legend class="screen-reader-text"><span>Applications</span></legend>';
		echo '<p>' . __('Choose the applications you want to share your content to:', $this->plugin_name) . '</p>';
		/* Share on Facebook */
		echo '<label><input type="checkbox" name="' . $this->option_name . '_applications[]" value="facebook"'; 
		echo (is_array($applications) && in_array("facebook", $applications))? " checked" : false;
		echo '> Facebook</label><br>';
		/* Share on Twitter */
		echo '<label><input type="checkbox" name="' . $this->option_name . '_applications[]" value="twitter"';
		echo (is_array($applications) && in_array("twitter", $applications))? " checked" : false;
		echo '> Twitter</label><br>';
		/* Share on WhatsApp*/
		echo '<label><input type="checkbox" name="' . $this->option_name . '_applications[]" value="whatsapp"';
		echo (is_array($applications) && in_array("whatsapp", $applications))? " checked" : false;
		echo '> WhatsApp</label><br>';
		/* Share on Telegram */
		echo '<label><input type="checkbox" name="' . $this->option_name . '_applications[]" value="telegram"';
		echo (is_array($applications) && in_array("telegram", $applications))? " checked" : false;
		echo '> Telegram</label><br>';
		/* Copy link */
		echo '<label><input type="checkbox" name="' . $this->option_name . '_applications[]" value="link"';
		echo (is_array($applications) && in_array("link", $applications))? " checked" : false;
		echo '> Show the link of the post to copy and paste</label><br>';

		echo '</fieldset>';
	}
	/**
	 * Render the "Buttons display" select
	 */
	public function vhm_share_buttons_icons_cb() {
		$icons = get_option( $this->option_name . '_icons' );
		
		echo '<fieldset><legend class="screen-reader-text"><span>Buttons display</span></legend>';

		echo '<label><select name="' . $this->option_name . '_icons">'; 
		echo '<option value="default" ' . selected($icons, 'default', false) .'>' . __('Icon and Label', $this->plugin_name) . '</option>';
		echo '<option value="icon" ' . selected($icons, 'icon', false) .'>' . __('Only icon', $this->plugin_name) . '</option>';
		echo '<option value="label" ' . selected($icons, 'label', false) .'>' . __('Only Label', $this->plugin_name) . '</option>';
		echo '></select></label><br>';
		echo '</fieldset>';
	}
	/**
	 * Render the "Sources" checkboxes
	 */
	public function vhm_share_buttons_source_cb() {

		$source = get_option( $this->option_name . '_source' );
		
		echo '<fieldset><legend class="screen-reader-text"><span>Source</span></legend>';
		echo '<p>' . __('Choose the sources you want to display the buttons:', $this->plugin_name) . '</p>';
		
		$args = array(
		   'public'   => true
		);
		foreach ( get_post_types( $args, 'names' ) as $post_type ) {
		   /*echo '<p>' . $post_type . '</p>';*/
		   echo '<label><input type="checkbox" name="' . $this->option_name . '_source[]" value="'.$post_type.'"';
			echo (is_array($source) && in_array($post_type, $source))? " checked" : false;
			echo '> '.$post_type.'</label><br>';
		}

		echo '</fieldset>';
	}
	/**
	 * Render the "Display" select
	 */
	public function vhm_share_buttons_display_cb() {
		$display = get_option( $this->option_name . '_display' );
		
		echo '<fieldset><legend class="screen-reader-text"><span>Display</span></legend>';

		echo '<label><select name="' . $this->option_name . '_display">'; 
		echo '<option value="before_content" ' . selected($display, 'before_content', false) .'>' . __('Before content', $this->plugin_name) . '</option>';
		echo '<option value="after_content" ' . selected($display, 'after_content', false) .'>' . __('After content', $this->plugin_name) . '</option>';
		echo '<option value="shortcode" ' . selected($display, 'shortcode', false) .'>' . __('Use shortcode', $this->plugin_name) . '</option>';
		echo '></select></label><br>';
		echo '</fieldset><p class="desciption">' . sprintf(__('Use the shortcode %s where you want to display the share buttons.'), '<code>[vhm-share-buttons]</code>')  . '</p>';
	}

	/**
	 * Meta Boxes for each post, page, producto or custom post type
	 *
	 */
	public function vhmsb_add_meta_box() {

        $screens = get_option($this->option_name . '_source');
        foreach ($screens as $screen) {
            add_meta_box(
                'vhm_share_buttons_meta_box',          // Unique ID
                __('VHM Share Buttons',  $this->plugin_name), // Box title
                [$this, 'vhmsb_html_meta_box'],   // Content callback, must be of type callable
                $screens,
                'side',
				'high'
            );
        }
    }
 
    public function vhmsb_save_meta_box($post_id)
    {
    	$update_state = $_POST['vhm_share_buttons_show_in_page'];
        update_post_meta($post_id, '_vhm_share_buttons_show_in_page', $update_state);
    }
 
    public function vhmsb_html_meta_box($post)
    {
        # Default is YES
    	$state = get_post_meta($post->ID, '_vhm_share_buttons_show_in_page', true) ;
        ?>
        <p class="meta-options"><label><?php _e('Show share buttons on this page', $plugin_name) ?>:</label> 
		<select id="vhm_share_buttons_show_in_page" name="vhm_share_buttons_show_in_page">
			<option value="yes" <?php echo selected($state, 'yes'); ?>><?php _e('Yes', $this->plugin_name); ?></option>
			<option value="no" <?php echo selected($state, 'no'); ?>><?php _e('No', $this->plugin_name); ?></option>
		</select></p>
        <?php
    }
}
