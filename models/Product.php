<?php
	class Product {
		private $connect;
		private $table = 'products';

		public $id;
		public $brand;
		public $date_added;
		public $description;
		public $image;
		public $is_featured;
		public $is_recommended;
		public $max_quantity;
		public $name;
		public $name_lower;
		public $price;
		public $quantity;


		public function __construct($db) {
			$this->connect = $db;
		}

		// Get Users
		public function read() {
				// Create query
				$query = 'SELECT p.id, p.brand, p.date_added, p.description, p.image, p.is_featured, p.is_recommended, 
									p.max_quanity, p.name, p.name_lower, p.price, p.quanity, p.created_at
									FROM ' . $this->table . 'p
									ORDER BY p.date_added DESC';

				$stmt = $this->connect->prepare($query);
				$stmt->execute();
				
				return $stmt;
		}

		// Get Single Post
		public function read_single() {
				// Create query
				$query = 'SELECT p.brand, p.date_added, p.description, p.image, p.is_featured, p.is_recommended, 
									p.max_quanity, p.name, p.name_lower, p.price, p.quanity, p.created_at
									FROM ' . $this->table . 'p
									ORDER BY p.date_added DESC
									WHERE p.id = :id
									LIMIT 0,1';

				$stmt = $this->connect->prepare($query);
				$stmt->bindParam(1, $this->id);
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_ASSOC);

				$this->brand = $row['id'];
				$this->date_added = $row['date_added'];
				$this->description = $row['description'];
				$this->image = $row['image'];
				$this->is_featured = $row['is_featured'];
				$this->is_recommended = $row['is_recommended'];
				$this->max_quantity = $row['max_quantity'];
				$this->name = $row['name'];
				$this->name_lower = $row['name_lower'];
				$this->price = $row['price'];
				$this->quantity = $row['quanity'];
				$this->created_at = $row['created_at'];
		}

		public function create() {
			$query = 'INSERT INTO ' . $this->table . '(brand, date_added, description, image, is_featured, is_recommended, 
								max_quanity, name, name_lower, price, quanity, created_at) 
								VALUES(:brand, :date_added, :description, :image, :is_featured, :is_recommended, :max_quanity, :name, 
								:name_lower, :price, :quanity, :created_at)';


			$statement = $this->connect->prepare($query);

			// clean current data of class properties
			$this->brand = htmlspecialchars(strip_tags($this->brand));
			$this->date_added = htmlspecialchars(strip_tags($this->date_added));
			$this->description = htmlspecialchars(strip_tags($this->description));
			$this->image = htmlspecialchars(strip_tags($this->image));
			$this->is_featured = htmlspecialchars(strip_tags($this->is_featured));
			$this->is_recommended = htmlspecialchars(strip_tags($this->is_recommended));
			$this->max_quantity = htmlspecialchars(strip_tags($this->max_quantity));
			$this->name = htmlspecialchars(strip_tags($this->name));
			$this->name_lower = htmlspecialchars(strip_tags($this->name_lower));
			$this->price = htmlspecialchars(strip_tags($this->price));
			$this->quanity = htmlspecialchars(strip_tags($this->quanity));
			$this->created_at = htmlspecialchars(strip_tags($this->created_at));

			$statement->bindParams(':brand', $this->brand);
			$statement->bindParams(':date_added', $this->date_added);
			$statement->bindParams(':description', $this->description);
			$statement->bindParams(':image', $this->image);
			$statement->bindParams(':is_featured', $this->is_featured);
			$statement->bindParams(':is_recommended', $this->is_recommended);
			$statement->bindParams(':max_quanity', $this->max_quanity);
			$statement->bindParams(':name', $this->name);
			$statement->bindParams(':name_lower', $this->name);
			$statement->bindParams(':price', $this->name);
			$statement->bindParams(':quanity', $this->name);
			$statement->bindParams(':create_at', $this->name);

			if ($statement->execute()) {
				return true;
			}

			printf("Error %s.\n", $statement->error);
		}

		public function update() {
			$query = 'UPDATE TABLE ' . $this->table . '
				SET address = :address, avatar = :avatar, banner = :banner, email = :email, fullName = :fullName, role = :role,
				created_at = :created_at, updated_at = :updated_at
				WHERE id = :id';

			$statement = $this->connect->prepare($query);

			// clean current data of class properties
			$this->brand = htmlspecialchars(strip_tags($this->brand));
			$this->date_added = htmlspecialchars(strip_tags($this->date_added));
			$this->description = htmlspecialchars(strip_tags($this->description));
			$this->image = htmlspecialchars(strip_tags($this->image));
			$this->is_featured = htmlspecialchars(strip_tags($this->is_featured));
			$this->is_recommended = htmlspecialchars(strip_tags($this->is_recommended));
			$this->max_quantity = htmlspecialchars(strip_tags($this->max_quantity));
			$this->name = htmlspecialchars(strip_tags($this->name));
			$this->name_lower = htmlspecialchars(strip_tags($this->name_lower));
			$this->price = htmlspecialchars(strip_tags($this->price));
			$this->quanity = htmlspecialchars(strip_tags($this->quanity));
			$this->created_at = htmlspecialchars(strip_tags($this->created_at));

			$statement->bindParams(':brand', $this->brand);
			$statement->bindParams(':date_added', $this->date_added);
			$statement->bindParams(':description', $this->description);
			$statement->bindParams(':image', $this->image);
			$statement->bindParams(':is_featured', $this->is_featured);
			$statement->bindParams(':is_recommended', $this->is_recommended);
			$statement->bindParams(':max_quanity', $this->max_quanity);
			$statement->bindParams(':name', $this->name);
			$statement->bindParams(':name_lower', $this->name);
			$statement->bindParams(':price', $this->name);
			$statement->bindParams(':quanity', $this->name);
			$statement->bindParams(':create_at', $this->name);

			if ($statement->execute()) {
				return true;
			}

			printf("Error %s.\n", $statement->error);
		
		}

		// Delete Post
    public function delete() {
				// Create query
				$query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

				// Prepare statement
				$stmt = $this->conn->prepare($query);

				// Clean data
				$this->id = htmlspecialchars(strip_tags($this->id));

				// Bind data
				$stmt->bindParam(':id', $this->id);

				// Execute query
				if($stmt->execute()) {
					return true;
				}

				// Print error if something goes wrong
				printf("Error: %s.\n", $stmt->error);

				return false;
    }
	}