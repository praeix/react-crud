<?php
/**
 * product.php
 *
 * @package     react
 * @subpackage  react
 * @author      Michael Smith
 * @since       1.0.0
 */

/**
 * Class Product
 *
 * DataModel class for building the product object.
 *
 * @author  Michael Smith
 * @since   1.0.0
 */
class Product {
    // Private class properties
    private $connection;                // Holds the database connection
    private $table_name = 'products';   // Holds the table name for products

    // Public class properties
    public $id;
    public $name;
    public $price;
    public $description;
    public $category_id;
    public $timestamp;

    /**
     * Product constructor.
     *
     * @author  Michael Smith
     * @since   1.0.0
     *
     * @param   $db
     */
    public function __construct( $db ) {
        $this->connection = $db;
    }

    /**
     * Create a product via form input, sanitize and insert into database.
     *
     * @author  Michael Smith
     * @since   1.0.0
     *
     * @return  bool
     */
    public function create() {
        try {
            // Insert query
            $query = 'INSERT INTO products
                SET name=:name, description=:description, price=:price, category_id=:category_id, created=:created';

            // Prepare query for execution
            $stmt = $this->connection->prepare( $query );

            // Sanitize
            $name           = htmlspecialchars( strip_tags( $this->name ) );
            $description    = htmlspecialchars( strip_tags( $this->description ) );
            $price          = htmlspecialchars( strip_tags( $this->price ) );
            $category_id    = htmlspecialchars( strip_tags( $this->category_id ) );

            // Bind the params
            $stmt->bindParam( ':name', $name );
            $stmt->bindParam( ':description', $description );
            $stmt->bindParam( ':price', $price );
            $stmt->bindParam( ':category_id', $category_id );

            // Create the timestamp
            $created = date( 'Y-m-d H:i:s' );
            $stmt->bindParam( ':created', $created );

            // Execute the query
            if ( $stmt->execute() ) {
                return true;
            } else {
                return false;
            }
        } catch ( PDOException $exception ) {
            die( 'ERROR: ' . $exception->getMessage() );
        }
    }

    /**
     * Reads all of the products from the database and returns in JSON format.
     *
     * @author  Michael Smith
     * @since   1.0.0
     *
     * @return  string
     */
    public function readAll() {
        // Select the data
        $query  = 'SELECT p.*, c.name as category_name 
                    FROM ' . $this->table_name . ' p LEFT JOIN categories c ON p.category_id=c.id 
                    ORDER BY name ASC';

        $stmt   = $this->connection->prepare( $query );
        $stmt->execute();

        $results = $stmt->fetchAll( PDO::FETCH_ASSOC );

        return json_encode( $results );
    }

    /**
     * Reads a single product from the database based on the given product ID and returns in JSON format.
     *
     * @author  Michael Smith
     * @since   1.0.0
     *
     * @return  string
     */
    public function readOne() {
        // Select one record
        $query  = 'SELECT p.id, p.name, p.description, p.price, p.category_id, c.name as category_name
                    FROM ' . $this->table_name . ' p LEFT JOIN categories c ON p.category_id=c.id
                    WHERE p.id=:id';

        // Prepare query
        $stmt   = $this->connection->prepare( $query );

        $id     = htmlspecialchars( strip_tags( $this->id ) );
        $stmt->bindParam( ':id', $id );
        $stmt->execute();

        $results = $stmt->fetchAll( PDO::FETCH_ASSOC );

        return json_encode( $results );
    }

    /**
     * Updates the product record based on given form data. Returns true/false on query execution results.
     *
     * @author  Michael Smith
     * @since   1.0.0
     *
     * @return  bool
     */
    public function update() {
        $query  = 'UPDATE products
                    SET name=:name, description=:description, price=:price, category_id=:category_id
                    WHERE id=:id';

        // Prepare
        $stmt   = $this->connection->prepare( $query );

        // Sanitize
        $name           = htmlspecialchars( strip_tags( $this->name ) );
        $description    = htmlspecialchars( strip_tags( $this->description ) );
        $price          = htmlspecialchars( strip_tags( $this->price ) );
        $category_id    = htmlspecialchars( strip_tags( $this->category_id ) );
        $id             = htmlspecialchars( strip_tags( $this->id ) );

        // Bind params
        $stmt->bindParam( ':name', $name );
        $stmt->bindParam( ':description', $description );
        $stmt->bindParam( ':price', $price );
        $stmt->bindParam( ':category_id', $category_id );
        $stmt->bindParam( ':id', $id );

        // Execute
        if ( $stmt->execute() ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Deletes a product record from given ID(s). Returns true/false on query execution results.
     *
     * @author  Michael Smith
     * @since   1.0.0
     *
     * @param   $ins
     *
     * @return  bool
     */
    public function delete( $ins ) {
        // Query to delete multiple records
        $query = 'DELETE FROM products WHERE id IN (:ins)';

        $stmt   = $this->connection->prepare( $query );

        // Sanitize
        $ins    = htmlspecialchars( strip_tags( $ins ) );

        // Bind the params
        $stmt->bindParam( ':ins', $ins );

        if ( $stmt->execute() ) {
            return true;
        } else {
            return false;
        }
    }
}