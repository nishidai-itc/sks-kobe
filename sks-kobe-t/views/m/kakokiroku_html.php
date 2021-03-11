<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="Shift_JIS">
    <title>かんたんヘルパーさん</title>
  </head>
  <body>
    <div class="container">
      <pre><p class="text-info"><font size="+1"><?php print($common->html_display($user->oup_m_user_name[0])); ?> 様 の過去の記録を選択してください</font></p></pre>

<?php for($i=0;$i<count($work2->oup_t_work_no);$i++) { ?>
<?php 
    $time = strtotime(date($work2->oup_t_work_plan_start_date[$i]));
    $w = date("w", $time);
    $weekday = $week[$w];
?>
          <button class="btn btn-success btn-lg btn-block" onclick="location.href='servicekiroku.php?work_no=<?php print($work2->oup_t_work_no[$i]); ?>'"><?php print(substr($work2->oup_t_work_plan_start_date[$i],5,5)); ?> (<?php print($weekday); ?>) <?php print(substr($work2->oup_t_work_plan_start_time[$i],0,2).":".substr($work2->oup_t_work_plan_start_time[$i],2,2)); ?>-<?php print(substr($work2->oup_t_work_plan_end_time[$i],0,2).":".substr($work2->oup_t_work_plan_end_time[$i],2,2)); ?> <?php print($work2->oup_t_work_service_content[$i]); ?></button>
<?php } ?>

      <br />

      <button class="btn btn-default btn-block" onclick="location.href='../controllers/servicekiroku.php'">戻る</button>
      <br />

    </div>
  </body>
</html>
