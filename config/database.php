<?php
/**
 * database.php
 *
 * @package     react
 * @subpackage  react
 * @author      Michael Smith
 * @since       1.0.0
 */

class Database {
    // Database credentials - replace with your own credentials
    private $host       = 'localhost';
    private $db_name    = 'php_react_crud';
    private $username   = '';
    private $password   = '';

    // Holds the database connection
    public $connection;

    /**
     * Gets the connection to the database
     *
     * @author  Michael Smith
     * @since   1.0.0
     *
     * @return  null|PDO
     */
    public function get_connection() {
        $this->connection = null;

        try {
            $this->connection = new PDO( 'mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password );
        } catch( PDOException $exception ) {
            echo 'Connection error: ' . $exception->getMessage();
        }

        return $this->connection;
    }
}