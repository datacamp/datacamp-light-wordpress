<?php
/**
 * @package DataCampLight
 * @version 1.0
 */
/*
Plugin Name: DataCamp Light
Description: This plugin allows easy integration of the DataCamp Light interactive learning widget into posts and pages.
Version: 1.0
Author URI: https://www.datacamp.com/
*/

if (!defined('ABSPATH')) exit;

class DataCampLight {
	public static function loadJSAndStyle(){
		// wp_enqueue_scripts action hook to link only on the front-end
		add_action("wp_enqueue_scripts", array(__CLASS__, "loadJSAndStyleHook"));
	}

	public static function loadJSAndStyleHook(){
		wp_enqueue_style("datacamp-light-style", plugins_url('style/frontend_style.css', __FILE__));
		wp_enqueue_script("datacamp-light-library", "https://cdn.datacamp.com/datacamp-light-latest.min.js", array(), false, true);
	}

	/**
	* If anything breaks wordpress or other plugins, it's probably this.
	* Inspired by http://wordpress.stackexchange.com/questions/99625/shortcode-adding-p-and-br-tags
	* Replaced "raw" with "datacamp_exercise"
	*/
	public static function customFormatter($content){
		$new_content = '';
		$pattern_full = '{(\[datacamp_exercise\].*?\[/datacamp_exercise\])}is';
		$pattern_contents = '{\[datacamp_exercise\](.*?)\[/datacamp_exercise\]}is';
		$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

		foreach ($pieces as $piece) {
			if (preg_match($pattern_contents, $piece, $matches)) {
				$new_content .= html_entity_decode($matches[1]);
			} else {
				$new_content .= wptexturize(wpautop($piece));
			}
		}

		return $new_content;
	}


	/**
	 * Performs the htmlentities function on everything in the [datacamp_exercise] shortcode.
	 */
	public static function htmlEntitiesFormatter($content){
		$new_content = '';
		$pattern_full = '{(\[datacamp_exercise\].*?\[/datacamp_exercise\])}is';
		$pattern_contents = '{\[datacamp_exercise\](.*?)\[/datacamp_exercise\]}is';
		$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

		foreach ($pieces as $piece) {
			if (preg_match($pattern_contents, $piece, $matches)) {
				$new_content .= htmlentities($matches[0]);
			} else {
				$new_content .= $piece;
			}
		}
		return $new_content;
	}

	private static function createDataAttribute($atts, $key) {
		if (isset($atts[$key])) {
			return ' data-' . $key . '="' . $atts[$key] . '"';
		}
		return "";
	}


	public static function datacampExerciseSC($atts, $content, $tag) {
		return '[' . $tag . ']'
				. '<div data-datacamp-exercise'
					. self::createDataAttribute($atts, 'lang')
					. self::createDataAttribute($atts, 'height')
					. self::createDataAttribute($atts, 'min-height')
					. self::createDataAttribute($atts, 'max-height')
				. '>'
					. do_shortcode($content)
				. '</div>'
			. '[/' . $tag . ']';
	}

	public static function pecSC($atts, $content) {
		return '<code data-type="pre-exercise-code">' . $content .  '</code>';
	}

	public static function sampleCodeSC($atts, $content) {
		return '<code data-type="sample-code">' . $content .  '</code>';
	}

	public static function solutionSC($atts, $content) {
		return '<code data-type="solution">' . $content .  '</code>';
	}

	public static function sctSC($atts, $content) {
		return '<code data-type="sct">' . $content .  '</code>';
	}

	public static function hintSC($atts, $content) {
		return '<div data-type="hint">' . $content .  '</div>';
	}

	private static function addShortCode($name, $functionName){
		add_shortcode($name, array(__CLASS__, $functionName));
	}

	private static function setShortCodes(){
		// Remove default formatters that add <p> and <br>
		remove_filter('the_content', 'wpautop');
		remove_filter('the_content', 'wptexturize');

		// Add own version of the above filters (they fallback to them)
		add_filter('the_content', array(__CLASS__, "customFormatter"), 99);

		// Perform htmlentities on code inside datacamp_exercse shortcode
		// This is executed first on post/page content
		// Then the shortcodes are parsed
		// Then the customFormatter is executed which reverses this process
		add_filter('the_content', array(__CLASS__, "htmlEntitiesFormatter"));

		// Add the datacamp shortcodes
		self::addShortCode('datacamp_pre_exercise_code', 'pecSC');
		self::addShortCode('datacamp_sample_code', 'sampleCodeSC');
		self::addShortCode('datacamp_solution', 'solutionSC');
		self::addShortCode('datacamp_sct', 'sctSC');
		self::addShortCode('datacamp_hint', 'hintSC');

		// If you rename this, you should also change the regexes in the customFormatter
		self::addShortCode('datacamp_exercise', 'datacampExerciseSC');
	}

	public static function showMediaButton() {
		echo '<a href="" class="button"' .
				'id="insert-datacamp-exercise-button" title="' . __("Insert DataCamp Exercise", 'add_datacamp_exercise') . '">' .
				'Add Exercise' .
			'</a>';
	}

	public static function includeMediaButton() {
		include(plugin_dir_path(__FILE__) . 'includes/media_button_popup.php');

		wp_enqueue_style( 'wp-jquery-ui-dialog' );
		wp_enqueue_script('jquery-ui-dialog');

		wp_enqueue_script('datacamp_media_button_popup', plugins_url('js/media_button_popup.js', __FILE__), array('jquery'));
		wp_enqueue_style('datacamp_media_button_popup', plugins_url('style/media_button_popup.css', __FILE__));
	}

	private static function setMediaButton() {
		add_action('media_buttons',  array(__CLASS__, 'showMediaButton'), 15);
		add_action('wp_enqueue_media', array(__CLASS__, 'includeMediaButton'));
	}

	public static function run() {
		self::setMediaButton();
		self::setShortCodes();
		self::loadJSAndStyle();
	}
}

// Run plugin
DataCampLight::run();

?>
