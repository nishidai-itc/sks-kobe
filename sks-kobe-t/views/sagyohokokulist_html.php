<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" media="screen, projection" />
    <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>　
    <title>かんたんヘルパーさん</title>
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
        <h4>作業報告一覧</h4>
      </div>

      <div class="row">
        <div class="col-xs-12 col-md-12">
          <pre><p class="text-info"><font size="+1">作業報告日を選択してください</font></p></pre></div>
      </div>

      <form name="frm" method="POST" action="../controllers/sagyohokokulist.php">

      <div class="row">
        <div class="col-xs-12 col-md-12">
          <select name="sagyomonth" class="form-control" style="font-size:12pt" onChange="func();">
            <option value=""></option>
<?php for($i=0;$i<count($work->oup_t_work_month_cnt);$i++) { ?>
<option value="<?php print($work->oup_t_work_month2[$i]); ?>"><?php print($work->oup_t_work_month1[$i]); ?> ( <?php print($work->oup_t_work_month_cnt[$i]); ?>件<?php if ($company->oup_m_company_simple_kbn[0] != "1") { ?> : <?php print($work->oup_t_work_monthtime[$i]); ?>分 <?php } ?>)</option>
<?php } ?>
          </select>
        </div>
      </div>
  		<br />

      <div class="row">
        <div class="col-xs-12 col-md-12">
<?php for($i=0;$i<count($work->oup_t_work_day_cnt);$i++) { ?>
          <button class="btn btn-success btn-lg btn-block" onclick="func2('<?php print($work->oup_t_work_day2[$i]); ?>')"><?php print($work->oup_t_work_day1[$i]); ?> ( <?php print($work->oup_t_work_day_cnt[$i]); ?>件<?php if ($company->oup_m_company_simple_kbn[0] != "1") { ?> : <?php print($work->oup_t_work_daytime[$i]); ?> 分 <?php } ?>)</button>
<?php } ?>
        </div>
      </div>
      <br />

      <div class="row">
        <div class="col-xs-12 col-md-12"><button type="button" class="btn btn-default btn-lg btn-block" onclick="location.href='menu.php'">戻る</button></div>
      </div>
  		<br />

        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">
        <INPUT type="hidden" name="work_day" value="">

      </form>
    </div>
  </body>
</html>
