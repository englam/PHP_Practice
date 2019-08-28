<!DOCTYPE html> 
<html lang = "en">
 
   <head> 
      <meta charset = "utf-8"> 
      <title>CodeIgniter Session Example</title> 
   </head>
	
   <body> 
      Welcome <?php echo $this->session->userdata('name'); ?> 
      <br> 
      <a href = 'http://localhost:85/CodeIgniter-3.0.1/CodeIgniter3.0.1/index.php/sessionex/unset'>
         Click Here</a> to unset session data. 
   </body>
	
</html>