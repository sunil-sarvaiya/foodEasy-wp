<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <style>
        #header-style span {
            margin: 8px;
        }

        #logo {
            text-decoration: none;
            font-size: 25px;
            margin-right: 12px;
        }

        #header-style a {
            text-decoration: none;
        }

        .btn {
            border: none;
            padding: 0.5em;
            font-size: 16px;
            margin: 1px;
        }
    </style>
    <?php
    $nameErr  = $passErr = $conpassErr = $emailErr = $mobileErr = "";
    $name = $pass = $conpass = $mobile = $email = "";
    // redirect to form.php if form is not set
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

    
        if(empty($_POST["user"])) {
            $nameErr = "* Please fill the user field";
        } else {
            $name = test_input($_POST["user"]);
            if(strlen($name) <= 2 || strlen($name) > 20) {
                $nameErr = "* Username lenght must be between 3 and 20";
            }
        }

        if(empty($_POST["pass"])) {
            $passErr = " * Please fill the password field";
        } else {
            $pass = test_input($_POST["pass"]);
            if(strlen($pass) < 8 || strlen($pass) > 16) {
                $passErr = "Password conatin character between 8 to 16";
            }
        }

        if(empty($_POST["conpass"])) {
            $conpassErr = "* Please fill the confirm password field";
        } else {
            $conpass = $_POST["conpass"];
            if($conpass != $pass) {
                $conpassErr = "* password doesn't match";
            }
        }

        if(empty($_POST["email"])) {
            $emailErr = "* Please fill the email field";
        } else {
            $email = $_POST["email"];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "* Email id is not valid";
            }
        }

        if(empty($_POST["mobile"])) {
            $mobileErr = "* Please fill mobile field";
        } else {
            $mobile = $_POST["mobile"];
            if(strlen($mobile) != 10) {
                $mobileErr = "* Mobile Number must be 10 digits only";
            } else if(is_nan($mobile)) {
                $mobileErr = "* Mobile number only conatins the character";
            }
        }
    }
    ?>
</head>

<body>
   

    <div class="container"><br>
        <div class="form-group container border border-dark mt-4">
            <form  action="db.php" method="post">
                <legend class="text-center bg-light mt-3">Create Account</legend>
                <div class="form-group">
                    <label for="user" class="font-weight-bold"> Name: </label>
                    <input type="text" name="user" value="<?php echo $name?>" class="form-control" id="user" autocomplete="off">
                    <span id="username" class="text-danger">
                        <?php 
                            echo $nameErr;
                        ?>
                    </span>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold"> Mobile Number: </label>
                    <input type="text" name="mobile" value="<?php echo $mobile?>" class="form-control" id="mobileNumber" autocomplete="off">
                    <span id="mobileno" class="text-danger">
                    <?php 
                            echo $mobileErr;
                    ?>
                    </span>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold"> Email: </label>
                    <input type="text" name="email" value="<?php echo $email?>" class="form-control" id="emails" autocomplete="off">
                    <span id="emailids" class="text-danger">
                    <?php 
                            echo $emailErr;
                    ?>
                    </span>
                </div>

                
                <div class="form-group">
                    <label class="font-weight-bold">Password: </label>
                    <input type="text" name="pass"  value="<?php echo $pass?>" class="form-control" id="pass" autocomplete="off">
                    <span id="passwords" class="text-danger"> 
                    <?php 
                            echo $passErr;
                    ?>
                    </span>
                </div>

                <div class="form-group">
                    <label class="font-weight-bold"> Confirm Password: </label>
                    <input type="text" name="conpass" value="<?php echo $conpass?>" class="form-control" id="conpass" autocomplete="off">
                    <span id="confrmpass" class="text-danger">
                    <?php 
                            echo $conpassErr;
                    ?>
                    </span>
                </div>

                <div class="form-group text-center">
                    <input type="submit" name="Submit" value="submit"  class="btn btn-primary" autocomplete="off"></a>

                    <input type="reset"  value="Reset" class="btn btn-warning" autocomplete="off">
                </div>
            </form>


        </div>
    </div>

</body>
</html>