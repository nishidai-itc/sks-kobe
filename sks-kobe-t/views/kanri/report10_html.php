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
/* .table-bordered td{
  border: 1px solid #000;
} */
.col-1,
.col-2,
.col-3,
.col-4,
.col-5,
.col-6,
.col-7,
.col-8,
.col-9,
.col-10,
.col-11,
.col-12,{
  border: 1px solid #000 !important;
}
.w-20{
  width: 20%;
}
.w-5{
  width: 5%;
}
.w-3{
  width: 3%;
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
    <div class="row">
      <div class="col-12">
        <div>業務名</div>
        <div style="font-size: 1.5em;">RC4/5ターミナルに係る待機車両誘導業務</div>
      </div>
    </div>
    <hr>

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
          <?php echo "自）".$dates[0]."年".$dates[1]."月".$dates[2]."日　(".$week[$w].")"; ?>
          <input type="number" class="text-center" value="<?php echo $joban_time[0]; ?>" min="0" max="23">
          <span class="">:</span>
          <input type="number" class="text-center" value="<?php echo $joban_time[1]; ?>" min="0" max="59">
        </td>
      </tr>
      <tr>
        <td>
          <?php echo "至）".$dates2[0]."年".$dates2[1]."月".$dates2[2]."日　(".$week[$w2].")"; ?>
          <input type="number" class="text-center" value="<?php echo $kaban_time[0]; ?>" min="0" max="23">
          <span class="">:</span>
          <input type="number" class="text-center" value="<?php echo $kaban_time[1]; ?>" min="0" max="59">
        </td>
        <td rowspan="2">
          <select name="" id="" class="">
            <option value=""></option>
            <?php for ($i=1;$i<count($weathers)+1;$i++) { ?>
            <option value="<?php echo $i; ?>"<?php echo $i == $weather ? "selected" : "" ; ?>><?php echo $weathers[$i]; ?></option>
            <?php } ?>
          </select>
          <select name="" id="" class="">
            <option value=""></option>
            <?php for ($i=1;$i<count($weathers)+1;$i++) { ?>
            <option value="<?php echo $i; ?>"<?php echo $i == $weather ? "selected" : "" ; ?>><?php echo $weathers[$i]; ?></option>
            <?php } ?>
          </select>
        </td>
        <td rowspan="2">
          <select name="" id="" class="">
            <option value=""></option>
            <?php /*if ($staff2->oup_m_staff_id) { ?>
            <?php for ($i=0;$i<count($staff2->oup_m_staff_id);$i++) { ?>
            <option value="<?php echo $staff2->oup_m_staff_id[$i]; ?>"<?php echo $staff2->oup_m_staff_id[$i] == $staff_id ? "selected" : "" ; ?>><?php echo $staff2->oup_m_staff_name[$i]; ?></option>
            <?php } ?>
            <?php }*/ ?>
          </select>
        </td>
      </tr>
    </table>
  </div>
</div>
<hr>

<div class="row">
    <table class="table table-bordered" id="">
    <thead class="thead-light">

    <colgroup>
                  <col>
                  <col>
                  <col>
                  <col width="20">
                  <col width="20">
    </colgroup>


                  <tr>
                    <th>最大待機台数</th>
                    <th>マースク返バン</th>
                    <th>待機場A</th> 
                    <th>待機場B</th>
                    <th>待機場B場外</th>
                  </tr>
    </thead>
    <tbody>
                  <tr>
                    <td><input type="time" name="" class="" value=""></td>
                    <td><input type="text" name="" class="" value=""></td>
                    <td><input type="text" name="" class="" value=""></td>
                    <td><input type="text" name="" class="" value=""></td>
                    <td><input type="text" name="" class="" value=""></td>
                  </tr>
                  <tr>
                  <td><input type="time" name="" class="" value=""></td>
                    <td><input type="text" name="" class="" value=""></td>
                    <td><input type="text" name="" class="" value=""></td>
                    <td><input type="text" name="" class="" value=""></td>
                    <td><input type="text" name="" class="" value=""></td>
                  </tr>

                  <tr>
                  <td><input type="time" name="" class="" value=""></td>
                    <td><input type="text" name="" class="" value=""></td>
                    <td><input type="text" name="" class="" value=""></td>
                    <td><input type="text" name="" class="" value=""></td>
                    <td><input type="text" name="" class="" value=""></td>
                  </tr>

                  <tr>
                  <td><input type="time" name="" class="" value=""></td>
                    <td><input type="text" name="" class="" value=""></td>
                    <td><input type="text" name="" class="" value=""></td>
                    <td><input type="text" name="" class="" value=""></td>
                    <td><input type="text" name="" class="" value=""></td>
                  </tr>

                </tbody>
              </table>
    </div>
    <hr>




    
    
    <div class="row">
     <div class="col-12">本船寄港　<input type="text" class="" value="無"><br>　　　　　<input type="text" class="" value="有"></div>
    </div>
    <hr>

    <div class="row">
     <div class="col-12">発生要因　<input type="text" class="" value="自然"></div>
    </div>
    <hr>
    
    <div class="row">
      <div class="col-1 m-auto">備考</div>
      <div class="col-11">
        <textarea name="" id="" rows="5" class="form-control"></textarea>
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
    $('hr').css('border-top','1px solid #000')
</script>