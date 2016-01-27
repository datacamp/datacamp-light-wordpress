<?php
/**
 * @package DataCampLight
 * @version 1.0
 */
/*
Plugin Name: DataCamp Light
Description: This plugin allows easy embedding of programming exercises using the DataCamp Light interactive coding interface.
Author: DataCamp
Version: 1.0
Author URI: https://www.datacamp.com/
*/

if (!defined('ABSPATH')) exit;

class DataCampLight {
	public static function loadJS(){
		// wp_enqueue_scripts action hook to link only on the front-end
		add_action("wp_enqueue_scripts", array(__CLASS__, "loadJSHook"));
	}

	public static function loadJSHook(){
		wp_enqueue_script("datacamp-light-library", "https://cdn.datacamp.com/datacamp-light-latest.min.js");
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


	public static function datacampExerciseSC($atts, $content, $tag) {
		$atts = shortcode_atts(array(
			'lang' => '',
		), $atts);
		return '[' . $tag . ']'
				. '<div data-datacamp-exercise data-lang="' . $atts['lang'] . '">'
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
		return '<p data-type="hint">' . $content .  '</p>';
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
		include(plugin_dir_path(__FILE__) . 'includes/MediaButtonPopup.php');

		wp_enqueue_style( 'wp-jquery-ui-dialog' );
		wp_enqueue_script('jquery-ui-dialog');

		wp_enqueue_script('datacamp_media_button_popup', plugins_url('js/mediaButtonPopup.js', __FILE__), array('jquery'));
		wp_enqueue_style('datacamp_media_button_popup', plugins_url('style/media_button_popup.css', __FILE__));
	}

	private static function setMediaButton() {
		add_action('media_buttons',  array(__CLASS__, 'showMediaButton'), 15);
		add_action('wp_enqueue_media', array(__CLASS__, 'includeMediaButton'));
	}

	public static function run() {
		self::setMediaButton();
		self::setShortCodes();
		self::loadJS();
	}
}

// Run plugin
DataCampLight::run();

?>
