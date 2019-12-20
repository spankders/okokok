<?php
include 'PhpImap/__autoload.php';
function Hotmail($username = NULL, $password = NULL)
    {
        try
        {
            $mailbox = new PhpImap\Mailbox("{imap-mail.outlook.com:993/imap/ssl/novalidate-cert}INBOX", $username, $password);
            $mailsIds = $mailbox->statusMailbox();
			return json_encode(array('status' => 'true','message' => $mailsIds));
        }
        catch( Exception $e )
        {
            if( strpos($e->getMessage(), "Account is blocked") || strpos($e->getMessage(), "Login to your account via a web browser") )
            {
				//echo  $e->getMessage();
                //echo ' true';
				return json_encode(array('status' => 'true','message' => $e->getMessage()));
            }
			//echo  $e->getMessage();
            //echo ' false';
			return json_encode(array('status' => 'false','message' => $e->getMessage()));
        }
    }
if($_POST['email'] and $_POST['pass']){
    $ss = json_decode(Hotmail($_POST['email'],$_POST['pass']),true);
    echo $ss['status'];
}
