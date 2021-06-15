<?php

namespace ACA\YoastSeo\Export\Post;

use ACP\Export;

class FocusKW extends Export\Model {

	public function get_value( $id ) {
		return get_post_meta( $id, '_yoast_wpseo_focuskw', true );
	}

}