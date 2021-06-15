<?php

namespace ACA\YoastSeo\Column\Post;

use AC;
use ACA\YoastSeo\Editing;
use ACA\YoastSeo\Export;
use ACP;

class MetaDesc extends AC\Column
	implements ACP\Editing\Editable, ACP\Export\Exportable, ACP\Search\Searchable {

	public function __construct() {
		$this->set_type( 'wpseo-metadesc' )
		     ->set_group( 'yoast-seo' )
		     ->set_original( true );
	}

	public function get_meta_key() {
		return '_yoast_wpseo_metadesc';
	}

	public function editing() {
		return new Editing\Post\MetaDesc( $this );
	}

	public function export() {
		return new Export\Post\MetaDesc( $this );
	}

	public function search() {
		return new ACP\Search\Comparison\Meta\Text( $this->get_meta_key(), AC\MetaType::POST );
	}

}