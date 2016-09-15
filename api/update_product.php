<?php
/**
 * update_product.php
 *
 * @package     react
 * @subpackage  react
 * @author      Michael Smith
 * @since       1.0.0
 */

// Handle form submit
if ( $_POST ) {
    // Include core config
    require_once '../config/core.php';

    // Include database
    require_once '../config/database.php';

    // Product object
    require_once '../objects/product.php';

    // Class instance
    $database   = new Database();
    $db         = $database->get_connection();
    $product    = new Product( $db );

    // New values
    $product->name          = $_POST['name'];
    $product->description   = $_POST['description'];
    $product->price         = $_POST['price'];
    $product->category_id   = $_POST['category_id'];
    $product->id            = $_POST['id'];

    // Update the product
    echo $product->update() ? 'true' : 'false';
}