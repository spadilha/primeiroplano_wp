<?php

namespace ACA\YoastSeo\Editing\Taxonomy;

use ACA\YoastSeo\Column;
use ACP\Editing;

class SeoMeta extends Editing\Model {

	/**
	 * @var string
	 */
	private $meta_key;

	/**
	 * @var string
	 */
	private $taxonomy;

	public function __construct( Column\TermMeta $column, $taxonomy, $meta_key ) {
		parent::__construct( $column );

		$this->meta_key = $meta_key;
		$this->taxonomy = $taxonomy;
	}

	public function get_view_settings() {
		return [
			'type' => 'text',
		];
	}

	public function save( $id, $value ) {
		$meta = get_option( 'wpseo_taxonomy_meta' );

		if ( ! isset( $meta[ $this->taxonomy ] ) ) {
			$meta[ $this->taxonomy ] = [];
		}

		if ( ! isset( $meta[ $this->taxonomy ][ $id ] ) ) {
			$meta[ $this->taxonomy ][ $id ] = [];
		}

		$meta[ $this->taxonomy ][ $id ][ $this->meta_key ] = $value;

		update_option( 'wpseo_taxonomy_meta', $meta );
	}

}