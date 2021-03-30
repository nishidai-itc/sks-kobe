<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">


    <!-- bootstrap-4.3.1 -->
    <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../bootstrap-4.3.1/jquery-3.4.1.min.js"></script>
    <script src="../../bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- <script type="text/javascript" src="./jquery-3.4.1.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> -->

    <title>警備報告書</title>
</head>

<style>
</style>

<body>
  <div class="container">

    <br>
    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <tr>
            <td><label>（警備場所）</label></td>
            <td><label>（契約先）</label></td>
          </tr>

          <tr>
            <td><label>RIC-C5・CFS</label></td>
            <td><label>三菱倉庫株式会社　殿</label></td>
          </tr>
        </table>
      </div>
    </div>
    <hr>

    <form action="report6.php" method="post">
    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <tr>
            <td><label>（勤務時間）</label></td>
            <td><label>天候</label></td>
            <td><label>報告者</label></td>
          </tr>

          <tr>
            <td>
              <label><?php echo "自）".substr($start_date,0,4)."年".substr($start_date,5,2)."月".substr($start_date,8,2)."日　(".getWeek($start_date).")"; ?></label>
              <input type="hidden" name="start_date" value="<?php echo $start_date; ?>">
              <div class="time">
                <input type="number" class="text-center" name="joban_time[0]" value="<?php echo $joban_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="joban_time[1]" value="<?php echo $joban_time[1]; ?>" min="0" max="59">
              </div>
            </td>
          </tr>

          <tr>
            <td>
              <label><?php echo "至）".substr($end_date,0,4)."年".substr($end_date,5,2)."月".substr($end_date,8,2)."日　(".getWeek($end_date).")"; ?></label>
              <input type="hidden" name="end_date" value="<?php echo $end_date; ?>">
              <div class="time">
                <input type="number" class="text-center" name="kaban_time[0]" value="<?php echo $kaban_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="kaban_time[1]" value="<?php echo $kaban_time[1]; ?>" min="0" max="59">
              </div>
            </td>

            <td rowspan="2">
              <select name="weather1" id="weather1" class="">
                <option value=""></option>
                <?php for ($i=0;$i<count($weathers);$i++) { ?>
                <option value="<?php echo $weathers[$i]; ?>"<?php echo $weathers[$i] == $weather1 ? "selected" : "" ; ?>><?php echo $weathers[$i]; ?></option>
                <?php } ?>
              </select>
              <select name="weather2" id="weather2" class="">
                <option value=""></option>
                <?php for ($i=0;$i<count($weathers);$i++) { ?>
                <option value="<?php echo $weathers[$i]; ?>"<?php echo $weathers[$i] == $weather2 ? "selected" : "" ; ?>><?php echo $weathers[$i]; ?></option>
                <?php } ?>
              </select>
            </td>
            <td rowspan="2">
            <select name="staff_id" id="staff_id" class="w-50">
                <option value=""></option>
                <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
                <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { ?>
                <option value="<?php echo $wkdetail->oup_t_wk_taiin_id[$i]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$i] == $staff_id ? "selected" : "" ; ?>><?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$i]]; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </td>
          </tr>
        </table>
      </div>
    </div>
    <hr>


    <div class="row">
      <div class="col-12">
      <table class="table table-borderless">
        <tr>
          <td><label>（１）状況</label></td>
        </tr>
        <tr>
          <td><label>i.C－５・CFSゲート立哨</label></td>
          <td>
            <div class="time">
              <input type="number" class="text-center" name="wk_start_time1[0]" value="<?php echo $wk_start_time1[0]; ?>" min="0" max="23">
              <span class="">:</span>
              <input type="number" class="text-center" name="wk_start_time1[1]" value="<?php echo $wk_start_time1[1]; ?>" min="0" max="59">
            </div>
            <label for="">～</label>
            <div class="time">
              <input type="number" class="text-center" name="wk_end_time1[0]" value="<?php echo $wk_end_time1[0]; ?>" min="0" max="23">
              <span class="">:</span>
              <input type="number" class="text-center" name="wk_end_time1[1]" value="<?php echo $wk_end_time1[1]; ?>" min="0" max="59">
            </div>
          </td>
        </tr>

        <tr>
        <td><label>ii.搬入出車輛</label></td>
          <td>
            <div class="time">
              <input type="number" class="text-center" name="wk_start_time2[0]" value="<?php echo $wk_start_time2[0]; ?>" min="0" max="23">
              <span class="">:</span>
              <input type="number" class="text-center" name="wk_start_time2[1]" value="<?php echo $wk_start_time2[1]; ?>" min="0" max="59">
            </div>
            <label for="">～</label>
            <div class="time">
              <input type="number" class="text-center" name="wk_end_time2[0]" value="<?php echo $wk_end_time2[0]; ?>" min="0" max="23">
              <span class="">:</span>
              <input type="number" class="text-center" name="wk_end_time2[1]" value="<?php echo $wk_end_time2[1]; ?>" min="0" max="59">
            </div>
          </td>
        </tr>

        <tr>
        <td><label>iii.CFSゲート解錠及び施錠</label></td>
          <td>
            <div class="time">
              <input type="number" class="text-center" name="wk_start_time3[0]" value="<?php echo $wk_start_time3[0]; ?>" min="0" max="23">
              <span class="">:</span>
              <input type="number" class="text-center" name="wk_start_time3[1]" value="<?php echo $wk_start_time3[1]; ?>" min="0" max="59">
            </div>
            <label for="">～</label>
            <div class="time">
              <input type="number" class="text-center" name="wk_end_time3[0]" value="<?php echo $wk_end_time3[0]; ?>" min="0" max="23">
              <span class="">:</span>
              <input type="number" class="text-center" name="wk_end_time3[1]" value="<?php echo $wk_end_time3[1]; ?>" min="0" max="59">
            </div>
          </td>
        </tr>

        <tr>
          <td><label>（２）重点</label></td>
        </tr>
        <tr>
          <td><label>i. 事務所並びに倉庫の火災、盗難等警戒警備、不法侵入者の警戒監視</label></td>
        </tr>
        <tr>
          <td><label>ii. 搬入車輛及び、外来者の適正誘導</label></td>
        </tr>

        <tr>
          <td><label>（３）実施</label></td>
        </tr>
        <tr>
          <td><label>i. 夜間巡回、警戒警備及び外周赤外線システムの監視</label></td>
        </tr>
        <tr>
          <td><label>ii. 事務所並びに倉庫の鍵の保管・管理</label></td>
        </tr>
        </table>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
      <table class="table table-borderless">
    

    </table>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <tr><label>警備員</label></tr>
          <tr>
            <?php for ($i=1;$i<=4;$i++) { ?>
            <td>
              <label><?php echo $title[$i-1]; ?></label>
              <select name="wk_staff_id<?php echo $i; ?>" id="wk_staff_id<?php echo $i; ?>" class="">
                <option value=""></option>
                <?php if ($i <= 2 && $wkdetail->oup_t_wk_detail_no) { ?>
                <?php for ($j=0;$j<count($wkdetail->oup_t_wk_detail_no);$j++) { ?>
                <option value="<?php echo $wkdetail->oup_t_wk_plan_kensyu[$j] == "1" ? $plan_kbn[$wkdetail->oup_t_wk_plan_kbn[$j]].$plan_ken[$wkdetail->oup_t_wk_plan_kensyu[$j]] : $plan_kbn[$wkdetail->oup_t_wk_plan_kbn[$j]] ; ?>,<?php echo $wkdetail->oup_t_wk_taiin_id[$j]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$j] == ${"wk_staff_id".$i} ? "selected" : "" ; ?>>
                  <?php echo $plan_kbn[$wkdetail->oup_t_wk_plan_kbn[$j]]; ?>
                  <?php echo $plan_ken[$wkdetail->oup_t_wk_plan_kensyu[$j]]; ?>
                  <?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$j]]; ?>
                </option>
                <?php } ?>
                <?php } elseif ($i > 2 && $wkdetail2->oup_t_wk_detail_no) { ?>
                <?php for ($j=0;$j<count($wkdetail2->oup_t_wk_detail_no);$j++) { ?>
                <option value="<?php echo $wkdetail2->oup_t_wk_plan_kensyu[$j] == "1" ? $plan_kbn[$wkdetail2->oup_t_wk_plan_kbn[$j]].$plan_ken[$wkdetail2->oup_t_wk_plan_kensyu[$j]] : $plan_kbn[$wkdetail2->oup_t_wk_plan_kbn[$j]] ; ?>,<?php echo $wkdetail2->oup_t_wk_taiin_id[$j]; ?>"<?php echo $wkdetail2->oup_t_wk_taiin_id[$j] == ${"wk_staff_id".$i} ? "selected" : "" ; ?>>
                  <?php echo $plan_kbn[$wkdetail2->oup_t_wk_plan_kbn[$j]]; ?>
                  <?php echo $plan_ken[$wkdetail2->oup_t_wk_plan_kensyu[$j]]; ?>
                  <?php echo $staff_name[$wkdetail2->oup_t_wk_taiin_id[$j]]; ?>
                </option>
                <?php } ?>
                <?php } ?>
              </select>
            </td>
            <?php } ?>
          </tr>
        </table>
      </div>
    </div>
    <hr>

      <div class="row">
      <div class="col-12">
      <table class="table table-borderless">
      <tr>
          <td><label>（時間外）</label></td>
        </tr>
        <tr>
          <td><label>人数</label><input type="text" name="offwk_count" id="" value="<?php echo $offwk_count; ?>"><label>&nbsp;部外者入門</label><input type="text" name="outsider" id="" value="<?php echo $outsider; ?>"></td>
        </tr>
        <!-- <tr>
          <td><label>部外者入門</label><input type="text" name="" id="" value=""></td>
        </tr> -->

      <tr>
          <td rowspan="5">
            <label>（備考）</label>
            <textarea name="comment" id="" class="w-100" cols="" rows="5" value="<?php echo $comment; ?>"><?php echo $comment; ?></textarea>
          </td>
      </tr>

        </table>
      </div>
    </div>
    <hr>


    <input type="hidden" name="no" value="<?php echo $no; ?>">
    <input type="hidden" name="act" value="">
    </form>

    
    <div class="row">
      <div class="col-12 text-right">（株）新神戸セキュリティ</div>
    </div>
    <br>

    <!-- <div class="row">
      <div class="col-4">
        <button type="button" class="btn btn-warning btn-block regist" role="button">一時保存</button>
      </div>
      <div class="col-4">
        <button type="button" class="btn btn-success btn-block regist" role="button">完了</button>
      </div>
      <div class="col-4">
        <button type="button" class="btn btn-secondary btn-block" role="button" onclick="location.href='report_menu.php'">戻る</button>
      </div>
    </div> -->
    <div class="row">
      <div class="col-4">
        <button type="button" class="btn btn-warning btn-block temp" role="button">一時保存</button>
      </div>
      <div class="col-4">
        <button type="button" class="btn btn-success btn-block regist" role="button">完了</button>
      </div>
      <div class="col-4">
        <?php if ($_SESSION["menu_flg"] == "kanri") { ?>
        <button type="button" class="btn btn-secondary btn-block" role="button" onclick="location.href='keibihokoku.php'">戻る</button>
        <?php } else { ?>
        <button type="button" class="btn btn-secondary btn-block" role="button" onclick="location.href='report_menu.php'">戻る</button>
        <?php } ?>
      </div>
    </div>

    <!-- ログアウト -->
    <!-- <div class="row">
      <div class="col-12">
        <form name="frm" method="POST" action="">
          <button class="btn btn-secondary btn-block" name="logout" role="button">ログアウト</button>
        </form>
      </div>
    </div> -->

  </div>
  <br>

  <div class="modal-footer"></div>
</body>

</html>
<script type="text/javascript">
  $('hr').css('border-top','1px solid #000')

  $('table td').addClass('p-0')

  $('.time').addClass('d-inline-block border border-dark')
  $('.time [type="number"]').addClass('p-0 border-0')
  $('.time [type="number"]').css('width','45px')

  $('.temp, .regist').click(function(){
    if (!confirm('この内容で登録します。よろしいですか？')) return false

    if ($(this).hasClass('temp')) {
      $('[name="act"]').val('2')
    } else {
      $('[name="act"]').val('1')
    }

    // Gチェックあればアラート
    $.ajax({
      url : "ajaxController.php",
      type:"post",
      data: {
        act: 'gchk',
        no: $('[name="start_date"]').val().replace(/-/g,'')+'6'
      },
      dataType:"json"
    }).done(function(data){
      if (data == '1') {
        alert('既にGチェック済のため登録できません。')
      } else {
        $('form').submit()
      }
    }).fail(function(data){
      alert('通信エラー')
    })
    
    // $('form').submit()
  })
</script>