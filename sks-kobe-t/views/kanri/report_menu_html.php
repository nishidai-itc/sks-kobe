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
            <?php print($common->html_display($staff->oup_m_staff_name[0])." さん　　　".date("m/d")."(".getWeek($today).")".$totime); ?>
          </div>
        </div>
      </div>
    </div>
    <br>

    <form action="report_menu.php" method="post">

    <div class="row">
      <div class="col-12"><?php echo substr($plan_date,5,2)."月".substr($plan_date,8,2)."日分　(".getWeek($plan_date).")"; ?></div>
    </div>
    <br>

    <!-- メニュー -->
    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <thead>
            <tr class="table-secondary">
              <!-- <th class="text-center" style="width:100px;">日付</th> -->
              <th class="" style="width:100px;">入力状態</th>
              <th class="text-center" style="width:100px;">詳細</th>
              <th>勤務場所</th>
              <th>契約先</th>
              <th class="text-center" style="width:100px;">削除</th>
            </tr>
          </thead>
          <?php for ($i=0;$i<count($report->oup_no);$i++) { ?>
          <?php //if (!$flg[$report->oup_no[$i]]) {continue;} ?>
          <tr>
            <!-- <td class="text-center"><?php echo substr($plan_date,5,2)."/".substr($plan_date,8,2)."(".getWeek($plan_date).")"; ?></td> -->
            <td><?php echo $report_kbn[$report->oup_table[$i]] ? $report_kbn[$report->oup_table[$i]] : "未入力" ; ?></td>
            <td class="text-center">
              <a href="./report<?php echo $report->oup_table[$i]; ?>.php?plan_date=<?php echo $report_no[$report->oup_table[$i]] ? $plan_date."&no=".$report_no[$report->oup_table[$i]] : $plan_date ; ?>">
                <i class="fas fa-pen"></i>
              </a>
            </td>
            <td><?php echo $report->oup_place[$i]; ?></td>
            <td><?php echo $report->oup_contract[$i]; ?></td>
            <td class="text-center">
              <?php if ($report_no[$report->oup_table[$i]]) { ?>
              <a href="#" onclick="conf(<?php echo $report_no[$report->oup_table[$i]].','.$report->oup_table[$i] ; ?>);">
                <i class="fa fa-times" style="color: red;"></i>
              </a>
              <?php } ?>
            </td>
          </tr>
          <?php } ?>
        </table>
      </div>
    </div>
    <br>

    <input type="hidden" name="no" value="">
    <input type="hidden" name="act" value="2">
    </form>

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

function conf(no,table) {
  if (!confirm('警備報告書を削除します。よろしいですか？')) return false

  $('[name="no"]').val(no+','+table)
  $('form').submit()
}

// $('.report1').click(function(){
//   location.href = './report1.php'
// })
</script>