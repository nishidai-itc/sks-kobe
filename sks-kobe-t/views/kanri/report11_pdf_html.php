<?php 
    ob_end_clean();

include "../../tcpdf/tcpdf.php"; //ライブラリの読み込み
$tcpdf = new TCPDF("Portrait");
$tcpdf->setPrintHeader(false); // 追加する
$tcpdf->AddPage();
$tcpdf->SetFont("kozminproregular", "", 10);
$html = <<< EOF

<html lang="ja">

    <table border="1" cellpadding="7" cellspacing="0">
        <tr>
            <td colspan="7">
              <table>
                <tr>
                  <td><font size="15">(勤務場所)</font></td>
                  <td><font size="15">(契約先)</font></td>
                </tr>
                <tr>
                  <td><font size="15">KFC</font></td>
                  <td><font size="15">商船港運株式会社</font></td>
                </tr>
              </table>
            </td>
        </tr>
        <tr>
            <td colspan="3">
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
        <tr>
            <td>巡回
            </td>
            <td>バース
            </td>
            <td colspan="3">本船名
            </td>
            <td>入港
            </td>
            <td>出港
            </td>
        </tr>
        <tr>
            <td>20:05
            </td>
            <td>
            </td>
            <td colspan="3">
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>22:06
            </td>
            <td>C-6
            </td>
            <td colspan="3">ONE APLIS
            </td>
            <td>停泊
            </td>
            <td>停泊
            </td>
        </tr>
        <tr>
            <td>00:25
            </td>
            <td>
            </td>
            <td colspan="3">
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>02:15
            </td>
            <td>
            </td>
            <td colspan="3">
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>04:00
            </td>
            <td>
            </td>
            <td colspan="3">
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>05:30
            </td>
            <td>
            </td>
            <td colspan="3">
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td rowspan="3">実<br><br>施
            </td>
            <td colspan="3" rowspan="3">
              <table>
                <tr>
                  <td>立哨時間</td>
                  <td></td>
                </tr>
                <tr>
                  <td>正面ゲート</td>
                  <td>(08:30～17:02)</td>
                </tr>
                <tr>
                  <td>東ゲート</td>
                  <td>(08:00～16:46)</td>
                </tr>
                <tr>
                  <td>西ゲート</td>
                  <td>(08:30～16:40)</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>残業者</td>
                  <td></td>
                </tr>
                <tr>
                  <td>名</td>
                  <td>(  :  ～  :  )</td>
                </tr>
              </table>
            </td>
            <td colspan="3">
              <table>
                <tr>
                  <td>ヤード灯（作業　常夜　街灯）</td>
                </tr>
                <tr>
                  <td>  :  ～  :  /  :  ～  :  </td>
                </tr>
              </table>
            </td>
        </tr>
        <tr>
            <td colspan="3">
              <table>
                <tr>
                  <td>カメラ操作状況</td>
                </tr>
                <tr>
                  <td>20:10　異常なし</td>
                </tr>
              </table>
            </td>
        </tr>
        <tr>
            <td colspan="3">
              <table>
                <tr>
                  <td>フェンス等の破損状況</td>
                </tr>
                <tr>
                  <td>18:10　異常なし</td>
                </tr>
              </table>
            </td>
        </tr>

        <tr>
            <td rowspan="9">備<br><br>考
            </td>
            <td colspan="2">税関入場
            </td>
            <td colspan="4">作業ほか
            </td>
        </tr>
        <tr>
            <td colspan="2">なし
            </td>
            <td colspan="4">
            </td>
        </tr>
        <tr>
            <td colspan="2">
            </td>
            <td colspan="4">
            </td>
        </tr>
        <tr>
            <td colspan="2">
            </td>
            <td colspan="4">
            </td>
        </tr>
        <tr>
            <td colspan="2">
            </td>
            <td colspan="4">
            </td>
        </tr>
        <tr>
            <td colspan="2">
            </td>
            <td colspan="4">
            </td>
        </tr>
        <tr>
            <td colspan="2">
            </td>
            <td colspan="4">
            </td>
        </tr>
        <tr>
            <td colspan="2">
            </td>
            <td colspan="4">
            </td>
        </tr>
        <tr>
            <td colspan="2">
            </td>
            <td colspan="4">
            </td>
        </tr>

        <tr>
            <td rowspan="3">勤<br>務<br>員
            </td>
            <td>(泊)
            </td>
            <td>小川
            </td>
            <td>松田
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>(日)
            </td>
            <td>弓場
            </td>
            <td>中村
            </td>
            <td>松浦
            </td>
            <td>宮内
            </td>
            <td>
            </td>
        </tr>
        <tr>
            <td>(夜)
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
            <td>
            </td>
        </tr>
    </table>
<div align="right">株式会社新神戸セキュリティ</div>


</html>

EOF;

$tcpdf->writeHTML($html);
$tcpdf->Output("test.pdf");

?>
