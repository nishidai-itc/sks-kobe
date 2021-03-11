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

<script type="text/javascript">
// <!--
function func() {
  document.frm.submit();
}

function func2(arg1) {
  document.frm.act.value = '2';
  document.frm.work_day.value = arg1;
  document.frm.submit();
}
// 
// -->
</script>

<body>
  <div class="container">
    <div class="page-header">
      <h4>勤務体系登録</h4>
    </div>

    <form name="frm" method="POST" action="shift2.php">

      <div class="card" style="padding: 10px;">
        <div class="card-body">
          <?php print($common->html_display($staff->oup_m_staff_name[0])); ?>
          さん<br /><?php print(date('m/d')) ?>(<?php print($week[$w]); ?>) <?php print(date('H:i')) ?>
        </div>
      </div>
      <br />

      <!-- メッセージの表示 -->
      <?php if (isset($error_message)) {?>
      <div class="row">
        <div class="col">
          <div class="alert alert-danger">
            <?php echo $error_message; ?>
          </div>
        </div>
      </div>
      <?php } ?>

      <div class="row">
        <div class="col-xs-12 col-md-12">
          <table border="1">
            <tr align="center">
              <td width="85" bgcolor="FFDCA5">勤務区分</td>
              <td width="85">
                <select name="plan_kbn" id="selection" class="form-control">
                  <option value=""></option>
                  <option value="1" <?php
                  if ($plan_kbn=="1") {
                      print("selected");
                  } ?>>泊</option>
                  <option value="2" <?php
                  if ($plan_kbn=="2") {
                      print("selected");
                  } ?>>日</option>
                  <option value="3" <?php
                  if ($plan_kbn=="3") {
                      print("selected");
                  } ?>>夜</option>
                  <option value="4" <?php
                  if ($plan_kbn=="4") {
                      print("selected");
                  } ?>>年</option>
                  <option value="5" <?php
                  if ($plan_kbn=="5") {
                      print("selected");
                  } ?>>欠</option>
                  <option value="6" <?php
                  if ($plan_kbn=="6") {
                      print("selected");
                  } ?>>時</option>
                </select>
              </td>
            </tr>
            <tr>
              <td width="85" bgcolor="FFDCA5">背景カラー</td>
              <td width="85">
                <select name="color" id="selection" class="form-control">
                  <option value=" ">なし</option>
                  <?php foreach ($color_code_list as $color_code => $color_name) { ?>
                  <option value="<?php echo $color_code; ?>" <?php
                    if ($color==$color_code) {
                        echo("selected");
                    } ?>><?php echo $color_name;?>
                  </option>
                  <?php } ?>
                </select>
              </td>
            </tr>
            <tr align="center">
              <td width="85" bgcolor="FFDCA5">補足文字</td>
              <td><input type="text" name="plan_hosoku" value="<?php print($plan_hosoku); ?>"
                  maxlength="1" size="3"></td>
            </tr>
            <tr align="center">
              <td width="85" bgcolor="FFDCA5">現場名</td>
              <td>
                <select name="genba_id" id="selection" class="form-control">
                  <option value=""></option>
                  <?php
                  $disp = false;
                  for ($i=0;$i<count($genba->oup_m_genba_id);$i++) {
                      if ($genba->oup_m_genba_id[$i] == $genba_id) {
                          $selected = 'selected';
                          $disp = true;
                      } else {
                          $selected = '';
                      } ?>
                  <option value="<?php echo $genba->oup_m_genba_id[$i]; ?>" <?php echo $selected; ?>>
                    <?php print($genba->oup_m_genba_name[$i]); ?></option>
                  <?php
                  } ?>
                </select>
              </td>
            </tr>
            <tr align="center">
              <td width="85" bgcolor="FFDCA5">上番時間</td>
              <td><input type="time" name="joban_time" value="<?php print($joban_time); ?>"></td>
            </tr>
            <tr align="center">
              <td width="85" bgcolor="FFDCA5">下番時間</td>
              <td><input type="time" name="kaban_time" value="<?php print($kaban_time); ?>"></td>
            </tr>
            <tr align="center">
              <td width="85" bgcolor="FFDCA5">休憩開始</td>
              <td><input type="time" name="kyukei_start" value="<?php print($kyukei_start); ?>">
              </td>
            </tr>
            <tr align="center">
              <td width="85" bgcolor="FFDCA5">休憩終了</td>
              <td><input type="time" name="kyukei_end" value="<?php print($kyukei_end); ?>"></td>
            </tr>
            <tr align="center">
              <td width="85" bgcolor="FFDCA5">時給</td>
              <td><input type="number" name="jikyu" value="<?php print($jikyu); ?>"></td>
            </tr>
            <tr align="center">
              <td width="85" bgcolor="FFDCA5">日給</td>
              <td><input type="number" name="nikyu" value="<?php print($nikyu); ?>"></td>
            </tr>
            <tr align="center">
              <td width="85" bgcolor="FFDCA5">労働時間</td>
              <td><input type="number" name="rodo_time" value="<?php print($rodo_time); ?>"></td>
            </tr>
            <tr align="center">
              <td width="85" bgcolor="FFDCA5">残業時間</td>
              <td><input type="number" name="over_time" value="<?php print($over_time); ?>"></td>
            </tr>
            <tr align="center">
              <td width="85" bgcolor="FFDCA5">休憩時間</td>
              <td><input type="number" name="kyukei_time" value="<?php print($kyukei_time); ?>">
              </td>
            </tr>
            <tr align="center">
              <td width="120" bgcolor="FFDCA5">使用終了日</td>
              <td><input type="date" name="deleteday" value="<?php print($deleteday); ?>" maxlength=8>
              </td>
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
          <a href="shift1.php#<?php print($shift_no); ?>" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
        </div>
      </div>
      <br />

      <input type="hidden" name="act" value="1">
      <input type="hidden" name="shift_id2" value="<?php print($shift_id2); ?>">
      <!-- <input type="hidden" name="jikyu" value="0"> -->

    </form>

  </div>

  <div class="modal-footer">
    <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
  </div><!-- /footer -->

</body>

</html>