<?php
$logo ='https://www.xentocorp.com/email-img/logo.png';
$congrats ='https://www.xentocorp.com/email-img/congrats.png';
$bg ='https://www.xentocorp.com/email-img/bg.png';
$thanks ='https://www.xentocorp.com/email-img/thanks.png';
$box ='https://www.xentocorp.com/email-img/box.png';

// $logo       = asset('img/logo_new.png');
//$emaillogo = $message->embed(public_path() . '/img/email.png');
//$facebook = $message->embed(public_path() . '/img/facebook.png');
$projectname = Config::get('constants.settings.projectname');
$path = Config::get('constants.settings.domainpath');
$url = Config::get('constants.settings.domain');
echo $msg = '<!DOCTYPE HTML>
<html>
   <head>
      <title>Confirmation Mail</title>
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
                                 '.$fullname.' 
                              </h2>
                              <p style="color: #000000;text-align: center;padding: 20px;">
                                 We welcome you on board with The Miners. You have successfully finished the registration process in the personal dashboard. 
                              </p>
                              <p style="color: #40a238;text-align: center;padding: 0 10px;">Please follow the link below to activate your account. </p>
                              
                              <p style="text-align: center;"><a href="' . $path . '/verifyemailid?verifytoken=' . $verify_token . '"  style="background: #328535;text-align: center;text-decoration: none;color: #fff;padding: 10px;display: inline-block;">Confirm my account</a>  
                              </p>
                              <p style="text-align: center;">
                                 Regards<br>
                                 Team '.$projectname.'<br>
                                 <a href='.$url.'>'.$url.'</a>
                              </p>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
         </tbody>
      </table>
   </body>
</html>
';

