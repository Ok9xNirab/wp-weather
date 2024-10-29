<div class="nirab-wi-shortcode">
	<div class="nirab-wi-current">
		<div>
			<h5><?php echo esc_html( $address ); ?></h5>
			<h3><?php echo esc_html( $current->temp ); ?>&deg;C</h3>
			<p>Humidity: <?php echo esc_html( $current->humidity ); ?>%</p>
		</div>
		<div class="nirab-wi-right">
			<h3><?php echo esc_html( $current->conditions ); ?></h3>
			<br/>
			<p class="nirab-wi-small-p"><?php esc_html_e( 'Sunrise', 'nirab-wi' ); ?>: <?php echo esc_html( gmdate( 'h:i A', $current->sunriseEpoch ) ); ?></p>
			<p class="nirab-wi-small-p"><?php esc_html_e( 'Sunset', 'nirab-wi' ); ?>: <?php echo esc_html( gmdate( 'h:i A', $current->sunsetEpoch ) ); ?></p>
		</div>
	</div>
	<div class="nirab-wi-forecast">
		<div>
			<p class="nirab-wi-small-p"><?php esc_html_e( '7-day Forecast', 'nirab-wi' ); ?></p>
		</div>
		<table>
			<?php foreach ( $forecasts as $forecast ) : ?>
				<tr>
					<td><?php echo esc_html( gmdate( 'l', $forecast->datetimeEpoch ) ); ?></td>
					<td class="nirab-wi-small-p"><?php echo esc_html( $forecast->tempmin . '&deg;C - ' . $forecast->tempmax . '&deg;C' ); ?></td>
					<td class="nirab-wi-small-p">
					<?php
					echo esc_html(
						sprintf(
							// translators: percentage of precipitation probabilities.
							__( '%s%% chance of rain', 'nirab-wi' ),
							$forecast->precipprob
						)
					);
					?>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	</div>
</div>
