<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift-jis">
    <title>かんたんﾍﾙﾊﾟｰさん</title>
  </head>

  <body>
    <h2>本人情報</h2>
    お名前<br /><?php print($common->html_display($staff->oup_m_staff_name[0])); ?> さん<br /><br />
    ﾒｰﾙｱﾄﾞﾚｽ<br /><?php print($common->html_display($staff->oup_m_staff_mail[0])); ?>
    <br />
    <br />
    <form name="frm" method="POST" action="menu.php">
      <input type="submit" value="ﾒﾆｭｰに戻る">
      <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
    </form>
    <br />
    <br />
  </body>
</html>
