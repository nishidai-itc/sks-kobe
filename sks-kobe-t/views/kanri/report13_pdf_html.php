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
        <td><font size="15">警　備　報　告　書</font></td>
      </tr>
    </table>
    <table border="1" cellpadding="7" cellspacing="0">
        <tr>
            <td colspan="10">
              <table>
                <tr>
                  <td><font size="15">(警備場所)</font></td>
                  <td><font size="15">(契約先)</font></td>
                </tr>
                <tr>
                  <td><font size="15">日本郵船神戸バンブール</font></td>
                  <td><font size="15">日本郵船株式会社殿</font></td>
                </tr>
              </table>
            </td>
        </tr>
        <tr>
            <td colspan="5">
              <table>
                <tr>
                  <td><font size="15">(勤務時間)</font></td>
                </tr>
                <tr>
                  <td><font size="12">自）３年２月３日水曜　０８時００分</font></td>
                </tr>
                <tr>
                  <td><font size="12">至）３年２月４日木曜　０８時００分</font></td>
                </tr>
              </table>
            </td>
            <td align="center">
              <table>
                <tr>
                  <td><font size="15">天候</font></td>
                </tr>
                <tr>
                  <td><font size="15">晴</font></td>
                </tr>
              </table>
            </td>
            <td colspan="4">
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
        <tr>
            <td colspan="10">
              <table>
                <tr>
                  <td>（１）構内作業</td>
                  <td>日本港運</td>
                  <td>08:30 ～ 16:30</td>
                </tr>
                <tr>
                  <td colspan="3">（２）搬出入車（者）の安全誘導、火災、盗難の防止、不法侵入者の排除、その他事故防止に留意</td>
                </tr>
                <tr>
                  <td>（３）正門立哨</td>
                  <td></td>
                  <td>08:30 ～ 16:30</td>
                </tr>
                <tr>
                  <td>特記事項</td>
                  <td colspan="2">なし</td>
                </tr>
              </table>
            </td>
        </tr>

        <tr>
          <td rowspan="5">巡<br>回</td>
          <td>1</td>
          <td>08:00</td>
          <td rowspan="5">勤<br>務<br>員</td>
          <td>A</td>
          <td colspan="5" rowspan="5">
            <table>
              <tr>
                <td>備考</td>
              </tr>
              <tr>
                <td>なし</td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td>2</td>
          <td>12:00</td>
          <td>B</td>
        </tr>
        <tr>
          <td>3</td>
          <td>13:00</td>
          <td>C</td>
        </tr>
        <tr>
          <td>4</td>
          <td>16:30</td>
          <td>D</td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
        </tr>
    </table>

<div align="right">株式会社新神戸セキュリティ</div>


</html>

EOF;

$tcpdf->writeHTML($html);
$tcpdf->Output("test.pdf");

?>
