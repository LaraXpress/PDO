<?php
    session_start();
    require_once '../inc/dbcon.php'; 
    require_once 'inc/header.php';
    if(isset($_POST['login'])){
        $email    = $_POST['inputEmailAddress'];
        $password = $_POST['inputPassword'];
        $sql      = "select * from users where user_email = :email";
        $query    = $con->prepare($sql);
        $query->execute([
            ':email'  => $email,            
        ]);          
        if($query->rowCount() == 1){
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $user_email       = $row['user_email'];
            $user_password    = $row['user_password'];
            $_SESSION['name'] = $row['user_name'];
            if($user_email = $email){
                if(password_verify($password, $user_password)){
                    $success = "Sign In Successfully!";                                     
                    header("Refresh:2; url = index.php");
                }else{
                    $pass_error = 'Password not matched!';  
                }
            }else{
                $error= 'Wrong Email or Password';
            }
        }else{
            $error = 'Invalid Info';
        }

    } 
?>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header justify-content-center"><h3 class="font-weight-light my-4">SIGN IN</h3></div>
                                    <div class="card-body">
                                        <?php
                                            if(isset($success)){
                                                echo '<p class="alert alert-success">'.$success.'</p>';
                                            } 
                                            if(isset($error)){
                                                echo '<p class="alert alert-danger">'.$error.'</p>';
                                            }else if(isset($pass_error)){
                                                echo '<p class="alert alert-danger">'.$pass_error.'</p>';
                                            }
                                        ?>                                        
                                        <form action="" method="post">
                                            <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Email</label><input class="form-control py-4" name ="inputEmailAddress" type="email" placeholder="Enter email address" /></div>
                                            <div class="form-group"><label class="small mb-1" for="inputPassword">Password</label><input class="form-control py-4" name ="inputPassword" type="password" placeholder="Enter password" /></div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox"><input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" /><label class="custom-control-label" for="rememberPasswordCheck">Remember password</label></div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <input type="submit" value="LOGIN" name="login" class="btn btn-primary btn-block">              
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="signup.php">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
<?php require_once 'inc/footer.php'; ?>       