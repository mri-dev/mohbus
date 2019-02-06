<?php
class WeatherAppSC
{
    const SCTAG = 'weather-app';

    public function __construct()
    {
        add_action( 'init', array( &$this, 'register_shortcode' ) );
    }

    public function register_shortcode() {
        add_shortcode( self::SCTAG, array( &$this, 'do_shortcode' ) );
    }

    public function do_shortcode( $attr, $content = null )
    {
      global $wpdb;
      /* Set up the default arguments. */
      $defaults = apply_filters(
          self::SCTAG.'_defaults',
          array(
          )
      );

      $this->autoDownloadWeather();

      $weather = $wpdb->get_row("SELECT fok, kep, idopont FROM weather ORDER BY idopont DESC LIMIT 0,1;");
      $weather->kep = IFROOT.'/images/weather/' . $weather->kep.'.svg';

      /* Parse the arguments. */
      $attr = shortcode_atts( $defaults, $attr );

      setlocale(LC_TIME, get_locale());

      $pass_data['weather'] = $weather;

      $output = '<div class="'.self::SCTAG.'-holder">';
      $output .= (new ShortcodeTemplates('WeatherApp'))->load_template( $pass_data );
      $output .= '</div>';

      /* Return the output of the tooltip. */
      return apply_filters( self::SCTAG, $output );
    }

    function autoDownloadWeather()
    {
      global $wpdb;

      $lastdownload = $wpdb->get_var("SELECT idopont FROM weather ORDER BY idopont DESC LIMIT 0,1;");

      $diffsec = time() - strtotime($lastdownload);

      if ($diffsec <= 3600) {
        return false;
      }

      $apiurl = "http://api.openweathermap.org/data/2.5/weather?q=Mohács,HU&units=metric&lang=HU&APPID=f00565265c18d0a94587170f98eef4db";

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_URL, $apiurl);
      $result = curl_exec($ch);
      curl_close($ch);

      $weatherdata = json_decode($result, true);
      if ($weatherdata) {
        $wpdb->insert(
          "weather",
          array(
            "fok" => (float)$weatherdata['main']['temp'],
            "kep" => $weatherdata['weather'][0]['icon'],
            "datastr" => $result
          ),
          array("%s", "%s", "%s")
        );
      }
    }
}

new WeatherAppSC();

?>
