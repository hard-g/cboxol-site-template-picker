<?php
/**
 * Plugin Name: CBOXOL Site Template Picker
 * Description: @todo
 * Author:      OpenLab
 * Author URI:  https://openlab.bmcc.cuny.edu/
 * Plugin URI:  https://openlab.bmcc.cuny.edu/
 * Version:     1.0.0
 * License:     GPL-2.0-or-later
 * Text Domain: cboxol-site-template-picker
 * Domain Path: /languages
 */

namespace CBOX\OL\SiteTemplatePicker;

const VERSION   = '1.0.0';
const ROOT_DIR  = __DIR__;
const ROOT_FILE = __FILE__;

require_once ROOT_DIR . '/inc/functions.php';
require_once ROOT_DIR . '/inc/rest.php';
require_once ROOT_DIR . '/inc/post-type.php';
require_once ROOT_DIR . '/inc/taxonomy.php';
require_once ROOT_DIR . '/inc/groups.php';
require_once ROOT_DIR . '/inc/sites.php';
