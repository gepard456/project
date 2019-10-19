<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/functions.php');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Comments</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="css/app.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
    <div id="app">

      <?php
      require_once($_SERVER["DOCUMENT_ROOT"].'/lib/header.php');
      ?>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header"><h3>Комментарии</h3></div>

                            <div class="card-body">

                              <?php
                              /** Flash сообщение добавления комментария **/
                              if(isset($_SESSION['add_comment_error']))
                              {
                              ?>
                                <div class="alert<?php
                                  if($_SESSION['add_comment_error'])
                                    echo ' alert-success';
                                  else
                                    echo ' alert-danger';
                                  ?>" role="alert">
                                  <?php echo $_SESSION['add_comment_message'];?>
                                </div>
                              <?php
                                unset($_SESSION['add_comment_error'], $_SESSION['add_comment_message']);
                              }
                              ?>

                              <?php
                              /** Вывод комментариев из БД **/
                              $sql = "SELECT * FROM `comments` ORDER BY `id` DESC";
                              $statement = $pdo->query($sql);

                              while($resultComment = $statement->fetch(PDO::FETCH_ASSOC))
                              {
                              ?>
                                <div class="media">
                                  <img src="img/no-user.jpg" class="mr-3" alt="..." width="64" height="64">
                                  <div class="media-body">
                                    <h5 class="mt-0"><?php echo $resultComment['name']?></h5>
                                    <span><small><?php echo date ('d/m/Y', strtotime($resultComment['date']))?></small></span>
                                    <p><?php echo $resultComment['comment']?></p>
                                  </div>
                                </div>
                              <?php
                              }
                              ?>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" style="margin-top: 20px;">
                        <div class="card">
                            <div class="card-header"><h3>Оставить комментарий</h3></div>

                            <div class="card-body">
                                <form id="form-comments" action="/lib/form_comments_store.php" method="post">
                                  <div class="form-group">
                                    <label for="name">Имя</label>

                                    <?php
                                    /** Flash проверка Имя на заполнение **/
                                    if(isset($_SESSION['name_empty']))
                                    {
                                    ?>
                                      <div class="alert alert-danger" role="alert"><?php echo $_SESSION['name_empty']?></div>
                                    <?php
                                      unset($_SESSION['name_empty']);
                                    }
                                    ?>

                                    <input id="name" name="name" class="form-control" />
                                  </div>
                                  <div class="form-group">
                                    <label for="text">Сообщение</label>

                                    <?php
                                    /** Flash проверка Сообщение на заполнение **/
                                    if(isset($_SESSION['comment_empty']))
                                    {
                                    ?>
                                      <div class="alert alert-danger" role="alert"><?php echo $_SESSION['comment_empty']?></div>
                                    <?php
                                      unset($_SESSION['comment_empty']);
                                    }
                                    ?>

                                    <textarea id="text" name="comment" class="form-control" rows="3"></textarea>
                                  </div>
                                  <button id="button-comments" type="submit" class="btn btn-success">Отправить</button>
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
