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

<script>
function func(act) {
    document.frm.act.value=act;
    document.frm.submit();
}
</script>


  <body>
    <div class="container">
      <div class="page-header">
      <?php if ($flg == 3) { ?>
        <h4>勤務実績表</h4>
      <?php } else { ?>
        <h4>給与連携処理（総務）</h4>
      <?php } ?>
      </div>

      <form name="frm" method="POST" action="kinmusyukei.php">

        <?php if ($genba2->errmsg != "") { ?>
            <div class="row">
              <div class="col-xs-12 col-md-12"><pre><p class="text-danger"><?php print($genba2->errmsg); ?></p></pre></div>
            </div>
        <?php } ?>

        <div class="row">
          <div class="col-xs-12 col-md-12">
            <table border="1">
              <tr align="center">
                    <td bgcolor="#d5d5d5">現場名</td>
                    <td bgcolor="#d5d5d5">
                      <select id="genba_id" name="genba_id" class="form-control">
                        <option value=""></option>
                        <?php for ($i=0;$i<count($genba2->oup_m_genba_id);$i++) { ?>
                        <option value="<?php print($genba2->oup_m_genba_id[$i]); ?>" <?php
                        if ($genba_id===$genba2->oup_m_genba_id[$i]) {
                            print("selected");
                        } ?>><?php print($genba2->oup_m_genba_name[$i]); ?></option>
                        <?php } ?>
                      </select>
                    </td>
                    <td bgcolor="#d5d5d5">　隊員　</td>
                        <td>
                          <select id="user_kana" class="form-control" name="user_kana"  onChange="func(0);">
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
                    <td bgcolor="#d5d5d5">　協力会社　</td>
                    <td>
                      <select style="width: 150px" id="company_id" name="company_id" class="form-control">
                        <option>
                        <?php for ($i=0;$i<count($company->oup_m_company_id);$i++) { ?>
                          <option value="<?php print($company->oup_m_company_id[$i]); ?>" <?php
                            if ($company_id===$company->oup_m_company_id[$i]) {
                              print("selected");
                            } ?>><?php print($company->oup_m_company_name[$i]); ?></option>
                        <?php } ?>
                      </select>
                    </td>
                <td width="85" bgcolor="d5d5d5">年月</td>
                <td width="150" bgcolor="d5d5d5">
                    <select id="nengetu" class="form-control" name="nengetu">
                      <?php for($i=$start;$i<=$end;$i=date('Ym01', strtotime($i.'+1 month'))) { ?>
                      <option value="<?php echo substr($i,0,6) ?>" <?php echo substr($i,0,6) == $nengetu ? 'selected':"" ?>><?php echo substr($i,0,6) ?></option>
                      <?php } ?>
                    </select>
                    <!--<input type="text" name="nengetu" id="nengetu" value="<?php print($nengetu); ?>">-->
                </td>
              </tr>
            </table>
          </div>
        </div>
        <br />

        <!--<div class="row">
          <div class="col-3">
            <button type="button" class="btn btn-success btn-block" role="button" onClick="func(0);">検索</button>
          </div>
          <div class="col-3">
            <button type="button" class="btn btn-warning btn-block" role="button" onClick="func(1);">連勤残集計処理</button>
          </div>
          <div class="col-3">
            <button type="button" class="btn btn-success btn-block" role="button" onClick="func(2);">給与連携処理</button>
          </div>
          <div class="col-3">
            <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
          </div>
        </div>-->
        <div class="row">
        <?php if ($flg == 3) { ?>
          <div class="col-4">
            <button type="button" class="btn btn-info btn-block" role="button" onClick="func(0);">検索（勤務実績照会）</button>
          </div>
          <div class="col-4">
            <button type="button" class="btn btn-warning btn-block" role="button" onClick="func(1);">連勤残集計</button>
          </div>
          <div class="col-4">
            <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
          </div>
        <?php } else { ?>
          <div class="col-4">
            <button type="button" class="btn btn-warning btn-block" role="button" onClick="func(1);">連勤残集計</button>
          </div>
          <div class="col-4">
            <button type="button" class="btn btn-success btn-block" role="button" onClick="func(2);">給与連携データ出力</button>
          </div>
          <div class="col-4">
            <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
          </div>
        <?php } ?>
        </div>
        <br />

        <input type="hidden" name="act" value="">

      </form>

<?php 
    if ($act == "0") {
?>
              <table class="text-nowrap" border="1" style="font-size: 10pt; width:1100px">
<?php 
            for ($i=0;$i<count($wk->oup_t_wk_no);$i++) {
                /*
                 * 予定
                 */
?>

<?php 
                $head = "0";
                if ($genba_id=="") {
                    if (($i==0) || ($wk->oup_t_wk_genba_id[$i]!=$old_genba_id)) {
                        $head = "1";
                    }
                } else {
                if ($i%5==0) {
                        $head = "1";
                    }
                }

                // 深夜残業があるかどうか判断のフラグ
                $sinflg = false;

                // 予定があるかどうか判断のフラグ
                $yoteiflg = false;

                // 1日～月末までループ
                for ($j=1;$j<=31;$j++) {

                    // 日を2桁0埋めでフォーマット
                    $day = sprintf('%02d', $j);

                    if (($sin[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day][$wk->oup_t_wk_genba_id[$i]] == "") ||
                        ($sin[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day][$wk->oup_t_wk_genba_id[$i]] == "00:00")) {
                    } else {
                        $sinflg = true;
                    }

                    // 指定日の予定があるかどうか判定
                    if ($kbn[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day][$wk->oup_t_wk_genba_id[$i]] != "") {
                        $yoteiflg = true;
                    }
                    if ($kbn2[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day][$wk->oup_t_wk_genba_id[$i]] != "") {
                        $yoteiflg = true;
                    }

                }

                if ($head == "1") {

                    $meisaiflg = false;
?>

                    <tr bgcolor="FFDCA5">
                        <td align="center" rowspan="2">現場名</td>
                        <td align="center" rowspan="2">隊員ID</td>
                        <td align="center" rowspan="2">隊員名</td>
                        <td align="center" rowspan="2">&nbsp;</td>
<?php 
                    // 1日～月末までループ
                    for ($j=1;$j<=31;$j++) {
                        $time = strtotime(substr($nengetu, 0, 4) . "-" . substr($nengetu, 4, 2) . "-" . $j);
                        $w = date("w", $time);

                        print("<td align=\"center\">");

                        print($j."<br />");

                            print("</font>");
                        print("</td>");
                    }
?>
                        <td align="center" rowspan="2">泊</td>
                        <td align="center" rowspan="2">夜</td>
                        <td align="center" rowspan="2">日</td>
                        <td align="center" rowspan="2">時</td>
                        <td align="center" rowspan="2">時間給<br />時間外</td>
                        <td align="center" rowspan="2">集計<br />ﾁｪｯｸ</td>
                    </tr>
                    <tr bgcolor="FFDCA5">
<?php 
                    // 1日～月末までループ
                    for ($j=1;$j<=31;$j++) {
                        $time = strtotime(substr($nengetu, 0, 4) . "-" . substr($nengetu, 4, 2) . "-" . $j);
                        $w = date("w", $time);

                        print("<td align=\"center\">");

                        if ($week[$w]=="土") {
                            print("<font color=\"blue\">");
                        } elseif ($week[$w]=="日") {
                            print("<font color=\"red\">");
                        } elseif ($wk_holiday != "" && strpos($wk_holiday,sprintf("%02d",$j)) !== false) {
                            print("<font color=\"red\">");
                        } else {
                            print("<font color=\"black\">");
                    }

?>
                        <?php print($week[$w]); ?>
<?php 
                            print("</font>");
                        print("</td>");
                    }
?>

                    </tr>

<?php 
                }
?>

                <?php  if ($yoteiflg) { ?>

                    <?php $meisaiflg = true; ?>

                    <tr>
                        <?php if ($sinflg) { ?>
                        <td rowspan="4">
                        <?php } else { ?>
                        <td rowspan="3">
                        <?php } ?>
                            <?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?>
                        </td>
                        <?php if ($sinflg) { ?>
                        <td rowspan="4">
                        <?php } else { ?>
                        <td rowspan="3">
                        <?php } ?>
                            <?php print($wk->oup_t_wk_taiin_id[$i]);              /* 隊員ID */ ?>
                        </td>
                        <?php if ($sinflg) { ?>
                        <td rowspan="4">
                        <?php } else { ?>
                        <td rowspan="3">
                        <?php } ?>
                            <?php print($staffs[$wk->oup_t_wk_taiin_id[$i]]);     /* 隊員名 */ ?>
                        </td>
                        <td>予定</td>
<?php 
                $tomaricnt = 0;
                $yorucnt = 0;
                $nikincnt = 0;
                $syukeichk = 0;
                $jikyucnt = 0;

                // 1日～月末までループ
                for ($j=1;$j<=31;$j++) {

                    // 日を2桁0埋めでフォーマット
                    $day = sprintf('%02d', $j);

                    $nengetuwk = substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day;

                    // 指定日の予定があるかどうか判定
                    if ($kbn[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] != "") {

                        if ($kbn[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "1") {
                            $tomaricnt = $tomaricnt + 1;
                            $daytomaricnt[$j] = $daytomaricnt[$j] + 1;
                        }
                        if ($kbn[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "3") {
                            $yorucnt = $yorucnt + 1;
                            $dayyorucntcnt[$j] = $dayyorucntcnt[$j] + 1;
                        }
                        if ($kbn[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "2") {
                            $nikincnt = $nikincnt + 1;
                            $daynikincnt[$j] = $daynikincnt[$j] + 1;
                        }
                        if ($kbn[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "6") {
                            $jikyucnt = $jikyucnt + 1;
                            $dayjikyucnt[$j] = $dayjikyucnt[$j] + 1;
                        }

                        // 予定内容を表示
?>
                        <td align="center">
                            <?php print($shift->kbn[$kbn[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]]); ?>
                        </td>
<?php 
                    } else {
?>
                        <td>&nbsp;</td>
<?php 
                    }
                }

                $syukeichk = $tomaricnt*2+$yorucnt+$nikincnt+$jikyucnt;
?>

                        <td align="center"><?php print($tomaricnt); ?></td>
                        <td align="center"><?php print($yorucnt); ?></td>
                        <td align="center"><?php print($nikincnt); ?></td>
                        <td align="center"><?php print($jikyucnt); ?></td>
                        <td>&nbsp;</td>
                        <td align="center"><?php print($tomaricnt*2+$yorucnt+$nikincnt+$jikyucnt); ?></td>
                    </tr>

<?php 
                /*
                 * 実績
                 */
?>
                    <tr bgcolor="#CCFFCC">
                        <td>実績</td>
<?php 
                $tomaricnt = 0;
                $yorucnt = 0;
                $nikincnt = 0;
                $ng = 0;
                $jikyucnt = 0;

                // 1日～月末までループ
                for ($j=1;$j<=31;$j++) {

                    // 日を2桁0埋めでフォーマット
                    $day = sprintf('%02d', $j);

                    $nengetuwk = substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day;

                    // 下番時刻があるかどうか判定
                    if ($jktime[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] != "") {

                        if ($jikyuflg[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "1") {
                            $jikyucnt = $jikyucnt + 1;
                            $dayjikyucnt2[$j] = $dayjikyucnt2[$j] + 1;
                            print("<td align=\"center\">".$kintime[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]."</td>");
                        } else if ($kbn2[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "1") {
                            $tomaricnt = $tomaricnt + 1;
                            $daytomaricnt2[$j] = $daytomaricnt2[$j] + 1;
                            print("<td align=\"center\">◎</td>");
                        } else if ($kbn2[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "3") {
                            $yorucnt = $yorucnt + 1;
                            $dayyorucntcnt2[$j] = $dayyorucntcnt2[$j] + 1;
                            print("<td align=\"center\">▲</td>");
                        } else if ($kbn2[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "2") {
                            $nikincnt = $nikincnt + 1;
                            $daynikincnt2[$j] = $daynikincnt2[$j] + 1;
                            print("<td align=\"center\">○</td>");
                        } else if ($kbn2[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "6") {
                            $jikyucnt = $jikyucnt + 1;
                            $dayjikyucnt2[$j] = $dayjikyucnt2[$j] + 1;
                            print("<td align=\"center\">".$kintime[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]."</td>");
                        } else if ($kbn2[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "4") {
                            print("<td align=\"center\">年</td>");
                        } else {
                            print("<td align=\"center\">？</td>");
                        }
?>
<?php 
                    } else {

                        if ($jbnkbn[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "4") {
                            print("<td align=\"center\">年</td>");
                        } else if ($jbnkbn[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "5") {
                            print("<td align=\"center\">欠</td>");
                        } else {
                            print("<td>&nbsp;</td>");
                        }
                    }
                }
                if ($syukeichk != $tomaricnt*2+$yorucnt+$nikincnt+$jikyucnt) {
                    $ng = 1;
                }
?>
                        <td align="center"><?php print($tomaricnt); ?></td>
                        <td align="center"><?php print($yorucnt); ?></td>
                        <td align="center"><?php print($nikincnt); ?></td>
                        <td align="center"><?php print($jikyucnt); ?></td>
                        <td>&nbsp;</td>
                        <td align="center"><?php if ($ng==1) { print("<font color='red'>"); } ?><?php print($tomaricnt*2+$yorucnt+$nikincnt+$jikyucnt); ?></td><?php if ($ng==1) { print("</font>"); } ?>
                    </tr>

<?php 
                /*
                 * 残業
                 */
?>
                    <tr bgcolor="#CCFFCC">
                        <td>時間外</td>

<?php 
                $wk5 = 0;

                // 1日～月末までループ
                for ($j=1;$j<=31;$j++) {

                    // 日を2桁0埋めでフォーマット
                    $day = sprintf('%02d', $j);

                    $nengetuwk = substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day;

                    // 下番時刻があるかどうか判定
                    if ($jktime[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "") {
?>
                            <td>&nbsp;</td>
<?php 
                    } else {

                        // 残業があるかどうか判定
                    if (($zan[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day][$wk->oup_t_wk_genba_id[$i]] == "") ||
                        ($zan[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day][$wk->oup_t_wk_genba_id[$i]] == "00:00")) {
?>
                        <td>&nbsp;</td>
<?php 
                    } else {
                        $wk5 = $wk5 + $zan[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day][$wk->oup_t_wk_genba_id[$i]];
?>
                        <td align="center">
                            <font size="-1"><?php print($zan[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day][$wk->oup_t_wk_genba_id[$i]]); ?></font>
                        </td>
<?php 
                    }
                }
                }
?>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php print($wk5); ?></td>
                        <td align="center">&nbsp;</td>
                    </tr>

<?php 
                /*
                 * 深夜残業
                 */
?>

                <?php if ($sinflg) { ?>

                    <tr bgcolor="#CCFFCC">
                        <td>深夜</td>

<?php 

                        $wk6 = 0;

                        // 1日～月末までループ
                        for ($j=1;$j<=31;$j++) {

                            // 日を2桁0埋めでフォーマット
                            $day = sprintf('%02d', $j);

                            if (($sin[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day][$wk->oup_t_wk_genba_id[$i]] == "") ||
                                ($sin[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day][$wk->oup_t_wk_genba_id[$i]] == "00:00")) {
?>
                                <td>&nbsp;</td>

<?php 
                            } else {

                                $wk6 = $wk6 + $sin[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day][$wk->oup_t_wk_genba_id[$i]];
?>

                                <td align="center">
                                    <font size="-1"><?php print($sin[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day][$wk->oup_t_wk_genba_id[$i]]); ?></font>
                                </td>

<?php 
                            }
                        }
?>


                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php print($wk6); ?></td>
                        <td align="center">&nbsp;</td>
                    </tr>

                <?php } ?>
                <?php } ?>


                    <!-- 現場が変わったとき集計 -->
                    <?php if ((($i+1)==count($wk->oup_t_wk_no)) || (($i!=0) && ($wk->oup_t_wk_genba_id[$i]!=$wk->oup_t_wk_genba_id[$i+1]))) { ?>

                        <?php if ($meisaiflg) { ?>

                        <tr bgcolor="#DCE6F1">
                            <td align="left"><?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?></td>
                            <td align="center">予定合計</td>
                            <td align="left">泊</td>
                            <td align="left">予定</td>

<?php
                            // 1日～月末までループ
                            for ($j=1;$j<=31;$j++) {
?>
                                <td align="center">
                                    <?php print($daytomaricnt[$j]); ?>
                                    <?php $monthtomaricnt=$monthtomaricnt+$daytomaricnt[$j]; ?>
                                    <?php $daytomaricnt[$j]=""; ?>
                                </td>
<?php 
                            }
?>
                            <td align="center"><?php print($monthtomaricnt); ?></td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <?php $monthtomaricnt=0; ?>

                        </tr>
                        <tr bgcolor="#DCE6F1">
                            <td align="left"><?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?></td>
                            <td align="center">予定合計</td>
                            <td align="left">夜</td>
                            <td align="left">予定</td>

<?php
                            // 1日～月末までループ
                            for ($j=1;$j<=31;$j++) {
?>
                                <td align="center">
                                    <?php print($dayyorucntcnt[$j]); ?>
                                    <?php $monthyorucnt=$monthyorucnt+$dayyorucntcnt[$j]; ?>
                                    <?php $dayyorucntcnt[$j]=""; ?>
                                </td>
<?php 
                            }
?>

                            <td align="center">&nbsp;</td>
                            <td align="center"><?php print($monthyorucnt); ?></td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <?php $monthyorucnt=0; ?>

                        </tr>
                        <tr bgcolor="#DCE6F1">
                            <td align="left"><?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?></td>
                            <td align="center">予定合計</td>
                            <td align="left">日</td>
                            <td align="left">予定</td>

<?php
                            // 1日～月末までループ
                            for ($j=1;$j<=31;$j++) {
?>
                                <td align="center">
                                    <?php print($daynikincnt[$j]); ?>
                                    <?php $monthnikincnt=$monthnikincnt+$daynikincnt[$j]; ?>
                                    <?php $daynikincnt[$j]=""; ?>
                                </td>
<?php 
                            }
?>

                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center"><?php print($monthnikincnt); ?></td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <?php $monthnikincnt=0; ?>

                        </tr>
                        <tr bgcolor="#DCE6F1">
                            <td align="left"><?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?></td>
                            <td align="center">予定合計</td>
                            <td align="left">時</td>
                            <td align="left">予定</td>

<?php
                            // 1日～月末までループ
                            for ($j=1;$j<=31;$j++) {
?>
                                <td align="center">
                                    <?php print($dayjikyucnt[$j]); ?>
                                    <?php $monthjikyucnt=$monthjikyucnt+$dayjikyucnt[$j]; ?>
                                    <?php $dayjikyucnt[$j]=""; ?>
                                </td>
<?php 
                            }
?>

                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center"><?php print($monthjikyucnt); ?></td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <?php $monthjikyucnt=0; ?>

                        </tr>

                        <tr bgcolor="#ffff99">
                            <td align="left"><?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?></td>
                            <td align="center">実績合計</td>
                            <td align="left">泊</td>
                            <td align="left">実績</td>

<?php
                            // 1日～月末までループ
                            for ($j=1;$j<=31;$j++) {
?>
                                <td align="center">
                                    <?php print($daytomaricnt2[$j]); ?>
                                    <?php $monthtomaricnt2=$monthtomaricnt2+$daytomaricnt2[$j]; ?>
                                    <?php $daytomaricnt2[$j]=""; ?>
                                </td>
<?php 
                            }
?>

                            <td align="center"><?php print($monthtomaricnt2); ?></td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <?php $monthtomaricnt2=0; ?>
                        </tr>
                        <tr bgcolor="#ffff99">
                            <td align="left"><?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?></td>
                            <td align="center">実績合計</td>
                            <td align="left">夜</td>
                            <td align="left">実績</td>

<?php
                            // 1日～月末までループ
                            for ($j=1;$j<=31;$j++) {
?>
                                <td align="center">
                                    <?php print($dayyorucntcnt2[$j]); ?>
                                    <?php $monthyorucnt2=$monthyorucnt2+$dayyorucntcnt2[$j]; ?>
                                    <?php $dayyorucntcnt2[$j]=""; ?>
                                </td>
<?php 
                            }
?>

                            <td align="center">&nbsp;</td>
                            <td align="center"><?php print($monthyorucnt2); ?></td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <?php $monthyorucnt2=0; ?>

                        </tr>
                        <tr bgcolor="#ffff99">
                            <td align="left"><?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?></td>
                            <td align="center">実績合計</td>
                            <td align="left">日</td>
                            <td align="left">実績</td>

<?php
                            // 1日～月末までループ
                            for ($j=1;$j<=31;$j++) {
?>
                                <td align="center">
                                    <?php print($daynikincnt2[$j]); ?>
                                    <?php $monthnikincnt2=$monthnikincnt2+$daynikincnt2[$j]; ?>
                                    <?php $daynikincnt2[$j]=""; ?>
                                </td>
<?php 
                            }
?>

                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center"><?php print($monthnikincnt2); ?></td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <?php $monthnikincnt2=0; ?>

                        </tr>
                        <tr bgcolor="#ffff99">
                            <td align="left"><?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?></td>
                            <td align="center">実績合計</td>
                            <td align="left">時</td>
                            <td align="left">実績</td>

<?php
                            // 1日～月末までループ
                            for ($j=1;$j<=31;$j++) {
?>
                                <td align="center">
                                    <?php print($dayjikyucnt2[$j]); ?>
                                    <?php $monthjikyucnt2=$monthjikyucnt2+$dayjikyucnt2[$j]; ?>
                                    <?php $dayjikyucnt2[$j]=""; ?>
                                </td>
<?php 
                            }
?>

                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <td align="center"><?php print($monthjikyucnt2); ?></td>
                            <td align="center">&nbsp;</td>
                            <td align="center">&nbsp;</td>
                            <?php $monthjikyucnt2=0; ?>

                        </tr>

                        <?php } ?>
                    <?php } ?>



<?php 
                $old_genba_id = $wk->oup_t_wk_genba_id[$i];
            }
?>
                </table>
<?php 
    }
?>


    </div>

      <div class="modal-footer">
          <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
      </div><!-- /footer -->

  </body>
</html>
