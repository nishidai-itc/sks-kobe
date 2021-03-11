<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" media="screen, projection" />
    <!-- 勤務複数検索 -->
    <link rel="stylesheet" href="./../multiple/multiple-select.min.css">
    <script src="./../bootstrap-4.3.1/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>　
    <!-- 勤務複数検索 -->
    <script src="./../multiple/multiple-select.min.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-multiselect-widget/3.0.0/jquery.multiselect.js"></script>-->
    <title>勤怠管理システム</title>
  </head>

<script>
//勤務複数検索
$(function(){
    $('#genba_id').multipleSelect();
    
    //ボタン
    var b_val = $('input[name="chk_kbn"]').val();
    //初期表示
    if (b_val == '入力') {
        $('#chk_kbn').val('入力');
    } else {
        $('#chk_kbn').val('選択');
    }
    var nengetu;
    $('.nengetu_t').removeAttr('id');
    $('.nengetu_s').removeAttr('id');
    nengetu = $('.nengetu_s').remove();
        //初期、再読み込み時
        if (b_val == '入力') {
            $('.nengetu_t').attr('type','text');
            $('.nengetu_t').prop('id','nengetu');
        } else {
            $('#nen').append(nengetu);
            $('.nengetu_s').prop('id','nengetu');
        }
    //ボタンクリック
    $('#chk_kbn').click(function(){
    //alert("OK")
    b_val = $('input[name="chk_kbn"]').val();
        if (b_val == '入力') {
            $('input[name="chk_kbn"]').val('選択');
            $(this).val('選択');
            $('.nengetu_t').attr('type','hidden');
            $('.nengetu_t').removeAttr('id');
            $('#nen').append(nengetu);
            $('.nengetu_s').prop('id','nengetu');
        } else {
            $('input[name="chk_kbn"]').val('入力');
            $(this).val('入力');
            $('.nengetu_s').removeAttr('id');
            nengetu = $('.nengetu_s').remove();
            $('.nengetu_t').attr('type','text');
            $('.nengetu_t').prop('id','nengetu');
        }
    });
    // //ボタン
    // var b_val = $('input[name="chk_kbn"]').val();
    // //初期表示
    // if (b_val == '入力') {
    //     $('#chk_kbn').val('入力');
    // } else {
    //     $('#chk_kbn').val('選択');
    // }
    // var nengetu;
    // nengetu = $('#nengetu').remove();
    //     //初期、再読み込み時
    //     if (b_val == '入力') {
    //         $('#nengetu_t').attr('type','text');
    //     } else {
    //         $('#nen').append(nengetu);
    //     }
    // //ボタンクリック
    // $('#chk_kbn').click(function(){
    // b_val = $('input[name="chk_kbn"]').val();
    //     if (b_val == '入力') {
    //         $('input[name="chk_kbn"]').val('選択');
    //         $(this).val('選択');
    //         $('#nengetu_t').attr('type','hidden');
    //         $('#nen').append(nengetu);
    //     } else {
    //         $('input[name="chk_kbn"]').val('入力');
    //         $(this).val('入力');
    //         nengetu = $('#nengetu').remove();
    //         $('#nengetu_t').attr('type','text');
    //     }
    // });
});

//function func(act) {
//    document.frm.act.value=act;
//    //dispLoading('処理中');
//    document.frm.submit();
//}
 
/* ------------------------------
 Loading イメージ表示関数
 ------------------------------ */
function dispLoading(msg){
 // 引数なし（メッセージなし）を許容
 if( msg == undefined ){
 msg = "";
 }
 // 画面表示メッセージ
 var dispMsg = "<div class='loadingMsg'>" + msg + "</div>";
 // ローディング画像が表示されていない場合のみ出力
 if($("#loading").length == 0){
 $("body").append("<div id='loading'>" + dispMsg + "</div>");
 }
}
 
/* ------------------------------
 Loading イメージ削除関数
 ------------------------------ */
function removeLoading(){
 $("#loading").remove();
}

$(function () {
  $(".func").click( function() {
 
    if ($(this).val() == "0") {
        dispLoading("処理中...");
        frm.act.value=$(this).val();
        frm.submit();
    } else {
    const datalist = {
        act: $(this).val(),
        nengetu: $('#nengetu').val(),
        // genba_id: $('#genba_id').val(),
        staff_id: $('#staff_id').val(),
        staff_name: $('#staff_id option:selected').text(),
    }
    // 処理前に Loading 画像を表示
    dispLoading("処理中...");
 
    console.log(datalist)
        // 非同期処理
        $.ajax({
          url : "kinmusyukei.php",
          type:"post",
          data: datalist,
          dataType:"json"
        })
        // 通信成功時
        .done( function(data) {
        // console.log("OK:2",data)
          //showMsg("成功しました");
          if (datalist.act == "2") {
            if (data == null) {
                if (datalist.staff_id != "") {
                    alert(datalist.staff_name+'さんの勤務実績データがありません。')
                }
                if (datalist.staff_id == "") {
                    alert('集計する勤務実績データがありません。')
                }
                removeLoading()
                return
            }
            alert('給与データ作成完了しました。')
          }
          if (datalist.act == "3") {
            // console.log("OK:3",data)
            if (data == null) {
                const staff_name = datalist.staff_name
                alert(staff_name+'さんの給与データがありません。')
                removeLoading()
                return
            }
            //ダウンロードするCSVファイル名を指定する
            const filename = datalist.nengetu+'.csv';
            //CSVデータ
            const csvData = data;
            //BOMを付与する（Excelでの文字化け対策）
            const bom = new Uint8Array([0xef, 0xbb, 0xbf]);
            //Blobでデータを作成する
            const blob = new Blob([bom, csvData], { type: 'text/csv' });
            if (window.navigator.msSaveBlob) {
                window.navigator.msSaveBlob(blob, filename);
            //その他ブラウザ
            } else {
                //BlobからオブジェクトURLを作成する
                const url = (window.URL || window.webkitURL).createObjectURL(blob);
                //ダウンロード用にリンクを作成する
                const download = document.createElement('a');
                //リンク先に上記で生成したURLを指定する
                download.href = url;
                //download属性にファイル名を指定する
                download.download = filename;
                //作成したリンクをクリックしてダウンロードを実行する
                download.click();
                //createObjectURLで作成したオブジェクトURLを開放する
                (window.URL || window.webkitURL).revokeObjectURL(url);
            }
            //alert('CSV出力完了しました。');
          }
          removeLoading()
        })
        // 通信失敗時
        .fail( function(data) {
        console.log("NG",data)
          //showMsg("失敗しました");
          //alert('CSV出力完了しました。')
          removeLoading()
        })
        // 処理終了時
        //.always( function(data) {
        //  // Lading 画像を消す
        //  removeLoading();
        //});
    }
  });
});
</script>

<!-- カナ検索絞込み -->
<?php require_once('../../models/common/script.php'); ?>

<style>
#loading {
 display: table;
 width: 100%;
 height: 100%;
 position: fixed;
 top: 0;
 left: 0;
 background-color: #fff;
 opacity: 0.8;
}
 
#loading .loadingMsg {
 display: table-cell;
 text-align: center;
 vertical-align: middle;
 padding-top: 140px;
 background: url("../../load.gif") center center no-repeat;
}

.ms-parent {
    padding:0;
}
.ms-choice {
    height:100%;
}
li {
    text-align:left;
}
</style>

  <body>
    <!--<div class="container">-->
    <div>
    
    <?php if ($common->uae == 1) { ?>
    <table class="text-nowrap" style="width:80%; margin:0 auto;">
    <?php } else { ?>
    <table class="text-nowrap" style="margin:0 auto;">
    <?php } ?>
    
    <tr>
    <td>
    
      <div class="page-header">
      <?php if ($flg == 3) { ?>
        <h4>勤務実績表</h4>
      <?php } else { ?>
        <h4>給与連携処理（総務）</h4>
      <?php } ?>
      </div>

      <form name="frm" method="POST" action="kinmusyukei.php">

        <?php if ($genba2->errmsg != "") { ?>
            <div class="row">
              <div class="col-xs-12 col-md-12"><pre><p class="text-danger"><?php print($genba2->errmsg); ?></p></pre></div>
            </div>
        <?php } ?>

        <div class="row">
          <div class="col-xs-12 col-md-12">
            <table border="1">
              <tr align="center">
                    <td bgcolor="#d5d5d5">現場名</td>
                    <td bgcolor="#d5d5d5">
                      <!--<select id="genba_id" name="genba_id" class="form-control">-->
                      <select style="width: 150px" id="genba_id" name="genba_id[]" class="form-control" multiple="multiple" size="1">
                        <!--<option value=""></option>-->
                        <?php for ($i=0;$i<count($genba2->oup_m_genba_id);$i++) { ?>
                        <option value="<?php print($genba2->oup_m_genba_id[$i]); ?>" <?php
                        if ($genba_id) {
                        for ($j=0;$j<count($genba_id);$j++) {
                            if ($genba_id[$j]===$genba2->oup_m_genba_id[$i]) {
                                print("selected");
                            }
                        }
                        } ?>><?php print($genba2->oup_m_genba_name[$i]); ?></option>
                        <?php } ?>
                      </select>
                    </td>
                    <td bgcolor="#d5d5d5">　隊員　</td>
                        <td>
                          <!--<select id="user_kana" class="form-control" name="user_kana"  onChange="func(0);">-->
                          <select id="user_kana" class="form-control" name="user_kana">
                            <?php for ($i=0;$i<count($user_kana_array);$i++) { ?>
                              <option value="<?php print($user_kana_array[$i]); ?>" <?php if ($user_kana == $user_kana_array[$i]) { print("selected"); }?> ><?php print($user_kana_array[$i]); ?>
                            <?php } ?>
                          </select>
                        </td>
                        <td>
                          <select style="width: 150px" id="staff_id" name="staff_id" class="form-control">
                            <option>
                            <?php for ($i=0;$i<count($staff->oup_m_staff_id);$i++) { ?>
                              <option class="staff" name="<?php print(mb_convert_kana(mb_substr($staff->oup_m_staff_kana[$i],0,1),"K")); ?>"
                              value="<?php print($staff->oup_m_staff_id[$i]); ?>" <?php
                                if ($staff_id===$staff->oup_m_staff_id[$i]) {
                                  print("selected");
                                } ?>><?php print($staff->oup_m_staff_name[$i]); ?></option>
                            <?php } ?>
                          </select>
                        </td>
                    <td bgcolor="#d5d5d5">　協力会社　</td>
                    <td>
                      <select style="width: 150px" id="company_id" name="company_id" class="form-control">
                        <option>
                        <?php for ($i=0;$i<count($company->oup_m_company_id);$i++) { ?>
                          <option value="<?php print($company->oup_m_company_id[$i]); ?>" <?php
                            if ($company_id===$company->oup_m_company_id[$i]) {
                              print("selected");
                            } ?>><?php print($company->oup_m_company_name[$i]); ?></option>
                        <?php } ?>
                      </select>
                    </td>
                <td width="85" bgcolor="d5d5d5">年月</td>
                
                <td bgcolor="d5d5d5" class="p-0">
                <!-- ボタン -->
                <input type="button" id="chk_kbn" value="">
                <input type="hidden" name="chk_kbn" value="<?php print($chk_kbn); ?>">
                </td>
                
                <td id="nen" width="150" bgcolor="d5d5d5">
                    
                    <input type="hidden" class="form-control nengetu_t" id="nengetu" name="nengetu" maxlength="6" value="<?php print($nengetu); ?>">
                    <select id="nengetu" class="form-control nengetu_s" name="nengetu">
                      <?php for($i=$start;$i<=$end;$i=date('Ym01', strtotime($i.'+1 month'))) { ?>
                      <option value="<?php echo substr($i,0,6) ?>" <?php echo substr($i,0,6) == $nengetu ? 'selected':"" ?>><?php echo substr($i,0,6) ?></option>
                      <?php } ?>
                    </select>
                    
                </td>
                
                <?php if ($flg == 3) { ?>
                <td width="" bgcolor="d5d5d5">所定勤務時間</td>
                <td width="150" bgcolor="d5d5d5">
                    <!--<select id="nengetu" class="form-control" name="nengetu">
                      <?php for($i=$start;$i<=$end;$i=date('Ym01', strtotime($i.'+1 month'))) { ?>
                      <option value="<?php echo substr($i,0,6) ?>" <?php echo substr($i,0,6) == $nengetu ? 'selected':"" ?>><?php echo substr($i,0,6) ?></option>
                      <?php } ?>
                    </select>-->
                    <input type="text" class="form-control" name="plan_total" id="plan_total" value="<?php print($syukei->oup_m_syukei_plan_total[0]); ?>" maxlength=3>
                    <!--<input type="hidden" name="syukei_no" value="<?php print($syukei->oup_m_syukei_no[0]); ?>">-->
                </td>
                <td width="" bgcolor="d5d5d5">所定日数</td>
                <td width="80" bgcolor="d5d5d5">
                    <input type="text" class="form-control" name="plan_day_total" id="plan_day_total" value="<?php print($syukei->oup_m_syukei_plan_day_total[0]); ?>" maxlength=2>
                </td>
                
                <td width="">
                    <!--<button type="button" class="btn btn-info btn-block" role="button" onClick="func(0);">検索</button>-->
                    <button type="button" class="func btn btn-info btn-block" role="button" value="0">検索</button>
                </td>
                <?php } ?>
                
              </tr>
            </table>
          </div>
        </div>
        <br />
        
        <div class="row">
        <?php if ($flg == 3) { ?>
          <!--
          <div class="col-6">
            <button type="button" class="btn btn-warning btn-block" role="button" onClick="func(1);">連勤残集計</button>
          </div>
          -->
          <!--<div class="col-6">-->
          <?php if ($act == "0") { ?>
          <div class="col-12">
            <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">メニューに戻る</a>
          </div>
          <?php } ?>
        <?php } else { ?>
          <!--
          <div class="col-4">
            <button type="button" class="btn btn-warning btn-block" role="button" onClick="func(1);">連勤残集計</button>
          </div>
          -->
          <!--<div class="col-4">-->
          <div class="col-6">
            <!--<button type="button" class="btn btn-success btn-block" role="button" onClick="func(2);">給与用データ集計</button>-->
            <button type="button" class="func btn btn-success btn-block" role="button" value="2">給与用データ集計</button>
          </div>
          <!--<div class="col-4">-->
          <div class="col-6">
            <!--<button type="button" class="btn btn-success btn-block" role="button" onClick="func(3);">給与連携用CSV出力</button>-->
            <button type="button" class="func btn btn-success btn-block" role="button" value="3">給与連携用CSV出力</button>
          </div>
          
          <div class="col-12" style="margin-top:30px;">
            <a href="kinmujokyo.php?flg=2" class="btn btn-primary btn-block" role="button" aria-pressed="true">勤務状況一覧（総務)へ</a>
          </div>
          
        <?php } ?>
        </div>
        <br />

        <input type="hidden" name="act" value="">

      </form>

<?php 
    if ($act == "0") {
?>
              <table class="text-nowrap" style="border: solid 1px #000000; border-collapse:collapse; font-size: 10pt; width:100%;">
<?php 
            if ($wk->oup_t_wk_no) {
            for ($i=0;$i<count($wk->oup_t_wk_no);$i++) {
                /*
                 * 予定
                 */
?>

<?php 
                $head = "0";
                if ($genba_id=="") {
                    if (($i==0) || ($wk->oup_t_wk_genba_id[$i]!=$old_genba_id)) {
                        $head = "1";
                        $headno = "0";
                    }
                } else {
                    //if ($i%5==0) {
                    //    $head = "1";
                    //    $headno = "0";
                    //}
                    
                    //現場複数検索、ヘッダ表示制御
                    //if (count($genba_id) == 1) {
                    //    if ($cnt%5==0) {
                    //        $head = "1";
                    //        $headno = "0";
                    //    }
                    //} else {
                    //    if ($cnt%5==0 || $wk->oup_t_wk_genba_id[$i]!=$old_genba_id) {
                    //        $head = "1";
                    //        $headno = "0";
                    //    }
                    //}
                    if ($wk->oup_t_wk_genba_id[$i]!=$old_genba_id) {
                        $head = "1";
                        $headno = "0";
                    }
                }

                // 深夜残業があるかどうか判断のフラグ
                $sinflg = false;

                // 予定があるかどうか判断のフラグ
                $yoteiflg = false;

                // 1日～月末までループ
                for ($j=0;$j<=31;$j++) {
                    if ($j > intval($toLastday)) {
                        break;
                    }

                    // 日を2桁0埋めでフォーマット
                    if ($j == 0) {
                        $day = sprintf('%02d', $last);
                        $nengetuwk = substr($sengetu, 0, 4)."-".substr($sengetu, 4, 2)."-".$day;
                    } else {
                        $day = sprintf('%02d', $j);
                        $nengetuwk = substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day;
                    }

                    //if (($sin[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day][$wk->oup_t_wk_genba_id[$i]] == "") ||
                    //    ($sin[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day][$wk->oup_t_wk_genba_id[$i]] == "00:00")) {
                    if (($sin[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "") ||
                        ($sin[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "00:00")) {
                    } else {
                        $sinflg = true;
                    }

                    // 指定日の予定があるかどうか判定
                    //if ($kbn[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day][$wk->oup_t_wk_genba_id[$i]] != "") {
                    if ($kbn[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] != "") {
                        $yoteiflg = true;
                    }
                    //if ($kbn2[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day][$wk->oup_t_wk_genba_id[$i]] != "") {
                    if ($kbn2[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] != "") {
                        $yoteiflg = true;
                    }

                }

                if ((($head == "1") && ($yoteiflg)) || (($headno=="1") && ($yoteiflg))) {

                    $meisaiflg = false;
                    $headno = "2";
                    
                    //ヘッダ表示毎にカウント初期化
                    $cnt = 0;

?>

                    <?php /*if ($genba_id != "" || $staff_id != "") {
                    $count = $count + 1;
                        if ($count <= 1) { ?>
                        <tr style="border:1px solid white;">
                            <td colspan=2 style="font-size:12pt; font-weight:500;"><?php print(substr($nengetu,0,4)."年".substr($nengetu,4,2)."月"); ?></td>
                            <?php if ($syukei->oup_m_syukei_plan_total[0] != "") { ?>
                                <td colspan=2 style="font-size:12pt; font-weight:500;""><?php print("所定勤務時間　".$syukei->oup_m_syukei_plan_total[0]."時間"); ?></td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    <?php } else {*/ ?>
                        <tr style="border:1px solid white;">
                            <td colspan=2 style="font-size:12pt; font-weight:500;"><?php print(substr($nengetu,0,4)."年".substr($nengetu,4,2)."月"); ?></td>
                            <?php if ($syukei->oup_m_syukei_plan_total[0] != "") { ?>
                                <td colspan=2 style="font-size:12pt; font-weight:500;""><?php print("所定勤務時間　".$syukei->oup_m_syukei_plan_total[0]."時間"); ?></td>
                            <?php } ?>
                            <?php if ($syukei->oup_m_syukei_plan_day_total[0] != "") { ?>
                                <td colspan=10 style="font-size:12pt; font-weight:500;""><?php print("所定日数　".$syukei->oup_m_syukei_plan_day_total[0]."日"); ?></td>
                            <?php } ?>
                        </tr>
                    <?php //} ?>
                    
                    <tr bgcolor="FFDCA5">
                        <td style="border: solid 1px;" align="center" rowspan="2">現場名</td>
                        <td style="border: solid 1px;" align="center" rowspan="2">隊員ID</td>
                        <td style="border: solid 1px;" align="center" rowspan="2">隊員名</td>
                        <td style="border: solid 1px;" align="center" rowspan="2">&nbsp;</td>
<?php 
                    // 1日～月末までループ
                    for ($j=0;$j<=31;$j++) {
                        if ($j > intval($toLastday)) {
                            break;
                        }
                        if ($j == 0) {
                            $time = strtotime(substr($sengetu, 0, 4) . "-" . substr($sengetu, 4, 2) . "-" . $last);
                            $w = date("w", $time);
                            //前月最終日背景色変更
                            print("<td style=\"border: solid 1px;\" align=\"center\" bgcolor=\"f7ead5\">");
                            print($last."<br />");
                                print("</font>");
                            print("</td>");
                        } else {
                            $time = strtotime(substr($nengetu, 0, 4) . "-" . substr($nengetu, 4, 2) . "-" . $j);
                            $w = date("w", $time);

                            print("<td style=\"border: solid 1px;\" align=\"center\">");

                            print($j."<br />");

                                print("</font>");
                            print("</td>");
                        }
                    }
?>
                        <td style="border: solid 1px;" align="center" rowspan="2">泊</td>
                        <td style="border: solid 1px;" align="center" rowspan="2">夜</td>
                        <td style="border: solid 1px;" align="center" rowspan="2">日</td>
                        <td style="border: solid 1px;" align="center" rowspan="2">時</td>
                        <td style="border: solid 1px;" align="center" rowspan="2">年</td>
                        <td style="border: solid 1px;" align="center" rowspan="2">欠</td>
                        <td style="border: solid 1px;" align="center" rowspan="2">勤務<br />時間</td>
                        <td style="border: solid 1px;" align="center" rowspan="2">時間給<br />時間外</td>
                        <td style="border: solid 1px;" align="center" rowspan="2">集計<br />ﾁｪｯｸ</td>
                    </tr>

                    <tr bgcolor="FFDCA5">
<?php 
                    // 1日～月末までループ
                    for ($j=0;$j<=31;$j++) {
                        if ($j > intval($toLastday)) {
                            break;
                        }
                        if ($j == 0) {
                            $time = strtotime(substr($sengetu, 0, 4) . "-" . substr($sengetu, 4, 2) . "-" . $last);
                            $w = date("w", $time);
                        } else {
                            $time = strtotime(substr($nengetu, 0, 4) . "-" . substr($nengetu, 4, 2) . "-" . $j);
                            $w = date("w", $time);
                        }

                        //前月最終日背景色変更
                        if ($j == 0) {
                            print("<td style=\"border: solid 1px;\" align=\"center\" bgcolor=\"f7ead5\">");
                        } else {
                            print("<td style=\"border: solid 1px;\" align=\"center\">");
                        }

                        /*
                        if ($week[$w]=="土") {
                            print("<font color=\"blue\">");
                        } elseif ($week[$w]=="日") {
                            print("<font color=\"red\">");
                        } elseif (($j != 0 && $wk_holiday != "" && strpos($wk_holiday,sprintf("%02d",$j)) !== false) || ($j == 0 && $wk_holiday != "" && strpos($wk_holiday,sprintf("%02d",$last)) !== false)) {
                            print("<font color=\"red\">");
                        } else {
                            print("<font color=\"black\">");
                        }
                        */
                        if (($j != 0 && $wk_holiday != "" && strpos($wk_holiday,$nengetu.sprintf("%02d",$j)) !== false)
                        || ($j == 0 && $wk_holiday != "" && strpos($wk_holiday,$sengetu.sprintf("%02d",$last)) !== false)) {
                            echo "<font color=\"red\">";
                        } else {
                            if ($week[$w]=="土") {
                                echo "<font color=\"blue\">";
                            } elseif ($week[$w]=="日") {
                                echo "<font color=\"red\">";
                            } else {
                                print("<font color=\"black\">");
                            }
                        }

?>
                        <?php print($week[$w]); ?>
<?php 
                            print("</font>");
                        print("</td>");
                    }
?>

                    </tr>

<?php 
                } else {
                    if ($headno == "0") {
                        $headno = "1";
                    }
                }
?>

                <?php if ($yoteiflg) { ?>

                    <?php $meisaiflg = true; ?>
                    
                    <!-- ヘッダ表示制御のカウント -->
                    <?php $cnt = $cnt + 1; ?>

                    <tr>
                        <?php if ($sinflg) { ?>
<!--
                        <td rowspan="4">
-->
                        <?php } else { ?>
<!--
                        <td rowspan="3">
-->
                        <?php } ?>
                        <td style="border:1px; border-style: solid solid none solid;">
                            <?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?>
                        </td>
                        <?php if ($sinflg) { ?>
<!--
                        <td rowspan="4">
-->
                        <?php } else { ?>
<!--
                        <td rowspan="3">
-->
                        <?php } ?>
                        <td style="border:1px; border-style: solid solid none solid;">
                            <?php print($wk->oup_t_wk_taiin_id[$i]);              /* 隊員ID */ ?>
                        </td>
                        <?php if ($sinflg) { ?>
<!--
                        <td rowspan="4">
-->
                        <?php } else { ?>
<!--
                        <td rowspan="3">
-->
                        <?php } ?>
                        <td style="border:1px; border-style: solid solid none solid;">
                            <?php print($staffs[$wk->oup_t_wk_taiin_id[$i]]);     /* 隊員名 */ ?>
                        </td>
                        <td style="border:1px; border-style: solid solid none solid;">予定</td>
<?php 
                $tomaricnt = 0;
                $yorucnt = 0;
                $nikincnt = 0;
                $syukeichk = 0;
                $nenkyucnt = 0;
                $jikyucnt = 0;
                $kinmu_time = 0;

                // 1日～月末までループ
                for ($j=0;$j<=31;$j++) {
                    if ($j > intval($toLastday)) {
                        break;
                    }

                    // 日を2桁0埋めでフォーマット
                    if ($j == 0) {
                        $color = "bgcolor=f7ead5";
                        $day = sprintf('%02d', $last);
                        $nengetuwk = substr($sengetu, 0, 4)."-".substr($sengetu, 4, 2)."-".$day;
                    } else {
                        $color = "";
                        $day = sprintf('%02d', $j);
                        $nengetuwk = substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day;
                    }

                    //$nengetuwk = substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day;

                    // 指定日の予定があるかどうか判定
                    if ($kbn[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] != "") {

                        //前月最終日は集計しない
                        if ($j != 0) {
                            if ($kbn[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "1") {
                                $tomaricnt = $tomaricnt + 1;
                                (int)$daytomaricnt[$j] = (int)$daytomaricnt[$j] + 1;
                                //月の予定勤務時間合計（泊）
                                $month1_plan_kinmu_time = $month1_plan_kinmu_time + $kintime3[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                            }
                            if ($kbn[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "3") {
                                $yorucnt = $yorucnt + 1;
                                (int)$dayyorucntcnt[$j] = (int)$dayyorucntcnt[$j] + 1;
                                //月の予定勤務時間合計（夜勤）
                                $month3_plan_kinmu_time = $month3_plan_kinmu_time + $kintime3[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                            }
                            if ($kbn[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "2") {
                                $nikincnt = $nikincnt + 1;
                                (int)$daynikincnt[$j] = (int)$daynikincnt[$j] + 1;
                                //月の予定勤務時間合計（日勤）
                                $month2_plan_kinmu_time = $month2_plan_kinmu_time + $kintime3[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                            }
                            if ($kbn[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "4") {
                                $nenkyucnt = $nenkyucnt + 1;
                                (int)$daynenkyucnt[$j] = (int)$daynenkyucnt[$j] + 1;
                            }
                            if ($kbn[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "6") {
                                $jikyucnt = $jikyucnt + 1;
                                (int)$dayjikyucnt[$j] = (int)$dayjikyucnt[$j] + 1;
                            }
                            
                            //予定勤務時間
                            $kinmu_time = $kinmu_time + $kintime3[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                        }

                        // 予定内容を表示
                        //前月最終日背景色変更
?>
                        <td style="border: solid 1px;" align="center" <?php print($color); ?>>
                            <?php //print($shift->kbn[$kbn[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]]); ?>
                            <?php if ($hosoku[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] != "") {
                                print($shift->kbn[$kbn[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]].$hosoku[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]);
                            } else {
                                print($shift->kbn[$kbn[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]]);
                            } ?>
                        </td>
<?php 
                    } else {
?>
                        <td style="border: solid 1px;" <?php print($color); ?>>&nbsp;</td>
<?php 
                    }
                }

                $syukeichk = $tomaricnt*2+$yorucnt+$nikincnt+$jikyucnt+$nenkyucnt;
?>

                        <td style="border: solid 1px;" align="center"><?php print(format($tomaricnt)); ?></td>
                        <td style="border: solid 1px;" align="center"><?php print(format($yorucnt)); ?></td>
                        <td style="border: solid 1px;" align="center"><?php print(format($nikincnt)); ?></td>
                        <td style="border: solid 1px;" align="center"><?php print(format($jikyucnt)); ?></td>
                        <td style="border: solid 1px;" align="center"><?php print(format($nenkyucnt)); ?></td>
                        <td style="border: solid 1px;">&nbsp;</td>
                        <!-- 予定勤務時間（合計）-->
                        <td style="border: solid 1px;" align="center"><?php if (($kinmu_time+$zan_time) > $plan_total && $plan_total != "") {print("<font color=red>");} ?><?php print(format($kinmu_time)); ?></font></td>
                        <td style="border: solid 1px;">&nbsp;</td>
                        <td style="border: solid 1px;" align="center"><?php if (($syukeichk) > $plan_day_total && $plan_day_total != "") { print("<font color='red'>".format($syukeichk)."</font>"); } else {print(format($syukeichk));} ?></td>
                    </tr>

<?php 
                /*
                 * 実績
                 */
?>
                    <tr>
                        <td style="border:1px; border-style: none solid none solid;">
                            <?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?>
                        </td>
                        <td style="border:1px; border-style: none solid none solid;">
                            <?php print($wk->oup_t_wk_taiin_id[$i]);              /* 隊員ID */ ?>
                        </td>
                        <td style="border:1px; border-style: none solid none solid;">
                            <?php print($staffs[$wk->oup_t_wk_taiin_id[$i]]);     /* 隊員名 */ ?>
                        </td>
                        <td style="border:1px; border-style: none solid none solid;">実績</td>
<?php 
                $tomaricnt = 0;
                $yorucnt = 0;
                $nikincnt = 0;
                $ng = 0;
                $jikyucnt = 0;
                $jikyu_total = 0;
                $nenkyucnt = 0;
                $kekkincnt = 0;
                $kinmu_time = 0;
                $zan_time = 0;

                // 1日～月末までループ
                for ($j=0;$j<=31;$j++) {
                    if ($j > intval($toLastday)) {
                        break;
                    }

                    // 日を2桁0埋めでフォーマット
                    if ($j == 0) {
                        $color = "bgcolor=\"#f7ead5\"";
                        $day = sprintf('%02d', $last);
                        $nengetuwk = substr($sengetu, 0, 4)."-".substr($sengetu, 4, 2)."-".$day;
                    } else {
                        $color = "bgcolor=\"#CCFFCC\"";
                        $day = sprintf('%02d', $j);
                        $nengetuwk = substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day;
                    }
                    //$day = sprintf('%02d', $j);
                    //
                    //$nengetuwk = substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day;

                    // 下番時刻があるかどうか判定
                    if ($jktime[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] != "") {
                        
                        //時間外
                        //前月最終日は集計しない
                        if ($j != 0) {
                            if (($zan[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] != "") ||
                                ($zan[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] != "00:00")) {
                            //} else {
                                $zan_time = $zan_time + $zan[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                            }
                        }

                        if ($jikyuflg[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "1") {
                            //前月最終日は集計しない
                            if ($j != 0) {
                                $jikyucnt = $jikyucnt + 1;
                                (int)$dayjikyucnt2[$j] = (int)$dayjikyucnt2[$j] + 1;
                                $jikyu_total = $jikyu_total + $kintime[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                                //月の実績勤務時間合計（時給）
                                $month4_kinmu_time = $month4_kinmu_time + $kintime[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                                //月の実績残業時間合計（時給）
                                if (($zan[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] != "") ||
                                ($zan[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] != "00:00")) {
                                    $month4_zan_time = $month4_zan_time + $zan[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                                }
                            }
                            //print("<td style=\"border: solid 1px;\" align=\"center\" bgcolor=\"#CCFFCC\">".$kintime[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]."</td>");
                            print("<td style=\"border: solid 1px;\" align=\"center\" ".$color.">".$kintime[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]);
                            if ($hosoku[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] != "") {
                                print($hosoku[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]);
                            }
                            print("</td>");
                        } else if ($kbn2[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "1") {
                            //前月最終日は集計しない
                            if ($j != 0) {
                                $tomaricnt = $tomaricnt + 1;
                                (int)$daytomaricnt2[$j] = (int)$daytomaricnt2[$j] + 1;
                                //月の実績勤務時間合計（泊）
                                $month1_kinmu_time = $month1_kinmu_time + $kintime[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                                //月の実績残業時間合計（泊）
                                if (($zan[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] != "") ||
                                ($zan[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] != "00:00")) {
                                    $month1_zan_time = $month1_zan_time + $zan[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                                }
                            }
                            //print("<td style=\"border: solid 1px;\" align=\"center\" bgcolor=\"#CCFFCC\">◎</td>");
                            print("<td style=\"border: solid 1px;\" align=\"center\" ".$color.">◎");
                            if ($hosoku[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] != "") {
                                print($hosoku[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]);
                            }
                            print("</td>");
                        } else if ($kbn2[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "3") {
                            //前月最終日は集計しない
                            if ($j != 0) {
                                $yorucnt = $yorucnt + 1;
                                (int)$dayyorucntcnt2[$j] = (int)$dayyorucntcnt2[$j] + 1;
                                //月の実績勤務時間合計（夜勤）
                                $month3_kinmu_time = $month3_kinmu_time + $kintime[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                                //月の実績残業時間合計（夜勤）
                                if (($zan[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] != "") ||
                                ($zan[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] != "00:00")) {
                                    $month3_zan_time = $month3_zan_time + $zan[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                                }
                            }
                            //print("<td style=\"border: solid 1px;\" align=\"center\" bgcolor=\"#CCFFCC\">▲</td>");
                            print("<td style=\"border: solid 1px;\" align=\"center\" ".$color.">▲");
                            if ($hosoku[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] != "") {
                                print($hosoku[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]);
                            }
                            print("</td>");
                        } else if ($kbn2[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "2") {
                            //前月最終日は集計しない
                            if ($j != 0) {
                                $nikincnt = $nikincnt + 1;
                                (int)$daynikincnt2[$j] = (int)$daynikincnt2[$j] + 1;
                                //月の実績勤務時間合計（日勤）
                                $month2_kinmu_time = $month2_kinmu_time + $kintime[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                                //月の実績残業時間合計（日勤）
                                if (($zan[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] != "") ||
                                ($zan[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] != "00:00")) {
                                    $month2_zan_time = $month2_zan_time + $zan[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                                }
                            }
                            //print("<td style=\"border: solid 1px;\" align=\"center\" bgcolor=\"#CCFFCC\">○</td>");
                            print("<td style=\"border: solid 1px;\" align=\"center\" ".$color.">○");
                            if ($hosoku[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] != "") {
                                print($hosoku[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]);
                            }
                            print("</td>");
                        } else if ($kbn2[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "6") {
                            //前月最終日は集計しない
                            if ($j != 0) {
                                $jikyucnt = $jikyucnt + 1;
                                (int)$dayjikyucnt2[$j] = (int)$dayjikyucnt2[$j] + 1;
                            }
                            //print("<td style=\"border: solid 1px;\" align=\"center\" bgcolor=\"#CCFFCC\">".$kintime[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]."</td>");
                            print("<td style=\"border: solid 1px;\" align=\"center\" ".$color.">".$kintime[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]);
                            if ($hosoku[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] != "") {
                                print($hosoku[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]);
                            }
                            print("</td>");
                        } else if ($kbn2[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "4") {
                            //前月最終日は集計しない
                            if ($j != 0) {
                                $nenkyucnt = $nenkyucnt + 1;
                                (int)$daynenkyucnt2[$j] = (int)$daynenkyucnt2[$j] + 1;
                            }
                            print("<td style=\"border: solid 1px;\" align=\"center\" ".$color.">年</td>");
                        } else {
                            print("<td style=\"border: solid 1px;\" align=\"center\" ".$color.">？</td>");
                        }
                        
                        //実績勤務時間
                        //前月最終日は集計しない
                        if ($j != 0) {
                            $kinmu_time = $kinmu_time + $kintime[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                        }
?>
<?php 
                    } else {

                        if ($jbnkbn[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "4") {
                            //前月最終日は集計しない
                            if ($j != 0) {
                                $nenkyucnt = $nenkyucnt + 1;
                                (int)$daynenkyucnt2[$j] = (int)$daynenkyucnt2[$j] + 1;
                            }
                            print("<td style=\"border: solid 1px;\" align=\"center\" ".$color.">年</td>");
                        } else if ($jbnkbn[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "5") {
                            //前月最終日は集計しない
                            if ($j != 0) {
                                $kekkincnt = $kekkincnt + 1;
                                (int)$daykekkincnt2[$j] = (int)$daykekkincnt2[$j] + 1;
                            }
                            print("<td style=\"border: solid 1px;\" align=\"center\" ".$color.">欠</td>");
                        } else {
                            print("<td style=\"border: solid 1px;\" ".$color.">&nbsp;</td>");
                        }
                    }
                }
                //if ($syukeichk != $tomaricnt*2+$yorucnt+$nikincnt+$jikyucnt+$nenkyucnt+$kekkincnt) {
                if (($tomaricnt*2+$yorucnt+$nikincnt+$jikyucnt+$nenkyucnt+$kekkincnt) > $plan_day_total && $plan_day_total != "") {
                    $ng = 1;
                }
?>
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC"><?php print(format($tomaricnt)); ?></td>
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC"><?php print(format($yorucnt)); ?></td>
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC"><?php print(format($nikincnt)); ?></td>
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC"><?php print(format($jikyucnt)); ?></td>
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC"><?php print(format($nenkyucnt)); ?></td>
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC"><?php print(format($kekkincnt)); ?></td>
                        <!-- 実績勤務時間（合計）-->
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC"><?php if (($kinmu_time+$zan_time) > $plan_total && $plan_total != "") {print("<font color=red>");} ?><?php print(format($kinmu_time+$zan_time)); ?></font></td>
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC"><?php print(format($jikyu_total)); ?></td>
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC"><?php if ($ng==1) { print("<font color='red'>"); } ?><?php print($tomaricnt*2+$yorucnt+$nikincnt+$jikyucnt+$nenkyucnt+$kekkincnt); ?></td><?php if ($ng==1) { print("</font>"); } ?>
                    </tr>

<?php 
                /*
                 * 残業
                 */
?>
                    <tr>
                        <td style="border:1px; border-style: none solid none solid;">
                            <?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?>
                        </td>
                        <td style="border:1px; border-style: none solid none solid;">
                            <?php print($wk->oup_t_wk_taiin_id[$i]);              /* 隊員ID */ ?>
                        </td>
                        <td style="border:1px; border-style: none solid none solid;">
                            <?php print($staffs[$wk->oup_t_wk_taiin_id[$i]]);     /* 隊員名 */ ?>
                        </td>
                        <td style="border:1px; border-style: none solid none solid;">時間外</td>

<?php 
                $wk5 = 0;

                // 1日～月末までループ
                for ($j=0;$j<=31;$j++) {
                    if ($j > intval($toLastday)) {
                        break;
                    }

                    // 日を2桁0埋めでフォーマット
                    if ($j == 0) {
                        $color = "bgcolor=#f7ead5";
                        $day = sprintf('%02d', $last);
                        $nengetuwk = substr($sengetu, 0, 4)."-".substr($sengetu, 4, 2)."-".$day;
                    } else {
                        $color = "bgcolor=#CCFFCC";
                        $day = sprintf('%02d', $j);
                        $nengetuwk = substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day;
                    }
                    

                    // 下番時刻があるかどうか判定
                    if ($jktime[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "") {
?>
                            <td style="border: solid 1px;" <?php print($color); ?>>&nbsp;</td>
<?php 
                    } else {

                        // 残業があるかどうか判定
                        //if (($zan[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day][$wk->oup_t_wk_genba_id[$i]] == "") ||
                        //    ($zan[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day][$wk->oup_t_wk_genba_id[$i]] == "00:00")) {
                        if (($zan[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "") ||
                            ($zan[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "00:00")) {
?>
                            <td style="border: solid 1px;" <?php print($color); ?>>&nbsp;</td>
<?php 
                        } else {
                            //前月最終日は集計しない
                            if ($j != 0) {
                                //$wk5 = $wk5 + $zan[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day][$wk->oup_t_wk_genba_id[$i]];
                                $wk5 = $wk5 + $zan[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                            }
?>
                            <td style="border: solid 1px;" align="center" <?php print($color); ?>>
                                <!--<font size="-1"><?php print($zan[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day][$wk->oup_t_wk_genba_id[$i]]); ?></font>-->
                                <font size="-1"><?php print($zan[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]); ?></font>
                            </td>
<?php 
                        }
                    }
                }
?>
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC">&nbsp;</td>
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC">&nbsp;</td>
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC">&nbsp;</td>
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC">&nbsp;</td>
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC">&nbsp;</td>
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC">&nbsp;</td>
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC"></td>
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC"><?php print(format($wk5)); ?></td>
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC">&nbsp;</td>
                    </tr>

<?php 
                /*
                 * 深夜残業
                 */
?>

                <?php if ($sinflg) { ?>

                    <tr>
                        <td style="border:1px; border-style: none solid none solid;">
                            <?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?>
                        </td>
                        <td style="border:1px; border-style: none solid none solid;">
                            <?php print($wk->oup_t_wk_taiin_id[$i]);              /* 隊員ID */ ?>
                        </td>
                        <td style="border:1px; border-style: none solid none solid;">
                            <?php print($staffs[$wk->oup_t_wk_taiin_id[$i]]);     /* 隊員名 */ ?>
                        </td>
                        <td style="border:1px; border-style: none solid none solid;">深夜</td>

<?php 

                        $wk6 = 0;

                        // 1日～月末までループ
                        for ($j=0;$j<=31;$j++) {
                            if ($j > intval($toLastday)) {
                                break;
                            }

                            // 日を2桁0埋めでフォーマット
                            if ($j == 0) {
                                $color = "bgcolor=#f7ead5";
                                $day = sprintf('%02d', $last);
                                $nengetuwk = substr($sengetu, 0, 4)."-".substr($sengetu, 4, 2)."-".$day;
                            } else {
                                $color = "bgcolor=#CCFFCC";
                                $day = sprintf('%02d', $j);
                                $nengetuwk = substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day;
                            }

                            //if (($sin[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day][$wk->oup_t_wk_genba_id[$i]] == "") ||
                            //    ($sin[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day][$wk->oup_t_wk_genba_id[$i]] == "00:00")) {
                            if (($sin[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "") ||
                                ($sin[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]] == "00:00")) {
?>
                                <td style="border: solid 1px;" <?php print($color); ?>>&nbsp;</td>

<?php 
                            } else {
                                //前月最終日は集計しない
                                if ($j != 0) {
                                    //$wk6 = $wk6 + $sin[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day][$wk->oup_t_wk_genba_id[$i]];
                                    $wk6 = $wk6 + $sin[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]];
                                }
?>

                                <td style="border: solid 1px;" align="center" <?php print($color); ?>>
                                    <!--<font size="-1"><?php print($sin[$wk->oup_t_wk_taiin_id[$i]][substr($nengetu, 0, 4)."-".substr($nengetu, 4, 2)."-".$day][$wk->oup_t_wk_genba_id[$i]]); ?></font>-->
                                    <font size="-1"><?php print($sin[$wk->oup_t_wk_taiin_id[$i]][$nengetuwk][$wk->oup_t_wk_genba_id[$i]]); ?></font>
                                </td>

<?php 
                            }
                        }
?>


                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC">&nbsp;</td>
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC">&nbsp;</td>
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC">&nbsp;</td>
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC">&nbsp;</td>
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC">&nbsp;</td>
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC">&nbsp;</td>
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC">&nbsp;</td>
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC"><?php print($wk6); ?></td>
                        <td style="border: solid 1px;" align="center" bgcolor="#CCFFCC">&nbsp;</td>
                    </tr>

                <?php } ?>
                <?php } ?>


                    <!-- 現場が変わったとき集計 -->
                    <?php /*if ((($i+1)==count($wk->oup_t_wk_no)) || (($i!=0) && ($wk->oup_t_wk_genba_id[$i]!=$wk->oup_t_wk_genba_id[$i+1]))) {*/ ?>
                    <?php if ((($i+1)==count($wk->oup_t_wk_no)) || (($wk->oup_t_wk_genba_id[$i]!=$wk->oup_t_wk_genba_id[$i+1]))) { ?>

                        <?php if ($meisaiflg) { ?>

                            <?php $meisaiflg = false; ?>

                        <tr bgcolor="#DCE6F1">
                            <td style="border: solid 1px;" align="left"><?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?></td>
                            <td style="border: solid 1px;" align="center">予定合計</td>
                            <td style="border: solid 1px;" align="left">泊</td>
                            <td style="border: solid 1px;" align="left">予定</td>

<?php
                            // 1日～月末までループ
                            //前月最終日は集計しない
                            for ($j=0;$j<=31;$j++) {
                                if ($j > intval($toLastday)) {
                                    break;
                                }
?>
                                <?php
                                //前月最終日色変更
                                $color = "bgcolor=#f7ead5";
                                //前月最終日は集計しない
                                if ($j != 0) {
                                    $color = "";
                                    (int)$monthtomaricnt=(int)$monthtomaricnt+(int)$daytomaricnt[$j];
                                    //総合計
                                    (int)$monthtomaricnt_total1[$j] = (int)$monthtomaricnt_total1[$j] + (int)$daytomaricnt[$j];
                                } ?>
                                <td style="border: solid 1px;" align="center" <?php print($color); ?>>
                                    <?php print(format($daytomaricnt[$j])); ?>
                                    <?php $daytomaricnt[$j]=""; ?>
                                </td>
                                <!--<td style="border: solid 1px;" align="center">
                                    <?php print(format($daytomaricnt[$j])); ?>
                                    <?php if ($j != 0) { ?>
                                    <?php $monthtomaricnt=(int)$monthtomaricnt+(int)$daytomaricnt[$j]; ?>
                                    <?php
                                    //総合計
                                    $monthtomaricnt_total1[$j] = (int)$monthtomaricnt_total1[$j] + (int)$daytomaricnt[$j]; 
                                    ?>
                                    <?php } ?>
                                    <?php $daytomaricnt[$j]=""; ?>
                                </td>-->
<?php 
                            }
?>
                            <td style="border: solid 1px;" align="center"><?php print(format($monthtomaricnt)); ?></td>
                            <?php $monthtomaricnt_total2 = $monthtomaricnt_total2 + $monthtomaricnt; ?>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center"><?php print(num_format($month1_plan_kinmu_time)); ?></td>
                            <?php $month1_plan_kinmu_time_total = $month1_plan_kinmu_time_total + $month1_plan_kinmu_time; ?>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center"><?php print(format($monthtomaricnt*2)); ?></td>
                            <?php $monthtomaricnt=0; ?>
                            <?php $month1_plan_kinmu_time=0; ?>

                        </tr>
                        <tr bgcolor="#DCE6F1">
                            <td style="border: solid 1px;" align="left"><?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?></td>
                            <td style="border: solid 1px;" align="center">予定合計</td>
                            <td style="border: solid 1px;" align="left">夜</td>
                            <td style="border: solid 1px;" align="left">予定</td>

<?php
                            // 1日～月末までループ
                            for ($j=0;$j<=31;$j++) {
                                if ($j > intval($toLastday)) {
                                    break;
                                }
?>
                                <?php
                                //前月最終日色変更
                                $color = "bgcolor=#f7ead5";
                                //前月最終日は集計しない
                                if ($j != 0) {
                                    $color = "";
                                    (int)$monthyorucnt=(int)$monthyorucnt+(int)$dayyorucntcnt[$j];
                                    //総合計
                                    (int)$monthyorucnt_total1[$j] = (int)$monthyorucnt_total1[$j] + (int)$dayyorucntcnt[$j];
                                } ?>
                                <td style="border: solid 1px;" align="center" <?php print($color); ?>>
                                    <?php print(format($dayyorucntcnt[$j])); ?>
                                    <?php $dayyorucntcnt[$j]=""; ?>
                                </td>
<?php 
                            }
?>

                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center"><?php print(format($monthyorucnt)); ?></td>
                            <?php $monthyorucnt_total2 = $monthyorucnt_total2 + $monthyorucnt; ?>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center"><?php print(num_format($month3_plan_kinmu_time)); ?></td>
                            <?php $month3_plan_kinmu_time_total = $month3_plan_kinmu_time_total + $month3_plan_kinmu_time; ?>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center"><?php print(format($monthyorucnt)); ?></td>
                            <?php $monthyorucnt=0; ?>
                            <?php $month3_plan_kinmu_time=0; ?>

                        </tr>
                        <tr bgcolor="#DCE6F1">
                            <td style="border: solid 1px;" align="left"><?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?></td>
                            <td style="border: solid 1px;" align="center">予定合計</td>
                            <td style="border: solid 1px;" align="left">日</td>
                            <td style="border: solid 1px;" align="left">予定</td>

<?php
                            // 1日～月末までループ
                            for ($j=0;$j<=31;$j++) {
                                if ($j > intval($toLastday)) {
                                    break;
                                }
?>
                                <?php
                                //前月最終日色変更
                                $color = "bgcolor=#f7ead5";
                                //前月最終日は集計しない
                                if ($j != 0) {
                                    $color = "";
                                    (int)$monthnikincnt=(int)$monthnikincnt+(int)$daynikincnt[$j];
                                    //総合計
                                    (int)$monthnikincnt_total1[$j] = (int)$monthnikincnt_total1[$j] + (int)$daynikincnt[$j];
                                } ?>
                                <td style="border: solid 1px;" align="center" <?php print($color); ?>>
                                    <?php print(format($daynikincnt[$j])); ?>
                                    <?php $daynikincnt[$j]=""; ?>
                                </td>
<?php 
                            }
?>

                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center"><?php print(format($monthnikincnt)); ?></td>
                            <?php $monthnikincnt_total2 = $monthnikincnt_total2 + $monthnikincnt; ?>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center"><?php print(num_format($month2_plan_kinmu_time)); ?></td>
                            <?php $month2_plan_kinmu_time_total = $month2_plan_kinmu_time_total + $month2_plan_kinmu_time; ?>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center"><?php print(format($monthnikincnt)); ?></td>
                            <?php $monthnikincnt=0; ?>
                            <?php $month2_plan_kinmu_time=0; ?>

                        </tr>
                        <tr bgcolor="#DCE6F1">
                            <td style="border: solid 1px;" align="left"><?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?></td>
                            <td style="border: solid 1px;" align="center">予定合計</td>
                            <td style="border: solid 1px;" align="left">時</td>
                            <td style="border: solid 1px;" align="left">予定</td>

<?php
                            // 1日～月末までループ
                            for ($j=0;$j<=31;$j++) {
                                if ($j > intval($toLastday)) {
                                    break;
                                }
?>
                                <?php
                                //前月最終日色変更
                                $color = "bgcolor=#f7ead5";
                                //前月最終日は集計しない
                                if ($j != 0) {
                                    $color = "";
                                    (int)$monthjikyucnt=(int)$monthjikyucnt+(int)$dayjikyucnt[$j];
                                    //総合計
                                    (int)$monthjikyucnt_total1[$j] = (int)$monthjikyucnt_total1[$j] + (int)$dayjikyucnt[$j];
                                } ?>
                                <td style="border: solid 1px;" align="center" <?php print($color); ?>>
                                    <?php print(format($dayjikyucnt[$j])); ?>
                                    <?php $dayjikyucnt[$j]=""; ?>
                                </td>
<?php 
                            }
?>

                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center"><?php print(format($monthjikyucnt)); ?></td>
                            <?php $monthjikyucnt_total2 = $monthjikyucnt_total2 + $monthjikyucnt; ?>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center"><?php print(format($monthjikyucnt)); ?></td>
                            <?php $monthjikyucnt=0; ?>

                        </tr>
                        
                        <tr bgcolor="#DCE6F1">
                            <td style="border: solid 1px;" align="left"><?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?></td>
                            <td style="border: solid 1px;" align="center">予定合計</td>
                            <td style="border: solid 1px;" align="left">年</td>
                            <td style="border: solid 1px;" align="left">予定</td>

<?php
                            // 1日～月末までループ
                            for ($j=0;$j<=31;$j++) {
                                if ($j > intval($toLastday)) {
                                    break;
                                }
?>
                                <?php
                                //前月最終日色変更
                                $color = "bgcolor=#f7ead5";
                                //前月最終日は集計しない
                                if ($j != 0) {
                                    $color = "";
                                    (int)$monthnenkyucnt=(int)$monthnenkyucnt+(int)$daynenkyucnt[$j];
                                    //総合計
                                    (int)$monthnenkyucnt_total1[$j] = (int)$monthnenkyucnt_total1[$j] + (int)$daynenkyucnt[$j];
                                } ?>
                                <td style="border: solid 1px;" align="center" <?php print($color); ?>>
                                    <?php print(format($daynenkyucnt[$j])); ?>
                                    <?php $daynenkyucnt[$j]=""; ?>
                                </td>
<?php 
                            }
?>

                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center"><?php print(format($monthnenkyucnt)); ?></td>
                            <?php $monthnenkyucnt_total2 = $monthnenkyucnt_total2 + $monthnenkyucnt; ?>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center"><?php print(format($monthnenkyucnt)); ?></td>
                            <?php $monthnenkyucnt=0; ?>

                        </tr>

                        <tr bgcolor="#ffff99">
                            <td style="border: solid 1px;" align="left"><?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?></td>
                            <td style="border: solid 1px;" align="center">実績合計</td>
                            <td style="border: solid 1px;" align="left">泊</td>
                            <td style="border: solid 1px;" align="left">実績</td>

<?php
                            // 1日～月末までループ
                            for ($j=0;$j<=31;$j++) {
                                if ($j > intval($toLastday)) {
                                    break;
                                }
?>
                                <?php
                                //前月最終日色変更
                                $color = "bgcolor=#f7ead5";
                                //前月最終日は集計しない
                                if ($j != 0) {
                                    $color = "";
                                    (int)$monthtomaricnt2=(int)$monthtomaricnt2+(int)$daytomaricnt2[$j];
                                    //総合計
                                    (int)$monthtomaricnt2_total1[$j] = (int)$monthtomaricnt2_total1[$j] + (int)$daytomaricnt2[$j];
                                } ?>
                                <td style="border: solid 1px;" align="center" <?php print($color); ?>>
                                    <?php print(format($daytomaricnt2[$j])); ?>
                                    <?php $daytomaricnt2[$j]=""; ?>
                                </td>
<?php 
                            }
?>

                            <td style="border: solid 1px;" align="center"><?php print(format($monthtomaricnt2)); ?></td>
                            <?php $monthtomaricnt2_total2 = $monthtomaricnt2_total2 + $monthtomaricnt2; ?>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center"><?php print(num_format($month1_kinmu_time + $month1_zan_time)); ?></td>
                            <?php $month1_kinmu_time_total = $month1_kinmu_time_total + $month1_kinmu_time + $month1_zan_time; ?>
                            <td style="border: solid 1px;" align="center"><?php print(num_format($month1_zan_time)); ?></td>
                            <?php $month1_zan_time_total = $month1_zan_time_total + $month1_zan_time; ?>
                            <td style="border: solid 1px;" align="center"><?php print(format($monthtomaricnt2*2)); ?></td>
                            <?php $monthtomaricnt2=0; ?>
                            <?php $month1_kinmu_time=0; ?>
                            <?php $month1_zan_time=0; ?>
                        </tr>
                        <tr bgcolor="#ffff99">
                            <td style="border: solid 1px;" align="left"><?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?></td>
                            <td style="border: solid 1px;" align="center">実績合計</td>
                            <td style="border: solid 1px;" align="left">夜</td>
                            <td style="border: solid 1px;" align="left">実績</td>

<?php
                            // 1日～月末までループ
                            for ($j=0;$j<=31;$j++) {
                                if ($j > intval($toLastday)) {
                                    break;
                                }
?>
                                <?php
                                //前月最終日色変更
                                $color = "bgcolor=#f7ead5";
                                //前月最終日は集計しない
                                if ($j != 0) {
                                    $color = "";
                                    (int)$monthyorucnt2=(int)$monthyorucnt2+(int)$dayyorucntcnt2[$j];
                                    //総合計
                                    (int)$monthyorucnt2_total1[$j] = (int)$monthyorucnt2_total1[$j] + (int)$dayyorucntcnt2[$j];
                                } ?>
                                <td style="border: solid 1px;" align="center" <?php print($color); ?>>
                                    <?php print(format($dayyorucntcnt2[$j])); ?>
                                    <?php $dayyorucntcnt2[$j]=""; ?>
                                </td>
<?php 
                            }
?>

                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center"><?php print(format($monthyorucnt2)); ?></td>
                            <?php $monthyorucnt2_total2 = $monthyorucnt2_total2 + $monthyorucnt2; ?>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center"><?php print(num_format($month3_kinmu_time + $month3_zan_time)); ?></td>
                            <?php $month3_kinmu_time_total = $month3_kinmu_time_total + $month3_kinmu_time + $month3_zan_time; ?>
                            <td style="border: solid 1px;" align="center"><?php print(num_format($month3_zan_time)); ?></td>
                            <?php $month3_zan_time_total = $month3_zan_time_total + $month3_zan_time; ?>
                            <td style="border: solid 1px;" align="center"><?php print(format($monthyorucnt2)); ?></td>
                            <?php $monthyorucnt2=0; ?>
                            <?php $month3_kinmu_time=0; ?>
                            <?php $month3_zan_time=0; ?>

                        </tr>
                        <tr bgcolor="#ffff99">
                            <td style="border: solid 1px;" align="left"><?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?></td>
                            <td style="border: solid 1px;" align="center">実績合計</td>
                            <td style="border: solid 1px;" align="left">日</td>
                            <td style="border: solid 1px;" align="left">実績</td>

<?php
                            // 1日～月末までループ
                            for ($j=0;$j<=31;$j++) {
                                if ($j > intval($toLastday)) {
                                    break;
                                }
?>
                                <?php
                                //前月最終日色変更
                                $color = "bgcolor=#f7ead5";
                                //前月最終日は集計しない
                                if ($j != 0) {
                                    $color = "";
                                    (int)$monthnikincnt2=(int)$monthnikincnt2+(int)$daynikincnt2[$j];
                                    //総合計
                                    (int)$monthnikincnt2_total1[$j] = (int)$monthnikincnt2_total1[$j] + (int)$daynikincnt2[$j];
                                } ?>
                                <td style="border: solid 1px;" align="center" <?php print($color); ?>>
                                    <?php print(format($daynikincnt2[$j])); ?>
                                    <?php $daynikincnt2[$j]=""; ?>
                                </td>
<?php 
                            }
?>

                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center"><?php print(format($monthnikincnt2)); ?></td>
                            <?php $monthnikincnt2_total2 = $monthnikincnt2_total2 + $monthnikincnt2; ?>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center"><?php print(num_format($month2_kinmu_time + $month2_zan_time)); ?></td>
                            <?php $month2_kinmu_time_total = $month2_kinmu_time_total + $month2_kinmu_time + $month2_zan_time; ?>
                            <td style="border: solid 1px;" align="center"><?php print(num_format($month2_zan_time)); ?></td>
                            <?php $month2_zan_time_total = $month2_zan_time_total + $month2_zan_time; ?>
                            <td style="border: solid 1px;" align="center"><?php print(format($monthnikincnt2)); ?></td>
                            <?php $monthnikincnt2=0; ?>
                            <?php $month2_kinmu_time=0; ?>
                            <?php $month2_zan_time=0; ?>

                        </tr>
                        <tr bgcolor="#ffff99">
                            <td style="border: solid 1px;" align="left"><?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?></td>
                            <td style="border: solid 1px;" align="center">実績合計</td>
                            <td style="border: solid 1px;" align="left">時</td>
                            <td style="border: solid 1px;" align="left">実績</td>

<?php
                            // 1日～月末までループ
                            for ($j=0;$j<=31;$j++) {
                                if ($j > intval($toLastday)) {
                                    break;
                                }
?>
                                <?php
                                //前月最終日色変更
                                $color = "bgcolor=#f7ead5";
                                //前月最終日は集計しない
                                if ($j != 0) {
                                    $color = "";
                                    (int)$monthjikyucnt2=(int)$monthjikyucnt2+(int)$dayjikyucnt2[$j];
                                    //総合計
                                    (int)$monthjikyucnt2_total1[$j] = (int)$monthjikyucnt2_total1[$j] + (int)$dayjikyucnt2[$j];
                                } ?>
                                <td style="border: solid 1px;" align="center" <?php print($color); ?>>
                                    <?php print(format($dayjikyucnt2[$j])); ?>
                                    <?php $dayjikyucnt2[$j]=""; ?>
                                </td>
<?php 
                            }
?>

                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center"><?php print(format($monthjikyucnt2)); ?></td>
                            <?php $monthjikyucnt2_total2 = $monthjikyucnt2_total2 + $monthjikyucnt2; ?>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <!--<td style="border: solid 1px;" align="center"><?php print(num_format($month4_kinmu_time)); ?></td>
                            <td style="border: solid 1px;" align="center"><?php print($month4_zan_time); ?></td>-->
                            
                            <td style="border: solid 1px;" align="center"><?php print(num_format($month4_kinmu_time + $month4_zan_time)); ?></td>
                            <?php $month4_kinmu_time_total = $month4_kinmu_time_total + $month4_kinmu_time + $month4_zan_time; ?>
                            <td style="border: solid 1px;" align="center"><?php print(num_format($month4_zan_time)); ?></td>
                            <?php $month4_zan_time_total = $month4_zan_time_total + $month4_zan_time; ?>
                            
                            <td style="border: solid 1px;" align="center"><?php print(format($monthjikyucnt2)); ?></td>
                            <?php $monthjikyucnt2=0; ?>
                            <?php $month4_kinmu_time=0; ?>
                            <?php $month4_zan_time=0; ?>

                        </tr>
                        <tr bgcolor="#ffff99">
                            <td style="border: solid 1px;" align="left"><?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?></td>
                            <td style="border: solid 1px;" align="center">実績合計</td>
                            <td style="border: solid 1px;" align="left">年</td>
                            <td style="border: solid 1px;" align="left">実績</td>

<?php
                            // 1日～月末までループ
                            for ($j=0;$j<=31;$j++) {
                                if ($j > intval($toLastday)) {
                                    break;
                                }
?>
                                <?php
                                //前月最終日色変更
                                $color = "bgcolor=#f7ead5";
                                //前月最終日は集計しない
                                if ($j != 0) {
                                    $color = "";
                                    (int)$monthnenkyucnt2=(int)$monthnenkyucnt2+(int)$daynenkyucnt2[$j];
                                    //総合計
                                    (int)$monthnenkyucnt2_total1[$j] = (int)$monthnenkyucnt2_total1[$j] + (int)$daynenkyucnt2[$j];
                                } ?>
                                <td style="border: solid 1px;" align="center" <?php print($color); ?>>
                                    <?php print(format($daynenkyucnt2[$j])); ?>
                                    <?php $daynenkyucnt2[$j]=""; ?>
                                </td>
<?php 
                            }
?>

                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center"><?php print(format($monthnenkyucnt2)); ?></td>
                            <?php $monthnenkyucnt2_total2 = $monthnenkyucnt2_total2 + $monthnenkyucnt2; ?>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center"><?php print(format($monthnenkyucnt2)); ?></td>
                            <?php $monthnenkyucnt2=0; ?>

                        </tr>
                        <tr bgcolor="#ffff99">
                            <td style="border: solid 1px;" align="left"><?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?></td>
                            <td style="border: solid 1px;" align="center">実績合計</td>
                            <td style="border: solid 1px;" align="left">欠</td>
                            <td style="border: solid 1px;" align="left">実績</td>

<?php
                            // 1日～月末までループ
                            for ($j=0;$j<=31;$j++) {
                                if ($j > intval($toLastday)) {
                                    break;
                                }
?>
                                <?php
                                //前月最終日色変更
                                $color = "bgcolor=#f7ead5";
                                //前月最終日は集計しない
                                if ($j != 0) {
                                    $color = "";
                                    (int)$monthkekkincnt2=(int)$monthkekkincnt2+(int)$daykekkincnt2[$j];
                                    //総合計
                                    (int)$monthkekkincnt2_total1[$j] = (int)$monthkekkincnt2_total1[$j] + (int)$daykekkincnt2[$j];
                                } ?>
                                <td style="border: solid 1px;" align="center" <?php print($color); ?>>
                                    <?php print(format($daykekkincnt2[$j])); ?>
                                    <?php $daykekkincnt2[$j]=""; ?>
                                </td>
                                <!--<td style="border: solid 1px;" align="center">
                                    <?php print(format($daykekkincnt2[$j]));
                                    //前月最終日は集計しない
                                    if ($j != 0) { ?>
                                    <?php $monthkekkincnt2=(int)$monthkekkincnt2+(int)$daykekkincnt2[$j]; ?>
                                    <?php
                                    //総合計
                                    $monthkekkincnt2_total1[$j] = (int)$monthkekkincnt2_total1[$j] + (int)$daykekkincnt2[$j]; 
                                    ?>
                                    <?php } ?>
                                    <?php $daykekkincnt2[$j]=""; ?>
                                </td>-->
<?php 
                            }
?>

                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center"><?php print(format($monthkekkincnt2)); ?></td>
                            <?php $monthkekkincnt2_total2 = $monthkekkincnt2_total2 + $monthkekkincnt2; ?>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center">&nbsp;</td>
                            <td style="border: solid 1px;" align="center"><?php print(format($monthkekkincnt2)); ?></td>
                            <?php $monthkekkincnt2=0; ?>

                        </tr>

                        <?php } ?>
                    <?php } ?>



<?php 
                $old_genba_id = $wk->oup_t_wk_genba_id[$i];
            }
            }
?>
                    <!-- 行の数だけループ -->
                    <?php for ($k=1;$k<=5;$k++) { ?>
                    <tr bgcolor="#bbd0e8">
                        <!--<td style="border: solid 1px;" align="left"><?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?></td>-->
                        <td style="border: solid 1px;" align="center" colspan=2>総合計</td>
                        
                        <td style="border: solid 1px;" align="left">
                        <?php if ($k == 1) {
                            print("泊");
                        } elseif ($k == 2) {
                            print("夜");
                        } elseif ($k == 3) {
                            print("日");
                        } elseif ($k == 4) {
                            print("時");
                        } elseif ($k == 5) {
                            print("年");
                        } ?>
                        </td>
                        
                        <td style="border: solid 1px;" align="left">予定</td>
<?php
                        // 1日～月末までループ
                        //前月最終日は集計しない
                        for ($j=0;$j<=31;$j++) {
                            if ($j > intval($toLastday)) {
                                break;
                            }
                        //前月最終日色変更
                        if ($j != 0) {
                            $color = "";
                        } else {
                            $color = "bgcolor=#f7ead5";
                        }
?>
                            <td style="border: solid 1px;" align="center" <?php print($color); ?>>
                            <?php if ($k == 1) {
                                print(format($monthtomaricnt_total1[$j]));
                                $monthtomaricnt_total1[$j]="";
                            } elseif ($k == 2) {
                                print(format($monthyorucnt_total1[$j]));
                                $monthyorucnt_total1[$j]="";
                            } elseif ($k == 3) {
                                print(format($monthnikincnt_total1[$j]));
                                $monthnikincnt_total1[$j]="";
                            } elseif ($k == 4) {
                                print(format($monthjikyucnt_total1[$j]));
                                $monthjikyucnt_total1[$j]="";
                            } elseif ($k == 5) {
                                print(format($monthnenkyucnt_total1[$j]));
                                $monthnenkyucnt_total1[$j]="";
                            } ?>
                            </td>
<?php 
                        }
?>

                        <td style="border: solid 1px;" align="center">
                        <?php if ($k == 1) {
                            print(format($monthtomaricnt_total2));
                            //$monthtomaricnt_total2=0;
                        } ?>
                        </td>
                        <td style="border: solid 1px;" align="center">
                        <?php if ($k == 2) {
                            print(format($monthyorucnt_total2));
                            //$monthyorucnt_total2=0;
                        } ?>
                        </td>
                        <td style="border: solid 1px;" align="center">
                        <?php if ($k == 3) {
                            print(format($monthnikincnt_total2));
                            //$monthnikincnt_total2=0;
                        } ?>
                        </td>
                        <td style="border: solid 1px;" align="center">
                        <?php if ($k == 4) {
                            print(format($monthjikyucnt_total2));
                            //$monthjikyucnt_total2=0;
                        } ?>
                        </td>
                        <td style="border: solid 1px;" align="center">
                        <?php if ($k == 5) {
                            print(format($monthnenkyucnt_total2));
                            //$monthnenkyucnt_total2=0;
                        } ?>
                        </td>
                        
                        <td style="border: solid 1px;" align="center"></td>
                        
                        <td style="border: solid 1px;" align="center">
                        <?php if ($k == 1) {
                            print(num_format($month1_plan_kinmu_time_total));
                            $month1_plan_kinmu_time_total=0;
                        } elseif ($k == 2) {
                            print(num_format($month3_plan_kinmu_time_total));
                            $month3_plan_kinmu_time_total=0;
                        } elseif ($k == 3) {
                            print(num_format($month2_plan_kinmu_time_total));
                            $month2_plan_kinmu_time_total=0;
                        } ?>
                        </td>
                        
                        <td style="border: solid 1px;" align="center">&nbsp;</td>
                        <!--<td style="border: solid 1px;" align="center">&nbsp;</td>-->
                        <td style="border: solid 1px;" align="center">
                        <?php if ($k == 1) {
                            print(format($monthtomaricnt_total2*2));
                            $monthtomaricnt_total2=0;
                        } elseif ($k == 2) {
                            print(format($monthyorucnt_total2));
                            $monthyorucnt_total2=0;
                        } elseif ($k == 3) {
                            print(format($monthnikincnt_total2));
                            $monthnikincnt_total2=0;
                        } elseif ($k == 4) {
                            print(format($monthjikyucnt_total2));
                            $monthjikyucnt_total2=0;
                        } elseif ($k == 5) {
                            print(format($monthnenkyucnt_total2));
                            $monthnenkyucnt_total2=0;
                        } ?>
                        </td>

                    </tr>
                    <?php } ?>
                    
                    <!-- 行の数だけループ -->
                    <?php for ($k=1;$k<=6;$k++) { ?>
                    <tr bgcolor="#ffff5c">
                        <!--<td style="border: solid 1px;" align="left"><?php print($genbas[$wk->oup_t_wk_genba_id[$i]]);     /* 現場名 */ ?></td>-->
                        <td style="border: solid 1px;" align="center" colspan=2>総合計</td>
                        
                        <td style="border: solid 1px;" align="left">
                        <?php if ($k == 1) {
                            print("泊");
                        } elseif ($k == 2) {
                            print("夜");
                        } elseif ($k == 3) {
                            print("日");
                        } elseif ($k == 4) {
                            print("時");
                        } elseif ($k == 5) {
                            print("年");
                        } elseif ($k == 6) {
                            print("欠");
                        } ?>
                        </td>
                        
                        <td style="border: solid 1px;" align="left">実績</td>
<?php
                        // 1日～月末までループ
                        for ($j=0;$j<=31;$j++) {
                            if ($j > intval($toLastday)) {
                                break;
                            }
                        //前月最終日色変更
                        if ($j != 0) {
                            $color = "";
                        } else {
                            $color = "bgcolor=#f7ead5";
                        }
?>
                            <td style="border: solid 1px;" align="center" <?php print($color); ?>>
                            <?php if ($k == 1) {
                                print(format($monthtomaricnt2_total1[$j]));
                                $monthtomaricnt2_total1[$j]="";
                            } elseif ($k == 2) {
                                print(format($monthyorucnt2_total1[$j]));
                                $monthyorucnt2_total1[$j]="";
                            } elseif ($k == 3) {
                                print(format($monthnikincnt2_total1[$j]));
                                $monthnikincnt2_total1[$j]="";
                            } elseif ($k == 4) {
                                print(format($monthjikyucnt2_total1[$j]));
                                $monthjikyucnt2_total1[$j]="";
                            } elseif ($k == 5) {
                                print(format($monthnenkyucnt2_total1[$j]));
                                $monthnenkyucnt2_total1[$j]="";
                            } elseif ($k == 6) {
                                print(format($monthkekkincnt2_total1[$j]));
                                $monthkekkincnt2_total1[$j]="";
                            } ?>
                            </td>
<?php 
                        }
?>

                        <td style="border: solid 1px;" align="center">
                        <?php if ($k == 1) {
                            print(format($monthtomaricnt2_total2));
                            //$monthtomaricnt2_total2=0;
                        } ?>
                        </td>
                        <td style="border: solid 1px;" align="center">
                        <?php if ($k == 2) {
                            print(format($monthyorucnt2_total2));
                            //$monthyorucnt2_total2=0;
                        } ?>
                        </td>
                        <td style="border: solid 1px;" align="center">
                        <?php if ($k == 3) {
                            print(format($monthnikincnt2_total2));
                            //$monthnikincnt2_total2=0;
                        } ?>
                        </td>
                        <td style="border: solid 1px;" align="center">
                        <?php if ($k == 4) {
                            print(format($monthjikyucnt2_total2));
                            //$monthjikyucnt2_total2=0;
                        } ?>
                        </td>
                        <td style="border: solid 1px;" align="center">
                        <?php if ($k == 5) {
                            print(format($monthnenkyucnt2_total2));
                            //$monthnenkyucnt2_total2=0;
                        } ?>
                        </td>
                        <td style="border: solid 1px;" align="center">
                        <?php if ($k == 6) {
                            print(format($monthkekkincnt2_total2));
                            //$monthkekkincnt2_total2=0;
                        } ?>
                        </td>
                        
                        <td style="border: solid 1px;" align="center">
                        <?php if ($k == 1) {
                            print(num_format($month1_kinmu_time_total));
                            $month1_kinmu_time_total=0;
                        } elseif ($k == 2) {
                            print(num_format($month3_kinmu_time_total));
                            $month3_kinmu_time_total=0;
                        } elseif ($k == 3) {
                            print(num_format($month2_kinmu_time_total));
                            $month2_kinmu_time_total=0;
                        } elseif ($k == 4) {
                            print(num_format($month4_kinmu_time_total));
                            $month4_kinmu_time_total=0;
                        } ?>
                        </td>
                        
                        <td style="border: solid 1px;" align="center">
                        <?php if ($k == 1) {
                            print(num_format($month1_zan_time_total));
                            $month1_zan_time_total=0;
                        } elseif ($k == 2) {
                            print(num_format($month3_zan_time_total));
                            $month3_zan_time_total=0;
                        } elseif ($k == 3) {
                            print(num_format($month2_zan_time_total));
                            $month2_zan_time_total=0;
                        } elseif ($k == 4) {
                            print(num_format($month4_zan_time_total));
                            $month4_zan_time_total=0;
                        } ?>
                        </td>
                        
                        <!--<td style="border: solid 1px;" align="center">&nbsp;</td>-->
                        <td style="border: solid 1px;" align="center">
                        <?php if ($k == 1) {
                            print(format($monthtomaricnt2_total2*2));
                            $monthtomaricnt2_total2=0;
                        } elseif ($k == 2) {
                            print(format($monthyorucnt2_total2));
                            $monthyorucnt2_total2=0;
                        } elseif ($k == 3) {
                            print(format($monthnikincnt2_total2));
                            $monthnikincnt2_total2=0;
                        } elseif ($k == 4) {
                            print(format($monthjikyucnt2_total2));
                            $monthjikyucnt2_total2=0;
                        } elseif ($k == 5) {
                            print(format($monthnenkyucnt2_total2));
                            $monthnenkyucnt2_total2=0;
                        } elseif ($k == 6) {
                            print(format($monthkekkincnt2_total2));
                            $monthkekkincnt2_total2=0;
                        } ?>
                        </td>

                    </tr>
                    <?php } ?>
                
                </table>
<?php 
    }
?>


    <div class="row">
        <div class="col-12">
          &nbsp;
        </div>
        <div class="col-12">
          <a href="menu.php" class="btn btn-secondary btn-block" role="button" aria-pressed="true">メニューに戻る</a>
        </div>
    </div>
    
    </td>
    </tr>
    </table>
    
    </div>

      <div class="modal-footer">
          <p><span>Copyright &copy; ITC Co., Ltd. </span><span>All Rights Reserved. </span></p>
      </div><!-- /footer -->

  </body>
</html>
