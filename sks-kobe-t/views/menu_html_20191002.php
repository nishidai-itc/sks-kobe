<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" media="screen, projection" />
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>　
    <title>勤怠管理システム</title>

  </head>

<?php // var_dump($_SESSION); ?>

  <body>
    <div class="container">

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
          <button class="btn btn-success btn-lg btn-block" role="button" onclick="location.href='kanri/kinmuyotei.php'">勤務予定表</button>
          <button class="btn btn-success btn-lg btn-block" role="button" onclick="location.href='recently_list.php#today'">勤務予定照会</button>
          <div class="col-12" style="padding: 8px;"></div>
<!--
          <button class="btn btn-success btn-lg btn-block" role="button" onclick="location.href='joban0.php'">早出予定入力（リーダー用）</button>
          <div class="col-12" style="padding: 8px;"></div>
          <button class="btn btn-success btn-lg btn-block" role="button" onclick="location.href='joban1_20190613.php'">上番報告（リーダー用）修正前</button>
-->
          <button class="btn btn-success btn-lg btn-block" role="button" onclick="location.href='joban1.php'">上番報告（リーダー用）</button>
<?php if ($todayworkflg) { ?>
          <button class="btn btn-success btn-lg btn-block" role="button" onclick="location.href='joban3.php'">上番報告（個人用）</button>
<?php } ?>
          <div class="col-12" style="padding: 8px;"></div>
<!--
          <button class="btn btn-success btn-lg btn-block" role="button" onclick="location.href='kaban1_20190614.php'">下番報告（リーダー用）修正前</button>
          <button class="btn btn-success btn-lg btn-block" role="button" onclick="location.href='kaban1.php'">下番報告（リーダー用）修正後</button>
-->
          <button class="btn btn-success btn-lg btn-block" role="button" onclick="location.href='kaban1.php'">下番報告（リーダー用）</button>
<?php if ($todayworkflg) { ?>
          <button class="btn btn-success btn-lg btn-block" role="button" onclick="location.href='kaban4.php'">下番報告（個人用）</button>
<?php } ?>
          <button class="btn btn-success btn-lg btn-block" role="button" onclick="location.href='kanri/kinmujokyo.php'">勤務状況一覧</button>
          <div class="col-12" style="padding: 8px;"></div>
          <button class="btn btn-primary btn-block" role="button" onclick="location.href='tisou.php'">遅刻・早退申請</button>
          <button class="btn btn-primary btn-block" role="button" onclick="location.href='kyuka.php'">休暇申請</button>
          <button class="btn btn-primary btn-block" role="button" onclick="location.href='kotuhi1.php'">交通費登録</button>
<?php /* 管理者メニューは本部のみ */ ?>
<?php if ($staff->oup_m_staff_auth[0]=="1") { ?>
          <button class="btn btn-info btn-lg btn-block" role="button" onclick="location.href='kanri/menu.php'">管理者メニュー</button>
<?php } ?>
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
