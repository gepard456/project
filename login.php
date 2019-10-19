<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Comments</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="css/app.css" rel="stylesheet">
</head>
<body>
    <div id="app">

      <?php
      require_once($_SERVER["DOCUMENT_ROOT"].'/lib/header.php');
      ?>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Login</div>

                            <div class="card-body">
                                <form method="POST" action="/lib/form_login.php">

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control<?php if(isset($_SESSION['email_error'])) echo ' is-invalid'?>" name="email"  autocomplete="email" autofocus >

                                            <?php
                                            /** Flash сообщение email **/
                                            if(isset($_SESSION['email_error']))
                                            {
                                            ?>
                                              <span class="invalid-feedback" role="alert">
                                                  <strong><?php echo $_SESSION['email_error']?></strong>
                                              </span>

                                            <?php
                                              unset($_SESSION['email_error']);
                                            }
                                            ?>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control<?php if(isset($_SESSION['password_error'])) echo ' is-invalid'?>" name="password"  autocomplete="current-password">

                                            <?php
                                            /** Flash сообщение password **/
                                            if(isset($_SESSION['password_error']))
                                            {
                                            ?>
                                              <span class="invalid-feedback" role="alert">
                                                  <strong><?php echo $_SESSION['password_error']?></strong>
                                              </span>
                                            <?php
                                              unset($_SESSION['password_error']);
                                            }
                                            ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" >

                                                <label class="form-check-label" for="remember">
                                                    Remember Me
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                               Login
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
