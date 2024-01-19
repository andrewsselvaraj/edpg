<?php
session_start(); 
include('election_db_connect/election_db_connect.php'); 
if(isset($_POST['submit']))
{

    $user_name=$_POST['user_name'];
	$user_password=$_POST['user_password'];
	//$only_admin_access = "Admin";

	$result=mysqli_query($conn, 'SELECT * from election_users where election_user_name="'.$user_name.'" AND election_user_password="'.$user_password.'" AND election_user_role="Admin" AND election_user_status="A"');
	if(mysqli_num_rows($result)==1)
	{
			$_SESSION['login_election_user_name']="$user_name";
            
			echo "<h1>Redirecting...Please Wait..!</h1>";
            //echo "<script>alert('Login Successful..!')</script>";
<<<<<<< HEAD
		   	echo "<script>location.href='thiruvanandhapuram.php'</script>";
						     
=======

		   	echo "<script>location.href='coimbatore.php'</script>";

>>>>>>> 3a89cd1bacade0dde2fa5e1f4b65494b0e8298fc

	}
	else {
		echo "<script>alert('Username or password is incorrect!')</script>";
		echo "<script>location.href='index.php'</script>";

	}
	
}
	
?>