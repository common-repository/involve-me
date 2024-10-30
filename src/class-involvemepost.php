<?php

/**
 * Class InvolvemePost
 *
 * Handle the settings admin page
 */
class InvolvemePost
{
	/**
	 * @var InvolvemePost The reference the *Singleton* instance of this class
	 */
	private static $instance;

	public static $input_prefix = 'involveme_iframe_';

	/**
	 * Returns the *Singleton* instance of this class.
	 *
	 * @return InvolvemePost The *Singleton* instance.
	 */
	public static function get_instance()
	{
		if(null === self::$instance) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * InvolvemePost constructor.
	 */
	protected function __construct()
	{
		add_action('init', array($this, 'init'));
		add_action('init', array($this, 'register_involveme_post_code'));
		add_action('init', array($this, 'register_involvme_shortcode'));
	}

	/**
	 *
	 */
	public function init()
	{
		$this->actions();
		$this->filters();
	}

	/**
	 *
	 */
	public function actions()
	{
		add_action('admin_init', array($this, 'add_post_meta_box'));

		add_action('admin_enqueue_scripts', array($this, 'enqueue_script'));

		add_action('save_post', array($this, 'save_post_meta'));
	}

	public function filters()
	{
		add_filter('manage_' . INVOLVE_ME_POST_TYPE . '_posts_columns', array($this, 'update_admin_columns'));
		add_filter('manage_' . INVOLVE_ME_POST_TYPE . '_posts_custom_column', array($this, 'display_column_values'), 10, 2);
	}

	public function save_post_meta($post_id)
	{
		if(!isset($_POST[$this->key('customization_box_nonce')])) {
			return $post_id;
		}
		$nonce = $_POST[$this->key('customization_box_nonce')];
		if(!wp_verify_nonce($nonce, $this->key('customization_box'))) {
			return $post_id;
		}

		if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		if(!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}

		update_post_meta($post_id, $this->key('project_url', '_'), sanitize_url($_POST[$this->key('project_url')]));


		switch (sanitize_text_field($_POST[$this->key('embed_mode')])) {
			case 'standard':
				$this->saveStandard($post_id);
				break;
			case 'popup':
				$this->savePopup($post_id);
				break;
			case 'chatButton':
				$this->saveChatButton($post_id);
				break;
			case 'sidePanel':
				$this->saveSidePanel($post_id);
				break;
			case 'sideTab':
				$this->saveSideTab($post_id);
				break;
		}

		update_post_meta($post_id, $this->key('background_color', '_'), sanitize_text_field($_POST[$this->key('background_color')]));


		update_post_meta($post_id, $this->key('embed_mode', '_'), sanitize_text_field($_POST[$this->key('embed_mode')]));
	}

	public function add_post_meta_box()
	{
		add_meta_box(
			"involveme-forms-settings",
			__('Embed settings', 'involveme'),
			array($this, 'form_settings_metabox'),
			INVOLVE_ME_POST_TYPE
		);
	}

	public function form_settings_metabox()
	{
		global $post;
		$currentScreen = get_current_screen();
		if(!$post) {
			$post = get_post($_GET['post']);
		}
		$this->include_view('settings', array_merge($this->get_settings($post->ID, true), array('post_id' => $post->ID, 'add_screen' => $currentScreen->action == 'add')));

	}

	protected function get_settings($post_id, $preview = false)
	{
		if(!$post_id) {
			return array(
				$this->key('project_url') => '',
				$this->key('project') => '',
				$this->key('domain') => '',
				$this->key('width') => 'auto',
				$this->key('minimal_height') => 'auto',
				$this->key('background_color') => '#ffffff',
				$this->key('transparent_background') => false,
				$this->key('dynamic_height_resize') => true,
				$this->key('show_popup') => 'button',
				$this->key('show_popup_side') => 'button',
				$this->key('popup_size') => 'medium',
				$this->key('button_text') => '',
				$this->key('close_popup_on_completion') => false,
				$this->key('hide_once_viewed') => false,
				$this->key('hide_once_viewed_duration') => 'indefinite',
				$this->key('time_delay_to_close') => 5,
				$this->key('icon') => 'speech-bubble',
				$this->key('icon_side') => 'speech-bubble',
				$this->key('button_color') => '#2679ff',
				$this->key('position') => 'right',
				$this->key('stop_showing_once_completed') => false,
				$this->key('stop_showing_duration') => 'indefinite',
				$this->key('trigger_delay') => 15,
				$this->key('embed_mode') => 'standard',
				$this->key('preview') => $preview,
			);
		}
		return array(
			$this->key('project_url') => $this->get_post_meta($post_id, 'project_url'),
			$this->key('project') => $this->extract_project_slug_from_url($this->get_post_meta($post_id, 'project_url')),
			$this->key('domain') => $this->extract_domain_from_project_url($this->get_post_meta($post_id, 'project_url')),
			$this->key('width') => $this->get_post_meta($post_id, 'width','auto'),
			$this->key('minimal_height') => $this->get_post_meta($post_id, 'minimal_height','auto'),
			$this->key('background_color') => $this->get_post_meta($post_id, 'background_color', '#ffffff'),
			$this->key('transparent_background') => $this->get_post_meta($post_id, 'transparent_background', false),
			$this->key('dynamic_height_resize') => $this->get_post_meta($post_id, 'dynamic_height_resize', true),
			$this->key('show_popup') => $this->get_post_meta($post_id, 'show_popup', 'button'),
			$this->key('show_popup_side') => $this->get_post_meta($post_id, 'show_popup_side', 'button'),
			$this->key('popup_size') => $this->get_post_meta($post_id, 'popup_size', 'medium'),
			$this->key('button_text') => $this->get_post_meta($post_id, 'button_text', 'Launch popup'),
			$this->key('close_popup_on_completion') => $this->get_post_meta($post_id, 'close_popup_on_completion', false),
			$this->key('hide_once_viewed') => $this->get_post_meta($post_id, 'hide_once_viewed', false),
			$this->key('hide_once_viewed_duration') => $this->get_post_meta($post_id, 'hide_once_viewed_duration', 'indefinite'),
			$this->key('time_delay_to_close') => $this->get_post_meta($post_id, 'time_delay_to_close', 5),
			$this->key('icon') => $this->get_post_meta($post_id, 'icon', 'speech-bubble'),
			$this->key('icon_side') => $this->get_post_meta($post_id, 'icon_side', 'speech-bubble'),
			$this->key('button_color') => $this->get_post_meta($post_id, 'button_color', '#2679ff'),
			$this->key('position') => $this->get_post_meta($post_id, 'position', 'right'),
			$this->key('stop_showing_once_completed') => $this->get_post_meta($post_id, 'stop_showing_once_completed', false),
			$this->key('stop_showing_duration') => $this->get_post_meta($post_id, 'stop_showing_duration', 'indefinite'),
			$this->key('trigger_delay') => $this->get_post_meta($post_id, 'trigger_delay', 15),
			$this->key('embed_mode') => $this->get_post_meta($post_id, 'embed_mode', 'standard'),
			$this->key('preview') => $preview,
		);
	}

	protected function extract_project_slug_from_url($project_url)
	{
		$project_url = trim($project_url, '/');
		$parts = explode('/', $project_url);
		return end($parts);
	}

	protected function extract_domain_from_project_url($project_url)
	{
		$slug = $this->extract_project_slug_from_url($project_url);
		return str_replace('/' . $slug, '', $project_url);
	}

	protected function key($name, $prefix = '')
	{
		return $prefix . self::$input_prefix . $name;

	}

	protected function get_post_meta($post_id, $key, $default = '')
	{
		$value = get_post_meta($post_id, $this->key($key, '_'), true);
		if(!$value) {
			return $default;
		}

		return $value;
	}


	public function register_involveme_post_code()
	{

		register_post_type(INVOLVE_ME_POST_TYPE,
			array(
				'labels' => array(
					'name' => __('involve.me', 'involveme'),
					'singular_name' => __('involve.me project', 'involveme'),
					'add_new_item' => __('Add New involve.me project', 'involveme'),
					'edit_item' => __('Edit involve.me project', 'involveme'),
					'new_item' => __('New involve.me project', 'involveme'),
					'view_item' => __('View involve.me project', 'involveme'),
					'view_items' => __('New involve.me projects', 'involveme'),
					'search_items' => __('Search involve.me projects', 'involveme'),
					'not_found' => __('No involve.me projects found', 'involveme'),
					'not_found_in_trash' => __('No involve.me projects found in trash', 'involveme'),
					'all_items' => __('All involve.me projects', 'involveme'),
				),
				'public' => true,
				'has_archive' => false,
				'show_ui' => true,
				'show_in_menu' => true,
				'supports' => array('title'),
				'menu_icon' => 'data:image/svg+xml;base64,' . base64_encode('
<svg width="100%" height="100%" viewBox="0 0 259 260" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
    <path d="M193.379,97.05L258.74,97.05L258.74,259.01L96.79,259.01L96.79,193.38C149.663,193.328 193.179,149.901 193.379,97.05ZM96.79,193.38L96.69,193.38C43.647,193.38 0,149.733 -0,96.69C-0,43.647 43.647,0 96.69,0C149.733,-0 193.38,43.647 193.38,96.69L193.379,97.05L96.79,97.05L96.79,193.38Z" style="fill:white;fill-opacity:0.6;fill-rule:nonzero;"/>
</svg>')
			)
		);
	}

	public static function include_view($view_name, $args = array(), $echo = true)
	{
		if($args && is_array($args)) {
			extract($args);
		}

		$view_name = $view_name . '.php';
		$path = INVOLVEME_DIR . '/views/' . $view_name;

		if(!file_exists($path)) {
			return '';
		}

		if($echo) {
			include($path);
		} else {
			ob_start();
			include($path);

			return ob_get_clean();
		}
	}

	public static function embed($post_id, $echo = true, $preview = false)
	{
		$InvolvemePost = self::get_instance();
		return $InvolvemePost->include_view('embed', $InvolvemePost->get_settings($post_id, $preview), $echo);
	}

	public function enqueue_script($hook_suffix)
	{
		global $post;
		if($hook_suffix !== 'post-new.php' && $hook_suffix != 'post.php') {
			return false;
		}

		$post_type='';
		if(isset($_GET['post_type'])){
			$post_type=$_GET['post_type'];
		}

		if($post->post_type == INVOLVE_ME_POST_TYPE || INVOLVE_ME_POST_TYPE === $post_type) {
			wp_enqueue_style('wp-color-picker');
			wp_enqueue_script('wp-color-picker-alpha', plugins_url('assets/js/wp-color-picker-alpha.min.js', INVOLVEME_FILE), array('wp-color-picker'), '3.0.0', true);
			wp_enqueue_script('clipboard', plugins_url('assets/js/clipboard.min.js', INVOLVEME_FILE), array(), '2.0.10');
			wp_enqueue_script('involve-me-post-admin', plugins_url('assets/js/involveme-post-admin.js', INVOLVEME_FILE), array('wp-color-picker-alpha','clipboard'),
				false, true);
		}
	}

	public function update_admin_columns($columns)
	{
		$date = $columns ['date'];
		unset($columns['date']);
		$columns['involveme_shortcode'] = __('Shortcode', 'involveme');
		$columns['date'] = $date;
		return $columns;
	}

	public function display_column_values($column, $post_id)
	{
		if('involveme_shortcode' == $column) {
			echo esc_html('[' . INVOLVE_ME_SHORTCODE . ' embed="' . $post_id . '"]');
		}
	}

	public function register_involvme_shortcode()
	{
		add_shortcode(INVOLVE_ME_SHORTCODE, array($this, 'handle_shortcode'));
	}

	public function handle_shortcode($atts)
	{
		$args = shortcode_atts(array(
			'embed' => 0,
		), $atts);
		return self::embed($args['embed'], false);
	}

	/**
	 * @param $post_id
	 * @return void
	 */
	private function saveStandard($post_id)
	{
		$width = sanitize_text_field($_POST[$this->key('width')]);
		if($width!='auto') {
			$width = (int) $width;
			if($width && $width < 320) {
				$width = 320;
			}
		}

		update_post_meta($post_id, $this->key('width', '_'), $width);

		$height = sanitize_text_field($_POST[$this->key('minimal_height')]);
		if($height != 'auto') {
			$height = (int)$height;
			if($height && $height < 200) {
				$height = 200;
			}
		}
		update_post_meta($post_id, $this->key('minimal_height', '_'), $height);

		$this->saveCheckboxFields(array('dynamic_height_resize','transparent_background'),$post_id);
	}

	/**
	 * @param $post_id
	 * @return void
	 */
	private function savePopup($post_id)
	{
		$this->saveTextFields(array('show_popup', 'popup_size', 'button_text', 'time_delay_to_close', 'stop_showing_duration','hide_once_viewed_duration','trigger_delay'), $post_id);
		$this->saveCheckboxFields(array('close_popup_on_completion', 'stop_showing_once_completed','hide_once_viewed'), $post_id);
	}

	/**
	 * @param $post_id
	 * @return void
	 */
	private function saveChatButton($post_id)
	{
		$this->saveTextFields(array('popup_size', 'icon', 'button_color', 'time_delay_to_close', 'stop_showing_duration','hide_once_viewed_duration','trigger_delay'), $post_id);
		$this->saveCheckboxFields(array('stop_showing_once_completed','close_popup_on_completion','hide_once_viewed'), $post_id);
	}

	/**
	 * @param $post_id
	 * @return void
	 */
	private function saveSidePanel($post_id)
	{
		$this->saveTextFields(array('show_popup_side','position','icon_side', 'button_color','popup_size', 'button_text', 'time_delay_to_close','stop_showing_duration', 'hide_once_viewed_duration','trigger_delay'), $post_id);
		$this->saveCheckboxFields(array('close_popup_on_completion','stop_showing_once_completed','hide_once_viewed'), $post_id);
	}

	/**
	 * @param $post_id
	 * @return void
	 */
	private function saveSideTab($post_id)
	{
		$this->saveTextFields(array('show_popup_side','position','icon_side', 'button_color','popup_size', 'button_text', 'time_delay_to_close', 'stop_showing_duration','trigger_delay', 'hide_once_viewed_duration'), $post_id);
		$this->saveCheckboxFields(array('close_popup_on_completion','stop_showing_once_completed','hide_once_viewed'), $post_id);
	}

	/**
	 * @param $post_id
	 * @return void
	 */
	private function saveTextValueField($post_id, $key)
	{
		update_post_meta($post_id, $this->key($key, '_'), sanitize_text_field($_POST[$this->key($key)]));
	}

	/**
	 * @param $post_id
	 * @return void
	 */
	private function saveCheckboxField($post_id, $key)
	{
		if(!isset($_POST[$this->key($key)])) {
			update_post_meta($post_id, $this->key($key, '_'), false);
		} else {
			update_post_meta($post_id, $this->key($key, '_'), true);
		}
	}

	/**
	 * @param array $checkboxFields
	 * @param $post_id
	 * @return void
	 */
	private function saveCheckboxFields(array $checkboxFields, $post_id)
	{
		foreach($checkboxFields as $field) {
			$this->saveCheckboxField($post_id, $field);
		}
	}

	/**
	 * @param array $textValueFields
	 * @param $post_id
	 * @return void
	 */
	private function saveTextFields(array $textValueFields, $post_id)
	{
		foreach($textValueFields as $field) {
			$this->saveTextValueField($post_id, $field);
		}
	}


}
