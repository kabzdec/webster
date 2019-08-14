<?php

require_once('class_connect.php');

class Task{
	private $comment;
	private $user;
	private $email;
	private $page;
	private $nums = 3;
	private $sort;

	function __construct($user=null,$email=null,$sometext=null,$page=1,$sort=null){
		$this->comment = $sometext;
		$this->user = $user;
		$this->email = $email;
		$this->page = $page;
		$this->sort = $sort;
	}

	public function addToBase(){
		$conn = new Connect();
		$conn->connect();
			$add = $conn->pdo->prepare("INSERT INTO users(user,email,comment) VALUES (?,?,?)");
			$conn->closeConnect();
			$sql = $add->execute(array($this->user,$this->email,$this->comment));
		if ($sql){
			return true;
		} else return false;
	}

	public function showComments(){
		$conn = new Connect();
		$conn->connect();
		$next = ($this->page - 1) * $this->nums;
		if (isset($this->sort)){
			$sql = 'SELECT id,user,email,comment,cheked FROM users ORDER BY '.$this->sort.' DESC LIMIT '.$next.','.$this->nums.' ';	
		} else {
	 $sql = 'SELECT id,user,email,comment,cheked FROM users LIMIT '.$next.','.$this->nums.'';
	}
			foreach($conn->pdo->query($sql) as $row){
				if (isset($_SESSION['admin'])){
					print_r($row['user']."<br>".$row['email']."<br>");
					print_r("<form method='POST'>".
						"<input type='text' name='comment' value='".$row['comment']."' class='input'>&nbsp;
						<input type='hidden' name='id' value='".$row['id']."'>
						<button type='submit' class='btn btn-outline-primary'>редактировать</button>
						</form><br>");
						
					if ($_SERVER['REQUEST_METHOD'] == 'POST'){
						$sql2 = 'UPDATE users SET comment="'.$_POST['comment'].'", cheked = "1" WHERE id ="'.$_POST['id'].'"';
						$do = $conn->pdo->exec($sql2);
						header("Location: ".$_SERVER['PHP_SELF']);
					}		
				} else if ($row['cheked'] == 1){
					print_r($row['user']."<br>".$row['email']."<br>".$row['comment']."<br><span class='badge badge-success'>Проверено администратором</span><br><br>");	
			} else print_r($row['user']."<br>".$row['email']."<br>".$row['comment']."<br><br>");
		
		}
		$conn->closeConnect();
	}
		public function numPages(){
		$conn = new Connect();
		$conn->connect();
		$sql3 = 'SELECT COUNT(*) as count FROM users';
				foreach ($conn->pdo->query($sql3) as $do){
					$cnt = $do['count'];
				}
				$listPage = ceil($cnt / $this->nums);
				for ($i=1;$i<=$listPage;$i++){
					 if (isset($this->sort) && isset($this->page)){
						if ($this->page == $i){
						echo "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"./?page=".$i."&sort=".$this->sort." \">".$i."</a></li>";
						} else echo "<li class=\"page-item\"><a class=\"page-link\" href=\"./?page=".$i."&sort=".$this->sort." \">".$i."</a></li>";
					} else 
						if ($this->page == $i){
					echo "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"./?page=".$i." \">".$i."</a></li>";
						} else {
					echo "<li class=\"page-item\"><a class=\"page-link\" href=\"./?page=".$i." \">".$i."</a></li>";
						}
				}
		$conn->closeConnect();
			}
}
			