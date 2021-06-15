<?php

namespace ACA\YoastSeo\Column\Post;

use AC;
use ACA\YoastSeo\Editing;
use ACA\YoastSeo\Export;
use ACP;

class FocusKW extends AC\Column
	implements ACP\Editing\Editable, ACP\Export\Exportable {

	public function __construct() {
		$this->set_type( 'wpseo-focuskw' )
		     ->set_group( 'yoast-seo' )
		     ->set_original( true );
	}

	public function editing() {
		return new Editing\Post\FocusKW( $this );
	}

	public function export() {
		return new Export\Post\FocusKW( $this );
	}

}