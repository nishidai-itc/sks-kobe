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
  <!--<script type="text/javascript" src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-multiselect-widget/3.0.0/jquery.multiselect.js"></script>
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->

  <title>勤怠管理システム</title>
</head>

<script>
function confirm1(no) {
  if (!confirm('この項目を削除してもよろしいですか?')) return false;
    location.href = "kinmujokyosyousai.php?act=2&no=" + no;
//  location.href = "shift2.php?act=2&shift_id=" + no + "&shift_id2=" + no;
}

// チェックボックスのクリック判定
$(function() {
    $("#user_kana").change( function(){
        self.location = "kinmujokyo.php?user_kana="+$('#user_kana').val()+"&startday="+$('#startday').val()+"&endday="+$('#endday').val()+"&genba_id="+$('#genba_id').val()+"&kbn="+$('#kbn').val()+"&staff_id="+$('#staff_id').val()+"&oyako_kbn="+$('.oyako:checked').val();
    });
  // 全選択ボタンの押下時
  $('#all-checked').on("click", function() {
    $('.teate-checked').prop("checked", $(this).prop("checked"));
  });
});
</script>
<script type="text/javascript">
<!--
$(function(){
  $("#genba_id").multiselect();
});
-->
</script>

<body>
  <div class="container">
    <div class="page-header">
      <h4>勤務状況一覧</h4>
    </div>

    <form name="frm" method="POST" action="kinmujokyo.php">

      <div class="row">
        <div class="col-xs-12 col-md-12">
          <table class="text-nowrap" border="1" style="font-size: 10pt; width:1200px" bgcolor="#d5d5d5">
            <tr>
              <td>
                <table class="text-nowrap" style="font-size: 10pt;">
                  <tr>
                    <td bgcolor="#d5d5d5">　日付　</td>
                    <td bgcolor="#d5d5d5"><input style="width: 170px"  type="date" size="8" class="form-control" name="startday" id="startday"
                        value="<?php print(substr($startday,0,4)."-".substr($startday,4,2)."-".substr($startday,6,2)); ?>"></td>
                    <td bgcolor="#d5d5d5">　～　</td>
                      <td bgcolor="#d5d5d5"><input style="width: 170px"  type="date" size="8" class="form-control" name="endday" id="endday"
                        value="<?php print(substr($endday,0,4)."-".substr($endday,4,2)."-".substr($endday,6,2)); ?>"></td>
                    <td bgcolor="#d5d5d5">　現場　
                    <!-- </td>
                    <td> -->
                      <!--<label for="oya"><input type="radio" id="oya" class="oyako" name="oyako_kbn" value="1" <?php if ($oyako_kbn=="1") { print("checked"); } ?>> 親　</label>
                      <label for="ko"><input type="radio" id="ko" class="oyako" name="oyako_kbn" value="2" <?php if ($oyako_kbn=="2") { print("checked"); } ?>> 子　</label>-->
                    </td>
                    <td bgcolor="#d5d5d5">
                        <!--<select style="width: 170px"  id="genba_id" name="genba_id[]" class="form-control" multiple size="10">-->
                            <select style="width: 170px"  id="genba_id" name="genba_id" class="form-control">
                            <option value=""></option>
                          <?php for ($i=0;$i<count($genba->oup_m_genba_id);$i++) { ?>
                        <option value="<?php print($genba->oup_m_genba_id[$i]); ?>" <?php
                        if ($genba_id===$genba->oup_m_genba_id[$i]) {
                            print("selected");
                        } ?>><?php print($genba->oup_m_genba_name[$i]); ?></option>
                        <?php } ?>
                      </select>
                    </td>
                    <td bgcolor="#d5d5d5">
                        &nbsp;&nbsp;<input type="checkbox" id="alone" class="alone" name="alone" value="1" <?php if ($alone=="1") { print("checked"); } ?>>個別
                    </td>
                    <!--<td bgcolor="#d5d5d5">
                    </td>-->

                      <td bgcolor="#d5d5d5">
                      </td>
                    <td bgcolor="#d5d5d5">
                    </td>
                    <td bgcolor="#d5d5d5">
                    </td>
                  </tr>
                  <tr>
<!--                    <td bgcolor="#d5d5d5">
                    </td>
                    <td bgcolor="#d5d5d5">
                    </td>-->
                    <td bgcolor="#d5d5d5">　勤務　</td>
                    <td>
                    <select id="kinmu" name="kinmu" class="form-control form-control-sm">
                    <option></option>
                    <?php
                    for ($i=0; $i<count($shift->oup_m_shift_no); $i++) {
                        // 現場IDから現場名を取得
                        $genba = new Genba; // Genbaクラスの初期化
                        $genba->inp_m_genba_id = $shift->oup_m_shift_genba_id[$i];
                        $genba->getGenba(); ?>
                    
                    <option
                      value="<?php print($shift->oup_m_shift_plan_kbn[$i].','.$shift->oup_m_shift_kaban_time[$i].','.$shift->oup_m_shift_joban_time[$i].','.$shift->oup_m_shift_plan_hosoku[$i].','.$genba->oup_m_genba_id[0]); ?>" <?php
                        if ($genba_id2 == $shift->oup_m_shift_genba_id[$i] && $plan_kbn === $shift->oup_m_shift_plan_kbn[$i] && $plan_kaban_time === $shift->oup_m_shift_kaban_time[$i] && $plan_joban_time === $shift->oup_m_shift_joban_time[$i] && $plan_hosoku === $shift->oup_m_shift_plan_hosoku[$i]) {
                            echo 'selected';
                        } ?>>
                      <?php
                      echo $genba->oup_m_genba_name[0] . '/' . $shift->kbn[$shift->oup_m_shift_plan_kbn[$i]] . $shift->oup_m_shift_plan_hosoku[$i] . "/" . $shift->oup_m_shift_joban_time[$i] . " ～ " . $shift->oup_m_shift_kaban_time[$i];
                      ?>
                    </option>
                    <?php
                    } ?>
                  </select>
                    </td>
                    </td>
                    <td bgcolor="#d5d5d5">　状態　</td>
                    <td bgcolor="#d5d5d5">
                      <select style="width: 100px" id="kbn" name="kbn" class="form-control">
                        <?php foreach ($jk_kbn as $kbn_1 => $kbn_2) {?>
                        <option value="<?php echo $kbn_1; ?>"
                        <?php echo $kbns == $kbn_1 ? 'selected':'' ; ?>>
                        <?php echo $kbn_2; ?>
                        </option>
                        <?php } ?>
                      </select>
                    </td>
                    <td bgcolor="#d5d5d5">　隊員　</td>
                    <td bgcolor="#d5d5d5">
                      <table>
                        <tr>
                          <td>
                            <select id="user_kana" class="form-control" name="user_kana">
                              <?php for ($i=0;$i<count($user_kana_array);$i++) { ?>
                                <option value="<?php print($user_kana_array[$i]); ?>" <?php if ($user_kana == $user_kana_array[$i]) { print("selected"); }?> ><?php print($user_kana_array[$i]); ?>
                              <?php } ?>
                            </select>
                          </td>
                          <td>
                            <select style="width: 150px" id="staff_id" name="staff_id" class="form-control">
                              <option>
                              <?php for ($i=0;$i<count($staff->oup_m_staff_id);$i++) { ?>
                                <option value="<?php print($staff->oup_m_staff_id[$i]); ?>" <?php
                                  if ($staff_id===$staff->oup_m_staff_id[$i]) {
                                    print("selected");
                                  } ?>><?php print($staff->oup_m_staff_name[$i]); ?></option>
                              <?php } ?>
                            </select>
                          </td>
                        </tr>
                      </table>
                    </td>
                    <td bgcolor="#d5d5d5" style="text-align:center;">&nbsp;チェック&#10004;</td>
                    <td bgcolor="#d5d5d5">
                        <select name="chk_search" class="form-control">
                        <option value="" <?php if ($chk_search == "") {print("selected");} ?>></option>
                        <option value="0" <?php if ($chk_search == "0") {print("selected");} ?>>未</option>
                        <option value="1" <?php if ($chk_search == "1") {print("selected");} ?>>済</option>
                        </select>
                    </td>
                    <td bgcolor="#d5d5d5">&nbsp;&nbsp;&nbsp;
                    </td>
                    <td bgcolor="#d5d5d5">
                      <button type="submit" class="btn btn-info" role="button" name="search">検索</button>
                    </td>
                    <td bgcolor="#d5d5d5">
                    　　　　　　
                    </td>
                    <td bgcolor="#d5d5d5">
                      <?php if ($staff2->oup_m_staff_auth[0]=="1") { ?>
                      <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">メニューに戻る</a>
                      <?php } else { ?>
                      <a href="../menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">メニューに戻る</a>
                      <?php } ?>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </div>
<!--
          <div class="col-12" style="width: 1200px">
            <table class="text-center" border="1">
            <tr>
              <td width="100">下番</td>
              <td width="100" bgcolor="FFDCA5">上番中</td>
              <td width="100" bgcolor="d5d5d5">未</td>
            </tr>
          </table>
        </div>
-->
      </div>

      <br />

      <!-- 一覧 -->
      <div class="row">
        <div class="col-12">
          <table class="text-nowrap" border="1" style="font-size: 10pt; width:1200px">
<?php 
            $ycnt = 0;
            $kcnt = 0;
            $dcnt = 0;
            $scnt = 0;
            $tcnt = 0;
?>
              <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { 
                        if($i == 0 ){
              ?>
            <thead>
              <tr class="text-center">
                <td width="30" rowspan="2" bgcolor="FFDCA5">詳細</td>
                <td width="30" rowspan="2" bgcolor="FFDCA5"><input type="checkbox" id="all-checked"></td>
                <td width="30" rowspan="2" bgcolor="FFDCA5">&#10004;</td>
                <td width="60" rowspan="2" bgcolor="FFDCA5">日付</td>
                <td width="40" rowspan="2" bgcolor="FFDCA5">曜<br />日</td>
                <td width="85" rowspan="2" bgcolor="FFDCA5">現場</td>
                <td width="100" rowspan="2" bgcolor="FFDCA5">氏名</td>
                <td width="60" rowspan="2" bgcolor="FFDCA5">勤務</td>
                <td width="70" colspan="1" bgcolor="FFDCA5">所定時間</td>
                <td width="70" colspan="1" bgcolor="d5d5d5">打刻</td>
                <td width="70" colspan="1" bgcolor="d5d5d5">実績</td>
                <td width="70" rowspan="2" bgcolor="FFDCA5">&nbsp;</td>
                <td width="60" rowspan="2" bgcolor="d5d5d5">勤務<br />時間</td>
                <td colspan="6" bgcolor="d5d5d5">時間外勤務</td>
                <?php if ($staff2->oup_m_staff_auth[0]!="1") { ?>
                    <td width="70" rowspan="2" bgcolor="d5d5d5">交通費</td>
                <?php } ?>
                <?php if ($staff2->oup_m_staff_auth[0]=="1") { ?>
                <td width="70" rowspan="2" bgcolor="d5d5d5">交通費</td>
                    <td colspan="6" bgcolor="d5d5d5">手当て</td>
                <?php } else { ?>
                    <td bgcolor="d5d5d5">手当て</td>
                <?php } ?>
				<td width="60" rowspan="2" bgcolor="d5d5d5">&nbsp;</td>
              </tr>
              <tr class="text-center">
                <td width="60" bgcolor="FFDCA5">上番<br>下番</td>
                <td width="60" bgcolor="d5d5d5">上番<br>下番</td>
                <td width="60" bgcolor="d5d5d5">上番<br>下番</td>
                <td width="60" bgcolor="d5d5d5">所定残</td>
                <td width="60" bgcolor="d5d5d5">早出残<br>通常残</td>
                <td width="60" bgcolor="d5d5d5">昼残</td>
                <td width="60" bgcolor="d5d5d5">休憩残</td>
                <td width="60" bgcolor="d5d5d5">深夜残</td>
                <td width="60" bgcolor="d5d5d5">連勤残</td>
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
            <?php } elseif($i%10 == 0) { ?>
             <thead>
              <tr class="text-center">
                <td width="30" bgcolor="FFDCA5">詳細</td>
                <td width="30" bgcolor="FFDCA5"></td>
                <td width="30" bgcolor="FFDCA5">&#10004;</td>
                <td width="60" bgcolor="FFDCA5">日付</td>
                <td width="40" bgcolor="FFDCA5">曜<br />日</td>
                <td width="85" bgcolor="FFDCA5">現場</td>
                <td width="100" bgcolor="FFDCA5">氏名</td>
                <td width="60" bgcolor="FFDCA5">勤務</td>
                <td width="70" colspan="1" bgcolor="FFDCA5">所定時間</td>
                <td width="70" colspan="1" bgcolor="d5d5d5">打刻</td>
                <td width="70" colspan="1" bgcolor="d5d5d5">実績</td>
                <td width="70" bgcolor="FFDCA5">&nbsp;</td>
                <td width="60" bgcolor="d5d5d5">勤務<br />時間</td>
                <td width="60" bgcolor="d5d5d5">所定残</td>
                <td width="60" bgcolor="d5d5d5">早出残<br>通常残</td>
                <td width="60" bgcolor="d5d5d5">昼残</td>
                <td width="60" bgcolor="d5d5d5">休憩残</td>
                <td width="60" bgcolor="d5d5d5">深夜残</td>
                <td width="60" bgcolor="d5d5d5">連勤残</td>
                <td width="70" bgcolor="d5d5d5">交通費</td>
                <td width="60" bgcolor="d5d5d5">ﾎﾟｽﾄ</td>
            <?php if ($staff2->oup_m_staff_auth[0]=="1") { ?>
                <td width="60" bgcolor="d5d5d5"><?php print($teate->oup_m_teate_name[0]); ?></td>
                <td width="60" bgcolor="d5d5d5"><?php print($teate->oup_m_teate_name[1]); ?></td>
                <td width="60" bgcolor="d5d5d5"><?php print($teate->oup_m_teate_name[2]); ?></td>
                <td width="60" bgcolor="d5d5d5"><?php print($teate->oup_m_teate_name[3]); ?></td>
                <td width="60" bgcolor="d5d5d5"><?php print($teate->oup_m_teate_name[4]); ?></td>
            <?php } ?>
				<td width="60" bgcolor="d5d5d5">&nbsp;</td>
              </tr>
            </thead>
              

            <tbody>
              
              <?php } ?>
              <tr class="text-center" <?php if ($i == 0 || $i%2 == 0) { print("bgcolor=#e1f6fc"); } ?>>
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
                <!-- チェック -->
                <td>
                  <?php if ($wkdetail->oup_t_wk_chk_kbn[$i] == "1") { print("済"); } else { print(""); } ?>
                </td>
                <!-- 日付 -->
                <td>
                  <?php print(substr($wkdetail->oup_t_wk_plan_date[$i], 5, 2)."/".substr($wkdetail->oup_t_wk_plan_date[$i], 8, 2)); ?>
                </td>
                <!-- 曜日 -->
                <?php 
                    $time = strtotime(date($wkdetail->oup_t_wk_plan_date[$i]));
                    $w = date("w", $time);
                ?>
                <td>
                  <?php print($week[$w]); ?>
                </td>
                <!-- 現場 -->
                <td><?php print($genbas2[$wkdetail->oup_t_wk_genba_id[$i]]); ?><?php if ($genbas2[$wkdetail->oup_t_wk_genba_id[$i]] != "") { print(' : '); } ?><?php print($genbas[$wkdetail->oup_t_wk_genba_id[$i]]); ?></td>
                <!-- 氏名 -->
                <td><?php print($staffs[$wkdetail->oup_t_wk_taiin_id[$i]]); ?></td>
                <!-- 勤務 -->
                <td><?php print(mb_substr($shift->kbn2[$wkdetail->oup_t_wk_plan_kbn[$i]],0,1)); ?><?php print($wkdetail->oup_t_wk_plan_hosoku[$i]); ?></td>
                <!-- 所定時間 -->
                <td>
                  <?php echo $wkdetail->oup_t_wk_plan_joban_time[$i] !== null ? $wkdetail->oup_t_wk_plan_joban_time[$i] : '&nbsp;'; ?>
                  <br>
                  <?php echo $wkdetail->oup_t_wk_plan_kaban_time[$i] !== null ? $wkdetail->oup_t_wk_plan_kaban_time[$i] : '&nbsp;'; ?>
                </td>
                <!-- 打刻 -->
                <td>
                  <?php echo $wkdetail->oup_t_wk_joban_dakoku_time[$i] != "00:00" ? $wkdetail->oup_t_wk_joban_dakoku_time[$i] : '&nbsp;'; ?>
                  <br>
                  <?php echo $wkdetail->oup_t_wk_kaban_dakoku_time[$i] == "00:00" || $wkdetail->oup_t_wk_kaban_dakoku_time[$i] == "" ? '&nbsp;' : $wkdetail->oup_t_wk_kaban_dakoku_time[$i] ?>
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
                  } elseif ($wkdetail->oup_t_wk_joban_kbn[$i]=="4") {
                      print("年休");
                  } elseif ($wkdetail->oup_t_wk_joban_kbn[$i]=="5") {
                      print("欠勤");
                  } elseif ($wkdetail->oup_t_wk_joban_kbn[$i]!="") {
                      print("上番中");
                  } else {
                      print("未");
                  } ?>
                </td>
                <!-- 勤務時間 -->
                <td>
                <?php 
                    $wk00 = ($shift2_rod[$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_kbn[$i]][$wkdetail->oup_t_wk_plan_joban_time[$i]][$wkdetail->oup_t_wk_plan_kaban_time[$i]])*60;
                    if ($wkdetail->oup_t_wk_joban_kbn[$i]=="4") {
                    } else if ($wkdetail->oup_t_wk_joban_kbn[$i]=="5") {
                    } else {
                    if ($wk00!=0) {
//                        print("<br />");
                        if ($wkdetail->oup_t_wk_stminus[$i]=="") {
                            print(sprintf('%02d',($wk00/60)).":".sprintf('%02d',($wk00%60)));
//                            print("&nbsp;");
                            $kj=$kj+$wk00;
                        } else {
                            print("<font color=\"red\">");
//                            print($wkdetail->oup_t_wk_stminus[$i]);
                            $wk01 = $wk00+($wkdetail->oup_t_wk_stminus[$i])*60;
                            print(sprintf('%02d',($wk01/60)).":".sprintf('%02d',($wk01%60)));
                            print("</font>");
                            $kjikyu=$kjikyu+$wk00+($wkdetail->oup_t_wk_stminus[$i]*60);
                            }
                        }
                    }
                ?>
                </td>
                <!-- 所定残 -->
                <td>
                <?php 
                    // 所定残
                    $wk00 = ($shift2_ovr[$wkdetail->oup_t_wk_genba_id[$i]][$wkdetail->oup_t_wk_plan_kbn[$i]][$wkdetail->oup_t_wk_plan_joban_time[$i]][$wkdetail->oup_t_wk_plan_kaban_time[$i]])*60;
                    if ($wk00!=0) {
                        print(sprintf('%02d',($wk00/60)).":".sprintf('%02d',($wk00%60)));
                        $syzan = $syzan + $wk00;
                    }
                ?>
                </td>
                <!-- 早出, 通常 -->
                <td>
                  <?php
                  // 差分を表示
                  if ($wkdetail->oup_t_wk_plan_joban_time[$i] !== null && $wkdetail->oup_t_wk_joban_time[$i] !== null) {
                      $plan_joban_time = new DateTime($wkdetail->oup_t_wk_plan_joban_time[$i]);
                      $joban_time = new DateTime($wkdetail->oup_t_wk_joban_time[$i]);
                      $interval = $plan_joban_time->diff($joban_time);
                      if (($interval->format('%H:%I') != "00:00") && ($wkdetail->oup_t_wk_plan_joban_time[$i]>$wkdetail->oup_t_wk_joban_time[$i])) {
                          echo $interval->format('%H:%I');
                          $szan = $szan + substr($interval->format('%H%I'),0,2)*60+substr($interval->format('%H%I'),2,2);
                      }
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
                      if (($interval->format('%H:%I') != "00:00") && ($wkdetail->oup_t_wk_plan_kaban_time[$i]<$wkdetail->oup_t_wk_kaban_time[$i])) {
                          echo $interval->format('%H:%I');
                          $tzan = $tzan + substr($interval->format('%H%I'),0,2)*60+substr($interval->format('%H%I'),2,2);
                      }
                  } else {
                      echo '&nbsp;';
                  }
                  ?>
                </td>
                <!-- 昼残残業時間 -->
                <td>
                <?php 
                    if ($wkdetail->oup_t_wk_daytime_over_time[$i]!="00:00") { 
                        print($wkdetail->oup_t_wk_daytime_over_time[$i]); 
                        $hzan = $hzan + substr($wkdetail->oup_t_wk_daytime_over_time[$i],0,2)*60+substr($wkdetail->oup_t_wk_daytime_over_time[$i],3,2);
                    }
                ?>
                </td>
                <!-- 休憩残業時間 -->
                <td>
                <?php 
                    if ($wkdetail->oup_t_wk_rest_over_time[$i]!="00:00") {
                        print($wkdetail->oup_t_wk_rest_over_time[$i]);
                        $kzan = $kzan + substr($wkdetail->oup_t_wk_rest_over_time[$i],0,2)*60+substr($wkdetail->oup_t_wk_rest_over_time[$i],3,2);
                    }
                ?>
                </td>
                <!-- 深夜残業時間 -->
                <td>
                <?php 
                    if ($wkdetail->oup_t_wk_midnight_over_time[$i]!="00:00") {
                        print($wkdetail->oup_t_wk_midnight_over_time[$i]); 
                        $sizan = $sizan + substr($wkdetail->oup_t_wk_midnight_over_time[$i],0,2)*60+substr($wkdetail->oup_t_wk_midnight_over_time[$i],3,2);
                    } 
                ?>
                </td>
                <!-- 連勤残 -->
                <td>
                <?php 
                    $wk00 = $wkdetail->oup_t_wk_renzan[$i]*60;
                    if ($wk00!=0) {
                        print(sprintf('%02d',($wk00/60)).":".sprintf('%02d',($wk00%60)));
                        $rezan = $rezan + $wk00;
                    }
                ?>
                </td>
<!--
                <td><?php print($wkdetail->oup_t_wk_zan[$i]); ?></td>
-->
                <!-- 交通費 -->
                <td>
                <?php 
                    if ($wkdetail->oup_t_wk_kotuhi[$i]!=0) { 
                        print(number_format($wkdetail->oup_t_wk_kotuhi[$i])); 
                        $kotuhi = $kotuhi + $wkdetail->oup_t_wk_kotuhi[$i];
                    } 
                ?>
                </td>
                <!-- ポスト手当て -->
                <td>
                <?php 
                    if ($wkdetail->oup_t_wk_post_teate[$i]!="0") { 
                        print(number_format($wkdetail->oup_t_wk_post_teate[$i])); 
                        $post = $post + $wkdetail->oup_t_wk_post_teate[$i];
                    } 
                ?>
                </td>
                <?php if ($staff2->oup_m_staff_auth[0]=="1") { ?>
                    <!-- 正月手当て -->
                    <td>
                    <?php 
                        if ($wkdetail->oup_t_wk_shogatu_teate[$i]!="0") { 
                            print($wkdetail->oup_t_wk_shogatu_teate[$i]); 
                            $teate1 = $teate1 + $wkdetail->oup_t_wk_shogatu_teate[$i];
                        } 
                        ?>
                    </td>
                    <!-- 夏季手当て -->
                    <td>
                    <?php 
                        if ($wkdetail->oup_t_wk_kaki_teate[$i]!="0") { 
                            print($wkdetail->oup_t_wk_kaki_teate[$i]); 
                            $teate2 = $teate2 + $wkdetail->oup_t_wk_kaki_teate[$i];
                        } ?></td>
                    <!-- 手当て1 -->
                    <td>
                    <?php 
                        if ($wkdetail->oup_t_wk_etc_teate1[$i]!="0") { 
                            print($wkdetail->oup_t_wk_etc_teate1[$i]); 
                            $teate3 = $teate3 + $wkdetail->oup_t_wk_etc_teate1[$i];
                        } 
                    ?>
                    </td>
                    <!-- 手当て2 -->
                    <td>
                    <?php 
                        if ($wkdetail->oup_t_wk_etc_teate2[$i]!="0") { 
                            print($wkdetail->oup_t_wk_etc_teate2[$i]); 
                            $teate4 = $teate4 + $wkdetail->oup_t_wk_etc_teate2[$i];
                        } 
                    ?>
                    </td>
                    <!-- 手当て3 -->
                    <td>
                    <?php 
                        if ($wkdetail->oup_t_wk_etc_teate3[$i]!="0") { 
                            print($wkdetail->oup_t_wk_etc_teate3[$i]); 
                            $teate5 = $teate5 + $wkdetail->oup_t_wk_etc_teate3[$i];
                        } 
                    ?>
                    </td>
                <?php } ?>
                <td><a href="#" onClick="confirm1(<?php print($wkdetail->oup_t_wk_detail_no[$i]); ?>);">
                    削</a></td>
              </tr>

<?php 
                if ($wkdetail->oup_t_wk_joban_kbn[$i]=="4") {
                    $ycnt = $ycnt+1;
                } else if ($wkdetail->oup_t_wk_joban_kbn[$i]=="5") {
                    $kcnt = $kcnt+1;
                } else {
                    if ($wkdetail->oup_t_wk_plan_kbn[$i]=="1") {
                        $dcnt = $dcnt+1;
                    } else if ($wkdetail->oup_t_wk_plan_kbn[$i]=="2") {
                        $scnt = $scnt+1;
                    } else if ($wkdetail->oup_t_wk_plan_kbn[$i]=="3") {
                        $tcnt = $tcnt+1;
                    }
                }
?>
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
              <td valign="top">

                <table style="border-collapse:collapse; font-size: 10pt;" cellpadding="4">
                  <tr>
                    <td style="border:1px; border-style: solid solid none solid;" colspan="2" width="100" bgcolor="FFDCA5">合計<?php if ($staff_id!="") { print("回数"); } else { print("人数"); } ?></td>  <?php /* 上:、右:、下:、左: */ ?>
                    <td style="border:1px solid black" align="right" width="80" colspan="3"><?php print(count($wkdetail->oup_t_wk_detail_no)); ?> <?php if ($staff_id!="") { print("回"); } else { print("人"); } ?></td>
                  </tr>
                  <tr>
                    <td style="border:1px; border-style: none solid none solid;" bgcolor="FFDCA5">&nbsp;</td>
                    <td style="border:1px solid black" bgcolor="FFDCA5" width="80">泊</td>
                    <td style="border:1px solid black" align="right" width="80"><?php print($dcnt); ?> <?php if ($staff_id!="") { print("回"); } else { print("人"); } ?></td>
                    <td style="border:1px solid black" bgcolor="FFDCA5" width="80">年休</td>
                    <td style="border:1px solid black" align="right" width="80"><?php print($ycnt); ?> <?php if ($staff_id!="") { print("回"); } else { print("人"); } ?></td>
                  </tr>
                  <tr>
                    <td style="border:1px; border-style: none solid none solid;" bgcolor="FFDCA5">&nbsp;</td>
                    <td style="border:1px solid black" bgcolor="FFDCA5">日勤</td>
                    <td style="border:1px solid black" align="right"><?php print($scnt); ?> <?php if ($staff_id!="") { print("回"); } else { print("人"); } ?></td>
                    <td style="border:1px solid black" bgcolor="FFDCA5">欠勤</td>
                    <td style="border:1px solid black" align="right"><?php print($kcnt); ?> <?php if ($staff_id!="") { print("回"); } else { print("人"); } ?></td>
                    </tr>
                  <tr>
                    <td style="border:1px; border-style: none solid solid solid;" bgcolor="FFDCA5">&nbsp;</td>
                    <td style="border:1px solid black" bgcolor="FFDCA5">夜勤</td>
                    <td style="border:1px solid black" align="right"><?php print($tcnt); ?> <?php if ($staff_id!="") { print("回"); } else { print("人"); } ?></td>
                    <td style="border:1px solid black" bgcolor="d5d5d5" colspan="2" ></td>
                  </tr>
                </table>

              </td>
              <td width="20">　
              </td>

              <td valign="top">
              <table class="text-nowrap" border="1" style="font-size: 10pt;" cellpadding="4">
                <tr>
                  <td bgcolor="FFDCA5" colspan="9" align="center">合計</td>
                </tr>
                <tr>
                  <td width="60" align="center" bgcolor="FFDCA5">勤務時間</td>
                  <td width="60" align="center" bgcolor="FFDCA5">時給時間</td>
                  <td width="60" align="center" bgcolor="FFDCA5">所定残</td>
                  <td width="60" align="center" bgcolor="FFDCA5">早出残</td>
                  <td width="60" align="center" bgcolor="FFDCA5">通常残</td>
                  <td width="60" align="center" bgcolor="FFDCA5">昼残</td>
                  <td width="60" align="center" bgcolor="FFDCA5">休憩残</td>
                  <td width="60" align="center" bgcolor="FFDCA5">深夜残</td>
                  <td width="60" align="center" bgcolor="FFDCA5">連勤残</td>
                </tr>
                <tr>
                  <td align="center">
                  <?php
                    if ($kj!=0) {
                        print(sprintf('%02d',($kj/60)).":".sprintf('%02d',($kj%60)));
                    }
                  ?>
                  </td>
                  <td align="center">
                  <?php
                    if ($kjikyu!=0) {
                        print(sprintf('%02d',($kjikyu/60)).":".sprintf('%02d',($kjikyu%60)));
                    }
                  ?>
                  </td>
                  <td align="center">
                  <?php
                    if ($syzan!=0) {
                        print(sprintf('%02d',($syzan/60)).":".sprintf('%02d',($syzan%60)));
                    }
                  ?>
                  </td>
                  <td align="center">
                  <?php
                    if ($szan!=0) {
                        print(sprintf('%02d',($szan/60)).":".sprintf('%02d',($szan%60)));
                    }
                  ?>
                  </td>
                  <td align="center">
                  <?php
                    if ($tzan!=0) {
                        print(sprintf('%02d',($tzan/60)).":".sprintf('%02d',($tzan%60)));
                    }
                  ?>
                  </td>
                  <td align="center">
                  <?php
                    if ($hzan!=0) {
                        print(sprintf('%02d',($hzan/60)).":".sprintf('%02d',($hzan%60)));
                    }
                  ?>
                  </td>
                  <td align="center">
                  <?php
                    if ($kzan!=0) {
                        print(sprintf('%02d',($kzan/60)).":".sprintf('%02d',($kzan%60)));
                    }
                  ?>
                  </td>
                  <td align="center">
                  <?php
                    if ($sizan!=0) {
                        print(sprintf('%02d',($sizan/60)).":".sprintf('%02d',($sizan%60)));
                    }
                  ?>
                  </td>
                  <td align="center">
                  <?php
                    if ($rezan!=0) {
                        print(sprintf('%02d',($rezan/60)).":".sprintf('%02d',($rezan%60)));
                    }
                  ?>
                  </td>
                </tr>
              </table>
              </td>
              <td width="20">　
              </td>

              <td valign="top">
              <table class="text-nowrap" border="1" style="font-size: 10pt;" cellpadding="4">
                <tr>
                  <td bgcolor="FFDCA5" colspan="7" align="center">合計</td>
                </tr>
                <tr>
                  <td width="60" align="center" bgcolor="FFDCA5">交通費</td>
                  <td width="60" align="center" bgcolor="FFDCA5">ﾎﾟｽﾄ</td>
                  <td width="60" align="center" bgcolor="FFDCA5"><?php print($teate->oup_m_teate_name[0]); ?></td>
                  <td width="60" align="center" bgcolor="FFDCA5"><?php print($teate->oup_m_teate_name[1]); ?></td>
                  <td width="60" align="center" bgcolor="FFDCA5"><?php print($teate->oup_m_teate_name[2]); ?></td>
                  <td width="60" align="center" bgcolor="FFDCA5"><?php print($teate->oup_m_teate_name[3]); ?></td>
                  <td width="60" align="center" bgcolor="FFDCA5"><?php print($teate->oup_m_teate_name[4]); ?></td>
                </tr>
                <tr>
                  <td align="right">
                  <?php 
                    if ($kotuhi!="") {
                        print(number_format($kotuhi));
                    }
                  ?>
                  </td>
                  <td align="right">
                  <?php 
                    if ($post!="") {
                        print(number_format($post));
                    }
                  ?>
                  </td>
                  <td align="right">
                  <?php 
                    if ($teate1!="") {
                        print(number_format($teate1));
                    }
                  ?>
                  </td>
                  <td align="right">
                  <?php 
                    if ($teate2!="") {
                        print(number_format($teate2));
                    }
                  ?>
                  </td>
                  <td align="right">
                  <?php 
                    if ($teate3!="") {
                        print(number_format($teate3));
                    }
                  ?>
                  </td>
                  <td align="right">
                  <?php 
                    if ($teate4!="") {
                        print(number_format($teate4));
                    }
                  ?>
                  </td>
                  <td align="right">
                  <?php 
                    if ($teate5!="") {
                        print(number_format($teate5));
                    }
                  ?>
                  </td>
                </tr>
              </table>
              </td>

            </tr>
          </table>
        </div>
      </div>
      <br />

    <?php if ($staff2->oup_m_staff_auth[0]=="1") { $col1 = 4; $col2 = 5; } else { $col1 = 6; $col2 = 6; } ?>
      <div class="row">
        <div class="col-<?php print($col1); ?>">
          <table>
            <tr>
              <td>時間外一括登録　</td>
              <td>
                <select name="over_time" class="form-control">
                  <option value="">
                  <option value="daytime">昼残
                  <option value="rest">休憩残
                  <option value="midnight">深夜残
                </select>
              </td>
              <td>
                <select class="form-control form-control" name="input_over">
                  <option value="">
                    <?php foreach ($select_daytime as $time => $minute) {?>
                    <option value="<?php echo $time; ?>"
                      <?php echo $wkdetail->oup_t_wk_daytime_over_time[0] == $time ? 'selected':'' ; ?>>
                      <?php echo $minute; ?>
                    </option>
                    <?php } ?>
                </select>
              </td>
              <td>
                <button type="submit" class="btn btn-success btn-block">登録</button>
              </td>
            </tr>
          </table>
        </div>
        <div class="col-<?php print($col2); ?>">
          <table>
            <tr>
              <td>手当て一括登録　</td>
              <td>
                <select name="select_teate" class="form-control">
                  <option value="">
                  <option value="post_teate">ﾎﾟｽﾄ手当
                  <option value="kotu_teate">交通費
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
        <?php if ($staff2->oup_m_staff_auth[0]=="1") { ?>
        <div class="col-3">
          <table>
            <tr>
              <td>チェック&nbsp;&#10004;&nbsp;</td>
              <td>
                <select name="chk" class="form-control">
                  <option value="">
                  <option value="1">済
                </select>
              </td>
              <td>
                <button type="submit" class="btn btn-success btn-block">登録</button>
              </td>
            </tr>
          </table>
        </div>
        <?php } ?>
      </div>
      <br />
      <div class="row">
        <div class="col-6">
          <table>
            <tr>
              <td>上下番一括登録　</td>
              <td>
                <select name="select_kbn" class="form-control">
                  <option value="">
                  <option value="joban">上番
                  <option value="kaban">下番
                </select>
              </td>
              <td>
                <select name="time1" class="form-control">
                  <option value="">
<?php for ($i=0;$i<24;$i++) { ?>
                  <option value="<?php print(sprintf('%02d', $i)); ?>"><?php print(sprintf('%02d', $i)); ?>
<?php } ?>
                </select>
              </td>
              <td>
                :
              </td>
              <td>
                <select name="time2" class="form-control">
                  <option value="">
<?php for ($i=0;$i<60;$i++) { ?>
                  <option value="<?php print(sprintf('%02d', $i)); ?>"><?php print(sprintf('%02d', $i)); ?>
<?php } ?>
                </select>
              </td>
              <td>
                <button type="submit" class="btn btn-success btn-block">登録</button>
              </td>
            </tr>
          </table>
        </div>
        <div class="col-6">
          <table>
            <tr>
              <td>年休・欠勤一括登録　</td>
              <td>
                <select name="select_nk" class="form-control">
                  <option value="">
                  <option value="4">年休
                  <option value="5">欠勤
                </select>
              </td>
              <td>
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