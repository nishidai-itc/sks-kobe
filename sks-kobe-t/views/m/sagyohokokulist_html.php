<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift-jis">
    <title>かんたんﾍﾙﾊﾟｰさん</title>
  </head>

  <body>
        <h2>作業報告一覧</h2>

          作業報告日を選択してください
<br />

      <form name="frm" method="POST" action="sagyohokokulist.php">
          <select name="sagyomonth">
            <option value=""></option>
<?php for($i=0;$i<count($work->oup_t_work_month_cnt);$i++) { ?>
<option value="<?php print($common->html_display($work->oup_t_work_month2[$i])); ?>"><?php print($common->html_display($work->oup_t_work_month1[$i])); ?> (<?php print($common->html_display($work->oup_t_work_month_cnt[$i])); ?>件<?php if ($company->oup_m_company_simple_kbn[0] != "1") { ?>:<?php print($common->html_display($work->oup_t_work_monthtime[$i])); ?>分<?php } ?>)</option>
<?php } ?>
          </select>
<br />
        <input type="submit" value="検索">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
        <br />
        <br />

      </form>

<?php for($i=0;$i<count($work->oup_t_work_day_cnt);$i++) { ?>
      <form name="frm" method="POST" action="sagyohokokulist.php">
          <input type="submit" value="<?php print($common->html_display($work->oup_t_work_day1[$i])); ?>(<?php print($work->oup_t_work_day_cnt[$i]); ?>件<?php if ($company->oup_m_company_simple_kbn[0] != "1") { ?>:<?php print($work->oup_t_work_daytime[$i]); ?>分<?php } ?>)">
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
