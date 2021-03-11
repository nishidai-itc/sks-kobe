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

  <body>
    <div class="container">
      <div class="page-header">
        <h4>手当て登録</h4>
      </div>

      <form name="frm" method="POST" action="teate.php">

        <div class="card" style="padding: 10px;">
          <div class="card-body">
            <?php print($common->html_display($staff->oup_m_staff_name[0])); ?> さん<br /><?php print(date('m/d')) ?>(<?php print($week[$w]); ?>) <?php print(date('H:m')) ?>
          </div>
        </div>
        <br />

        <?php if ($genba2->errmsg != "") { ?>
            <div class="row">
              <div class="col-xs-12 col-md-12"><pre><p class="text-danger"><?php print($genba2->errmsg); ?></p></pre></div>
            </div>
        <?php } ?>

        <div class="row">
          <div class="col-xs-12 col-md-12">
            <table border="1">
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">手当て名1</td>
                <td width="85"><input type="text" name="teate_name1" value="<?php print($teate->oup_m_teate_name[0]); ?>"></td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">手当て名2</td>
                <td><input type="text" name="teate_name2" value="<?php print($teate->oup_m_teate_name[1]); ?>"></td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">手当て名3</td>
                <td><input type="text" name="teate_name3" value="<?php print($teate->oup_m_teate_name[2]); ?>"></td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">手当て名4</td>
                <td><input type="text" name="teate_name4" value="<?php print($teate->oup_m_teate_name[3]); ?>"></td>
              </tr>
              <tr align="center">
                <td width="85" bgcolor="FFDCA5">手当て名5</td>
                <td><input type="text" name="teate_name5" value="<?php print($teate->oup_m_teate_name[4]); ?>"></td>
              </tr>
            </table>
          </div>
        </div>
        <br />

        <div class="row">
          <div class="col-6">
            <button type="submit" class="btn btn-success btn-block" role="button">登録</button>
          </div>
          <div class="col-6">
            <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
          </div>
        </div>
        <br />

        <input type="hidden" name="act" value="1">

      </form>

    </div>

      <div class="modal-footer">
          <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
      </div><!-- /footer -->

  </body>
</html>
