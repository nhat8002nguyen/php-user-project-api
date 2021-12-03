<?php
	class User {
		private $connect;
		private $table = 'users';

		public $id;
		public $address;
		public $avatar;
		public $banner;
		public $email;
		public $fullName;
		public $role;
		public $created_at;

		// Constructor with DB
		public function __construct($db)
		{
			$this->connect = $db;	
		}

		// Get Users
		public function read() {
				// Create query
				$query = 	'SELECT u.id, u.address, u.avatar, u.banner, u.email, u.fullName, u.role, u.created_at
							FROM ' . $this->table . ' u
							ORDER BY u.created_at DESC';

				$stmt = $this->connect->prepare($query);
				$stmt->execute();
				
				return $stmt;
		}

		// Get Single Post
		public function read_single() {
				// Create query
				$query = 'SELECT u.id, u.address, u.avatar, u.banner, u.email, u.fullName, u.role, u.created_at,
									FROM ' . $this->table . 'u
									WHERE u.id = ?
									LIMIT 0,1';

				$stmt = $this->connect->prepare($query);
				$stmt->bindParam(1, $this->id);
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_ASSOC);

				$this->address = $row['address'];
				$this->avatar = $row['avatar'];
				$this->banner = $row['banner'];
				$this->email = $row['email'];
				$this->fullName = $row['fullName'];
				$this->role = $row['role'];
				$this->created_at = $row['created_at'];
		}

		public function create() {
			$query = 'INSERT INTO ' . $this->table . '(address, avatar, banner, email, fullName, role, created_at) 
								VALUES(:address, :avatar, :banner, :email, :fullName, :role, :created_at)';


			$statement = $this->connect->prepare($query);

			// clean current data of class properties
			$this->address = htmlspecialchars(strip_tags($this->address));
			$this->avatar = htmlspecialchars(strip_tags($this->avatar));
			$this->banner = htmlspecialchars(strip_tags($this->banner));
			$this->email = htmlspecialchars(strip_tags($this->email));
			$this->fullName = htmlspecialchars(strip_tags($this->fullName));
			$this->role = htmlspecialchars(strip_tags($this->role));
			$this->created_at = htmlspecialchars(strip_tags($this->created_at));

			$statement->bindParam(':address', $this->address);
			$statement->bindParam(':avatar', $this->avatar);
			$statement->bindParam(':banner', $this->banner);
			$statement->bindParam(':email', $this->email);
			$statement->bindParam(':fullName', $this->fullName);
			$statement->bindParam(':role', $this->role);
			$statement->bindParam(':created_at', $this->created_at);

			if ($statement->execute()) {
				return true;
			}

			printf("Error %s.\n", $statement->error);
		}

		public function update() {
			$query = 'UPDATE ' . $this->table . '
				SET address = :address, avatar = :avatar, banner = :banner, email = :email, fullName = :fullName, role = :role
				WHERE id = :id';

			$statement = $this->connect->prepare($query);

			$this->address = htmlspecialchars(strip_tags($this->address));
			$this->avatar = htmlspecialchars(strip_tags($this->avatar));
			$this->banner = htmlspecialchars(strip_tags($this->banner));
			$this->email = htmlspecialchars(strip_tags($this->email));
			$this->fullName = htmlspecialchars(strip_tags($this->fullName));
			$this->role = htmlspecialchars(strip_tags($this->role));
			$this->id = htmlspecialchars(strip_tags($this->id));

			$statement->bindParam(':address', $this->address);
			$statement->bindParam(':avatar', $this->avatar);
			$statement->bindParam(':banner', $this->banner);
			$statement->bindParam(':email', $this->email);
			$statement->bindParam(':fullName', $this->fullName);
			$statement->bindParam(':role', $this->role);
			$statement->bindParam(':id', $this->id);
			
			// Execute query
			if($statement->execute()) {
				return true;
			}
			// Print error if something goes wrong
			printf("Error: %s.\n", $statement->error);

			return false;
		}

		// Delete Post
    public function delete() {
				// Create query
				$query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

				// Prepare statement
				$stmt = $this->connect->prepare($query);

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