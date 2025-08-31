<?php

function get_breadcrumb() {
    echo '<a href="'.home_url().'" rel="nofollow">Home</a>';
    if (is_single()) {
        if(is_product())
        {
            echo ' &nbsp;&nbsp;&#187;&nbsp;&nbsp; <a href="'.get_site_url().'/shop/">Product</a> &nbsp;&nbsp;&#187;&nbsp;&nbsp; ';
        }
        else 
        {
            echo ' &nbsp;&nbsp;&#187;&nbsp;&nbsp; <a href="'.get_post_type_archive_link( 'post' ).'">Blog</a> &nbsp;&nbsp;&#187;&nbsp;&nbsp; ';
        }
        
                the_title();
    } elseif (is_category()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        echo the_category(' &bull; ');
    } elseif (is_page()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;";
        echo the_title();
    } elseif (is_search()) {
        echo "&nbsp;&nbsp;&#187;&nbsp;&nbsp;Search Results for... ";
        echo '"<em>';
        echo the_search_query();
        echo '</em>"';
    }
}

function register_my_menu() {
  register_nav_menu('header-menu',__( 'Header Menu' ));
    register_nav_menu('footer-menu',__( 'Footer Menu' ));
}
add_action( 'init', 'register_my_menu' );

function load_sidebar()
{        register_sidebar(
        array(
            'name' => 'sidebar',
            'id' => 'sidebar',
            'description' => 'Sidebar',
            'before_widget' => '<div class="sidebar sidebar__right">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="sidebar__title">',
            'after_title' => '</h3>',
        )
    );
    
    
    register_sidebar(
        array(
            'name' => 'Footer1',
            'id' => 'FooterWidget1',
            'description' => 'Footer Column 1',
            'before_widget' => '<div class="FooterWidget">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        )
    );
    
    register_sidebar(
        array(
            'name' => 'Footer2',
            'id' => 'FooterWidget2',
            'description' => 'Footer Column 2',
            'before_widget' => '<div class="FooterWidget">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        )
    );
    
    register_sidebar(
        array(
            'name' => 'Footer3',
            'id' => 'FooterWidget3',
            'description' => 'Footer Column 3',
            'before_widget' => '<div class="FooterWidget">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        )
    );
    
}

add_action('widgets_init','load_sidebar');

add_theme_support('post-thumbnails');

add_theme_support( 'custom-logo' );

add_theme_support('woocommerce');

// function my_theme_woocommerce_support()
// {
//     add_theme_support('woocommerce');
    
// }
// add_action('after_setup_theme', 'my_theme_woocommerce_support');

add_shortcode ('woo_cart_but', 'woo_cart_but' );

function woo_cart_but()
{
    ob_start();
    $cart_count = WC()->cart->cart_contents_count;
    $cart_url = wc_get_cart_url();
?>
        <a class="menu-item cart-contents" href="<?php echo $cart_url; ?>" title="My Basket"><i class="fa fa-shopping-cart"></i>
<?php if ($cart_coun> 0){ ?>
    <span class="cart-contents-count"><?php echo $cart_count; ?> Items</span>
<?php } ?>
    </a>
<?php 
return ob_get_clean();
}

add_filter( 'woocommerce_add_to_cart_fragments', 'woo_cart_but_count' );
function woo_cart_but_count($fragments)
{
    ob_start();
    $cart_count = WC()->cart->cart_contents_count;
    $cart_url = wc_get_cart_url();
    
?>
    <a class="menu-item cart-contents" href="<?php echo $cart_url; ?>" title="<?php _e( 'View your shopping cart' ); ?>"><i class="fa fa-shopping-cart"></i>
<?php
    if($cart_count > 0)
    {
?>
        <span class="cart-contents-count"><?php echo $cart_count; ?> Items</span>
<?php            
    }
?>
    </a>
<?php
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
}



function myshoptheme_customizer($wp_customize)
{
    $wp_customize->add_section('social_details',
        array(
            'title' =>  __( 'Social Links' ),
            'priority'  =>  40,
        )
    );
    
    $wp_customize->add_setting('Facebook',
        array(
            'default' => '',
            'transport' => 'refresh'
        )
    );
    
    $wp_customize->add_control('Facebook_Control',
        array(
            'label' => __('Facebook'),
            'section' => 'social_details',
            'settings'    => 'Facebook',
            'priority' => 10,
            'type' => 'text',
            'capability' => 'edit_theme_options',
            'input_attrs' => array(
                'class' => 'my-custom-class',
                'style' => 'border: 1px solid rebeccapurple',
                'placeholder' => __( 'Enter Social Link' ),
            ),
        )
    );
    
    $wp_customize->add_setting('Twitter',
        array(
            'default' => '',
            'transport' => 'refresh'
        )
    );
    
    $wp_customize->add_control('Twitter_Control',
        array(
            'label' => __('Twitter'),
            'section' => 'social_details',
            'settings'    => 'Twitter',
            'priority' => 10,
            'type' => 'text',
            'capability' => 'edit_theme_options',
            'input_attrs' => array(
                'class' => 'my-custom-class',
                'style' => 'border: 1px solid rebeccapurple',
                'placeholder' => __( 'Enter Social Link' ),
            ),
        )
    );
    
    $wp_customize->add_setting('LinkedIn',
        array(
            'default' => '',
            'transport' => 'refresh'
        )
    );
    
    $wp_customize->add_control('LinkedIn_Control',
        array(
            'label' => __('LinkedIn'),
            'section' => 'social_details',
            'settings'    => 'LinkedIn',
            'priority' => 10,
            'type' => 'text',
            'capability' => 'edit_theme_options',
            'input_attrs' => array(
                'class' => 'my-custom-class',
                'style' => 'border: 1px solid rebeccapurple',
                'placeholder' => __( 'Enter Social Link' ),
            ),
        )
    );
    
    $wp_customize->add_setting('Instagram',
        array(
            'default' => '',
            'transport' => 'refresh'
        )
    );
    
    $wp_customize->add_control('Instagram_Control',
        array(
            'label' => __('Instagram'),
            'section' => 'social_details',
            'settings'    => 'Instagram',
            'priority' => 10,
            'type' => 'text',
            'capability' => 'edit_theme_options',
            'input_attrs' => array(
                'class' => 'my-custom-class',
                'style' => 'border: 1px solid rebeccapurple',
                'placeholder' => __( 'Enter Social Link' ),
            ),
        )
    );
    
    
    $wp_customize->add_section('contact_details',
        array(
            'title' =>  __( 'Contact Details' ),
            'priority'  =>  40,
        )
    );
    
    $wp_customize->add_setting('Address',
        array(
            'default' => '',
            'transport' => 'refresh'
        )
    );
    
    $wp_customize->add_control('Address_Control',
        array(
            'label' => __('Address'),
            'section' => 'contact_details',
            'settings'    => 'Address',
            'priority' => 10,
            'type' => 'text',
            'capability' => 'edit_theme_options',
            'input_attrs' => array(
                'class' => 'my-custom-class',
                'style' => 'border: 1px solid rebeccapurple',
                'placeholder' => __( 'Enter Address' ),
            ),
        )
    );
    
    $wp_customize->add_setting('Phone_Support',
        array(
            'default' => '',
            'transport' => 'refresh'
        )
    );
    
    $wp_customize->add_control('Sales_Support_Control',
        array(
            'label' => __('Phone Support'),
            'section' => 'contact_details',
            'settings'    => 'Phone_Support',
            'priority' => 10,
            'type' => 'text',
            'capability' => 'edit_theme_options',
            'input_attrs' => array(
                'class' => 'my-custom-class',
                'style' => 'border: 1px solid rebeccapurple',
                'placeholder' => __( 'Phone Support Details' ),
            ),
        )
    );
    
    $wp_customize->add_setting('Email_Support',
        array(
            'default' => '',
            'transport' => 'refresh'
        )
    );
    
    $wp_customize->add_control('Email_Support_Control',
        array(
            'label' => __('Email Support'),
            'section' => 'contact_details',
            'settings'    => 'Email_Support',
            'priority' => 10,
            'type' => 'text',
            'capability' => 'edit_theme_options',
            'input_attrs' => array(
                'class' => 'my-custom-class',
                'style' => 'border: 1px solid rebeccapurple',
                'placeholder' => __( 'Email Support Details' ),
            ),
        )
    );
}
add_action('customize_register','myshoptheme_customizer');

/* contact form 7 selection box images */
function Typeofvehicle(){
    ob_start();
?>
<div id="imageContainer">
        <?php
            
            $defaultImage = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/luxury-sedans.jpg";
            echo "<img src='" . $defaultImage . "' alt='Default Image'>";
        ?>
    </div>

    <script>
        jQuery(document).ready(function() {
            jQuery("#type-of-vehicle").change(function() {
                var selectedValue = jQuery(this).val();
                displayImage(selectedValue);
            });

            function displayImage(selectedValue) {
                var imageUrl;
                switch (selectedValue) {
                    case 'Luxury Sedan':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/luxury-sedans.jpg";
                        break;
                    case 'Mercedes S Class Sedan':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/Mercedes S Class.png";
                        break;
                    case 'Mercedes Sprinter Van 2024':
                        imageUrl = "https://www.bestlimousines.com/wp-content/uploads/2024/02/sprinter-van-2024.jpeg";
                        break;    
                    case 'Luxury Suburban':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/luxury-suburban.png";
                        break; 
                    case 'Luxury Escalade':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/escalade-limousine.png";
                        break;    
                    case 'Stretch Limousine':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/stretch-white-limousine.jpg";
                        break;
                    case 'Stretch Hummer Limousine':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/stretch-hummer-limousine.jpg";
                        break; 
                    case 'Stretch Escalade Limousine':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/stretch-black-limousine.jpg";
                        break;
                    case 'Passenger Van':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/passenger-vans.jpg";
                        break;
                    case 'Mercedes Sprinter':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/mercedes-sprinter.jpg";
                        break;
                    case '20 Passenger Limo Bus':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/20-passenger-limo-bus.jpg";
                        break; 
                    case 'Shuttle Bus':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/shuttle-buses.jpg";
                        break;     
                    case '30 Passenger Limo Bus':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/35-passenger-limo-bus.png";
                        break; 
                    case '35 Passenger Limo Bus':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/35-passenger-limo-bus.png";
                        break; 
                    case 'Executive Shuttle Bus':
                        imageUrl = "https://www.royalcarriages.com/wp-content/uploads/2023/12/exe-bus.jpg";
                        break; 
                    case 'Charter Bus / Motor Coach':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/charter-bus-motor-coach.jpeg";
                        break;             
                                                  
                    // Add more cases as needed
                    default:
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/luxury-sedans.jpg";
                }

                jQuery("#imageContainer img").attr("src", imageUrl);
            }
        });
    </script>

<?php
    
    return ob_get_clean();
}
add_shortcode('vehicleImage','Typeofvehicle');


/* contact form 7 selection box images in one way trip */

function Typeofoneway(){
    ob_start();
?>
<div id="imageContainer">
        <?php
            
            $defaultImage = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/luxury-sedans.jpg";
            echo "<img src='" . $defaultImage . "' alt='Default Image'>";
        ?>
    </div>

    <script>
        jQuery(document).ready(function() {
            jQuery("#type-of-oneway").change(function() {
                var selectedValue = jQuery(this).val();
                displayImage(selectedValue);
            });

            function displayImage(selectedValue) {
                var imageUrl;
                switch (selectedValue) {
                    case 'Luxury Sedan':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/luxury-sedans.jpg";
                        break;
                    case 'Mercedes S Class Sedan':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/Mercedes S Class.png";
                        break;
                    case 'Mercedes Sprinter Van 2024':
                        imageUrl = "https://www.bestlimousines.com/wp-content/uploads/2024/02/sprinter-van-2024.jpeg";
                        break;    
                    case 'Luxury Suburban':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/luxury-suburban.png";
                        break; 
                    case 'Luxury Escalade':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/escalade-limousine.png";
                        break;    
                    case 'Stretch Limousine':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/stretch-white-limousine.jpg";
                        break;
                    case 'Stretch Hummer Limousine':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/stretch-hummer-limousine.jpg";
                        break; 
                    case 'Stretch Escalade Limousine':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/stretch-black-limousine.jpg";
                        break;
                    case 'Passenger Van':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/passenger-vans.jpg";
                        break;
                    case 'Mercedes Sprinter':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/mercedes-sprinter.jpg";
                        break;
                    case '20 Passenger Limo Bus':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/20-passenger-limo-bus.jpg";
                        break; 
                    case 'Shuttle Bus':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/shuttle-buses.jpg";
                        break;     
                    case '30 Passenger Limo Bus':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/35-passenger-limo-bus.png";
                        break; 
                    case '35 Passenger Limo Bus':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/35-passenger-limo-bus.png";
                        break; 
                    case 'Executive Shuttle Bus':
                        imageUrl = "https://www.royalcarriages.com/wp-content/uploads/2023/12/exe-bus.jpg";
                        break; 
                    case 'Charter Bus / Motor Coach':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/charter-bus-motor-coach.jpeg";
                        break;             
                                                  
                    // Add more cases as needed
                    default:
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/luxury-sedans.jpg";
                }

                jQuery("#imageContainer img").attr("src", imageUrl);
            }
        });
    </script>

<?php
    
    return ob_get_clean();
}
add_shortcode('onewayvehicleImage','Typeofoneway');


/* contact form 7 selection box images in hourly trip */
function Typeofhourly(){
    ob_start();
?>
<div id="imageContainer">
        <?php
            
            $defaultImage = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/luxury-sedans.jpg";
            echo "<img src='" . $defaultImage . "' alt='Default Image'>";
        ?>
    </div>

    <script>
        jQuery(document).ready(function() {
            jQuery("#type-of-hourly").change(function() {
                var selectedValue = jQuery(this).val();
                displayImage(selectedValue);
            });

            function displayImage(selectedValue) {
                var imageUrl;
                switch (selectedValue) {
                    case 'Luxury Sedan':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/luxury-sedans.jpg";
                        break;
                    case 'Mercedes S Class Sedan':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/Mercedes S Class.png";
                        break;
                    case 'Mercedes Sprinter Van 2024':
                        imageUrl = "https://www.bestlimousines.com/wp-content/uploads/2024/02/sprinter-van-2024.jpeg";
                        break;    
                    case 'Luxury Suburban':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/luxury-suburban.png";
                        break; 
                    case 'Luxury Escalade':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/escalade-limousine.png";
                        break;    
                    case 'Stretch Limousine':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/stretch-white-limousine.jpg";
                        break;
                    case 'Stretch Hummer Limousine':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/stretch-hummer-limousine.jpg";
                        break; 
                    case 'Stretch Escalade Limousine':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/stretch-black-limousine.jpg";
                        break;
                    case 'Passenger Van':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/passenger-vans.jpg";
                        break;
                    case 'Mercedes Sprinter':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/mercedes-sprinter.jpg";
                        break;
                    case '20 Passenger Limo Bus':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/20-passenger-limo-bus.jpg";
                        break; 
                    case 'Shuttle Bus':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/shuttle-buses.jpg";
                        break;     
                    case '30 Passenger Limo Bus':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/35-passenger-limo-bus.png";
                        break; 
                    case '35 Passenger Limo Bus':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/35-passenger-limo-bus.png";
                        break; 
                    case 'Executive Shuttle Bus':
                        imageUrl = "https://www.royalcarriages.com/wp-content/uploads/2023/12/exe-bus.jpg";
                        break; 
                    case 'Charter Bus / Motor Coach':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/charter-bus-motor-coach.jpeg";
                        break;             
                                                  
                    // Add more cases as needed
                    default:
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/luxury-sedans.jpg";
                }

                jQuery("#imageContainer img").attr("src", imageUrl);
            }
        });
    </script>

<?php
    
    return ob_get_clean();
}
add_shortcode('hourlyvehicleImage','Typeofhourly');




/* contact form 7 selection box images in Round Trip */

function Typeofroundtrip(){
    ob_start();
?>
<div id="imageContainer">
        <?php
            
            $defaultImage = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/luxury-sedans.jpg";
            echo "<img src='" . $defaultImage . "' alt='Default Image'>";
        ?>
    </div>

    <script>
        jQuery(document).ready(function() {
            jQuery("#type-of-roundtrip").change(function() {
                var selectedValue = jQuery(this).val();
                displayImage(selectedValue);
            });

            function displayImage(selectedValue) {
                var imageUrl;
                switch (selectedValue) {
                    case 'Luxury Sedan':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/luxury-sedans.jpg";
                        break;
                    case 'Mercedes S Class Sedan':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/Mercedes S Class.png";
                        break;
                    case 'Mercedes Sprinter Van 2024':
                        imageUrl = "https://www.bestlimousines.com/wp-content/uploads/2024/02/sprinter-van-2024.jpeg";
                        break;    
                    case 'Luxury Suburban':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/luxury-suburban.png";
                        break; 
                    case 'Luxury Escalade':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/escalade-limousine.png";
                        break;    
                    case 'Stretch Limousine':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/stretch-white-limousine.jpg";
                        break;
                    case 'Stretch Hummer Limousine':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/stretch-hummer-limousine.jpg";
                        break; 
                    case 'Stretch Escalade Limousine':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/stretch-black-limousine.jpg";
                        break;
                    case 'Passenger Van':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/passenger-vans.jpg";
                        break;
                    case 'Mercedes Sprinter':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/mercedes-sprinter.jpg";
                        break;
                    case '20 Passenger Limo Bus':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/20-passenger-limo-bus.jpg";
                        break; 
                    case 'Shuttle Bus':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/shuttle-buses.jpg";
                        break;     
                    case '30 Passenger Limo Bus':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/35-passenger-limo-bus.png";
                        break; 
                    case '35 Passenger Limo Bus':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/35-passenger-limo-bus.png";
                        break; 
                    case 'Executive Shuttle Bus':
                        imageUrl = "https://www.royalcarriages.com/wp-content/uploads/2023/12/exe-bus.jpg";
                        break; 
                    case 'Charter Bus / Motor Coach':
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/charter-bus-motor-coach.jpeg";
                        break;             
                                                  
                    // Add more cases as needed
                    default:
                        imageUrl = "https://www.bestlimousines.com/wp-content/themes/bestlimousines-4/assets/images/luxury-sedans.jpg";
                }

                jQuery("#imageContainer img").attr("src", imageUrl);
            }
        });
    </script>

<?php
    
    return ob_get_clean();
}
add_shortcode('roundtripvehicleImage','Typeofroundtrip');

// Load WordPress Form Enhancement Script with highest priority
add_action('wp_enqueue_scripts', function () {
    // Use timestamp to force fresh load and bypass all caches
    $timestamp = time();
    wp_enqueue_script(
        'wp-form-enhancements',
        'https://cdn.jsdelivr.net/gh/MujtabaRaza1/wordpressforms2@main/script.js',
        array('jquery'), // Depends on jQuery
        '1.3.0-' . $timestamp, // Version number with timestamp
        false // Load in head
    );
}, 1); // Highest priority

// Alternative method - direct script injection with cache busting
add_action('wp_head', function () {
    $timestamp = time();
    // Try multiple CDN approaches to bypass cache
    echo '<script>
    // Try loading from different CDN sources with cache busting
    var scriptLoaded = false;
    var timestamp = "' . $timestamp . '";
    
    function loadScript(src, callback) {
        var script = document.createElement("script");
        script.src = src;
        script.onload = function() {
            if (!scriptLoaded) {
                scriptLoaded = true;
                console.log("WordPress Form Enhancement Script loaded from: " + src);
                if (callback) callback();
            }
        };
        script.onerror = function() {
            console.log("Failed to load script from: " + src);
            if (callback) callback();
        };
        document.head.appendChild(script);
    }
    
    // Try jsDelivr with cache busting first
    loadScript("https://cdn.jsdelivr.net/gh/MujtabaRaza1/wordpressforms2@main/script.js?v=1.3.0&t=" + timestamp, function() {
        if (!scriptLoaded) {
            // Fallback to different jsDelivr URL format
            loadScript("https://cdn.jsdelivr.net/gh/MujtabaRaza1/wordpressforms2@latest/script.js?t=" + timestamp);
        }
    });
    </script>' . "\n";
}, 1); // Highest priority