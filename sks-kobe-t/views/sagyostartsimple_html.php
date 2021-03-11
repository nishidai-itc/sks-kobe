<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen, projection" />
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>　
    <script type="text/javascript" src="../js/jquery-1.8.0.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="../js/geoloc.js" charset="utf-8"></script>
    <script type="text/javascript" src="../js/sock.js" charset="utf-8"></script>
    <title>かんたんヘルパーさん</title>
  </head>

  <script type="text/javascript">
  <!--
  function confrim(act){
      document.frm.act.value=act;
      document.frm.submit();
  }
  // -->
  </script>

  <body>
    <div class="container">
      <div class="page-header">
        <h4>利用者名確認</h4>
      </div>

      <form name="frm" method="POST" action="sagyostart.php">

        <?php if ($sagyostart->errmsg != "") { ?>
            <div class="row">
              <div class="col-xs-12 col-md-12"><pre><p class="text-danger"><?php print($sagyostart->errmsg); ?></p></pre></div>
            </div>
        <?php } ?>

      <div class="row">
        <div class="col-xs-12 col-md-12">
            <pre><h4><?php print($common->html_display($staff->oup_m_staff_name[0])); ?>　さん<br /><br /><?php print(date('Y/m/d')) ?> (<?php print($week[$w]); ?>)  <?php print(substr($run_start_time,0,2)); ?>:<?php print(substr($run_start_time,3,2)); ?><br /><br />作業準備中</h4></pre>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-md-12"><pre><h4>利用者　<?php print($common->html_display($user->oup_m_user_name[0])); ?> 様</h4></pre></div>
      </div>

      <div class="row">
        <div class="col-xs-12 col-md-12"><p>
          報告内容
          <textarea name="rest_reason" class="form-control" rows="3" placeholder="報告内容を入れて作業報告しますを押してください"></textarea>
        </p></div>
      </div>

      <div class="row">
        <div class="col-md-9">
          <div class="col-xs-6 col-md-6">
            <button type="button" class="btn btn-default btn-lg btn-block" onclick="location.href='user_list.php'">戻る</button>
          </div>
          <div class="col-xs-6 col-md-6">
            <button type="button" class="btn btn-success btn-lg btn-block" onclick="confrim(3)">作業報告します</button>
          </div>
        </div>
      </div>
  		<br />

      <?php /* アクションフラグ */ ?>
      <INPUT type="hidden" name="act" value="">
        <INPUT type="hidden" name="run_start_time" value="<?php print($run_start_time); ?>">
        <INPUT type="hidden" name="ido" value="">
        <INPUT type="hidden" name="keido" value="">

      </form>

    </div>
  </body>
</html>
