<?php
/**
 * read_all_categories.php
 *
 * @package     react
 * @subpackage  react
 * @author      Michael Smith
 * @since       1.0.0
 */

// Include core config
require_once '../config/core.php';

// Include database connection
require_once '../config/database.php';

// Product object
require_once '../objects/category.php';

// Class instance
$database   = new Database();
$db         = $database->get_connection();
$category   = new Category( $db );

// Read all products
$results    = $category->readAll();

// Output
echo $results;