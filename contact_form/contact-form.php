<!DOCTYPE html>
<html lang="en">
<head>
   
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title> Document</title>
</head>
<body>
               
               
                <?php 
                
                //message vars
                $msg= '';
                $msgClass = '';

    
                // check for submit 
if(filter_has_var(INPUT_POST, 'submit')){
                    
                    // get form data 
                    $firstname = htmlspecialchars($_POST['first_name']);
                    $lastname = htmlspecialchars($_POST['last_name']);
                    $email = htmlspecialchars($_POST['email']);
                    $message = htmlspecialchars($_POST['message']);
                    
                    
                    // check required fields 
                    
                    
if(!empty($email) && !empty($firstname) && !empty($lastname) && !empty($message)){
     
        // passed
        // check email
        if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
                    
                    // failed
                    $msg = 'Please use a valid email';
                    $msgClass = 'alert-danger';
            
                } else {
                    
                    //passed
                    // recipient email
                $toEmail = 'info@billettdevelopment.co.uk';
                $subject = 'Contact request from' .$firstname;
                $body = '<h2>Contact Request</h2>
                         <h4>firstname</h4><p>'.$firstname.'</p>
                         <h4>lastname</h4><p>'.$lastname.'</p>
                         <h4>email</h4><p>'.$email.'</p>
                         <h4>message</h4><p>'.$message.'</p>
                ';
            
            
            //email headers
            
            $headers = "MIME-version: 1.0" ."/r/n";
            $headers .="Content-type:text/html;charset=UTF-8" . "/r/n";
            
            //additional headers
            $headers .= "From: " .$firstname. "<".$email.">". "/r/n";
            
            if(mail($toEmail, $subject, $body, $headers)) {
                
                //email sent
                    $msg = 'Your email has been sent!';
                    $msgClass = 'alert-success';
                
            } else {
                
                    $msg = 'Your email was not able to be sent';
                    $msgClass = 'alert-danger';
                
                
            }
                    
                }
            } else {
                        // failed 
                        $msg = 'Please fill in all the fields';
                        $msgClass = 'alert-danger';        
       }        
                                        }
                
                ?>
                
                <nav class="navbar navbar-default">
                    <div class="container">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="index.php">My website</a>
                        </div>
                    </div>
                </nav>
                
                <?php if($msg != ''): ?>
                   
                       <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
                   
                <?php endif; ?>
                   
                   
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                   
                    <div class="form-group">
                        <label for="">first name</label>
                        <input type="text" name="first_name" class="form-control" value="<?php echo isset($_POST['first_name']) ? $firstname : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="">last name</label>
                        <input type="text" name="last_name" class="form-control" value="<?php echo isset($_POST['last_name']) ? $lastname : ''; ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="">email</label>
                        <input type="text" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">message</label>
                        <textarea class="form-control" name="message" id="" cols="30" rows="10">
                            <?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
                    </div>
                    <br>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                
                </form>

          
</body>
</html>