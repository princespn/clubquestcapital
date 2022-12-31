<?php
$logo ='https://www.xentocorp.com/email-img/logo.png';
$congrats ='https://www.xentocorp.com/email-img/congrats.png';
$bg ='https://www.xentocorp.com/email-img/bg.png';
$thanks ='https://www.xentocorp.com/email-img/thanks.png';
$box ='https://www.xentocorp.com/email-img/box.png';

$path       = Config::get('constants.settings.domainpath');
$url       = Config::get('constants.settings.domain');
$linkexpire = Config::get('constants.settings.linkexpire');
//$logo       = asset('img/logo_new.png');
// $emaillogo  = asset('img/email.png');
// $facebook   = asset('img/facebook.png');
$projectname = Config::get('constants.settings.projectname');
echo $msg = '<!DOCTYPE HTML>
<head>
   <title>Deposit</title>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Josefin+Slab:wght@500&display=swap" rel="stylesheet">
   </head>
   <body style=" padding:30px;  font-family: Poppins, sans-serif;">
         <table width="600" cellspacing="0" cellpadding="0" align="center" style=" padding: 15px 25px; background: url('.$bg.') no-repeat; background-size: contain; min-height: 650px;">
         <tbody>
            <tr>
               <td>
                  <table width="100%" cellspacing="0" cellpadding="0">
                     <tbody>
                        <tr>
                           <td>
                              <center>
                                 <img src="' . $logo . '" alt="" width="100">
                              </center>
                              <h2 style="text-align: center;margin: 10px auto;color: #47820c;font-size: 35px;font-weight: 900;line-height: 35px;"> 
                                 <span style="display: block; color: black;">Hello</span>
                                  '.$username.' 
                               </h2>


                     <p style="text-align:center;margin: 20px 40px ; font-size: 16px;font-weight: 700;">

                        Package of '.$Package.' and '.$amount.' has been activated in your account of Username '.$username.'. </p> 
                        
                     <p style="text-align:center;color: #000; font-size: 18px;">
                                You can login here: <a href="'.$url.'" target="_blank" style="color: #000;text-decoration: none;"> '.$url.'</a>
                              </p>
                              <img src="' .$thanks. '" style="margin: auto; text-align: center; display: block; width: 250px;">
                  </td>
               </tr>
            </table>
         </td>
      </tr>
   </table>
</body>
</html>
';