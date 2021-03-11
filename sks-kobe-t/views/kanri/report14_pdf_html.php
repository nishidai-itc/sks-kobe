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
            <td colspan="5">
              <table>
                <tr>
                  <td align="center"><font size="19">警　備　報　告　書</font></td>
                </tr>
                <tr>
                  <td><font size="15">契約先</font></td>
                </tr>
                <tr>
                  <td><font size="15">日本郵船株式会社　殿</font></td>
                </tr>
                <tr>
                  <td align="right"><font size="15">株式会社新神戸セキュリティ</font></td>
                </tr>
                <tr>
                  <td align="right"><font size="10">〒658-0027 神戸市東灘区青木１丁目２－１</font></td>
                </tr>
                <tr>
                  <td align="right"><font size="10">TEL(078)436-7255 FAX(078)436-7275</font></td>
                </tr>
                <tr>
                  <td><font size="15">警備場所：RC-6・7、内航バース間</font></td>
                </tr>
              </table>
            </td>
        </tr>
        <tr>
            <td>警備実施日</td>
            <td colspan="4">３年２月３日（水）天候：晴</td>
        </tr>
        <tr>
            <td colspan="5">&nbsp;</td>
        </tr>
        <tr>
            <td>警備員氏名</td>
            <td>上番</td>
            <td>下番</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
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
