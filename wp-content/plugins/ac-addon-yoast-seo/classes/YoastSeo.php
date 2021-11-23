<?php

namespace ACA\YoastSeo;

use AC;
use ACP;
use ReflectionException;

class YoastSeo extends AC\Plugin {

	public function __construct( $file ) {
		parent::__construct( $file, 'aca_yoast_seo' );
	}

	/**
	 * Register hooks
	 */
	public function register() {
		( new HideFilters() )->register();

		add_action( 'ac/column_groups', [ $this, 'register_column_groups' ] );
		add_action( 'ac/column_types', [ $this, 'add_columns' ] );
	}

	public function register_column_groups( AC\Groups $groups ) {
		$groups->register_group( 'yoast-seo', __( 'Yoast SEO', 'wordpress-seo' ), 25 );
	}

	/**
	 * @param AC\ListScreen $list_screen
	 *
	 * @throws ReflectionException
	 */
	public function add_columns( AC\ListScreen $list_screen ) {

		switch ( true ) {
			case $list_screen instanceof AC\ListScreen\User:
				$list_screen->register_column_types_from_dir( 'ACA\YoastSeo\Column\User' );

				break;

			case $list_screen instanceof AC\ListScreen\Post:
				$list_screen->register_column_types_from_dir( 'ACA\YoastSeo\Column\Post' );

				break;
			case $list_screen instanceof ACP\ListScreen\Taxonomy:
				$list_screen->register_column_types_from_dir( 'ACA\YoastSeo\Column\Taxonomy' );

				break;
		}

	}

}