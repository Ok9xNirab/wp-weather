<?php

namespace Nirab\WI\Handlers;

use Nirab\WI\Facades\LocationAPI;
use WPDrill\Facades\View;

/**
 * Settings Controller.
 */
class WeatherSettingsHandler {

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

    public function register_settings(): void {
        register_setting( 'nirab_weather_settings', 'nirab_wi_location' );
        register_setting( 'nirab_weather_settings', 'nirab_wi_enable_alert' );
        register_setting( 'nirab_weather_settings', 'nirab_wi_email' );

        $this->register_fields();
    }

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
            __( 'Location for Weather', 'nirab_wi' ),
            array( $this, 'location_field' ),
            'nirab-weather-settings',
        );

        add_settings_field(
            'nirab_wi_enable_alert',
            __( 'Enable Alert', 'nirab_wi' ),
            array( $this, 'enabled_alert_field' ),
            'nirab-weather-settings',
        );

        add_settings_field(
            'nirab_wi_email',
            __( 'Email for Alert', 'nirab_wi' ),
            array( $this, 'email_field' ),
            'nirab-weather-settings',
        );
    }

    public function location_field(): void {
        $option = get_option( 'nirab_wi_location' );
        ?>
        <input class="regular-text" placeholder="Ex: London" type="text" name="nirab_wi_location" id="nirab_wi_location"
               value="<?php echo esc_attr( $option ); ?>"/>
        <?php
    }

    public function enabled_alert_field(): void {
        $option = get_option( 'nirab_wi_enable_alert' );
        ?>
        <input class="regular-text" placeholder="Ex: London" type="checkbox"
               name="nirab_wi_enable_alert" <?php echo checked( 'on', $option ); ?> />
        <?php
    }

    public function email_field(): void {
        $option = get_option( 'nirab_wi_email' );
        ?>
        <input class="regular-text" placeholder="<?php echo esc_attr( get_option( 'admin_email' ) ); ?>" type="email"
               name="nirab_wi_email" value="<?php echo esc_attr( $option ); ?>"/>
        <?php
    }
}
