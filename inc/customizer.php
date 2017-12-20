<?php
/**
 * marinara_blog Theme Customizer.
 *
 * @package Marinara_Blog
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function marinara_blog_customize_preview_js() {
  wp_enqueue_script( 'marinara_blog_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'marinara_blog_customize_preview_js' );

/**/
/* WP Customizer API
***********************************/
function marinara_blog_register_theme_customizer( $wp_customize ) {
  // echo '<pre>';  var_dump( $wp_customize );  echo '</pre>';
  // Customize title and tagline sections and labels
  $wp_customize->get_section('title_tagline')->title = __('Site: Name and Description', 'marinara-blog');  
  $wp_customize->get_control('blogname')->label = __('Site Name', 'marinara-blog');  
  $wp_customize->get_control('blogdescription')->label = __('Site Description', 'marinara-blog');  
  $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
  $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
  // Customize the Front Page Settings
  $wp_customize->get_section('static_front_page')->title = __('Site: Front Page', 'marinara-blog');
  $wp_customize->get_section('static_front_page')->priority = 20;
  $wp_customize->get_control('show_on_front')->label = __('Choose Front Page', 'marinara-blog');  
  $wp_customize->get_control('page_on_front')->label = __('Select Front Page', 'marinara-blog');  
  $wp_customize->get_control('page_for_posts')->label = __('Select Blog Page', 'marinara-blog'); 
  // Customize Background Settings
  $wp_customize->get_section('background_image')->title = __('Site: Background Styles', 'marinara-blog');  
  $wp_customize->get_control('background_color')->section = 'background_image';
  // Customize Header Image Settings
  $wp_customize->add_section( 'header_text_styles' , array(
    'title'      => __('Header: Text Colors','marinara-blog'), 
    'priority'   => 50    
  ) );
  $wp_customize->remove_control('display_header_text');
  // $wp_customize->get_control('display_header_text')->section = 'header_text_styles';
  // $wp_customize->get_control('display_header_text')->label = __('Display Header Description', 'marinara_blog'); 
  $wp_customize->get_control('header_textcolor')->section = 'header_text_styles'; 
  $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage'; 
  // Add Page Template: Home Settings
  /* General Settings */
  /* General Settings > Google Analytics Textfield */
  $wp_customize->add_section( 'goo_analytics_field' , array(
  'title'      => __('Site: Google Analytics','marinara-blog'), 
  'panel'      => 'general_settings',
  'priority'   => 40    
  ) );  
  $wp_customize->add_setting(
    'google_analytics_code',
    array(          
        'sanitize_callback' => 'sanitize_text_field'      
    )
  );
  $wp_customize->add_control(
      new WP_Customize_Control(
          $wp_customize,
          'goo_analytics',
          array(
              'label'          => __( 'Add Google Analytics Code here. Remove the &#60;script>&#60;/script> tags', 'marinara-blog' ),
              'section'        => 'goo_analytics_field',
              'settings'       => 'google_analytics_code',
              'type'           => 'textarea'
          )
      )
  );
  $wp_customize->add_section( 'header_settings' , array(
    'title'      => __('Header: Settings','marinara-blog'), 
    'panel'      => 'general_settings',
    'priority'   => 60    
  ) );
    $wp_customize->add_setting(
        'enable_user_col',
        array(
            'type'       => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'header_enable_user_col',
        array(
            'settings' => 'enable_user_col',
            'label'    => __('Enable Header User Column. This displays a header column with current user actions.', 'marinara-blog' ),
            'section'  => 'header_settings',
            'type'     => 'checkbox',
        )
    );
  $wp_customize->add_section( 'blog_settings' , array(
    'title'      => __('Blog: Settings','marinara-blog'), 
    'panel'      => 'general_settings',
    'priority'   => 70    
  ) );
    $wp_customize->add_setting(
        'show_by_author_on_blog_listing',
        array(
            'type'       => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'blog_show_by_author_on_blog_listing',
        array(
            'settings' => 'show_by_author_on_blog_listing',
            'label'    => __( 'Show by Author on Blog Listings.', 'marinara-blog' ),
            'section'  => 'blog_settings',
            'type'     => 'checkbox',
        )
    );
  $wp_customize->add_section( 'page_temp_home_settings' , array(
    'title'      => __('Page Template: Home Settings','marinara-blog'), 
    'panel'      => 'general_settings',
    'priority'   => 80    
  ) );
    $wp_customize->add_setting(
        'enable_author_tab',
        array(
            'type'       => 'theme_mod',
        'sanitize_callback' => 'sanitize_text_field'
        )
    );
    $wp_customize->add_control(
        'page_temp_home_enable_author_tab',
        array(
            'settings' => 'enable_author_tab',
            'label'    => __( 'Enable Author Tab. This displays a tag that outputs the users with the role: author.', 'marinara-blog' ),
            'section'  => 'page_temp_home_settings',
            'type'     => 'checkbox',
        )
    );
  /* General Settings > Add Contact Info Settings */
  $wp_customize->add_section( 'contact_social_info' , array(
  'title'      => __('Footer: Contact & Social Info','marinara-blog'), 
  'panel'      => 'general_settings',
  'priority'   => 100    
  ) );  
  $wp_customize->add_setting(
    'marinara_blog_phone_num',
    array(
        'default'           => '',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'      
    )
  );
  $wp_customize->add_control(
      new WP_Customize_Control(
          $wp_customize,
          'phone_info',
          array(
              'label'          => __( 'Phone Number (ex: 1-949-555-5555)', 'marinara-blog' ),
              'section'        => 'contact_social_info',
              'settings'       => 'marinara_blog_phone_num',
              'type'           => 'text'
          )
      )
  );
  $wp_customize->add_setting(
    'marinara_blog_email',
    array(
        'default'           => '',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'        
    )
  );
  $wp_customize->add_control(
      new WP_Customize_Control(
          $wp_customize,
          'email_info',
          array(
              'label'          => __( 'Email', 'marinara-blog' ),
              'section'        => 'contact_social_info',
              'settings'       => 'marinara_blog_email',
              'type'           => 'text'
          )
      )
  );
  $wp_customize->add_setting(
    'marinara_blog_twitter',
    array(
        'default'           => '',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'      
    )
  );
  $wp_customize->add_control(
      new WP_Customize_Control(
          $wp_customize,
          'twitter_info',
          array(
              'label'          => __( 'Twitter URL', 'marinara-blog' ),
              'section'        => 'contact_social_info',
              'settings'       => 'marinara_blog_twitter',
              'type'           => 'text'
          )
      )
  );
  $wp_customize->add_setting(
    'marinara_blog_facebook',
    array(
        'default'           => '',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'       
    )
  );
  $wp_customize->add_control(
      new WP_Customize_Control(
          $wp_customize,
          'facebook_info',
          array(
              'label'          => __( 'Facebook URL', 'marinara-blog' ),
              'section'        => 'contact_social_info',
              'settings'       => 'marinara_blog_facebook',
              'type'           => 'text'
          )
      )
  );
  $wp_customize->add_setting(
    'marinara_blog_instagram',
    array(
        'default'           => '',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'      
    )
  );
  $wp_customize->add_control(
      new WP_Customize_Control(
          $wp_customize,
          'instagram_info',
          array(
              'label'          => __( 'Instagram URL', 'marinara-blog' ),
              'section'        => 'contact_social_info',
              'settings'       => 'marinara_blog_instagram',
              'type'           => 'text'
          )
      )
  );
  $wp_customize->add_setting(
    'marinara_blog_google_plus',
    array(
        'default'           => '',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'       
    )
  );
  $wp_customize->add_control(
      new WP_Customize_Control(
          $wp_customize,
          'google_plus_info',
          array(
              'label'          => __( 'Google Plus URL', 'marinara-blog' ),
              'section'        => 'contact_social_info',
              'settings'       => 'marinara_blog_google_plus',
              'type'           => 'text'
          )
      )
  );
  $wp_customize->add_setting(
    'marinara_blog_linkedin',
    array(
        'default'           => '',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'        
    )
  );
  $wp_customize->add_control(
      new WP_Customize_Control(
          $wp_customize,
          'linkedin_info',
          array(
              'label'          => __( 'Linkedin URL', 'marinara-blog' ),
              'section'        => 'contact_social_info',
              'settings'       => 'marinara_blog_linkedin',
              'type'           => 'text'
          )
      )
  );
  $wp_customize->add_setting(
    'marinara_blog_pinterest',
    array(
        'default'           => '',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'      
    )
  );
  $wp_customize->add_control(
      new WP_Customize_Control(
          $wp_customize,
          'pinterest_info',
          array(
              'label'          => __( 'Pinterest URL', 'marinara-blog' ),
              'section'        => 'contact_social_info',
              'settings'       => 'marinara_blog_pinterest',
              'type'           => 'text'
          )
      )
  );
  $wp_customize->add_setting(
    'marinara_blog_tumblr',
    array(
        'default'           => '',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'       
    )
  );
  $wp_customize->add_control(
      new WP_Customize_Control(
          $wp_customize,
          'tumblr_info',
          array(
              'label'          => __( 'Tumblr URL', 'marinara-blog' ),
              'section'        => 'contact_social_info',
              'settings'       => 'marinara_blog_tumblr',
              'type'           => 'text'
          )
      )
  );
  $wp_customize->add_setting(
    'marinara_blog_tumblr',
    array(
        'default'           => '',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'      
    )
  );
  $wp_customize->add_control(
      new WP_Customize_Control(
          $wp_customize,
          'tumblr_info',
          array(
              'label'          => __( 'Tumblr URL', 'marinara-blog' ),
              'section'        => 'contact_social_info',
              'settings'       => 'marinara_blog_tumblr',
              'type'           => 'text'
          )
      )
  );
  $wp_customize->add_setting(
    'marinara_blog_youtube',
    array(
        'default'           => '',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'          
    )
  );
  $wp_customize->add_control(
      new WP_Customize_Control(
          $wp_customize,
          'youtube_info',
          array(
              'label'          => __( 'YouTube URL', 'marinara-blog' ),
              'section'        => 'contact_social_info',
              'settings'       => 'marinara_blog_youtube',
              'type'           => 'text'
          )
      )
  );
  $wp_customize->add_setting(
    'marinara_blog_soundcloud',
    array(
        'default'           => '',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'          
    )
  );
  $wp_customize->add_control(
      new WP_Customize_Control(
          $wp_customize,
          'soundcloud_info',
          array(
              'label'          => __( 'SoundCloud URL', 'marinara-blog' ),
              'section'        => 'contact_social_info',
              'settings'       => 'marinara_blog_soundcloud',
              'type'           => 'text'
          )
      )
  );

  /* Design Settings > Site > Text Colors */
  $wp_customize->add_section( 'text_colors' , array(
  'title'      => __('Site: Text Colors','marinara-blog'), 
  'panel'      => 'design_settings',
  'priority'   => 20    
  ) );
  $wp_customize->add_setting(
    'primary_color',
    array(
        'default'         => '#444',
        'transport'       => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control(
     new WP_Customize_Color_Control(
         $wp_customize,
         'custom_primary_color',
         array(
             'label'      => __( 'Site: Primary Text Color', 'marinara-blog' ),
             'section'    => 'text_colors',
             'settings'   => 'primary_color' 
         )
     )
  ); 
  $wp_customize->add_setting(
    'secondary_color',
    array(
        'default'         => '#f50',
        'transport'       => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control(
     new WP_Customize_Color_Control(
         $wp_customize,
         'custom_secondary_color',
         array(
             'label'      => __( 'Site: Secondary Text Color', 'marinara-blog' ),
             'section'    => 'text_colors',
             'settings'   => 'secondary_color' 
         )
     )
  ); 
  $wp_customize->add_setting(
    'highlight_color',
    array(
        'default'         => '#f50',
        'transport'       => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control(
     new WP_Customize_Color_Control(
         $wp_customize,
         'custom_highlight_color',
         array(
             'label'      => __( 'Site: Highlight Color', 'marinara-blog' ),
             'section'    => 'text_colors',
             'settings'   => 'highlight_color' 
         )
     )
  ); 
  /* Design Settings > Site > Custom CSS */
  $wp_customize->add_section( 'custom_css_field' , array(
  'title'      => __('Site: Custom CSS','marinara-blog'), 
  'panel'      => 'design_settings',
  'priority'   => 30    
  ) );  
  $wp_customize->add_setting(
    'marinara_blog_custom_css',
    array(          
        'sanitize_callback' => 'sanitize_text_field'         
    )
  );
  $wp_customize->add_control(
      new WP_Customize_Control(
          $wp_customize,
          'custom_css',
          array(
              'label'          => __( 'Add custom site-wide CSS here', 'marinara-blog' ),
              'section'        => 'custom_css_field',
              'settings'       => 'marinara_blog_custom_css',
              'type'           => 'textarea'
          )
      )
  );
  /* Design Settings > Header Text Colors */
  $wp_customize->add_setting(
    'header_highlight_clr',
    array(
        'default'         => '#444',
        'transport'       => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control(
     new WP_Customize_Color_Control(
         $wp_customize,
         'custom_header_highlight_clr',
         array(
             'label'      => __( 'Header Highlight Text Color', 'marinara-blog' ),
             'section'    => 'header_text_styles',
             'settings'   => 'header_highlight_clr' 
         )
     )
  ); 
  /* Design Settings > Page > Banner */
  $wp_customize->add_section( 'page_banner' , array(
  'title'      => __('Page: Banner','marinara-blog'), 
  'panel'      => 'design_settings',
  'priority'   => 60    
  ) );  
  $wp_customize->add_setting(
    'page_banner_cta_bg',
    array(
        'default'         => '#444',
        'transport'       => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field' 
    )
  );
  $wp_customize->add_control(
     new WP_Customize_Color_Control(
         $wp_customize,
         'custom_page_banner_cta_bg',
         array(
             'label'      => __( 'Page Banner CTA Background', 'marinara-blog' ),
             'section'    => 'page_banner',
             'settings'   => 'page_banner_cta_bg' 
         )
     )
  );   
  $wp_customize->add_setting(
    'page_banner_cta_clr',
    array(
        'default'         => '#fff',
        'transport'       => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control(
     new WP_Customize_Color_Control(
         $wp_customize,
         'custom_page_banner_cta_clr',
         array(
             'label'      => __( 'Page Banner CTA Text Color', 'marinara-blog' ),
             'section'    => 'page_banner',
             'settings'   => 'page_banner_cta_clr' 
         )
     )
  );   
  /* Design Settings > Blog > Blog Title */
  $wp_customize->add_section( 'blog_styles' , array(
  'title'      => __('Blog: Styles','marinara-blog'), 
  'panel'      => 'design_settings',
  'priority'   => 70    
  ) );
  $wp_customize->add_setting(
    'blog_title_clr',
    array(
        'default'         => '#444',
        'transport'       => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control(
     new WP_Customize_Color_Control(
         $wp_customize,
         'custom_blog_title_clr',
         array(
             'label'      => __( 'Blog Post Title Text Color', 'marinara-blog' ),
             'section'    => 'blog_styles',
             'settings'   => 'blog_title_clr' 
         )
     )
  );  
  /* Design Settings > Footer > Styles */
  $wp_customize->add_section( 'footer_styles' , array(
  'title'      => __('Footer: Styles','marinara-blog'), 
  'panel'      => 'design_settings',
  'priority'   => 80    
  ) );  
  $wp_customize->add_setting(
    'footer_image',
    array(
    'default'         => '',
        'sanitize_callback' => 'sanitize_text_field'
    // 'default'         => get_template_directory_uri() . '/img/logo.png',
    //'transport'       => 'postMessage'
    )
  );
  $wp_customize->add_control(
     new WP_Customize_Image_Control(
         $wp_customize,
         'custom_footer_image',
         array(
             'label'      => __( 'Add an image to the Footer.', 'marinara-blog' ),
             'section'    => 'footer_styles',
             'settings'   => 'footer_image',
             'context'    => 'footer-image' 
         )
     )
  );
  $wp_customize->add_setting(
    'footer_clr',
    array(
        'default'         => '#fff',
        'transport'       => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control(
     new WP_Customize_Color_Control(
         $wp_customize,
         'custom_footer_clr',
         array(
             'label'      => __( 'Footer Text Color', 'marinara-blog' ),
             'section'    => 'footer_styles',
             'settings'   => 'footer_clr' 
         )
     )
  );  
  $wp_customize->add_setting(
    'footer_highlight_clr',
    array(
        'default'         => '#fff',
        'transport'       => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
  );
  $wp_customize->add_control(
     new WP_Customize_Color_Control(
         $wp_customize,
         'custom_footer_highlight_clr',
         array(
             'label'      => __( 'Footer Highlight Text Color', 'marinara-blog' ),
             'section'    => 'footer_styles',
             'settings'   => 'footer_highlight_clr' 
         )
     )
  );  
  // Create custom panels
  $wp_customize->add_panel( 'general_settings', array(
    'priority' => 10,
    'theme_supports' => '',
    'title' => __( 'General Settings', 'marinara-blog' ),
    'description' => __( 'Controls the basic settings for the theme.', 'marinara-blog' ),
  ) );
  $wp_customize->add_panel( 'design_settings', array(
    'priority' => 20,
    'theme_supports' => '',
    'title' => __( 'Design Settings', 'marinara-blog' ),
    'description' => __( 'Controls the basic design settings for the theme.', 'marinara-blog' ),
  ) ); 
  // Assign sections to panels
  $wp_customize->get_section('title_tagline')->panel = 'general_settings';      
  $wp_customize->get_section('static_front_page')->panel = 'general_settings';
  $wp_customize->get_section('header_text_styles')->panel = 'design_settings';
  $wp_customize->get_section('background_image')->panel = 'design_settings';
  $wp_customize->get_section('background_image')->priority = 10;
  $wp_customize->get_section('header_image')->panel = 'design_settings';
  $wp_customize->get_section('header_image')->priority = 40;
  $wp_customize->get_section('header_image')->title = __('Header: Image', 'marinara-blog');  
}
function admin_customizable_theme_css(){
  ?>
  <style type="text/css">
  /* Admin Custom CSS goes here
  ========================= */
  <?php
  /**
   * @package Marinara_Blog
   */
  /* Declare PHP Variables 
  ========================= */
  /* Site */
  /* Site > Background Styles */
  $siteBgClr = get_background_color();
  if ($siteBgClr){
    $siteBgClr = '#' . $siteBgClr;
  } else {
    $siteBgClr = '#444';
  }
  $siteBg = get_background_image();
  if( ! ( $siteBg ) ) {
    $siteBg = get_site_url().'/wp-content/themes/blog/img/bg/default.jpg';    
  }
  /* Site > Text Colors */
  if (get_theme_mod('primary_color')){
    $primaryClr = get_theme_mod('primary_color');
  } else {
    $primaryClr = '#444';   
  }
  if (get_theme_mod('secondary_color')){
    $secondaryClr = get_theme_mod('secondary_color');
  } else {
    $secondaryClr = '#f50';    
  }
  /* Site > Text Colors > Highlight */
  if (get_theme_mod('highlight_color')){
    $highlightClr = get_theme_mod('highlight_color');
  } else {
    $highlightClr = '#f50';    
  }
  /* background */
  $primaryBg = '#444';
  $secondaryBg = '#f50';
  /* btns */
  $primaryBtn = '';
  $secondaryBtn = '';

  /* Header > Text Colors */
  if (get_theme_mod('header_textcolor')){
    $headerClr = '#' . get_theme_mod('header_textcolor');
  } else {
    $headerClr = '#444';    
  }
  if (get_theme_mod('header_highlight_clr')){
    $headerHighlightClr = get_theme_mod('header_highlight_clr');
  } else {
    $headerHightlightClr = '#f50';    
  }
  $headerBg = '';

  /* Page > Banner */
  if (get_theme_mod('page_banner_cta_bg')){
    $pageBannerCTABg = get_theme_mod('page_banner_cta_bg');
  } else {
    $pageBannerCTABg = '#444';    
  }
  if (get_theme_mod('page_banner_cta_clr')){
    $pageBannerCTAClr = get_theme_mod('page_banner_cta_clr');
  } else {
    $pageBannerCTAClr = '#fff';    
  }
  /* Page > Banner */
  if (get_theme_mod('blog_title_clr')){
    $blogTitleClr = get_theme_mod('blog_title_clr');
  } else {
    $blogTitleClr = '#444';    
  }

  /* Footer > Colors */
  if (get_theme_mod('footer_clr')){
    $footerClr = get_theme_mod('footer_clr');
  } else {
    $footerClr = '#444';    
  }
  if (get_theme_mod('footer_highlight_clr')){
    $footerHighlightClr = get_theme_mod('footer_highlight_clr');
  } else {
    $footerHighlightClr = '#fff';
  }

  ?>
  /* Site > Background Styles */
  #inside-page-content-wrapper {
    /*  background-color: <?php echo $siteBgClr; ?>;
    background-image: url('<?php echo $siteBg; ?>');
      background-size: cover;
      background-position: 50%;
      background-attachment: fixed;*/
  }
  #inside-page-featured-img-wrapper,
  .inside-page-container {
    background: rgba(255,255,255,.85);
  }
  /* Site > Text Colors */
  .primary-clr,
  a.primary-clr {
    color: <?php echo $primaryClr; ?>;
  }
  .primary-clr-important,
  a.primary-clr-important,
  .single-post-types-nav-tabs.nav-tabs > li > a {
    color: <?php echo $primaryClr; ?>!important;
  }
  .secondary-clr,
  a.secondary-clr,
  .contact-listing .fa-li {
    color: <?php echo $secondaryClr; ?>;
  }
  .secondary-clr-important,
  a.secondary-clr-important {
    color: <?php echo $secondaryClr; ?>!important;
  }
  /* Site > Highlight Colors */
  blockquote {
      border-left: 5px solid <?php echo $highlightClr; ?>;
  }
  .commentlist .bypostauthor { border-top: 10px solid <?php echo $highlightClr; ?>; }
  .commentlist li ul.children li.bypostauthor { border-top: 10px solid <?php echo $highlightClr; ?>; }
  #comments input[type="submit"]:hover,
  #comments input[type="submit"]:focus,
  form input[type="submit"]:hover
  form input[type="submit"]:focus {
      background: <?php echo $highlightClr; ?>;
      color: #fff;
  }
  #comments .comment-list li .reply .comment-reply-link {
      background: <?php echo $highlightClr; ?>;
      color: #fff;  
  }
  #comments .comment-list .children li .comment-body {
      border-left: 5px solid <?php echo $highlightClr; ?>;
  }
  .blog-listing-wrapper .article-wrapper {
    border-bottom: 5px solid <?php echo $highlightClr; ?> !important;    
  }
  .blog-listing-wrapper .article-title a {
    color: <?php echo $blogTitleClr; ?>;
  }
  .widget-group .panel {
      border-bottom: 5px solid <?php echo $highlightClr; ?>;
  }
  .social-shares li a {
      color: #fff;
      background: <?php echo $highlightClr; ?>;
  }
  .hvr-underline-from-center:before {
      background: <?php echo $highlightClr; ?>;
  }
  .single-post-types-nav-tabs.nav-tabs > li > a:focus,
  .single-post-types-nav-tabs.nav-tabs > li > a:hover,
  .single-post-types-nav-tabs.nav-tabs > li.active > a,
  .single-post-types-nav-tabs.nav-tabs > li.active > a:focus,
  .single-post-types-nav-tabs.nav-tabs > li.active > a:hover {
      color: <?php echo $highlightClr; ?> !important;
      border-bottom: 3px solid <?php echo $highlightClr; ?> !important;
  }
  .single-content a:link,
  .single-content a:hover,
  .single-content a:focus {
    color: <?php echo $highlightClr; ?> !important;
  }

  /* Header > Text Colors */
  #searchform input#s,
  .header-user-options-col .header-user-options-dropdown-button,
  .header-right-dropdown-menu-panel-group .panel-title {
    color: <?php echo $headerClr; ?> !important;
  }
  .header-right-dropdown-menu-panel-group .panel-collapse .menu a {
      color: <?php echo $headerClr; ?> !important;
  }
  .header-right-dropdown-menu-panel-group .panel-collapse .menu a:hover,
  .header-right-dropdown-menu-panel-group .panel-collapse .menu a:focus {
      color: <?php echo $headerHighlightClr; ?> !important;
  }
  .header-user-options-dropdown .login-btn, .header-user-options-dropdown .logout-btn {
    background: <?php echo $headerClr; ?> !important;
    border: 1px solid <?php echo $headerClr; ?> !important;
  }
  .header-row .navbar-toggle .icon-bar,
  .dropdown-right-sidebar-social-icons a.icon {
    background: <?php echo $headerClr; ?> !important;
  }
  .header-search-col #searchform button#searchsubmit,
  .header-right-dropdown-menu-panel-group .panel-title:hover a,
  .header-right-dropdown-menu-panel-group .panel-title:focus a {
    color: <?php echo $headerHighlightClr; ?> !important;
  }

  /* Page > Banner */
  .no-feat-img-inner-wrapper {
    background: <?php echo $pageBannerCTABg ?>;    
  }
  .no-feat-img-caption-title {
    color: <?php echo $pageBannerCTAClr ?>;
  }
  .feat-img-caption-title {
    background: <?php echo $pageBannerCTABg ?>;
    color: <?php echo $pageBannerCTAClr ?>;
  }

  /* Page > Pagination */
  .pagination-navigation li a,
  .pagination-navigation li a:hover,
  .pagination-navigation li.active a,
  .pagination-navigation li.disabled {
    background-color: <?php echo $blogTitleClr; ?>;
  }
  .pagination-navigation li a:hover,
  .pagination-navigation li.active a {
    background-color: <?php echo $highlightClr; ?>;
  }

  /* Footer > Text Color */
  .footer-clr,
  .footer-clr a,
  .footer-clr a:hover,
  .footer-clr a:focus {
    color: <?php echo $footerClr; ?>;
  }
  .footer-menu>li a,
  .footer-social-icons > div a {
      color: <?php echo $footerClr; ?>;
  }
  .footer-menu>li a:focus,
  .footer-menu>li a:hover,
  .footer-social-icons > div a:hover,
  .footer-social-icons > div a:focus,
  .footer-menu .dropdown-menu li a,
  .footer-menu .dropdown-menu li a:hover,
  .footer-menu .dropdown-menu li a:focus {
      color: <?php echo $footerHighlightClr; ?>;
  }
  <?php echo get_theme_mod('marinara_blog_custom_css'); ?>
  </style>
<?php
}
add_action( 'customize_register', 'marinara_blog_register_theme_customizer' );
add_action('wp_head', 'admin_customizable_theme_css');
?>