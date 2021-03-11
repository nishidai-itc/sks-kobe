<?php
    session_start();

    // ログインチェック
    if (!isset($_SESSION["staff_id"])){
        // HTML表示
        header('Location:login.php');
    }
?>
<?php
    require_once('../../models/common/common.php');          // 共通クラス
    require_once('../../models/common/db.php');              // DBクラス
    require_once('../../models/Staff.php');                  // 社員クラス
    require_once('../../models/Tuti.php');                  // 通知クラス

    
    if (isset($_REQUEST['tuti_no'])) {
        $tuti_no = $_REQUEST['tuti_no'];
    }
    if (isset($_REQUEST['tuti_sday'])) {
        $tuti_sday = $_REQUEST['tuti_sday'];
    }
    if (isset($_REQUEST['tuti_eday'])) {
        $tuti_eday = $_REQUEST['tuti_eday'];
    }
    if (isset($_REQUEST['tuti_msg'])) {
        $tuti_msg = $_REQUEST['tuti_msg'];
    }
    
    $today = date('Ymd');
    $sp = "";
    $tuti_sday   = str_replace("-",$sp,$_REQUEST["tuti_sday"]);
    $tuti_eday     = str_replace("-",$sp,$_REQUEST["tuti_eday"]);
    
    //$auth_array = array("1"=>"本部","2"=>"リーダー","3"=>"上下番チェック","4"=>"隊員");
    /*********************************************************
     *	クラスの作成
     ********************************************************/
    $common     = new Common;       // 共通クラス
    $staff      = new Staff;        // 社員マスタクラス
    $tuti      = new Tuti;        // 通知マスタクラス
    $tuti2      = new Tuti;        // 通知マスタクラス
    
    if (isset($_REQUEST["modify"])) {
    //var_dump($_REQUEST,$_REQUEST["tuti_no"],$tuti_sday);
    //exit;
    if ($_POST["tuti_no"]) {
    for ($i=0; $i<count($_POST["tuti_no"]); $i++) {
        $tuti2->inp_m_tuti_no = $tuti_no[$i];
        $tuti2->getTuti();
        
        if (!$tuti2->oup_m_tuti_no) {
        // if (count($tuti2->oup_m_tuti_no) == 0) {
            $tuti2->inp_m_tuti_startday = $tuti_sday[$i];
            $tuti2->inp_m_tuti_endday = $tuti_eday[$i];
            $tuti2->inp_m_tuti_msg = $tuti_msg[$i];
            $tuti2->insertTuti();
        } else {
            $tuti2->inp_m_tuti_no = $tuti_no[$i];
            $tuti2->inp_m_tuti_startday = $tuti_sday[$i];
            $tuti2->inp_m_tuti_endday = $tuti_eday[$i];
            $tuti2->inp_m_tuti_msg = $tuti_msg[$i];
            $tuti2->updateTuti();
        }
    }
    }
    }
//    if (isset($_REQUEST["auth"])) {
//        for ($i=0;$i<count($_REQUEST['auth']);$i++) {
//            $auth[$i] = $_REQUEST['auth'][$i];
//            //$_SESSION["gid"][$i] = $_REQUEST['genba_id'][$i];
//        }
//    }

    // 作業実施の曜日　取得
    $time = strtotime(date('Y-m-d'));
    $w = date("w", $time);
    
    $tuti->getTuti();
    
    if ($tuti->oup_m_tuti_no) {
    for ($i=0;$i<count($tuti->oup_m_tuti_no);$i++) {
        if (($tuti->oup_m_tuti_startday[$i] != "" && $tuti->oup_m_tuti_startday[$i] != "0000-00-00") && ($tuti->oup_m_tuti_endday[$i] != "" && $tuti->oup_m_tuti_endday[$i] != "0000-00-00") && $tuti->oup_m_tuti_msg[$i] != "") {
            if ($today >= substr($tuti->oup_m_tuti_startday[$i],0,4).substr($tuti->oup_m_tuti_startday[$i],5,2).substr($tuti->oup_m_tuti_startday[$i],8,2) && 
            $today <= substr($tuti->oup_m_tuti_endday[$i],0,4).substr($tuti->oup_m_tuti_endday[$i],5,2).substr($tuti->oup_m_tuti_endday[$i],8,2)) {
                $hyoji[$tuti->oup_m_tuti_no[$i]] = "表示中";
            } else {
                $hyoji[$tuti->oup_m_tuti_no[$i]] = "非表示";
            }
        }
        if ($common->uae == 1) {
            $tuti->oup_m_tuti_startday[$i] = str_replace(array('-', 'ー', '−', '―', '‐'), '', $tuti->oup_m_tuti_startday[$i]);
            $tuti->oup_m_tuti_endday[$i] = str_replace(array('-', 'ー', '−', '―', '‐'), '', $tuti->oup_m_tuti_endday[$i]);
        }
        if ($tuti->oup_m_tuti_startday[$i] < 1) {
            $tuti->oup_m_tuti_startday[$i] = "";
        }
        if ($tuti->oup_m_tuti_endday[$i] < 1) {
            $tuti->oup_m_tuti_endday[$i] = "";
        }
    }
    }

    // キャリア判定（PC/スマートフォン/タブレット）
    if ($common->judgephone) {
        // HTML表示
        require_once('tuti1.php');
    // キャリア判定（フィーチャーフォン）
    } else {
        // HTML表示
        require_once('../../views/m/kanri/tuti1_html.php');
    }
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" media="screen, projection" />
    <script type="text/javascript" src="../bootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/jquery.balloon.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>　
    <title>勤怠管理システム</title>
  </head>

  <script>
    function confirm1(no) {
      if(!confirm('この項目を削除してもよろしいですか?')) return false;
      location.href = "staff2.php?act=2&staff_id="+no;
    }
  </script>

  <body>
    <div class="container">
      <div class="page-header">
        <h4>通知メッセージ設定一覧</h4>
      </div>

      <form name="frm" method="POST" action="tuti1.php">

        <br />
        <div class="row">
          <div class="col-xs-12 col-md-12">
            <table border="1">
              <tr align="center">
                <td width="30" bgcolor="FFDCA5">&nbsp;</td>
<!--                <td width="150" bgcolor="FFDCA5">対象</td>-->
                <td width="150" bgcolor="FFDCA5">開始日</td>
<!--                <td width="150" bgcolor="FFDCA5">期間</td>-->
                <td width="150" bgcolor="FFDCA5">終了日</td>
                <td width="650" bgcolor="FFDCA5">メッセージ</td>
                <td width="100" bgcolor="FFDCA5">表示</td>
              </tr>
              <?php 
              if ($tuti->oup_m_tuti_no) {
              if (count($tuti->oup_m_tuti_no) < 3) {
                for ($i=0;$i<3;$i++) { ?>
                    <tr align="center">
                      <td><?php print($i+1); ?></td>
                      <td>
                        <input type="date" name="tuti_sday[<?php echo $i; ?>]" size="9" maxlength="8" value="<?php print($tuti->oup_m_tuti_startday[$i]); ?>" >
                      </td>
                      <td>
                        <input type="date" name="tuti_eday[<?php echo $i; ?>]" size="9" maxlength="8" value="<?php print($tuti->oup_m_tuti_endday[$i]); ?>" >
                      </td>
                      <td><textarea name="tuti_msg[<?php echo $i; ?>]" rows="4" cols="70" value="<?php print($tuti->oup_m_tuti_msg[$i]); ?>" ><?php print($tuti->oup_m_tuti_msg[$i]); ?></textarea></td>
                      <td><?php print($hyoji); ?></td>
                      <INPUT type="hidden" name="tuti_no[<?php echo $i; ?>]" value="<?php echo $i+1; ?>">
                    </tr>
                <?php }
              } else {
              //for ($i=0;$i<count($tuti->oup_m_tuti_no);$i++) { 
              for ($i=0;$i<count($tuti->oup_m_tuti_no);$i++) {
              ?>
              <tr align="center">
                <td><?php print($i+1); ?></td>
                <td>
                  <input type="date" name="tuti_sday[<?php echo $i; ?>]" size="9" maxlength="8" value="<?php print($tuti->oup_m_tuti_startday[$i]); ?>" >
                </td>
                <td>
                  <input type="date" name="tuti_eday[<?php echo $i; ?>]" size="9" maxlength="8" value="<?php print($tuti->oup_m_tuti_endday[$i]); ?>" >
                </td>
                <td><textarea name="tuti_msg[<?php echo $i; ?>]" rows="4" cols="70" value="<?php print($tuti->oup_m_tuti_msg[$i]); ?>" ><?php print($tuti->oup_m_tuti_msg[$i]); ?></textarea></td>
                <td><?php print($hyoji[$tuti->oup_m_tuti_no[$i]]); ?></td>
                <INPUT type="hidden" name="tuti_no[<?php echo $i; ?>]" value="<?php echo $i+1; ?>">
              </tr>
              <?php } ?>
              <?php } ?>
              <?php } ?>
            </table>
          </div>
        </div>
        <br />

        <div class="row">
          <div class="col-6">
          <button type="submit" class="btn btn-success btn-block" role="button" name="modify">登録</button>
<!--            <a href="tuti1.php" class="btn btn-success btn-block" role="button" aria-pressed="true">登録</a>-->
          </div>
          <div class="col-6">
            <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">戻る</a>
          </div>
        </div>
        <br />

      </form>

    </div>

      <div class="modal-footer">
          <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
      </div><!-- /footer -->

  </body>
</html>
