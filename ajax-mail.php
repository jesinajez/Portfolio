<?php 
    header('Access-Control-Allow-Origin: *'); 
    error_reporting(0);
    $action = $_POST['action'];
    $ref = $_POST['referer'];

    if($ref=='ezioaws') {

        if($action=='add_enquiry') {

            $name = $con -> real_escape_string($_POST['name']);
            $email = $_POST['email'];
            $message = $_POST['message'];
            $dates = date("Y-m-d");
                            
            require "mailer/PHPMailerAutoload.php";

            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';                 // Specify main and backup server
            $mail->Port = 465;                                    // Set the SMTP port
            $mail->SMTPAuth = true;                               // Enable SMTP authentication

            $mail->Username = 'jesinah17@gmail.com';                // SMTP username
            $mail->Password = 'Jesin@123';                  // SMTP password
            $mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted

            $mail->setFrom('jesinah17@gmail.com',"Portfolio - Enquiry");
            $mail->AddAddress('jesinah17@gmail.com', "Portfolio - Enquiry");  // Add a recipient
            $mail->IsHTML(true);                                  // Set email format to HTML

            $mail->Subject = "Good news! Portfolio - Enquiry";
        
            $mail->Body    = "<p>Hi, <br><br>A new Enquiry has been Submitted.  <br><br> <b>Name:</b> $name<br>
            <b>Email:</b> $email <br><b>Message:</b> $message  <br><br><b><em>Take care,</em> </b><br><b><em>Team, Portfoio! </em></b> </p>";
            

            if(!$mail->send()) {
               $json['message']= "We were unable to send your request.Please try again";
               $json['status']= "Failed";
               
            }
            else
            {
                $json['message']= "Your request has been sent successfully";
                $json['status']= "Success";
            
            }
            echo json_encode($json);
        }
    } 
    else {
        echo "Access Denied";
    }
?>
