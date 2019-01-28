<?php
class BlogListSC
{
  const SCTAG = 'bloglist';

  public function __construct()
  {
    add_action( 'init', array( &$this, 'register_shortcode' ) );
  }

  public function register_shortcode() {
    add_shortcode( self::SCTAG, array( &$this, 'do_shortcode' ) );
  }

  public function do_shortcode( $attr, $content = null )
  {
    /* Set up the default arguments. */
    $defaults = apply_filters(
      self::SCTAG.'_defaults',
      array(
        'type' => 'post',
        'view' => 'post',
        'limit' => 3,
        'title' => '',
        'more-text' => 'További cikkek',
        'more-link' => '/hirek',
        'pagination' => 0,
        'slide' => 0
      )
    );

    $current_page = 1;
    $current_page = (!empty($_GET['page'])) ? (int)$_GET['page'] : $current_page;

    $pages = array(
      'current' => 1,
      'max' => 1,
      'items' => 0
    );

    /* Parse the arguments. */
    $attr = shortcode_atts( $defaults, $attr );

    $meta_query = array();
    $param = array(
      'post_type' => $attr['type'],
      'posts_per_page' => $attr['limit'],
      'paged' => $current_page
    );

    $param['meta_query'] = $meta_query;

    $datas = new WP_Query( $param );

    $pages['current'] = $current_page;
    $pages['max'] = (int)$datas->max_num_pages;
    $pages['items'] = (int)$datas->found_posts;

    $attr['datas'] = $datas;
    $attr['pages'] = $pages;

    $pass_data = $attr;

    $hash = uniqid();
    $output = '<div  class="'.self::SCTAG.'-holder-header">
      <div class="wrapper">
        <div class="title">'.$attr['title'].'</div>
        <div class="goto"><a href="'.$attr['more-link'].'"><i class="fa fa-bars"></i> '.$attr['more-text'].'</a></div>
      </div>
    </div>';
    $output .= '<div class="'.self::SCTAG.'-holder view-of-'.$attr['view'].''. ( ($attr['slide'] == '1') ? ' is-slider': '' ) .'" id="bloglist'.$hash.'">';
    $output .= (new ShortcodeTemplates('Bloglist-'.$attr['view']))->load_template( $pass_data );

    // Lapozás
    if ( $pages['items'] > 0 && $attr['pagination'] == 1 ) {
      $output .= $this->pagination( $pages );
    }
    $output .= '</div>';

    if ($attr['slide'] == '1') {
      if ($attr['type'] == 'videok') {
        $output .= '<script>
        (function($){
          $(function(){
            $(".is-slider#bloglist'.$hash.'").slick({
              infinite: true,
              slidesToShow: 1,
              slidesToScroll: 1,
              autoplay: false
            });
          });
        })(jQuery);
        </script>';
      } else {
        $output .= '<script>
        (function($){
          $(function(){
            $(".is-slider#bloglist'.$hash.'").slick({
              infinite: true,
              slidesToShow: 3,
              slidesToScroll: 1,
              autoplay: true
            });
          });
        })(jQuery);
        </script>';
      }
    }

    /* Return the output of the tooltip. */
    return apply_filters( self::SCTAG, $output );
  }

  public function pagination( $pages )
  {
    $href = '/programok/';
    $param = array();
    unset($_GET['page']);
    $param = $_GET;
    $qry = build_query($param);
    if ( $qry == '') {
      $href .= '?';
    } else {
      $href .= '?'.$qry.'&';
    }

    $t = '<div class="pagination">';
      $t .= '<ul>';
      for( $p = 1; $p <= $pages[max]; $p++ ){
        $t .= '<li class="'. ( ($p == $pages[current])?'active':'' ) .'"><a href="'.$href.'page='.$p.'">'.$p.'</a></li>';
      }
      $t .= '</ul>';
    $t .= '</div>';

    return $t;
  }
}

new BlogListSC();

?>
