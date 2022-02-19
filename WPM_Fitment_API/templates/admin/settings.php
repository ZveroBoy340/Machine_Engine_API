<div id="settings-panel">
    <div class="section-company">
        <div class="left-side">
            <ul>
                <li><a class="change-table active" data-table="general-settings-table"><i class="fas fa-tools"></i> <?php echo esc_html__( 'General Setting', 'wpm-core' ) ?></a></li>
                <li><a class="change-table" data-table="system-info-table"><i class="fas fa-shield-alt"></i> <?php echo esc_html__( 'System Info', 'wpm-core' ) ?></a></li>
                <li><a class="support-item" href="https://wp-masters.com" target="_blank"><i class="fas fa-life-ring"></i> <?php echo esc_html__( 'Plugin Support', 'wpm-core' ) ?></a></li>
            </ul>
        </div>
        <div class="right-side">
            <a href="https://wp-masters.com" target="_blank"><img src="<?php echo esc_attr( FITMENT_PLUGIN_PATH . '/templates/assets/img/logo.png' ) ?>" alt=""></a>
        </div>
    </div>
    <div class="select-table" id="general-settings-table">
        <form action="" method="post">
            <div class="section_data">
                <div class="title">API Authorization</div>
                <div class="head_items">
                    <div class="item-table">API URL: <a href="#" data-tooltip="API URL for get Data from API" class="help-icon clicktips"><i class="fas fa-question-circle"></i></a></div>
                    <div class="item-table">API Key: <a href="#" data-tooltip="API Key for Autorization" class="help-icon clicktips"><i class="fas fa-question-circle"></i></a></div>
                </div>
                <div class="items-list">
                    <div class="item-content">
                        <div class="item-table"><input type="text" name="wpm_core[api_url]" value="<?php if ( isset( $settings['api_url'] ) ) {echo esc_html( $settings['api_url'] );} ?>"></div>
                        <div class="item-table"><input type="text" name="wpm_core[api_key]" value="<?php if ( isset( $settings['api_key'] ) ) {echo esc_html( $settings['api_key'] );} ?>"></div>
                    </div>
                </div>
            </div>
            <button class="button button-primary button-large" id="save-settings" type="submit"><?php echo esc_html__( 'Save settings', 'wpm-core' ) ?></button>
        </form>
    </div>
    <div class="select-table" id="system-info-table" style="display: none">
        <div class="section_data">
            <div class="alert-help">
                <i class="fas fa-question-circle"></i> <?php echo esc_html__( 'The following is a system report containing useful technical information for troubleshooting issues. If you need further help after viewing the report, do the screenshots of this page and send it to our Support.', 'wpm-core' ) ?>
            </div>
            <table class="status-table" cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th colspan="2"><?php echo esc_html__( 'WordPress', 'wpm-core' ) ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo esc_html__( 'Home URL', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( get_home_url() ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Site URL', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( get_site_url() ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'REST API Base URL', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( rest_url() ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'WordPress Version', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( $wp_version ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'WordPress Memory Limit', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( WP_MEMORY_LIMIT ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'WordPress Debug Mode', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( WP_DEBUG ? 'Yes' : 'No' ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'WordPress Debug Log', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( WP_DEBUG_LOG ? __( 'Yes', 'wpm-core' ) : __( 'No', 'wpm-core' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'WordPress Script Debug Mode', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( SCRIPT_DEBUG ? __( 'Yes', 'wpm-core' ) : __( 'No', 'wpm-core' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'WordPress Cron', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ? __( 'Yes', 'wpm-core' ) : __( 'No', 'wpm-core' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'WordPress Alternate Cron', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( defined( 'ALTERNATE_WP_CRON' ) && ALTERNATE_WP_CRON ? __( 'Yes', 'wpm-core' ) : __( 'No', 'wpm-core' ) ) ?></td>
                </tr>
                </tbody>
            </table>
            <table class="status-table" cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th colspan="2"><?php echo esc_html__( 'Web Server', 'wpm-core' ) ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo esc_html__( 'Software', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( $_SERVER['SERVER_SOFTWARE'] ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Port', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( $_SERVER['SERVER_PORT'] ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Document Root', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( $_SERVER['DOCUMENT_ROOT'] ) ?></td>
                </tr>
                </tbody>
            </table>
            <table class="status-table" cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th colspan="2"><?php echo esc_html__( 'PHP', 'wpm-core' ) ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo esc_html__( 'Version', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( phpversion() ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Memory Limit (memory_limit)', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( ini_get( 'memory_limit' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Maximum Execution Time (max_execution_time)', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( ini_get( 'max_execution_time' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Maximum File Upload Size (upload_max_filesize)', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( ini_get( 'upload_max_filesize' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Maximum File Uploads (max_file_uploads)', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( ini_get( 'max_file_uploads' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Maximum Post Size (post_max_size)', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( ini_get( 'post_max_size' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Maximum Input Variables (max_input_vars)', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( ini_get( 'max_input_vars' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'cURL Enabled', 'wpm-core' ) ?></td>
                    <td><?php $curl = curl_version();
						if ( isset( $curl['version'] ) ) {
							echo esc_html( "Yes (version $curl[version])" );
						} else {
							echo esc_html( "No" );
						} ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Mcrypt Enabled', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( function_exists( 'mcrypt_encrypt' ) ? 'Yes' : 'No' ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Mbstring Enabled', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( function_exists( 'mb_strlen' ) ? 'Yes' : 'No' ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Loaded Extensions', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( implode( ', ', get_loaded_extensions() ) ) ?></td>
                </tr>
                </tbody>
            </table>
            <table class="status-table" cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th colspan="2"><?php echo esc_html__( 'Database Server', 'wpm-core' ) ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo esc_html__( 'Database Character Set', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( $wpdb->get_var( 'SELECT @@character_set_database' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'Database Collation', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( $wpdb->get_var( 'SELECT @@collation_database' ) ) ?></td>
                </tr>
                </tbody>
            </table>
            <table class="status-table" cellpadding="0" cellspacing="0">
                <thead>
                <tr>
                    <th colspan="2"><?php echo esc_html__( 'Date and Time', 'wpm-core' ) ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?php echo esc_html__( 'WordPress (Local) Timezone', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( get_option( 'timezone_string' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'MySQL (UTC)', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( $wpdb->get_var( 'SELECT utc_timestamp()' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'MySQL (Local)', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( date( "F j, Y, g:i a", strtotime( $wpdb->get_var( 'SELECT utc_timestamp()' ) ) ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'PHP (UTC)', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( date( 'Y-m-d H:i:s' ) ) ?></td>
                </tr>
                <tr>
                    <td><?php echo esc_html__( 'PHP (Local)', 'wpm-core' ) ?></td>
                    <td><?php echo esc_html( date( "F j, Y, g:i a" ) ) ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>