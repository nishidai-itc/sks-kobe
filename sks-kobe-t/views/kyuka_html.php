<!DOCTYPE html>
  <html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" media="screen, projection" />
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>　
    <title>休暇申請</title>
  </head>

  <body>
    <div class="container">
      <div class="page-header">
        <div align="center">
          <h4>休　暇　願</h4>
        </div>
      <div align="right">
    </div>
    <br/>

    <div align="right">
      <label>申請日　<?php print(date("Y年m月d日")); ?></label><br />
      <label>(申請者)　　<?php echo $staff->oup_m_staff_name[0]; ?>　</label>
      <label>従業員No　　<?php echo $_SESSION["staff_id"]; ?>　</label>
      <label>氏　名　　　<?php echo $staff->oup_m_staff_name[0]; ?></label>
    </div>

    <form name="frm" action="#">
      <div align="center">
        <div class="row">
          <div class="col-12">
            <table border="1">
              <tr align="center">
                <td bgcolor="FFDCA5" width="80">期間</td>
                <td>
                  <input type="date" name="start" value="<?php print(date("Y-m-d")); ?>"></input>
                  <br />
                  <label>～</label>
                  <br />
                  <input type="date" name="end" value="<?php print(date("Y-m-d")); ?>"></input>
                </td>
              </tr>
              <tr align="center">
                <td bgcolor="FFDCA5">勤務<br />種別</td>
                <td>
                  <input type="radio" name="syubetu" value="1">泊
                  <label>　　</label>
                  <input type="radio" name="syubetu" value="2">夜
                  <label>　　</label>
                  <input type="radio" name="syubetu" value="3">日
                </td>
              <tr/>
              <tr align="center">
                <td bgcolor="FFDCA5">休暇<br/>区分</td>
                <td>
                  <div align="left">
                  <input type="radio" name="kubun" value="1">年休・使用回数(
                  <label><input type="text" name="yukyu" size="3">日)</label>
                  <br/>
                  <label>残日数(</label>
                  <label><input type="text" name="yukyu" size="3">日)</label><br />
                  <input type="radio" name="kubun" value="2">　欠勤
                </td>
              <tr/>
              <tr align="center">
                <td bgcolor="B4E5D5">事由</td>
                <td>
                  <label>慶弔(</label>
                  <label><input type="text" name="keicyo" size="12">)　</label><br/>
                  <label>病気(</label>
                  <label><input type="text" name="byouki" size="12">)　</label><br/>
                  <label>その他(</label>
                  <label><input type="text" name="sonota" size="12">)　</label><br/>
                </td>
              <tr/>
            </table>
            <br/>
          </div>
        </div>

      <div class="row">
        <div class="col-6">
          <a href="menu.php" class="btn btn-success btn-block" role="button" aria-pressed="true">申請</a>
        </div>
        <div class="col-6">
          <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
          </div>
        </div>
      </div>
    </form>

  </body>
</html>
