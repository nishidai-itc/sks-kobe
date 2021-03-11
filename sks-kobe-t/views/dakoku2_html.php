<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">
  <title>勤怠管理システム</title>

  <!-- bootstrap-4.3.1 -->
  <link href="./bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="./bootstrap-4.3.1/jquery-3.4.1.min.js"></script>
  <script src="./bootstrap-4.3.1/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <style>
  /* 隊員IDと氏名欄 */
  .display-font-size {
    font-size: 1.2rem;
    font-weight: 500;
    line-height: 1.2;
  }

  /* 上番下番の打刻ボタン */
  .dakoku-button-font-size {
    font-size: 2.0rem;
    font-weight: 500;
    line-height: 1.2;
  }
  </style>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 border border-dark display-font-size">
        <div class="row">
          <div class="col-4">社員ID</div>
          <div class="col"><?php echo $dakoku_staff_id; ?></div>
        </div>
        <div class="row">
          <div class="col-4">氏名</div>
          <div class="col"><?php echo $dakoku_staff_name; ?>さん</div>
        </div>
      </div>
    </div>

    <br>

    <!-- 打刻時間の表示 -->
    <div class="row justify-content-center">
      <div class="col-12 h4"><?php echo date("Y年m月d日") . '(' . $week[date("w")] . ')'; ?></div>
    </div>
    <div class="row justify-content-center">
      <div class="col-12 border border-dark">
        <div class="display-4 text-center p-3">
          <strong>
            <?php echo date("H:i"); ?>
          </strong>
        </div>
      </div>
    </div>

    <!-- 上番,下番のボタン -->
    <?php
    // 打刻されているかどうかで色を判定
    if ($work->oup_t_wk_joban_dakoku_time[0]) {
        $btn_class = 'btn-secondary';
    } else {
        $btn_class = 'btn-warning';
    }
    if ($work->oup_t_wk_kaban_dakoku_time[0]) {
        $btn_class2 = 'btn-secondary';
    } else {
        $btn_class2 = 'btn-info';
    }
    ?>
    <div class="row my-1">
      <div class="col">
        <form method="POST" action="dakoku1.php">
          <input type="hidden" name="joban_dakoku" value="<?php echo $dakoku_staff_id; ?>">
          <button type="submit" class="btn <?php echo $btn_class; ?> btn-block" role="button">
            <div class="dakoku-button-font-size p-2">上番</div>
          </button>
        </form>
      </div>
      <div class="col">
        <form method="POST" action="dakoku1.php">
          <input type="hidden" name="kaban_dakoku" value="<?php echo $dakoku_staff_id; ?>">
          <button type="submit" class="btn <?php echo $btn_class2; ?> btn-block" role="button">
            <div class="dakoku-button-font-size p-2">下番</div>
          </button>
        </form>
      </div>
    </div>

    <div class="row">
      <div class="col-6">
        <a href="menu.php" class="btn btn-success btn-block" role="button" aria-pressed="true">メニュー</a>
      </div>
      <div class="col-6">
        <form name="frm3" method="POST" action="login.php">
          <button name="logout" class="btn btn-secondary btn-block" role="button">ログアウト</button>
        </form>
      </div>
    </div>
  </div>

</body>

</html>