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
        <h4>利用者さん登録</h4>
      </div>

      <form name="frm" method="POST" action="../controllers/user_regist.php">

        <?php if ($registuser->errmsg != "") { ?>
            <div class="row">
              <div class="col-xs-12 col-md-12"><pre><p class="text-danger"><?php print($registuser->errmsg); ?></p></pre></div>
            </div>
        <?php } ?>

        <div class="row">
          <div class="col-xs-12 col-md-12"><pre><p class="text-info"><font size="+1">利用者さんを登録してください</font></p></pre></div>
        </div>

        <div class="row">
          <div class="col-xs-12 col-md-12"><label>利用者さんのお名前（漢字）</label></div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-md-12">
            <input type="text" name="m_user_name" value="<?php print($m_user_name); ?>" class="form-control" placeholder="利用者さんのお名前（漢字）">
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12 col-md-12"><label>利用者さんのお名前（カナ）</label></div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-md-12">
            <input type="text" name="m_user_kana" value="<?php print($m_user_kana); ?>" class="form-control" placeholder="利用者さんのお名前（カナ）">
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12 col-md-12"><label>利用者さんの生年月日（YYYY/MM/DD）</label></div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-md-12">
            <input type="date" name="m_user_birth_date" value="<?php print($m_user_birth_date); ?>" class="form-control" placeholder="利用者さんの年齢">
          </div>
        </div>
  	    <br />

        <div class="row">
          <div class="col-md-9">
            <div class="col-xs-6 col-md-6">
              <button type="button" class="btn btn-default btn-lg btn-block" onclick="location.href='../controllers/user_list.php'">戻る</button>
            </div>
            <div class="col-xs-6 col-md-6">
              <button type="submit" class="btn btn-success btn-lg btn-block">登録します</button>
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
