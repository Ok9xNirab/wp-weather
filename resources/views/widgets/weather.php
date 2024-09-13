<div class="nirab_widget_weather_widget">
	<div class="nirab_widget_weather_heading">
		<h4><?php esc_html_e( 'Current Weather', 'nirab-wi' ); ?></h4>
		<small><?php echo esc_html( $address ); ?></small>
		<h3><?php echo esc_html( $current->temp ); ?>&deg;C</h3>
		<p><?php echo esc_html( $current->conditions ); ?></p>
	</div>

	<div class="nirab_widget_forecast">
		<p>
			<small>7-Day Forecast</small>
		</p>
		<div class="nirab_widget_forecast_card">
	<?php foreach ( $forecasts as $forecast ) : ?>
				<div>
					<b><?php echo esc_html( gmdate( 'D', $forecast->datetimeEpoch ) ); ?></b>
					<p><?php echo esc_html( $forecast->tempmin . '&deg;C / ' . $forecast->tempmax . '&deg;C' ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
