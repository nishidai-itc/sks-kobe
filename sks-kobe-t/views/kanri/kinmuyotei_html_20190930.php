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
    function confirm1(no) {
        var genba_id = $('#genba_id').val();
        var nengetu = $('#nengetu').val();
        var shift_no = $('#shift_no').val();
        if(!confirm('この項目を削除してもよろしいですか?')) return false;
        location.href = "kinmuyotei.php?search=&delete1=&wk_no="+no+"&genba_id="+genba_id+"&nengetu="+nengetu+"&shift_no="+shift_no;
    }
    function regist(wk_no,id) {
        var genba_id = $('#genba_id').val();
        var nengetu = $('#nengetu').val();
        var shift_no = $('#shift_no').val();
        var kensyu = $('#kensyu:checked').val();
        if (shift_no == "") {
            alert('登録するシフトを選択してください');
        } else {
            location.href = "kinmuyotei.php?search=&regist=&genba_id="+genba_id+"&nengetu="+nengetu+"&shift_no="+shift_no+"&wk_no="+wk_no+"&id="+id+"&kensyu="+kensyu;
        }
    }
    function del(wk_no) {
        var genba_id = $('#genba_id').val();
        var nengetu = $('#nengetu').val();
        var shift_no = $('#shift_no').val();
        location.href = "kinmuyotei.php?search=&delete2=&genba_id="+genba_id+"&nengetu="+nengetu+"&shift_no="+shift_no+"&wk_no="+wk_no;
    }
  </script>

  <body>
    <div class="container">
      <div class="page-header">
        <h4>勤務予定表</h4>
      </div>

      <form name="frm" method="POST" action="kinmuyotei.php">
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
                          <option value="<?php print($genba->oup_m_genba_id[$i]); ?>" <?php if ($genba_id===$genba->oup_m_genba_id[$i]) { print("selected"); } ?> ><?php print($genba->oup_m_genba_name[$i]); ?></option>
<?php } ?>
                        </select>
                      </td>
                      <td bgcolor="#d5d5d5">年月　</td>
                      <td bgcolor="#d5d5d5"><input type="tel" size="6" id="nengetu" name="nengetu" class="form-control" value="<?php print($nengetu); ?>"></td>
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
                          <option value="<?php print($shift->oup_m_shift_no[$i]); ?>"  <?php if ($shift_no===$shift->oup_m_shift_no[$i]) { print("selected"); } ?> ><?php print($shift->kbn[$shift->oup_m_shift_plan_kbn[$i]]." ".$shift->oup_m_shift_joban_time[$i]." ～ ".$shift->oup_m_shift_kaban_time[$i]); ?></option>
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

        <?php if (isset($_REQUEST['search'])) { ?>
        <div class="row">
          <div class="col-xs-12 col-md-12">
            <table border="1">
              <tr align="center" bgcolor="FFDCA5">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="2"></td>
                <td colspan="<?php print(intval($lastday)); ?>"><?php print($nengetu); ?></td>
                <td colspan="3" rowspan="2">集計</td>
                <td rowspan="3">&nbsp;</td>
              </tr>
              <tr align="center" bgcolor="FFDCA5">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td width="150" colspan="2">勤務者</td>
<?php for ($i=1;$i<=intval($lastday);$i++) { ?>
                <td width="28"><?php print($i); ?></td>
<?php } ?>
              </tr>
              <tr align="center" bgcolor="FFDCA5">
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td colspan="2"><a href="kinmutuika.php?genba_id=<?php print($genba_id); ?>&nengetu=<?php print($nengetu); ?>" class="btn btn-success btn-block" role="button" aria-pressed="true">追加</a></td>
<?php for ($i=1;$i<=intval($lastday);$i++) { ?>
    <?php $time = strtotime(substr($nengetu,0,4) . "-" . substr($nengetu,4,2) . "-" . $i); ?>
    <?php $w = date("w", $time); ?>
                <td><?php if (($week[$w]=="土") || ($week[$w]=="日")) { print("<font color=\"red\">"); } ?><?php print($week[$w]); ?><?php if (($week[$w]=="土") || ($week[$w]=="日")) { print("</font>"); } ?></td>
<?php } ?>
                <td width="28">日</td>
                <td width="28">夜</td>
                <td width="28">泊</td>
              </tr>

<?php $wk_taiin_id = "" ?>
<?php for ($i=0;$i<count($wk->oup_t_wk_no);$i++) { ?>
              <tr align="center">
              <?php if ($i===0) { ?>
                <td>&nbsp;</td>
              <?php } else { ?>
                <td><a href="kinmuyotei.php?search=&up=&wk_no=<?php print($wk->oup_t_wk_no[$i]); ?>&genba_id=<?php print($genba_id); ?>&nengetu=<?php print($nengetu); ?>" class="btn btn-success btn-block" role="button" aria-pressed="true">↑</a></td>
              <?php } ?>
              <?php if ($i===count($wk->oup_t_wk_no)-1) { ?>
                <td>&nbsp;</td>
              <?php } else { ?>
                <td><a href="kinmuyotei.php?search=&down=&wk_no=<?php print($wk->oup_t_wk_no[$i]); ?>&genba_id=<?php print($genba_id); ?>&nengetu=<?php print($nengetu); ?>" class="btn btn-success btn-block" role="button" aria-pressed="true">↓</a></td>
              <?php } ?>
                <td colspan="2"><a href="kinmunaiyo.html"><?php print($staffs[$wk->oup_t_wk_taiin_id[$i]]); ?></a></td>

        <?php $dayk1cnt = 0; ?>
        <?php $dayk2cnt = 0; ?>
        <?php $dayk3cnt = 0; ?>
        <?php for ($j=1;$j<=intval($lastday);$j++) { ?>
                <td>
            <?php $day = sprintf('%02d',$j); ?>
            <?php if ($kbn[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu,0,4)."-".substr($nengetu,4,2)."-".$day] == "") { ?>
                  <a href="#" onclick="regist(<?php print($wk->oup_t_wk_no[$i]); ?>,<?php print($j); ?>);">－</a>
            <?php } else { ?>
                  <a href="#" onclick="del(<?php print($wk_detail_no[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu,0,4)."-".substr($nengetu,4,2)."-".$day]); ?>);">
                  <?php print($shift->kbn[$kbn[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu,0,4)."-".substr($nengetu,4,2)."-".$day]]); ?></a>
                  <!-- 上番時間 -->
                  <br /><font size="-2"><?php print($jtime[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu,0,4)."-".substr($nengetu,4,2)."-".$day]); ?>
                  <!-- 下番時間 -->
                  <br /><?php print($ktime[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu,0,4)."-".substr($nengetu,4,2)."-".$day]); ?></font>
                  <?php 
                    if ($kbn[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu,0,4)."-".substr($nengetu,4,2)."-".$day]==1) { 
                        $dayk1cnt = $dayk1cnt+1; 
                        if ($ken[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu,0,4)."-".substr($nengetu,4,2)."-".$day]=="1") {
                            $kcnt1[$j] = $kcnt1[$j]+1; 
                        } else {
                            $tcnt1[$j] = $tcnt1[$j]+1; 
                        }
                    }
                    if ($kbn[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu,0,4)."-".substr($nengetu,4,2)."-".$day]==2) { 
                        $dayk2cnt = $dayk2cnt+1; 
                        if ($ken[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu,0,4)."-".substr($nengetu,4,2)."-".$day]=="1") {
                            $kcnt2[$j] = $kcnt2[$j]+1; 
                        } else {
                            $tcnt2[$j] = $tcnt2[$j]+1; 
                        }
                    }
                    if ($kbn[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu,0,4)."-".substr($nengetu,4,2)."-".$day]==3) { 
                        $dayk3cnt = $dayk3cnt+1; 
                        if ($ken[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu,0,4)."-".substr($nengetu,4,2)."-".$day]=="1") {
                            $kcnt3[$j] = $kcnt3[$j]+1; 
                        } else {
                            $tcnt3[$j] = $tcnt3[$j]+1; 
                        }
                    } 
                  ?>
            <?php } ?>
                </td>
        <?php } ?>

                <td><?php print($dayk2cnt); ?></td>
                <td><?php print($dayk3cnt); ?></td>
                <td><?php print($dayk1cnt); ?></td>
                <td><a href="#" onClick="confirm1(<?php print($wk->oup_t_wk_no[$i]); ?>);">削</a></td>
              </tr>
<?php } ?>
<?php // var_dump($tcnt2); ?>
              <tr>
                <td></td>
                <td></td>
                <td colspan="2">&nbsp;</td>
                <td></td>
        <?php for ($j=1;$j<=intval($lastday);$j++) { ?>
                <td></td>
        <?php } ?>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td rowspan="3" width="60">通常計</td>
                <td><?php print($shift->kbn[2]); ?></td>
        <?php for ($j=1;$j<=intval($lastday);$j++) { ?>
                <td align="right"><?php print($tcnt2[$j]); ?></td>
        <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td><?php print($shift->kbn[3]); ?></td>
        <?php for ($j=1;$j<=intval($lastday);$j++) { ?>
                <td align="right"><?php print($tcnt3[$j]); ?></td>
        <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td><?php print($shift->kbn[1]); ?></td>
        <?php for ($j=1;$j<=intval($lastday);$j++) { ?>
                <td align="right"><?php print($tcnt1[$j]); ?></td>
        <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td rowspan="3" width="60">研修計</td>
                <td>日</td>
        <?php for ($j=1;$j<=intval($lastday);$j++) { ?>
                <td align="right"><?php print($kcnt2[$j]); ?></td>
        <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td>夜</td>
        <?php for ($j=1;$j<=intval($lastday);$j++) { ?>
                <td align="right"><?php print($kcnt3[$j]); ?></td>
        <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td>泊</td>
        <?php for ($j=1;$j<=intval($lastday);$j++) { ?>
                <td align="right"><?php print($kcnt1[$j]); ?></td>
        <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td rowspan="3" width="60">総合計</td>
                <td>日</td>
        <?php for ($j=1;$j<=intval($lastday);$j++) { ?>
                <td align="right"><?php print($tcnt2[$j]+$kcnt2[$j]); ?></td>
        <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td>夜</td>
        <?php for ($j=1;$j<=intval($lastday);$j++) { ?>
                <td align="right"><?php print($tcnt3[$j]+$kcnt3[$j]); ?></td>
        <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td></td>
                <td></td>
                <td>泊</td>
        <?php for ($j=1;$j<=intval($lastday);$j++) { ?>
                <td align="right"><?php print($tcnt1[$j]+$kcnt1[$j]); ?></td>
        <?php } ?>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </table>
          </div>
        </div>
        <br />
        <?php } ?>

        <div class="row">
          <div class="col-6">
            <a href="勤務予定表.xlsx" class="btn btn-success btn-block" role="button" aria-pressed="true">Excel出力</a>
          </div>
          <div class="col-6">
            <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">メニューに戻る</a>
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
