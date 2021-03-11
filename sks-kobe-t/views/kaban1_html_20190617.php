<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" media="screen, projection" />
    <script type="text/javascript" src="bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/jquery.balloon.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>　
    <title>勤怠管理システム</title>
  </head>

<script language="JavaScript" type="text/javascript">
<!--
  // 「全て選択」チェックで全てにチェック付く
  function AllChecked(){
    var chked = document.getElementById('all').checked;

<?php for($i=0;$i<count($work_mem->oup_t_work_taiin_id);$i++) { ?>
    document.getElementById('in_normal<?php echo $i; ?>').checked = chked;
//    document.getElementById('jtime<?php echo $i; ?>').value = document.getElementById('plan_time<?php echo $i; ?>').value;
<?php } ?> 
  }
// -->
</script>

  <body>
    <div class="container">
      <div class="page-header">
        <h4>下番報告（リーダー用）</h4>
      </div>

      <form name="frm" method="POST" action="login.php">

        <div class="row">
          <div class="col-3 bg-warning border border-dark text-center">勤務者</div>
          <div class="col-3 border border-dark text-center"><?php echo $staff->oup_m_staff_name[0]; ?></div>
          <div class="col-6"></div>

          <div class="col-3 bg-warning border border-dark text-center">日付</div>
          <div class="col-3 border border-dark text-center"><?php print(substr($work->oup_t_work_plan_date[0],0,4)."年".substr($work->oup_t_work_plan_date[0],5,2)."月".substr($work->oup_t_work_plan_date[0],8,2)."日"); ?>(<?php print($week[$w]); ?>)</div>

          <div class="col-2"></div>
          <div class="col-4 bg-success border border-dark text-center">昼残業雛形</div>


          <div class="col-3 bg-warning border border-dark text-center">現場名</div>
          <div class="col-3 border border-dark text-center"><?php echo $genba->oup_m_genba_name[0] ?></div>
          <div class="col-2"></div>

          <div class="col-2 border border-dark text-center">
            <input type="time" step="60" name="kaban_time" class="form-control" value="12:00">
          </div>
          <div class="col-2 border border-dark text-center">
            <input type="time" step="60" name="kaban_time" class="form-control" value="13:00">
          </div>

          <div class="col-8"></div>
        </div>

        <br />
        <div class="row">
          <div class="col-1 bg-warning border border-dark text-center">氏名</div>
          <div class="col-1 bg-warning border border-dark text-center">勤務</div>
          <div class="col-1 bg-warning border border-dark text-center">開始<br />終了</div>
          <div class="col-1 bg-warning border border-dark text-center">上番<br />時刻</div>
          <div class="col-2 bg-warning border border-dark text-center">下番<br />時刻</div>
          <div class="col-1 bg-warning border border-dark text-center">交通費</div>
          <div class="col-1 bg-warning border border-dark text-center">ﾎﾟｽﾄ</div>
          <div class="col-1 bg-warning border border-dark text-center">危険物</div>
          <div class="col-1 bg-warning border border-dark text-center">車</div>
          <div class="col-2 bg-warning border border-dark text-center">理由</div>
          <div class="col-2 bg-warning border border-dark text-center">昼残業</div>
          <div class="col-4 bg-warning border border-dark text-center">深夜残業</div>
          <div class="col-4 bg-warning border border-dark text-center">その他残業</div>
          <div class="col-2 bg-warning border border-dark text-center"></div>

          <div class="col-1 border border-dark text-center">福島</div>
          <div class="col-1 border border-dark text-center">日勤</div>
          <div class="col-1 border border-dark text-center">8:00<br />18:00</div>
          <div class="col-1 border border-dark text-center">7:30</div>
          <div class="col-2 border border-dark text-center"><input type="time" step="60" name="kaban_time" class="form-control" value="19:00"></div>
          <div class="col-1 border border-dark text-center"><input type="tel" name="post" class="form-control" value="500"></div>
          <div class="col-1 border border-dark text-center"><input type="tel" name="post" class="form-control" value="1500"></div>
          <div class="col-1 border border-dark text-center"><input type="tel" name="post" class="form-control" value=""></div>
          <div class="col-1 border border-dark text-center"><input type="tel" name="post" class="form-control" value=""></div>
          <div class="col-2 border border-dark text-center"><input type="text" name="post" class="form-control" value=""></div>
          <div class="col-1 border border-dark text-center"><a href="#">昼残</a></div>
          <div class="col-1 border border-dark text-center"><a href="#">昼残</a></div>
          <div class="col-2 border border-dark text-center"><input type="time" step="60" name="kaban_time" class="form-control" value=""></div>
          <div class="col-2 border border-dark text-center"><input type="time" step="60" name="kaban_time" class="form-control" value=""></div>
          <div class="col-2 border border-dark text-center"><input type="time" step="60" name="kaban_time" class="form-control" value=""></div>
          <div class="col-2 border border-dark text-center"><input type="time" step="60" name="kaban_time" class="form-control" value=""></div>
          <div class="col-2 border border-dark text-center"></div>
          <div class="col-12">&nbsp;</div>

          <div class="col-1 border border-dark text-center">井上</div>
          <div class="col-1 border border-dark text-center">日勤</div>
          <div class="col-1 border border-dark text-center">7:00<br />17:00</div>
          <div class="col-1 border border-dark text-center">7:00</div>
          <div class="col-2 border border-dark text-center"><input type="time" step="60" name="kaban_time" class="form-control" value="17:00"></div>
          <div class="col-1 border border-dark text-center"><input type="tel" name="post" class="form-control" value="700"></div>
          <div class="col-1 border border-dark text-center"><input type="tel" name="post" class="form-control" value=""></div>
          <div class="col-1 border border-dark text-center"><input type="tel" name="post" class="form-control" value=""></div>
          <div class="col-1 border border-dark text-center"><input type="tel" name="post" class="form-control" value=""></div>
          <div class="col-2 border border-dark text-center"><input type="text" name="post" class="form-control" value=""></div>
          <div class="col-1 border border-dark text-center"><a href="#">昼残</a></div>
          <div class="col-1 border border-dark text-center"><a href="#">昼残</a></div>
          <div class="col-2 border border-dark text-center"><input type="time" step="60" name="kaban_time" class="form-control" value=""></div>
          <div class="col-2 border border-dark text-center"><input type="time" step="60" name="kaban_time" class="form-control" value=""></div>
          <div class="col-2 border border-dark text-center"><input type="time" step="60" name="kaban_time" class="form-control" value=""></div>
          <div class="col-2 border border-dark text-center"><input type="time" step="60" name="kaban_time" class="form-control" value=""></div>
          <div class="col-2 border border-dark text-center"></div>
          <div class="col-12">&nbsp;</div>

          <div class="col-1 border border-dark text-center">山田</div>
          <div class="col-1 border border-dark text-center">日勤</div>
          <div class="col-1 border border-dark text-center">7:30<br />17:30</div>
          <div class="col-1 border border-dark text-center">7:30</div>
          <div class="col-2 border border-dark text-center"><input type="time" step="60" name="kaban_time" class="form-control" value="17:00"></div>
          <div class="col-1 border border-dark text-center"><input type="tel" name="post" class="form-control" value="400"></div>
          <div class="col-1 border border-dark text-center"><input type="tel" name="post" class="form-control" value=""></div>
          <div class="col-1 border border-dark text-center"><input type="tel" name="post" class="form-control" value=""></div>
          <div class="col-1 border border-dark text-center"><input type="tel" name="post" class="form-control" value=""></div>
          <div class="col-2 border border-dark text-center"><input type="text" name="post" class="form-control" value=""></div>
          <div class="col-1 border border-dark text-center"><a href="#">昼残</a></div>
          <div class="col-1 border border-dark text-center"><a href="#">昼残</a></div>
          <div class="col-2 border border-dark text-center"><input type="time" step="60" name="kaban_time" class="form-control" value=""></div>
          <div class="col-2 border border-dark text-center"><input type="time" step="60" name="kaban_time" class="form-control" value=""></div>
          <div class="col-2 border border-dark text-center"><input type="time" step="60" name="kaban_time" class="form-control" value=""></div>
          <div class="col-2 border border-dark text-center"><input type="time" step="60" name="kaban_time" class="form-control" value=""></div>
          <div class="col-2 border border-dark text-center"></div>
          <div class="col-12">&nbsp;</div>

          <div class="col-1 bg-warning border border-dark text-center">氏名</div>
          <div class="col-1 bg-warning border border-dark text-center">勤務</div>
          <div class="col-1 bg-warning border border-dark text-center">開始<br />終了</div>
          <div class="col-1 bg-warning border border-dark text-center">上番<br />時刻</div>
          <div class="col-2 bg-warning border border-dark text-center">下番<br />時刻</div>
          <div class="col-1 bg-warning border border-dark text-center">交通費</div>
          <div class="col-1 bg-warning border border-dark text-center">ﾎﾟｽﾄ</div>
          <div class="col-1 bg-warning border border-dark text-center">危険物</div>
          <div class="col-1 bg-warning border border-dark text-center">車</div>
          <div class="col-2 bg-warning border border-dark text-center">理由</div>
          <div class="col-2 bg-warning border border-dark text-center">昼残業</div>
          <div class="col-4 bg-warning border border-dark text-center">深夜残業</div>
          <div class="col-4 bg-warning border border-dark text-center">その他残業</div>
          <div class="col-2 bg-warning border border-dark text-center"></div>

          <div class="col-1 border border-dark text-center">徳田</div>
          <div class="col-1 border border-dark text-center">日勤</div>
          <div class="col-1 border border-dark text-center">7:30<br />17:30</div>
          <div class="col-1 border border-dark text-center">7:30</div>
          <div class="col-2 border border-dark text-center"><input type="time" step="60" name="kaban_time" class="form-control" value="17:00"></div>
          <div class="col-1 border border-dark text-center"><input type="tel" name="post" class="form-control" value="400"></div>
          <div class="col-1 border border-dark text-center"><input type="tel" name="post" class="form-control" value=""></div>
          <div class="col-1 border border-dark text-center"><input type="tel" name="post" class="form-control" value=""></div>
          <div class="col-1 border border-dark text-center"><input type="tel" name="post" class="form-control" value=""></div>
          <div class="col-2 border border-dark text-center"><input type="text" name="post" class="form-control" value=""></div>
          <div class="col-1 border border-dark text-center"><a href="#">昼残</a></div>
          <div class="col-1 border border-dark text-center"><a href="#">昼残</a></div>
          <div class="col-2 border border-dark text-center"><input type="time" step="60" name="kaban_time" class="form-control" value=""></div>
          <div class="col-2 border border-dark text-center"><input type="time" step="60" name="kaban_time" class="form-control" value=""></div>
          <div class="col-2 border border-dark text-center"><input type="time" step="60" name="kaban_time" class="form-control" value=""></div>
          <div class="col-2 border border-dark text-center"><input type="time" step="60" name="kaban_time" class="form-control" value=""></div>
          <div class="col-2 border border-dark text-center"></div>
          <div class="col-12">&nbsp;</div>

          <div class="col-1 border border-dark text-center">谷</div>
          <div class="col-1 border border-dark text-center">泊</div>
          <div class="col-1 border border-dark text-center">8:00<br />8:00</div>
          <div class="col-1 border border-dark text-center">8:00</div>
          <div class="col-2 border border-dark text-center"><input type="time" step="60" name="kaban_time" class="form-control" value="08:00"></div>
          <div class="col-1 border border-dark text-center"><input type="tel" name="post" class="form-control" value="400"></div>
          <div class="col-1 border border-dark text-center"><input type="tel" name="post" class="form-control" value=""></div>
          <div class="col-1 border border-dark text-center"><input type="tel" name="post" class="form-control" value=""></div>
          <div class="col-1 border border-dark text-center"><input type="tel" name="post" class="form-control" value=""></div>
          <div class="col-2 border border-dark text-center"><input type="text" name="post" class="form-control" value=""></div>
          <div class="col-1 border border-dark text-center"><a href="#">昼残</a></div>
          <div class="col-1 border border-dark text-center"><a href="#">昼残</a></div>
          <div class="col-2 border border-dark text-center"><input type="time" step="60" name="kaban_time" class="form-control" value=""></div>
          <div class="col-2 border border-dark text-center"><input type="time" step="60" name="kaban_time" class="form-control" value=""></div>
          <div class="col-2 border border-dark text-center"><input type="time" step="60" name="kaban_time" class="form-control" value=""></div>
          <div class="col-2 border border-dark text-center"><input type="time" step="60" name="kaban_time" class="form-control" value=""></div>
          <div class="col-2 border border-dark text-center"></div>
          <div class="col-12">&nbsp;</div>


        </div>
        <br />

        <div class="row">
          <div class="col-6">
            <a href="menu.php" class="btn btn-success btn-block btn-lg" role="button" aria-pressed="true">下番報告</a>
          </div>
          <div class="col-6">
            <a href="menu.php" class="btn btn-secondary btn-block btn-lg" role="button" aria-pressed="true">戻る</a>
          </div>
        </div>
        <br />



<?php /* ?>
        <br />
        <div class="row">
          <div class="col-6">
            <a href="kaban2.php" class="btn btn-success btn-block" role="button" aria-pressed="true">新規</a>
          </div>
          <div class="col-6">
          </div>
        </div>
        <br />
        <div class="row">
          <div class="col-xs-12 col-md-12">
            <table border="1">
              <tr align="center">
                <td width="40" bgcolor="FFDCA5"><input type="checkbox" name="rd0" id='all' onClick="AllChecked();"><br />通<br />常</td>
                <td width="85" bgcolor="FFDCA5">氏名</td>
                <td width="60" bgcolor="FFDCA5">勤務</td>
                <td width="60" bgcolor="FFDCA5">上番<br />時刻</td>
                <td width="60" bgcolor="FFDCA5">開始<br />終了</td>
                <td width="50" bgcolor="FFDCA5">早退<br />残有</td>
              </tr>

<?php for($i=0;$i<count($work_mem->oup_t_work_taiin_id);$i++) { ?>

              <tr align="center" <?php if ($work_mem->oup_t_work_plan_kbn[$i]=="3") { print("bgcolor=\"powderblue\""); } ?>>
                <td><input type="radio" name="kaban_kbn[<?php echo $i; ?>]" id="in_normal<?php echo $i; ?>" value="1" <?php echo $checked1; ?>></td>
                <td><?php echo $staff_name[$i]; ?></td>
                <td><?php echo $kinmu[$i]; ?></td>
                <td><?php echo $joban_time[$i]; ?></td>
                <td><?php echo $p_joban_time[$i]; ?><br /><?php echo $p_kaban_time[$i]; ?></td>
                <td bgcolor="FFDCA5"><a href="kaban2.php?id=<?php print($work_mem->oup_t_work_taiin_id[$i]); ?>">詳</a></td>
              </tr>

<?php } ?>

            </table>
          </div>
        </div>
        <br />

        <div class="row">
          <div class="col-6">
            <a href="kaban1.php" class="btn btn-success btn-block" role="button" aria-pressed="true">下番報告</a>
          </div>
          <div class="col-6">
            <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
          </div>
        </div>
        <br />
<?php */ ?>

      </form>

    </div>

      <div class="modal-footer">
          <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
      </div><!-- /footer -->

  </body>

</html>
