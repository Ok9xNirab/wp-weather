import { registerBlockType } from "@wordpress/blocks";
import { useBlockProps } from "@wordpress/block-editor";
import { __ } from "@wordpress/i18n";
import block from "./block.json";
import icons from "../../icons";
import "./style.less";

registerBlockType(block.name, {
  icon: icons.weather,
  edit({ attributes, setAttributes }) {
    const blockProps = useBlockProps();

    return (
      <>
        <div {...blockProps}>
          <div class="nirab_widget_weather_widget">
            <div class="nirab_widget_weather_heading">
              <h4>{__("Current Weather", "nirab-wi")}</h4>
              <small>{__("{Location you set}", "nirab-wi")}</small>
              <h3>100 &deg;C</h3>
              <p>{__("Partially Hot", "nirab-wi")}</p>
            </div>

            <div class="nirab_widget_forecast">
              <p>
                <small>{__("7-Day Forecast", "nirab-wi")}</small>
              </p>
              <div class="nirab_widget_forecast_card">
                <div>
                  <b>Sun</b>
                  <p>100&deg;C / 120&deg;C</p>
                </div>
                <div>
                  <b>Mon</b>
                  <p>100&deg;C / 120&deg;C</p>
                </div>
                <div>
                  <b>Tue</b>
                  <p>100&deg;C / 120&deg;C</p>
                </div>
                <div>
                  <b>Wed</b>
                  <p>100&deg;C / 120&deg;C</p>
                </div>
                <div>
                  <b>Thu</b>
                  <p>100&deg;C / 120&deg;C</p>
                </div>
                <div>
                  <b>Fri</b>
                  <p>100&deg;C / 120&deg;C</p>
                </div>
                <div>
                  <b>Sat</b>
                  <p>100&deg;C / 120&deg;C</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </>
    );
  },
});
