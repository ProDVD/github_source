<?
require('structure.php');
setcookie('uniqueID' , validator($_POST['login'], $_POST['password']));
setcookie('email' , $_POST['login']);
setcookie('flag' , $isDoctor);
$user= new OneUser($UID, $_POST['login'], $isDoctor);
if($isDoctor)
		redirectSwitcher('docmode.php');
else
{
			redirectSwitcher('user.php');
}

		