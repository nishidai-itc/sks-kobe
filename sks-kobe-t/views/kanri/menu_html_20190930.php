<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" media="screen, projection" />
    <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>　
    <title>勤怠管理システム</title>

  </head>

<?php // var_dump($_SESSION); ?>

  <body>
    <div class="container">
      <div class="page-header">
        <h4>管理者メニュー</h4>
      </div>

    <form name="form1" method="POST" action="menu.php">

        <div class="card" style="padding: 10px;">
          <div class="card-body">
            <?php print($common->html_display($staff->oup_m_staff_name[0])); ?> さん <br /><?php print(date('m/d')) ?>(<?php print($week[$w]); ?>) <?php print(date('H:i')) ?>
          </div>
        </div>

        <input type="hidden" name="field2" value="<?php print(intval(substr($work->oup_t_work_run_start_time[0],0,2)) * 60 + intval(substr($work->oup_t_work_run_start_time[0],2,2))); ?>">
    </form>

      <div class="row">
        <div class="col-xs-12 col-md-12">
          <button class="btn btn-primary btn-lg btn-block" role="button" onclick="location.href='shift1.php'">勤務体系登録</button>
          <button class="btn btn-success btn-lg btn-block" role="button" onclick="location.href='kinmuyotei.php'">勤務予定表</button>
          <button class="btn btn-success btn-lg btn-block" role="button" onclick="location.href='kinmujokyo.php'">勤務状況一覧</button>
          <button class="btn btn-success btn-lg btn-block" role="button" onclick="location.href='haitihyo.php'">配置照会</button>
          <button class="btn btn-primary btn-lg btn-block" role="button" onclick="location.href='#'">ﾎﾟｽﾄ手当て登録</button>
          <button class="btn btn-primary btn-lg btn-block" role="button" onclick="location.href='#'">車手当て登録</button>
          <button class="btn btn-primary btn-lg btn-block" role="button" onclick="location.href='staff1.php'">隊員登録</button>
          <button class="btn btn-primary btn-lg btn-block" role="button" onclick="location.href='genba1.php'">現場登録</button>
          <button class="btn btn-info btn-lg btn-block" role="button" onclick="location.href='../menu.php'">隊員メニュー</button>
        </div>
      </div>
      <br />

      <div class="row">
        <div class="col-12">
          <form name="frm3" method="POST" action="login.php">
              <button name="logout" class="btn btn-secondary btn-lg btn-block" role="button">ログアウト</button>
          </form>
        </div>
      </div>
      <br />

    </div>
  </body>
</html>
