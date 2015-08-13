<?php 
session_start();
require_once('models/User.php');
require_once('models/Ambassador.php');

$baseURL = "http://edg.co.in";

if(isset($_POST['email']) && isset($_POST['password'])){
	$email = $_POST['email'];
	$password = $_POST['password'];
	$results = User::login($email, $password);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edge 15 | Admin Panel</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>	</head>
	<body>
		<style>
			nav{
				background: #A1C2FF;
			}
			a{
				color: black;
			}
		</style>
		<nav class="navbar">
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="#">Events</a></li>
					<li><a href="#ambassador">Ambassador</a></li>
				</ul>
				<?php
				if(isset($_SESSION['data']))
					echo '<ul class="nav navbar-nav navbar-right"><li><a>Welcome, '.$_SESSION['data']['name'].'</a></li></ul>';
				else
					echo'
				<form role="form" class="navbar-form navbar-right" action="panel.php" method="POST">
					<div class="form-group">
						<input type="email" name="email" class="form-control" placeholder="Email Address">
					</div>
					<div class="form-group">
						<input type="password" name="password" class="form-control" placeholder="Password">
					</div>
					<button class="btn btn-default" type="submit">Login</button>
				</form>'
				?>
			</div>
		</nav>
		<div class="container">
			<div id="ambassador" style="max-height: 450px!important; overflow-y: scroll; overflow-x: hidden">
				<?php
				if(isset($_SESSION['data'])){
					$ambassadors=Ambassador::getAllDetails();
					echo "<h1 class='page-header'> Ambassador Details </h1>";

					echo '<div role="tabpanel"> <ul class="nav nav-tabs" role="tablist" id="options_ambassador"><li role="presentation" class="active"><a href="#view" aria-controls="view" role="tab" data-toggle="tab">View All Ambassadors</a></li>
					<li role="presentation"><a href="#add" aria-controls="add" role="tab" data-toggle="tab">Add a new ambassador</a></li>
				</ul>';	

				echo'<div class="tab-content"><div role="tabpanel" class="tab-pane active" id="view">';
				echo "<table class='table table-striped'><tr><th>ID</th><th>Name</th><th>Year</th><th>College</th><th>Email</th><th>Contact</th><th>Downloads</th></tr>";
				foreach ($ambassadors as $ambassador) {
					echo "<tr><td>".$ambassador['id']."</td><td>".$ambassador['name']."</td><td>".$ambassador['year']."</td><td>".$ambassador['college']."</td><td>".$ambassador['email']."</td><td>".$ambassador['contact']."</td><td>".$ambassador['line_hits']."</td></tr>";
				}
				echo "</table>";
				echo'</div><div role="tabpanel" class="tab-pane" id="add">';

				echo '<form role="form" method="POST" style="width: 50%">
				<div class="form-group"><input type="text" id="name" name="name" class="form-control" placeholder="Name"></div>
				<div class="form-group"><input type="email" id="email" name="email" class="form-control" placeholder="Email Address">
				</div>
				<label>Year</label>
				<select id="year"><option value="1">1st Year</option><option value="2">2nd Year</option><option value="3">3rd Year</option><option value="4">4th Year</option></select>
				<div class="form-group"><input type="text" id="college" name="college" class="form-control" placeholder="College"></div>
				<div class="form-group"><input type="text" id="department" name="department" class="form-control" placeholder="Department"></div>
				<div class="form-group"><input type="text" id="contact" name="contact" class="form-control" placeholder="Contact"></div>

				<button class="btn btn-primary" type="submit" id="register" data-action="add">Add ambassador</button>
			</form>
			<div id="response"></div>
			<script>
				function add(){
					var action = "add";
				    var name=$("#name").val();
				    var email=$("#email").val();
				    var college=$("#college").val();
				    var department=$("#department").val();
				    var contact=$("#contact").val();
				    var year=$("#year option:selected").val();
				    console.log(name,email,college,year);
				  	$.ajax({
						url: "models/Ambassador.php",
						type: "POST",
						data: {action:action, name:name, email:email, college:college, department:department, contact:contact, year:year},
						dataType: "json",
						success:function(reply){
							$("#name").val("");
							$("#email").val("");
							$("#college").val("");
							$("#department").val("");
							$("contact").val("");
							$("#response").html("Data inserted successfully");			
						},
						error:function(xhr, desc, err) {
							console.log(xhr);
							console.log("Desc :: "+desc+"\nError :: "+err);
						}
					});
				};
			

			$("#register").click(function(e){
				e.preventDefault();
				add();
			});

			</script>';

			echo'</div><div role="tabpanel" class="tab-pane" id="edit">';
			echo '<form role="form" method="POST" style="width:30%" class="navbar-form"><div class="form-group"><input type="text" class="form-control" name="id" placeholder="Enter id to edit"></div><button class="btn btn-primary">Get Details</button></form>';
			echo'</div></div>';

			echo'<script>
			$("#options_ambassador a:first").tab("show");
			$("#options_ambassador a:last").tab("show");
			$("#options_ambassador li:eq(1) a").tab("show");
		</script>';
	}
	?>
</div>
</div>		
</body>
</html>