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
        <h4>上番報告（個人用）</h4>
      </div>

        <?php if ($errmsg != "") { ?>
            <div class="row">
              <div class="col-xs-12 col-md-12"><pre><p class="text-danger"><?php print($errmsg); ?></p></pre></div>
            </div>
        <?php } ?>

      <form name="frm" method="POST" action="joban2.php" enctype="multipart/form-data">

        <div class="row">
          <div class="col-12">
            <table border="1">
              <tr>
                <td width="70" bgcolor="FFDCA5" align="center">氏名</td>
                <td width="170"><?php print($common->html_display($staff->oup_m_staff_name[0])); ?></td>
              </tr>
              <tr>
                <td bgcolor="FFDCA5" align="center">日付</td>
                <td><?php print(substr($work->oup_t_work_plan_date[0],0,4)."年".substr($work->oup_t_work_plan_date[0],5,2)."月".substr($work->oup_t_work_plan_date[0],8,2)."日"); ?>(<?php print($week[$w]); ?>)</td>
              </tr>
              <tr>
                <td bgcolor="FFDCA5" align="center">現場名</td>
                <td><?php print($genba->oup_m_genba_name[0]); ?></td>
              </tr>
              <tr>
                <td bgcolor="FFDCA5" align="center">勤務</td>
                <td><?php print($kinmu); ?></td>
              </tr>
            </table>
          </div>
        </div>
        <br />

        <div class="row">
          <div class="col-12">
            <table border="1">
              <tr align="center">
                <td colspan="3">
                  <label class="radio-inline"><input type="radio" name="joban_kbn" value="1" <?php if ($work->oup_t_work_joban_kbn[0]=="1") { print("checked"); } ?> > 通常</label>　
                  <label class="radio-inline"><input type="radio" name="joban_kbn" value="2" <?php if ($work->oup_t_work_joban_kbn[0]=="2") { print("checked"); } ?> > 早出</label>　
                  <label class="radio-inline"><input type="radio" name="joban_kbn" value="3" <?php if ($work->oup_t_work_joban_kbn[0]=="3") { print("checked"); } ?> > 遅刻</label>　
                  <label class="radio-inline"><input type="radio" name="joban_kbn" value="4" <?php if ($work->oup_t_work_joban_kbn[0]=="4") { print("checked"); } ?> > 休</label>
                </td>
              </tr>
              <tr align="center">
                <td width="70" rowspan="2" bgcolor="FFDCA5">所定</td>
                <td width="70" bgcolor="FFDCA5">開始</td>
                <td width="100"><?php print(substr($work->oup_t_work_plan_joban_time[0],0,5)); ?></td>
              </tr>
              <tr align="center">
                <td bgcolor="FFDCA5">終了</td>
                <td><?php print(substr($work->oup_t_work_plan_kaban_time[0],0,5)); ?></td>
              </tr>
              <tr align="center">
                <td bgcolor="d5d5d5">打刻</td>
                <td bgcolor="d5d5d5">上番</td>
                <td bgcolor="d5d5d5"><input type="time" step="60" name="joban_time" class="form-control" value="<?php print(substr($joban_time,0,5)); ?>"></td>
              </tr>
            </table>
          </div>
        </div>
        <br />

        <div class="row">
          <div class="col-6">
            <button type="submit" class="btn btn-success btn-block" role="button" aria-pressed="true">上番報告</button>
          </div>
          <div class="col-6">
            <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
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
