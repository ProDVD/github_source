<?
require('structure.php');
if ($_POST['isChecked']!=null) {
   $res = getPassForRemind ($_POST['login']);
   if($res==false)
    redirectSwitcher('failure.php');
    else
    {
        sendMail($_POST['login'], $res);
        redirectSwitcher('success.php');
    }
} 
else 
 redirectSwitcher('failure.php');