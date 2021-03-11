<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" media="screen, projection" />
    <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>　
    <title>勤怠管理システム</title>
  </head>

  <script>
    function confirm1(no) {
      if(!confirm('この項目を削除してもよろしいですか?')) return false;
      location.href = "shift2.php?act=2&shift_id="+no+"&shift_id2="+no;
    }
    
    const timer = 300000    // ミリ秒で間隔の時間を指定
    window.addEventListener('load',function(){
      setInterval('location.reload()',timer);
    });
  </script>
  
  <style>
    .font_g {font-size:1.7rem; }
    .font {font-size:1.9rem; }
    .font2 {font-size:1.3rem; }
    .margin_b {margin-bottom:2px; }
    .span {display: inline-block; width:167px; }
  </style>

  <body>
    <div class="container-fluid">
<!--      <div class="page-header">
        <h4>配置照会</h4>
      </div>

      <form name="frm" method="POST" action="login.php">-->
        <form name="frm" method="POST" action="login.php">
          <table class="page-header w-100" style="margin-bottom:20px;">
            <tr nowrap class="w-100">
              <td nowrap class="w-25" style="font-size:30px; text-align:center;">配置照会</td>
              <td nowrap class="w-50" style="font-size:25px;"><?php print(substr($targetday,0,4)); ?>年<?php print(substr($targetday,4,2)); ?>月<?php print(substr($targetday,6,2)); ?>日(<?php print($week[$w]); ?>)
              &nbsp;&nbsp;&nbsp;<?php print(substr(date("H:i"),0,2)); ?>時<?php print(date("i")); ?>分&nbsp;現在</td>
              <!-- <td class="w-25" style="font-size:25px;">現在<?php print(substr(date("H:i"),0,2)); ?>時<?php print(substr(date("H:i"),2,3)); ?>分</td> -->
            </tr>
          </table>

        <div class="row">
          <div class="col-xs-12 col-md-12">
<!--            <table border="1">
              <tr>
                <td width="130" bgcolor="FFDCA5" align="center">日付</td>
                <td width="300"><input type="tel" name="targetday" class="form-control" value="<?php print($targetday); ?>"></td>
              </tr>
              <tr>
                <td bgcolor="FFDCA5" align="center">時刻</td>
                <td><input type="hidden" name="today_time" class="form-control" value="<?php print(date("H:i")); ?>">　<?php print(date("H:i")); ?></td>
              </tr>
            </table>-->
            <table class="text-center" border="1">
                <tr>
                    <td width="100" class="font2" bgcolor="93FFAB">本部</td>
                    <td width="100" class="font2" bgcolor="FFFF99">常用</td>
                    <td width="100" class="font2" bgcolor="FFAD90">登録</td>
                    <td width="100" class="font2" bgcolor="A4C6FF">協力会社</td>
                </tr>
            </table>
          </div>
        </div>
        <br />
        <div class="row">
          <div class="col-xs-12 col-md-12">
            <table border="1">
<?php for($i=0;$i<count($genba->oup_m_genba_id);$i++){ ?>
              <?php /*
                if ($i == 0 || $i%10 == 0){
                ?>
              <tr align="center" bgcolor="FFDCA5">
                <td width="150" >現場</td>
                <td width="250" >泊</td>
                <td width="250" >日勤</td>
                <td width="250" >夜</td>
              </tr>
              <?php } ?>
              <tr>
              */?>
              
              <?php
              // シフト予定マスタクラス(泊当日)
              $wkdetail   = new Wkdetail;     
              // 予定の検索条件セット
              $wkdetail->inp_t_wk_plan_date = $targetday;
              $wkdetail->inp_t_wk_genba_id = $genba->oup_m_genba_id[$i];
              $wkdetail->inp_t_wk_plan_kbn = "1";
              // 予定の取得
              $wkdetail->getWkdetail();
              // シフト予定マスタクラス(泊前日)
              $work_mem2 = new Wkdetail;
              $work_mem2->inp_t_wk_genba_id    = $genba->oup_m_genba_id[$i];
              $work_mem2->inp_t_wk_plan_date   = date('Ymd', strtotime('-1 day'));
              $work_mem2->inp_t_wk_kaban_time  = "null";
              $work_mem2->inp_t_wk_joban_time  = "is not null";
              // $work_mem2->inp_t_wk_joban_time_flg  = "1";
              $work_mem2->inp_t_wk_del_flg     = "0";
              $work_mem2->inp_t_wk_plan_kbn = "1";
              $work_mem2->getWkdetail();

              // シフト予定マスタクラス(日勤当日)
              $wkdetail2   = new Wkdetail;     
              // 予定の検索条件セット
              $wkdetail2->inp_t_wk_plan_date = $targetday;
              $wkdetail2->inp_t_wk_genba_id = $genba->oup_m_genba_id[$i];
              $wkdetail2->inp_t_wk_plan_kbn = "2";
              // 予定の取得
              $wkdetail2->getWkdetail();
              // シフト予定マスタクラス(日勤前日)
              $work_mem3 = new Wkdetail;
              $work_mem3->inp_t_wk_genba_id    = $genba->oup_m_genba_id[$i];
              $work_mem3->inp_t_wk_plan_date   = date('Ymd', strtotime('-1 day'));
              $work_mem3->inp_t_wk_kaban_time  = "null";
              $work_mem3->inp_t_wk_joban_time  = "is not null";
              // $work_mem3->inp_t_wk_joban_time_flg  = "1";
              $work_mem3->inp_t_wk_del_flg     = "0";
              $work_mem3->inp_t_wk_plan_kbn = "2";
              $work_mem3->getWkdetail();

              // シフト予定マスタクラス(夜勤当日)
              $wkdetail3   = new Wkdetail;     
              // 予定の検索条件セット
              $wkdetail3->inp_t_wk_plan_date = $targetday;
              $wkdetail3->inp_t_wk_genba_id = $genba->oup_m_genba_id[$i];
              $wkdetail3->inp_t_wk_plan_kbn = "3";
              // 予定の取得
              $wkdetail3->getWkdetail();
              // シフト予定マスタクラス(夜勤前日)
              $work_mem4 = new Wkdetail;
              $work_mem4->inp_t_wk_genba_id    = $genba->oup_m_genba_id[$i];
              $work_mem4->inp_t_wk_plan_date   = date('Ymd', strtotime('-1 day'));
              $work_mem4->inp_t_wk_kaban_time  = "null";
              $work_mem4->inp_t_wk_joban_time  = "is not null";
              // $work_mem4->inp_t_wk_joban_time_flg  = "1";
              $work_mem4->inp_t_wk_del_flg     = "0";
              $work_mem4->inp_t_wk_plan_kbn = "3";
              $work_mem4->getWkdetail();
              ?>
              <?php if (count($work_mem2->oup_t_wk_taiin_id[0]) != 0 || count($wkdetail->oup_t_wk_detail_no[0]) != 0 ||
              count($work_mem3->oup_t_wk_taiin_id[0]) != 0 || count($wkdetail2->oup_t_wk_detail_no[0]) != 0 ||
              count($work_mem4->oup_t_wk_taiin_id[0]) != 0 || count($wkdetail3->oup_t_wk_detail_no[0]) != 0) { ?>

              <?php if (!isset($count)) {
                $count = 0;
              }
              if ($count == 0 || $count%10 == 0){
                ?>
              <tr align="center" bgcolor="FFDCA5">
                <td class="font2">現場</td>
                <td class="font2">泊</td>
                <td class="font2">日勤</td>
                <td class="font2">夜</td>
              </tr>
              <?php }
              $count = $count + 1; ?>
              <tr>
              
                <td nowrap class="font_g"><?php print($genba->oup_m_genba_name[$i]); ?></td>

                <?php
                    
                ?>

                <td nowrap style="padding:2px;">
                    <?php for ($j=0; $j<count($work_mem2->oup_t_wk_taiin_id); $j++) { 
                    if ($work_mem2->oup_t_wk_plan_kensyu[$j] == 1) { $work_mem2->oup_t_wk_plan_kensyu[$j] = "研"; } ?>
                      <?php $color=""; ?>
                      <?php if ($staffkbns[$work_mem2->oup_t_wk_taiin_id[$j]]=="1") { $color="#93FFAB"; } ?><?php // green ?>
                      <?php if ($staffkbns[$work_mem2->oup_t_wk_taiin_id[$j]]=="2") { $color="#FFFF99"; } ?><?php // yellow ?>
                      <?php if ($staffkbns[$work_mem2->oup_t_wk_taiin_id[$j]]=="3") { $color="#FFAD90"; } ?><?php // red ?>
                      <?php if ($staffkbns[$work_mem2->oup_t_wk_taiin_id[$j]]=="4") { $color="#A4C6FF"; } ?><?php // blue ?>
                      <?php if ($work_mem2->oup_t_wk_joban_kbn[$j] != "" && $work_mem2->oup_t_wk_kaban_kbn[$j] != "1") { ?>
                      <b><span class="font margin_b span" style="background-color:<?php print($color); ?>;">
                          <a style="color:black; text-decoration: none;" href="kinmujokyosyousai.php?no=<?php print($work_mem2->oup_t_wk_detail_no[$j]); ?>">
                          <?php print($work_mem2->oup_t_wk_plan_kensyu[$j].$work_mem2->oup_t_wk_plan_hosoku[$j]."&nbsp;".str_replace(array(" ","　"),"",$staffs[$work_mem2->oup_t_wk_taiin_id[$j]])); ?><?php print("(".date('n', strtotime($work_mem2->oup_t_wk_plan_date[$j]))."/".date('j', strtotime($work_mem2->oup_t_wk_plan_date[$j])).")"); ?>
                          </a>
                        </span></b><br>
                      <?php } ?>
                    <?php } ?>
                    <?php for ($j=0;$j<count($wkdetail->oup_t_wk_detail_no);$j++) { 
                    if ($wkdetail->oup_t_wk_plan_kensyu[$j] == 1) { $wkdetail->oup_t_wk_plan_kensyu[$j] = "研"; } ?>
                        <?php /* if ($wkdetail->oup_t_wk_joban_kbn[$j]!="") { ?>
                            「
                        <?php } */ ?>
                            <?php $color=""; ?>
                            <?php if ($staffkbns[$wkdetail->oup_t_wk_taiin_id[$j]]=="1") { $color="#93FFAB"; } ?><?php // green ?>
                            <?php if ($staffkbns[$wkdetail->oup_t_wk_taiin_id[$j]]=="2") { $color="#FFFF99"; } ?><?php // yellow ?>
                            <?php if ($staffkbns[$wkdetail->oup_t_wk_taiin_id[$j]]=="3") { $color="#FFAD90"; } ?><?php // red ?>
                            <?php if ($staffkbns[$wkdetail->oup_t_wk_taiin_id[$j]]=="4") { $color="#A4C6FF"; } ?><?php // blue ?>
                      <b><span class="font margin_b span" style="background-color:<?php print($color); ?>;">
                        <?php if ($wkdetail->oup_t_wk_joban_kbn[$j] != "" && $wkdetail->oup_t_wk_kaban_kbn[$j] != "1") { ?>
                          <a style="color:black; text-decoration: none;" href="kinmujokyosyousai.php?no=<?php print($wkdetail->oup_t_wk_detail_no[$j]); ?>">
                        <?php } elseif ($wkdetail->oup_t_wk_kaban_kbn[$j] == "1") { ?>
                      <font color="black">
                      <?php } else { ?>
                      <font color="gray">
                      <?php } ?>
                        <?php print($wkdetail->oup_t_wk_plan_kensyu[$j].$wkdetail->oup_t_wk_plan_hosoku[$j]."&nbsp;".str_replace(array(" ","　"),"",$staffs[$wkdetail->oup_t_wk_taiin_id[$j]])); ?></a></span></b></font>
                        <?php /* if ($wkdetail->oup_t_wk_joban_kbn[$j]!="") { ?>
                            <?php print(" ".$wkdetail->oup_t_wk_joban_time[$j]."」"); ?>
                        <?php } */ ?>
                    <!--     /　--><br />
                    <?php } ?>
                </td>

                <?php
                    
                ?>

                <td nowrap style="">
                    <?php for ($j=0; $j<count($work_mem3->oup_t_wk_taiin_id); $j++) { 
                    if ($work_mem3->oup_t_wk_plan_kensyu[$j] == 1) { $work_mem3->oup_t_wk_plan_kensyu[$j] = "研"; } ?>
                      <?php $color=""; ?>
                      <?php if ($staffkbns[$work_mem3->oup_t_wk_taiin_id[$j]]=="1") { $color="#93FFAB"; } ?><?php // green ?>
                      <?php if ($staffkbns[$work_mem3->oup_t_wk_taiin_id[$j]]=="2") { $color="#FFFF99"; } ?><?php // yellow ?>
                      <?php if ($staffkbns[$work_mem3->oup_t_wk_taiin_id[$j]]=="3") { $color="#FFAD90"; } ?><?php // red ?>
                      <?php if ($staffkbns[$work_mem3->oup_t_wk_taiin_id[$j]]=="4") { $color="#A4C6FF"; } ?><?php // blue ?>
                      <?php if ($work_mem3->oup_t_wk_joban_kbn[$j] != "" && $work_mem3->oup_t_wk_kaban_kbn[$j] != "1") { ?>
                        <b><span class="font margin_b span" style="background-color:<?php print($color); ?>;">
                          <a style="color:black; text-decoration: none;" href="kinmujokyosyousai.php?no=<?php print($work_mem3->oup_t_wk_detail_no[$j]); ?>">
                          <!-- <?php print($staffs[$work_mem3->oup_t_wk_taiin_id[$j]]); ?>&nbsp;<?php print("(".date('n', strtotime($work_mem3->oup_t_wk_plan_date[$j]))."/".date('j', strtotime($work_mem3->oup_t_wk_plan_date[$j])).")"); ?> -->
                          <?php print($work_mem3->oup_t_wk_plan_kensyu[$j].$work_mem3->oup_t_wk_plan_hosoku[$j]."&nbsp;".str_replace(array(" ","　"),"",$staffs[$work_mem3->oup_t_wk_taiin_id[$j]])); ?><?php print("(".date('n', strtotime($work_mem3->oup_t_wk_plan_date[$j]))."/".date('j', strtotime($work_mem3->oup_t_wk_plan_date[$j])).")"); ?>
                          </a>
                        </span></b>
                      <?php } ?>
                      <?php if (($j != 0 && $j == 4) || ($j == 4 + (5 * $count3))) {
                          print("<br>");
                          $count3 = 1 + $count3;
                        } ?>
                    <?php } ?>
                    <?php if(count($work_mem3->oup_t_wk_taiin_id) != 0 && count($work_mem3->oup_t_wk_taiin_id) %5 != 0) {
                        print("<br>");
                    } ?>
                    <?php for ($j=0;$j<count($wkdetail2->oup_t_wk_detail_no);$j++) { 
                    if ($wkdetail2->oup_t_wk_plan_kensyu[$j] == 1) { $wkdetail2->oup_t_wk_plan_kensyu[$j] = "研"; } ?>
                        <?php /* if ($wkdetail->oup_t_wk_joban_kbn[$j]!="") { ?>
                            「
                        <?php } */ ?>
                            <?php if ($staffkbns[$wkdetail2->oup_t_wk_taiin_id[$j]]=="1") { $color="#93FFAB"; } ?><?php // green ?>
                            <?php if ($staffkbns[$wkdetail2->oup_t_wk_taiin_id[$j]]=="2") { $color="#FFFF99"; } ?><?php // yellow ?>
                            <?php if ($staffkbns[$wkdetail2->oup_t_wk_taiin_id[$j]]=="3") { $color="#FFAD90"; } ?><?php // red ?>
                            <?php if ($staffkbns[$wkdetail2->oup_t_wk_taiin_id[$j]]=="4") { $color="#A4C6FF"; } ?><?php // blue ?>
                      <b><span class="font margin_b span" style="background-color:<?php print($color); ?>;">
                        <?php if ($wkdetail2->oup_t_wk_joban_kbn[$j] != "" && $wkdetail2->oup_t_wk_kaban_kbn[$j] != "1") { ?>
                          <a style="color:black; text-decoration: none;" href="kinmujokyosyousai.php?no=<?php print($wkdetail2->oup_t_wk_detail_no[$j]); ?>">
                        <?php } elseif ($wkdetail2->oup_t_wk_kaban_kbn[$j] == "1") { ?>
                      <font color="black">
                      <?php } else { ?>
                      <font color="gray">
                      <?php } ?>
                        <?php print($wkdetail2->oup_t_wk_plan_kensyu[$j].$wkdetail2->oup_t_wk_plan_hosoku[$j]."&nbsp;".str_replace(array(" ","　"),"",$staffs[$wkdetail2->oup_t_wk_taiin_id[$j]])); ?></a></span></b></font>
                        <?php /* if ($wkdetail->oup_t_wk_joban_kbn[$j]!="") { ?>
                            <?php print(" ".$wkdetail->oup_t_wk_joban_time[$j]."」"); ?>
                        <?php } */ ?>
                    <!--     /　-->
                        <?php if ($j != 0 && $j == 4) {
                                  print("<br>");
                                  $count2 = 1;
                              } elseif ($j == 4 + (5 * $count2)) { 
                                  print("<br>");
                                  $count2 = $count2 + 1;
                              } ?>
                    <?php } ?>
                </td>

                <?php
                    
                ?>

                <td nowrap>
                    <?php for ($j=0; $j<count($work_mem4->oup_t_wk_taiin_id); $j++) { 
                    if ($work_mem4->oup_t_wk_plan_kensyu[$j] == 1) { $work_mem4->oup_t_wk_plan_kensyu[$j] = "研"; } ?>
                      <?php $color=""; ?>
                      <?php if ($staffkbns[$work_mem4->oup_t_wk_taiin_id[$j]]=="1") { $color="#93FFAB"; } ?><?php // green ?>
                      <?php if ($staffkbns[$work_mem4->oup_t_wk_taiin_id[$j]]=="2") { $color="#FFFF99"; } ?><?php // yellow ?>
                      <?php if ($staffkbns[$work_mem4->oup_t_wk_taiin_id[$j]]=="3") { $color="#FFAD90"; } ?><?php // red ?>
                      <?php if ($staffkbns[$work_mem4->oup_t_wk_taiin_id[$j]]=="4") { $color="#A4C6FF"; } ?><?php // blue ?>
                      <?php if ($work_mem4->oup_t_wk_joban_kbn[$j] != "" && $work_mem4->oup_t_wk_kaban_kbn[$j] != "1") { ?>
                      <b><span class="font margin_b span" style="background-color:<?php print($color); ?>;">
                          <a style="color:black; text-decoration: none;" href="kinmujokyosyousai.php?no=<?php print($work_mem4->oup_t_wk_detail_no[$j]); ?>">
                          <?php print($work_mem4->oup_t_wk_plan_kensyu[$j].$work_mem4->oup_t_wk_plan_hosoku[$j]."&nbsp;".str_replace(array(" ","　"),"",$staffs[$work_mem4->oup_t_wk_taiin_id[$j]])); ?><?php print("(".date('n', strtotime($work_mem4->oup_t_wk_plan_date[$j]))."/".date('j', strtotime($work_mem4->oup_t_wk_plan_date[$j])).")"); ?>
                          </a>
                        </span></b><br>
                      <?php } ?>
                    <?php } ?>
                    <?php for ($j=0;$j<count($wkdetail3->oup_t_wk_detail_no);$j++) { 
                    if ($wkdetail3->oup_t_wk_plan_kensyu[$j] == 1) { $wkdetail3->oup_t_wk_plan_kensyu[$j] = "研"; } ?>
                        <?php /* if ($wkdetail->oup_t_wk_joban_kbn[$j]!="") { ?>
                            「
                        <?php } */ ?>
                            <?php if ($staffkbns[$wkdetail3->oup_t_wk_taiin_id[$j]]=="1") { $color="#93FFAB"; } ?><?php // green ?>
                            <?php if ($staffkbns[$wkdetail3->oup_t_wk_taiin_id[$j]]=="2") { $color="#FFFF99"; } ?><?php // yellow ?>
                            <?php if ($staffkbns[$wkdetail3->oup_t_wk_taiin_id[$j]]=="3") { $color="#FFAD90"; } ?><?php // red ?>
                            <?php if ($staffkbns[$wkdetail3->oup_t_wk_taiin_id[$j]]=="4") { $color="#A4C6FF"; } ?><?php // blue ?>
                      <b><span class="font margin_b span" style="background-color:<?php print($color); ?>;">
                        <?php if ($wkdetail3->oup_t_wk_joban_kbn[$j] != "" && $wkdetail3->oup_t_wk_kaban_kbn[$j] != "1") { ?>
                          <a style="color:black; text-decoration: none;" href="kinmujokyosyousai.php?no=<?php print($wkdetail3->oup_t_wk_detail_no[$j]); ?>">
                        <?php } elseif ($wkdetail3->oup_t_wk_kaban_kbn[$j] == "1") { ?>
                      <font color="black">
                      <?php } else { ?>
                      <font color="gray">
                      <?php } ?>
                        <?php print($wkdetail3->oup_t_wk_plan_kensyu[$j].$wkdetail3->oup_t_wk_plan_hosoku[$j]."&nbsp;".str_replace(array(" ","　"),"",$staffs[$wkdetail3->oup_t_wk_taiin_id[$j]])); ?></a></span></b></font>
                        <?php /* if ($wkdetail->oup_t_wk_joban_kbn[$j]!="") { ?>
                            <?php print(" ".$wkdetail->oup_t_wk_joban_time[$j]."」"); ?>
                        <?php } */ ?>
                    <!--     /　--><br />
                    <?php } ?>
                </td>
              </tr>
              <?php } ?>
<?php } ?>
            </table>
          </div>
        </div>
        <br />

        <div class="row">
          <div class="col-xs-12 col-md-12">
            <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">メニューに戻る</a>
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
