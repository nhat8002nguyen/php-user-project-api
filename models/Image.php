<?php 
  class Image {
    private $conn;
    private $table = 'Images';

    public $id;
	public $url;
    public $product_id;
	public $created_at;

    public function __construct($db) {
      $this->conn = $db;
    }

    public function read() {
      $query = 'SELECT i.url, i.product_id, i.created_at
				FROM ' . $this->table . ' i
				ORDER BY
					i.created_at DESC';
      
      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }

    public function read_single() {
		$query = 'SELECT i.url, i.product_id, i.created_at
				FROM ' . $this->table . ' i
				WHERE p.id = ?  LIMIT 0,1';

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(1, $this->id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->url = $row['url'];
		$this->product_id = $row['product_id'];
		$this->created_at = $row['created_at'];
    }

    public function create() {
          $query = 'INSERT INTO ' . $this->table . ' SET url = :url, product_id = :product_id, created_at = :created_at';
          $stmt = $this->conn->prepare($query);

          $this->url = htmlspecialchars(strip_tags($this->title));
          $this->product_id = htmlspecialchars(strip_tags($this->product_id));
          $this->created_at = htmlspecialchars(strip_tags($this->created_at));

          $stmt->bindParam(':url', $this->url);
          $stmt->bindParam(':product_id', $this->product_id);
          $stmt->bindParam(':created_at', $this->created_at);

          if($stmt->execute()) {
            return true;
      }
      printf("Error: %s.\n", $stmt->error);

      return false;
    }

    public function update() {
		$query = 'UPDATE ' . $this->table . '
							SET url = :url, product_id = :product_id, created_at = :created_at
							WHERE id = :id';

		$stmt = $this->conn->prepare($query);

		$this->id = htmlspecialchars(strip_tags($this->id));
		$this->url = htmlspecialchars(strip_tags($this->url));
		$this->product_id = htmlspecialchars(strip_tags($this->product_id));

		$stmt->bindParam(':url', $this->url);
		$stmt->bindParam(':product_id', $this->product_id);
		$stmt->bindParam(':id', $this->id);

		if($stmt->execute()) {
		return true;
		}
		printf("Error: %s.\n", $stmt->error);
		return false;
    }

    public function delete() {
		$query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
		$stmt = $this->conn->prepare($query);
		$this->id = htmlspecialchars(strip_tags($this->id));
		$stmt->bindParam(':id', $this->id);
		if($stmt->execute()) {
			return true;
		}
		printf("Error: %s.\n", $stmt->error);
		return false;
    }
  }