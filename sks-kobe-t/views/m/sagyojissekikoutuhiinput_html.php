<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift-jis">
    <title>かんたんﾍﾙﾊﾟｰさん</title>
  </head>

  <body>
        <h2>作業実績交通費入力</h2>
            <?php print($common->html_display($staff->oup_m_staff_name[0])); ?>　さん<br /><br />
            <?php print(date('Y/m/d')) ?> (<?php print($week[$w]); ?>) <?php print($run_end_time); ?><br /><br />
            訪問作業終了<br /><br />作業時刻　<?php print(substr($work->oup_t_work_run_start_time[0],0,2)); ?>:<?php print(substr($work->oup_t_work_run_start_time[0],2,2)); ?> － <?php print($run_end_time); ?><br />作業時間　<?php print(intval(substr($run_end_time,0,2)) * 60 + intval(substr($run_end_time,3,2)) - intval(substr($work->oup_t_work_run_start_time[0],0,2)) * 60 - intval(substr($work->oup_t_work_run_start_time[0],2,2))); ?> 分<br /><br />
<?php if (count($work2->oup_t_work_plan_service_no) == 0) { ?>
<?php for($i=0;$i<count($worktype->oup_m_work_type_kbn);$i++) { ?><?php print($common->html_display($worktype->oup_m_work_type_content[$i])); ?>　<?php print($T[$i]); ?>分<br /><?php } ?>
<?php } else { ?>
<?php for($i=0;$i<count($work2->oup_t_work_plan_service_no);$i++) { ?><?php print($work2->oup_t_work_plan_content[$i]); ?>　<?php print($T[$i]); ?> 分<br /><?php } ?><?php } ?>
<br />
<br />
      <form name="frm" method="POST" action="sagyojissekikoutuhiinput.php">

        <?php if ($sagyojissekikoutuhi->errmsg != "") { ?>
            <p><font color="red"><?php print(htmlspecialchars_decode($common->html_display($sagyojissekikoutuhi->errmsg))); ?></font></p>
        <?php } ?>

        <table>
          <tr>
            <td>交通費</td>
            <td><input type="text" name="move_cost_yen" value="<?php print($move_cost_yen); ?>" placeholder="" size="6" istyle="4" format="N" mode="numeric"></td>
            <td>円</td>
          </tr>
          <tr>
            <td>移動距離</td>
            <td><input type="text" name="move_cost_kilo" value="<?php print($move_cost_kilo); ?>" placeholder="" size="6" istyle="4" format="N" mode="numeric"></td>
            <td>km</td>
          </tr>
          <tr>
            <td>その他</td>
            <td><input type="text" name="move_cost_etc" value="<?php print($move_cost_etc); ?>" placeholder="" size="6"></td>
            <td>&nbsp;</td>
          </tr>
        </table>

        作業で気づいたことがあればｺﾒﾝﾄしてください<br />このｺﾒﾝﾄは管理者にﾒｰﾙで送られます<br />
        <br />
        <label><input type="checkbox" name="alert_kbn" value="1"> 重要</label>
        <br />
        <br />

        作業実績ｺﾒﾝﾄ
        <br />
        <textarea name="t_work_comment" rows="3" istyle="1" format="M" mode="hiragana"></textarea>
        <br />
        <br />

        <input type="submit" value="登録します">
        <br />
        <br />
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
        <br />
    	<br />

        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">

      </form>
      <form name="frm2" method="POST" action="sagyojissekisyuruiinput.php">
        <input type="submit" value="戻る">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
      </form>
  </body>
</html>
