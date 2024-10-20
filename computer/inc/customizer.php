<?php
/**
 * Computer Theme Customizer
 *
 * @package Computer
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function computer_customize_register( $wp_customize ) {
	
	function computer_sanitize_checkbox( $checked ) {
		// Boolean check.
		return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}
	
	class computer_simple_notice_control extends WP_Customize_Control{
		public $type = 'info';
		public function render_content(){
			?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<p><?php echo wp_kses_post($this->description); ?></p>
			<?php
		}
	}
	
	$wp_customize->get_setting( 'blogname' )->tranport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->tranport  = 'postMessage';

	$wp_customize->selective_refresh->add_partial( 'blogname', array(
	    'selector' => 'h1.site-title',
	    'render_callback' => 'computer_customize_partial_blogname',
	) );

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
	    'selector' => 'p.site-description',
	    'render_callback' => 'computer_customize_partial_blogdescription',
	) );
	
	/***************************************
	** Color Scheme
	***************************************/
	$wp_customize->add_setting('color_scheme', array(
		'default' => '#f69323',
		'sanitize_callback'	=> 'sanitize_hex_color',
	));

	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'color_scheme',array(
			'label' => __('Color Scheme','computer'),
			'description' => __('Select color from here.','computer'),
			'section' => 'colors',
			'settings' => 'color_scheme'
		))
	);

	$wp_customize->add_setting('computer_headerbg_color', array(
		'default' => '#ffffff',
		'sanitize_callback'	=> 'sanitize_hex_color',
	));

	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'computer_headerbg_color',array(
			'label' => __('Header Background color','computer'),
			'description'	=> __('Select background color for header.','computer'),
			'section' => 'colors',
			'settings' => 'computer_headerbg_color'
		))
	);

	$wp_customize->add_setting('computer_footer_color', array(
		'default' => '#252525',
		'sanitize_callback'	=> 'sanitize_hex_color',
	));

	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'computer_footer_color',array(
			'label' => __('Footer Background Color','computer'),
			'description' => __('Select background color for footer.','computer'),
			'section' => 'colors',
			'settings' => 'computer_footer_color'
		))
	);

	/***************************************
	** Registerd Theme Setup Panel
	***************************************/
	$wp_customize->add_panel( 'computer_theme_panel',
		array(
			'title'            => __( 'Setting up Theme', 'computer' ),
			'description'      => __( 'Theme Modifications like color scheme, theme texts and layout preferences can be done here', 'computer' ),
		)
	);
	
	/***************************************
	** Top Header
	***************************************/
	$wp_customize->add_section( 'computer_head_top',
		array(
			'title' => __('Top Header', 'computer'),
			'priority' => null,
			'description' => __('Add information to top header bar here','computer'),
			'panel' => 'computer_theme_panel',
		)
	);
	
	$wp_customize->add_setting('computer_wel_txt',array(
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		'transport' => 'refresh'
	));

	$wp_customize->add_control('computer_wel_txt',array(
		'type'	=> 'text',
		'label'	=> __('Add welcome text here','computer'),
		'section'	=> 'computer_head_top'
	));
	
	$wp_customize->selective_refresh->add_partial('computer_wel_txt', array(
        'selector' => '.com-top-left p'
    ));
	
	$wp_customize->add_setting( 'computer_tphead_menu',
		array(
			'default' => '',
			'transport' => 'postMessage',
			'sanitize_callback' => 'computer_text_sanitization'
		)
	);
	$wp_customize->add_control( new computer_simple_notice_control( $wp_customize, 'computer_tphead_menu',
		array(
			'label' => __( 'Top Header Menu', 'computer' ),
			'description' => __('For setting up top header menu goto Menus setting in customizer and select Menu Locations >> Top Header Menu','computer' ),
			'section' => 'computer_head_top'
		)
	) );
	
	$wp_customize->add_setting('computer_hide_tphead',array(
		'default' => true,
		'sanitize_callback' => 'computer_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 

	$wp_customize->add_control( 'computer_hide_tphead', array(
	   'settings' => 'computer_hide_tphead',
	   'section'   => 'computer_head_top',
	   'label'     => __('Check this to hide Top Header.','computer'),
	   'type'      => 'checkbox'
	));
	
	/***************************************
	** Header Info
	***************************************/
	$wp_customize->add_section(
		'computer_head_info',
		array(
			'title' => __('Header Information', 'computer'),
			'priority' => null,
			'description'	=> __('Add header information here. <strong>Use font-awesome version 4.7</strong>','computer'),
			'panel' => 'computer_theme_panel',
		)
	);
	
	$wp_customize->add_setting('computer_head_icn1',array(
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		'transport' => 'refresh'
	));
	
	$wp_customize->add_control('computer_head_icn1',array(
		'type'	=> 'text',
		'label'	=> __('Add font Awesome icon name here for first box','computer'),
		'section'	=> 'computer_head_info'
	));
	
	$wp_customize->add_setting('computer_head_sub1',array(
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		'transport' => 'refresh'
	));
	
	$wp_customize->add_control('computer_head_sub1',array(
		'type'	=> 'text',
		'label'	=> __('Add sub heading / text here for first box','computer'),
		'section'	=> 'computer_head_info'
	));
	
	$wp_customize->add_setting('computer_head_main1',array(
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		'transport' => 'refresh'
	));
	
	$wp_customize->add_control('computer_head_main1',array(
		'type'	=> 'text',
		'label'	=> __('Add heading / text here for first box','computer'),
		'section'	=> 'computer_head_info'
	));
	
	$wp_customize->add_setting('computer_head_icn2',array(
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		'transport' => 'refresh'
	));
	
	$wp_customize->add_control('computer_head_icn2',array(
		'type'	=> 'text',
		'label'	=> __('Add font Awesome icon name here for second box','computer'),
		'section'	=> 'computer_head_info'
	));
	
	$wp_customize->add_setting('computer_head_sub2',array(
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		'transport' => 'refresh'
	));
	
	$wp_customize->add_control('computer_head_sub2',array(
		'type'	=> 'text',
		'label'	=> __('Add sub heading / text here for second box','computer'),
		'section'	=> 'computer_head_info'
	));
	
	$wp_customize->add_setting('computer_head_main2',array(
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		'transport' => 'refresh'
	));
	
	$wp_customize->add_control('computer_head_main2',array(
		'type'	=> 'text',
		'label'	=> __('Add heading / text here for second box','computer'),
		'section'	=> 'computer_head_info'
	));
	
	$wp_customize->selective_refresh->add_partial('computer_head_icn1', array(
        'selector' => '.header-info'
    ));
	
	$wp_customize->add_setting('computer_hide_headinfo',array(
		'default' => true,
		'sanitize_callback' => 'computer_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));	 

	$wp_customize->add_control( 'computer_hide_headinfo', array(
	   'settings' => 'computer_hide_headinfo',
	   'section'   => 'computer_head_info',
	   'label'     => __('Check this to hide Header information.','computer'),
	   'type'      => 'checkbox'
	));
	
	/***************************************
	** Header Button
	***************************************/
	$wp_customize->add_section(
		'computer_cta_btn',
		array(
			'title' => __('CTA Button', 'computer'),
			'priority' => null,
			'description'	=> __('Add text and link for header cta button','computer'),
			'panel' => 'computer_theme_panel',
		)
	);

	$wp_customize->add_setting('computer_cta_lbl',array(
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
		'transport' => 'refresh'
	));

	$wp_customize->add_control('computer_cta_lbl',array(
		'type'	=> 'text',
		'label'	=> __('Add header cta button text here','computer'),
		'section'	=> 'computer_cta_btn'
	));

	$wp_customize->add_setting('computer_cta_link',array(
		'sanitize_callback'	=> 'esc_url_raw'
	));

	$wp_customize->add_control('computer_cta_link',array(
		'type'	=> 'url',
		'label'	=> __('Add header cta button link here.','computer'),
		'section'	=> 'computer_cta_btn'
	));
	$wp_customize->selective_refresh->add_partial('computer_cta_lbl', array(
        'selector' => '.header-btn a'
    ));
	
	/***************************************
	** Slider Section
	***************************************/
	$wp_customize->add_section(
		'computer_theme_slider',
		array(
			'title' => __('Theme Slider', 'computer'),
			'priority' => null,
			'description'	=> __('Recommended image size (1600x900). Slider will work only when you select the static front page.','computer'),
			'panel' => 'computer_theme_panel',
		)
	);

	$wp_customize->add_setting('slide1',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));

	$wp_customize->add_control('slide1',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide one:','computer'),
			'section'	=> 'computer_theme_slider'
	));

	$wp_customize->add_setting('slide2',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));

	$wp_customize->add_control('slide2',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide two:','computer'),
			'section'	=> 'computer_theme_slider'
	));

	$wp_customize->add_setting('slide3',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));

	$wp_customize->add_control('slide3',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for slide three:','computer'),
			'section'	=> 'computer_theme_slider'
	));

	$wp_customize->add_setting('slide_more',array(
		'default'	=> __('Read More','computer'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('slide_more',array(
		'label'	=> __('Add slider link button text.','computer'),
		'section'	=> 'computer_theme_slider',
		'setting'	=> 'slide_more',
		'type'	=> 'text'
	));

	$wp_customize->add_setting('computer_hide_slider',array(
		'default' => true,
		'sanitize_callback' => 'computer_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	)); 

	$wp_customize->add_control( 'computer_hide_slider', array(
	   'settings' => 'computer_hide_slider',
	   'section'   => 'computer_theme_slider',
	   'label'     => __('Check this to hide slider.','computer'),
	   'type'      => 'checkbox'
	));
	
	/***************************************
	** First Section
	***************************************/
	$wp_customize->add_section(
		'computer_first_sec',
		array(
			'title' => __('First Section', 'computer'),
			'priority' => null,
			'description'	=> __('Select pages for homepage fisrt section. This section will be displayed only when you select the static front page.','computer'),
			'panel' => 'computer_theme_panel',
		)
	);

	$wp_customize->add_setting('computer_fsec_ttl',array(
		'sanitize_callback'	=> 'sanitize_text_field',
		'transport' => 'refresh'
	));
	
	$wp_customize->add_control('computer_fsec_ttl',array(
		'type'	=> 'text',
		'label'	=> __('Add Section Title Here','computer'),
		'section'	=> 'computer_first_sec'
	));
	
	$wp_customize->selective_refresh->add_partial('computer_fsec_ttl', array(
        'selector' => '.welcome-section h2.section_title'
    ));
	
	$wp_customize->add_setting('fsec1',array(
		'default' => '0',
		'capability' => 'edit_theme_options',
		'sanitize_callback'	=> 'absint'
	));

	$wp_customize->add_control('fsec1',array(
		'type'	=> 'dropdown-pages',
		'label'	=> __('Select page for first column','computer'),
		'section'	=> 'computer_first_sec'
	));

	$wp_customize->add_setting('fsec2',array(
		'default' => '0',
		'capability' => 'edit_theme_options',
		'sanitize_callback'	=> 'absint'
	));

	$wp_customize->add_control('fsec2',array(
		'type'	=> 'dropdown-pages',
		'label'	=> __('Select page for second column','computer'),
		'section'	=> 'computer_first_sec'
	));

	$wp_customize->add_setting('fsec3',array(
		'default' => '0',
		'capability' => 'edit_theme_options',
		'sanitize_callback'	=> 'absint'
	));

	$wp_customize->add_control('fsec3',array(
		'type'	=> 'dropdown-pages',
		'label'	=> __('Select page for third column','computer'),
		'section'	=> 'computer_first_sec'
	));
	
	$wp_customize->add_setting('fsec_more',array(
		'default'	=> __('Read More','computer'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('fsec_more',array(
		'label'	=> __('Add read more button text.','computer'),
		'section'	=> 'computer_first_sec',
		'setting'	=> 'fsec_more',
		'type'	=> 'text'
	));
	
	$wp_customize->add_setting('computer_hide_fsec',array(
		'default' => true,
		'sanitize_callback' => 'computer_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'computer_hide_fsec', array(
	   'settings' => 'computer_hide_fsec',
	   'section'   => 'computer_first_sec',
	   'label'     => __('Check this to hide first section.','computer'),
	   'type'      => 'checkbox'
	));
	
	/***************************************
	** Second Section
	***************************************/
	$wp_customize->add_section(
		'computer_intro_sec',
		array(
			'title' => __('Second Section', 'computer'),
			'priority' => null,
			'description'	=> __('Select page for homepage second section. This section will be displayed only when you select the static front page.','computer'),
			'panel' => 'computer_theme_panel',
		)
	);
	
	$wp_customize->add_setting('computer_intro',array(
		'default' => '0',
		'capability' => 'edit_theme_options',
		'sanitize_callback'	=> 'absint',
		'transport' => 'refresh'
	));

	$wp_customize->add_control('computer_intro',array(
		'type'	=> 'dropdown-pages',
		'label'	=> __('Select page for display second section','computer'),
		'section'	=> 'computer_intro_sec'
	));
	
	$wp_customize->selective_refresh->add_partial('computer_intro', array(
        'selector' => '.intro-content'
    ));
	
	$wp_customize->add_setting('intro_more',array(
		'default'	=> __('Read More','computer'),
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('intro_more',array(
		'label'	=> __('Add read more button text.','computer'),
		'section'	=> 'computer_intro_sec',
		'setting'	=> 'intro_more',
		'type'	=> 'text'
	));
	
	$wp_customize->add_setting('computer_hide_intro',array(
		'default' => true,
		'sanitize_callback' => 'computer_sanitize_checkbox',
		'capability' => 'edit_theme_options',
	));

	$wp_customize->add_control( 'computer_hide_intro', array(
	   'settings' => 'computer_hide_intro',
	   'section'   => 'computer_intro_sec',
	   'label'     => __('Check this to hide second section.','computer'),
	   'type'      => 'checkbox'
	));
}
add_action( 'customize_register', 'computer_customize_register' );

function computer_css_func(){ ?>
<style>
	a,
	.tm_client strong,
	.postmeta a:hover,
	#sidebar ul li a:hover,
	.blog-post h3.entry-title,
	a.blog-more:hover,
	#commentform input#submit,
	input.search-submit,
	.blog-date .date{
		color:<?php echo esc_attr(get_theme_mod('color_scheme','#f69323'));?>;
	}
	h3.widget-title,
	.nav-links .current,
	.nav-links a:hover,
	p.form-submit input[type="submit"],
	.header-btn a,
	.sitenav ul li.current_page_item a,
	.sitenav ul li a:hover, 
	.sitenav ul li.current_page_item ul li a:hover,
	.com-slider .inner-caption .sliderbtn,
	.read-more,
	.nivo-controlNav a{
		background-color:<?php echo esc_attr(get_theme_mod('color_scheme','#f69323'));?>;
	}
	#header{
		background-color:<?php echo esc_attr(get_theme_mod('computer_headerbg_color','#ffffff'));?>;
	}
	.copyright-wrapper{
		background-color:<?php echo esc_attr(get_theme_mod('computer_footer_color','#252525'));?>;
	}
</style>
<?php }
add_action('wp_head','computer_css_func');

function computer_customize_preview_js() {
	wp_enqueue_script( 'computer-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20141216', true );
}
add_action( 'customize_preview_init', 'computer_customize_preview_js' );