<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php /* ?>
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">
<?php */ ?>

<?php 
header("Cache-Control:no-cache,no-store,must-revalidate,max-age=0");
header("Cache-Control:pre-check=0,post-check=0,false");
header("Pragma:no-cache");
?>

  <!-- bootstrap-4.3.1 -->
  <link href="./bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="./bootstrap-4.3.1/jquery-3.4.1.min.js"></script>
  <script src="./bootstrap-4.3.1/js/bootstrap.bundle.min.js"></script>

  <title>勤怠管理システム</title>
</head>

<body>
  <div class="container">

    <!-- ログイン者情報 -->
    <div class="row">
      <div class="col-12">
        <div class="card" style="padding: 10px;">
          <div class="card-body">
          <?php print("<table><tr><td nowrap>".$common->html_display($staff->oup_m_staff_name[0])); ?> さん<?php if (count($tuti->oup_m_tuti_msg) == 1) {
          print("</td><td width=45>&nbsp;</td><td style='word-break: break-all;'>".$tuti->oup_m_tuti_msg[0]."</td></tr><tr><td>".date('m/d')."(".$week[$w].")".date('H:i')."</td></tr></table>"); }
          elseif (count($tuti->oup_m_tuti_msg) == 2) {
          print("</td><td width=45>&nbsp;</td><td style='word-break: break-all;'>".$tuti->oup_m_tuti_msg[0]."</td></tr><tr><td>".date('m/d')."(".$week[$w].")".date('H:i')."</td><td>&nbsp;</td><td style='word-break: break-all;'>".$tuti->oup_m_tuti_msg[1]."</td></tr></table>"); }
          elseif (count($tuti->oup_m_tuti_msg) == 3) {
          print("</td><td width=45>&nbsp;</td><td style='word-break: break-all;'>".$tuti->oup_m_tuti_msg[0]."</td></tr><tr><td>".date('m/d')."(".$week[$w].")".date('H:i')."</td><td>&nbsp;</td><td style='word-break: break-all;'>".$tuti->oup_m_tuti_msg[1]."</td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td style='word-break: break-all;'>".$tuti->oup_m_tuti_msg[2]."</td></tr></table>"); }
          else { print("</td></tr><tr><td>".date('m/d')."(".$week[$w].")".date('H:i')."</td></tr></table>"); }
          ?>
          </div>
        </div>
      </div>
    </div>

    <!-- メニュー -->
    <div class="row">
      <!-- 上番・下番 -->
      <div class="col-12 my-1">
        <button class="btn btn-success btn-block" role="button" style="height:80px;"
          onclick="location.href='dakoku1.php'">上番・下番</button>
      </div>

      <?php /* 上番報告(リーダー用) */ ?>
      <?php if ($staff->oup_m_staff_auth[0] !== '4') { ?>
      <div class="col-6 my-1">
        <button class="btn btn-success btn-block" role="button" style="height:80px;"
          onclick="location.href='joban1.php'">上番報告<br />（リーダー用）</button>
      </div>
      <?php } ?>

      <?php /* 下番報告(リーダー用) */ ?>
      <?php if ($staff->oup_m_staff_auth[0] !== '4') { ?>
      <div class="col-6 my-1">
        <button class="btn btn-success btn-block" role="button" style="height:80px;"
          onclick="location.href='kaban1.php'">下番報告<br />（リーダー用）</button>
      </div>
      <?php } ?>

      <?php /* 勤務予定表 */ ?>
      <?php if ($staff->oup_m_staff_auth[0] !== '4') { ?>
      <div class="col-6 my-1">
        <button class="btn btn-success  btn-block" role="button" style="height:80px;"
          onclick="location.href='kanri/kinmuyotei.php'">勤務予定表</button>
      </div>
      <?php } ?>

      <!-- 勤務照会 -->
      <div class="col-6 my-1">
        <button class="btn btn-success  btn-block" role="button" style="height:80px;"
          onclick="location.href='kanri/kinmujokyo.php?flg=1'">勤務照会</button>
      </div>

      <!-- 勤務状況一覧 -->
      <div class="col-6 my-1">
        <button class="btn btn-success btn-block" role="button" style="height: 80px;"
          onclick="location.href='kanri/kinmujokyo.php'">勤務状況一覧</button>
      </div>

      <?php /* 管理者メニューは本部のみ */ ?>
      <?php if ($staff->oup_m_staff_auth[0] == '1') { ?>
      <div class="col-6 my-1">
        <button class="btn btn-info btn-block" role="button" style="height:80px;"
          onclick="location.href='kanri/menu.php'">管理者メニュー</button>
      </div>
      <?php } ?>

      <!-- ログアウト -->
      <div class="col-6 my-1">
        <form name="frm3" method="POST" action="login.php">
          <button name="logout" class="btn btn-secondary btn-block" role="button" style="height:80px;">ログアウト</button>
        </form>
      </div>
    </div>

    <!-- <button class="btn btn-success btn-lg btn-block" role="button"
      onclick="location.href='joban0.php'">早出予定入力（リーダー用）</button>
    <div class="col-12" style="padding: 8px;"></div>
    <button class="btn btn-success btn-lg btn-block" role="button"
      onclick="location.href='joban1_20190613.php'">上番報告（リーダー用）修正前</button>
    <button class="btn btn-success btn-lg btn-block" role="button"
      onclick="location.href='kaban1_20190614.php'">下番報告（リーダー用）修正前</button>
    <button class="btn btn-success btn-lg btn-block" role="button"
      onclick="location.href='kaban1.php'">下番報告（リーダー用）修正後</button>

    <div class="row">
      <div class="col-6 col-sm-6 col-md-6">
        <?php if ($todayworkflg) { ?>
        <button class="btn btn-success btn-block" role="button" style="height:80px;"
          onclick="location.href='joban3.php'">上番報告<br />（個人用）</button>
        <?php } ?>
      </div>
      <div class="col-6 col-sm-6 col-md-6">
        <?php if ($todayworkflg) { ?>
        <button class="btn btn-success btn-block" role="button" style="height:80px;"
          onclick="location.href='kaban4.php'">下番報告<br />（個人用）</button>
        <?php } ?>
      </div>
    </div>

    <button class="btn btn-success btn-lg btn-block" role="button"
      onclick="location.href='kanri/kinmujokyo.php'">勤務状況一覧</button>
    <button class="btn btn-primary btn-block" role="button" onclick="location.href='tisou.php'">遅刻・早退申請</button>
    <button class="btn btn-primary btn-block" role="button" onclick="location.href='kyuka.php'">休暇申請</button>
    <button class="btn btn-primary btn-block" role="button" onclick="location.href='kotuhi1.php'">交通費登録</button> -->
  </div>
</body>

</html>