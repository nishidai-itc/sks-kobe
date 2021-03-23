
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
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> -->

  <title>警備報告書</title>
</head>

<style>
.w-15{
  width: 15% !important;
}
</style>

<body>
  <div class="container">
    <!-- ヘッダー -->
    <!-- <div class="page-header">
      <br>
      <h2>TKUシステム</h2>
      <h4>メニュー</h4>
    </div> -->

    <!-- ログイン者情報 -->
    <!-- <div class="row">
      <div class="col-12">
        <div class="card" style="padding: 10px;">
          <div class="card-body"></div>
        </div>
      </div>
    </div>
    <br> -->

    <br>

    <form action="report11.php" method="post">
    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <tr>
            <td><label>（警備場所）</label></td>
            <td><label>（契約先）</label></td>
          </tr>
          <tr>
            <td><label>日本郵船神戸コンテナターミナル</label></td>
            <td><label>日本郵船株式会社　殿</label></td>
          </tr>
        </table>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <tr>
            <td><label>（勤務時間）</label></td>
            <td><label>天候</label></td>
            <td><label>担当警備士</label></td>
          </tr>

          <tr>
            <td>
              <label>
                <?php echo "自）".getYear($start_date)."年".getMonth($start_date)."月".getDay($start_date)."日　(".getWeek($start_date).")"; ?>
                <input type="hidden" name="start_date" value="<?php echo $start_date; ?>">
              </label>
              <div class="time">
                <input type="number" class="text-center" name="joban_time[0]" value="<?php echo $joban_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="joban_time[1]" value="<?php echo $joban_time[1]; ?>" min="0" max="59">
              </div>
            </td>
          </tr>

          <tr>
            <td>
              <label>
                <?php echo "至）".getYear($end_date)."年".getMonth($end_date)."月".getDay($end_date)."日　(".getWeek($end_date).")"; ?>
                <input type="hidden" name="end_date" value="<?php echo $end_date; ?>">
              </label>
              <div class="time">
                <input type="number" class="text-center" name="kaban_time[0]" value="<?php echo $kaban_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="kaban_time[1]" value="<?php echo $kaban_time[1]; ?>" min="0" max="59">
              </div>
            </td>
            <td rowspan="2">
              <?php for ($i=1;$i<=2;$i++) { ?>
              <select name="weather<?php echo $i; ?>" id="<?php echo "weather".$i; ?>" class="w-auto">
                <option value=""></option>
                <?php for ($j=0;$j<count($weathers);$j++) { ?>
                <option value="<?php echo $weathers[$j]; ?>"<?php echo $weathers[$j] == ${"weather".$i} ? "selected" : "" ; ?>><?php echo $weathers[$j]; ?></option>
                <?php } ?>
              </select>
              <?php } ?>
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
      <!-- 中央 -->
      <div class="col-12">
        <table class="table table-borderless">
          <tr>
            <td><label>巡回</label></td>
            <td><label>バース</label></td>
            <td><label>本船名</label></td>
            <!-- <td class="w-15"><label>入港</label></td>
            <td class="w-15"><label>出港</label></td> -->
            <td><label>入港</label></td>
            <td><label>出港</label></td>
          </tr>
          <?php for ($i=1;$i<=6;$i++) { ?>
          <tr>
            <td>
              <div class="time">
                <input type="number" class="text-center" name="patrol_time<?php echo $i; ?>[0]" value="<?php echo ${"patrol_time".$i}[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="patrol_time<?php echo $i; ?>[1]" value="<?php echo ${"patrol_time".$i}[1]; ?>" min="0" max="59">
              </div>
            </td>
            <td>
              <select name="bath<?php echo $i; ?>" id="bath<?php echo $i; ?>" class="">
                <option value=""></option>
                <?php for ($j=0;$j<count($baths);$j++) { ?>
                <option value="<?php echo $baths[$j]; ?>"<?php echo $baths[$j] == ${"bath".$i} ? "selected" : "" ; ?>><?php echo $baths[$j]; ?></option>
                <?php } ?>
              </select>
            </td>
            <td class="pr-3">
              <input type="text" name="sip<?php echo $i; ?>" class="w-100" value="<?php echo ${"sip".$i}; ?>">
            </td>
            <td>
              <input type="checkbox" class="check" <?php echo !is_array(${"in_port_time".$i}) && ${"in_port_time".$i} == "停泊" ? "checked" : ""; ?> value="<?php echo $i; ?>">
              <div class="d-inline-block">
                <span class="d-none">停泊</span>
                <div class="time">
                  <input type="number" class="text-center" name="in_port_time<?php echo $i; ?>[0]" value="<?php echo ${"in_port_time".$i}[0]; ?>" min="0" max="23">
                  <span class="">:</span>
                  <input type="number" class="text-center" name="in_port_time<?php echo $i; ?>[1]" value="<?php echo ${"in_port_time".$i}[1]; ?>" min="0" max="59">
                </div>
              </div>
            </td>
            <td>
              <input type="checkbox" class="check" <?php echo !is_array(${"out_port_time".$i}) && ${"out_port_time".$i} == "停泊" ? "checked" : ""; ?> value="<?php echo $i+5; ?>">
              <div class="d-inline-block">
                <span class="d-none">停泊</span>
                <div class="time">
                  <input type="number" class="text-center" name="out_port_time<?php echo $i; ?>[0]" value="<?php echo ${"out_port_time".$i}[0]; ?>" min="0" max="23">
                  <span class="">:</span>
                  <input type="number" class="text-center" name="out_port_time<?php echo $i; ?>[1]" value="<?php echo ${"out_port_time".$i}[1]; ?>" min="0" max="59">
                </div>
              </div>
            </td>
          </tr>
          <?php } ?>
        </table>
      </div>
    </div>
    <hr>

    <div class="row">
      <!-- 中央 -->
      <div class="col-12">
        <table class="table table-borderless">
          <!-- 実施 -->
          <tr>
            <td class="align-middle" rowspan="7">実<br>施</td>
            <td class="text-center" colspan="4"><label>立哨時間</label></td>
            <td colspan="4">
              <label>ヤード灯</label>
              <span>（</span>
              <?php /* ?>
              <select name="" id="">
                <option value=""></option>
                <?php for ($i=0;$i<count($yards);$i++) { ?>
                <option value="<?php echo $yards[$i]; ?>"<?php echo $yards[$i] == $yard ? "selected" : "" ; ?>><?php echo $yards[$i]; ?></option>
                <?php } ?>
              </select>
              <?php */ ?>
              <input type="checkbox" name="yard[]" value="作業" <?php echo in_array("作業",$yard) ? "checked" : "" ; ?>><label for="">作業</label>
              　<input type="checkbox" name="yard[]" value="常夜" <?php echo in_array("常夜",$yard) ? "checked" : "" ; ?>><label for="">常夜</label>　
              <input type="checkbox" name="yard[]" value="街路" <?php echo in_array("街路",$yard) ? "checked" : "" ; ?>><label for="">街路</label>
              <span>）</span>
            </td>
          </tr>
          <tr>
            <td class="text-center" colspan="2"><label>正面ゲート</label></td>
            <td colspan="2">
              <div class="time">
                <input type="number" class="text-center" name="front_gate_start_time[0]" value="<?php echo $front_gate_start_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="front_gate_start_time[1]" value="<?php echo $front_gate_start_time[1]; ?>" min="0" max="59">
              </div>
              <label class="">～</label>
              <div class="time">
                <input type="number" class="text-center" name="front_gate_end_time[0]" value="<?php echo $front_gate_end_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="front_gate_end_time[1]" value="<?php echo $front_gate_end_time[1]; ?>" min="0" max="59">
              </div>
            </td>
            <td colspan="4">
              <div class="time">
                <input type="number" class="text-center" name="yard1_start_time[0]" value="<?php echo $yard1_start_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="yard1_start_time[1]" value="<?php echo $yard1_start_time[1]; ?>" min="0" max="59">
              </div>
              <label class="">～</label>
              <div class="time">
                <input type="number" class="text-center" name="yard1_end_time[0]" value="<?php echo $yard1_end_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="yard1_end_time[1]" value="<?php echo $yard1_end_time[1]; ?>" min="0" max="59">
              </div>
              <label class="">/</label>
              <div class="time">
                <input type="number" class="text-center" name="yard2_start_time[0]" value="<?php echo $yard2_start_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="yard2_start_time[1]" value="<?php echo $yard2_start_time[1]; ?>" min="0" max="59">
              </div>
              <label class="">～</label>
              <div class="time">
                <input type="number" class="text-center" name="yard2_end_time[0]" value="<?php echo $yard2_end_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="yard2_end_time[1]" value="<?php echo $yard2_end_time[1]; ?>" min="0" max="59">
              </div>
            </td>
          </tr>
          <tr>
            <td class="text-center" colspan="2"><label>東ゲート</label></td>
            <td colspan="2">
              <div class="time">
                <input type="number" class="text-center" name="east_gate_start_time[0]" value="<?php echo $east_gate_start_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="east_gate_start_time[1]" value="<?php echo $east_gate_start_time[1]; ?>" min="0" max="59">
              </div>
              <label class="">～</label>
              <div class="time">
                <input type="number" class="text-center" name="east_gate_end_time[0]" value="<?php echo $east_gate_end_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="east_gate_end_time[1]" value="<?php echo $east_gate_end_time[1]; ?>" min="0" max="59">
              </div>
            </td>
            <td colspan="4"><label>カメラ操作状況</label></td>
          </tr>
          <tr>
            <td class="text-center" colspan="2"><label>西ゲート</label></td>
            <td colspan="2">
            <div class="time">
                <input type="number" class="text-center" name="west_gate_start_time[0]" value="<?php echo $west_gate_start_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="west_gate_start_time[1]" value="<?php echo $west_gate_start_time[1]; ?>" min="0" max="59">
              </div>
              <label class="">～</label>
              <div class="time">
                <input type="number" class="text-center" name="west_gate_end_time[0]" value="<?php echo $west_gate_end_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="west_gate_end_time[1]" value="<?php echo $west_gate_end_time[1]; ?>" min="0" max="59">
              </div>
            </td>
            <td colspan="2">
              <div class="time">
                <input type="number" class="text-center" name="cam_time[0]" value="<?php echo $cam_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="cam_time[1]" value="<?php echo $cam_time[1]; ?>" min="0" max="59">
              </div>
            </td>
            <td colspan="2">
              <input type="text" class="" name="cam_text" value="<?php echo $cam_text; ?>">
            </td>
          </tr>
          <tr>
            <td class="text-center" colspan="4"><label>残業者</label></td>
            <td colspan="4"><label>フェンス等の破損状況</label></td>
          </tr>
          <tr>
            <td class="text-right" colspan="2">
              <input type="number" class="text-center num" name="over_time_num" value="<?php echo $over_time_num; ?>" min="0">
              <label>名</label>
            </td>
            <td colspan="2">
              <label class="">（</label>
              <div class="time">
                <input type="number" class="text-center" name="over_start_time[0]" value="<?php echo $over_start_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="over_start_time[1]" value="<?php echo $over_start_time[1]; ?>" min="0" max="59">
              </div>
              <label class="">～</label>
              <div class="time">
                <input type="number" class="text-center" name="over_end_time[0]" value="<?php echo $over_end_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="over_end_time[1]" value="<?php echo $over_end_time[1]; ?>" min="0" max="59">
              </div>
              <label class="">）</label>
            </td>
            <td colspan="2">
              <div class="time">
                <input type="number" class="text-center" name="fence_time[0]" value="<?php echo $fence_time[0]; ?>" min="0" max="23">
                <span class="">:</span>
                <input type="number" class="text-center" name="fence_time[1]" value="<?php echo $fence_time[1]; ?>" min="0" max="59">
              </div>
            </td>
            <td colspan="2">
              <input type="text" class="" name="fence_text" value="<?php echo $fence_text; ?>">
            </td>
          </tr>
          <tr>
            <td colspan="4">
              <textarea name="over_time_name" id="" class="w-100" value="<?php echo $over_time_name; ?>" cols="" rows="2"><?php echo $over_time_name; ?></textarea>
            </td>
            <td colspan="4"></td>
          </tr>
          <!-- 備考 -->
          <tr>
            <td class="align-middle pr-3" rowspan="2">備<br>考</td>
            <td class="text-center" colspan="4"><label>税関入場</label></td>
            <td class="text-center" colspan="4"><label>作業ほか</label></td>
          </tr>
          <tr>
            <td colspan="4">
              <textarea name="etc_comment1" id="" rows="10" class="w-100" value="<?php echo $etc_comment1; ?>"><?php echo $etc_comment1; ?></textarea>
            </td>
            <td colspan="4">
              <textarea name="etc_comment2" id="" rows="10" class="w-100" value="<?php echo $etc_comment2; ?>"><?php echo $etc_comment2; ?></textarea>
            </td>
          </tr>
          
        </table>
      </div>

      <div class="col-12">
        <table class="table table-borderless">
          <!-- 勤務員 -->
          <?php for ($i=0;$i<3;$i++) { ?>
          <tr>
            <?php if ($i == 0) { ?>
            <td class="align-middle" rowspan="3">勤<br>務<br>員</td>
            <?php } ?>
            <td><label><?php echo "（".$plan_kbn[$i]."）"; ?></label></td>
            <?php for ($j=0;$j<6;$j++) { ?>
            <td>
              <select name="wk_staff_id<?php echo ($j+1)+$i*6; ?>" id="wk_staff_id<?php echo ($j+1)+$i*6; ?>" class="w-75">
                <option value=""></option>
                <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
                <?php for ($k=0;$k<count($wkdetail->oup_t_wk_detail_no);$k++) { ?>
                  <?php if ($wkdetail->oup_t_wk_plan_kbn[$k] == $i+1) { ?>
                  <option value="<?php echo $wkdetail->oup_t_wk_taiin_id[$k]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$k] == ${"wk_staff_id".(($j+1)+($i*6))} ? "selected" : "" ; ?>>
                    <?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$k]]; ?>
                  </option>
                  <?php } ?>
                <?php } ?>
                <?php } ?>
              </select>
            </td>
            <?php } ?>
          </tr>
          <?php } ?>
        </table>
      </div>
    </div>
    <hr>

    <input type="hidden" name="no" value="<?php echo $no; ?>">
    <!-- <input type="hidden" name="plan_date" value="<?php echo $plan_date; ?>"> -->
    <input type="hidden" name="act" value="">
    </form>

    <div class="row">
      <div class="col-12 text-right">（株）新神戸セキュリティ</div>
    </div>
    <br>

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
  var width
  window.onload = function() {
    width = $(window).width()
    if (width < 770) {
      changeWidth('20px')
    } else {
      changeWidth('45px')
    }
  }
  function changeWidth(num) {
    $('.time [type="number"]').css('width',num)
  }

  $(window).resize(function(){
    width = $(window).width()
    if (width < 770) {
      changeWidth('20px')
    } else {
      changeWidth('45px')
    }
  })

  $('hr').css('border-top','1px solid #000')

  $('table td').addClass('p-0')

  $('.time').addClass('d-inline-block border border-dark')
  $('.time [type="number"]').addClass('p-0 border-0')
  // $('.time [type="number"]').css('width',num)
  $('.num').css('width','45px')

  $('.num').addClass('p-0')

  // 入港、出港チェックボックス
  var div
  function winLoad() {
    div = {}
    $('.check').each(function(key,value){
      // console.log(this)
      if ($(this).prop('checked')) {
        $(this).next().children().eq(0).removeClass('d-none')
        div['div'+$(this).val()] = $(this).next().children().eq(1).remove()
      }
    })
  }
  winLoad()
  $('.check').change(function(){
    // console.log($(this).prop('checked'))
    if ($(this).prop('checked')) {
      // var div = $(this).parent().children('div').children()
      // $(this).parent().children('div').empty()
      // $(this).parent().children('div').text('停泊')

      // $(this).parent().children('div').children().eq(1).addClass('d-none')
      // $(this).parent().children('div').children().eq(2).addClass('d-none')
      // $(this).parent().children('div').children().eq(3).addClass('d-none')
      // $(this).parent().children('div').children().eq(0).removeClass('d-none')

      $(this).next().children().eq(0).removeClass('d-none')
      // $(this).next().children().eq(1).addClass('d-none')
      // $(this).next().children().eq(1).children().addClass('d-none')
      div['div'+$(this).val()] = $(this).next().children().eq(1).remove()
    } else {
      // $(this).parent().children('div').empty()
      // $(this).parent().children('div').append($('<input/>',{
      //   type:"number",
      //   class:"text-center",
      //   value:"",
      //   min:"0",
      //   max:"23",
      //   width:'40px'
      // }),$('<span/>',{
      //   text:":"
      // }),$('<input/>',{
      //   type:"number",
      //   class:"text-center",
      //   value:"",
      //   min:"0",
      //   max:"23",
      //   width:'40px'
      // }))

      // $(this).parent().children('div').children().eq(0).addClass('d-none')
      // $(this).parent().children('div').children().eq(1).removeClass('d-none')
      // $(this).parent().children('div').children().eq(2).removeClass('d-none')
      // $(this).parent().children('div').children().eq(3).removeClass('d-none')

      $(this).next().children().eq(0).addClass('d-none')
      // $(this).next().children().eq(1).removeClass('d-none')
      // $(this).next().children().eq(1).children().removeClass('d-none')
      $(this).next().append(div['div'+$(this).val()])
    }
  })

  $('.temp, .regist').click(function(){
    if (!confirm('この内容で登録します。よろしいですか？')) return false

    // $('.check').each(function(key,value) {
    //   if ($(this).prop('checked')) {
    //     $('<input>',{
    //       type:'hidden',
    //       name:'out_port_time'+$(this).val(),
    //       value:'99:99'
    //     }).appendTo($('form'))
    //   }
    // }
    
    if ($(this).hasClass('temp')) {
      $('[name="act"]').val('2')
    } else {
      $('[name="act"]').val('1')
    }
    
    $('form').submit()
  })
</script>