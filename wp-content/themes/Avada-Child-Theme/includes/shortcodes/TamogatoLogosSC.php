<?php
class TamogatoLogosSC
{
    const SCTAG = 'tamogato-logos';

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
      $hash = uniqid();

      $meta_query = array();
      $param = array(
        'post_type' => 'tamogatok',
        'posts_per_page' => -1
      );
      $datas = new WP_Query( $param );

      $pages['current'] = $current_page;
      $pages['max'] = (int)$datas->max_num_pages;
      $pages['items'] = (int)$datas->found_posts;

      $attr['datas'] = $datas;
      $attr['pages'] = $pages;

      $pass_data = $attr;

      $output = '<div class="'.self::SCTAG.'-holder tamogatoslide" id="tamog'.$hash.'">';
      $output .= (new ShortcodeTemplates('TamogatoLogos'))->load_template( $pass_data );
      $output .= '</div>';
      $output .= '<script>
      (function($){
        $(function(){
          $(".tamogatoslide#tamog'.$hash.'").slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            arrows: false
          });
        });
      })(jQuery);
      </script>';

      /* Return the output of the tooltip. */
      return apply_filters( self::SCTAG, $output );
    }

}

new TamogatoLogosSC();

?>
