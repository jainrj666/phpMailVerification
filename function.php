<?php
function doRegister($request)
{
$uname = $_REQUEST['uname'];
 $password=$_REQUEST['passwd'];
 $email=$_REQUEST['email'];
 $key = md5(rand(1,100));
 $query="insert into user_account_master values('','$uname','$email','$password',now(),0,'$key')";
 mysql_query($query);

 $query_uid="select * from user_account_master where uname='$uname'";
 $result_uid=mysql_query($query_uid);
 $row_uid=mysql_fetch_array($result_uid);
 $uid=$row_uid[0];
 $mailBody = generateMailBody($uname,$uid,$key);
 sendMail($email,SUBJECT,$mailBody);
}

function generateMailBody($uname,$uid,$key)
{
$body =CONTENT1.$uname.CONTENT2.CONTENT3.CONTENT4.CONTENT5.SITE_URL."/activate.php?uid=".$uid."&key=".$key.CONTENT6.CONTENT7.CONTENT8.SITE_NAME;
return $body;

}
function sendMail($to,$subject,$body)
{

/* You will have your own mailing code depending on your server and PHP configuration */
 
 echo $body;
}

function verifyEmail($uid,$key)
{
  $update_query ="update user_account_master set state=1 where uid=$uid and act_key='$key'";
 //echo  $update_query;
   mysql_query($update_query);
   $num= mysql_affected_rows();
  return $num;
 
}
?>
