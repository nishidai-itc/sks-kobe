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
input.hoge { width: 50%; }
</style>

<body>
  <div class="container">
    <br>
    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <tr>
            <td><label>（業務名）</label></td>
            <td><label>（契約先）</label></td>
          </tr>

          <tr>
            <td><label>RC4/5ターミナルに係る待機場車両誘導業務</label></td>
            <td><label>阪神国際港湾株式会社　御中</label></td>
          </tr>
        </table>
      </div>
    </div>
    <hr>

    <form action="report10.php" method="post">
    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <tr>
            <td><label>（勤務時間）</label></td>
            <td><label>天候</label></td>
            <td><label></label></td>
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
            <!-- <td rowspan="2">
              <select name="staff_id" id="staff_id" class="w-50">
                <option value=""></option>
                <?php if ($staff2->oup_m_staff_id) { ?>
                <?php for ($i=0;$i<count($staff2->oup_m_staff_id);$i++) { ?>
                <option value="<?php echo $staff2->oup_m_staff_id[$i]; ?>"<?php echo $staff2->oup_m_staff_id[$i] == $staff_id ? "selected" : "" ; ?>><?php echo $staff_name[$staff2->oup_m_staff_id[$i]]; ?></option>
                <?php } ?>
                <?php } ?>
              </select>
            </td> -->
          </tr>
        </table>
      </div>
    </div>
    <hr>

    <div class="row">
     <div class="col-12">
      <table class="table table-borderless">
        <tr>
          <td>最大待機台数</td>
          <td>マースク返バン</td>
          <td>待機場A</td> 
          <td>待機場B</td>
          <td>待機場B場外</td>
        </tr>
        <?php for ($i=1;$i<=4;$i++) { ?>
          <tr>
            <td><?php echo $times[$i];?></td>
            <td><input type="text" name="marsk_number<?php echo $i; ?>" class="hoge" value="<?php echo ${"marsk_number".$i}; ?>"></td>
            <td><input type="text" name="wait_anumber<?php echo $i; ?>" class="hoge" value="<?php echo ${"wait_anumber".$i}; ?>"></td>
            <td><input type="text" name="wait_bnumber<?php echo $i; ?>" class="hoge" value="<?php echo ${"wait_bnumber".$i}; ?>"></td>
            <td><input type="text" name="wait_outside<?php echo $i; ?>" class="hoge" value="<?php echo ${"wait_outside".$i}; ?>"></td>
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
    
    <tr>
     <td><label>本船寄港/MAERSK</label>
     
     <select name="in_port1" id="in_port1" class="">
        <option value=""></option>
        <?php for ($i=1;$i<=count($in_port);$i++) { ?>
        <option value="<?php echo $i; ?>"<?php echo $i == $in_port1 ? "selected" : "" ; ?>><?php echo $in_port[$i]; ?></option>
        <?php } ?>
      </select>
     </td>
     <td><label>本船寄港/K-LINE</label>
     <select name="in_port2" id="in_port2" class="">
        <option value=""></option>
        <?php for ($i=1;$i<=count($in_port);$i++) { ?>
        <option value="<?php echo $i; ?>"<?php echo $i == $in_port2 ? "selected" : "" ; ?>><?php echo $in_port[$i]; ?></option>
        <?php } ?>
      </select>
     </td>

    </tr>

    <tr>
     <td><label>発生要因</label><input type="text" name="facter" class="" value="<?php echo $facter; ?>"></td>
    </tr>

    </table>
      </div>
    </div>

    <tr>
      <td>備考</td>
    </tr>
    <tr>
      <td>
        <textarea name="comment" id="" rows="10" class="w-100" value="<?php echo $comment;?>"><?php echo $comment;?></textarea>
      </td>
    </tr>


  

  
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
    </div>    <!-- ログアウト -->
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
        no: $('[name="start_date"]').val().replace(/-/g,'')+'10'
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