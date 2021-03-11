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
        <h4>遅刻・早退届</h4>
      </div>

        <?php if ($errmsg != "") { ?>
            <div class="row">
              <div class="col-12"><pre><p class="text-danger"><?php print($errmsg); ?></p></pre></div>
            </div>
        <?php } ?>

      <form name="frm" method="POST" action="../controllers/sagyojissekikomento.php">

        <div class="row">
          <div class="col-12">
            <table border="1">
              <tr>
                <td width="130" bgcolor="FFDCA5" align="center">報告者</td>
                <td width="300"><?php print($common->html_display($staff->oup_m_staff_name[0])); ?></td>
              </tr>
              <tr>
                <td bgcolor="FFDCA5" align="center">日付</td>
                <td><?php print(substr($work->oup_t_work_plan_date[0],0,4)."年".substr($work->oup_t_work_plan_date[0],5,2)."月".substr($work->oup_t_work_plan_date[0],8,2)."日"); ?>(<?php print($week[$w]); ?>)</td>
              </tr>
            </table>
          </div>
        </div>
        <br />

        <div class="row">
          <div class="col-12">
            <table border="1">
              <tr align="center">
                <td bgcolor="FFDCA5">届出内容</td>
                <td>
                  <label class="radio-inline"><input type="radio" name="joban_kbn" value="1" <?php if ($work->oup_t_work_joban_kbn[0]=="1") { print("checked"); } ?> > 遅刻</label>　
                  <label class="radio-inline"><input type="radio" name="joban_kbn" value="2" <?php if ($work->oup_t_work_joban_kbn[0]=="2") { print("checked"); } ?> > 早退</label>　
                </td>
              </tr>
              <tr align="center">
                <td bgcolor="FFDCA5">日付</td>
                <td>
                  <input type="date" name="start" value="<?php print(date("Y-m-d")); ?>"></input>
                </td>
              </tr>
              <tr align="center">
                <td bgcolor="FFDCA5">開始時間</td>
                <td>
                  <input type="time" name="start" value="<?php print(date("Y-m-d")); ?>"></input>
                </td>
              </tr>
              <tr align="center">
                <td bgcolor="FFDCA5">終了時間</td>
                <td>
                  <input type="time" name="start" value="<?php print(date("Y-m-d")); ?>"></input>
                </td>
              </tr>
              <tr align="center">
                <td bgcolor="FFDCA5">事由</td>
                <td>
                  <input type="text" name="start" value=""></input>
                </td>
              </tr>
            </table>
          </div>
        </div>
        <br />

        <div class="row">
          <div class="col-6">
            <button type="submit" class="btn btn-success btn-block" role="button" aria-pressed="true">申請</button>
          </div>
          <div class="col-6">
            <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
          </div>
        </div>
        <br />

        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">

      </form>

    </div>
  </body>
</html>
