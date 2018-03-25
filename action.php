<?php
session_start();
$login=$_POST['login'];
if (isset($_POST['login'])){
$_SESSION['login']=$login;}
$password=$_POST['password'];

$dom_xml= new DomDocument();
$dom_xml->load("db.xml");
$xpath = new DOMXPath($dom_xml);

$users_count = $dom_xml->getElementsByTagName('users')->item(0);
$count = 'count(user/usname[. = "'.$_SESSION['login'].'"])';
$entries = $xpath->evaluate($count, $users_count);

$users = $xpath->query("/users/user[usname='".$_SESSION['login']."']/pass");
$ids = $xpath->query("/users/user[usname='".$_SESSION['login']."']/id");

if($entries!=0||isset($_SESSION['id'])){ //если есть пользователь с таким именем существует или в сессии уже хранится id
	
	foreach ($users as $us)
	{	
	   $usr=$us->nodeValue;				//получение значения имени пользователя
	   
		foreach ($ids as $id){
			$id=$id->nodeValue;			//получение значения id
		}
		   if(crypt($password, $usr) == $usr ||isset($_SESSION['id'])){//если введенные пароли равны или есть значение id в сессии
						
						$_SESSION['id']=$id;//запись id в переменную сессии
						$usnames = $xpath->query("/users/user[usname='".$_SESSION['login']."']/name");
						foreach ($usnames as $usname){
						$user_name=$usname->nodeValue;
						
						echo "Hello"." ".$user_name."!";
							}
							//перезапись логина в сесии 
						$logins = $xpath->query("/users/user[usname='".$_SESSION['login']."']/usname");
						foreach ($logins as $login){
						$login=$login->nodeValue;
						$_SESSION['login']=$login;
						
							}
			}
		else{
			echo "Пароль не верен";
		}
	}
}else{
	echo "Пользователя с таким логином не существует";
}

?>
