<?php
/**
 * delete_products.php
 *
 * @package     react
 * @subpackage  react
 * @author      Michael Smith
 * @since       1.0.0
 */

// If the form was submitted
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
    $product    = new Product($db);

    $ins = '';
    foreach ( $_POST['del_ids'] as $id ) {
        $ins .= $id . ', ';
    }

    $ins = trim( $ins, ',' );

    // Delete the product
    echo $product->delete( $ins ) ? 'true' : 'false';
}