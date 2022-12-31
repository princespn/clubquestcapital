<?php
$congrats ='https://www.xentocorp.com/email-img/congrats.png';
$bg ='https://www.xentocorp.com/email-img/bg.png';
$thanks ='https://www.xentocorp.com/email-img/thanks.png';
$box ='https://www.xentocorp.com/email-img/box.png';

//$logo       = asset('img/logo_new.png');
// $emaillogo  = asset('img/email.png');
// $facebook   = asset('img/facebook.png');
$projectname = Config::get('constants.settings.projectname');
$url      = Config::get('constants.settings.domain');
echo $msg = '<!DOCTYPE HTML>
<html>
   <head>
      <title>Structure Creation Mail</title>
           <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Josefin+Slab:wght@500&display=swap" rel="stylesheet">
   </head>
   <body style=" padding:30px;  font-family: Poppins, sans-serif;">
         <table width="600" cellspacing="0" cellpadding="0" align="center" style=" padding: 55px 25px 15px; background: url('.$bg.') no-repeat; background-size: contain; min-height: 650px;">
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
                                 <span style="display: block; color: black;">Hello</span> '.$username.' </h2>
                              <p style="text-align:center;margin: 20px auto;font-size: 16px;font-weight: 700;">
                                 Thank you for Signing Up on our website.
                              </p>
                              <h3 style="text-align:center;color:green;font-weight: 700;">   
                                 Your login details :
                              </h3>
                              <div style="text-align:center;width: 350px;margin:10px auto;background: url('.$box.') no-repeat;background-size: 100% 100%;font-size: 15px;color: #47820c;line-height: 25px;padding: 25px 15px 15px;background-position: center;height: 80px;">
                                 No. of IDs in structure : ' .$no_of_id. ' <br>
                                     Password : ' .$password. ' <br>
                                 Email: '.$user_email.'
                              </div>
                             
                              <p style="text-align:center;color: #fff; font-size: 18px;">
                                 <br><br><br><br>
                                You can login here: <a href="'.$url.'" target="_blank" style="color: #fff;text-decoration: none;"> '.$url.'</a>
                              </p>
                              <img src="' .$thanks. '" style="margin: auto; text-align: center; display: block; width: 250px;">
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