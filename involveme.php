<?php
/**
 * Plugin Name:     involve.me - Create Surveys, Quizzes, Calculators & Forms as Embedded Widgets or Pop-ups
 * Plugin URI:      https://wordpress.org/plugins/involve-me/
 * Description:     Add forms, quizzes, surveys and interactive calculators to your WordPress site. Easily embed or use as pop-ups. No coding required.
 * Author:          involve.me
 * Author URI:      https://www.involve.me/
 * Text Domain:     involveme
 * Domain Path:     /languages
 * Version:         1.1.6
 *
 * @package         Involveme
 */

require(__DIR__ . '/vendor/autoload.php');
define( 'INVOLVEME_DIR', __DIR__ );
define( 'INVOLVEME_FILE', __FILE__ );
define('INVOLVE_ME_POST_TYPE', 'involve-me-project');
define('INVOLVE_ME_SHORTCODE', 'involve-me');


if(!class_exists('Involveme')) {
	class Involveme
	{

		/**
		 * @var Involveme The reference the *Involveme* instance of this class
		 */
		private static $instance;

		/** @var InvolvemePost */
		public $post;

		/**
		 * Returns the *Involveme* instance of this class.
		 *
		 * @return Involveme The *Singleton* instance.
		 */
		public static function get_instance()
		{
			if(null === self::$instance) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Stockpack constructor.
		 */
		protected function __construct()
		{
			$this->dependencies();
			add_action('init', array($this, 'init'));
		}

		public function dependencies()
		{
			$this->post = InvolvemePost::get_instance();
		}

		/**
		 *
		 */
		public function filters()
		{
			add_filter('plugin_action_links_' . plugin_basename(__FILE__), array(
				$this,
				'plugin_action_links'
			));
		}

		/**
		 * Init the plugin after plugins_loaded so environment variables are set.
		 */
		public function init()
		{
			// works
			load_plugin_textdomain('involveme', false, plugin_basename(dirname(__FILE__)) . '/languages');
			$this->filters();
		}

		/**
		 * Adds plugin action links
		 *
		 * @since 1.0.0
		 */
		public function plugin_action_links($links)
		{
			$setting_link = $this->get_projects_link();
			$plugin_links = array(
				'<a href="' . $setting_link . '">' . __('involve.me projects', 'involveme') . '</a>',
			);

			return array_merge($plugin_links, $links);
		}

		/**
		 * Get setting link.
		 *
		 * @return string Setting link
		 * @since 1.0.0
		 *
		 */
		public function get_projects_link()
		{
			return admin_url('edit.php?post_type='.INVOLVE_ME_POST_TYPE);
		}

	}

	add_action('after_setup_theme', 'involveme_register_plugin');
	function involveme_register_plugin()
	{
		$GLOBALS['involveme'] = Involveme::get_instance();
	}


}
