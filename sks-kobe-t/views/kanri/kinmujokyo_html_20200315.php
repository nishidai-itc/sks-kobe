<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">

  <!-- bootstrap-4.3.1 -->
  <link href="./../bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="./../bootstrap-4.3.1/jquery-3.4.1.min.js"></script>
  <script src="./../bootstrap-4.3.1/js/bootstrap.bundle.min.js"></script>

  <!-- fontawesome -->
  <link href="./../fontawesome-free-5.11.2-web/css/all.min.css" rel="stylesheet">

  <title>勤怠管理システム</title>
</head>

<script>
function confirm1(no) {
  if (!confirm('この項目を削除してもよろしいですか?')) return false;
  location.href = "shift2.php?act=2&shift_id=" + no + "&shift_id2=" + no;
}

// チェックボックスのクリック判定
$(function() {
  // 全選択ボタンの押下時
  $('#all-checked').on("click", function() {
    $('.teate-checked').prop("checked", $(this).prop("checked"));
  });
});
</script>

<body>
  <div class="container">
    <div class="page-header">
      <h4>勤務状況詳細一覧</h4>
    </div>

    <form name="frm" method="POST" action="kinmujokyo.php">

      <div class="row">
        <div class="col-xs-12 col-md-12">
          <table border="1">
            <tr>
              <td>
                <table style="font-size: 10pt;">
                  <tr>
                    <td bgcolor="#d5d5d5">日付　</td>
                    <td bgcolor="#d5d5d5"><input type="tel" size="8" class="form-control" name="startday"
                        value="<?php print($startday); ?>"></td>
                    <td bgcolor="#d5d5d5">　～　</td>
                    <td bgcolor="#d5d5d5"><input type="tel" size="8" class="form-control" name="endday"
                        value="<?php print($endday); ?>"></td>
                    <td bgcolor="#d5d5d5">　現場　</td>
                    <td bgcolor="#d5d5d5">
                      <select id="genba_id" name="genba_id" class="form-control">
                        <option>
                          <?php for ($i=0;$i<count($genba->oup_m_genba_id);$i++) { ?>
                        <option value="<?php print($genba->oup_m_genba_id[$i]); ?>" <?php
                        if ($genba_id===$genba->oup_m_genba_id[$i]) {
                            print("selected");
                        } ?>><?php print($genba->oup_m_genba_name[$i]); ?></option>
                        <?php } ?>
                      </select>
                    </td>
                    <td bgcolor="#d5d5d5">　隊員　</td>
                    <!--
                      <td bgcolor="#d5d5d5">
                        <select id="selection" class="form-control">
                          <option>
                          <option>ア
                          <option>カ
                          <option>サ
                          <option>タ
                          <option>ナ
                        </select>
                      </td> -->
                    <td bgcolor="#d5d5d5">
                      <select id="staff_id" name="staff_id" class="form-control">
                        <option>
                          <?php for ($i=0;$i<count($staff->oup_m_staff_id);$i++) { ?>
                        <option value="<?php print($staff->oup_m_staff_id[$i]); ?>" <?php
                        if ($staff_id===$staff->oup_m_staff_id[$i]) {
                            print("selected");
                        } ?>><?php print($staff->oup_m_staff_name[$i]); ?></option>
                        <?php } ?>
                      </select>
                    </td>
                    <td bgcolor="#d5d5d5">
                      <button type="submit" class="btn btn-info btn-block" role="button" name="search">検索</button>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </div>
        <div class="col-12">
          <table border="1" align="right">
            <tr align="center">
              <td width="100">下番</td>
              <td width="100" bgcolor="FFDCA5">上番中</td>
              <td width="100" bgcolor="d5d5d5">未</td>
            </tr>
          </table>
        </div>
      </div>

      <br />

      <!-- 一覧 -->
      <div class="row">
        <div class="col-12">
          <table border="1" style="font-size: 10pt;">
            <thead>
              <tr class="text-center">
                <td width="30" rowspan="2" bgcolor="FFDCA5">詳細</td>
                <td width="30" rowspan="2" bgcolor="FFDCA5"><input type="checkbox" id="all-checked"></td>
                <td width="60" rowspan="2" bgcolor="FFDCA5">日付</td>
                <td width="85" rowspan="2" bgcolor="FFDCA5">現場</td>
                <td width="100" rowspan="2" bgcolor="FFDCA5">氏名</td>
                <td width="60" rowspan="2" bgcolor="FFDCA5">勤務</td>
                <td width="70" colspan="1" bgcolor="FFDCA5">所定時間</td>
                <td width="70" colspan="1" bgcolor="d5d5d5">打刻</td>
                <td width="70" colspan="1" bgcolor="d5d5d5">実績</td>
                <td width="70" rowspan="2" bgcolor="FFDCA5">&nbsp;</td>
                <td width="70" rowspan="2" bgcolor="d5d5d5">交通費</td>
                <td colspan="4" bgcolor="d5d5d5">時間外勤務</td>
                <?php if ($staff2->oup_m_staff_auth[0]=="1") { ?>
                    <td colspan="6" bgcolor="d5d5d5">手当て</td>
                <?php } else { ?>
                    <td bgcolor="d5d5d5">手当て</td>
                <?php } ?>
              </tr>
              <tr class="text-center">
                <td width="60" bgcolor="FFDCA5">開始<br>終了</td>
                <td width="60" bgcolor="d5d5d5">上番<br>下番</td>
                <td width="60" bgcolor="d5d5d5">上番<br>下番</td>
                <td width="60" bgcolor="d5d5d5">早出<br>通常</td>
                <td width="60" bgcolor="d5d5d5">昼残</td>
                <td width="60" bgcolor="d5d5d5">休憩<br>残業</td>
                <td width="60" bgcolor="d5d5d5">深夜<br>残業</td>
                <td width="60" bgcolor="d5d5d5">ﾎﾟｽﾄ</td>
                <?php if ($staff2->oup_m_staff_auth[0]=="1") { ?>
                    <td width="60" bgcolor="d5d5d5"><?php print($teate->oup_m_teate_name[0]); ?></td>
                    <td width="60" bgcolor="d5d5d5"><?php print($teate->oup_m_teate_name[1]); ?></td>
                    <td width="60" bgcolor="d5d5d5"><?php print($teate->oup_m_teate_name[2]); ?></td>
                    <td width="60" bgcolor="d5d5d5"><?php print($teate->oup_m_teate_name[3]); ?></td>
                    <td width="60" bgcolor="d5d5d5"><?php print($teate->oup_m_teate_name[4]); ?></td>
                <?php } ?>
              </tr>
            </thead>

            <tbody>
              <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { ?>
              <tr class="text-center">
                <!-- 詳細 -->
                <td>
                  <a href="kinmujokyosyousai.php?no=<?php print($wkdetail->oup_t_wk_detail_no[$i]); ?>">
                    <i class="fas fa-pen"></i>
                  </a>
                </td>
                <!-- チェックボックス -->
                <td>
                  <input name="check_teate[<?php echo $i; ?>]" type="checkbox" class="teate-checked"
                    value="<?php echo $wkdetail->oup_t_wk_detail_no[$i]; ?>">
                </td>
                <!-- 日付 -->
                <td>
                  <?php print(substr($wkdetail->oup_t_wk_plan_date[$i], 5, 2)."/".substr($wkdetail->oup_t_wk_plan_date[$i], 8, 2)); ?>
                </td>
                <!-- 現場 -->
                <td><?php print($genbas[$wkdetail->oup_t_wk_genba_id[$i]]); ?></td>
                <!-- 氏名 -->
                <td><?php print($staffs[$wkdetail->oup_t_wk_taiin_id[$i]]); ?></td>
                <!-- 勤務 -->
                <td><?php print($shift->kbn2[$wkdetail->oup_t_wk_plan_kbn[$i]]); ?></td>
                <!-- 所定時間 -->
                <td>
                  <?php echo $wkdetail->oup_t_wk_plan_joban_time[$i] !== null ? $wkdetail->oup_t_wk_plan_joban_time[$i] : '&nbsp;'; ?>
                  <br>
                  <?php echo $wkdetail->oup_t_wk_plan_kaban_time[$i] !== null ? $wkdetail->oup_t_wk_plan_kaban_time[$i] : '&nbsp;'; ?>
                </td>
                <!-- 打刻 -->
                <td>
                  <?php echo $wkdetail->oup_t_wk_joban_dakoku_time[$i] !== null ? $wkdetail->oup_t_wk_joban_dakoku_time[$i] : '&nbsp;'; ?>
                  <br>
                  <?php echo $wkdetail->oup_t_wk_kaban_dakoku_time[$i] !== null ? $wkdetail->oup_t_wk_kaban_dakoku_time[$i] : '&nbsp;'; ?>
                </td>
                <!-- 実績 -->
                <td>
                  <?php echo $wkdetail->oup_t_wk_joban_time[$i] !== null ? $wkdetail->oup_t_wk_joban_time[$i] : '&nbsp;'; ?>
                  <br>
                  <?php echo $wkdetail->oup_t_wk_kaban_time[$i] !== null ? $wkdetail->oup_t_wk_kaban_time[$i] : '&nbsp;'; ?>
                </td>
                <!--  -->
                <td>
                  <?php
                  if ($wkdetail->oup_t_wk_kaban_kbn[$i]=="1") {
                      print("下番");
                  } elseif ($wkdetail->oup_t_wk_joban_kbn[$i]!="") {
                      print("上番中");
                  } else {
                      print("未");
                  } ?>
                </td>
                <!-- 交通費 -->
                <td><?php print($wkdetail->oup_t_wk_kotuhi[$i]); ?></td>
                <!-- 早出, 通常 -->
                <td>
                  <?php
                  // 差分を表示
                  if ($wkdetail->oup_t_wk_plan_joban_time[$i] !== null && $wkdetail->oup_t_wk_joban_time[$i] !== null) {
                      $plan_joban_time = new DateTime($wkdetail->oup_t_wk_plan_joban_time[$i]);
                      $joban_time = new DateTime($wkdetail->oup_t_wk_joban_time[$i]);
                      $interval = $plan_joban_time->diff($joban_time);
                      echo $interval->format('%H:%I');
                  } else {
                      echo '&nbsp;';
                  }
                  ?>
                  <br>
                  <?php
                  // 差分を表示
                  if ($wkdetail->oup_t_wk_plan_kaban_time[$i] !== null && $wkdetail->oup_t_wk_kaban_time[$i] !== null) {
                      $plan_kaban_time = new DateTime($wkdetail->oup_t_wk_plan_kaban_time[$i]);
                      $kaban_time = new DateTime($wkdetail->oup_t_wk_kaban_time[$i]);
                      $interval = $plan_kaban_time->diff($kaban_time);
                      echo $interval->format('%H:%I');
                  } else {
                      echo '&nbsp;';
                  }
                  ?>
                </td>
                <!-- 昼残残業時間 -->
                <td><?php print($wkdetail->oup_t_wk_daytime_over_time[$i]); ?></td>
                <!-- 休憩残業時間 -->
                <td><?php print($wkdetail->oup_t_wk_rest_over_time[$i]); ?></td>
                <!-- 深夜残業時間 -->
                <td><?php print($wkdetail->oup_t_wk_midnight_over_time[$i]); ?></td>
                <!-- ポスト手当て -->
                <td><?php print($wkdetail->oup_t_wk_post_teate[$i]); ?></td>
                <?php if ($staff2->oup_m_staff_auth[0]=="1") { ?>
                    <!-- 正月手当て -->
                    <td><?php print($wkdetail->oup_t_wk_shogatu_teate[$i]); ?></td>
                    <!-- 夏季手当て -->
                    <td><?php print($wkdetail->oup_t_wk_kaki_teate[$i]); ?></td>
                    <!-- 手当て1 -->
                    <td><?php print($wkdetail->oup_t_wk_etc_teate1[$i]); ?></td>
                    <!-- 手当て2 -->
                    <td><?php print($wkdetail->oup_t_wk_etc_teate2[$i]); ?></td>
                    <!-- 手当て3 -->
                    <td><?php print($wkdetail->oup_t_wk_etc_teate3[$i]); ?></td>
                <?php } ?>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>

      <br />

      <div class="row">
        <div class="col-12">
          <table>
            <tr>
              <td>手当て一括登録　</td>
              <td>
                <select name="select_teate" class="form-control">
                  <option value="">
                  <option value="shogatu_teate">正月
                  <option value="kaki_teate">夏季
                  <option value="etc_teate1">1
                  <option value="etc_teate2">2
                  <option value="etc_teate3">3
                </select>
              </td>
              <td>
                <input type="tel" name="input_teate" size="6" class="form-control" value="">
              </td>
              <td>
                <button type="submit" class="btn btn-success btn-block">登録</button>
              </td>
            </tr>
          </table>
        </div>
      </div>

      <br />

      <div class="row">
        <div class="col-12">
          <?php if ($staff2->oup_m_staff_auth[0]=="1") { ?>
          <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">メニューに戻る</a>
          <?php } else { ?>
          <a href="../menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">メニューに戻る</a>
          <?php } ?>
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