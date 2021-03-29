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
            <td><label>RIC-4・C-5に係る待機場B</label></td>
            <td><label>三菱倉庫株式会社・川崎汽船株式会社　殿</label></td>
          </tr>
        </table>
      </div>
    </div>
    <hr>

    <form action="report9.php" method="post">
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
            <td><label>１. 状況</label></td>
        </tr>
        <tr>
            <td><label>i.　待機場B　稼働時間</label></td>
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
           <td>
              ii. 作業結果(警備中における異常の有無) 
              <select name="result1" id="" class="">
                <option value=""></option>
                <?php for ($i=1;$i<=count($result);$i++) { ?>
                <option value="<?php echo $i; ?>"<?php echo $i == $result1 ? "selected" : "" ; ?>><?php echo $result[$i]; ?></option>
                <?php } ?>
              </select>
          </td>
       </tr>

      </table>
      </div>
    </div>

    <div class="row">
    <div class="col-12">
      <table class="table table-borderless">

      <tr>
            <td><label>２.重点</label></td>
      </tr>
      <tr><td><label>i. 待機場Bに進入、待機、出場するコンテナ車両に対する交通誘導</label></td></tr>
      <tr><td><label>ii.待機場Bから退場するコンテナ車両と歩行者に注意する</label></td></tr>
      <tr><td><label>iii. その他</label></td></tr>




      <tr>
            <td><label>３.実施</label></td>
      </tr>

      <tr><td><label>i.待機場Bの車両整理と、待機場Aへ向かうコンテナ車両の交通誘導</label></td></tr>
      <tr><td><label>ii.待機場Bに一時待機するコンテナ車両と歩行者に注意する</label></td></tr>
      <tr><td><label>iii.待機場Bに進入、出場するコンテナ車両の交通誘導</label></td></tr>
      <tr><td><label>iⅴ.その他</label></td></tr>

    

    </table>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-12">
      <table class="table table-borderless">

　　  <tr>
      <td rowspan="5" class="align-middle">勤<br>務<br>員</td>
          <td>
            <label>A</label>
            <select name="wk_staff_id1" id="wk_staff_id1" class="w-50">
              <option value=""></option>
              <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
              <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { ?>
              <option value="<?php echo $wkdetail->oup_t_wk_taiin_id[$i]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$i] == $wk_staff_id1 ? "selected" : "" ; ?>><?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$i]]; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
          </td>
          <td>
            <label>B</label>
            <select name="wk_staff_id2" id="wk_staff_id2" class="w-50">
              <option value=""></option>
              <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
              <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { ?>
              <option value="<?php echo $wkdetail->oup_t_wk_taiin_id[$i]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$i] == $wk_staff_id2 ? "selected" : "" ; ?>><?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$i]]; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
          </td>
          <td>
            <label>C</label>
            <select name="wk_staff_id3" id="wk_staff_id3" class="w-50">
            <option value=""></option>
              <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
              <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { ?>
              <option value="<?php echo $wkdetail->oup_t_wk_taiin_id[$i]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$i] == $wk_staff_id3 ? "selected" : "" ; ?>><?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$i]]; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
          </td>
          <td>
            <label>D</label>
            <select name="wk_staff_id4" id="wk_staff_id4" class="w-50">
            <option value=""></option>
              <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
              <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { ?>
              <option value="<?php echo $wkdetail->oup_t_wk_taiin_id[$i]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$i] == $wk_staff_id4 ? "selected" : "" ; ?>><?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$i]]; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
          </td>
       </tr>
       <tr>

       <td>
            <label>E</label>
            <select name="wk_staff_id5" id="wk_staff_id5" class="w-50">
            <option value=""></option>
              <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
              <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { ?>
              <option value="<?php echo $wkdetail->oup_t_wk_taiin_id[$i]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$i] == $wk_staff_id5 ? "selected" : "" ; ?>><?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$i]]; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
          </td>
          <td>
            <label>F</label>
            <select name="wk_staff_id6" id="wk_staff_id6" class="w-50">
            <option value=""></option>
              <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
              <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { ?>
              <option value="<?php echo $wkdetail->oup_t_wk_taiin_id[$i]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$i] == $wk_staff_id6 ? "selected" : "" ; ?>><?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$i]]; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
          </td>
          <td>
            <label>G</label>
            <select name="wk_staff_id7" id="wk_staff_id7" class="w-50">
            <option value=""></option>
              <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
              <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { ?>
              <option value="<?php echo $wkdetail->oup_t_wk_taiin_id[$i]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$i] == $wk_staff_id7 ? "selected" : "" ; ?>><?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$i]]; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
          </td>
          <td>
            <label>H</label>
            <select name="wk_staff_id8" id="wk_staff_id8" class="w-50">
            <option value=""></option>
              <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
              <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { ?>
              <option value="<?php echo $wkdetail->oup_t_wk_taiin_id[$i]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$i] == $wk_staff_id8 ? "selected" : "" ; ?>><?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$i]]; ?></option>
              <?php } ?>
              <?php } ?>
            </select>
          </td>

       </tr>
       <tr>

<td>
     <label>I</label>
     <select name="wk_staff_id9" id="wk_staff_id9" class="w-50">
     <option value=""></option>
          <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
          <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { ?>
          <option value="<?php echo $wkdetail->oup_t_wk_taiin_id[$i]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$i] == $wk_staff_id9 ? "selected" : "" ; ?>><?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$i]]; ?></option>
          <?php } ?>
          <?php } ?>
     </select>
   </td>
   <td>
     <label>J</label>
     <select name="wk_staff_id10" id="wk_staff_id10" class="w-50">
     <option value=""></option>
          <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
          <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { ?>
          <option value="<?php echo $wkdetail->oup_t_wk_taiin_id[$i]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$i] == $wk_staff_id10 ? "selected" : "" ; ?>><?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$i]]; ?></option>
          <?php } ?>
          <?php } ?>
     </select>
   </td>
   <td>
     <label>K</label>
     <select name="wk_staff_id11" id="wk_staff_id11" class="w-50">
     <option value=""></option>
          <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
          <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { ?>
          <option value="<?php echo $wkdetail->oup_t_wk_taiin_id[$i]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$i] == $wk_staff_id11 ? "selected" : "" ; ?>><?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$i]]; ?></option>
          <?php } ?>
          <?php } ?>
     </select>
   </td>
   <td>
     <label>L</label>
     <select name="wk_staff_id12" id="wk_staff_id12" class="w-50">
     <option value=""></option>
          <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
          <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { ?>
          <option value="<?php echo $wkdetail->oup_t_wk_taiin_id[$i]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$i] == $wk_staff_id12 ? "selected" : "" ; ?>><?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$i]]; ?></option>
          <?php } ?>
          <?php } ?>
     </select>
   </td>

</tr>

<tr>

<td>
     <label>M</label>
     <select name="wk_staff_id13" id="wk_staff_id13" class="w-50">
     <option value=""></option>
          <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
          <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { ?>
          <option value="<?php echo $wkdetail->oup_t_wk_taiin_id[$i]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$i] == $wk_staff_id13 ? "selected" : "" ; ?>><?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$i]]; ?></option>
          <?php } ?>
          <?php } ?>
     </select>
   </td>
   <td>
     <label>N</label>
     <select name="wk_staff_id14" id="wk_staff_id14" class="w-50">
     <option value=""></option>
          <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
          <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { ?>
          <option value="<?php echo $wkdetail->oup_t_wk_taiin_id[$i]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$i] == $wk_staff_id14 ? "selected" : "" ; ?>><?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$i]]; ?></option>
          <?php } ?>
          <?php } ?>
     </select>
   </td>
   <td>
     <label>O</label>
     <select name="wk_staff_id15" id="wk_staff_id15" class="w-50">
     <option value=""></option>
          <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
          <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { ?>
          <option value="<?php echo $wkdetail->oup_t_wk_taiin_id[$i]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$i] == $wk_staff_id15 ? "selected" : "" ; ?>><?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$i]]; ?></option>
          <?php } ?>
          <?php } ?>
     </select>
   </td>
   <td>
     <label>P</label>
     <select name="wk_staff_id16" id="wk_staff_id16" class="w-50">
     <option value=""></option>
          <?php if ($wkdetail->oup_t_wk_detail_no) { ?>
          <?php for ($i=0;$i<count($wkdetail->oup_t_wk_detail_no);$i++) { ?>
          <option value="<?php echo $wkdetail->oup_t_wk_taiin_id[$i]; ?>"<?php echo $wkdetail->oup_t_wk_taiin_id[$i] == $wk_staff_id16 ? "selected" : "" ; ?>><?php echo $staff_name[$wkdetail->oup_t_wk_taiin_id[$i]]; ?></option>
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
      <div class="col-1 m-auto">備<br>考</div>
      <div class="col-11">
        <textarea name="comment" id="" rows="5" class="form-control" value="<?php echo $comment; ?>"><?php echo $comment; ?></textarea>
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
        no: $('[name="start_date"]').val().replace(/-/g,'')+'9'
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