<div id="form-body" class="wrap">
    <form method="post" action="options.php">
        <div class="header p-4 flex items-center space-between">
            <div class="flex items-center">
                <span class="dashicons dashicons-embed-generic mr-4 wp-icon"></span>
                <h2><?php _e( 'Add Scripts ') ?> — <?php _e( 'Page: Settings', ADD_SCRIPTS_TEXT_DOMAIN ) ?></h2>    
            </div>
            
            <button type="submit" class="button-primary"><?php _e( 'Save' ) ?></button>
        </div>
    
        <div class="flex flex-wrap">
            <div class="w-full md:w-3/4">
                <div class="section-header p-4">
                    <strong><?php _e( 'Add Scripts', ADD_SCRIPTS_TEXT_DOMAIN ) ?></strong>
                    <p>
                        <?php _e('
                            This plugin integrates scripts into the header of your theme.
                            If your theme doesn’t include default header, then I’d recommend 
                            getting another theme. A well-written theme will always include 
                            this, and if it doesn’t, who’s to say where else there may be 
                            problems?
                        ', ADD_SCRIPTS_TEXT_DOMAIN ) ?>
                    </p>
                </div>

                <div class="section-body">
                    <div class="p-4">
                        <table class="form-table">
                            <tr valign="top">
                                <th scope="row" class="align-middle">
                                    <div class="th-div">
                                        <span class="mr-5"><?php _e( 'Add Script', ADD_SCRIPTS_TEXT_DOMAIN ); ?></span>
                                    </div>
                                </th>
                                <td colspan="2">
                                    <label><?php _e( 'Code', ADD_SCRIPTS_TEXT_DOMAIN ); ?></label>
                                    <textarea placeholder="none" name="<?php echo ADD_SCRIPTS_INPUTS_PREFIX; ?>scripts"><?php echo get_option( KIRILKIRKOV_ADD_SCRIPTS_INPUTS_PREFIX.'scripts' ); ?></textarea>
                                </td>
                            </tr>

                            <input type="hidden" name="action" value="update" />
                            <input type="hidden" name="page_options" value="<?php echo ADD_SCRIPTS_INPUTS_GROUP; ?>" />

                            <?php settings_fields(ADD_SCRIPTS_INPUTS_GROUP); ?>
                        </table>
                        <div class="flex justify-end">
                            <button type="submit" class="button-primary"><?php _e( 'Save' ) ?></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/4 ad-col">
                <div class="p-4">
                    <div class="ad-box p-4 flex flex-wrap items-center justify-between">
                        <img src="<?php echo plugins_url('GitHub-Mark-64px.png', __FILE__ ); ?>" width="30px" height="30px" alt="GitHub">
                        <a href="https://github.com/Wordpress-Plugins-World" class="accent-button" target="_blank"><?php _e( 'Find Us', ADD_SCRIPTS_TEXT_DOMAIN ); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>