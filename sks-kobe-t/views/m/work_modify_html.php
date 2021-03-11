<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="shift-jis">
    <title>かんたんﾍﾙﾊﾟｰさん</title>
  </head>

  <body>
        <h2>作業報告修正</h2>

      <form name="frm" method="POST" action="work_modify.php">

        <?php if ($workregist->errmsg != "") { ?>
            <p>
              <font color="red"><?php print(htmlspecialchars_decode($common->html_display($workregist->errmsg))); ?></font>
            </p>
        <?php } ?>

          <label>利用者</label>
          <select name="user_id">
            <option value=""></option>
<?php for($i=0;$i<count($user->oup_m_user_id);$i++) { ?>
            <option value="<?php print($user->oup_m_user_id[$i]); ?>" <?php if($user->oup_m_user_id[$i] == $user_id) { print("selected"); } ?>><?php print($common->html_display($user->oup_m_user_name[$i])); ?> さん(<?php print((int) ((date('Ymd')-(substr($user->oup_m_user_birth_date[$i],0,4).substr($user->oup_m_user_birth_date[$i],5,2).substr($user->oup_m_user_birth_date[$i],8,2)))/10000)); ?>)</option>
<?php } ?>
          </select>
<br />

          <label>作業日</label>
          <input type="text" name="run_start_date_yy" value="<?php print(substr($run_start_date,0,4)); ?>">
          <label>年</label>
            <select name="run_start_date_mm">
              <option value=""></option>
<?php for ($i=1;$i<=12;$i++) { ?>
              <option value="<?php print($i); ?>" <?php if($i == intval(substr($run_start_date,5,2))) { print("selected"); } ?>><?php print($i); ?></option>
<?php } ?>
            </select>
          
            <label>月</label>
            <select name="run_start_date_dd">
              <option value=""></option>
<?php for ($i=1;$i<=31;$i++) { ?>
              <option value="<?php print($i); ?>" <?php if($i == intval(substr($run_start_date,8,2))) { print("selected"); } ?>><?php print($i); ?></option>
<?php } ?>
            </select>
            <label >日</label>
      <br />

            <label>作業時間</label>
<br />
            <select name="run_start_time_hh">
              <option value=""></option>
<?php for ($i=0;$i<=23;$i++) { ?>
                <option value="<?php print($i); ?>" <?php if($i == substr($run_start_time,0,2)) { print("selected"); } ?>><?php print($i); ?></option>
<?php } ?>
            </select>
            <label>時</label>

            <select name="run_start_time_mm">
              <option value=""></option>
<?php for ($i=0;$i<=59;$i++) { ?>
                <option value="<?php print($i); ?>" <?php if($i == substr($run_start_time,2,2)) { print("selected"); } ?>><?php print($i); ?></option>
<?php } ?>
            </select>
            <label>分</label>

      から
<br />
            <select name="run_end_time_hh">
              <option value=""></option>
<?php for ($i=0;$i<=23;$i++) { ?>
                <option value="<?php print($i); ?>" <?php if($i == substr($run_end_time,0,2)) { print("selected"); } ?>><?php print($i); ?></option>
<?php } ?>
            </select>

            <label>時</label>
            <select name="run_end_time_mm">
              <option value=""></option>
<?php for ($i=0;$i<=59;$i++) { ?>
                <option value="<?php print($i); ?>" <?php if($i == substr($run_end_time,2,2)) { print("selected"); } ?>><?php print($i); ?></option>
<?php } ?>
            </select>
            <label>分</label>
<br />
      <br />

        <table>
<?php for($i=0;$i<count($worktype->oup_m_work_type_kbn);$i++) { ?>
          <tr>
            <td width="120"><font size="+1"><?php print($common->html_display($worktype->oup_m_work_type_content[$i])); ?></font></td>
            <td width="120">
              <select class="form-control" name="T<?php print($i); ?>" onClick="func();" style="font-size:12pt">
                <option value=""></option>
                <option value="0" <?php if($work->oup_t_work_service_time[$_SESSION["work_no"].$worktype->oup_m_work_type_cd[$i].$worktype->oup_m_work_type_item_cd[$i]] == 0) { print("selected"); } ?>>0</option>
                <option value="30" <?php if($work->oup_t_work_service_time[$_SESSION["work_no"].$worktype->oup_m_work_type_cd[$i].$worktype->oup_m_work_type_item_cd[$i]] == 30) { print("selected"); } ?>>30</option>
                <option value="40" <?php if($work->oup_t_work_service_time[$_SESSION["work_no"].$worktype->oup_m_work_type_cd[$i].$worktype->oup_m_work_type_item_cd[$i]] == 40) { print("selected"); } ?>>40</option>
                <option value="45" <?php if($work->oup_t_work_service_time[$_SESSION["work_no"].$worktype->oup_m_work_type_cd[$i].$worktype->oup_m_work_type_item_cd[$i]] == 45) { print("selected"); } ?>>45</option>
                <option value="50" <?php if($work->oup_t_work_service_time[$_SESSION["work_no"].$worktype->oup_m_work_type_cd[$i].$worktype->oup_m_work_type_item_cd[$i]] == 50) { print("selected"); } ?>>50</option>
                <option value="60" <?php if($work->oup_t_work_service_time[$_SESSION["work_no"].$worktype->oup_m_work_type_cd[$i].$worktype->oup_m_work_type_item_cd[$i]] == 60) { print("selected"); } ?>>60</option>
                <option value="90" <?php if($work->oup_t_work_service_time[$_SESSION["work_no"].$worktype->oup_m_work_type_cd[$i].$worktype->oup_m_work_type_item_cd[$i]] == 90) { print("selected"); } ?>>90</option>
                <option value="120" <?php if($work->oup_t_work_service_time[$_SESSION["work_no"].$worktype->oup_m_work_type_cd[$i].$worktype->oup_m_work_type_item_cd[$i]] == 120) { print("selected"); } ?>>120</option>
                <option value="150" <?php if($work->oup_t_work_service_time[$_SESSION["work_no"].$worktype->oup_m_work_type_cd[$i].$worktype->oup_m_work_type_item_cd[$i]] == 150) { print("selected"); } ?>>150</option>
                <option value="180" <?php if($work->oup_t_work_service_time[$_SESSION["work_no"].$worktype->oup_m_work_type_cd[$i].$worktype->oup_m_work_type_item_cd[$i]] == 180) { print("selected"); } ?>>180</option>
                <option value="210" <?php if($work->oup_t_work_service_time[$_SESSION["work_no"].$worktype->oup_m_work_type_cd[$i].$worktype->oup_m_work_type_item_cd[$i]] == 210) { print("selected"); } ?>>210</option>
                <option value="240" <?php if($work->oup_t_work_service_time[$_SESSION["work_no"].$worktype->oup_m_work_type_cd[$i].$worktype->oup_m_work_type_item_cd[$i]] == 240) { print("selected"); } ?>>240</option>
              </select>
            </td>
            <td><font size="+1">分</font></td>
          </tr>
<?php } ?>
        </table>
      <br />

        <table>
          <tr>
            <td>交通費</td>
            <td><input type="text" name="move_cost_yen" placeholder="" value="<?php print($move_cost_yen); ?>"></td>
            <td>円</td>
          </tr>
          <tr>
            <td>移動距離</td>
            <td><input type="text" name="move_cost_kilo" placeholder="" value="<?php print($move_cost_kilo); ?>"></td>
            <td>km</td>
          </tr>
          <tr>
            <td>その他</td>
            <td><input type="text" name="move_cost_etc" placeholder="" value="<?php print($move_cost_etc); ?>"></td>
            <td>&nbsp;</td>
          </tr>
        </table>
      <br />

        作業で気づいたことがあればｺﾒﾝﾄを入力してください<br />このｺﾒﾝﾄは管理者にﾒｰﾙで送られます
        <br />
        <br />

        <input type="checkbox"> 重要
        <br />
        <br />

        作業実績ｺﾒﾝﾄ
        <br />
        <textarea rows="3"><?php print($common->html_display($comment)); ?></textarea>
        <br />
        <br />

        <input type="submit" value="確認へ">
        <br />
        <br />

        <input type="button" onclick="location.href='sagyohokokudetail.php?<?php print(SID); ?>'" value="戻る">
        <br />
        <br />

        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">
        <INPUT type="hidden" name="syurui_cnt" value="<?php print(count($worktype->oup_m_work_type_kbn)); ?>">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
      </form>

      <form name="frm1" method="POST" action="sagyohokokudetail.php">
        <input type="submit" value="戻る">
        <br />
        <br />

        <?php /* アクションフラグ */ ?>
        <INPUT type="hidden" name="act" value="1">
        <INPUT type="hidden" name="syurui_cnt" value="<?php print(count($worktype->oup_m_work_type_kbn)); ?>">
        <input type="hidden" name="PHPSESSID" value="<?php print(session_id()); ?>" />
      </form>
  </body>

</html>
