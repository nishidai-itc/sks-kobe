<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">
  <title>勤怠管理システム</title>

  <!-- bootstrap-4.3.1 -->
  <link href="./../bootstrap-4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <script src="./../bootstrap-4.3.1/jquery-3.4.1.min.js"></script>
  <script src="./../bootstrap-4.3.1/js/bootstrap.bundle.min.js"></script>

  <!-- floatThead -->
  <script type="text/javascript" src="./../lib/jquery.floatThead.js"></script>

  <script>
  // ライブラリの使用
  // $(function() {
  //   $('#date-table').floatThead(); // 日
  //   $('#time-table').floatThead(); // 時間
  // });
  </script>

  <style>
  /* タブ(日, 時間)のstyle */
  .nav-tabs .nav-item.show .nav-link,
  .nav-tabs .nav-link.active {
    color: #721c24;
    background-color: #ffeeba;
    border-color: #dee2e6;
  }
  </style>
</head>

<body>
  <div class="container">
    <div class="page-header">
      <h4>勤務予定表集計</h4>
    </div>

    <form name="frm" method="POST" action="shukei.php">

      <div class="row">
        <div class="col-12">
          <table class="table table-sm table-bordered">
            <tr>
              <td width="130" class="table-warning text-center">日付</td>
              <td width="300">
                <input type="tel" name="targetday" class="form-control form-control-sm" maxlength="6"
                  value="<?php print($targetday); ?>">
              </td>
            </tr>
          </table>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">メニューに戻る</a>
        </div>
      </div>
      <br />

      <!-- タブ部分 -->
      <div class="row">
        <div class="col-12">
          <ul id="myTab" class="nav nav-tabs justify-content-end" role="tablist">
            <li class="nav-item">
              <a href="#data" id="data-tab" class="nav-link active" role="tab" data-toggle="tab" aria-controls="data"
                aria-selected="true">日</a>
            </li>
            <li class="nav-item">
              <a href="#time" id="time-tab" class="nav-link" role="tab" data-toggle="tab" aria-controls="time"
                aria-selected="false">時間</a>
            </li>
          </ul>
        </div>
      </div>

      <!-- パネル部分 -->
      <div id="myTabContent" class="tab-content">
        <!-- 日フォーム -->
        <div id="data" class="tab-pane active" role="tabpanel" aria-labelledby="data-tab">
          <div class="row">
            <div class="col-12">
              <table class="table table-sm table-bordered" id="date-table">
                <colgroup>
                  <col>
                  <col style="width:100px;">
                  <col style="width:100px;">
                  <col style="width:100px;">
                  <col style="width:100px;">
                </colgroup>

                <thead>
                  <tr class="table-warning text-center">
                    <td>現場</td>
                    <td>日</td>
                    <td>夜</td>
                    <td>泊</td>
                    <td>有</td>
                  </tr>
                </thead>

                <tbody>
                  <?php for ($i=0;$i<count($genba->oup_m_genba_id);$i++) { ?>
                  <tr class="text-center">
                    <td><?php print($genba->oup_m_genba_name[$i]); ?></td>

                    <?php
                    $wkdetail   = new Wkdetail;     // シフト予定マスタクラス
                    // 予定の検索条件セット
                    $wkdetail->inp_t_wk_plan_date = $targetday;
                    $wkdetail->inp_t_wk_genba_id = $genba->oup_m_genba_id[$i];
                    $wkdetail->inp_t_wk_plan_kbn = "2";
              
                    // 予定の取得
                    $wkdetail->getWkGenbaNengetuKbn();
                    ?>
                    <td><?php echo $wkdetail->oup_t_wk_detail_no ? count($wkdetail->oup_t_wk_detail_no) : 0; ?></td>

                    <?php
                    $wkdetail   = new Wkdetail;     // シフト予定マスタクラス
                    
                    // 予定の検索条件セット
                    $wkdetail->inp_t_wk_plan_date = $targetday;
                    $wkdetail->inp_t_wk_genba_id = $genba->oup_m_genba_id[$i];
                    $wkdetail->inp_t_wk_plan_kbn = "3";
                    
                    // 予定の取得
                    $wkdetail->getWkGenbaNengetuKbn();
                    ?>
                    <td><?php echo $wkdetail->oup_t_wk_detail_no ? count($wkdetail->oup_t_wk_detail_no) : 0; ?></td>

                    <?php
                    $wkdetail   = new Wkdetail;     // シフト予定マスタクラス
                    
                    // 予定の検索条件セット
                    $wkdetail->inp_t_wk_plan_date = $targetday;
                    $wkdetail->inp_t_wk_genba_id = $genba->oup_m_genba_id[$i];
                    $wkdetail->inp_t_wk_plan_kbn = "1";
                    
                    // 予定の取得
                    $wkdetail->getWkGenbaNengetuKbn();
                    ?>
                    <td><?php echo $wkdetail->oup_t_wk_detail_no ? count($wkdetail->oup_t_wk_detail_no) : 0; ?></td>

                    <?php
                    $wkdetail   = new Wkdetail;     // シフト予定マスタクラス
                    
                    // 予定の検索条件セット
                    $wkdetail->inp_t_wk_plan_date = $targetday;
                    $wkdetail->inp_t_wk_genba_id = $genba->oup_m_genba_id[$i];
                    $wkdetail->inp_t_wk_plan_kbn = "4";
                    
                    // 予定の取得
                    $wkdetail->getWkGenbaNengetuKbn();
                    ?>
                    <td><?php echo $wkdetail->oup_t_wk_detail_no ? count($wkdetail->oup_t_wk_detail_no) : 0; ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- 時間フォーム -->
        <div id="time" class="tab-pane" role="tabpanel" aria-labelledby="time-tab">
          <div class="row">
            <div class="col-12">
              <table class="table table-sm table-bordered" id="time-table">
                <colgroup>
                  <col>
                  <col style="width:100px;">
                  <col style="width:100px;">
                  <col style="width:100px;">
                  <col style="width:100px;">
                </colgroup>

                <thead>
                  <tr class="table-warning text-center">
                    <td>現場</td>
                    <td>日</td>
                    <td>夜</td>
                    <td>泊</td>
                    <td>有</td>
                  </tr>
                </thead>

                <tbody>
                  <?php for ($i=0;$i<count($genba->oup_m_genba_id);$i++) { ?>
                  <tr class="text-center">
                    <td><?php print($genba->oup_m_genba_name[$i]); ?></td>

                    <?php
                    $wkdetail   = new Wkdetail;     // シフト予定マスタクラス
                    // 予定の検索条件セット
                    $wkdetail->inp_t_wk_plan_date = $targetday;
                    $wkdetail->inp_t_wk_genba_id = $genba->oup_m_genba_id[$i];
                    $wkdetail->inp_t_wk_plan_kbn = "2";
                
                    // 予定の取得
                    $wkdetail->getWkGenbaNengetuKbn();

                    // 労働時間の取得
                    $kinmu_time = 0;
                    if ($wkdetail->oup_t_wk_detail_no) {
                    for ($j=0; $j<count($wkdetail->oup_t_wk_detail_no); $j++) {
                        $shift = new Shift; // シフトクラス

                        $shift->inp_m_shift_plan_kbn = "2";
                        $shift->inp_m_shift_plan_hosoku = $wkdetail->oup_t_wk_plan_hosoku[$j];
                        $shift->inp_m_shift_genba_id = $wkdetail->oup_t_wk_genba_id[$j];
                        $shift->getShift(); // 取得

                        $kinmu_time += (int)$shift->oup_m_shift_rodo_time[0];
                    }
                    }
                    ?>
                    <td class="text-right"><?php echo number_format($kinmu_time); ?>h</td>

                    <?php
                    $wkdetail   = new Wkdetail;     // シフト予定マスタクラス
                    
                    // 予定の検索条件セット
                    $wkdetail->inp_t_wk_plan_date = $targetday;
                    $wkdetail->inp_t_wk_genba_id = $genba->oup_m_genba_id[$i];
                    $wkdetail->inp_t_wk_plan_kbn = "3";
                    
                    // 予定の取得
                    $wkdetail->getWkGenbaNengetuKbn();

                    // 労働時間の取得
                    $kinmu_time = 0;
                    if ($wkdetail->oup_t_wk_detail_no) {
                    for ($j=0; $j<count($wkdetail->oup_t_wk_detail_no); $j++) {
                        $shift = new Shift; // シフトクラス

                        $shift->inp_m_shift_plan_kbn = "3";
                        $shift->inp_m_shift_plan_hosoku = $wkdetail->oup_t_wk_plan_hosoku[$j];
                        $shift->inp_m_shift_genba_id = $wkdetail->oup_t_wk_genba_id[$j];
                        $shift->getShift(); // 取得

                        $kinmu_time += (int)$shift->oup_m_shift_rodo_time[0];
                    }
                    }
                    ?>
                    <td class="text-right"><?php echo number_format($kinmu_time); ?>h</td>

                    <?php
                    $wkdetail   = new Wkdetail;     // シフト予定マスタクラス
                    
                    // 予定の検索条件セット
                    $wkdetail->inp_t_wk_plan_date = $targetday;
                    $wkdetail->inp_t_wk_genba_id = $genba->oup_m_genba_id[$i];
                    $wkdetail->inp_t_wk_plan_kbn = "1";
                    
                    // 予定の取得
                    $wkdetail->getWkGenbaNengetuKbn();

                    // 労働時間の取得
                    $kinmu_time = 0;
                    if ($wkdetail->oup_t_wk_detail_no) {
                    for ($j=0; $j<count($wkdetail->oup_t_wk_detail_no); $j++) {
                        $shift = new Shift; // シフトクラス

                        $shift->inp_m_shift_plan_kbn = "1";
                        $shift->inp_m_shift_plan_hosoku = $wkdetail->oup_t_wk_plan_hosoku[$j];
                        $shift->inp_m_shift_genba_id = $wkdetail->oup_t_wk_genba_id[$j];
                        $shift->getShift(); // 取得

                        $kinmu_time += (int)$shift->oup_m_shift_rodo_time[0];
                    }
                    }
                    ?>
                    <td class="text-right"><?php echo number_format($kinmu_time); ?>h</td>
                    <td>-</td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">メニューに戻る</a>
        </div>
      </div>

    </form>

  </div>

  <div class="modal-footer">
    <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
  </div><!-- /footer -->

</body>

</html>