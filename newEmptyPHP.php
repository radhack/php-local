<?php
require_once 'vendor/autoload.php';
include('auth.php');
/*
 * Copyright (C) 2017 alexgriffen
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

//require_once 'vendor/autoload.php';
//include('auth.php');
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */
//// create new PDF document
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//
//// set document information
//$pdf->SetCreator(PDF_CREATOR);
//$pdf->SetAuthor('Nicola Asuni');
//$pdf->SetTitle('TCPDF Example 006');
//$pdf->SetSubject('TCPDF Tutorial');
//$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
//
//// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);
//
//// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
//
//// set default monospaced font
//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
//
//// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//
//// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//
//// set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
//
//// set some language-dependent strings (optional)
////if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
////    require_once(dirname(__FILE__).'/lang/eng.php');
////    $pdf->setLanguageArray($l);
////}
//
//// ---------------------------------------------------------
//
//// set font
//$pdf->SetFont('dejavusans', '', 10);
//
//// add a page
//$pdf->AddPage();
//
//// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
//// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
//
//// create some HTML content
//$html = '<h1>HTML Example</h1>
//Some special characters: &lt; € &euro; &#8364; &amp; è &egrave; &copy; &gt; \\slash \\\\double-slash \\\\\\triple-slash
//<h2>List</h2>
//List example:
//<ol>
//    <li><img src="images/logo_example.png" alt="test alt attribute" width="30" height="30" border="0" /> test image</li>
//    <li><b>bold text</b></li>
//    <li><i>italic text</i></li>
//    <li><u>underlined text</u></li>
//    <li><b>b<i>bi<u>biu</u>bi</i>b</b></li>
//    <li><a href="http://www.tecnick.com" dir="ltr">link to http://www.tecnick.com</a></li>
//    <li>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.<br />Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</li>
//    <li>SUBLIST
//        <ol>
//            <li>row one
//                <ul>
//                    <li>sublist</li>
//                </ul>
//            </li>
//            <li>row two</li>
//        </ol>
//    </li>
//    <li><b>T</b>E<i>S</i><u>T</u> <del>line through</del></li>
//    <li><font size="+3">font + 3</font></li>
//    <li><small>small text</small> normal <small>small text</small> normal <sub>subscript</sub> normal <sup>superscript</sup> normal</li>
//</ol>
//<dl>
//    <dt>Coffee</dt>
//    <dd>Black hot drink</dd>
//    <dt>Milk</dt>
//    <dd>White cold drink</dd>
//</dl>
//<div style="text-align:center">IMAGES<br />
//<img src="images/logo_example.png" alt="test alt attribute" width="100" height="100" border="0" /><img src="vendor/tecnickcom/tcpdf/examples/images/tcpdf_box.svg" alt="test alt attribute" width="100" height="100" border="0" /><img src="images/logo_example.jpg" alt="test alt attribute" width="100" height="100" border="0" />
//</div>';
//
//// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, '');
//
//
//// output some RTL HTML content
//$html = '<div style="text-align:center">The words &#8220;<span dir="rtl">&#1502;&#1494;&#1500; [mazel] &#1496;&#1493;&#1489; [tov]</span>&#8221; mean &#8220;Congratulations!&#8221;</div>';
//$pdf->writeHTML($html, true, false, true, false, '');
//
//// test some inline CSS
//$html = '<p>This is just an example of html code to demonstrate some supported CSS inline styles.
//<span style="font-weight: bold;">bold text</span>
//<span style="text-decoration: line-through;">line-trough</span>
//<span style="text-decoration: underline line-through;">underline and line-trough</span>
//<span style="color: rgb(0, 128, 64);">color</span>
//<span style="background-color: rgb(255, 0, 0); color: rgb(255, 255, 255);">background color</span>
//<span style="font-weight: bold;">bold</span>
//<span style="font-size: xx-small;">xx-small</span>
//<span style="font-size: x-small;">x-small</span>
//<span style="font-size: small;">small</span>
//<span style="font-size: medium;">medium</span>
//<span style="font-size: large;">large</span>
//<span style="font-size: x-large;">x-large</span>
//<span style="font-size: xx-large;">xx-large</span>
//</p>';
//
//$pdf->writeHTML($html, true, false, true, false, '');
//
//// reset pointer to the last page
//$pdf->lastPage();
//
//// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//// Print a table
//
//// add a page
//$pdf->AddPage();
//
//// create some HTML content
//$subtable = '<table border="1" cellspacing="6" cellpadding="4"><tr><td>a</td><td>b</td></tr><tr><td>c</td><td>d</td></tr></table>';
//
//$html = '<h2>HTML TABLE:</h2>
//<table border="1" cellspacing="3" cellpadding="4">
//    <tr>
//        <th>#</th>
//        <th align="right">RIGHT align</th>
//        <th align="left">LEFT align</th>
//        <th>4A</th>
//    </tr>
//    <tr>
//        <td>1</td>
//        <td bgcolor="#cccccc" align="center" colspan="2">A1 ex<i>amp</i>le <a href="http://www.tcpdf.org">link</a> column span. One two tree four five six seven eight nine ten.<br />line after br<br /><small>small text</small> normal <sub>subscript</sub> normal <sup>superscript</sup> normal  bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla<ol><li>first<ol><li>sublist</li><li>sublist</li></ol></li><li>second</li></ol><small color="#FF0000" bgcolor="#FFFF00">small small small small small small small small small small small small small small small small small small small small</small></td>
//        <td>4B</td>
//    </tr>
//    <tr>
//        <td>'.$subtable.'</td>
//        <td bgcolor="#0000FF" color="yellow" align="center">A2 € &euro; &#8364; &amp; è &egrave;<br/>A2 € &euro; &#8364; &amp; è &egrave;</td>
//        <td bgcolor="#FFFF00" align="left"><font color="#FF0000">Red</font> Yellow BG</td>
//        <td>4C</td>
//    </tr>
//    <tr>
//        <td>1A</td>
//        <td rowspan="2" colspan="2" bgcolor="#FFFFCC">2AA<br />2AB<br />2AC</td>
//        <td bgcolor="#FF0000">4D</td>
//    </tr>
//    <tr>
//        <td>1B</td>
//        <td>4E</td>
//    </tr>
//    <tr>
//        <td>1C</td>
//        <td>2C</td>
//        <td>3C</td>
//        <td>4F</td>
//    </tr>
//</table>';
//
//// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, '');
//
//// Print some HTML Cells
//
//$html = '<span color="red">red</span> <span color="green">green</span> <span color="blue">blue</span><br /><span color="red">red</span> <span color="green">green</span> <span color="blue">blue</span>';
//
//$pdf->SetFillColor(255,255,0);
//
//$pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'L', true);
//$pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 1, true, 'C', true);
//$pdf->writeHTMLCell(0, 0, '', '', $html, 'LRTB', 1, 0, true, 'R', true);
//
//// reset pointer to the last page
//$pdf->lastPage();
//
//// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//// Print a table
//
//// add a page
//$pdf->AddPage();
//
//// create some HTML content
//$html = '<h1>Image alignments on HTML table</h1>
//<table cellpadding="1" cellspacing="1" border="1" style="text-align:center;">
//<tr><td><img src="images/logo_example.png" border="0" height="41" width="41" /></td></tr>
//<tr style="text-align:left;"><td><img src="images/logo_example.png" border="0" height="41" width="41" align="top" /></td></tr>
//<tr style="text-align:center;"><td><img src="images/logo_example.png" border="0" height="41" width="41" align="middle" /></td></tr>
//<tr style="text-align:right;"><td><img src="images/logo_example.png" border="0" height="41" width="41" align="bottom" /></td></tr>
//<tr><td style="text-align:left;"><img src="images/logo_example.png" border="0" height="41" width="41" align="top" /></td></tr>
//<tr><td style="text-align:center;"><img src="images/logo_example.png" border="0" height="41" width="41" align="middle" /></td></tr>
//<tr><td style="text-align:right;"><img src="images/logo_example.png" border="0" height="41" width="41" align="bottom" /></td></tr>
//</table>';
//
//// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, '');
//
//// reset pointer to the last page
//$pdf->lastPage();
//
//// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//// Print all HTML colors
//
//// add a page
//$pdf->AddPage();
//
//$textcolors = '<h1>HTML Text Colors</h1>';
//$bgcolors = '<hr /><h1>HTML Background Colors</h1>';
//
//foreach(TCPDF_COLORS::$webcolor as $k => $v) {
//    $textcolors .= '<span color="#'.$v.'">'.$v.'</span> ';
//    $bgcolors .= '<span bgcolor="#'.$v.'" color="#333333">'.$v.'</span> ';
//}
//
//// output the HTML content
//$pdf->writeHTML($textcolors, true, false, true, false, '');
//$pdf->writeHTML($bgcolors, true, false, true, false, '');
//
//// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//
//// Test word-wrap
//
//// create some HTML content
//$html = '<hr />
//<h1>Various tests</h1>
//<a href="#2">link to page 2</a><br />
//<font face="courier"><b>thisisaverylongword</b></font> <font face="helvetica"><i>thisisanotherverylongword</i></font> <font face="times"><b>thisisaverylongword</b></font> thisisanotherverylongword <font face="times">thisisaverylongword</font> <font face="courier"><b>thisisaverylongword</b></font> <font face="helvetica"><i>thisisanotherverylongword</i></font> <font face="times"><b>thisisaverylongword</b></font> thisisanotherverylongword <font face="times">thisisaverylongword</font> <font face="courier"><b>thisisaverylongword</b></font> <font face="helvetica"><i>thisisanotherverylongword</i></font> <font face="times"><b>thisisaverylongword</b></font> thisisanotherverylongword <font face="times">thisisaverylongword</font> <font face="courier"><b>thisisaverylongword</b></font> <font face="helvetica"><i>thisisanotherverylongword</i></font> <font face="times"><b>thisisaverylongword</b></font> thisisanotherverylongword <font face="times">thisisaverylongword</font> <font face="courier"><b>thisisaverylongword</b></font> <font face="helvetica"><i>thisisanotherverylongword</i></font> <font face="times"><b>thisisaverylongword</b></font> thisisanotherverylongword <font face="times">thisisaverylongword</font>';
//
//// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, '');
//
//// Test fonts nesting
//$html1 = 'Default <font face="courier">Courier <font face="helvetica">Helvetica <font face="times">Times <font face="dejavusans">dejavusans </font>Times </font>Helvetica </font>Courier </font>Default';
//$html2 = '<small>small text</small> normal <small>small text</small> normal <sub>subscript</sub> normal <sup>superscript</sup> normal';
//$html3 = '<font size="10" color="#ff7f50">The</font> <font size="10" color="#6495ed">quick</font> <font size="14" color="#dc143c">brown</font> <font size="18" color="#008000">fox</font> <font size="22"><a href="http://www.tcpdf.org">jumps</a></font> <font size="22" color="#a0522d">over</font> <font size="18" color="#da70d6">the</font> <font size="14" color="#9400d3">lazy</font> <font size="10" color="#4169el">dog</font>.';
//
//$html = $html1.'<br />'.$html2.'<br />'.$html3.'<br />'.$html3.'<br />'.$html2;
//
//// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, '');
//
//// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//// test pre tag
//
//// add a page
//$pdf->AddPage();
//
//$html = <<<EOF
//<div style="background-color:#880000;color:white;">
//Hello World!<br />
//Hello
//</div>
//<pre style="background-color:#336699;color:white;">
//int main() {
//    printf("HelloWorld");
//    return 0;
//}
//</pre>
//<tt>Monospace font</tt>, normal font, <tt>monospace font</tt>, normal font.
//<br />
//<div style="background-color:#880000;color:white;">DIV LEVEL 1<div style="background-color:#008800;color:white;">DIV LEVEL 2</div>DIV LEVEL 1</div>
//<br />
//<span style="background-color:#880000;color:white;">SPAN LEVEL 1 <span style="background-color:#008800;color:white;">SPAN LEVEL 2</span> SPAN LEVEL 1</span>
//EOF;
//
//// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, '');
//
//// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//
//// test custom bullet points for list
//
//// add a page
//$pdf->AddPage();
//
//$html = <<<EOF
//<h1>Test custom bullet image for list items</h1>
//<ul style="font-size:14pt;list-style-type:img|png|4|4|images/logo_example.png">
//    <li>test custom bullet image</li>
//    <li>test custom bullet image</li>
//    <li>test custom bullet image</li>
//    <li>test custom bullet image</li>
//<ul>
//EOF;
//
//// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, '');
//
//// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//
//// reset pointer to the last page
//$pdf->lastPage();
//
//// ---------------------------------------------------------
//
//// add a page
//
//$pdf->AddPage();
//
//$html = '<style type="text/css">ol{margin:0;padding:0}table td,table th{padding:0}.c19{border-right-style:solid;padding:5pt 5pt 5pt 5pt;border-bottom-color:#ffffff;border-top-width:1pt;border-right-width:1pt;border-left-color:#ffffff;vertical-align:top;border-right-color:#ffffff;border-left-width:1pt;border-top-style:solid;border-left-style:solid;border-bottom-width:1pt;width:294.8pt;border-top-color:#000000;border-bottom-style:solid}.c10{border-right-style:solid;padding:5pt 5pt 5pt 5pt;border-bottom-color:#ffffff;border-top-width:1pt;border-right-width:1pt;border-left-color:#ffffff;vertical-align:top;border-right-color:#ffffff;border-left-width:1pt;border-top-style:solid;border-left-style:solid;border-bottom-width:1pt;width:231pt;border-top-color:#000000;border-bottom-style:solid}.c20{border-right-style:solid;padding:5pt 5pt 5pt 5pt;border-bottom-color:#ffffff;border-top-width:1pt;border-right-width:1pt;border-left-color:#ffffff;vertical-align:top;border-right-color:#ffffff;border-left-width:1pt;border-top-style:solid;border-left-style:solid;border-bottom-width:1pt;width:178.5pt;border-top-color:#000000;border-bottom-style:solid}.c12{border-right-style:solid;padding:5pt 5pt 5pt 5pt;border-bottom-color:#ffffff;border-top-width:1pt;border-right-width:1pt;border-left-color:#ffffff;vertical-align:top;border-right-color:#ffffff;border-left-width:1pt;border-top-style:solid;border-left-style:solid;border-bottom-width:1pt;width:380.2pt;border-top-color:#000000;border-bottom-style:solid}.c21{border-right-style:solid;padding:5pt 5pt 5pt 5pt;border-bottom-color:#ffffff;border-top-width:1pt;border-right-width:1pt;border-left-color:#ffffff;vertical-align:top;border-right-color:#ffffff;border-left-width:1pt;border-top-style:solid;border-left-style:solid;border-bottom-width:1pt;width:234pt;border-top-color:#000000;border-bottom-style:solid}.c0{padding-top:0pt;padding-bottom:0pt;line-height:1.0;orphans:2;widows:2;text-align:left;height:11pt}.c6{color:#ffffff;font-weight:400;text-decoration:none;vertical-align:baseline;font-size:10pt;font-family:"Arial";font-style:normal}.c3{color:#000000;font-weight:400;text-decoration:none;vertical-align:baseline;font-size:11pt;font-family:"Arial";font-style:normal}.c2{color:#000000;font-weight:400;text-decoration:none;vertical-align:baseline;font-size:14pt;font-family:"Arial";font-style:normal}.c25{padding-top:0pt;padding-bottom:0pt;line-height:1.15;orphans:2;widows:2;text-align:center}.c1{margin-left:3.8pt;padding-top:0pt;padding-bottom:0pt;line-height:1.0;text-align:left;height:11pt}.c13{padding-top:0pt;padding-bottom:0pt;line-height:1.0;orphans:2;widows:2;text-align:left}.c17{padding-top:0pt;padding-bottom:0pt;line-height:1.0;text-align:left;height:11pt}.c15{font-weight:400;text-decoration:none;vertical-align:baseline;font-family:"Arial";font-style:normal}.c11{margin-left:58.5pt;border-spacing:0;border-collapse:collapse;margin-right:auto}.c24{margin-left:83.2pt;border-spacing:0;border-collapse:collapse;margin-right:auto}.c18{margin-left:95.2pt;border-spacing:0;border-collapse:collapse;margin-right:auto}.c16{margin-left:104.2pt;border-spacing:0;border-collapse:collapse;margin-right:auto}.c7{margin-left:45pt;border-spacing:0;border-collapse:collapse;margin-right:auto}.c26{background-color:#ffffff;max-width:468pt;padding:72pt 72pt 72pt 72pt}.c8{background-color:#ffffff;color:#ffffff}.c14{height:6pt}.c5{height:0pt}.c4{font-size:14pt}.c22{font-size:10pt}.c9{color:#ffffff}.c23{color:#000000}.title{padding-top:0pt;color:#000000;font-size:26pt;padding-bottom:3pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}.subtitle{padding-top:0pt;color:#666666;font-size:15pt;padding-bottom:16pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}li{color:#000000;font-size:11pt;font-family:"Arial"}p{margin:0;color:#000000;font-size:11pt;font-family:"Arial"}h1{padding-top:20pt;color:#000000;font-size:20pt;padding-bottom:6pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}h2{padding-top:18pt;color:#000000;font-size:16pt;padding-bottom:6pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}h3{padding-top:16pt;color:#434343;font-size:14pt;padding-bottom:4pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}h4{padding-top:14pt;color:#666666;font-size:12pt;padding-bottom:4pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}h5{padding-top:12pt;color:#666666;font-size:11pt;padding-bottom:4pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;orphans:2;widows:2;text-align:left}h6{padding-top:12pt;color:#666666;font-size:11pt;padding-bottom:4pt;font-family:"Arial";line-height:1.15;page-break-after:avoid;font-style:italic;orphans:2;widows:2;text-align:left}</style><body class="c26">
//      <p class="c25"><span class="c2">Testing Text Tags (invisible)</span></p>
//      <p class="c0"><span class="c2"></span></p>
//      <p class="c13"><span class="c4">Name: </span><span class="c8 c4">[text|req|signer1|Full Name|ID1 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ]</span></p>
//      <a id="t.1aebe24dda1b56316fca09844ec7bf63e4290b0d"></a><a id="t.0"></a>
//      <table class="c7">
//         <tbody>
//            <tr class="c14">
//               <td class="c19" colspan="1" rowspan="1">
//                  <p class="c1"><span class="c2"></span></p>
//               </td>
//            </tr>
//         </tbody>
//      </table>
//      <p class="c13"><span class="c4">Date of Birth:</span><span class="c4 c9">&nbsp;[text|req|signer1|DOB|ID2 &nbsp; ] &nbsp; &nbsp; &nbsp; &nbsp;</span><span class="c2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></p>
//      <a id="t.1aebe24dda1b56316fca09844ec7bf63e4290b0d"></a><a id="t.1"></a>
//      <table class="c24">
//         <tbody>
//            <tr class="c5">
//               <td class="c20" colspan="1" rowspan="1">
//                  <p class="c0"><span class="c2"></span></p>
//               </td>
//            </tr>
//         </tbody>
//      </table>
//      <p class="c13"><span class="c4">Address: </span><span class="c15 c4 c9">[text|req|signer1|Address|ID2 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;]</span></p>
//      <a id="t.1aebe24dda1b56316fca09844ec7bf63e4290b0d"></a><a id="t.2"></a>
//      <table class="c11">
//         <tbody>
//            <tr class="c5">
//               <td class="c12" colspan="1" rowspan="1">
//                  <p class="c17"><span class="c2"></span></p>
//               </td>
//            </tr>
//         </tbody>
//      </table>
//      <p class="c13"><span class="c4">Daytime Phone: </span><span class="c15 c4 c9">[text|req|signer1|Daytime Phone|ID2 ]</span></p>
//      <a id="t.1aebe24dda1b56316fca09844ec7bf63e4290b0d"></a><a id="t.3"></a>
//      <table class="c16">
//         <tbody>
//            <tr class="c5">
//               <td class="c10" colspan="1" rowspan="1">
//                  <p class="c17"><span class="c2"></span></p>
//               </td>
//            </tr>
//         </tbody>
//      </table>
//      <p class="c13"><span class="c4">Mobile Phone: </span><span class="c15 c4 c9">[$mobile &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ]</span></p>
//      <a id="t.1aebe24dda1b56316fca09844ec7bf63e4290b0d"></a><a id="t.4"></a>
//      <table class="c18">
//         <tbody>
//            <tr class="c5">
//               <td class="c21" colspan="1" rowspan="1">
//                  <p class="c17"><span class="c2"></span></p>
//               </td>
//            </tr>
//         </tbody>
//      </table>
//      <p class="c0"><span class="c3"></span></p>
//      <p class="c0"><span class="c15 c22 c23"></span></p>
//      <p class="c13"><span class="c6">[sig|req|signer1 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;[date|req|signer1 &nbsp; &nbsp; &nbsp;]</span></p>
//      <p class="c13"><span class="c3">___________________________ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;____________________</span></p>
//      <p class="c13"><span class="c4">Signer1</span><span>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span><span class="c2">Signer1Date</span></p>
//      <p class="c0"><span class="c3"></span></p>
//      <p class="c0"><span class="c3"></span></p>
//      <p class="c0"><span class="c3"></span></p>
//      <p class="c0"><span class="c3"></span></p>
//      <p class="c0"><span class="c3"></span></p>
//      <p class="c0"><span class="c3"></span></p>
//      <p class="c0"><span class="c3"></span></p>
//      <p class="c0"><span class="c3"></span></p>
//      <p class="c0"><span class="c3"></span></p>
//      <p class="c13"><span class="c6">[def:$mobile|text|noreq|signer1|Mobile if different from Daytime|ID1]</span></p>
//      <p class="c0"><span class="c3"></span></p>
//      <p class="c0"><span class="c3"></span></p>
//      <p class="c0"><span class="c3"></span></p></body>';
//
//// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, '');
//
//// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
//
//// reset pointer to the last page
//$pdf->lastPage();
//
////Close and output PDF document
//$pdf->Output('example_006.pdf', 'I');
//
////============================================================+
//// END OF FILE
////============================================================+
//$token = 'MmQ5ZTVjYmM1ZDg4OGJlZjMyNTNjMDQ4OWQ2ODUxZjVlZmJhZDEyMTg2ZmU5YmEwZWI4NjJmNjY3ZGI3ZjI1YjA1YWY3MDcxMjFlODk5MjNmOWIzZDBiMjc2YjFhMzZhMjEzNDFmODU=';

//$client = new HelloSign\Client($api_key);
//$oauth_request = new HelloSign\OAuthTokenRequest(array(
//    'code' => '43e57313f54f4f2d',
//    'state' => 'somethingrandom',
//    'client_id' => '2d9e5cbc5d888bef3253c0489d6851f5',
//    'client_secret' => '249046db0fd92da7ddcbd1487feb7246'
//        ));
//
//
//
//// Request OAuth token for the first time
//$token1 = $client->requestOAuthToken($oauth_request);
//
//// Export token to array, store it to use later
//$hellosign_oauth = $token1->toArray($options);
//
//print_r($hellosign_oauth);
//
//echo "<br />you got here";
//
//// Populate token from array
//$token = new HelloSign\OAuthToken($hellosign_oauth);
//
//print_r($token);//
//
//// Provide the user's OAuth access token to the client
//$client = new HelloSign\Client($token);
//
////$signature_requests = $client->getSignatureRequests(1);
//$response = $client->getAccount();
//print_r($response->getWarnings());
//echo "<br />you got more here";
////echo("$signature_requests");

$client = new HelloSign\Client($api_key);
$pages = $client->getSignatureRequests()->getNumPages();

fopen('all_signature_requests.log', "w");
$page = 1;
$signature_requests = fopen('all_signature_requests.log', "a");
while ($page <= $pages) {
    $siganture_requests_object = print_r($client->getSignatureRequests($page), 1);
    fwrite($signature_requests, $siganture_requests_object);
    $page++;
}
?>

<!-- this send a signature request using GET parameters in a POST somehow -->
<form action="https://02b35105d83ab3170140283bd44ff05c958c87fa5a7c7346de1eb83d07f3715f:@api.hellosign.com/v3/signature_request/send?test_mode=1&signers[0][email_address]=alex%2Bsigner@hellosign.com&signers[0][name]=bob+swanson&file_url%5B0%5D=https%3A%2F%2Fcodifysignapi.blob.core.windows.net%2Fpdfs2%2FFreelancerAgreement%2CSchedule.pdf&form_fields_per_document%3D%5B%5B%7B%22api_id%22%3A%20%22e3f6ff_9%22%2C%20%22name%22%3A%20%22%22%2C%20%22type%22%3A%20%22signature%22%2C%20%22x%22%3A%20102%2C%20%22y%22%3A%20217%2C%20%22width%22%3A%20120%2C%20%22height%22%3A%2030%2C%20%22required%22%3A%20true%2C%20%22signer%22%3A%200%2C%20%22page%22%3A%203%7D%2C%7B%22api_id%22%3A%20%22fb001f_9%22%2C%20%22name%22%3A%20%22%22%2C%20%22type%22%3A%20%22signature%22%2C%20%22x%22%3A%20375%2C%20%22y%22%3A%20217%2C%20%22width%22%3A%20120%2C%20%22height%22%3A%2030%2C%20%22required%22%3A%20true%2C%20%22signer%22%3A%201%2C%20%22page%22%3A%203%7D%2C%7B%22api_id%22%3A%20%22f78b4f_9%22%2C%20%22name%22%3A%20%22%22%2C%20%22type%22%3A%20%22signature%22%2C%20%22x%22%3A%20375%2C%20%22y%22%3A%20550%2C%20%22width%22%3A%20120%2C%20%22height%22%3A%2030%2C%20%22required%22%3A%20true%2C%20%22signer%22%3A%201%2C%20%22page%22%3A%204%5D%5D%7D" method="post" enctype="multipart/form-data">        
    <fieldset>
        <input type="submit" value="Template Creation"/>
        <!--        <br />
                <input type="file" name="uploadedTemplateFile" id="uploadedTemplateFile"/>-->
        <p>Create a template</p>
    </fieldset>
</form>