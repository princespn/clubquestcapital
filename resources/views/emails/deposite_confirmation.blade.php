<?php

$logo ='https://www.xentocorp.com/email-img/logo.png';
$congrats ='https://www.xentocorp.com/email-img/congrats.png';
$bg ='https://www.xentocorp.com/email-img/bg.png';
$thanks ='https://www.xentocorp.com/email-img/thanks.png';
$box ='https://www.xentocorp.com/email-img/box.png';

//$logo = $message->embed(public_path() . '/img/logo.png');
//$emaillogo = $message->embed(public_path() . '/img/email.png');
//$facebook = $message->embed(public_path() . '/img/facebook.png');
$project_name = Config::get('constants.settings.projectname');
$path = Config::get('constants.settings.domainpath');
$url = Config::get('constants.settings.domain');
echo $msg = '<html>
  <head>
    <meta charset="utf-8">
    <title>Confirmation Mail </title>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Josefin+Slab:wght@500&display=swap" rel="stylesheet">
   </head>
   <body style=" padding:30px;  font-family: Poppins, sans-serif;">
         <table width="600" cellspacing="0" cellpadding="0" align="center" style=" padding: 15px 35px; background: url('.$bg.') no-repeat; background-size: contain; min-height: 650px;">
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
                                    <img src="' .$congrats. '" width="250">
                                 </center>
                              </div>
                              <h2 style="text-align: center;margin: 10px auto;color: #47820c;font-size: 35px;font-weight: 900;line-height: 35px;"> 
                                 Password Reset Successfully 
                              </h2>


            <p style="margin: 10px 0;line-height: 1.6;text-align: center;font-weight: 700;"> Thank you for using password recovery option. .</p>
            <p style="margin: 10px 0;line-height: 1.6;font-weight: 600;text-align: center;"> You password reset successfully.</p>
             <p style="margin: 10px 0;line-height: 1.6;text-align: center;">Regards,<br>
               '.$project_name.'<br>
               <a href="'.$url.'">'.$url.'</a>
             </p>
           <p style="text-align:center;margin: 20px auto;font-size: 16px;font-weight: 700;">
              Greetings on your successful confirmation of your deposit '.$amount.' with order ID '.$order_id.'
           </p>
            </tr>
          </tbody></table>

      </td>
    </tr>
  </tbody></table>


</body>

</html>
';