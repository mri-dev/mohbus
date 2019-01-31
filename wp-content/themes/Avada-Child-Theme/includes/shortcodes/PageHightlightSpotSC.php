<?php
class PageHightlightSpotSC
{
    const SCTAG = 'page-hightlight-spot';

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

      /* Parse the arguments. */
      $attr = shortcode_atts( $defaults, $attr );

      $hid = (int)get_option('highlight_page_id', '');

      if ($hid) {
        $hpage = get_page($hid);
        $pass_data['post'] = $hpage;

        $output = '<div class="'.self::SCTAG.'-holder">';
        $output .= (new ShortcodeTemplates('PageHightlightSpot'))->load_template( $pass_data );
        $output .= '</div>';
      }
      
      /* Return the output of the tooltip. */
      return apply_filters( self::SCTAG, $output );
    }

}

new PageHightlightSpotSC();

?>
