<?php

    if ($_SERVER ["REQUEST_METHOD"] == "POST")
    {
        if(empty($_POST["username"])||empty($_POST["email"])||empty($_POST["phone"]))
        {
			header('location:errors.php');
        }
        else
        {
			$username = $_POST["username"];
			$email = $_POST["email"];
			$phone = $_POST["phone"];
			
			$link = mysqli_connect("localhost", "root", "","orders"); //второй параметр имя пользователя, root - стандратное, и последним - имя базы данных, в которой находится эта таблица.
			// print_r( $link );
			//echo mysql_error();
						
			//add to mysql
			$str = "INSERT INTO `phoneorders` (`name`, `email`, `phone`) VALUES ('".$username."', '".$email."', '".$phone."')";
			mysqli_query($link, $str );
			
			//send mail
			$messege = 'Hello dear ' . $_POST["username"] . ' Your order is accepted. In the near future our employee will contact you';
			
			$headers =  'MIME-Version: 1.0' . "\r\n"; 
			$headers .= 'From: Your name <vsatd1@gmail.com>' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
			mail($_POST["email"], "Phone order for " . $_POST["username"], $messege, $headers);
			
			//redirect
			header('location:success.php');
		}
	}
?>