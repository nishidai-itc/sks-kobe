<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" media="screen, projection" />
  <script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
  <script type="text/javascript" src="../bootstrap/js/jquery.balloon.js"></script>
  <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>　
  <title>勤怠管理システム</title>
</head>

<script>
function confirm1(no) {
  if (!confirm('この項目を削除してもよろしいですか?')) return false;
  location.href = "shift2.php?act=2&shift_id=" + no + "&shift_id2=" + no;
}
</script>

<body>
  <div class="container">
    <div class="page-header">
      <h4>勤務体系一覧</h4>
    </div>

    <form name="frm" method="POST" action="login.php">

      <div class="card" style="padding: 10px;">
        <div class="card-body">
          <?php print($common->html_display($staff->oup_m_staff_name[0])); ?>
          さん<br /><?php print(date('m/d')) ?>(<?php print($week[$w]); ?>) <?php print(date('H:i')) ?>
        </div>
      </div>
      <br />
      <div class="row">
        <div class="col-6">
          <a href="shift2.php" class="btn btn-success btn-block" role="button" aria-pressed="true">新規登録</a>
        </div>
        <div class="col-6">
          <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
        </div>
      </div>
      <br />
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <table border="1">
<?php for ($i=0;$i<count($shift->oup_m_shift_no);$i++) {
            if($i == 0 || $i%10 == 0){
            ?>
            <tr align="center">
              <td width="30" bgcolor="FFDCA5">&nbsp;</td>
              <td width="50" bgcolor="FFDCA5">勤務<br />区分</td>
              <td width="50" bgcolor="FFDCA5">補足<br />文字</td>
              <td width="95" bgcolor="FFDCA5">背景<br />カラー</td>
              <td width="220" bgcolor="FFDCA5">現場名</td>
              <td width="95" bgcolor="FFDCA5">上番時間</td>
              <td width="95" bgcolor="FFDCA5">下番時間</td>
              <td width="95" bgcolor="FFDCA5">休憩開始</td>
              <td width="95" bgcolor="FFDCA5">休憩終了</td>
              <td width="95" bgcolor="FFDCA5">時給</td>
              <td width="95" bgcolor="FFDCA5">日給</td>
              <td width="50" bgcolor="FFDCA5">労働<br>時間</td>
              <td width="50" bgcolor="FFDCA5">残業<br>時間</td>
              <td width="50" bgcolor="FFDCA5">休憩<br>時間</td>
              <td width="50" bgcolor="FFDCA5">合計<br>時間</td>
              <td width="30" bgcolor="FFDCA5">&nbsp;</td>
            </tr>
            <?php }
                $plan_kbn = "";
                if ($shift->oup_m_shift_plan_kbn[$i] == "1") {
                    $plan_kbn = "泊";
                } elseif ($shift->oup_m_shift_plan_kbn[$i] == "2") {
                    $plan_kbn = "日";
                } elseif ($shift->oup_m_shift_plan_kbn[$i] == "3") {
                    $plan_kbn = "夜";
                } elseif ($shift->oup_m_shift_plan_kbn[$i] == "4") {
                    $plan_kbn = "年";
                } elseif ($shift->oup_m_shift_plan_kbn[$i] == "5") {
                    $plan_kbn = "欠";
                } elseif ($shift->oup_m_shift_plan_kbn[$i] == "6") {
                    $plan_kbn = "時";
                } ?>

            <tr align="center">
              <td>
                <div id="<?php print($shift->oup_m_shift_no[$i])?>">
                    <a href="shift2.php?no=<?php print($shift->oup_m_shift_no[$i]); ?>">詳</a>
                </div>
              </td>
              <td><?php print($plan_kbn); ?></td>
              <td align="center"><?php print($shift->oup_m_shift_plan_hosoku[$i]); ?></td>
              <td style="background-color:<?php print($shift->oup_m_shift_color[$i]); ?>;">
                <?php print($color_code_list[$shift->oup_m_shift_color[$i]]); ?></td>
              <td align="left">　<?php print($genba_m[$shift->oup_m_shift_genba_id[$i]]); ?></td>
              <td><?php print(substr($shift->oup_m_shift_joban_time[$i], 0, 5)); ?></td>
              <td><?php print(substr($shift->oup_m_shift_kaban_time[$i], 0, 5)); ?></td>
              <td><?php print(substr($shift->oup_m_shift_kyukei_start[$i], 0, 5)); ?></td>
              <td><?php print(substr($shift->oup_m_shift_kyukei_end[$i], 0, 5)); ?></td>
              <td align="right"><?php print(number_format($shift->oup_m_shift_jikyu[$i])); ?>　</td>
              <td align="right"><?php print(number_format($shift->oup_m_shift_nikyu[$i])); ?>　</td>

              <!-- 労働時間, 残業時間, 休憩時間, 合計時間 -->
              <td align="right"><?php print($shift->oup_m_shift_rodo_time[$i]); ?>h</td>
              <td align="right"><?php print($shift->oup_m_shift_over_time[$i]); ?>h</td>
              <td align="right"><?php print($shift->oup_m_shift_kyukei_time[$i]); ?>h</td>
              <td align="right">
                <?php print($shift->oup_m_shift_rodo_time[$i] + $shift->oup_m_shift_over_time[$i] + $shift->oup_m_shift_kyukei_time[$i]); ?>h
              </td>

              <td><a href="#" onClick="confirm1(<?php print($shift->oup_m_shift_no[$i]); ?>);">削</a></td>
            </tr>
            <?php
            } ?>
          </table>
        </div>
      </div>
      <br />

      <div class="row">
        <div class="col-6">
          <a href="shift2.php" class="btn btn-success btn-block" role="button" aria-pressed="true">新規登録</a>
        </div>
        <div class="col-6">
          <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
        </div>
      </div>
      <br />

    </form>

  </div>

  <div class="modal-footer">
    <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
  </div><!-- /footer -->

</body>

</html>