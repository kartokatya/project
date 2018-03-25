<?php
$name=$_POST['name'];
$login=$_POST['login'];
$password=$_POST['password'];
$twopassword=$_POST['twopassword'];
$mail=$_POST['mail'];
if($password==$twopassword){
	$passwoprdh = crypt($password); //хэширование и добавление соли
	
$dom_xml= new DomDocument();
$dom_xml->load("db.xml");
$xpath = new DOMXPath($dom_xml);

$users = $dom_xml->getElementsByTagName('users')->item(0);   //получение элементов в 'users'
$mails = 'count(user/mail[. = "'.$mail.'"])';
$entr_mail = $xpath->evaluate($mails, $users);

$query = 'count(user/usname[. = "'.$login.'"])';			// получение кол-ва эл-тов со значением usname=$login
$entries = $xpath->evaluate($query, $users);				// возвращает типизированный результата count

		if ($entries!=0){									//ecли элементы в 'users' существуют
			
			echo "Пользователь с таким именем уже существует";
		}
		elseif ($entr_mail!=0){
			echo "Пользователь с таким email уже существует";
		}
		else{
			
			$parent = $xpath->query ('//users');
			$next = $xpath->query ('//users/user');
			$count='count(user)';										//определение кол. зарег. пользователей
			$id = $xpath->evaluate($count, $users);
			$id++;														//значение id путем прирощения кол-ва
			$new_item = $dom_xml->createElement ('user');				//создание эл-та 'user'
			$new_id=$dom_xml->createElement ('id', $id);
			$new_usname = $dom_xml->createElement ('usname', $login);	//создание эл-та 'usname' со значением $login
			$new_pass = $dom_xml->createElement ('pass',$passwoprdh);
			$new_name = $dom_xml->createElement ('name', $name);
			$new_mail = $dom_xml->createElement ('mail', $mail);
			$new_item->appendChild ($new_id);							//добавление элемента в $new_item
			$new_item->appendChild ($new_usname);
			$new_item->appendChild ($new_pass);
			$new_item->appendChild ($new_name);
			$new_item->appendChild ($new_mail);
			$parent->item(0)->insertBefore($new_item, $next->item(0));	//запись $new_item первым
			
		$path="db.xml";
		$dom_xml->save($path);											//сохоанение в db.xml
		echo "Регистрация прошла успешно!";
		}
}else{
echo "Проль не совпвдает";
}
?>
