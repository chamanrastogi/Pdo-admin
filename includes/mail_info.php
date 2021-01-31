<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
class mail_info
{
	
	public static function mail_body_template($body="", $title="")
	{
		$site=Template::find_by_id(1);
		 $temp = '
  <html>
    <head>
        <title>'.$title.'</title>
        <style>

* {
    margin: 0;
    padding: 0;
    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
    box-sizing: border-box;
    font-size: 14px;
}

img {
    max-width: 100%;
}

body {
    -webkit-font-smoothing: antialiased;
    -webkit-text-size-adjust: none;
    width: 100% !important;
    height: 100%;
    line-height: 1.6;
}


table td {
    vertical-align: top;
}

/* -------------------------------------
    BODY & CONTAINER
------------------------------------- */
body {
    background-color: #f6f6f6;
}

.body-wrap {
    background-color: #f6f6f6;
    width: 100%;
}

.container {
    display: block !important;
    max-width: 600px !important;
    margin: 0 auto !important;
    /* makes it centered */
    clear: both !important;
}

.content {
    max-width: 600px;
    margin: 0 auto;
    display: block;
    padding: 20px;
}

/* -------------------------------------
    HEADER, FOOTER, MAIN
------------------------------------- */
.main {
    background: #fff;
    border: 1px solid #e9e9e9;
    border-radius: 3px;
}

.content-wrap {
	padding: 20px;
	text-align: left;
}

.content-block {
    padding: 0 0 20px;
}

.header {
    width: 100%;
    margin-bottom: 20px;
}

.footer {
    width: 100%;
    clear: both;
    color: #999;
    padding: 20px;
}
.footer a {
    color: #999;
}
.footer p, .footer a, .footer unsubscribe, .footer td {
    font-size: 12px;
}

/* -------------------------------------
    TYPOGRAPHY
------------------------------------- */
h1, h2, h3 {
    font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
    color: #000;
    margin: 40px 0 0;
    line-height: 1.2;
    font-weight: 400;
}

h1 {
    font-size: 32px;
    font-weight: 500;
}

h2 {
    font-size: 24px;
}

h3 {
    font-size: 18px;
}

h4 {
    font-size: 14px;
    font-weight: 600;
}

p, ul, ol {
	margin-bottom: 10px;
	font-weight: normal;
	text-align: justify;
}
p li, ul li, ol li {
    margin-left: 5px;
    list-style-position: inside;
}

/* -------------------------------------
    LINKS & BUTTONS
------------------------------------- */
a {
    color: #1ab394;
    text-decoration: underline;
}

.btn-primary {
    text-decoration: none;
    color: #FFF;
    background-color: #1ab394;
    border: solid #1ab394;
    border-width: 5px 10px;
    line-height: 2;
    font-weight: bold;
    text-align: center;
    cursor: pointer;
    display: inline-block;
    border-radius: 5px;
    text-transform: capitalize;
}

/* -------------------------------------
    OTHER STYLES THAT MIGHT BE USEFUL
------------------------------------- */
.last {
    margin-bottom: 0;
}

.first {
    margin-top: 0;
}

.aligncenter {
    text-align: center;
}

.alignright {
    text-align: left;
}

.alignleft {
    text-align: left;
}

.clear {
    clear: both;
}

.alert {
    font-size: 16px;
    color: #fff;
    font-weight: 500;
    padding: 20px;
    text-align: center;
    border-radius: 3px 3px 0 0;
}
.alert a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    font-size: 16px;
}
.alert.alert-warning {
    background: #f8ac59;
}
.alert.alert-bad {
    background: #ed5565;
}
.alert.alert-good {
    background: #2196f3;
}

/* -------------------------------------
    INVOICE
    Styles for the billing table
------------------------------------- */
.invoice {
    margin: 40px auto;
    text-align: left;
    width: 80%;
}
.invoice td {
    padding: 5px 0;
}
.invoice .invoice-items {
    width: 100%;
}
.invoice .invoice-items td {
    border-top: #eee 1px solid;
}
.invoice .invoice-items .total td {
    border-top: 2px solid #333;
    border-bottom: 2px solid #333;
    font-weight: 700;
}

/* -------------------------------------
    RESPONSIVE AND MOBILE FRIENDLY STYLES
------------------------------------- */
@media only screen and (max-width: 640px) {
    h1, h2, h3, h4 {
        font-weight: 600 !important;
        margin: 20px 0 5px !important;
    }

    h1 {
        font-size: 22px !important;
    }

    h2 {
        font-size: 18px !important;
    }

    h3 {
        font-size: 16px !important;
    }

    .container {
        width: 100% !important;
    }

    .content, .content-wrap {
        padding: 10px !important;
    }

    .invoice {
        width: 100% !important;
    }
}

        </style>
    </head>
    <body>
        <table class="body-wrap">
    <tbody><tr>
        <td></td>
        <td class="container" width="600">
            <div class="content">
                <table class="main" width="100%" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                        <td class="alert alert-good"></td>
                    </tr>
                    <tr>
                        <td class="content-wrap"><center>
                        </center>
						 <p>Dear, Sir/Mam<br/>
                          <p>'.$body.'<br/>
                          </p><h3>&nbsp;</h3>
                          <p>&nbsp;</p>
<p>'.$site->mail_line.'
<p><br>
  <strong>Warm regards,<br>
    </strong><strong>'.ucfirst($site->sitename).'</strong></p>
<p><br>
                  </tr>
                </tbody></table>
              </div>
        </td>
        <td></td>
    </tr>
</tbody></table> 
    </body>
    </html>
';
return $temp;
	}
	public static function mail_template_send($title,$message,$id)
	{
		
		$Template = Template::find_by_id(1);
		 $temp = '
  <html>
    <head>
        <title>'.$title.'</title>
        <style>

* {
    margin: 0;
    padding: 0;
    font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
    box-sizing: border-box;
    font-size: 14px;
}

img {
    max-width: 100%;
}

body {
    -webkit-font-smoothing: antialiased;
    -webkit-text-size-adjust: none;
    width: 100% !important;
    height: 100%;
    line-height: 1.6;
}


table td {
    vertical-align: top;
}

/* -------------------------------------
    BODY & CONTAINER
------------------------------------- */
body {
    background-color: #f6f6f6;
}

.body-wrap {
    background-color: #f6f6f6;
    width: 100%;
}

.container {
    display: block !important;
    max-width: 600px !important;
    margin: 0 auto !important;
    /* makes it centered */
    clear: both !important;
}

.content {
    max-width: 600px;
    margin: 0 auto;
    display: block;
    padding: 20px;
}

/* -------------------------------------
    HEADER, FOOTER, MAIN
------------------------------------- */
.main {
    background: #fff;
    border: 1px solid #e9e9e9;
    border-radius: 3px;
}

.content-wrap {
	padding: 20px;
	text-align: left;
}

.content-block {
    padding: 0 0 20px;
}

.header {
    width: 100%;
    margin-bottom: 20px;
}

.footer {
    width: 100%;
    clear: both;
    color: #999;
    padding: 20px;
}
.footer a {
    color: #999;
}
.footer p, .footer a, .footer unsubscribe, .footer td {
    font-size: 12px;
}

/* -------------------------------------
    TYPOGRAPHY
------------------------------------- */
h1, h2, h3 {
    font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
    color: #000;
    margin: 40px 0 0;
    line-height: 1.2;
    font-weight: 400;
}

h1 {
    font-size: 32px;
    font-weight: 500;
}

h2 {
    font-size: 24px;
}

h3 {
    font-size: 18px;
}

h4 {
    font-size: 14px;
    font-weight: 600;
}

p, ul, ol {
	margin-bottom: 10px;
	font-weight: normal;
	text-align: justify;
}
p li, ul li, ol li {
    margin-left: 5px;
    list-style-position: inside;
}

/* -------------------------------------
    LINKS & BUTTONS
------------------------------------- */
a {
    color: #1ab394;
    text-decoration: underline;
}

.btn-primary {
    text-decoration: none;
    color: #FFF;
    background-color: #1ab394;
    border: solid #1ab394;
    border-width: 5px 10px;
    line-height: 2;
    font-weight: bold;
    text-align: center;
    cursor: pointer;
    display: inline-block;
    border-radius: 5px;
    text-transform: capitalize;
}

/* -------------------------------------
    OTHER STYLES THAT MIGHT BE USEFUL
------------------------------------- */
.last {
    margin-bottom: 0;
}

.first {
    margin-top: 0;
}

.aligncenter {
    text-align: center;
}

.alignright {
    text-align: left;
}

.alignleft {
    text-align: left;
}

.clear {
    clear: both;
}

.alert {
    font-size: 16px;
    color: #fff;
    font-weight: 500;
    padding: 20px;
    text-align: center;
    border-radius: 3px 3px 0 0;
}
.alert a {
    color: #fff;
    text-decoration: none;
    font-weight: 500;
    font-size: 16px;
}
.alert.alert-warning {
    background: #f8ac59;
}
.alert.alert-bad {
    background: #ed5565;
}
.alert.alert-good {
    background: #2196f3;
}

/* -------------------------------------
    INVOICE
    Styles for the billing table
------------------------------------- */
.invoice {
    margin: 40px auto;
    text-align: left;
    width: 80%;
}
.invoice td {
    padding: 5px 0;
}
.invoice .invoice-items {
    width: 100%;
}
.invoice .invoice-items td {
    border-top: #eee 1px solid;

}
.invoice .invoice-items .total td {
    border-top: 2px solid #333;
    border-bottom: 2px solid #333;
    font-weight: 700;
}

/* -------------------------------------
    RESPONSIVE AND MOBILE FRIENDLY STYLES
------------------------------------- */
@media only screen and (max-width: 640px) {
    h1, h2, h3, h4 {
        font-weight: 600 !important;
        margin: 20px 0 5px !important;
    }

    h1 {
        font-size: 22px !important;
    }

    h2 {
        font-size: 18px !important;
    }

    h3 {
        font-size: 16px !important;
    }

    .container {
        width: 100% !important;
    }

    .content, .content-wrap {
        padding: 10px !important;
    }

    .invoice {
        width: 100% !important;
    }
}

        </style>
    </head>
    <body>
        <table class="body-wrap">
    <tbody><tr>
        <td></td>
        <td class="container" width="600">
            <div class="content">
                <table class="main" width="100%" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                        <td class="alert alert-good"></td>
                    </tr>
                    <tr>
                        <td class="content-wrap">
						<center>
					<img src="'.BASE_PATH.$Template->image_path().'" width="200px" height="auto" />
					</center>
					<br/><br/>
                            <p><strong>Dear : '.ucfirst($user->name).'</strong></p>
                            <p><strong>&nbsp;</strong></p>
                            <p>'.$message.'</p>
                            <p>&nbsp;</p>
<br/>
                          <p>&nbsp;</p>
<p>For any kind of information please contact our customer  support within working hours thank you for choosing us!</p>
<p><br>
  <strong>Warm regards,<br>
    </strong><strong>Malaysia Visa Center</strong></p>
<p><br>
  <strong>Telephone Numbers</strong>&nbsp;<br>
Australia: <a href="tel:+61%20455%20144%20366" target="_blank">+</a>61452247786<br>
Malaysia: <a href="tel:+60%203-2164%205555" target="_blank">+60</a>172714138<br>
India: +919557629843,+918193092594<br>
Email:&nbsp;<a href="mailto:Officialmalaysiavisa.in@gmail.com" target="_blank">Officialmalaysiavisa.in@gmail.com</a></p></td>
                    </tr>
                </tbody></table>
              </div>
        </td>
        <td></td>
    </tr>
</tbody></table> 
    </body>
    </html>
';
return $temp;
	}
	
	
	
	
	public static function mail_msg($email,$femail,$cc,$subject, $message)
	{
	    $recvr=explode("@",$email);
	    $sndr=explode("@",$femail);
	    
			   $mail = new PHPMailer;
               $mail->setFrom($femail, $sndr[1]);
               $mail->addAddress($email, $recvr[0]);
               $mail->Subject  = $subject;
               $mail->isHTML(true);
               $mail->Body     =  $message;
			   $mail->AddCC($cc);
			   if(!$mail->send()) 
			   {
                echo 'Message was not sent.';
                echo 'Mailer error: ' . $mail->ErrorInfo;
               }
               else 
               {
                #echo 'Message has been sent.';
               }
				
	}
		public static function mail_msg_attach($email, $femail, $subject, $message,$attach)
	{
	    $recvr=explode("@",$email);
	    $sndr=explode("@",$femail);
	    
			   $mail = new PHPMailer;
               $mail->setFrom($femail, $sndr[1]);
               $mail->addAddress($email, $recvr[0]);
			   $mail->addAttachment($attach);
               $mail->Subject  = $subject;
               $mail->isHTML(true);
               $mail->Body     =  $message;
			   if(!$mail->send()) 
			   {
                echo 'Message was not sent.';
                echo 'Mailer error: ' . $mail->ErrorInfo;
               }
               else 
               {
                #echo 'Message has been sent.';
               }
				
	}
}

?>