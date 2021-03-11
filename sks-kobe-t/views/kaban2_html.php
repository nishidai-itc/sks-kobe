<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" media="screen, projection" />
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>　
    <title>勤怠管理システム</title>
  </head>

  <body>
    <div class="container">
      <div class="page-header">
        <h4>下番報告（個人用）</h4>
      </div>

        <?php if ($errmsg != "") { ?>
            <div class="row">
              <div class="col-12"><pre><p class="text-danger"><?php print($errmsg); ?></p></pre></div>
            </div>
        <?php } ?>

      <form name="frm" method="POST" action="kaban2.php" enctype="multipart/form-data">

        <div class="row">
          <div class="col-12">
            <table class="table table-bordered">
              <tr>
                <td bgcolor="FFDCA5" align="center">報告者</td>
                <td><?php print($common->html_display($staff->oup_m_staff_name[0])); ?></td>
              </tr>
              <tr>
                <td bgcolor="FFDCA5" align="center">日付</td>
                <td><?php print(substr($work->oup_t_work_plan_date[0],0,4)."年".substr($work->oup_t_work_plan_date[0],5,2)."月".substr($work->oup_t_work_plan_date[0],8,2)."日"); ?>(<?php print($week[$w]); ?>)</td>
              </tr>
              <tr>
                <td bgcolor="FFDCA5" align="center">現場名</td>
                <td><?php echo $genba->oup_m_genba_name[0] ?></td>
              </tr>
              <tr>
                <td bgcolor="FFDCA5" align="center">勤務</td>
                <td><?php print($kinmu); ?></td>
              </tr>
            </table>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12 col-md-12">
            <table class="table table-bordered">
              <tr align="center">
                <td colspan="3">
                  <label class="radio-inline"><input type="radio" name="kaban_kbn" value="1" <?php if ($work->oup_t_work_kaban_kbn[0]=="1") { print("checked"); } ?> > 通常</label>　
                  <label class="radio-inline"><input type="radio" name="kaban_kbn" value="2" <?php if ($work->oup_t_work_kaban_kbn[0]=="2") { print("checked"); } ?> > 早退</label>　
                  <label class="radio-inline"><input type="radio" name="kaban_kbn" value="4" <?php if ($work->oup_t_work_kaban_kbn[0]=="4") { print("checked"); } ?> > 指示終了</label>　
                  <label class="radio-inline"><input type="radio" name="kaban_kbn" value="3" <?php if ($work->oup_t_work_kaban_kbn[0]=="3") { print("checked"); } ?> > 残業有</label>　
                </td>
              </tr>
              <tr align="center">
                <td width="50" rowspan="2" bgcolor="FFDCA5">所定</td>
                <td width="50" bgcolor="FFDCA5">開始</td>
                <td><?php print(substr($work->oup_t_work_plan_joban_time[0],0,5)); ?></td>
              </tr>
              <tr align="center">
                <td bgcolor="FFDCA5">終了</td>
                <td><?php print(substr($work->oup_t_work_plan_kaban_time[0],0,5)); ?></td>
              </tr>
              <tr align="center">
                <td rowspan="2" bgcolor="d5d5d5">打刻</td>
                <td height="50" bgcolor="d5d5d5">上番</td>
                <td bgcolor="d5d5d5" align="left">
                  <table>
                    <tr>
                      <td width="150">
                        <input type="time" step="60" name="joban_time" class="form-control" value="<?php print(substr($joban_time,0,5)); ?>">
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr align="center">
                <td height="50" bgcolor="d5d5d5">下番</td>
                <td bgcolor="d5d5d5" align="left">
                  <table>
                    <tr>
                      <td width="150">
                        <input type="time" step="60" name="kaban_time" class="form-control" value="<?php print(substr($kaban_time,0,5)); ?>">
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr align="center">
                <td rowspan="13" bgcolor="d5d5d5">残業</td>
                <td height="50" bgcolor="d5d5d5">早出<br />残業</td>
                <td bgcolor="d5d5d5"><?php print(substr($joban_time,0,5)); ?> ～ <?php print(substr($work->oup_t_work_plan_joban_time[0],0,5)); ?>　<?php print($hayade); ?>分</td>
              </tr>
              <tr align="center">
                <td height="50" bgcolor="d5d5d5">通常<br />残業</td>
                <td bgcolor="d5d5d5"><?php print(substr($work->oup_t_work_plan_kaban_time[0],0,5)); ?> ～ <?php print(substr($kaban_time,0,5)); ?>　<?php print($tujo); ?>分</td>
              </tr>
              <tr>
                <td align="center" height="50" bgcolor="d5d5d5" rowspan="11">休憩<br />残業</td>
                <td bgcolor="d5d5d5">
                  <table>
                    <tr>
                      <td width="150"><input type="time" step="60" name="kyukei_start1" class="form-control" value="<?php print(substr($work->oup_t_work_kyukei_start1[0],0,5)); ?>"></td>
                      <td>～</td>
                      <td width="150"><input type="time" step="60" name="kyukei_end1" class="form-control" value="<?php print(substr($work->oup_t_work_kyukei_end1[0],0,5)); ?>"></td>
                    </tr>
                    <tr>
                      <td colspan="3"><?php print($kyukei1); ?>分</td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td bgcolor="d5d5d5">
                  <table>
                    <tr>
                      <td width="150"><input type="time" step="60" name="kyukei_start2" class="form-control" value="<?php print(substr($work->oup_t_work_kyukei_start2[0],0,5)); ?>"></td>
                      <td>～</td>
                      <td width="150"><input type="time" step="60" name="kyukei_end2" class="form-control" value="<?php print(substr($work->oup_t_work_kyukei_end2[0],0,5)); ?>"></td>
                    </tr>
                    <tr>
                      <td colspan="3"><?php print($kyukei2); ?>分</td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td bgcolor="d5d5d5">
                  <table>
                    <tr>
                      <td width="150"><input type="time" step="60" name="kyukei_start3" class="form-control" value="<?php print(substr($work->oup_t_work_kyukei_start3[0],0,5)); ?>"></td>
                      <td>～</td>
                      <td width="150"><input type="time" step="60" name="kyukei_end3" class="form-control" value="<?php print(substr($work->oup_t_work_kyukei_end3[0],0,5)); ?>"></td>
                    </tr>
                    <tr>
                      <td colspan="3"><?php print($kyukei3); ?>分</td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td bgcolor="d5d5d5">
                  <table>
                    <tr>
                      <td width="150"><input type="time" step="60" name="kyukei_start4" class="form-control" value="<?php print(substr($work->oup_t_work_kyukei_start4[0],0,5)); ?>"></td>
                      <td>～</td>
                      <td width="150"><input type="time" step="60" name="kyukei_end4" class="form-control" value="<?php print(substr($work->oup_t_work_kyukei_end4[0],0,5)); ?>"></td>
                    </tr>
                    <tr>
                      <td colspan="3"><?php print($kyukei4); ?>分</td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td bgcolor="d5d5d5">
                  <table>
                    <tr>
                      <td width="150"><input type="time" step="60" name="kyukei_start5" class="form-control" value="<?php print(substr($work->oup_t_work_kyukei_start5[0],0,5)); ?>"></td>
                      <td>～</td>
                      <td width="150"><input type="time" step="60" name="kyukei_end5" class="form-control" value="<?php print(substr($work->oup_t_work_kyukei_end5[0],0,5)); ?>"></td>
                    </tr>
                    <tr>
                      <td colspan="3"><?php print($kyukei5); ?>分</td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td bgcolor="d5d5d5">
                  <table>
                    <tr>
                      <td width="150"><input type="time" step="60" name="kyukei_start5" class="form-control" value="<?php print(substr($work->oup_t_work_kyukei_start5[0],0,5)); ?>"></td>
                      <td>～</td>
                      <td width="150"><input type="time" step="60" name="kyukei_end5" class="form-control" value="<?php print(substr($work->oup_t_work_kyukei_end5[0],0,5)); ?>"></td>
                    </tr>
                    <tr>
                      <td colspan="3"><?php print($kyukei5); ?>分</td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td bgcolor="d5d5d5">
                  <table>
                    <tr>
                      <td width="150"><input type="time" step="60" name="kyukei_start5" class="form-control" value="<?php print(substr($work->oup_t_work_kyukei_start5[0],0,5)); ?>"></td>
                      <td>～</td>
                      <td width="150"><input type="time" step="60" name="kyukei_end5" class="form-control" value="<?php print(substr($work->oup_t_work_kyukei_end5[0],0,5)); ?>"></td>
                    </tr>
                    <tr>
                      <td colspan="3"><?php print($kyukei5); ?>分</td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td bgcolor="d5d5d5">
                  <table>
                    <tr>
                      <td width="150"><input type="time" step="60" name="kyukei_start5" class="form-control" value="<?php print(substr($work->oup_t_work_kyukei_start5[0],0,5)); ?>"></td>
                      <td>～</td>
                      <td width="150"><input type="time" step="60" name="kyukei_end5" class="form-control" value="<?php print(substr($work->oup_t_work_kyukei_end5[0],0,5)); ?>"></td>
                    </tr>
                    <tr>
                      <td colspan="3"><?php print($kyukei5); ?>分</td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td bgcolor="d5d5d5">
                  <table>
                    <tr>
                      <td width="150"><input type="time" step="60" name="kyukei_start5" class="form-control" value="<?php print(substr($work->oup_t_work_kyukei_start5[0],0,5)); ?>"></td>
                      <td>～</td>
                      <td width="150"><input type="time" step="60" name="kyukei_end5" class="form-control" value="<?php print(substr($work->oup_t_work_kyukei_end5[0],0,5)); ?>"></td>
                    </tr>
                    <tr>
                      <td colspan="3"><?php print($kyukei5); ?>分</td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td bgcolor="d5d5d5">
                  <table>
                    <tr>
                      <td width="150"><input type="time" step="60" name="kyukei_start5" class="form-control" value="<?php print(substr($work->oup_t_work_kyukei_start5[0],0,5)); ?>"></td>
                      <td>～</td>
                      <td width="150"><input type="time" step="60" name="kyukei_end5" class="form-control" value="<?php print(substr($work->oup_t_work_kyukei_end5[0],0,5)); ?>"></td>
                    </tr>
                    <tr>
                      <td colspan="3"><?php print($kyukei5); ?>分</td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td bgcolor="d5d5d5">
                  <table>
                    <tr>
                      <td width="150"><input type="time" step="60" name="kyukei_start5" class="form-control" value="<?php print(substr($work->oup_t_work_kyukei_start5[0],0,5)); ?>"></td>
                      <td>～</td>
                      <td width="150"><input type="time" step="60" name="kyukei_end5" class="form-control" value="<?php print(substr($work->oup_t_work_kyukei_end5[0],0,5)); ?>"></td>
                    </tr>
                    <tr>
                      <td colspan="3"><?php print($kyukei5); ?>分</td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr align="center">
                <td bgcolor="d5d5d5" colspan="2">交通費</td>
                <td bgcolor="d5d5d5">
                  <select name="kotuhi" id="selection" class="form-control">
                    <option value=""></option>
<?php
          $disp = false;
for ($i=0;$i<count($kotuhi->oup_m_kotuhi_no);$i++) { 
          if ($kotuhi->oup_m_kotuhi_cost[$i] == $work->oup_t_work_kotuhi[0]) {
              $selected = 'selected';
              $disp = true;
          } else {
              $selected = '';
          }
?>
                    <option value="<?php echo $kotuhi->oup_m_kotuhi_cost[$i]; ?>" <?php echo $selected; ?>><?php print($kotuhi->oup_m_kotuhi_place[$i]." ".$kotuhi->oup_m_kotuhi_cost[$i]); ?></option>
<?php } ?>
                  </select>
                  <input type="text" name="kotuhi2" list="klist" class="form-control" value="<?php if ($disp==false) { print($work->oup_t_work_kotuhi[0]); } ?>">
<!--
                  <input type="text" name="kotuhi" list="klist" class="form-control" value="<?php print($work->oup_t_work_kotuhi[0]); ?>">
                    <datalist id="klist">
<?php for ($i=0;$i<count($kotuhi->oup_m_kotuhi_no);$i++) { ?>
                      <option value="<?php print($kotuhi->oup_m_kotuhi_cost[$i]); ?>">
<?php } ?>
                    </datalist>
-->
                </td>
              </tr>
              <tr align="center">
                <td bgcolor="d5d5d5" colspan="2">ﾎﾟｽﾄ手当</td>
                <td bgcolor="d5d5d5"><input type="tel" name="post" class="form-control" value="<?php print($work->oup_t_work_post_teate[0]); ?>"></td>
              </tr>
              <tr align="center">
                <td bgcolor="d5d5d5" colspan="2">危険物<br />資格手当</td>
                <td bgcolor="d5d5d5"><input type="tel" name="sikaku" class="form-control" value="<?php print($work->oup_t_work_kiken_teate[0]); ?>"></td>
              </tr>
              <tr align="center">
                <td bgcolor="d5d5d5" colspan="2">車手当</td>
                <td bgcolor="d5d5d5"><input type="tel" name="kuruma" class="form-control" value="<?php print($work->oup_t_work_kuruma_teate[0]); ?>"></td>
              </tr>
              <tr align="center">
                <td bgcolor="d5d5d5" colspan="2">理由</td>
                <td bgcolor="d5d5d5"><input type="text" name="riyu" class="form-control" value="<?php print($work->oup_t_work_rest_reason[0]); ?>"></td>
              </tr>
            </table>
          </div>
        </div>
        <br />


        <input type="hidden" name="id" value="<?php print($_REQUEST["id"]); ?>">

        <div class="row">
          <div class="col-6">
            <button type="submit" class="btn btn-success btn-block btn-lg" role="button" aria-pressed="true">下番報告</button>
          </div>
          <div class="col-6">
<?php 
    if (isset($_REQUEST["id"])) {
?>
            <a href="kaban1.php" class="btn btn-secondary btn-block btn-lg" role="button" aria-pressed="true">戻る</a>
<?php 
    } else {
?>
            <a href="kaban1.php" class="btn btn-secondary btn-block btn-lg" role="button" aria-pressed="true">戻る</a>
<?php 
    }
?>
          </div>
        </div>
        <br />

        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">
        <INPUT type="hidden" name="work_no" value="<?php print($_GET['work_no']); ?>">

    </form>

    </div>
  </body>
</html>
