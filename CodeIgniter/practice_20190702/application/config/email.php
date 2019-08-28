<?php

#$config['protocol']     = 'smtp';
#$config['smtp_host']    = 'ssl://smtp.gmail.com';
#$config['smtp_port']    = '465';
#$config['smtp_timeout'] = '30';
#$config['smtp_user']    = 'englam3345678@gmail.com';    // 填 Google App Domain Mail 也可以
#$config['smtp_pass']    = 'Kk88224682$';
#$config['charset']      = 'utf-8';
#$config['newline']      = "\r\n";
#$config['mailtype']     = 'html';
#$config['wordwrap']     = true;


$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.gmail.com'; 
$config['smtp_port'] = '587';
$config['smtp_crypto'] = 'tls';
$config['smtp_user'] = 'englam3345678@gmail.com';
$config['smtp_pass'] = 'Kk88224682$';
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['wordwrap'] = TRUE;
$config['newline'] = "\r\n"; //use double quotes to comply with RFC 822 standard

?>