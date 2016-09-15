<?php
/**
 * index.php
 *
 * @package     react
 * @subpackage  react
 * @author      Michael Smith
 * @since       1.0.0
 */

// Include config
require_once 'config/core.php';

// Include the head template
require_once 'layout_head.php';

// Placeholder for rendering react components
echo '<div id="content"></div>';

// Page footer
require_once 'layout_foot.php';