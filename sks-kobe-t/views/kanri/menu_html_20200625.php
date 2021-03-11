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
  <link href="./../bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="./../bootstrap-4.3.1/jquery-3.4.1.min.js"></script>
  <script src="./../bootstrap-4.3.1/js/bootstrap.bundle.min.js"></script>

  <title>勤怠管理システム</title>
</head>

<body>
  <div class="container">
    <!-- ヘッダー -->
    <div class="page-header">
      <h4>管理者メニュー</h4>
    </div>

    <!-- ログイン者情報 -->
    <div class="row">
      <div class="col-12">
        <div class="card" style="padding: 10px;">
          <div class="card-body">
            <?php print($common->html_display($staff->oup_m_staff_name[0])); ?> さん
            <br /><?php print(date('m/d')) ?>(<?php print($week[$w]); ?>) <?php print(date('H:i')) ?>
            </div>
        </div>
      </div>
    </div>

    <!-- メニュー -->
    <div class="row">
      <!-- 勤務予定表 -->
      <div class="col-4 my-1">
        <button class="btn btn-success btn-block" role="button" style="height: 70px;"
          onclick="location.href='kinmuyotei.php'">勤務予定表</button>
      </div>

      <!-- 勤務状況一覧 -->
      <div class="col-4 my-1">
        <button class="btn btn-success btn-block" role="button" style="height: 70px;"
          onclick="location.href='kinmujokyo.php'">勤務状況一覧</button>
      </div>

      <!-- 配置照会 -->
      <div class="col-4 my-1">
        <button class="btn btn-success btn-block" role="button" style="height: 70px;"
          onclick="location.href='haitihyo.php'">配置照会</button>
      </div>

      <!-- ポスト手当て登録 -->
      <div class="col-4 my-1">
        <button class="btn btn-primary btn-block" role="button" style="height: 70px;"
          onclick="location.href='./../post_teate1.php'">ﾎﾟｽﾄ手当て登録</button>
      </div>

      <!-- 車手当て登録 -->
      <div class="col-4 my-1">
        <button class="btn btn-primary  btn-block" role="button" style="height: 70px;"
          onclick="location.href='./../car_teate1.php'">車手当て登録</button>
      </div>

      <!-- 交通費登録 -->
      <div class="col-4 my-1">
        <button class="btn btn-primary btn-block" role="button" style="height: 70px;"
          onclick="location.href='../kotuhi1.php'">交通費登録</button>
      </div>

      <!-- 現場登録 -->
      <div class="col-4 my-1">
        <button class="btn btn-primary btn-block" role="button" style="height: 70px;"
          onclick="location.href='genba1.php'">現場登録</button>
      </div>

      <!-- <div class="col-4 my-1">
        <button class="btn btn-success btn-block" role="button" style="height: 70px;"
          onclick="location.href='#'">(勤怠登録)</button>
      </div> -->

      <!-- 勤務予定表集計 -->
      <div class="col-4 my-1">
        <button class="btn btn-success btn-block" role="button" style="height: 70px;"
          onclick="location.href='shukei.php'">勤務予定表集計</button>
      </div>

      <!-- 勤務照会 -->
      <div class="col-4 my-1">
        <button class="btn btn-success  btn-block" role="button" style="height: 70px;"
          onclick="location.href='./../recently_list.php#today'">勤務照会</button>
      </div>

      <!-- 勤務集計表 -->
      <div class="col-4 my-1">
        <button class="btn btn-success btn-block" role="button" style="height: 70px;"
          onclick="location.href='kinmusyukei.php'">勤務集計表</button>
      </div>

      <!-- 隊員登録 -->
      <div class="col-4 my-1">
        <button class="btn btn-primary btn-block" role="button" style="height: 70px;"
          onclick="location.href='staff1.php'">隊員登録</button>
      </div>

      <!-- 勤務体系登録 -->
      <div class="col-4 my-1">
        <button class="btn btn-primary btn-block" role="button" style="height: 70px;"
          onclick="location.href='shift1.php'">勤務体系登録</button>
      </div>

      <!-- 手当て名称登録 -->
      <div class="col-4 my-1">
        <button class="btn btn-primary btn-block" role="button" style="height: 70px;"
          onclick="location.href='teate.php'">手当て名称登録</button>
      </div>

      <!-- <div class="col-4 my-1">
        <button class="btn btn-info btn-block" role="button" style="height: 70px;"
          onclick="location.href='#'">(単価登録)</button>
      </div> -->

      <!-- 隊員メニュー -->
      <div class="col-4 my-1">
        <button class="btn btn-info btn-block" role="button" style="height: 70px;"
          onclick="location.href='../menu.php'">隊員メニュー</button>
      </div>

      <!-- ログアウト -->
      <div class="col-4 my-1">
        <form name="frm3" method="POST" action="./../login.php">
          <button name="logout" class="btn btn-secondary  btn-block" role="button" style="height: 70px;">ログアウト</button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>