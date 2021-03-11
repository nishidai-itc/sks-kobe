<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen, projection" />
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>　
    <title>かんたんヘルパーさん</title>
  </head>

  <body>
    <div class="container">
      <div class="page-header">
        <h4>パスワード変更</h4>
      </div>

      <form name="frm" method="POST" action="password_modify.php">

        <?php if ($password->errmsg != "") { ?>
            <div class="row">
              <div class="col-xs-12 col-md-12"><pre><p class="text-danger"><?php print($password->errmsg); ?></p></pre></div>
            </div>
        <?php } ?>

      <div class="row">
        <div class="col-xs-12 col-md-12"><label>現在のパスワード</label></div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-md-12"><input name="now_pw" type="password" class="form-control" placeholder="現在のパスワード"></div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-md-12"><label>新しいパスワード</label></div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-md-12"><input name="new_pw1" type="password" class="form-control" placeholder="新しいパスワード"></div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-md-12"><label>新しいパスワード（確認）</label></div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-md-12"><input name="new_pw2" type="password" class="form-control" placeholder="新しいパスワード"></div>
      </div>
      <br />

      <div class="row">
        <div class="col-md-9">
          <div class="col-xs-6 col-md-6">
            <button type="button" class="btn btn-default btn-lg btn-block" onclick="location.href='menu.php'">戻る</button>
          </div>
          <div class="col-xs-6 col-md-6">
            <button type="submit" class="btn btn-success btn-lg btn-block">次へ</button>
          </div>
        </div>
      </div>
      <br />

        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">

    </form>

    </div>
  </body>
</html>
