<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/header.php');
?>

        <main class="py-4">
          <div class="container">
            <div class="row justify-content-center">

              <?php
              /** Проверка авторизации **/
              if(isset($_SESSION['email'])) // Если авторизован
              {
              ?>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><h3>Профиль пользователя</h3></div>

                        <div class="card-body">

                        <?php
                        /** Flash сообщение form **/
                        if(isset($_SESSION['profile_form_success']))
                        {
                        ?>
                          <div class="alert alert-success" role="alert">
                            <?php echo $_SESSION['profile_form_success']?>
                          </div>
                        <?php
                          unset($_SESSION['profile_form_success']);
                        }
                        ?>

                        <?php
                        /** Flash сообщение form **/
                        if(isset($_SESSION['profile_form_error']))
                        {
                        ?>
                          <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION['profile_form_error']?>
                          </div>
                        <?php
                          unset($_SESSION['profile_form_error']);
                        }
                        ?>

                            <form action="/lib/form_profile_store.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Name</label>
                                            <input type="text" class="form-control<?php if(isset($_SESSION['name_error'])) echo ' is-invalid'?>" name="name" id="exampleFormControlInput1" value="<?php echo $_SESSION['name']?>">

                                            <?php
                                            /** Flash сообщение name **/
                                            if(isset($_SESSION['name_error']))
                                            {
                                            ?>
                                              <span class="text text-danger">
                                                  <?php echo $_SESSION['name_error']?>
                                              </span>

                                            <?php
                                              unset($_SESSION['name_error']);
                                            }
                                            ?>

                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput2">Email</label>
                                            <input type="email" class="form-control<?php if(isset($_SESSION['email_error'])) echo ' is-invalid'?>" name="email" id="exampleFormControlInput2" value="<?php echo $_SESSION['email']?>">

                                            <?php
                                            /** Flash сообщение email **/
                                            if(isset($_SESSION['email_error']))
                                            {
                                            ?>
                                              <span class="text text-danger">
                                                  <?php echo $_SESSION['email_error']?>
                                              </span>

                                            <?php
                                              unset($_SESSION['email_error']);
                                            }
                                            ?>

                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput3">Аватар</label>
                                            <input type="file" class="form-control" name="image" id="exampleFormControlInput3">

                                            <?php
                                            /** Flash сообщение image **/
                                            if(isset($_SESSION['image_error']))
                                            {
                                            ?>
                                              <span class="text text-danger">
                                                  <?php echo $_SESSION['image_error']?>
                                              </span>

                                            <?php
                                              unset($_SESSION['image_error']);
                                            }
                                            ?>

                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                      <img src="<?php echo PATH_DIR_UPLOAD?>/<?
                                        if(empty($_SESSION['image']))
                                          echo 'no-user.jpg';
                                        else
                                          echo $_SESSION['image'];
                                        ?>" alt="<?php echo $_SESSION['name']?>" class="img-fluid">

                                    </div>

                                    <div class="col-md-12">
                                        <button class="btn btn-warning">Редактировать</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-12" style="margin-top: 20px;">
                    <div class="card">
                        <div class="card-header"><h3>Безопасность</h3></div>

                        <div class="card-body">
                            <div class="alert alert-success" role="alert">
                                Пароль успешно обновлен
                            </div>

                            <form action="/profile/password" method="post">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Current password</label>
                                            <input type="password" name="current" class="form-control" id="exampleFormControlInput1">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">New password</label>
                                            <input type="password" name="password" class="form-control" id="exampleFormControlInput1">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleFormControlInput1">Password confirmation</label>
                                            <input type="password" name="password_confirmation" class="form-control" id="exampleFormControlInput1">
                                        </div>

                                        <button class="btn btn-success">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php
                }
                else // Если не авторизован
                {
                ?>
                  <div class="col-md-12">
                      <div class="alert alert-info" role="alert">
                        Для входа в личный кабинет <a href="/login.php">авторизуйтесь</a>
                      </div>
                  </div>
                <?php
                }
                ?>

            </div>
        </div>
      </main>

<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/footer.php');
?>
