<?php
/**
 * This file is an entry point for the annotations library.
 *
 * It includes all necessary classes, and also initializes some global constants.
 *
 * @author Dmitry Bedrin mailto:bedrin@msn.com
 * @since PHP 5.1.0
 */

if (version_compare(phpversion(),'5.1.0') < 0) {
    user_error('PHP version 5.1.0 or higher is required for annotations library', E_USER_ERROR);
}

define('ANNOTATIONS_LIBRARY', true);
define('ANNOTATIONS_LIBRARY_DIR', dirname(__FILE__));

include_once(ANNOTATIONS_LIBRARY_DIR . '/AnnotatedClass.php');
?>