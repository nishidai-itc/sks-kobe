<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">
  <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" media="screen, projection" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <?php /*    <script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script> */ ?>
  <script type="text/javascript" src="../bootstrap/js/jquery.balloon.js"></script>
  <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
  <title>勤怠管理システム</title>
</head>

<script type="text/javascript">
function confirm1(no,taiin_id) {
  var genba_id = $('#genba_id').val();
  var nengetu = $('#nengetu').val();
  var shift_no = $('#shift_no').val();
  
  if (!confirm('この項目を削除してもよろしいですか?')) return false;
  location.href = "kinmuyotei.php?search=&delete1=&wk_no=" + no + "&taiin_id=" + taiin_id + "&genba_id=" + genba_id + "&nengetu=" + nengetu +
    "&shift_no=" + shift_no;
}

function regist(wk_no, id) {
  var token = $('#token').val();
  var genba_id = $('#genba_id').val();
  var nengetu = $('#nengetu').val();
  var shift_no = $('#shift_no').val();
  var kensyu = $('#kensyu:checked').val();
  var pos = $(window).scrollTop();
  if (shift_no == "") {
    alert('登録するシフトを選択してください');
  } else {
    location.href = "kinmuyotei.php?search=&regist=&genba_id=" + genba_id + "&nengetu=" + nengetu + "&shift_no=" +
      shift_no + "&wk_no=" + wk_no + "&id=" + id + "&kensyu=" + kensyu + "&pos=" + pos + "&token=" + token;
  }
}

function ins() {
  var genba_id = $('#genba_id').val();
  var nengetu = $('#nengetu').val();
  var shift_no = $('#shift_no').val();
  var kensyu = $('#kensyu:checked').val();
  var staff_id = $('#staff_id').val();
  if (staff_id == "") {
    alert('登録する隊員を選択してください');
  } else {
    location.href = "kinmuyotei.php?search=&ins=&genba_id=" + genba_id + "&nengetu=" + nengetu + "&shift_no=" +
      shift_no + "&staff_id=" + staff_id + "&kensyu=" + kensyu;
  }
}

function del(wk_no) {
  var genba_id = $('#genba_id').val();
  var nengetu = $('#nengetu').val();
  var shift_no = $('#shift_no').val();
  var pos = $(window).scrollTop();
  location.href = "kinmuyotei.php?search=&delete2=&genba_id=" + genba_id + "&nengetu=" + nengetu + "&shift_no=" +
    shift_no + "&wk_no=" + wk_no + "&pos=" + pos;
}
</script>

<script>
jQuery(function($) {
  var tableSheet = $('table.sheet');
  var offset = tableSheet.offset();
  $('.fixheader').width(tableSheet.width());

  $(window).scroll(function() {
    if ($(window).scrollTop() > tableSheet.offset().top &&
      $(window).scrollTop() < (tableSheet.offset().top + tableSheet.height())) {
      var fixheaderTop = $(window).scrollTop();
      $('.fixheader').show();
    } else {
      $('.fixheader').hide();
    }
  });

  $(window).resize(function() {
    $('.fixheader').width(tableSheet.width());
  });

});
</script>

<body onload="start()">
  <div class="container">
    <div class="page-header">
      <h4>勤務予定表</h4>
    </div>

    <form name="frm" id="frm" method="POST" action="kinmuyotei.php">
      <input type="hidden" name="scroll_top" value="" class="st">
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <table border="1">
            <tr>
              <td>
                <table>
                  <tr>
                    <td bgcolor="#d5d5d5">現場名</td>
                    <td bgcolor="#d5d5d5">
                      <select id="genba_id" name="genba_id" class="form-control">
                        <option value=""></option>
                        <?php for ($i=0;$i<count($genba->oup_m_genba_id);$i++) { ?>
                        <option value="<?php print($genba->oup_m_genba_id[$i]); ?>" <?php
                        if ($genba_id===$genba->oup_m_genba_id[$i]) {
                            print("selected");
                        } ?>><?php print($genba->oup_m_genba_name[$i]); ?></option>
                        <?php } ?>
                      </select>
                    </td>
                    <td bgcolor="#d5d5d5">年月　</td>
                    <td bgcolor="#d5d5d5">
                      <select id="nengetu" class="form-control" name="nengetu">
                        <?php for($i=$start;$i<=$end;$i=date('Ym01', strtotime($i.'+1 month'))) { ?>
                        <option value="<?php echo substr($i,0,6) ?>" <?php echo substr($i,0,6) == $nengetu ? 'selected':"" ?>><?php echo substr($i,0,6) ?></option>
                        <?php } ?>
                      </select>
                    <!-- <input type="tel" size="6" id="nengetu" name="nengetu" class="form-control"
                    value="<?php print($nengetu); ?>"> -->
                    </td>
                    <td>
                      <label>
                        <input type="checkbox" id="jikan" name="jikan" value="1"> 時間表示　
                      </label>
                    </td>
                    <td bgcolor="#d5d5d5">
                      <button type="submit" class="btn btn-info btn-block" role="button" name="search">検索</button>
                    </td>
                  </tr>
                </table>
              </td>
              <td>
                <table>
                  <tr>
                    <td>
                      <!-- シフト -->
                      <select id="shift_no" name="shift_no" class="form-control">
                        <option></option>
                        <?php for ($i=0;$i<count($shift->oup_m_shift_no);$i++) { ?>
                        <option value="<?php print($shift->oup_m_shift_no[$i]); ?>" <?php if ($shift_no===$shift->oup_m_shift_no[$i]) {
                            print("selected");
                        } ?>>
                          <?php print($shift->kbn[$shift->oup_m_shift_plan_kbn[$i]].$shift->oup_m_shift_plan_hosoku[$i]."　".$shift->oup_m_shift_joban_time[$i]." ～ ".$shift->oup_m_shift_kaban_time[$i]); ?>
                        </option>
                        <?php } ?>
                      </select>
                    </td>
                    <td>
                      <label>
                        <input type="checkbox" id="kensyu" name="kensyu" value="1"> 研　
                      </label>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <br />

      <?php
      // 総合計
      $total_dayk1cnt = 0;
      $total_dayk2cnt = 0;
      $total_dayk3cnt = 0;
      $total_result_rodo_time = 0;
      $total_result_over_time = 0;
      ?>
      <?php if (isset($_REQUEST['search'])) { ?>
      <div class="row">
        <div class="col-xs-12 col-md-12">
<?php /* ?>
          <table border="1" class="fixheader"
            style="display: none; position: fixed; top: 0; border-collapse: collapse; table-layout: fixed;">
            <thead>
              <tr class="text-center" bgcolor="FFDCA5">
                <th width="43">&nbsp;</th>
                <th width="43">&nbsp;</th>
                <th width="75"></th>
                <th colspan="31"><?php print($nengetu); ?></th>
                <th colspan="5" rowspan="2">集計</th>
                <th width="24" rowspan="3">&nbsp;</th>
              </tr>
              <tr class="text-center" bgcolor="FFDCA5">
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>勤務者</th>
                <?php for ($i=1;$i<=31;$i++) { ?>
                <?php if ($i <= intval($lastday)) { ?>
                <th width="28"><?php print($i); ?></th>
                <?php } else { ?>
                <th width="28">
                  <FONT COLOR="FFDCA5"><?php print($i); ?></FONT>
                </th>
                <?php } ?>
                <?php } ?>
              </tr>
              <tr class="text-center" bgcolor="FFDCA5">
                <th>&nbsp;</th>
                <th>&nbsp;</th>
                <th>
                  <!-- <a href="kinmutuika.php?genba_id=<?php print($genba_id); ?>&nengetu=<?php print($nengetu); ?>" class="btn btn-success btn-block" role="button" aria-pressed="true">追加</a> -->
                </th>
                <?php for ($i=1;$i<=31;$i++) { ?>
                <?php if ($i <= intval($lastday)) { ?>
                <?php $time = strtotime(substr($nengetu, 0, 4) . "-" . substr($nengetu, 4, 2) . "-" . $i); ?>
                <?php $w = date("w", $time); ?>
                <th><?php
                if (($week[$w]=="土") || ($week[$w]=="日")) {
                    print("<font color=\"red\">");
                } ?><?php print($week[$w]); ?><?php if (($week[$w]=="土") || ($week[$w]=="日")) {
                    print("</font>");
                } ?></th>
                <?php } else { ?>
                <th>&nbsp;</th>
                <?php } ?>
                <?php } ?>
                <th width="28">日</th>
                <th width="28">夜</th>
                <th width="28">泊</th>
                <th width="28">実働</th>
                <th width="28">残業</th>
              </tr>
            </thead>
          </table>
<?php */ ?>

          <table border="1" class="sheet" style="border-collapse: collapse; table-layout: fixed;">
            <thead>
              <tr class="text-center" bgcolor="FFDCA5">
                <th width="161" colspan="4"></th>
                <th colspan="31"><?php print(substr($nengetu,0,4)."年".substr($nengetu,4,2)."月"); ?></th>
                <th colspan="6" rowspan="2">集計</th>
                <th width="24" rowspan="3">&nbsp;</th>
              </tr>
              <tr class="text-center" bgcolor="FFDCA5">
                <th colspan="4">勤務者</th>
                <?php for ($i=1;$i<=31;$i++) { ?>
                <?php if ($i <= intval($lastday)) { ?>
                <th width="28"><?php print($i); ?></th>
                <?php } else { ?>
                <th width="28">
                  <FONT COLOR="FFDCA5"><?php print($i); ?></FONT>
                </th>
                <?php } ?>
                <?php } ?>
              </tr>
              <tr class="text-center" bgcolor="FFDCA5">
                <th colspan="4">
                  <select class="form-control" id="staff_id" name="staff_id">
                    <option></option>
                    <?php
                    for ($i=0;$i<count($staff->oup_m_staff_id);$i++) {
                        if (!in_array($staff->oup_m_staff_id[$i], $wk->oup_t_wk_taiin_id)) { ?>
                    <option value="<?php print($staff->oup_m_staff_id[$i]); ?>">
                      <?php print($staff->oup_m_staff_name[$i]); ?></option>
                    <?php }
                    } ?>
                  </select>

                  <!--
                  <a href="kinmutuika.php?genba_id=<?php print($genba_id); ?>&nengetu=<?php print($nengetu); ?>" class="btn btn-success btn-block" role="button" aria-pressed="true">追加</a>
                  -->
                  <button type="button" class="btn btn-success btn-block" role="button" name="add"
                    onClick="ins()">追加</button>
                </th>
                <?php for ($i=1;$i<=31;$i++) { ?>
                <?php $time = strtotime(substr($nengetu, 0, 4) . "-" . substr($nengetu, 4, 2) . "-" . $i); ?>
                <?php $w = date("w", $time); ?>
                <?php if ($i <= intval($lastday)) { ?>
                <th><?php
                if (($week[$w]=="土") || ($week[$w]=="日")) {
                    print("<font color=\"red\">");
                } ?><?php print($week[$w]); ?><?php if (($week[$w]=="土") || ($week[$w]=="日")) {
                    print("</font>");
                } ?></th>
                <?php } else { ?>
                <th>&nbsp;</th>
                <?php } ?>
                <?php } ?>
                <th width="28">日</th>
                <th width="28">夜</th>
                <th width="28">泊</th>
                <th width="28">年休</th>
                <th width="28">実働</th>
                <th width="28">残業</th>
              </tr>
            </thead>
            <tbody>
              <?php $wk_taiin_id = "" ?>
              <?php for ($i=0;$i<count($wk->oup_t_wk_no);$i++) { ?>


                <?php if (($i!=0) && ($i%10==0)) { ?>
                      <tr class="text-center" bgcolor="FFDCA5">
                        <th colspan="4" rowspan="2"><?php print(substr($nengetu,0,4)."年".substr($nengetu,4,2)."月"); ?></th>
                        <?php for ($j=1;$j<=31;$j++) { ?>
                        <?php if ($j <= intval($lastday)) { ?>
                        <th width="28"><?php print($j); ?></th>
                        <?php } else { ?>
                        <th width="28">
                          <FONT COLOR="FFDCA5"><?php print($j); ?></FONT>
                        </th>
                        <?php } ?>
                        <?php } ?>
                        <th colspan="6">集計</th>
                        <th rowspan="2">&nbsp;</th>
                      </tr>
                      <tr class="text-center" bgcolor="FFDCA5">
                        <?php for ($j=1;$j<=31;$j++) { ?>
                        <?php $time = strtotime(substr($nengetu, 0, 4) . "-" . substr($nengetu, 4, 2) . "-" . $j); ?>
                        <?php $w = date("w", $time); ?>
                        <?php if ($j <= intval($lastday)) { ?>
                        <th><?php
                        if (($week[$w]=="土") || ($week[$w]=="日")) {
                            print("<font color=\"red\">");
                        } ?><?php print($week[$w]); ?><?php if (($week[$w]=="土") || ($week[$w]=="日")) {
                            print("</font>");
                        } ?></th>
                        <?php } else { ?>
                        <th>&nbsp;</th>
                        <?php } ?>
                        <?php } ?>
                        <th width="28">日</th>
                        <th width="28">夜</th>
                        <th width="28">泊</th>
                        <th width="28">年休</th>
                        <th width="28">実</th>
                        <th width="28">残</th>
                      </tr>
                <?php } ?>

              <tr class="text-center">
                
                <?php if ($i===0) { ?>
                <td><a name="#<?php print($wk->oup_t_wk_no[$i]); ?>">&nbsp;</td>
                <?php } else { ?>
                <td><a name="#<?php print($wk->oup_t_wk_no[$i]); ?>"><a
                    href="kinmuyotei.php?search=&up=&wk_no=<?php print($wk->oup_t_wk_no[$i]); ?>&genba_id=<?php print($genba_id); ?>&nengetu=<?php print($nengetu); ?>"
                    class="btn btn-success btn-block" role="button" aria-pressed="true">↑</a></td>
                <?php } ?>
                <?php if ($i===count($wk->oup_t_wk_no)-1) { ?>
                <td>&nbsp;</td>
                <?php } else { ?>
                <td><a
                    href="kinmuyotei.php?search=&down=&wk_no=<?php print($wk->oup_t_wk_no[$i]); ?>&genba_id=<?php print($genba_id); ?>&nengetu=<?php print($nengetu); ?>"
                    class="btn btn-success btn-block" role="button" aria-pressed="true">↓</a></td>
                <?php } ?>
                <td colspan="2">
                  <font size="-1"><a href="kinmunaiyo.html"><?php print($staffs[$wk->oup_t_wk_taiin_id[$i]]); ?></a>
                  </font>
                </td>

                <?php
                $dayk1cnt = 0;
                $dayk2cnt = 0;
                $dayk3cnt = 0;
                $dayk4cnt = 0;
                $result_rodo_time = 0;
                $result_over_time = 0;
                ?>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <?php $day = sprintf('%02d', $j); ?>
                <?php if ($ken[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]=="1") { ?>
                <td bgcolor="#CCFF99">

                  <?php } else { ?>
                <td
                  style="background-color:<?php echo $color[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]; ?>">
                  <?php } ?>
                  <?php if ($kbn[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day] == "") { ?>
                  <a href="#<?php print($wk->oup_t_wk_no[$i]); ?>" onclick="regist(<?php print($wk->oup_t_wk_no[$i]); ?>,<?php print($j); ?>);">－</a>
                  <?php } else { ?>
                  <a name="del" href="#<?php print($wk->oup_t_wk_no[$i]); ?>"
                    onclick="del(<?php print($wk_detail_no[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]); ?>);">
                    <font size="-1">
                      <?php print($shift->kbn[$kbn[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]]); ?>
                      <?php print($hosoku[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]); ?>
                    </font>
                  </a>
                  <!-- 上番時間 -->
                  <?php if ($jikan=="1") { ?>
                  <br />
                  <font size="-2">
                    <?php print($jtime[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]); ?>
                    <!-- 下番時間 -->
                    <br /><?php print($ktime[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]); ?>
                  </font>
                  <?php } ?>
                  <?php
                    if ($kbn[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]==1) {
                        $dayk1cnt = $dayk1cnt+1;
                        if ($ken[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]=="1") {
                            $kcnt1[$j] = $kcnt1[$j]+1;
                        } else {
                            $tcnt1[$j] = $tcnt1[$j]+1;
                        }
                    }
                    if ($kbn[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]==2) {
                        $dayk2cnt = $dayk2cnt+1;
                        if ($ken[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]=="1") {
                            $kcnt2[$j] = $kcnt2[$j]+1;
                        } else {
                            $tcnt2[$j] = $tcnt2[$j]+1;
                        }
                    }
                    if ($kbn[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]==3) {
                        $dayk3cnt = $dayk3cnt+1;
                        if ($ken[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]=="1") {
                            $kcnt3[$j] = $kcnt3[$j]+1;
                        } else {
                            $tcnt3[$j] = $tcnt3[$j]+1;
                        }
                    }
                    if ($kbn[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]==4) {
                      $dayk4cnt = $dayk4cnt+1;
                      if ($ken[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day]=="1") {
                          $kcnt4[$j] = $kcnt4[$j]+1;
                      } else {
                          $tcnt4[$j] = $tcnt4[$j]+1;
                      }
                  }

                    $result_rodo_time += $rodo_time[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day];
                    $result_over_time += $over_time[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day];
                  ?>
                  <?php } ?>
                </td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>

                <td><?php print($dayk2cnt); ?></td>
                <td><?php print($dayk3cnt); ?></td>
                <td><?php print($dayk1cnt); ?></td>
                <td><?php print($dayk4cnt); ?></td>
                <td><?php print($result_rodo_time + $result_over_time); ?></td>
                <td><?php print($result_over_time); ?></td>
                <td>
                  <a href="#rc<?php print($i); ?>" onClick="confirm1(<?php print($wk->oup_t_wk_no[$i]); ?>,'<?php print($wk->oup_t_wk_taiin_id[$i]); ?>' );">削</a>
                </td>
              </tr>
              <?php
              // 総合計の集計用
              $total_dayk1cnt += $dayk1cnt;
              $total_dayk2cnt += $dayk2cnt;
              $total_dayk3cnt += $dayk3cnt;
              $total_dayk4cnt += $dayk4cnt;
              $total_result_rodo_time += $result_rodo_time;
              $total_result_over_time += $result_over_time;
              ?>
              <?php } ?>
              <tr>
                <td></td>
                <td></td>
                <td colspan="2">&nbsp;</td>
                <td></td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <td></td>
                <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td rowspan="4" width="60">通常計</td>
                <td><?php print($shift->kbn[2]); ?></td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <td align="right"><?php print($tcnt2[$j]); ?></td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td><?php print($shift->kbn[3]); ?></td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <td align="right"><?php print($tcnt3[$j]); ?></td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td><?php print($shift->kbn[1]); ?></td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <td align="right"><?php print($tcnt1[$j]); ?></td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td><?php print($shift->kbn[4]); ?></td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <td align="right"><?php print($tcnt4[$j]); ?></td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td rowspan="4" width="60">研修計</td>
                <td>日</td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <td align="right"><?php print($kcnt2[$j]); ?></td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td>夜</td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <td align="right"><?php print($kcnt3[$j]); ?></td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td>泊</td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <td align="right"><?php print($kcnt1[$j]); ?></td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td>年</td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <td align="right"><?php print($kcnt4[$j]); ?></td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td rowspan="4" width="60">総合計</td>
                <td>日</td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <td align="right"><?php print($tcnt2[$j]+$kcnt2[$j]); ?></td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>
                <td><?php echo number_format($total_dayk2cnt); ?></td>
                <td><?php echo number_format($total_dayk3cnt); ?></td>
                <td><?php echo number_format($total_dayk1cnt); ?></td>
                <td><?php echo number_format($total_dayk4cnt); ?></td>
                <td><?php echo number_format($total_result_rodo_time + $total_result_over_time); ?></td>
                <td><?php echo number_format($total_result_over_time); ?></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td>夜</td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <td align="right"><?php print($tcnt3[$j]+$kcnt3[$j]); ?></td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td>泊</td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <td align="right"><?php print($tcnt1[$j]+$kcnt1[$j]); ?></td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td>年</td>
                <?php for ($j=1;$j<=31;$j++) { ?>
                <?php if ($j <= intval($lastday)) { ?>
                <td align="right"><?php print($tcnt4[$j]+$kcnt4[$j]); ?></td>
                <?php } else { ?>
                <td>&nbsp;</td>
                <?php } ?>
                <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <br />
      <?php } ?>

      <div class="row">
        <div class="col-6">
          <a href="kinmuyotei.php?search=&conf=&genba_id=<?php print($genba_id); ?>&nengetu=<?php print($nengetu); ?>" class="btn btn-success btn-block" role="button" aria-pressed="true">予定の確定</a>
        </div>
        <div class="col-6">
          <?php if ($staff2->oup_m_staff_auth[0]=="1") { ?>
          <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">メニューに戻る</a>
          <?php } else { ?>
          <a href="../menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">メニューに戻る</a>
          <?php } ?>
        </div>
      </div>
      <br />
      <input type="hidden" name="token" id="token" value="<?php print($token); ?>">

    </form>

  </div>

  <div class="modal-footer">
    <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
  </div><!-- /footer -->

  <script>
    function start() {
      var pos = <?php echo($_REQUEST['pos']); ?>;
      if(pos > 0) {
        window.scrollTo(0, pos);
      }
    }
  </script>

</body>

</html>