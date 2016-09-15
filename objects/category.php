<?php
/**
 * category.php
 *
 * @package     react
 * @subpackage  react
 * @author      Michael Smith
 * @since       1.0.0
 */

/**
 * Class Category
 *
 * DataModel class for building the category object.
 *
 * @author  Michael Smith
 * @since   1.0.0
 */
class Category {
    // Private class properties
    private $connection;                    // Holds the database connection
    private $table_name = 'categories';     // Holds the table name for categories

    // Public class properties
    public $id;
    public $name;

    /**
     * Category constructor.
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
     * Reads all of the categories from the database, returns list in JSON format.
     *
     * @author  Michael Smith
     * @since   1.0.0
     *
     * @return  string
     */
    public function readAll() {
        // Select the data
        $query  = 'SELECT id, name FROM ' . $this->table_name . ' ORDER BY name';

        $stmt   = $this->connection->prepare( $query );
        $stmt->execute();

        $categories = $stmt->fetchAll( PDO::FETCH_ASSOC );

        return json_encode( $categories );
    }
}