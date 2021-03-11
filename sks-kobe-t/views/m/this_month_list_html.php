<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift-jis">
    <title>かんたんﾍﾙﾊﾟｰさん</title>
  </head>

  <body>
        <h2>今月の予定</h2>

          確認したい日を選択してください
<br />

<?php for($i=0;$i<count($work->oup_t_work_day_cnt);$i++) { ?>
      <form name="frm" method="POST" action="this_month_list.php">
        <input type="submit" value="<?php print($common->html_display($work->oup_t_work_day1[$i])); ?>(<?php print($work->oup_t_work_day_cnt[$i]); ?>件:<?php print($work->oup_t_work_daytime[$i]); ?>分)">
        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="2">
        <INPUT type="hidden" name="work_day" value="<?php print($work->oup_t_work_day2[$i]); ?>">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
      </form>
<?php } ?>
      <br />

      <form name="frm1" method="POST" action="menu.php">
        <input type="submit" value="戻る">
        <?php /* アクションフラグ */ ?>
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
      </form>
    <br />
    <br />

  </body>
</html>
