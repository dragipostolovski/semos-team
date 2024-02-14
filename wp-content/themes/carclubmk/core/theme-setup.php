<?php

<<<<<<< HEAD
=======
require_once 'after-setup-theme.php';

>>>>>>> ffa1ff69d9e7283fd3272d58992c0b7a10b96fe7
foreach ( glob( get_template_directory() . '/core/classes/*.php' ) as $filename ) {
	require_once $filename;
}

foreach ( glob( get_template_directory() . '/core/post-types/*.php' ) as $filename ) {
	require_once $filename;
<<<<<<< HEAD
}

require_once 'after-setup-theme.php';
=======
}
>>>>>>> ffa1ff69d9e7283fd3272d58992c0b7a10b96fe7
