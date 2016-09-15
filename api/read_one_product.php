<?php
/**
 * read_one_product.php
 *
 * @package     react
 * @subpackage  react
 * @author      Michael Smith
 * @since       1.0.0
 */

// Include core config
require_once '../config/core.php';

// Include database
require_once '../config/database.php';

// Product object
require_once '../objects/product.php';

// Class instance
$database       = new Database();
$db             = $database->get_connection();
$product        = new Product( $db );

// Read all products
$product->id    = $_POST['prod_id'];
$results        = $product->readOne();

// Output
echo $results;