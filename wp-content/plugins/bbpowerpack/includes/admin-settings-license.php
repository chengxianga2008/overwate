<?php
/**
 * PowerPack admin settings license tab.
 *
 * @since 1.0.0
 * @package bb-powerpack
 */

?>

<?php if ( is_network_admin() || ! is_multisite() ) { ?>

    <?php settings_fields( 'bb_powerpack_license' ); ?>

    <p><?php echo sprintf(__('Enter your <a href="%s" target="_blank">license key</a> to enable remote updates and support.', 'bb-powerpack'), 'https://wpbeaveraddons.com/checkout/purchase-history/?utm_medium=powerpack&utm_source=license-settings-page&utm_campaign=license-key-link'); ?>
    <table class="form-table">
        <tbody>
            <tr valign="top">
                <th scope="row" valign="top">
                    <?php esc_html_e('License Key', 'bb-powerpack'); ?>
                </th>
                <td>
                    <input id="bb_powerpack_license_key" name="bb_powerpack_license_key" type="password" class="regular-text" value="<?php esc_attr_e( $license ); ?>" />
                </td>
            </tr>
            <?php if( false !== $license ) { ?>
                <tr valign="top">
                    <th scope="row" valign="top">
                        <?php esc_html_e( 'License Status', 'bb-powerpack' ); ?>
                    </th>
                    <td>
                        <?php if ( $status == 'valid' ) { ?>
                            <span style="color: #267329; background: #caf1cb; padding: 5px 10px; text-shadow: none; border-radius: 3px; display: inline-block; text-transform: uppercase;"><?php esc_html_e('active'); ?></span>
                            <?php wp_nonce_field( 'bb_powerpack_nonce', 'bb_powerpack_nonce' ); ?>
                                <input type="submit" class="button-secondary" name="bb_powerpack_license_deactivate" value="<?php esc_html_e('Deactivate License', 'bb-powerpack'); ?>" />
                        <?php } else { ?>
                            <?php if ( $status == '' ) { $status = 'inactive'; } ?>
                            <span style="<?php echo $status == 'inactive' ? 'color: #fff; background: #b1b1b1;' : 'color: red; background: #ffcdcd;'; ?> padding: 5px 10px; text-shadow: none; border-radius: 3px; display: inline-block; text-transform: uppercase;"><?php echo $status; ?></span>
                            <?php
                            wp_nonce_field( 'bb_powerpack_nonce', 'bb_powerpack_nonce' ); ?>
                            <input type="submit" class="button-secondary" name="bb_powerpack_license_activate" value="<?php esc_html_e( 'Activate License', 'bb-powerpack' ); ?>"/>
                            <p class="description"><?php esc_html_e( 'Please click the “Activate License” button to activate your license.', 'bb-powerpack' ); ?>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php submit_button(); ?>

<?php } ?>
