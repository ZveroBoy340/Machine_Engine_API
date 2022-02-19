<?php
/*
Plugin Name: WPM Fitment API
Plugin URI: https://wp-masters.com
Description: Add Search Form with Fitment Data from API
Author: wp-masters
Version: 1.0
*/

define('FITMENT_PLUGIN_PATH', plugins_url('', __FILE__));

class WPM_Fitment_API
{

    private $settings;

    /**
     * Initialize functions
     */
    public function __construct()
    {
        // Init Functions
        add_action('init', [$this, 'save_settings']);
        add_action('init', [$this, 'load_settings']);

        // Include Styles and Scripts
        add_action('admin_enqueue_scripts', [$this, 'admin_scripts_and_styles']);
        add_action('wp_enqueue_scripts', [$this, 'include_scripts_and_styles'], 99);

        // Admin menu
        add_action('admin_menu', [$this, 'register_menu']);

        // Ajax Functions
        add_action('wp_ajax_get_data_from_api', [$this, 'get_data_from_api']);
        add_action('wp_ajax_nopriv_get_data_from_api', [$this, 'get_data_from_api']);

        // Create Shortcodes
        add_shortcode('fitment_api', [$this, 'create_shortcode']);
    }

    /**
     * Get Results from API by Ajax
     */
    public function get_data_from_api()
    {
        if(!wp_verify_nonce($_POST['nonce'], 'wpm-fitment-nonce') && isset($_POST['value']) && isset($_POST['type'])) {
            return false;
        }

        // Prepare Data
        $year = sanitize_text_field($_POST['year']);
        $make = sanitize_text_field($_POST['make']);
        $model = sanitize_text_field($_POST['model']);
        $engine = sanitize_text_field($_POST['engine']);
        $transmissions = sanitize_text_field($_POST['transmissions']);
        $product = sanitize_text_field($_POST['product']);
        $type = sanitize_text_field($_POST['type']);

        // Prepare Data to Send on API
        $data = [];
        if($type == 'years') {
            $type_key = 'fitment';
            $data = [
                'column' => 'YearID'
            ];
        } elseif($type == 'makes') {
            $type_key = 'fitment';
            $data = [
                'YearID' => $year,
                'column' => 'MakeID'
            ];
        } elseif($type == 'models') {
            $type_key = 'fitment';
            $data = [
                'YearID' => $year,
                'MakeID' => $make,
                'column' => 'ModelID'
            ];
        } elseif($type == 'engines') {
            $type_key = 'fitment';
            $data = [
                'YearID' => $year,
                'MakeID' => $make,
                'ModelID' => $model,
                'column' => 'EngineBaseID'
            ];
        } elseif($type == 'transmissions') {
            $type_key = 'fitment';
            $data = [
                'YearID' => $year,
                'MakeID' => $make,
                'ModelID' => $model,
                'EngineBaseID' => $engine,
                'column' => 'TransmissionMfrCodeID'
            ];
        } elseif($type == 'product_list') {
            $type_key = 'fitment';
            $data = [
                'YearID' => $year,
                'MakeID' => $make,
                'ModelID' => $model,
                'EngineBaseID' => $engine,
                'TransmissionMfrCodeID' => $transmissions,
                'column' => 'TransmissionMfrCodeID',
                'getProducts' => 1
            ];
        } elseif($type == 'product') {
            $type_key = 'product';
            $data = [
                'id' => $product,
                'pricing' => 1,
                'attributes' => 1
            ];
        }

        if($type == 'product_list') {
            ob_start();

            $products = $this->get_properties_data($data, $type_key);
            $products_data = [];

            if(count($products['data']) > 0) {
                foreach($products['data'] as $product) {
                    $type_key = 'product';
                    $data = [
                        'id' => $product['id'],
                        'pricing' => 1,
                        'attributes' => 1
                    ];
                    $products_data[] = $this->get_properties_data($data, $type_key);
                }
            }

            include('templates/ajax/fitment-product.php');
            $result = ob_get_clean();
        } elseif($type == 'product') {
            ob_start();

            $products_data = [];
            $type_key = 'attributeSearch';
            $data = [
                'paid' => 'eTlMRnhOTGIvalFOS01nR0w5YzltUT09',
                'search' => $product,
                'searchStrict' => 1,
                'searchStrictPrefixMatch' => 1,
                'includeInactive' => 1
            ];
            $attr_products = $this->get_properties_data($data, $type_key);

            if(count($attr_products['data']) > 0) {
                foreach($attr_products['data'] as $product) {
                    $type_key = 'product';
                    $data = [
                        'id' => $product,
                        'pricing' => 1,
                        'attributes' => 1
                    ];
                    $products_data[] = $this->get_properties_data($data, $type_key);
                }
            } else {
                $products_data[] = $this->get_properties_data($data, $type_key);
            }

            include('templates/ajax/fitment-product.php');
            $result = ob_get_clean();
        } else {
            $result = $this->get_properties_data($data, $type_key);
        }

        wp_send_json([
            'data' => $result,
            'type' => $type,
            'status' => 'true'
        ]);
    }

    /**
     * Get Properties from OpenBroker
     */
    public function get_properties_data($data, $type_key)
    {
        $response = wp_remote_post($this->settings['api_url']."?".http_build_query($data), array(
            'method' => 'GET',
            "timeout" => 100,
            'headers' => [
                "Content-type" => "application/json",
                "X-Resource-Key" => $type_key,
                "X-Authorization" => "Basic ".$this->settings['api_key']
            ]
        ));

        return json_decode($response['body'], true);
    }

    /**
     * Create ShortCode
     */
    public function create_shortcode($args)
    {
        if(!isset($args['template'])) {
            return false;
        }

        // Get Template
        if($args['template'] == 'search') {
            $years = $this->get_properties_data(['column' => 'YearID'], 'fitment');
            ob_start();
            include ('templates/frontend/shortcodes/search_form.php');
            $content = ob_get_clean();
        } elseif($args['template'] == 'results') {
            $content = '<div class="wpm_fitment_products"></div>';
        } elseif($args['template'] == 'search_product') {
            $years = $this->get_properties_data(['column' => 'YearID'], 'fitment');
            ob_start();
            include ('templates/frontend/shortcodes/search_single_form.php');
            $content = ob_get_clean();
        } elseif($args['template'] == 'result_single') {
            $content = '<div class="wpm_fitment_products"></div>';
        }

        return $content;
    }

    /**
     * Save Core Settings to Option
     */
    public function save_settings()
    {
        if(isset($_POST['wpm_core']) && is_array($_POST['wpm_core']))
        {
            $data = $this->sanitize_array($_POST['wpm_core']);
            update_option('wpm_core', serialize($data));
        }
    }

    /**
     * Sanitize Array Data
     */
    public function sanitize_array($data)
    {
        $filtered = [];
        foreach($data as $key => $value) {
            if(is_array($value)) {
                foreach($value as $sub_key => $sub_value) {
                    $filtered[$key][$sub_key] = sanitize_text_field($sub_value);
                }
            } else {
                $filtered[$key] = sanitize_text_field($value);
            }
        }

        return $filtered;
    }

    /**
     * Load Saved Settings
     */
    public function load_settings()
    {
        $this->settings = unserialize(get_option('wpm_core'));
    }

    /**
     * Include Scripts And Styles on Admin Pages
     */
    public function admin_scripts_and_styles()
    {
        $api_nonce = wp_create_nonce('wpm-fitment-nonce');

        // Register styles
        wp_enqueue_style('wpm-core-selectstyle', plugins_url('templates/libs/selectstyle/selectstyle.css', __FILE__));
        wp_enqueue_style('wpm-font-awesome', plugins_url('templates/libs/font-awesome/scripts/all.min.css', __FILE__));
        wp_enqueue_style('wpm-core-tips', plugins_url('templates/libs/tips/tips.css', __FILE__));
        wp_enqueue_style('wpm-core-select2', plugins_url('templates/libs/select2/select2.min.css', __FILE__));
        wp_enqueue_style('wpm-core-admin', plugins_url('templates/assets/css/admin.css', __FILE__));

        // Register Scripts
        wp_enqueue_script('wpm-core-selectstyle', plugins_url('templates/libs/selectstyle/selectstyle.js', __FILE__));
        wp_enqueue_script('wpm-font-awesome', plugins_url('templates/libs/font-awesome/scripts/all.min.js', __FILE__));
        wp_enqueue_script('wpm-core-tips', plugins_url('templates/libs/tips/tips.js', __FILE__));
        wp_enqueue_script('wpm-core-select2', plugins_url('templates/libs/select2/select2.min.js', __FILE__));
        wp_enqueue_script('wpm-core-admin', plugins_url('templates/assets/js/admin.js', __FILE__));
        wp_localize_script('wpm-core-admin', 'admin', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => $api_nonce
        ));
        wp_enqueue_script('wpm-core-admin');
    }

    /**
     * Include Scripts And Styles on FrontEnd
     */
    public function include_scripts_and_styles()
    {
        $api_nonce = wp_create_nonce('wpm-fitment-nonce');

        // Register styles
        wp_enqueue_style('wpm-font-awesome', plugins_url('templates/libs/font-awesome/scripts/all.min.css', __FILE__));
        wp_enqueue_style('wpm-core-lightzoom', plugins_url( 'templates/libs/lightzoom/style.css', __FILE__ ) );
        wp_enqueue_style('wpm-core', plugins_url('templates/assets/css/frontend.css', __FILE__) , false, '1.0.8', 'all');

        // Register scripts
        wp_enqueue_script('wpm-core-lightzoom', plugins_url('templates/libs/lightzoom/lightzoom.js', __FILE__ ) , array('jquery') , '1.0.2', 'all');
        wp_enqueue_script('wpm-font-awesome', plugins_url('templates/libs/font-awesome/scripts/all.min.js', __FILE__) , array('jquery') , '1.0.2', 'all');
        wp_register_script('wpm-core', plugins_url('templates/assets/js/frontend.js', __FILE__) , array('jquery') , '1.0.17', 'all');
        wp_localize_script('wpm-core', 'admin', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => $api_nonce
        ));
        wp_enqueue_script('wpm-core');
    }

    /**
     * Add Settings to Admin Menu
     */
    public function register_menu()
    {
        add_menu_page('WPM Fitment API', 'WPM Fitment API', 'edit_others_posts', 'wpm_fitment_settings');
        add_submenu_page('wpm_fitment_settings', 'WPM Fitment API', 'WPM Fitment API', 'manage_options', 'wpm_fitment_settings', function ()
        {
            global $wp_version, $wpdb;

            // Get Saved Settings
            $settings = $this->settings;

            include 'templates/admin/settings.php';
        });
    }
}

new WPM_Fitment_API();

