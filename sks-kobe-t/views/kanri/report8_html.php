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
            <td>（警備場所）</td>
            <td>（契約先）</td>
          </tr>

          <tr>
            <td>RIC-4・C-5に係る待機場A</td>
            <td>三菱倉庫株式会社・川崎汽船株式会社　殿</td>
          </tr>
        </table>
      </div>
    </div>
    <hr>

    <form action="report13.php" method="post">
    <div class="row">
      <div class="col-12">
        <table class="table table-borderless">
          <tr>
            <td>（勤務時間）</td>
            <td>天候</td>
            <td>担当警備士</td>
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
                <?php if ($staff2->oup_m_staff_id) { ?>
                <?php for ($i=0;$i<count($staff2->oup_m_staff_id);$i++) { ?>
                <option value="<?php echo $staff2->oup_m_staff_id[$i]; ?>"<?php echo $staff2->oup_m_staff_id[$i] == $staff_id ? "selected" : "" ; ?>><?php echo $staff_name[$staff2->oup_m_staff_id[$i]]; ?></option>
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
          <td><label>i.　待機場A　稼働時間</label></td>
          <td>
            <div class="time">
              <input type="number" class="text-center" name="wk_start_time[0]" value="<?php echo $wk_start_time[0]; ?>" min="0" max="23">
              <span class="">:</span>
              <input type="number" class="text-center" name="wk_start_time[1]" value="<?php echo $wk_start_time[1]; ?>" min="0" max="59">
            </div>
            <label for="">～</label>
            <div class="time">
              <input type="number" class="text-center" name="wk_end_time[0]" value="<?php echo $wk_end_time[0]; ?>" min="0" max="23">
              <span class="">:</span>
              <input type="number" class="text-center" name="wk_end_time[1]" value="<?php echo $wk_end_time[1]; ?>" min="0" max="59">
            </div>
          </td>
        </tr>
        
        <tr>
        <td>
         ii. 作業結果(警備中における異常の有無) 
              <select name="" id="" class="">
                <option value=""></option>
                <?php for ($i=1;$i<=count($gate);$i++) { ?>
                <option value="<?php echo $i; ?>"<?php echo $i == $gate_flg ? "selected" : "" ; ?>><?php echo $gate[$i]; ?></option>
                <?php } ?>
              </select>
        </td>
       </tr>

      </table>
      </div>
    </div>
    <hr>

    <tr>
          <td><label>（１）状況</label></td>
          <td><label>i.　待機場A　稼働時間</label></td>
          <td>
            <div class="time">
              <input type="number" class="text-center" name="wk_start_time[0]" value="<?php echo $wk_start_time[0]; ?>" min="0" max="23">
              <span class="">:</span>
              <input type="number" class="text-center" name="wk_start_time[1]" value="<?php echo $wk_start_time[1]; ?>" min="0" max="59">
            </div>
            <label for="">～</label>
            <div class="time">
              <input type="number" class="text-center" name="wk_end_time[0]" value="<?php echo $wk_end_time[0]; ?>" min="0" max="23">
              <span class="">:</span>
              <input type="number" class="text-center" name="wk_end_time[1]" value="<?php echo $wk_end_time[1]; ?>" min="0" max="59">
            </div>
          </td>
        </tr>
        <tr>
        <td>
        
        </td>
        </tr>




    <div class="row">
    　<div class="col-12">１.状況 </div>
      <div class="col-12">i.　待機場A　稼働時間　　<input type="time" class="" value="08:00">～<input type="time" class="" value="17:00"></div>
      <div class="col-12">ii. 作業結果(警備中における異常の有無)  　<input type="text" value="無し"><br>　　　　　　　　　　　　　　　　　　※「有」の場合、別途報告書提出</div>
    </div>
    <hr>

    <div class="row">
      <div class="col-12">２.重点</div>
      <div class="col-12">i. 　待機場Aに侵入、待機、出場するコンテナ車両に対する交通誘導</div>
      <div class="col-12">ii.　待機場Aと交差して、C5ゲートを出場する車両全般の安全確保</div>
      <div class="col-12">iii. その他</div>
    </div>
    <hr>

    <div class="row">
      <div class="col-12">３.実施</div>
      <div class="col-12">i. 　交差点「甲南大学前」における、待機場Aへ向かうコンテナ車両に対する交通誘導</div>
      <div class="col-12">ii.　待機場Aに侵入するコンテナ車両と交差して、C５ゲートから出場する　車両の交通誘導</div>
      <div class="col-12">iii. 　待機場Aに侵入するコンテナ車両の交通誘導</div>
      <div class="col-12">iⅴ. 東サブゲートに侵入するコンテナ車両と交差して、待機場A内を通過するコンテナ車両の<br> 交通誘導</A></div>
      <div class="col-12">ⅴ.  　待機場Aを出場するコンテナ車両の交通誘導</div>
      <div class="col-12">ⅴi. その他</div>

    </div>
    <hr>

    <div class="row">
    <div class="col-2">警備員</div>
       <div class="col-2">
      A <input type="text" value="崎山"> E <input type="text" value="">
      </div>
      <div class="col-2">
      B <input type="text" value="合田"> F <input type="text" value="">
      </div>
      <div class="col-2">
      C <input type="text" value="松本"> G <input type="text" value="">
      </div>
      <div class="col-2">
      D <input type="text" value="北篠"> H <input type="text" value="">
      </div>
      <div class="col-2">
      </div>


    </div>
    <hr>

    
    <div class="row">
      <div class="col-1 m-auto">備<br>考</div>
      <div class="col-11">
        <textarea name="" id="" rows="5" class="form-control"></textarea>
      </div>
    </div>
    <hr>

    <div class="row">
      <div class="col-12 text-right">（株）新神戸セキュリティ</div>
    </div>
    <br>

    <div class="row">
      <div class="col-4">
        <button type="button" class="btn btn-warning btn-block regist" role="button">一時保存</button>
      </div>
      <div class="col-4">
        <button type="button" class="btn btn-success btn-block regist" role="button">完了</button>
      </div>
      <div class="col-4">
        <button type="button" class="btn btn-secondary btn-block" role="button" onclick="location.href='report_menu.php'">戻る</button>
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
  // $('.col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12').addClass('border')
  // $('.row').css({
  //   'border-bottom':'1px solid #000' 
  // })
  $('hr').css('border-top','1px solid #000')
</script>