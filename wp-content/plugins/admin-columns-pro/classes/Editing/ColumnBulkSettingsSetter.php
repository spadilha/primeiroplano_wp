<?php

namespace ACP\Editing;

use AC\Column;
use ACP\Editing\Model\Disabled;

class ColumnBulkSettingsSetter {

	public function register( Column $column ) {
		if ( ! $column instanceof Editable ) {
			return;
		}

		$service = $column->editing();

		if ( ! $service || $column->get_setting( Settings\BulkEditing::NAME ) ) {
			return;
		}

		// legacy
		if ( $service instanceof Disabled ) {
			return;
		}

		if ( $service->get_view( Service::CONTEXT_BULK ) === false ) {
			return;
		}

		$column->add_setting( new Settings\BulkEditing( $column ) );
	}

}