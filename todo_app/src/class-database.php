<?php
/**
 * Database
 *
 * @package TodoApp
 */

/**
 * Main database interface
 */
class Database {
	// 'db' is the Docker host alias.
	private const HOST    = 'db';
	private const DB_NAME = 'app';
	// Goes without saying, but don't do this in real life.
	private const USER     = 'root';
	private const PASSWORD = 'root';

	/**
	 * PDO connection
	 *
	 * @var PDO
	 */
	private $db;

	/**
	 * Constructor
	 */
	public function __construct() {
		// phpcs:disable
		$this->db = new PDO(
			'mysql:' . join(
				';',
				[
					'host=' . self::HOST,
					'dbname=' . self::DB_NAME,
					'charset=utf8mb4',
				]
			),
			self::USER,
			self::PASSWORD,
			[
				PDO::ATTR_CASE               => PDO::CASE_LOWER,
				PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
			]
		);
		// phpcs:enable
	}

	/**
	 * Add a to-do item.
	 *
	 * @param string $todo The to-do item to be added.
	 */
	public function add_todo( string $todo ): void {
		$this->db->prepare(
			'
			INSERT INTO todos (content)
			VALUES (?)
			'
		)->execute( [ $todo ] );
	}

	/**
	 * Sets the status of all `completed` items to `deleted`.
	 */
	public function clear_completed(): void {
		$this->db->exec(
			'
            UPDATE todos
               SET status = "deleted"
             WHERE status = "completed"
			'
		);
	}

	/**
	 * Mark item with given id deleted.
	 *
	 * @param int $id The id of the item.
	 */
	public function delete_todo( int $id ): void {
		$this->db->prepare(
			'
            UPDATE todos
               SET status = "deleted"
             WHERE id = ?
			'
		)->execute( [ $id ] );
	}

	/**
	 * Retrieve todos.
	 *
	 * @param string $status Only return todos with this status.
	 */
	public function get_todos( string $status = null ): array {
		if ( in_array( $status, [ 'active', 'completed', 'deleted' ], true ) ) {
			$stmt = $this->db->prepare(
				'
                SELECT *
                  FROM todos
                 WHERE status = ?
				 ORDER BY status ASC, created ASC
				'
			);
			$stmt->execute( [ $status ] );
		} else {
			$stmt = $this->db->query(
				'
				SELECT *
				  FROM todos
				 WHERE status != "deleted"
				 ORDER BY status ASC, created ASC
				'
			);
		}
		return $stmt->fetchAll();
	}

	/**
	 * Toggle status of a given item betwen 'active' and 'completed'
	 *
	 * @param int $id The id of the item.
	 */
	public function toggle_todo( int $id ): void {
		$this->db->prepare(
			'
			UPDATE todos
			   SET status = CASE WHEN status = "completed" THEN "active"
							ELSE "completed"
							END
			 WHERE id = ?
			'
		)->execute( [ $id ] );
	}
}

$db = new Database();
