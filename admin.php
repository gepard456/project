<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/header.php');

$sql = "SELECT c.id, c.date, c.comment, c.status, u.image, u.name
          FROM comments c INNER JOIN users u
            ON c.user_id = u.id
              ORDER BY c.date DESC";

$statement = $pdo->query($sql);
$resultComments = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                  
                  <?php if(isset($_SESSION['email'])):?>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header"><h3>Админ панель</h3></div>

                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Аватар</th>
                                            <th>Имя</th>
                                            <th>Дата</th>
                                            <th>Комментарий</th>
                                            <th>Действия</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($resultComments as $key => $value):?>
                                          <tr>
                                              <td>
                                                <?php if($value['image']):?>
                                                  <img src="<?=PATH_DIR_UPLOAD?>/<?=$value['image']?>" alt="<?=$value['name']?>" class="img-fluid" width="64" height="64">
                                                <?php else:?>
                                                  <img src="<?=PATH_DIR_UPLOAD?>/no-user.jpg" alt="<?=$value['name']?>" class="img-fluid" width="64" height="64">
                                                <?php endif?>
                                              </td>
                                              <td><?=$value['name']?></td>
                                              <td><?php echo date ('d/m/Y', strtotime($value['date']))?></td>
                                              <td><?=$value['comment']?></td>
                                              <td>
                                                <?if($value['status'] == 0):?>
                                                  <a href="lib/admin_handler.php?forbid=<?=$value['id']?>" class="btn btn-warning">Запретить</a>
                                                <?else:?>
                                                  <a href="lib/admin_handler.php?allow=<?=$value['id']?>" class="btn btn-success">Разрешить</a>
                                                <?endif?>

                                                  <a href="lib/admin_handler.php?delete=<?=$value['id']?>" onclick="return confirm('are you sure?')" class="btn btn-danger">Удалить</a>
                                              </td>
                                          </tr>
                                        <?php endforeach?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                  <?php else:?>
                    <div class="col-md-12">
                        <div class="alert alert-info" role="alert">
                          Для входа <a href="/login.php">авторизуйтесь</a>
                        </div>
                    </div>
                  <?php endif?>
                </div>
            </div>
        </main>

<?php
require_once($_SERVER["DOCUMENT_ROOT"].'/lib/footer.php');
?>
