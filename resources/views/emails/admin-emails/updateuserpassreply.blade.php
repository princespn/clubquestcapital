<?php
$logo ='https://www.xentocorp.com/email-img/logo.png';
$congrats ='https://www.xentocorp.com/email-img/congrats.png';
$bg ='https://www.xentocorp.com/email-img/bg.png';
$thanks ='https://www.xentocorp.com/email-img/thanks.png';
$box ='https://www.xentocorp.com/email-img/box.png';

$emaillogo    = $message->embed(public_path() . '/img/email.png');
$facebook     = $message->embed(public_path() . '/img/facebook.png');
$projectname  = Config::get('constants.settings.projectname');
$path         = Config::get('constants.settings.domainpath');
echo  '<!DOCTYPE HTML>
<html><head>
   <title>Enquiry Mail</title>
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
                              <div>
                                 <center>
                                    <img src=".$emaillogo." alt="" width="100" style="opacity: 0.2;">
                                 </center>
                              </div>
                             <p style="text-align:center;margin: 20px auto;font-size: 16px;font-weight: 700;">
                                 '.$msg.'
                              </p>
               
                  <div class="wrapper-footer" style=" padding: 10px; text-align: center;">
                     <h3 style="font-size: 20px;font-weight: 200;margin: 10px;">Stay in touch</h3>
                     <a href="#">
                     <img src=".$facebook." alt="" style="width:30px"> 
                     </a>
                     <div class="copyright">
                        <p style="margin: 0;margin-top: 10px;line-height: 1.6;"> Email send by '.$projectname.'</p>
                        <p style="margin: 0;margin: 0px;line-height: 1.6;"> Copyright © '.date('Y').', All rights reserved.</p>
                     </div>
                  </div>
               </td>
            </tr>
            </tbody>
         </table>
      </td>
   </tr>
   </tbody>
</table>

</body></html>';