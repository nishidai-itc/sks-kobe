<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" media="screen, projection" />
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>　
    <title>勤怠管理システム</title>
  </head>

  <body>
    <div class="container">
      <div class="page-header">
        <h4>隊員追加</h4>
      </div>

      <form name="frm" method="POST" action="kinmutuika.php">

        <div class="row">
          <div class="col-xs-12 col-md-12">
            <table border="1">
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">現場</td>
                <td><?php print($genba->oup_m_genba_name[0]); ?></td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">年月</td>
                <td><?php print($nengetu); ?></td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">隊員</td>
                <td>
                  <select id="selection" class="form-control" name="staff_id">
                    <option></option>
<?php for ($i=0;$i<count($staff->oup_m_staff_id);$i++) { ?>
                    <option value="<?php print($staff->oup_m_staff_id[$i]); ?>"><?php print($staff->oup_m_staff_name[$i]); ?></option>
<?php } ?>
                  </select>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <br />

        <input type="hidden" name="genba_id" value="<?php print($genba_id); ?>">
        <input type="hidden" name="nengetu" value="<?php print($nengetu); ?>">

        <div class="row">
          <div class="col-6">
            <button type="submit" class="btn btn-success btn-block" role="button" name="regist">登録</button>
          </div>
          <div class="col-6">
            <a href="kinmuyotei.php?genba_id=<?php print($genba_id); ?>&nengetu=<?php print($nengetu); ?>&search=" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
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
