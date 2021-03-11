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
        <h4>勤務集計表</h4>
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

        <div class="row">
          <div class="col-3">
            <button type="button" class="btn btn-success btn-block" role="button" onClick="func(0);">検索</button>
          </div>
          <div class="col-3">
            <button type="button" class="btn btn-success btn-block" role="button" onClick="func(1);">集計処理</button>
          </div>
          <div class="col-3">
            <button type="button" class="btn btn-success btn-block" role="button" onClick="func(2);">給与連携データ出力</button>
          </div>
          <div class="col-3">
            <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
          </div>
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
                if ($i%5==0) {
?>

                    <tr bgcolor="FFDCA5">
                        <td align="center">現場名</td>
                        <td align="center">隊員ID</td>
                        <td align="center">隊員名</td>
                        <td align="center">&nbsp;</td>
<?php 
                    // 1日～月末までループ
                    for ($j=1;$j<=31;$j++) {
?>
                        <td align="center"><?php print($j); ?></td>
<?php 
                    }
?>
                        <td align="center">泊</td>
                        <td align="center">夜</td>
                        <td align="center">日</td>
                        <td align="center">時</td>
                        <td align="center">時間給<br />時間外</td>
                        <td align="center">集計<br />ﾁｪｯｸ</td>
                    </tr>

<?php 
                }
?>


                    <tr>
                        <td rowspan="3">
                            <?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?>
                        </td>
                        <td rowspan="3">
                            <?php print($wk->oup_t_wk_taiin_id[$i]);              /* 隊員ID */ ?>
                        </td>
                        <td rowspan="3">
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
                        }
                        if ($kbn[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "3") {
                            $yorucnt = $yorucnt + 1;
                        }
                        if ($kbn[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "2") {
                            $nikincnt = $nikincnt + 1;
                        }
                        if ($kbn[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "6") {
                            $jikyucnt = $jikyucnt + 1;
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

                        if ($kbn2[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "1") {
                            $tomaricnt = $tomaricnt + 1;
                            print("<td align=\"center\">◎</td>");
                        } else if ($kbn2[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "3") {
                            $yorucnt = $yorucnt + 1;
                            print("<td align=\"center\">▲</td>");
                        } else if ($kbn2[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "2") {
                            $nikincnt = $nikincnt + 1;
                            print("<td align=\"center\">○</td>");
                        } else if ($kbn2[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "6") {
                            $jikyucnt = $jikyucnt + 1;
                            print("<td align=\"center\">時</td>");
                        } else if ($kbn2[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "4") {
                            print("<td align=\"center\">年</td>");
                        } else {
                            print("<td align=\"center\">？</td>");
                        }
?>
<?php 
                    } else {

                        if ($kbn2[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "4") {
                            print("<td align=\"center\">年</td>");
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
?>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                        <td align="center"><?php print($wk5); ?></td>
                        <td align="center">&nbsp;</td>
                    </tr>

<?php 
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
