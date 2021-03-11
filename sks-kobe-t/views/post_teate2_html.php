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

  <title>勤怠管理システム</title>
</head>

<body>
  <div class="container">
    <div class="page-header">
      <h4>ポスト手当て一覧</h4>
    </div>

    <form name="frm" method="POST" action="post_teate2.php" onSubmit="return false;">

      <div class="card" style="padding: 10px;">
        <div class="card-body">
          <?php print($common->html_display($staff->oup_m_staff_name[0])); ?>
          さん<br /><?php print(date('m/d')) ?>(<?php print($week[$w]); ?>) <?php print(date('h:i')) ?>
        </div>
      </div>

      <br />

      <?php
      // 社員IDから社員名を取得
      $staff = new Staff; // Staffクラスの初期化
      $staff->inp_m_staff_id = $post_teate->oup_m_post_teate_staff_id[0];
      $staff->getStaff();
      
      // シフトNoからシフトを取得
      $shift = new Shift; // Shiftクラスの初期化
      $shift->getShift();

      // スタッフのリストを取得
      $staff_list = new Staff; // Staffクラスの初期化
      $staff_list->getStaff();
      ?>

      <div class="row">
        <div class="col-12">
          <table class="table table-sm table-bordered">
            <!-- 社員 -->
            <tr class="text-center">
              <td bgcolor="FFDCA5">社員</td>
              <td>
                <select name="staff_no" class="form-control form-control-sm">
                  <option value="">
                    <?php for ($i=0; $i<count($staff_list->oup_m_staff_id); $i++) { ?>
                  <option value="<?php echo $staff_list->oup_m_staff_id[$i]; ?>" <?php
                    if ($staff_list->oup_m_staff_id[$i] == $staff->oup_m_staff_id[0]) {
                        echo ' selected';
                    } ?>>
                    <?php echo $staff_list->oup_m_staff_name[$i]; ?>
                  </option>
                  <?php } ?>
                </select>
                <!-- <?php print($staff->oup_m_staff_name[0]); ?> -->
              </td>
            </tr>
            <!-- 現場・シフト -->
            <tr class="text-center">
              <td bgcolor="FFDCA5">現場・シフト</td>
              <td>
                <select name="shift_no" class="form-control form-control-sm">
                  <option value=""></option>
                  <?php
                  for ($i=0; $i<count($shift->oup_m_shift_no); $i++) {
                      $kubun = ''; // 表示用に整形
                      foreach ($shift->kbn as $status => $kbn) {
                          if ($shift->oup_m_shift_plan_kbn[$i] == $status) {
                              $kubun = $kbn;
                          }
                      }
                        
                      // 現場IDから現場名を取得
                      $genba = new Genba; // Genbaクラスの初期化
                      $genba->inp_m_genba_id = $shift->oup_m_shift_genba_id[$i];
                      $genba->getGenba(); ?>
                  <option value="<?php echo $shift->oup_m_shift_no[$i]; ?>" <?php
                    if ($post_teate->oup_m_post_teate_shift_no[0] == $shift->oup_m_shift_no[$i]) {
                        echo ' selected';
                    } ?>>
                    <?php echo $genba->oup_m_genba_name[0] . '/' . $kubun . $shift->oup_m_shift_plan_hosoku[$i] . '/' . $shift->oup_m_shift_joban_time[$i] . '~' . $shift->oup_m_shift_kaban_time[$i]; ?>
                  </option>
                  <?php
                  } ?>
                </select>
              </td>
            </tr>
            <!-- 金額 -->
            <tr class="text-center">
              <td bgcolor="FFDCA5">金額</td>
              <td><input type="number" name="post_cost" class="form-control form-control-sm" value="<?php print($post_teate->oup_m_post_teate_post_cost[0]); ?>" max="1000000" min="0"></td>
            </tr>
          </table>
        </div>
      </div>

      <br />

      <div class="row">
        <div class="col-6">
          <button type="button" onclick="submit();" class="btn btn-success btn-block" role="button">登録</button>
        </div>
        <div class="col-6">
          <a href="post_teate1.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
        </div>
      </div>
      <br />

      <input type="hidden" name="act" value="1">
      <input type="hidden" name="post_teate_no" value="<?php print($post_teate->oup_m_post_teate_no[0]); ?>">

    </form>

  </div>

  <div class="modal-footer">
    <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
  </div><!-- /footer -->

</body>

</html>