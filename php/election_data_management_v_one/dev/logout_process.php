<?php session_start(); 
if(isset($_SESSION['login_election_user_name']))
{
    
    
    session_destroy();
   
    echo "<h1>Logging you out...Please Wait..!</h1>";
    echo "<script>location.href='index.php'</script>";
   
    }
    else{
        session_destroy();
        echo "<h1>Logging you out...Please Wait..!</h1>";
        echo "<script>location.href='index.php'</script>";
     
     
}

?>