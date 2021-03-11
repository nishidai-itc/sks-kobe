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
        <td>RIC-5・CFS</td>
        <td>三菱倉庫株式会社　御中</td>
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
      <div class="col-12">i.　　C－５　CFSゲート立哨　　<input type="time" class="" value="07:30">　～　<input type="time" class="" value="18:00"></div>
      <div class="col-12">ii.　　搬入出車輛　　　　　　　<input type="time" class="" value="07:30">　～　<input type="time" class="" value="18:00"></div>
      <div class="col-12">iii. 　CFSゲート解錠及び施錠 　　<input type="time" class="" value="07:30">　～　<input type="time" class="" value="18:00"></div>
    </div>
    <hr>

    <div class="row">
      <div class="col-12">２.重点</div>
      <div class="col-12">i. 事務所並びに倉庫の火災、盗難等警戒警備、不法侵入者の警戒監視</div>
      <div class="col-12">ii. 搬入車輛及び、外来者の適正誘導</div>
    </div>
    <hr>

    <div class="row">
      <div class="col-12">３.実施</div>
      <div class="col-12">i. 夜間巡回、警戒警備及び外周赤外線システムの監視</div>
      <div class="col-12">ii. 事務所並びに倉庫の鍵の保管・管理</div>
    </div>
    <hr>

    <div class="row">
    <div class="col-12">◆巡回</div>
       <div class="col-2">
      <input type="time" value=""><input type="time" value=""> <input type="time" value="">
      </div>

      <div class="col-2">
      <input type="time" value=""><input type="time" value=""><input type="time" value=""> 
      </div>
      <div class="col-2">
      <input type="time" value=""><input type="time" value=""> <input type="time" value="">
      </div>
      <div class="col-2">
      <input type="time" value=""><input type="time" value=""> <input type="time" value="">
      </div>
      <div class="col-2">
       <input type="time" value=""><input type="time" value="">
      </div>
      <div class="col-2">
      <input type="time" value=""><input type="time" value="">
      </div>

    </div>
    <hr>

    <div class="row">
      <div class="col-12">時間外　　　<input type="text" value="2名">　部外者入門　<input type="text" value="6名"></div>
      &nbsp;
      <div class="col-12">勤務者　　　<input type="text" value="陣野">　<input type="text" value="中根">　<input type="text" value=""></div>
      <div class="col-12">　　　　　　<input type="text" value="">　<input type="text" value="">　<input type="text" value=""></div>
      <div class="col-12">　　　　　　<input type="text" value="">　<input type="text" value="">　<input type="text" value=""></div>

    </div>
    <hr>

    <div class="row">
      <div class="col-1 m-auto">備<br>考</div>
      <div class="col-11">
        <textarea name="" id="" rows="5" class="form-control">巡回点検警備その他服務中異常ありません</textarea>
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