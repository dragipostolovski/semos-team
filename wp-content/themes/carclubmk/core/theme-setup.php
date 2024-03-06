<?php

require_once 'after-setup-theme.php';

foreach ( glob( get_template_directory() . '/core/post-types/*.php' ) as $filename ) {
	require_once $filename;
}

// foreach ( glob( get_template_directory() . '/core/classes/*.php' ) as $filename ) {
// 	require_once $filename;
// }

require_once '../sections/stefan-v1.php';

foreach ( glob( get_template_directory() . '/core/tasks/stefan.php' ) as $filename ) {
	require_once $filename;
}

require_once 'tasks/stefan.php';