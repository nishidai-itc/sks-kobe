<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">

<?php 
header("Cache-Control:no-cache,no-store,must-revalidate,max-age=0");
header("Cache-Control:pre-check=0,post-check=0,false");
header("Pragma:no-cache");
?>

  <!-- bootstrap-4.3.1 -->
  <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../fontawesome-free-5.11.2-web/css/all.min.css" rel="stylesheet">
  <script src="../bootstrap-4.3.1/jquery-3.4.1.min.js"></script>
  <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>

  <title>勤怠管理システム</title>
</head>

<body>
  <div class="container">
    <!-- ヘッダー -->
    <div class="page-header d-flex">
      <h4>警備報告書メニュー</h4>
      <h5>　(sks-system.com)</h5>
    </div>

    <!-- ログイン者情報 -->
    <div class="row">
      <div class="col-12">
        <div class="card" style="padding: 10px;">
          <div class="card-body">
            <?php print($common->html_display($staff->oup_m_staff_name[0])." さん　　　".date('m/d')."(".$week[$w].")".date('H:i')); ?>
          </div>
        </div>
      </div>
    </div>
    <br>

    <!-- メニュー -->
    <!-- <div class="row">
      <div class="col-12 my-1">
        <button type="button" class="btn btn-success btn-block report1" role="button">警備報告書１</button>
      </div>

      <div class="col-12 my-1">
        <button type="button" class="btn btn-success btn-block report2" role="button">警備報告書２</button>
      </div>

      <div class="col-12 my-1">
        <button type="button" class="btn btn-success btn-block report3" role="button">警備報告書３</button>
      </div>
    </div>
    <br> -->

    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <thead>
            <tr class="table-secondary">
              <th class="" style="width:100px;">入力状態</th>
              <th class="text-center" style="width:100px;">詳細</th>
              <th>勤務場所</th>
              <th>契約先</th>
              <th class="text-center" style="width:100px;">削除</th>
            </tr>
          </thead>
          <?php for ($i=0;$i<count($data);$i++) { ?>
          <?php if ($i == 3) {continue;} ?>
          <tr>
            <td>
              <?php //if ($i == 0) {echo "未入力";} elseif ($i == 1) {echo "一時保存";} elseif ($i == 2) {echo "完了";} else {echo "";} ?>
              <?php if ($data[$i]["kbn"] == "1") {echo "完了";} elseif ($data[$i]["kbn"] == "2") {echo "一時保存";} else {echo "未入力";} ?>
            </td>
            <td class="text-center">
              <a href="./report<?php echo $data[$i]["table"]; ?>.php<?php echo $data[$i]["no"] ? "?no=".$data[$i]["no"] : "" ; ?>">
                <i class="fas fa-pen"></i>
              </a>
            </td>
            <td>
              <?php //echo $place[$i]; ?>
              <?php echo $data[$i]["place"]; ?>
            </td>
            <td>
              <?php //echo $company[$i]; ?>
              <?php echo $data[$i]["contract"]; ?>
            </td>
            <td class="text-center">
              <!-- <a href="#"><i class="fa fa-times" style="color: red;"></i></a> -->
            </td>
          </tr>
          <?php } ?>
        </table>
      </div>
    </div>
    <br>

    <div class="row">
      <!-- メニューに戻る -->
      <div class="col-12 my-1">
        <button type="button" class="btn btn-secondary btn-block" role="button" onclick="menuBack()">メニューに戻る</button>
      </div>
    </div>
    <br>

  </div>
</body>

</html>

<script type="text/javascript">
$('button, a').css('height','50px')

function menuBack() {
  location.href = '../menu.php'
}

// $('.report1').click(function(){
//   location.href = './report1.php'
// })
</script>