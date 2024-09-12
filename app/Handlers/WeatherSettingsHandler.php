<?php

namespace Nirab\WI\Handlers;

use WPDrill\Facades\View;

/**
 * Settings Controller.
 */
class WeatherSettingsHandler {

	/**
	 * Initialize the class.
	 */
	public function __construct() {
		$this->register_settings();
	}

	/**
	 * Render settings page.
	 *
	 * @return void
	 */
	public function render() {
		View::output( 'settings' );
	}

	/**
	 * Register settings.
	 *
	 * @return void
	 */
	public function register_settings(): void {
		register_setting( 'nirab_weather_settings', 'nirab_wi_location' );
		register_setting( 'nirab_weather_settings', 'nirab_wi_enable_alert' );
		register_setting( 'nirab_weather_settings', 'nirab_wi_email' );

		$this->register_fields();
	}

	/**
	 * Register fields.
	 *
	 * @return void
	 */
	private function register_fields(): void {
		add_settings_section(
			'default',
			'',
			function () {
			},
			'nirab-weather-settings'
		);

		add_settings_field(
			'nirab_wi_location',
			__( 'Location for Weather', 'nirab-wi' ),
			array( $this, 'location_field' ),
			'nirab-weather-settings',
		);

		add_settings_field(
			'nirab_wi_enable_alert',
			__( 'Enable Alert', 'nirab-wi' ),
			array( $this, 'enabled_alert_field' ),
			'nirab-weather-settings',
		);

		add_settings_field(
			'nirab_wi_email',
			__( 'Email for Alert', 'nirab-wi' ),
			array( $this, 'email_field' ),
			'nirab-weather-settings',
		);
	}

	/**
	 * Input for location field.
	 *
	 * @return void
	 */
	public function location_field(): void {
		$option = get_option( 'nirab_wi_location' );
		?>
		<input class="regular-text" placeholder="Ex: London" type="text" name="nirab_wi_location" id="nirab_wi_location"
				value="<?php echo esc_attr( $option ); ?>"/>
		<?php
	}

	/**
	 * Checkbox for enabling email alert.
	 *
	 * @return void
	 */
	public function enabled_alert_field(): void {
		$option = get_option( 'nirab_wi_enable_alert' );
		?>
		<input class="regular-text" placeholder="Ex: London" type="checkbox"
				name="nirab_wi_enable_alert" <?php echo checked( 'on', $option ); ?> />
		<?php
	}

	/**
	 * Email address for alert.
	 *
	 * @return void
	 */
	public function email_field(): void {
		$option = get_option( 'nirab_wi_email' );
		?>
		<input class="regular-text" placeholder="<?php echo esc_attr( get_option( 'admin_email' ) ); ?>" type="email"
				name="nirab_wi_email" value="<?php echo esc_attr( $option ); ?>"/>
		<?php
	}
}
