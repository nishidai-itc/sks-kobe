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
        <h4>利用者様登録・選択</h4>
      </div>

      <div class="row">
        <div class="col-xs-12 col-md-12">
          <pre><h4><?php print($common->html_display($staff->oup_m_staff_name[0])); ?>　さん<br /><br /><?php print(date('Y/m/d')); ?> (<?php print($week[$w]); ?>)  <?php print(date('H:i')); ?><br /><br />作業準備中</h4></pre>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <pre><p class="text-info"><font size="+1">利用者様を選択してください</font></p></pre>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-md-12">
<?php for($i=0;$i<count($user->oup_m_user_id);$i++) { ?>
          <button class="btn btn-success btn-lg btn-block" onclick="location.href='../controllers/sagyostart.php?m_user_id=<?php print($user->oup_m_user_id[$i]); ?>'"><?php print($common->html_display($user->oup_m_user_name[$i])); ?> 様 <?php if ($user->oup_m_user_birth_date[$i] != "") { ?>(<?php print((int) ((date('Ymd')-(substr($user->oup_m_user_birth_date[$i],0,4).substr($user->oup_m_user_birth_date[$i],5,2).substr($user->oup_m_user_birth_date[$i],8,2)))/10000)); ?>)<?php } ?></button>
<?php } ?>
        </div>
      </div>
      <br />

      <div class="row">
        <div class="col-xs-12 col-md-12">
          <pre><p class="text-info">利用者様が表示されていない場合、利用者を「利用者様登録」から登録すると一覧に表示されます。</p></pre>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-md-12">
          <div class="col-xs-6 col-md-6"><button class="btn btn-default btn-block" onclick="location.href='../controllers/menu.php'">戻る</button></div>
          <div class="col-xs-6 col-md-6"><button class="btn btn-primary btn-block" onclick="location.href='../controllers/user_regist.php'">利用者様登録</button></div>
        </div>
      </div>
      <br />

    </div>
  </body>
</html>
