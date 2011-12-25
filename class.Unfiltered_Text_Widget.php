<?php # -*- coding: utf-8 -*-

/**
 * Simplified variant of the native text widget class.
 *
 * @author Thomas Scholz aka toscho http://toscho.de
 * @version 1.0
 */
class Unfiltered_Text_Widget extends WP_Widget
{
	/**
	 * @uses apply_filters( 'magic_widgets_name' )
	 */
	public function __construct()
	{
		parent::__construct(
			'unfiltered_text'
		,	__( 'Unfiltered Text', 'theme_ftt' )
		,	array( 'description' => __( 'Pure Markup', 'theme_ftt' ) )
		,	array( 'width' => 300, 'height' => 150 )
		);
	}

	/**
	 * Output.
	 *
	 * @param  array $args
	 * @param  array $instance
	 * @return void
	 */
	public function widget( $args, $instance )
	{
		echo $instance['text'];
	}

	/**
	 * Prepares the content. Not.
	 *
	 * @param  array $new_instance New content
	 * @param  array $old_instance Old content
	 * @return array New content
	 */
	public function update( $new_instance, $old_instance )
	{
		return $new_instance;
	}

	/**
	 * Backend form.
	 *
	 * @param array $instance
	 * @return void
	 */
	public function form( $instance )
	{
		$instance = wp_parse_args( (array) $instance, array( 'text' => '' ) );
		$text     = esc_textarea( $instance['text'] );
?>
		<textarea class="widefat" rows="7" cols="20" id="<?php
			echo $this->get_field_id( 'text' );
		?>" name="<?php
			echo $this->get_field_name( 'text' );
		?>"><?php
			echo $text;
		?></textarea>
<?php
	}

	/**
	 * Registers this widget.
	 *
	 * @return void
	 */
	public static function register()
	{
		register_widget( __CLASS__ );
	}
}