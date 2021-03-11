<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">

    <!-- bootstrap-4.3.1 -->
    <link href="./bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="./bootstrap-4.3.1/jquery-3.4.1.min.js"></script>
    <script src="./bootstrap-4.3.1/js/bootstrap.bundle.min.js"></script>

    <title>勤怠管理システム</title>
  </head>

<script type="text/javascript">
<!--
function func() {
    document.frm.submit();
}
function func2(arg1) {
    document.frm.act.value='2';
    document.frm.work_day.value=arg1;
    document.frm.submit();
}
// -->
</script>

  <body>
    <div class="container">
      <div class="page-header">
        <h4>交通費登録</h4>
      </div>

      <form name="frm" method="POST" action="kotuhi2.php">

        <div class="card" style="padding: 10px;">
          <div class="card-body">
            <?php print($common->html_display($staff->oup_m_staff_name[0])); ?> さん<br /><?php print(date('m/d')) ?>(<?php print($week[$w]); ?>) <?php print(date('h:i')) ?>
          </div>
        </div>
        <br />
        <div class="row">
          <div class="col-12">
            <table class="table table-sm table-bordered">
              <tr class="text-center">
                <td bgcolor="FFDCA5">行き先</td>
                <td><input type="text" name="place" class="form-control form-control-sm" value="<?php print($kotuhi->oup_m_kotuhi_place[0]); ?>"></td>
              </tr>
              <tr class="text-center">
                <td bgcolor="FFDCA5">交通機関</td>
                <td><input type="text" name="kikan" class="form-control form-control-sm" value="<?php print($kotuhi->oup_m_kotuhi_kikan[0]); ?>"></td>
              </tr>
              <tr class="text-center">
                <td bgcolor="FFDCA5">出発</td>
                <td><input type="text" name="from" class="form-control form-control-sm" value="<?php print($kotuhi->oup_m_kotuhi_from[0]); ?>"></td>
              </tr>
              <tr class="text-center">
                <td bgcolor="FFDCA5">到着</td>
                <td><input type="text" name="to" class="form-control form-control-sm" value="<?php print($kotuhi->oup_m_kotuhi_to[0]); ?>"></td>
              </tr>
              <tr class="text-center">
                <td bgcolor="FFDCA5">金額</td>
                <td><input type="text" name="cost" class="form-control form-control-sm" value="<?php print($kotuhi->oup_m_kotuhi_cost[0]); ?>"></td>
              </tr>
            </table>
          </div>
        </div>
        <br />

        <div class="row">
          <div class="col-6">
            <button type="button" onclick="submit();" class="btn btn-success btn-block" role="button">登録</button>
          </div>
          <div class="col-6">
            <a href="kotuhi1.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
          </div>
        </div>
        <br />

        <input type="hidden" name="act" value="1">
        <input type="hidden" name="kotuhi_no" value="<?php print($kotuhi->oup_m_kotuhi_no[0]); ?>">

      </form>

    </div>

      <div class="modal-footer">
          <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
      </div><!-- /footer -->

  </body>
</html>
