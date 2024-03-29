<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/header.php');
?>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Register</div>

                            <div class="card-body">
                                <form method="POST" action="/lib/form_register_users.php">

                                    <div class="form-group row">
                                        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control<?php if(isset($_SESSION['name_error'])) echo ' is-invalid'?>" name="name" autocomplete="on" autofocus>

                                            <?php
                                            /** Flash сообщение name **/
                                            if(isset($_SESSION['name_error']))
                                            {
                                            ?>
                                              <span class="invalid-feedback" role="alert">
                                                  <strong><?php echo $_SESSION['name_error']?></strong>
                                              </span>
                                            <?php
                                              unset($_SESSION['name_error']);
                                            }
                                            ?>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control<?php if(isset($_SESSION['email_error'])) echo ' is-invalid'?>" name="email" autocomplete="on">

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
                                            <input id="password" type="password" class="form-control<?php if(isset($_SESSION['password_error'])) echo ' is-invalid'?>" name="password">

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
                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control<?php if(isset($_SESSION['password_confirmation_error'])) echo ' is-invalid'?>" name="password_confirmation">

                                            <?php
                                            /** Flash сообщение password_confirmation **/
                                            if(isset($_SESSION['password_confirmation_error']))
                                            {
                                            ?>
                                              <span class="invalid-feedback" role="alert">
                                                  <strong><?php echo $_SESSION['password_confirmation_error']?></strong>
                                              </span>
                                            <?php
                                              unset($_SESSION['password_confirmation_error']);
                                            }
                                            ?>

                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                Register
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

<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/footer.php');
?>
