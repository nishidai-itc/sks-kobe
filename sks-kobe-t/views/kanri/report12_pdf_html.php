<?php 
    ob_end_clean();

include "../../tcpdf/tcpdf.php"; //ライブラリの読み込み
$tcpdf = new TCPDF("Portrait");
$tcpdf->setPrintHeader(false); // 追加する
$tcpdf->AddPage();
$tcpdf->SetFont("kozminproregular", "", 10);
$html = <<< EOF

<html lang="ja">

    <table border="0">
      <tr>
        <td><font size="15">作　業　報　告　書</font></td>
      </tr>
    </table>
    <table border="1" cellpadding="7" cellspacing="0">
        <tr>
            <td colspan="6">
              <table>
                <tr>
                  <td><font size="15">警備場所</font></td>
                </tr>
                <tr>
                  <td><font size="15">日本郵船神戸コンテナターミナル</font></td>
                </tr>
              </table>
            </td>
        </tr>
        <tr>
            <td colspan="3">
              <table>
                <tr>
                  <td><font size="15">報告時間</font></td>
                </tr>
                <tr>
                  <td><font size="12">自）３年２月３日水曜　０８時００分</font></td>
                </tr>
                <tr>
                  <td><font size="12">至）３年２月４日木曜　０８時００分</font></td>
                </tr>
              </table>
            </td>
            <td colspan="3">
              <table>
                <tr>
                  <td><font size="15">担当警備士</font></td>
                  <td align="right"><font size="15"></font></td>
                </tr>
                <tr>
                  <td><font size="15">松田　健</font></td>
                  <td><font size="15">印</font></td>
                </tr>
              </table>
            </td>
        </tr>
    </table>
<div>&nbsp;</div>
<div>１　搬出入車（人）の安全誘導、火災、盗難の防止、不法侵入者の排除、出入管理</div>
<div>巡回警備、その他事故防止に留意</div>
<div>２　PSカードの全てについて有効性の確認を実施</div>
<div>３　PSカードの顔写真について本人確認を実施</div>
<div>（正面ゲート： 一定の割合 /  サブINゲート： 全て）</div>
<div>４　その他　報告</div>
<div>なし</div>

<div align="right">株式会社新神戸セキュリティ</div>


</html>

EOF;

$tcpdf->writeHTML($html);
$tcpdf->Output("test.pdf");

?>
