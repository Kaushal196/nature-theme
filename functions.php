<?php  

function nature_load_scripts(){

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() .  '/css/bootstrap.min.css', array(), '3.3.7', 'all' );
	wp_enqueue_style( 'nature', get_template_directory_uri() .  '/css/nature.css', array(), '1.0.0', 'all' );
	wp_enqueue_style( 'raleway', 'https://fonts.googleapis.com/css?family=Raleway' );

	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js', false, '3.3.1', true );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.7', true );
}
add_action( 'wp_enqueue_scripts', 'nature_load_scripts' );

function nature_theme_setup(){
	add_theme_support( 'menus' );
	register_nav_menu( 'primary', 'Header Navigation Menu' );
	register_nav_menu( 'secondary', 'Footer Navigation' );
}
add_action('init','nature_theme_setup');

add_theme_support( 'custom-background' );
add_theme_support( 'custom-header' );
add_theme_support( 'post-thumbnails' );

add_theme_support('post-formats',array('aside','image','video'));

/*-----------blog loop custom function -----------*/
function nature_posted_meta(){
  $posted_on = human_time_diff( get_the_time('U'), current_time('timestamp') );
  $categories = get_the_category();
  $separator = ',  ';
  $output = '';
  $i=1;
  if( !empty($categories) ):
  	foreach ( $categories as $category ):
  		if($i>1): $output  .= $separator; endif;
  		$output .=  '<a href="' .esc_url(get_category_link( $category->term_id ) ).'" alt="'.esc_attr('View all posts in %s',  $category->name).'">'. esc_html($category->name).'</a>';
  		$i++;
    endforeach;
  endif;		

  return '<span class="posted-on">Posted <a href="'.esc_url(get_permalink() ).'">' .$posted_on. '</a> ago</span> / <span class="posted-in">' . $output. '</span>';
}

function nature_posted_footer(){
  $comments_num = get_comments_number();
  if(  comments_open() ){
  	if(  $comments_num == 0){
  		$comments = __('No Comments');
  	} elseif ($comments_num > 1){
  		$comments_num . __(' Comments');
  	} else{
  		$comments = __('1 Comment');
  	}
  	$comments = '<a class="comments-link" href="' . get_comments_link() .'">'. $comments .'<span class="glyphicon glyphicon-comment"></span></a>';
  } else{
  	$comments = __('Comments are closed');
  }	
  return '<div class="post-footer-container"><div class="row"><div class="col-xs-12 col-sm-6">'.get_the_tag_list('<div class="tags-list"><span class="glyphicon glyphicon-tag nature-icon nature-tag"></span>', ' ', '</div>').'</div><div class="col-xs-12 col-sm-6 text-right">'.$comments.'</div></div></div>';
}

function nature_get_attachment(){
  
  $output = '';
  if( has_post_thumbnail() ): 
    $output = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
  else:
    $attachments = get_posts( array( 
      'post_type' => 'attachment',
      'posts_per_page' => 1,
      'post_parent' => get_the_ID()
    ) );
    if( $attachments ):
      foreach ( $attachments as $attachment ):
        $output = wp_get_attachment_url( $attachment->ID );
      endforeach;
    endif;
    
    wp_reset_postdata();
    
  endif;
  
  return $output;
}
/*--------------------walker----------------------*/
require get_template_directory() . '/inc/walker.php';                     