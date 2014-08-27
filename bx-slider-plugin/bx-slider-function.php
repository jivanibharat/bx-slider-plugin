<?php 
function bx_slider_setting() {
	
	echo '<div class="wrap">';
	//screen_icon( 'plugins' );
	echo '<h2><div class="bxsetting"></div>My Bx Slider Setting Page </h2>';
	
	if($_GET['settings-updated']=='true') {?>
    <div id="message" class="updated below-h2"><p>Bx Slider Setting Updated....</p></div>
    <?php } ?>
	<form method="post" action="options.php">
			<?php settings_fields( 'bx_slider_options' ); ?>
			<?php do_settings_sections( 'setting' ); ?>
			<br /><p><input type="submit" name="Submit" value="<?php _e( 'Update Settings', 'bx-slider' ); ?>" class="button-primary" /></p>
		</form><?php echo '</div>'; 
}

function bx_slider_option_init() {
	
	/* Register the bx slider settings. */
	register_setting( 'bx_slider_options', 'bx_slider_options', 'bx_slider_validate_options' );
	
	/* Add bx slider settings section. */
	add_settings_section( 'bx_slider_options_main', __( ' ', 'bx-slider' ), 'bx_slider_text', 'setting' );
	
	/* Add bx slider settings fields. */
	add_settings_field( 'slider_useCSS', __( 'useCSS:', 'bx-slider' ), 'slider_useCSS', 'setting','bx_slider_options_main');
	add_settings_field( 'slider_responsive', __( 'responsive:', 'bx-slider' ), 'slider_responsive', 'setting','bx_slider_options_main');
	add_settings_field( 'slider_captions', __( 'captions:', 'bx-slider' ), 'slider_captions', 'setting','bx_slider_options_main');
	add_settings_field( 'slider_slideWidth', __( 'slideWidth:<span class="description">  (integer)</span>', 'bx-slider' ), 'slider_slideWidth', 'setting','bx_slider_options_main');
	add_settings_field( 'slider_mode1', __( 'mode:', 'bx-slider' ), 'slider_mode1', 'setting','bx_slider_options_main');
	add_settings_field( 'slider_pager', __( 'pager:', 'bx-slider' ), 'slider_pager', 'setting','bx_slider_options_main');
	add_settings_field( 'slider_controls', __( 'controls:', 'bx-slider' ), 'slider_controls', 'setting','bx_slider_options_main');
	//add_settings_field( 'slider_nextText', __( 'nextText:<span class="description">  (string)</span>', 'bx-slider' ), 'slider_nextText', 'setting','bx_slider_options_main');
	//add_settings_field( 'slider_prevText', __( 'prevText:<span class="description">  (string)</span>', 'bx-slider' ), 'slider_prevText', 'setting','bx_slider_options_main');
	add_settings_field( 'slider_autoHover', __( 'autoHover:', 'bx-slider' ), 'slider_autoHover', 'setting','bx_slider_options_main');
	add_settings_field( 'slider_auto', __( 'auto:', 'bx-slider' ), 'slider_auto', 'setting','bx_slider_options_main');
	add_settings_field( 'slider_startSlide', __( 'startSlide:<span class="description">  (integer)</span>', 'bx-slider' ), 'slider_startSlide', 'setting','bx_slider_options_main');
	add_settings_field( 'slider_speed', __( 'speed:  <span class="description">  (integer)</span>', 'bx-slider' ), 'slider_speed', 'setting','bx_slider_options_main');
	add_settings_field( 'slider_pause', __( 'pause:<span class="description">  (integer)</span>', 'bx-slider' ), 'slider_pause', 'setting','bx_slider_options_main');
	add_settings_field( 'slider_randomStart', __( 'randomStart:', 'bx-slider' ), 'slider_randomStart', 'setting','bx_slider_options_main');
	add_settings_field( 'slider_infiniteLoop', __( 'infiniteLoop:', 'bx-slider' ), 'slider_infiniteLoop', 'setting','bx_slider_options_main');
	add_settings_field( 'slider_adaptiveHeight', __( 'adaptiveHeight:', 'bx-slider' ), 'slider_adaptiveHeight', 'setting','bx_slider_options_main');
}

function slider_useCSS()
{
	/* Get the option value from the database. */
	$options = get_option( 'bx_slider_options' );
	$slider_useCSS = $options['slider_useCSS'];
	/* Echo the field. */
	echo "<select id='slider_useCSS' name='bx_slider_options[slider_useCSS]'>";
	echo '<option value="true" ' . selected( $slider_useCSS, 'true', false ) . ' >' . __( 'True', 'bx-slider' ) . '</option>';
	echo '<option value="false" ' . selected( $slider_useCSS, 'false', false ) . ' >' . __( 'False', 'bx-slider' ) . '</option>';
	echo '</select>'; 
	?><span class="description"><?php _e( 'If true, CSS transitions will be used for horizontal and vertical slide animations (this uses native hardware acceleration). If false, jQuery animate() will be used.', 'bx-slider' ); ?></span><?php
}
function slider_mode1()
{
	/* Get the option value from the database. */
	$options = get_option( 'bx_slider_options' );
	$slide_effect = $options['slider_mode1'];
	/* Echo the field. */
	echo "<select id='slider_mode1' name='bx_slider_options[slider_mode1]'>";
	echo '<option value="horizontal" ' . selected( $slide_effect, 'horizontal', false ) . ' >' . __('Horizontal', 'bx-slider' ) . '</option>';
	echo '</select>';?><span class="description"><?php _e(  'Transition between slides', 'bx-slider' ); ?></span><?php
}
 
function slider_speed()
{
	/* Get the option value from the database. */
	$options = get_option( 'bx_slider_options' );
	$slider_speed = $options['slider_speed'];
	/* Echo the field. */ ?>
	<input type="text" id="slider_speed" name="bx_slider_options[slider_speed]" value="<?php echo $slider_speed; ?>" /> <span class="description"><?php _e( 'Slide transition duration (in ms)', 'bx-slider' ); ?></span>
<?php }
function slider_responsive()
{
	/* Get the option value from the database. */
	$options = get_option( 'bx_slider_options' );
	$slider_responsive = $options['slider_responsive'];
	/* Echo the field. */
	echo "<select id='slider_responsive' name='bx_slider_options[slider_responsive]'>";
	echo '<option value="true" ' . selected( $slider_responsive, 'true', false ) . ' >' . __( 'True', 'bx-slider' ) . '</option>';
	echo '<option value="false" ' . selected( $slider_responsive, 'false', false ) . ' >' . __( 'False', 'bx-slider' ) . '</option>';
	echo '</select>'; 
	?><span class="description"><?php _e( 'Enable or disable auto resize of the slider. Useful if you need to use fixed width sliders.', 'bx-slider' ); ?></span><?php
}
function slider_startSlide()
{
	/* Get the option value from the database. */
	$options = get_option( 'bx_slider_options' );
	$slider_startSlide = $options['slider_startSlide'];
	/* Echo the field. */ ?>
	<input type="text" id="slider_startSlide" name="bx_slider_options[slider_startSlide]" value="<?php echo $slider_startSlide; ?>" /> <span class="description"><?php _e( 'Starting slide index (zero-based)', 'bx-slider' ); ?></span>
<?php }
function slider_randomStart()
{
	/* Get the option value from the database. */
	$options = get_option( 'bx_slider_options' );
	$slide_effect = $options['slider_randomStart'];
	/* Echo the field. */
	echo "<select id='slider_randomStart' name='bx_slider_options[slider_randomStart]'>";
	echo '<option value="true" ' . selected( $slide_effect, 'true', false ) . ' >' . __( 'True', 'bx-slider' ) . '</option>';
	echo '<option value="false" ' . selected( $slide_effect, 'false', false ) . ' >' . __( 'False', 'bx-slider' ) . '</option>';
	echo '</select>';
}
function slider_infiniteLoop()
{
	/* Get the option value from the database. */
	$options = get_option( 'bx_slider_options' );
	$slider_infiniteLoop = $options['slider_infiniteLoop'];
	/* Echo the field. */
	echo "<select id='slider_infiniteLoop' name='bx_slider_options[slider_infiniteLoop]'>";
	echo '<option value="true" ' . selected( $slider_infiniteLoop, 'true', false ) . ' >' . __( 'True', 'bx-slider' ) . '</option>';
	echo '<option value="false" ' . selected( $slider_infiniteLoop, 'false', false ) . ' >' . __( 'False', 'bx-slider' ) . '</option>';
	echo '</select>'; 
	?><span class="description"><?php _e( 'If true, clicking "Next" while on the last slide will transition to the first slide and vice-versa', 'bx-slider' ); ?></span><?php
}
function slider_captions()
{
/* Get the option value from the database. */
	$options = get_option( 'bx_slider_options' );
	$slider_captions = $options['slider_captions'];
	/* Echo the field. */
	echo "<select id='slider_captions' name='bx_slider_options[slider_captions]'>";
	echo '<option value="true" ' . selected( $slider_captions, 'true', false ) . ' >' . __( 'True', 'bx-slider' ) . '</option>';
	echo '<option value="false" ' . selected( $slider_captions, 'false', false ) . ' >' . __( 'False', 'bx-slider' ) . '</option>';
	echo '</select>'; 
	?><span class="description"><?php _e( 'Include image captions. Captions are derived from the images title attribute', 'bx-slider' ); ?></span><?php
}
function slider_adaptiveHeight()
{
	/* Get the option value from the database. */
	$options = get_option( 'bx_slider_options' );
	$slider_adaptiveHeight = $options['slider_adaptiveHeight'];
	/* Echo the field. */
	echo "<select id='slider_adaptiveHeight' name='bx_slider_options[slider_adaptiveHeight]'>";
	echo '<option value="true" ' . selected( $slider_adaptiveHeight, 'true', false ) . ' >' . __( 'True', 'bx-slider' ) . '</option>';
	echo '<option value="false" ' . selected( $slider_adaptiveHeight, 'false', false ) . ' >' . __( 'False', 'bx-slider' ) . '</option>';
	echo '</select>'; 
	?><span class="description"><?php _e( 'Dynamically adjust slider height based on each slides height', 'bx-slider' ); ?></span><?php
}
function slider_pager()
{
/* Get the option value from the database. */
	$options = get_option( 'bx_slider_options' );
	$slider_pager = $options['slider_pager'];
	/* Echo the field. */
	echo "<select id='slider_pager' name='bx_slider_options[slider_pager]'>";
	echo '<option value="true" ' . selected( $slider_pager, 'true', false ) . ' >' . __( 'True', 'bx-slider' ) . '</option>';
	echo '<option value="false" ' . selected( $slider_pager, 'false', false ) . ' >' . __( 'False', 'bx-slider' ) . '</option>';
	echo '</select>'; 
	?><span class="description"><?php _e( 'If true, a pager will be added', 'bx-slider' ); ?></span><?php
}
function slider_slideWidth()
{
	/* Get the option value from the database. */
	$options = get_option( 'bx_slider_options' );
	$slider_slideWidth = $options['slider_slideWidth'];
	/* Echo the field. */ ?>
	<input type="text" id="slider_slideWidth" name="bx_slider_options[slider_slideWidth]" value="<?php echo $slider_slideWidth; ?>" /> <span class="description"><?php _e( 'The width of each slide. This setting is required for all horizontal carousels!', 'bx-slider' ); ?></span>
<?php }
function slider_controls()
{
	/* Get the option value from the database. */
	$options = get_option( 'bx_slider_options' );
	$slider_controls = $options['slider_controls'];
	/* Echo the field. */
	echo "<select id='slider_controls' name='bx_slider_options[slider_controls]'>";
	echo '<option value="true" ' . selected( $slider_controls, 'true', false ) . ' >' . __( 'True', 'bx-slider' ) . '</option>';
	echo '<option value="false" ' . selected( $slider_controls, 'false', false ) . ' >' . __( 'False', 'bx-slider' ) . '</option>';
	echo '</select>'; 
	?><span class="description"><?php _e( 'If true, "Next" / "Prev" controls will be added', 'bx-slider' ); ?></span><?php	
}
/*
function slider_prevText()
{
	// Get the option value from the database. 
	$options = get_option( 'bx_slider_options' );
	$slider_prevText = $options['slider_prevText'];
	// Echo the field.  ?>
	<input type="text" id="slider_prevText" name="bx_slider_options[slider_prevText]" value="<?php echo $slider_prevText; ?>" /> <span class="description"><?php _e( 'Text to be used for the "Prev" control', 'bx-slider' ); ?></span>
<?php }
function slider_nextText()
{
	// Get the option value from the database. 
	$options = get_option( 'bx_slider_options' );
	$slider_nextText = $options['slider_nextText'];
	// Echo the field.  ?>
	<input type="text" id="slider_nextText" name="bx_slider_options[slider_nextText]" value="<?php echo $slider_nextText; ?>" /> <span class="description"><?php _e( 'Text to be used for the "Next" control', 'bx-slider' ); ?></span>
<?php }
*/
function slider_pause()
{
/* Get the option value from the database. */
	$options = get_option( 'bx_slider_options' );
	$slider_pause = $options['slider_pause'];
	/* Echo the field. */ ?>
	<input type="text" id="slider_pause" name="bx_slider_options[slider_pause]" value="<?php echo $slider_pause; ?>" /> <span class="description"><?php _e( 'The amount of time (in ms) between each auto transition', 'bx-slider' ); ?></span>
<?php }
function slider_auto()
{
	/* Get the option value from the database. */
	$options = get_option( 'bx_slider_options' );
	$slider_auto = $options['slider_auto'];
	/* Echo the field. */
	echo "<select id='slider_auto' name='bx_slider_options[slider_auto]'>";
	echo '<option value="true" ' . selected( $slider_auto, 'true', false ) . ' >' . __( 'True', 'bx-slider' ) . '</option>';
	echo '<option value="false" ' . selected( $slider_auto, 'false', false ) . ' >' . __( 'False', 'bx-slider' ) . '</option>';
	echo '</select>'; 
	?><span class="description"><?php _e( 'Slides will automatically transition', 'bx-slider' ); ?></span><?php	
}
function slider_autoHover()
{
	/* Get the option value from the database. */
	$options = get_option( 'bx_slider_options' );
	$slider_autoHover = $options['slider_autoHover'];
	/* Echo the field. */
	echo "<select id='slider_autoHover' name='bx_slider_options[slider_autoHover]'>";
	echo '<option value="true" ' . selected( $slider_autoHover, 'true', false ) . ' >' . __( 'True', 'bx-slider' ) . '</option>';
	echo '<option value="false" ' . selected( $slider_autoHover, 'false', false ) . ' >' . __( 'False', 'bx-slider' ) . '</option>';
	echo '</select>'; 
	?><span class="description"><?php _e( 'Auto show will pause when mouse hovers over slider', 'bx-slider' ); ?></span><?php	
}
function bx_slider_default_settings()
{
	/* Retrieve exisitng options, if any. */
	$ex_options = get_option( 'bx_slider_options' );
	
	/* Check if options are set. Add default values if not. */ 
	if ( !is_array( $ex_options ) || $ex_options['slider_mode1'] == '' || $ex_options['slider_speed'] == '' || $ex_options['slider_responsive'] == '' || $ex_options['slider_startSlide'] == '' || $ex_options['slider_randomStart'] == '' || $ex_options['slider_infiniteLoop'] == '' || $ex_options['slider_captions'] == '' || $ex_options['slider_adaptiveHeight'] == '' || $ex_options['slider_useCSS'] == '' || $ex_options['slider_pager'] == '' || $ex_options['slider_controls'] == '' || $ex_options['slider_auto'] == '' || $ex_options['slider_autoHover'] == '' || $ex_options['slider_slideWidth'] == '' ) 
	{
		$default_options = array(	
			'slider_mode1'     			=> 'horizontal',
			'slider_speed'    			=> 500,
			'slider_responsive' 		=> 'true',
			'slider_startSlide'			=> 0,
			'slider_randomStart'		=>'false',
			'slider_infiniteLoop'		=>'true',
			'slider_captions'			=>'false',
			'slider_adaptiveHeight'		=>'false',
			'slider_useCSS'				=>'true',
			'slider_pager'				=>'true',
			'slider_controls'			=>'true',
			//'slider_nextText'			=>'Next',
			//'slider_prevText'			=>'Prev',
			'slider_auto'				=>'false',
			'slider_pause'				=>'4000',
			'slider_autoHover'			=>'false',
			'slider_slideWidth'			=>0
			);	
		// Set the default options. 
		update_option( 'bx_slider_options', $default_options );
	}	
}

/**
 * Validate use
 */
function bx_slider_validate_options( $input ) {
	
	$options = get_option( 'bx_slider_options' );
	
	$options['slider_useCSS'] = wp_filter_nohtml_kses( $input['slider_useCSS'] );
	$options['slider_auto'] = wp_filter_nohtml_kses( $input['slider_auto'] );
	$options['slider_controls'] = wp_filter_nohtml_kses( $input['slider_controls'] );
	$options['slider_pager'] = wp_filter_nohtml_kses( $input['slider_pager'] );
	$options['slider_mode1'] = wp_filter_nohtml_kses( $input['slider_mode1'] );
	$options['slider_randomStart'] = wp_filter_nohtml_kses( $input['slider_randomStart'] );
	$options['slider_infiniteLoop'] = wp_filter_nohtml_kses( $input['slider_infiniteLoop'] );
	$options['slider_captions'] = wp_filter_nohtml_kses( $input['slider_captions'] );
	$options['slider_adaptiveHeight'] = wp_filter_nohtml_kses( $input['slider_adaptiveHeight'] );
	$options['slider_speed'] = wp_filter_nohtml_kses( intval( $input['slider_speed'] ) );
	$options['slider_responsive'] = wp_filter_nohtml_kses( $input['slider_responsive'] );
	$options['slider_autoHover'] = wp_filter_nohtml_kses( $input['slider_autoHover'] );
	$options['slider_startSlide'] = wp_filter_nohtml_kses( intval( $input['slider_startSlide'] ) );
	$options['slider_slideWidth'] = wp_filter_nohtml_kses( intval( $input['slider_slideWidth'] ) );
	$options['slider_pause'] = wp_filter_nohtml_kses( intval( $input['slider_pause'] ) );
	//$options['slider_prevText'] = wp_filter_nohtml_kses( strval( $input['slider_prevText'] ) );
	//$options['slider_nextText'] = wp_filter_nohtml_kses( strval( $input['slider_nextText'] ) );
	
	return $options;
}
function bx_slider_enqueue_jsandstylenew()
 {	
 	$options = get_option( 'bx_slider_options' );
?>
	<script type="text/javascript">
	$(document).ready(function() {
		$('.bxslider').bxSlider({
			controls: <?php echo $options['slider_controls']; ?>,
			useCSS: <?php echo $options['slider_useCSS']; ?>,
			responsive: <?php echo $options['slider_responsive']; ?>,
			slideWidth: <?php echo $options['slider_slideWidth']; ?>,
			speed: <?php echo $options['slider_speed']; ?>,
			pause: <?php echo $options['slider_pause']; ?>,
			startSlide: <?php echo $options['slider_startSlide']; ?>,
			auto: <?php echo $options['slider_auto']; ?>,
			randomStart: <?php echo $options['slider_randomStart']; ?>,
			infiniteLoop: <?php echo $options['slider_infiniteLoop']; ?>,
			captions: <?php echo $options['slider_captions']; ?>,
			adaptiveHeight: <?php echo $options['slider_adaptiveHeight']; ?>,
			pager: <?php echo $options['slider_pager']; ?>,
			controls: <?php echo $options['slider_controls']; ?>,
			autoHover: <?php echo $options['slider_autoHover']; ?>
		});	
	});
	</script>
<?php }
function bx_slider_text() { echo '<p class="description">' . __( '<span class="read"> Change Default Setting To Your Requirement...<br> <br>  Please Read Carefully To Below Description...</span> <br><br> This Slider used in shortcode to display for all slide <span class="ex"> ex [bxslider] </span> and you can create category wise slider so you can first add category and then add to slide in partiqular category all slide are add then use bx slider in category wise slide display for <span class="ex"> ex. [bxslider cat="home"] </span> but you can set "cat" equals category slug proper set then display category wise slide Thanks for user Bx Slider Plugin. Thanks............', 'bx-slider' ) . '</p>'.'<br/>'; }

/*function bx_slider_enqueue_jsandstyle()
{
	 // Enqueue script. 
	wp_enqueue_script( 'responsive_slider_bx_slider', BX_SLIDER_URI.'js/jquery.bxslidermain.js', array( 'jquery' ), 0.1, true );

	// Get slider settings. 
	$options = get_option( 'bx_slider_options' );

	// Prepare variables for JavaScript. 
	wp_localize_script( 'responsive_slider_bx_slider', 'bxslider', array(
		'slider_controls'    => $options['slider_controls'],
	) );
}
*/