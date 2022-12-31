<?php

$logo = $message->embed(public_path() . '/user_files/img/logo.png');
$bg = $message->embed(public_path() . '/user_files/img/bg.jpg');


$path       = Config::get('constants.settings.domainpath');
$url       = Config::get('constants.settings.domain');
$linkexpire = Config::get('constants.settings.linkexpire');
//$logo       = asset('img/logo_new.png');
// $emaillogo  = asset('img/email.png');
// $facebook   = asset('img/facebook.png');
$projectname = Config::get('constants.settings.projectname');
echo $msg = '<!DOCTYPE HTML>
<head>
  <title>otp Send</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body style="background-color: #fff; margin: 0 !important; padding: 0 !important; font-family: Poppins, sans-serif;">
  <!-- HIDDEN PREHEADER TEXT -->
  <table cellpadding="0" cellspacing="0" width="100%" style="padding:25px;border-spacing:0">
    <tr>
      <td>
        <table style="width: 600px;background: url('.$bg.');background-size: cover;color: #707070; background-position: right top;margin: auto; border-spacing: 0;text-align: center;    border: 1px solid #9c9c9c;box-shadow: 0px 0px 10px #6f6f6f;">
          <tr>
            <td style="text-align:center;">
              <table style="text-align: center;margin: auto;width: 100%;padding: 25px;">
                <tr>
                  <td>
                    <img src="' . $logo . '" alt="Club Quest Capital" style="max-width: 150px; background: #FFFFFF 0% 0% no-repeat padding-box; border-radius: 13px; padding: 5px 20px;">
                  </td>
                </tr>
                <tr>
                  <td>
                    <h2 style="text-align: left; color: #fff; font-size: 35px;font-weight: 400;margin-bottom: 40px;"> Hello...., <br>
                      <span style="font-weight: 600;">'.$username.'</span>
                    </h2>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td style="margin: 70px 0 20px 0;display: block;">
              <b> '.$contant.' </b>
            </td>
          </tr>
          <tr>
            <td style="margin-bottom: 10px;display: block;">
              <b>'.$sub_contant.'</b>
            </td>
          </tr>
          <tr>
            <td>
              <p></p>
              <p style="text-align:center; font-size: 18px;margin: 20px 0;">You can login here: <a href='.$url.' target="_blank" style="text-decoration: none;"> '.$url.'</a>
              </p>
            </td>
          </tr>
          <tr>
            <td>
              <h4 style="color: #005CDA;margin-top: 0px; padding-bottom: 10px;font-size: 25px;">Thank you.</h4>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
';