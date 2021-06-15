<?php

namespace ACA\YoastSeo\Column\Taxonomy;

use ACA\YoastSeo\Column;
use ACA\YoastSeo\Editing;
use ACP;

class MetaDesc extends Column\TermMeta
	implements ACP\Editing\Editable {

	public function __construct() {
		$this->set_type( 'wpseo-tax_metadesc' )
		     ->set_group( 'yoast-seo' )
		     ->set_label( __( 'Meta Desc.', 'wordpress-seo' ) );
	}

	protected function get_meta_key() {
		return 'wpseo_desc';
	}

	public function editing() {
		return new Editing\Taxonomy\SeoMetaDescription( $this, $this->get_taxonomy(), $this->get_meta_key() );
	}

}