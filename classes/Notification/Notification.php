<?php

namespace Gitpress\Notification;

use Gitpress\Data\Credentials;

class Notification {

	public function __construct() {


		add_action( 'admin_notices', function () {
			$credentials = Credentials::get_instance();
			if ( ! function_exists( 'get_field' ) ) {
				?>
                <div class="notice notice-error">
                    <p><?php echo "ACF needs to be installed for gitpress to work" ?></p>
                </div>
				<?php
				// Dont do next checks if field is not defined.
				return;
			}

			if ( ! $credentials->username ) {
				?>
                <div class="notice notice-error">
                    <p><?php echo "Gitpress configuration failed : Please set your github / gitlab username " ?> <a
                                href="<?php echo get_edit_profile_url() ?>">here</a></p>
                </div>
				<?php
			}

			if ( ! $credentials->password ) {
				?>
                <div class="notice notice-error">
                    <p><?php echo "Gitpress configuration failed : Please set your github / gitlab password " ?> <a
                                href="<?php echo get_edit_profile_url() ?>">here</a></p>
                </div>
				<?php
			}


		} );


	}


}