<?php
/**
 * create_product.php
 *
 * @package     react
 * @subpackage  react
 * @author      Michael Smith
 * @since       1.0.0
 */

// If the form was submitted
if ( $_POST ) {
    // Include core configuration
    require_once '../config/core.php';

    // Include database connection
    require_once '../config/database.php';

    // Product object
    require_once '../objects/product.php';

    // Class instance
    $database   = new Database();
    $db         = $database->get_connection();
    $product    = new Product( $db );

    // Set product property values - sanitization occurs in $product->create()
    $product->name          = $_POST['name'];
    $product->price         = $_POST['price'];
    $product->description   = $_POST['description'];
    $product->category_id   = $_POST['category_id'];

    // Create the product
    echo $product->create() ? 'true' : 'false';
}