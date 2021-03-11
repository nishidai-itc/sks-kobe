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

      <form name="frm" method="POST" action="login.php">

        <div class="row">
          <div class="col-12">
            <table class="table table-bordered table-sm">
              <tr>
                <td width="70" bgcolor="FFDCA5" align="center"><font size="+1">氏名</font></td>
                <td width="170"><font size="+1"><?php echo $staff->oup_m_staff_name[0]; ?></font></td>
              </tr>
              <tr>
                <td bgcolor="FFDCA5" align="center"><font size="+1">日付</font></td>
                <td><font size="+1"><?php print(substr($work->oup_t_wk_plan_date[0],0,4)."年".substr($work->oup_t_wk_plan_date[0],5,2)."月".substr($work->oup_t_wk_plan_date[0],8,2)."日"); ?>(<?php print($week[$w]); ?>)</td>
              </tr>
              <tr>
                <td bgcolor="FFDCA5" align="center"><font size="+1">現場名</font></td>
                <td><font size="+1"><?php echo $genba->oup_m_genba_name[0] ?>（<?php print($shift->kbn2[$work->oup_t_wk_plan_kbn[0]]); ?>）</font></td>
              </tr>
            </table>
          </div>
        </div>
        <div class="card" style="padding: 10px;">
          <div class="card-body">
            交通費を入力してください
          </div>
        </div>
        <br />
        <div class="row">
          <div class="col-12">
                  <select id="selection" class="form-control">
                    <option>500
                    <option>650
                    <option>700
                    <option>1000
                  </select>
          </div>
          <div class="col-12">
                  <input type="text" name="kotuhi" list="klist" class="form-control" value="">
          </div>
        </div>
        <br />

        <div class="row">
          <div class="col-6">
            <a href="kaban12.php" class="btn btn-success btn-lg btn-block" role="button" aria-pressed="true">次へ</a>
          </div>
          <div class="col-6">
            <a href="kaban6.php" class="btn btn-secondary btn-lg btn-block" role="button" aria-pressed="true">戻る</a>
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
