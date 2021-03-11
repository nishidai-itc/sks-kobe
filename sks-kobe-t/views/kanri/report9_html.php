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
    　<div class="col-12">１.状況 </div>
      <div class="col-12">i.　待機場B　　<Base></Base>早出<input type="time" class="" value="07:00">～<input type="time" class="" value="16:00">　　　　　<input type="time" class="" value="08:00">～<input type="time" class="" value="17:00"></div>
      <div class="col-12">ii. 作業結果(警備中における異常の有無)  　<input type="text" value="無し"><br>　　　　　　　　　　　　　　　　　　　※「有」の場合、別途報告書提出</div>
    </div>
    <hr>

    <div class="row">
      <div class="col-12">２.重点</div>
      <div class="col-12">i. 　待機場Bに侵入、待機、出場するコンテナ車両に対する交通誘導</div>
      <div class="col-12">ii.　待機場Bから退場するコンテナ車両と歩行者に注意する</div>
      <div class="col-12">iii. 　その他</div>
    </div>
    <hr>

    <div class="row">
      <div class="col-12">３.実施</div>
      <div class="col-12">i.   　待機場Bの車両整理と、待機場Aへ向かうコンテナ車両の交通誘導</div>
      <div class="col-12">ii.　待機場Bに一時待機するコンテナ車両と歩行者に注意する</div>
      <div class="col-12">iii. 待機場Bに進入、出場するコンテナ車両の交通誘導</div>
      <div class="col-12">iⅴ. その他</div>

    </div>
    <hr>

    <div class="row">
    <div class="col-2 m-auto">警<br>備<br>員</div>
       <div class="col-2">
      A <input type="text" value="早出　鈴木"> E <input type="text" value="松田"> I <input type="text" value="河内">
      </div>
      <div class="col-2">
      B <input type="text" value="WFS 酒井"> F <input type="text" value="川原"> J <input type="text" value="矢部">
      </div>
      <div class="col-2">
      C <input type="text" value="WFS 井上"> G <input type="text" value="井上"> K <input type="text" value="熊本">
      </div>
      <div class="col-2">
      D <input type="text" value="西浦"> H <input type="text" value="鈴木"> L <input type="text" value="徳永">
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