<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" media="screen, projection" />
  <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>　
  <title>勤怠管理システム</title>
</head>

<body>
  <div class="container">
    <div class="page-header">
      <h4>上番・下番打刻</h4>
    </div>
  </div>

  <div class="container">
    <!-- 隊員IDを検索 -->
    <form method="POST" action="dakoku1.php">
      <div class="row justify-content-center">
        <!-- <div class="col-4">隊員ID</div> -->
        <div class="col">
          <label>隊員ID</label>
          <input type="tel" class="form-control" name="staff_id" autocomplete="off" required>
        </div>
      </div>
      <br>
      <div class="row justify-content-center">
        <div class="col-11">
          <button type="submit" class="btn btn-secondary btn-block" role="button">打刻へ</button>
        </div>
      </div>
    </form>

    <!-- 隊員IDが違う場合 -->
    <!-- 隊員IDの検索が間違っていた場合 -->
    <?php if ($dakoku_staff_id === null) { ?>
    <div class="row justify-content-center">
      <div class="col-11">
        <div class="text-danger text-center">隊員IDが間違っています。</div>
      </div>
    </div>
    <?php } ?>

    <div class="row justify-content-center pt-2">
      <div class="col-8">
        <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
      </div>
    </div>
  </div>
</body>

</html>