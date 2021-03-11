<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift-jis">
    <title>かんたんﾍﾙﾊﾟｰさん</title>
  </head>

  <body>
        <h2>ﾊﾟｽﾜｰﾄﾞ変更完了</h2>

        ﾊﾟｽﾜｰﾄﾞを変更しました
        <br />
        <br />

    <form name="frm1" method="POST" action="menu.php">
        <input type="submit" value="ﾒﾆｭｰに戻る">
        <?php /* アクションフラグ */ ?>
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
    </form>
<br />
<br />

  </body>
</html>
