<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" media="screen, projection" />
    <script src="./../bootstrap-4.3.1/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>　
    <title>勤怠管理システム</title>
  </head>

  <script>
    function confirm1(no) {
      if(!confirm('この項目を削除してもよろしいですか?')) return false;
      location.href = "shift2.php?act=2&shift_id="+no+"&shift_id2="+no;
    }
    
    const loadTimer = 300000    // ミリ秒で間隔の時間を指定
    window.addEventListener('load',function(){
      // setInterval('location.reload()',loadTimer);
      setInterval(function(){
        self.location = "haitihyo.php"
      },loadTimer);
    });

    window.onload = function() {
      var doch = $(document).innerHeight(); //ページ全体の高さ
      var winh = $(window).innerHeight(); //ウィンドウの高さ
      var bottom = doch - winh; //ページ全体の高さ - ウィンドウの高さ = ページの最下部位置

      var timers
      var flg = 1
      var scrollTimer = 10000    // ミリ秒で間隔の時間を指定
      console.log("start")
      timers = setInterval(function(){
        // clearInterval(timers);
        // console.log("start")
        if (flg == 1) {
          console.log("down")
          flg = 2
          $('html, body').animate(
              // { scrollTop: $('body').get(0).scrollHeight },
              { scrollTop: doch/2 },
              // 200 * 100 * 100,
              5000,
              'linear',
          )
          // window.scrollBy(0, $(document).innerHeight()/2)
        } else {
          console.log("up")
          flg = 1
          $('html, body').animate(
              { scrollTop: 0 },
              // 200 * 100 * 100,
              5000,
              'linear',
          )
          // window.scrollBy(0, -$(document).innerHeight()/2)
        }
      },scrollTimer);
      
      /*
      const scrollHeight = Math.max(
        document.body.scrollHeight, document.documentElement.scrollHeight,
        document.body.offsetHeight, document.documentElement.offsetHeight,
        document.body.clientHeight, document.documentElement.clientHeight
      );
      const pageMostBottom = scrollHeight - window.innerHeight;
      window.addEventListener('scroll', () => {
          const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

          // iosはバウンドするので、無難に `>=` にする
          if (scrollTop >= pageMostBottom) {
              console.log('一番下までスクロールしました');
          }
      });

      var speed = 5; //時間あたりに移動するpx量です。デフォルトでは1pxにしていますが、自由に変えてください
      var interval = 100; //移動する間隔です。デフォルトでは0.1秒おきにしていますが、自由に変えてください
      var scrollTop = document.body.scrollTop;
      setInterval(function() {
          var scroll = scrollTop + speed;
          window.scrollBy(0, scroll)
      },interval);
      */
    }

    // $(function(){
    //   $(window).on('scroll', function () {
    //     var doch = $(document).innerHeight(); //ページ全体の高さ
    //     var winh = $(window).innerHeight(); //ウィンドウの高さ
    //     var bottom = doch - winh; //ページ全体の高さ - ウィンドウの高さ = ページの最下部位置
    //     if (bottom <= $(window).scrollTop()) {
    //     //一番下までスクロールした時に実行
    //     console.log("最底辺！");
    //     }
    //   });
    // })
    
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
              <td nowrap class="w-25" style="font-size:30px; text-align:center;"><b>配置照会</b></td>
              <td nowrap class="w-50" style="font-size:25px;"><b><?php print(substr($targetday,0,4)); ?>年<?php print(substr($targetday,4,2)); ?>月<?php print(substr($targetday,6,2)); ?>日(<?php print($week[$w]); ?>)
              &nbsp;&nbsp;&nbsp;<?php print(substr(date("H:i"),0,2)); ?>時<?php print(date("i")); ?>分&nbsp;現在</b></td>
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
                    <td width="200" class="font2" bgcolor="93FFAB"><b>本部</b></td>
                    <td width="200" class="font2" bgcolor="FFFF99"><b>常用</b></td>
                    <td width="200" class="font2" bgcolor="FFAD90"><b>登録</b></td>
                    <td width="200" class="font2" bgcolor="A4C6FF"><b>協力会社</b></td>
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
              //$wkdetail->inp_t_wk_joban_kbn2 = "4";
              //$wkdetail->inp_t_wk_joban_kbn3 = "5";
              $wkdetail->inp_t_wk_joban_kbns = "4,5";
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
              $work_mem2->inp_t_wk_joban_kbn2 = "4";
              $work_mem2->inp_t_wk_joban_kbn3 = "5";
              $work_mem2->getWkdetail();

              // シフト予定マスタクラス(日勤当日)
              $wkdetail2   = new Wkdetail;     
              // 予定の検索条件セット
              $wkdetail2->inp_t_wk_plan_date = $targetday;
              $wkdetail2->inp_t_wk_genba_id = $genba->oup_m_genba_id[$i];
              $wkdetail2->inp_t_wk_plan_kbn = "2";
              //$wkdetail2->inp_t_wk_joban_kbn2 = "4";
              //$wkdetail2->inp_t_wk_joban_kbn3 = "5";
              $wkdetail2->inp_t_wk_joban_kbns = "4,5";
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
              $work_mem3->inp_t_wk_joban_kbn2 = "4";
              $work_mem3->inp_t_wk_joban_kbn3 = "5";
              $work_mem3->getWkdetail();

              // シフト予定マスタクラス(夜勤当日)
              $wkdetail3   = new Wkdetail;     
              // 予定の検索条件セット
              $wkdetail3->inp_t_wk_plan_date = $targetday;
              $wkdetail3->inp_t_wk_genba_id = $genba->oup_m_genba_id[$i];
              $wkdetail3->inp_t_wk_plan_kbn = "3";
              //$wkdetail3->inp_t_wk_joban_kbn2 = "4";
              //$wkdetail3->inp_t_wk_joban_kbn3 = "5";
              $wkdetail3->inp_t_wk_joban_kbns = "4,5";
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
              $work_mem4->inp_t_wk_joban_kbn2 = "4";
              $work_mem4->inp_t_wk_joban_kbn3 = "5";
              $work_mem4->getWkdetail();
              
              // シフト予定マスタクラス(時給当日)
              $wkdetail_j   = new Wkdetail;     
              // 予定の検索条件セット
              $wkdetail_j->inp_t_wk_plan_date = $targetday;
              $wkdetail_j->inp_t_wk_genba_id = $genba->oup_m_genba_id[$i];
              $wkdetail_j->inp_t_wk_plan_kbn = "6";
              //$wkdetail_j->inp_t_wk_joban_kbn2 = "4";
              //$wkdetail_j->inp_t_wk_joban_kbn3 = "5";
              $wkdetail_j->inp_t_wk_joban_kbns = "4,5";
              // 予定の取得
              $wkdetail_j->getWkdetail();
              // シフト予定マスタクラス(時給前日)
              $work_mem_j = new Wkdetail;
              $work_mem_j->inp_t_wk_genba_id    = $genba->oup_m_genba_id[$i];
              $work_mem_j->inp_t_wk_plan_date   = date('Ymd', strtotime('-1 day'));
              $work_mem_j->inp_t_wk_kaban_time  = "null";
              $work_mem_j->inp_t_wk_joban_time  = "is not null";
              // $work_mem4->inp_t_wk_joban_time_flg  = "1";
              $work_mem_j->inp_t_wk_del_flg     = "0";
              $work_mem_j->inp_t_wk_plan_kbn = "6";
              $work_mem_j->inp_t_wk_joban_kbn2 = "4";
              $work_mem_j->inp_t_wk_joban_kbn3 = "5";
              $work_mem_j->getWkdetail();
              
              ?>
              <?php
              if ($work_mem2->oup_t_wk_taiin_id || $wkdetail->oup_t_wk_detail_no ||
              $work_mem3->oup_t_wk_taiin_id || $wkdetail2->oup_t_wk_detail_no ||
              $work_mem4->oup_t_wk_taiin_id || $wkdetail3->oup_t_wk_detail_no ||
              $work_mem_j->oup_t_wk_taiin_id || $wkdetail_j->oup_t_wk_detail_no) {
              // if (count($work_mem2->oup_t_wk_taiin_id[0]) != 0 || count($wkdetail->oup_t_wk_detail_no[0]) != 0 ||
              // count($work_mem3->oup_t_wk_taiin_id[0]) != 0 || count($wkdetail2->oup_t_wk_detail_no[0]) != 0 ||
              // count($work_mem4->oup_t_wk_taiin_id[0]) != 0 || count($wkdetail3->oup_t_wk_detail_no[0]) != 0 ||
              // count($work_mem_j->oup_t_wk_taiin_id[0]) != 0 || count($wkdetail_j->oup_t_wk_detail_no[0]) != 0) {
              ?>

              <?php if (!isset($count)) {
                $count = 0;
              }
              if ($count == 0 || $count%10 == 0){
                // echo '<tr><td><table>';
                // if ($count =! 0 || $count%10 == 0) {
                //   echo '</table>';
                //   echo '<table border="1">';
                // }
                ?>
              <tr align="center" bgcolor="FFDCA5">
                <td class="font2">現場</td>
                <td class="font2">泊</td>
                <td class="font2">日勤</td>
                <td class="font2">夜</td>
                
              <?php if ($work_mem_j2->oup_t_wk_taiin_id || $wkdetail_j2->oup_t_wk_detail_no) { ?>
              <?php //if (count($work_mem_j2->oup_t_wk_taiin_id) != 0 || count($wkdetail_j2->oup_t_wk_detail_no) != 0) { ?>
                <td class="font2">時給</td>
              <?php } ?>
              
              </tr>
              <?php }
              $count = $count + 1; ?>
              <tr>
              
                <td nowrap class="font_g"><?php print($genba->oup_m_genba_name[$i]); ?></td>

                <?php
                    
                ?>

                <td nowrap style="padding:2px;">
                    <?php if ($work_mem2->oup_t_wk_taiin_id) { ?>
                    <?php $t_cnt = 0; ?>
                    <?php for ($j=0; $j<count($work_mem2->oup_t_wk_taiin_id); $j++) { 
                    if ($work_mem2->oup_t_wk_plan_kensyu[$j] == 1) { $work_mem2->oup_t_wk_plan_kensyu[$j] = "研"; } ?>
                      <?php $color=""; ?>
                      <?php if ($staffkbns[$work_mem2->oup_t_wk_taiin_id[$j]]=="1") { $color="#93FFAB"; } ?><?php // green ?>
                      <?php if ($staffkbns[$work_mem2->oup_t_wk_taiin_id[$j]]=="2") { $color="#FFFF99"; } ?><?php // yellow ?>
                      <?php if ($staffkbns[$work_mem2->oup_t_wk_taiin_id[$j]]=="3") { $color="#FFAD90"; } ?><?php // red ?>
                      <?php if ($staffkbns[$work_mem2->oup_t_wk_taiin_id[$j]]=="4") { $color="#A4C6FF"; } ?><?php // blue ?>
                      <?php if ($work_mem2->oup_t_wk_joban_kbn[$j] != "" && $work_mem2->oup_t_wk_kaban_kbn[$j] != "1") { ?>
                      <b><span class="font margin_b span" style="background-color:<?php print($color); ?>;">
                          
                          <?php print($work_mem2->oup_t_wk_plan_kensyu[$j].$work_mem2->oup_t_wk_plan_hosoku[$j]."&nbsp;".str_replace(array(" ","　"),"",$staffs[$work_mem2->oup_t_wk_taiin_id[$j]])); ?><?php print("(".date('n', strtotime($work_mem2->oup_t_wk_plan_date[$j]))."/".date('j', strtotime($work_mem2->oup_t_wk_plan_date[$j])).")"); ?>
                          
                        </span></b><br>
                      <?php } ?>
                      <?php
                      if ($j == 1 || ($j == 1 + (2 * $t_cnt))) {
                        print("<br>");
                        $t_cnt = 1 + $t_cnt;
                      }
                      ?>
                    <?php } ?>
                    <?php } ?>
                    <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
                    <?php if($work_mem2->oup_t_wk_taiin_id) { ?>
                    <?php if(count($work_mem2->oup_t_wk_taiin_id) %2 != 0) {
                        print("<br>");
                    } ?>
                    <?php } ?>
                    <?php for ($j=0;$j<count($wkdetail->oup_t_wk_detail_no);$j++) { 
                    if ($wkdetail->oup_t_wk_plan_kensyu[$j] == 1) { $wkdetail->oup_t_wk_plan_kensyu[$j] = "研"; } ?>
                        
                            <?php $color=""; ?>
                            <?php if ($staffkbns[$wkdetail->oup_t_wk_taiin_id[$j]]=="1") { $color="#93FFAB"; } ?><?php // green ?>
                            <?php if ($staffkbns[$wkdetail->oup_t_wk_taiin_id[$j]]=="2") { $color="#FFFF99"; } ?><?php // yellow ?>
                            <?php if ($staffkbns[$wkdetail->oup_t_wk_taiin_id[$j]]=="3") { $color="#FFAD90"; } ?><?php // red ?>
                            <?php if ($staffkbns[$wkdetail->oup_t_wk_taiin_id[$j]]=="4") { $color="#A4C6FF"; } ?><?php // blue ?>
                      <b><span class="font margin_b span" style="background-color:<?php print($color); ?>;">
                        
                          
                        <?php if ($wkdetail->oup_t_wk_kaban_kbn[$j] == "1" || $wkdetail->oup_t_wk_joban_kbn[$j] == "1") { ?>
                          <font color="black">
                        <?php } else { ?>
                          <font color="gray">
                        <?php } ?>
                        <?php print($wkdetail->oup_t_wk_plan_kensyu[$j].$wkdetail->oup_t_wk_plan_hosoku[$j]."&nbsp;".str_replace(array(" ","　"),"",$staffs[$wkdetail->oup_t_wk_taiin_id[$j]])); ?></span></b></font>
                        
                        <?php
                        if ($j == 1) {
                          print("<br>");
                          $t_cnt2 = 1;
                        } elseif ($j == 1 + (2 * $t_cnt2)) { 
                          print("<br>");
                          $t_cnt2 = $t_cnt2 + 1;
                        }
                        ?>

                    <?php } ?>
                    <?php } ?>
                </td>

                <?php
                    
                ?>

                <td nowrap style="">
                    <?php if ($work_mem3->oup_t_wk_taiin_id) { ?>
                    <?php $count3 = 0; ?>
                    <?php for ($j=0; $j<count($work_mem3->oup_t_wk_taiin_id); $j++) { 
                    if ($work_mem3->oup_t_wk_plan_kensyu[$j] == 1) { $work_mem3->oup_t_wk_plan_kensyu[$j] = "研"; } ?>
                      <?php $color=""; ?>
                      <?php if ($staffkbns[$work_mem3->oup_t_wk_taiin_id[$j]]=="1") { $color="#93FFAB"; } ?><?php // green ?>
                      <?php if ($staffkbns[$work_mem3->oup_t_wk_taiin_id[$j]]=="2") { $color="#FFFF99"; } ?><?php // yellow ?>
                      <?php if ($staffkbns[$work_mem3->oup_t_wk_taiin_id[$j]]=="3") { $color="#FFAD90"; } ?><?php // red ?>
                      <?php if ($staffkbns[$work_mem3->oup_t_wk_taiin_id[$j]]=="4") { $color="#A4C6FF"; } ?><?php // blue ?>
                      <?php if ($work_mem3->oup_t_wk_joban_kbn[$j] != "" && $work_mem3->oup_t_wk_kaban_kbn[$j] != "1") { ?>
                        <b><span class="font margin_b span" style="background-color:<?php print($color); ?>;">
                          
                          
                          <?php print($work_mem3->oup_t_wk_plan_kensyu[$j].$work_mem3->oup_t_wk_plan_hosoku[$j]."&nbsp;".str_replace(array(" ","　"),"",$staffs[$work_mem3->oup_t_wk_taiin_id[$j]])); ?><?php print("(".date('n', strtotime($work_mem3->oup_t_wk_plan_date[$j]))."/".date('j', strtotime($work_mem3->oup_t_wk_plan_date[$j])).")"); ?>
                          
                        </span></b>
                      <?php } ?>
                      <?php if (($j != 0 && $j == 6) || ($j == 6 + (7 * $count3))) {
                          print("<br>");
                          $count3 = 1 + $count3;
                        } ?>
                    <?php } ?>
                    <?php } ?>
                    <?php if ($wkdetail2->oup_t_wk_detail_no) { ?>
                    <?php if($work_mem3->oup_t_wk_taiin_id) { ?>
                    <?php if(count($work_mem3->oup_t_wk_taiin_id) %7 != 0) {
                        print("<br>");
                    } ?>
                    <?php } ?>
                    <?php for ($j=0;$j<count($wkdetail2->oup_t_wk_detail_no);$j++) { 
                    if ($wkdetail2->oup_t_wk_plan_kensyu[$j] == 1) { $wkdetail2->oup_t_wk_plan_kensyu[$j] = "研"; } ?>
                        
                            <?php if ($staffkbns[$wkdetail2->oup_t_wk_taiin_id[$j]]=="1") { $color="#93FFAB"; } ?><?php // green ?>
                            <?php if ($staffkbns[$wkdetail2->oup_t_wk_taiin_id[$j]]=="2") { $color="#FFFF99"; } ?><?php // yellow ?>
                            <?php if ($staffkbns[$wkdetail2->oup_t_wk_taiin_id[$j]]=="3") { $color="#FFAD90"; } ?><?php // red ?>
                            <?php if ($staffkbns[$wkdetail2->oup_t_wk_taiin_id[$j]]=="4") { $color="#A4C6FF"; } ?><?php // blue ?>
                      <b><span class="font margin_b span" style="background-color:<?php print($color); ?>;">
                        
                          
                        <?php if ($wkdetail2->oup_t_wk_kaban_kbn[$j] == "1" || $wkdetail2->oup_t_wk_joban_kbn[$j] == "1") { ?>
                          <font color="black">
                        <?php } else { ?>
                          <font color="gray">
                        <?php } ?>
                        <?php print($wkdetail2->oup_t_wk_plan_kensyu[$j].$wkdetail2->oup_t_wk_plan_hosoku[$j]."&nbsp;".str_replace(array(" ","　"),"",$staffs[$wkdetail2->oup_t_wk_taiin_id[$j]])); ?></span></b></font>
                        
                        <?php if ($j != 0 && $j == 6) {
                                  print("<br>");
                                  $count2 = 1;
                              } elseif ($j == 6 + (7 * $count2)) { 
                                  print("<br>");
                                  $count2 = $count2 + 1;
                              } ?>
                    <?php } ?>
                    <?php } ?>
                </td>

                <?php
                    
                ?>

                <td nowrap>
                <?php if ($work_mem4->oup_t_wk_taiin_id) { ?>
                    <?php for ($j=0; $j<count($work_mem4->oup_t_wk_taiin_id); $j++) { 
                    if ($work_mem4->oup_t_wk_plan_kensyu[$j] == 1) { $work_mem4->oup_t_wk_plan_kensyu[$j] = "研"; } ?>
                      <?php $color=""; ?>
                      <?php if ($staffkbns[$work_mem4->oup_t_wk_taiin_id[$j]]=="1") { $color="#93FFAB"; } ?><?php // green ?>
                      <?php if ($staffkbns[$work_mem4->oup_t_wk_taiin_id[$j]]=="2") { $color="#FFFF99"; } ?><?php // yellow ?>
                      <?php if ($staffkbns[$work_mem4->oup_t_wk_taiin_id[$j]]=="3") { $color="#FFAD90"; } ?><?php // red ?>
                      <?php if ($staffkbns[$work_mem4->oup_t_wk_taiin_id[$j]]=="4") { $color="#A4C6FF"; } ?><?php // blue ?>
                      <?php if ($work_mem4->oup_t_wk_joban_kbn[$j] != "" && $work_mem4->oup_t_wk_kaban_kbn[$j] != "1") { ?>
                      <b><span class="font margin_b span" style="background-color:<?php print($color); ?>;">
                          
                          <?php print($work_mem4->oup_t_wk_plan_kensyu[$j].$work_mem4->oup_t_wk_plan_hosoku[$j]."&nbsp;".str_replace(array(" ","　"),"",$staffs[$work_mem4->oup_t_wk_taiin_id[$j]])); ?><?php print("(".date('n', strtotime($work_mem4->oup_t_wk_plan_date[$j]))."/".date('j', strtotime($work_mem4->oup_t_wk_plan_date[$j])).")"); ?>
                          
                        </span></b><br>
                      <?php } ?>
                    <?php } ?>
                    <?php } ?>
                    <?php if ($wkdetail3->oup_t_wk_detail_no) { ?>
                    <?php for ($j=0;$j<count($wkdetail3->oup_t_wk_detail_no);$j++) { 
                    if ($wkdetail3->oup_t_wk_plan_kensyu[$j] == 1) { $wkdetail3->oup_t_wk_plan_kensyu[$j] = "研"; } ?>
                        
                            <?php if ($staffkbns[$wkdetail3->oup_t_wk_taiin_id[$j]]=="1") { $color="#93FFAB"; } ?><?php // green ?>
                            <?php if ($staffkbns[$wkdetail3->oup_t_wk_taiin_id[$j]]=="2") { $color="#FFFF99"; } ?><?php // yellow ?>
                            <?php if ($staffkbns[$wkdetail3->oup_t_wk_taiin_id[$j]]=="3") { $color="#FFAD90"; } ?><?php // red ?>
                            <?php if ($staffkbns[$wkdetail3->oup_t_wk_taiin_id[$j]]=="4") { $color="#A4C6FF"; } ?><?php // blue ?>
                      <b><span class="font margin_b span" style="background-color:<?php print($color); ?>;">
                        
                          
                        <?php if ($wkdetail3->oup_t_wk_kaban_kbn[$j] == "1" || $wkdetail3->oup_t_wk_joban_kbn[$j] == "1") { ?>
                          <font color="black">
                        <?php } else { ?>
                          <font color="gray">
                        <?php } ?>
                        <?php print($wkdetail3->oup_t_wk_plan_kensyu[$j].$wkdetail3->oup_t_wk_plan_hosoku[$j]."&nbsp;".str_replace(array(" ","　"),"",$staffs[$wkdetail3->oup_t_wk_taiin_id[$j]])); ?></span></b></font>
                        <br />
                    <?php } ?>
                    <?php } ?>
                </td>
                
              <?php if ($work_mem_j2->oup_t_wk_taiin_id || $wkdetail_j2->oup_t_wk_detail_no) { ?>
              <?php //if (count($work_mem_j2->oup_t_wk_taiin_id) != 0 || count($wkdetail_j2->oup_t_wk_detail_no) != 0) { ?>
                <td nowrap>
                    <?php if ($work_mem_j->oup_t_wk_taiin_id) { ?>
                    <?php for ($j=0; $j<count($work_mem_j->oup_t_wk_taiin_id); $j++) { 
                    if ($work_mem_j->oup_t_wk_plan_kensyu[$j] == 1) { $work_mem_j->oup_t_wk_plan_kensyu[$j] = "研"; } ?>
                      <?php $color=""; ?>
                      <?php if ($staffkbns[$work_mem_j->oup_t_wk_taiin_id[$j]]=="1") { $color="#93FFAB"; } ?><?php // green ?>
                      <?php if ($staffkbns[$work_mem_j->oup_t_wk_taiin_id[$j]]=="2") { $color="#FFFF99"; } ?><?php // yellow ?>
                      <?php if ($staffkbns[$work_mem_j->oup_t_wk_taiin_id[$j]]=="3") { $color="#FFAD90"; } ?><?php // red ?>
                      <?php if ($staffkbns[$work_mem_j->oup_t_wk_taiin_id[$j]]=="4") { $color="#A4C6FF"; } ?><?php // blue ?>
                      <?php if ($work_mem_j->oup_t_wk_joban_kbn[$j] != "" && $work_mem_j->oup_t_wk_kaban_kbn[$j] != "1") { ?>
                      <b><span class="font margin_b span" style="background-color:<?php print($color); ?>;">
                          
                          <?php print($work_mem_j->oup_t_wk_plan_kensyu[$j].$work_mem_j->oup_t_wk_plan_hosoku[$j]."&nbsp;".str_replace(array(" ","　"),"",$staffs[$work_mem_j->oup_t_wk_taiin_id[$j]])); ?><?php print("(".date('n', strtotime($work_mem_j->oup_t_wk_plan_date[$j]))."/".date('j', strtotime($work_mem_j->oup_t_wk_plan_date[$j])).")"); ?>
                          
                        </span></b><br>
                      <?php } ?>
                    <?php } ?>
                    <?php } ?>
                    <?php if ($wkdetail_j->oup_t_wk_detail_no) { ?>
                    <?php for ($j=0;$j<count($wkdetail_j->oup_t_wk_detail_no);$j++) { 
                    if ($wkdetail_j->oup_t_wk_plan_kensyu[$j] == 1) { $wkdetail_j->oup_t_wk_plan_kensyu[$j] = "研"; } ?>
                            <?php if ($staffkbns[$wkdetail_j->oup_t_wk_taiin_id[$j]]=="1") { $color="#93FFAB"; } ?><?php // green ?>
                            <?php if ($staffkbns[$wkdetail_j->oup_t_wk_taiin_id[$j]]=="2") { $color="#FFFF99"; } ?><?php // yellow ?>
                            <?php if ($staffkbns[$wkdetail_j->oup_t_wk_taiin_id[$j]]=="3") { $color="#FFAD90"; } ?><?php // red ?>
                            <?php if ($staffkbns[$wkdetail_j->oup_t_wk_taiin_id[$j]]=="4") { $color="#A4C6FF"; } ?><?php // blue ?>
                      <b><span class="font margin_b span" style="background-color:<?php print($color); ?>;">
                        
                          
                        <?php if ($wkdetail_j->oup_t_wk_kaban_kbn[$j] == "1" || $wkdetail_j->oup_t_wk_joban_kbn[$j] == "1") { ?>
                          <font color="black">
                        <?php } else { ?>
                          <font color="gray">
                        <?php } ?>
                        <?php print($wkdetail_j->oup_t_wk_plan_kensyu[$j].$wkdetail_j->oup_t_wk_plan_hosoku[$j]."&nbsp;".str_replace(array(" ","　"),"",$staffs[$wkdetail_j->oup_t_wk_taiin_id[$j]])); ?></span></b></font>
                        <br />
                    <?php } ?>
                    <?php } ?>
                </td>
              <?php } ?>
                
              </tr>

              <?php
              // if ($count == 0 || $count%10 == 0){
              // echo '</table></td></tr>';
              // }
              ?>
              
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
