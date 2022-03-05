<?php 
session_start();
include("connection.php");
include("functions.php");

include("patients.php"); // I need to first include the patients.php so i can access the id of the user. 

	class minpath	{
		private $id;
		private $name;
		private $address;
		private $lat;
		private $lng;
		private $conn;
		private $tableName = "patients";

		function setId($id) { $this->id = $id; }
		function getId() { return $this->id; }
		function setName($name) { $this->name = $name; }
		function getName() { return $this-name; }
		function setAddress($address) { $this->Postcode = $address; }
		function getAddress() { return $this->Postcode; }

		function setLat($lat) { $this->lat = $lat; }
		function getLat() { return $this->lat; }
		function setLng($lng) { $this->lng = $lng; }
		function getLng() { return $this->lng; }

		public function __construct() {
			require_once('db/DbConnect.php');
			$conn = new DbConnect;
			$this->conn = $conn->connect();
		}

		public function getPatientDetailBlankLatLng() {

			$sql = "SELECT id, Patient_name, Postcode FROM $this->tableName WHERE lat IS NULL AND lng IS NULL";
			$stmt = $this->conn->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}

		public function updatePatientDetailsWithLatLng()
		{	
			$sql = "UPDATE $this->tableName SET lat =:lat, lng =:lng WHERE id =:id"; // This is called a prepared statement as I havent got any data to actually put in, instead I have said when i get the lat (=:lat), then put in this sql query 

			$stmt = $this->conn->prepare($sql);
			$stmt->bindParam(':lat', $this->lat); // this is letting sql know that instead of :lat put the value that was fetched from the current object
			$stmt->bindParam(':lng', $this->lng);
			$stmt->bindParam(':id', $this->id);
			
			if($stmt->execute()) {
				return true;
			} else {
				return false;
			}

		}

		public function getAllPatientDetail() {
			

			$sql = "SELECT * FROM $this->tableName WHERE Assign = '".$_SESSION["assignedId"]."' "; 
			// here it will only get the patients thhat are assigned to get the 

			$stmt = $this->conn->prepare($sql);
			$stmt-> execute();
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
    }
	#WHERE Assign = '".$user_data["id"]."'
	//$user_data = check_login($con);
	//$sql = "SELECT * FROM $this->tableName WHERE Assign = '".$user_data["id"]."' ";

?>


