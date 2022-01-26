<?php
    // include validation & email response files
    include "../inc/validation.php";
    include "../inc/contactFormResponseEmail.php";

    // set the form to be valid until validation fails
    $validform = true;

    // error message default empty variables
    $generalErrorMsg = "";
    $errFirstName = "";
    $errLastName = "";
    $errDateOfBirth = "";
    $errEmailAddress = "";
    $errMessage = "";

    // sticky variables to populate form if required field is missing or validation error
    $firstName = "";
    $lastName = "";
    $dateOfBirth = "";
    $emailAddress = "";
    $message = "";

    // if form is submitted
    if(isset($_POST['submit'])){

        // honeypot validation
        $middleName = $_POST['middleName'];
        
        // if $middleName is not empty refresh the page, else assign post variables and validate them
        if(!empty($middleName)){
            header("refresh:0");
        }else{
            // assign $_POST variables
            $firstName = $_POST['firstName'];   
            $lastName = $_POST['lastName'];
            $dateOfBirth = $_POST['dateOfBirth'];
            $emailAddress = $_POST['emailAddress'];
            $message = $_POST['message'];

            /* validate all input text fields ($_POST variable values)
                If a field or fields are not valid error message will display.
                If all fields are valid, form will process, display a success message,
                and clear all input fields.
            */
            if(!validateFirstName($firstName)){
                global $validform;
                $validform = false;
            };
            if(!validateLastName($lastName)){
                global $validform;
                $validform = false;
            }
            if(!validateDateOfBirth($dateOfBirth)){
                global $validform;
                $validform = false;
            }
            if(!validateEmail($emailAddress)){
                global $validform;
                $validform = false;
            }
            if(!validateMessage($message)){
                global $validform;
                $validform = false;
            }

            // if the form is valid an email response will be sent and contract variables will be reset
            if($validform === true){
                sendReponse($firstName, $lastName, $dateOfBirth, $emailAddress, $message);
                $firstName = "";
                $lastName = "";
                $dateOfBirth = "";
                $emailAddress = "";
                $message = "";
            }
            
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Week 2 Assignment</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatable" content="IE=edge">
        <meta name="description" content="Week One Assignment" keywords="Week two assignment">
        <meta name="Author" content="Jeremy Brannen">
        <meta name="viewport" content="width=device-width, intial-scale=1.0">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        
        <!--Jeremy Brannen WDV441 Week 2 assignment-->
        
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        
        <script>
        </script>
        
        <style> 
            body{
                color: #484c9b;
                background-color: cornsilk;
            }
            form div:nth-child(3){
                display: none;
            }
        </style>

    </head>

    <body class="container-fluid">

        <h1 class="text-center"> Week 2 Assignment</h1>

        <h2 class="text-center">Contact Form</h2>
        <?php
            // Confirmation message to the user that the form was submitted
            if(isset($_POST['submit']) && empty($middleName) && $validform){
        ?>
            <h4 class="text-center mt-2">We Have Recieved Your Information.  You Should Recieve An Email Shortly.</h4>
        <?php        
            }
        ?>
        <div class="col-md-8 mx-auto">
            <form class="" id="contactForm" name="contactForm" method="post" action="index.php">
                <div class="text-left text-danger">
                    <?php echo $generalErrorMsg ?>
                </div>
                <div class="form-group">
                    <span class="text-danger"><?php echo $errFirstName ?></span>
                    <label for="firstName">First Name: </label>
                    <input type="text" class="form-control form-control-sm" name="firstName" id="firstName" value="<?php echo $firstName;?>">
                </div>

                <div class="form-group">
                    <span class="text-danger"><?php //honeypot ?></span>
                    <label for="middleName">Middle Name: </label>
                    <input type="text" class="form-control form-control-sm" name="middleName" id="middleName" value="">
                </div>

                <div class="form-group">
                    <span class="text-danger"><?php echo $errLastName ?></span>
                    <label for="lastName">Last Name: </label>
                    <input type="text" class="form-control form-control-sm" name="lastName" id="lastName" value="<?php echo $lastName;?>">
                </div>

                <div class="form-group">
                    <span class="text-danger"><?php echo $errDateOfBirth ?></span>
                    <label for="dateOfBirth">Date Of Birth: </label>
                    <input type="text" class="form-control form-control-sm" name="dateOfBirth" id="dateOfBirth" value="<?php echo $dateOfBirth;?>" placeholder="mm/dd/yyyy">
                </div>

                <div class="form-group">
                    <span class="text-danger"><?php echo $errEmailAddress ?></span>
                    <label for="emailAddress">Email: </label>
                    <input type="text" class="form-control form-control-sm" name="emailAddress" id="emailAddress" value="<?php echo $emailAddress;?>" placeholder="youremail@domain.com">
                </div>

                <div class="form-group">
                    <span class="text-danger"><?php echo $errMessage ?></span>
                    <label for="message">Message: </label>
                    <textarea class="form-control" name="message" id="message" value="<?php echo $message;?>"><?php echo $message;?></textarea>
                </div>

                <div class="text-center">
                    <input type="submit" class="bg-primary text-light rounded-sm" name="submit" id="submit" value="Submit">      
                    <input type="reset" name="Reset" id="button" value="Clear Form">
                </div>
            </form>
        </div>
        
    </body>

</html>