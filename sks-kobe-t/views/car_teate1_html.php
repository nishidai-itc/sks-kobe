<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">

  <!-- bootstrap-4.3.1 -->
  <link href="./bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="./bootstrap-4.3.1/jquery-3.4.1.min.js"></script>
  <script src="./bootstrap-4.3.1/js/bootstrap.bundle.min.js"></script>

  <!-- fontawesome -->
  <link href="./fontawesome-free-5.11.2-web/css/all.min.css" rel="stylesheet">

  <title>勤怠管理システム</title>
</head>

<script>
function confirm1(no) {
  if (!confirm('この項目を削除してもよろしいですか?')) return false;
  location.href = "car_teate2.php?act=2&car_teate_no=" + no;
}
</script>


<body>
  <div class="container">
    <div class="page-header">
      <h4>車手当て一覧</h4>
    </div>

    <form name="frm" method="POST" action="login.php">

      <div class="card" style="padding: 10px;">
        <div class="card-body">
          <?php print($common->html_display($staff->oup_m_staff_name[0])); ?>
          さん<br /><?php print(date('m/d')) ?>(<?php print($week[$w]); ?>) <?php print(date('h:i')) ?>
        </div>
      </div>

      <br>

      <div class="row">
        <div class="col-6">
          <a href="car_teate2.php" class="btn btn-success btn-block" role="button" aria-pressed="true">新規登録</a>
        </div>
        <div class="col-6">
          <a href="kanri/menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
        </div>
      </div>

      <br>

      <div class="row">
        <div class="col-12">
        <table class="table table-sm table-bordered">
            <thead>
              <tr class="text-center">
                <td bgcolor="FFDCA5">&nbsp;</td>
                <td bgcolor="FFDCA5">社員</td>
                <td bgcolor="FFDCA5">現場</td>
                <td bgcolor="FFDCA5">シフト</td>
                <td bgcolor="FFDCA5">金額</td>
                <td bgcolor="FFDCA5">&nbsp;</td>
              </tr>
            </thead>

            <tbody>
              <?php if ($car_teate->oup_m_car_teate_no) { ?>
              <?php
              for ($i=0; $i<count($car_teate->oup_m_car_teate_no); $i++) {
                  // 社員IDから社員名を取得
                  $staff = new Staff; // Staffクラスの初期化
                  $staff->inp_m_staff_id = $car_teate->oup_m_car_teate_staff_id[$i];
                  $staff->getStaff();
                
                  // シフトNoからシフトを取得
                  $shift = new Shift; // Shiftクラスの初期化
                  $shift->inp_m_shift_no = $car_teate->oup_m_car_teate_shift_no[$i];
                  $shift->getShift();
                
                  $kubun = ''; // 表示用に整形
                  foreach ($shift->kbn as $status => $kbn) {
                      if ($shift->oup_m_shift_plan_kbn[0] == $status) {
                          $kubun = $kbn;
                      }
                  }
                
                  // 現場IDから現場名を取得
                  $genba = new Genba; // Genbaクラスの初期化
                  $genba->inp_m_genba_id = $shift->oup_m_shift_genba_id[0];
                  $genba->getGenba(); ?>

              <tr class="text-center">
                <!-- 詳細 -->
                <td>
                  <a href="car_teate2.php?no=<?php print($car_teate->oup_m_car_teate_no[$i]); ?>">
                    <i class="fas fa-pen"></i>
                  </a>
                </td>
                <!-- 社員 -->
                <td><?php echo $staff->oup_m_staff_name[0]; ?></td>
                <!-- 現場 -->
                <td><?php echo $genba->oup_m_genba_name[0]; ?></td>
                <!-- シフト -->
                <td><?php echo $kubun . $shift->oup_m_shift_plan_hosoku[0]; ?></td>
                <!-- 金額 -->
                <td><?php echo $car_teate->oup_m_car_teate_kuruma_cost[$i]; ?></td>
                <!-- 削除 -->
                <td>
                  <a href="car_teate2.php?act=2&no=<?php print($car_teate->oup_m_car_teate_no[$i]); ?>" onClick="confirm1(<?php print($car_teate->oup_m_car_teate_no[$i]); ?>);">
                    <i class="fas fa-trash-alt"></i>
                  </a>
                </td>
              </tr>
              <?php } ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>

      <br>

      <div class="row">
        <div class="col-6">
          <a href="car_teate2.php" class="btn btn-success btn-block" role="button" aria-pressed="true">新規登録</a>
        </div>
        <div class="col-6">
          <a href="kanri/menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
        </div>
      </div>

      <br>

    </form>
  </div>

  <div class="modal-footer">
    <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
  </div><!-- /footer -->

</body>

</html>