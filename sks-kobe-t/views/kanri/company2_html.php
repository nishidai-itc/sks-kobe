<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" media="screen, projection" />
    <script src="./../bootstrap-4.3.1/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>　
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
 -->
</script>

  <body>
    <div class="container">
      <div class="page-header">
        <h4>協力会社登録</h4>
      </div>

      <form name="frm" method="POST" action="company2.php">

        <div class="card" style="padding: 10px;">
          <div class="card-body">
            <?php print($common->html_display($staff->oup_m_staff_name[0])); ?> さん<br /><?php print(date('m/d')) ?>(<?php print($week[$w]); ?>) <?php print(date('H:i')) ?>
          </div>
        </div>
        <br />

        <?php if ($company2->errmsg != "") { ?>
            <div class="row">
              <div class="col-xs-12 col-md-12"><pre><p class="text-danger"><?php print($company2->errmsg); ?></p></pre></div>
            </div>
        <?php } ?>

        <div class="row">
          <div class="col-xs-12 col-md-12">
            <table border="1">
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">協力会社ID</td>
                <td width="85"><input type="text" name="company_id" value="<?php print($company->oup_m_company_id[0]); ?>" maxlength="4" <?php if ($company->oup_m_company_id[0] != "") {print("readonly");} ?>></td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">協力会社名</td>
                <td><input type="text" name="company_name" value="<?php print($company->oup_m_company_name[0]); ?>"></td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">協力会社名カナ</td>
                <td><input type="text" name="company_kana" value="<?php print($company->oup_m_company_kana[0]); ?>"></td>
              </tr>
              <!--<tr align="center">
                <td width="85" bgcolor="FFDCA5">表示順序</td>
                <td><input type="text" name="hyoji_kbn" value="<?php print($company->oup_m_company_hyoji_kbn[0]); ?>" maxlength="4"></td>
              </tr>-->
              <tr align="center">
                <td width="120" bgcolor="FFDCA5">使用終了日</td>
                <td><input type="date" name="deleteday" value="<?php print($company->oup_m_company_deleteday[0]); ?>" maxlength="8"></td>
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
            <a href="company1.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
          </div>
        </div>
        <br />

        <input type="hidden" name="act" value="1">
        <!--<input type="hidden" name="flg" value="<?php print($flg); ?>">-->
        <input type="hidden" name="company_id2" value="<?php print($company->oup_m_company_id[0]); ?>">

      </form>

    </div>

      <div class="modal-footer">
          <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
      </div><!-- /footer -->

  </body>
</html>
