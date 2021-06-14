<?php

	// SET MANY VARIABLES WITH META DATA OF THE CURRENT EDITION OR LAST EDITION
	global $thiseditionid, $lasteditionid, $editioslug, $editioname, $pdflink, $editionLink;


	$lasteditionid = get_field('ultima_edicao', 'options');

	$edicoes = get_the_terms($post->ID, 'edicao');

	// GET THE LAST EDITION TAXONOMY ID TO GET THE HEADER'S STYLES AND LOGOS
	// IF IS A SINGLE OR TAXONOMY ARCHIVE PAGE WE GET IT'S EDITION, OTHERWISE WE GET THE LAST EDITION.

	// GET CURRENT EDITION ID
	if($post && $edicoes) {

		foreach ($edicoes as $edicao) {
			$thiseditionid = $edicao->term_id;
			$editioslug = $edicao->slug;
			$editioname = $edicao->name;
		}

	}
	else {

		$thiseditionid = $lasteditionid;

		$edicao = get_term_by('id', $thiseditionid, 'edicao');

		$editioslug = $edicao->slug;
		$editioname = $edicao->name;
	}



	// GET HEADER STYLES AND LOGOS
	$pdflink = get_field('pdf_link', 'edicao_' . $thiseditionid);
	$editionLink = get_term_link( $editioslug, 'edicao' );

?>
