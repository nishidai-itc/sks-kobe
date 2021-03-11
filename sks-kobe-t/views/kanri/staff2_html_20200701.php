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
        <h4>隊員登録</h4>
      </div>

      <form name="frm" method="POST" action="staff2.php">
      <?php if ($staff2->errmsg != "") { ?>
            <div class="row">
              <div class="col-xs-12 col-md-12"><pre><p class="text-danger"><?php print($staff2->errmsg); ?></p></pre></div>
            </div>
        <?php } ?>

        <div class="row">
          <div class="col-xs-12 col-md-12">
            <table border="1">
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">隊員ID</td>
                <td width="85"><input type="text" name="staff_id" value="<?php print($staff->oup_m_staff_id[0]); ?>"></td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">隊員名</td>
                <td><input type="text" name="staff_name" value="<?php print($staff->oup_m_staff_name[0]); ?>"></td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">隊員名カナ</td>
                <td><input type="text" name="staff_kana" value="<?php print($staff->oup_m_staff_kana[0]); ?>"></td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">配置照会名</td>
                <td><input type="text" name="haiti_name" value="<?php print($staff->oup_m_staff_haiti_name[0]); ?>"></td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">ログインID</td>
                <td><input type="text" name="staff_login_id" value="<?php print($staff->oup_m_staff_login_id[0]); ?>"></td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">パスワード</td>
                <td><input type="text" name="staff_pass" value=""></td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">権限</td>
                <td align="left">
<?php for ($i=1;$i<=count($staff->auth);$i++) { ?>
                  <input type="radio" name="staff_auth" value="<?php print($i); ?>" <?php if ($staff->oup_m_staff_auth[0] == $i) { print("checked=\"checked\""); } ?> > <?php print($staff->auth[$i]); ?> <br />
<?php } ?>
                </td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">雇用形態</td>
                <td align="left">
<?php for ($i=1;$i<=count($staff->koyo);$i++) { ?>
                  <input type="radio" name="staff_koyo" value="<?php print($i); ?>" <?php if ($staff->oup_m_staff_kbn[0] == $i) { print("checked=\"checked\""); } ?> > <?php print($staff->koyo[$i]); ?> <br />
<?php } ?>
                </td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">現場</td>
                <td align="left">
                        <select id="genba_id" name="genba_id" class="form-control">
                          <option value=""></option>
<?php for ($i=0;$i<count($genba->oup_m_genba_id);$i++) { ?>
                          <option value="<?php print($genba->oup_m_genba_id[$i]); ?>" <?php if ($staff->oup_m_staff_genba_id[0]==$genba->oup_m_genba_id[$i]) { print("selected"); } ?> ><?php print($genba->oup_m_genba_name[$i]); ?></option>
<?php } ?>
                        </select>
                </td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">入社日</td>
                <td width="85">
                    <input type="date" maxlength="8" name="nyusya" value="<?php if ($staff->oup_m_staff_nyusya[0] != "0000-00-00") {
                        if ($uae == 2) { print($staff->oup_m_staff_nyusya[0]); } 
                        else { print(str_replace(array('-', 'ー', '−', '―', '‐'), '', $staff->oup_m_staff_nyusya[0])); } 
                    } ?>">
                </td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">退社日</td>
                <td width="85">
                    <input type="date" maxlength="8" name="taisya" value="<?php if ($staff->oup_m_staff_taisya[0] != "0000-00-00") {
                        if ($uae == 2) { print($staff->oup_m_staff_nyusya[0]); } 
                        else { print(str_replace(array('-', 'ー', '−', '―', '‐'), '', $staff->oup_m_staff_taisya[0])); } 
                    } ?>">
                </td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">協力会社</td>
                <td width="85"><input type="text" name="company" value="<?php print($staff->oup_m_staff_company[0]); ?>"></td>
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
            <a href="staff1.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
          </div>
        </div>
        <br />

        <input type="hidden" name="act" value="1">
        <input type="hidden" name="staff_id2" value="<?php print($staff->oup_m_staff_id[0]); ?>">

      </form>

    </div>

      <div class="modal-footer">
          <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
      </div><!-- /footer -->

  </body>
</html>
