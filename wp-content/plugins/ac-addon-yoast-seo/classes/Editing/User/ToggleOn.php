<?php

namespace ACA\YoastSeo\Editing\User;

use AC;
use ACP;

class ToggleOn extends ACP\Editing\Model\Meta {

	/**
	 * @var string
	 */
	private $on_value;

	public function __construct( AC\Column\Meta $column, $on_value = 'on' ) {
		parent::__construct( $column );

		$this->on_value = $on_value;
	}

	public function get_view_settings() {
		return [
			'type'    => 'togglable',
			'options' => [
				''              => __( 'False', 'codepress-admin-columns' ),
				$this->on_value => __( 'True', 'codepress-admin-columns' ),
			],
		];
	}

}