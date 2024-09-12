<?php

return array(
	'enable_templating' => false, // twig template not works well!
	'lexer'             => array(
		'tag_comment'   => array( '{#', '#}' ),
		'tag_block'     => array( '{%', '%}' ),
		'tag_variable'  => array( '{{', '}}' ),
		'interpolation' => array( '#{', '}' ),
	),
);
