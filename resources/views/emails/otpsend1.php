<?php

$logo = $message->embed(public_path() . '/user_files/img/logo-2.png');
//$backimg = $message->embed(public_path() . '/user_files/img/bg-img.jpg');

$path       = Config::get('constants.settings.domainpath');
$linkexpire = Config::get('constants.settings.linkexpire');
//$logo       = asset('img/logo_new.png');
// $emaillogo  = asset('img/email.png');
// $facebook   = asset('img/facebook.png');

$projectname = Config::get('constants.settings.projectname');
echo $msg = '<!DOCTYPE HTML>

<head>
  <title>Bitcoin Mail</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
</head>

<body style=" padding:30px; border:1px solid #eee; font-family: "Open Sans", sans-serif;">
  <table width="600" cellspacing="0" cellpadding="0" align="center"  style="background:url(https://www.xentocorp.com/public/user_files/img/bg-img.jpg) no-repeat;background-size: 100% 100%;padding:30px;border-radius:15px;">
    <tr>
      <td>
          <table width="100%" cellspacing="0" cellpadding="0" style="background:#fff; padding:15px;">
            <tr>
              <td>
                <center>
                <img src="' . $logo . '" alt="" width="200">
                </center>

                <p style="color: #717171; text-align:center; margin: 10px 0; line-height: 1.6;">
                Hello '.$username.'!<br>
Did you try to change the Bitcoin Address in your account?<br>
If Yes, use the below code to proceed.<br>

                 <div class="wrapper-body" style="background: #fff; padding: 40px; text-align: center;">
                 <p style="text-align:center; color: #696969; font-size:16px;">' . $otp . '</p>
                 </div>


  <p style="text-align:center; color: #257d8f;">
<span style="font-size: 14px; font-weight: 600; color: #848484;"> If Not, just ignore this mail.</span>
<br/> <br/>
You can login here: <a href="https://www.xentocorp.com" target="_blank" style="color: #1a3473; text-decoration: none;"> www.xentocorp.com </a> <br/>

Thank you.<br/>
</p>
 
              </td>
            </tr>
          </table>

      </td>
    </tr>
  </table>
</body>

</html>

';

