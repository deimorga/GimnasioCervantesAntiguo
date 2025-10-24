<?php

$html = '
<style>
.gradient {
	border:0.1mm solid #220044; 
	background-color: #f0f2ff;
	background-gradient: linear #c7cdde #f0f2ff 0 1 0 0.5;
}
.radialgradient {
	border:0.1mm solid #220044; 
	/*background-color: #f0f2ff;
	background-gradient: radial #c7cdde #f0f2ff 0.5 0.5 0.5 0.5 0.65;
	;*/
	margin: auto;
}
.rounded {
	border:0.1mm solid #220044; 
	background-color: #f0f2ff;
	background-gradient: linear #c7cdde #f0f2ff 0 1 0 0.5;
	border-radius: 2mm;
	background-clip: border-box;
}
h4 {
	font-family: sans;
	font-weight: bold;
	margin-top: 1em;
	margin-bottom: 0.5em;
}
div {
	padding:1em; 
	margin-bottom: 1em;
	text-align:justify; 
}
.example pre {
	background-color: #d5d5d5; 
	margin: 1em 1cm;
	padding: 0 0.3cm;
}

pre { text-align:left }
pre.code { font-family: monospace }

</style>

<h4>Background Images</h4>
<div style="border:0.1mm solid #880000;  background-color:#ccffff; ">
ñkl
</div>

<h4>Rounded Borders</h4>
<div class="rounded">
Rounded corners to borders can be added using border-radius as defined in the draft spec. of <a href="http://www.w3.org/TR/2008/WD-css3-background-20080910/#layering">CSS3</a>. <br />

The two length values of the border-*-radius properties define the radii of a quarter ellipse that defines the shape of the corner of the outer border edge.
The first value is the horizontal radius. <br />
<span style="font-family: mono; font-size: 9pt;">border-top-left-radius: 55pt 25pt;</span>  55pt is radius of curve from top end of left border starting to go round to the top.<br />

If the second length is omitted it is equal to the first (and the corner is thus a quarter circle). If either length is zero, the corner is square, not rounded.<br />

The border-radius shorthand sets all four border-*-radius properties. If values are given before and after a slash, then the values before the slash set the horizontal radius and the values after the slash set the vertical radius. If there is no slash, then the values set both radii equally. The four values for each radii are given in the order top-left, top-right, bottom-right, bottom-left. If bottom-left is omitted it is the same as top-right. If bottom-right is omitted it is the same as top-left. If top-right is omitted it is the same as top-left.
</div>
<div class="rounded">
<span style="font-family: mono; font-size: 9pt;">border-radius: 4em;</span><br />

would be equivalent to<br />

<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     4em;<br />
border-top-right-radius:    4em;<br />
border-bottom-right-radius: 4em;<br />
border-bottom-left-radius:  4em;</span><br />
<br />
and<br />
<span style="font-family: mono; font-size: 9pt;">border-radius: 2em 1em 4em / 0.5em 3em;</span><br />
would be equivalent to<br />
<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     2em 0.5em;<br />
border-top-right-radius:    1em 3em;<br />
border-bottom-right-radius: 4em 0.5em;<br />
border-bottom-left-radius:  1em 3em;</span><span style="font-family: mono; font-size: 9pt;">border-radius: 4em;</span><br />

would be equivalent to<br />

<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     4em;<br />
border-top-right-radius:    4em;<br />
border-bottom-right-radius: 4em;<br />
border-bottom-left-radius:  4em;</span><br />
<br />
and<br />
<span style="font-family: mono; font-size: 9pt;">border-radius: 2em 1em 4em / 0.5em 3em;</span><br />
would be equivalent to<br />
<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     2em 0.5em;<br />
border-top-right-radius:    1em 3em;<br />
border-bottom-right-radius: 4em 0.5em;<br />
border-bottom-left-radius:  1em 3em;</span><span style="font-family: mono; font-size: 9pt;">border-radius: 4em;</span><br />

would be equivalent to<br />

<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     4em;<br />
border-top-right-radius:    4em;<br />
border-bottom-right-radius: 4em;<br />
border-bottom-left-radius:  4em;</span><br />
<br />
and<br />
<span style="font-family: mono; font-size: 9pt;">border-radius: 2em 1em 4em / 0.5em 3em;</span><br />
would be equivalent to<br />
<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     2em 0.5em;<br />
border-top-right-radius:    1em 3em;<br />
border-bottom-right-radius: 4em 0.5em;<br />
border-bottom-left-radius:  1em 3em;</span><span style="font-family: mono; font-size: 9pt;">border-radius: 4em;</span><br />

would be equivalent to<br />

<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     4em;<br />
border-top-right-radius:    4em;<br />
border-bottom-right-radius: 4em;<br />
border-bottom-left-radius:  4em;</span><br />
<br />
and<br />
<span style="font-family: mono; font-size: 9pt;">border-radius: 2em 1em 4em / 0.5em 3em;</span><br />
would be equivalent to<br />
<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     2em 0.5em;<br />
border-top-right-radius:    1em 3em;<br />
border-bottom-right-radius: 4em 0.5em;<br />
border-bottom-left-radius:  1em 3em;</span><span style="font-family: mono; font-size: 9pt;">border-radius: 4em;</span><br />

would be equivalent to<br />

<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     4em;<br />
border-top-right-radius:    4em;<br />
border-bottom-right-radius: 4em;<br />
border-bottom-left-radius:  4em;</span><br />
<br />
and<br />
<span style="font-family: mono; font-size: 9pt;">border-radius: 2em 1em 4em / 0.5em 3em;</span><br />
would be equivalent to<br />
<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     2em 0.5em;<br />
border-top-right-radius:    1em 3em;<br />
border-bottom-right-radius: 4em 0.5em;<br />
border-bottom-left-radius:  1em 3em;</span><span style="font-family: mono; font-size: 9pt;">border-radius: 4em;</span><br />

would be equivalent to<br />

<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     4em;<br />
border-top-right-radius:    4em;<br />
border-bottom-right-radius: 4em;<br />
border-bottom-left-radius:  4em;</span><br />
<br />
and<br />
<span style="font-family: mono; font-size: 9pt;">border-radius: 2em 1em 4em / 0.5em 3em;</span><br />
would be equivalent to<br />
<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     2em 0.5em;<br />
border-top-right-radius:    1em 3em;<br />
border-bottom-right-radius: 4em 0.5em;<br />
border-bottom-left-radius:  1em 3em;</span><span style="font-family: mono; font-size: 9pt;">border-radius: 4em;</span><br />

would be equivalent to<br />

<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     4em;<br />
border-top-right-radius:    4em;<br />
border-bottom-right-radius: 4em;<br />
border-bottom-left-radius:  4em;</span><br />
<br />
and<br />
<span style="font-family: mono; font-size: 9pt;">border-radius: 2em 1em 4em / 0.5em 3em;</span><br />
would be equivalent to<br />
<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     2em 0.5em;<br />
border-top-right-radius:    1em 3em;<br />
border-bottom-right-radius: 4em 0.5em;<br />
border-bottom-left-radius:  1em 3em;</span><span style="font-family: mono; font-size: 9pt;">border-radius: 4em;</span><br />

would be equivalent to<br />

<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     4em;<br />
border-top-right-radius:    4em;<br />
border-bottom-right-radius: 4em;<br />
border-bottom-left-radius:  4em;</span><br />
<br />
and<br />
<span style="font-family: mono; font-size: 9pt;">border-radius: 2em 1em 4em / 0.5em 3em;</span><br />
would be equivalent to<br />
<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     2em 0.5em;<br />
border-top-right-radius:    1em 3em;<br />
border-bottom-right-radius: 4em 0.5em;<br />
border-bottom-left-radius:  1em 3em;</span><span style="font-family: mono; font-size: 9pt;">border-radius: 4em;</span><br />

would be equivalent to<br />

<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     4em;<br />
border-top-right-radius:    4em;<br />
border-bottom-right-radius: 4em;<br />
border-bottom-left-radius:  4em;</span><br />
<br />
and<br />
<span style="font-family: mono; font-size: 9pt;">border-radius: 2em 1em 4em / 0.5em 3em;</span><br />
would be equivalent to<br />
<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     2em 0.5em;<br />
border-top-right-radius:    1em 3em;<br />
border-bottom-right-radius: 4em 0.5em;<br />
border-bottom-left-radius:  1em 3em;</span><span style="font-family: mono; font-size: 9pt;">border-radius: 4em;</span><br />

would be equivalent to<br />

<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     4em;<br />
border-top-right-radius:    4em;<br />
border-bottom-right-radius: 4em;<br />
border-bottom-left-radius:  4em;</span><br />
<br />
and<br />
<span style="font-family: mono; font-size: 9pt;">border-radius: 2em 1em 4em / 0.5em 3em;</span><br />
would be equivalent to<br />
<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     2em 0.5em;<br />
border-top-right-radius:    1em 3em;<br />
border-bottom-right-radius: 4em 0.5em;<br />
border-bottom-left-radius:  1em 3em;</span><span style="font-family: mono; font-size: 9pt;">border-radius: 4em;</span><br />

would be equivalent to<br />

<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     4em;<br />
border-top-right-radius:    4em;<br />
border-bottom-right-radius: 4em;<br />
border-bottom-left-radius:  4em;</span><br />
<br />
and<br />
<span style="font-family: mono; font-size: 9pt;">border-radius: 2em 1em 4em / 0.5em 3em;</span><br />
would be equivalent to<br />
<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     2em 0.5em;<br />
border-top-right-radius:    1em 3em;<br />
border-bottom-right-radius: 4em 0.5em;<br />
border-bottom-left-radius:  1em 3em;</span><span style="font-family: mono; font-size: 9pt;">border-radius: 4em;</span><br />

would be equivalent to<br />

<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     4em;<br />
border-top-right-radius:    4em;<br />
border-bottom-right-radius: 4em;<br />
border-bottom-left-radius:  4em;</span><br />
<br />
and<br />
<span style="font-family: mono; font-size: 9pt;">border-radius: 2em 1em 4em / 0.5em 3em;</span><br />
would be equivalent to<br />
<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     2em 0.5em;<br />
border-top-right-radius:    1em 3em;<br />
border-bottom-right-radius: 4em 0.5em;<br />
border-bottom-left-radius:  1em 3em;</span><span style="font-family: mono; font-size: 9pt;">border-radius: 4em;</span><br />

would be equivalent to<br />

<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     4em;<br />
border-top-right-radius:    4em;<br />
border-bottom-right-radius: 4em;<br />
border-bottom-left-radius:  4em;</span><br />
<br />
and<br />
<span style="font-family: mono; font-size: 9pt;">border-radius: 2em 1em 4em / 0.5em 3em;</span><br />
would be equivalent to<br />
<span style="font-family: mono; font-size: 9pt;">border-top-left-radius:     2em 0.5em;<br />
border-top-right-radius:    1em 3em;<br />
border-bottom-right-radius: 4em 0.5em;<br />
border-bottom-left-radius:  1em 3em;</span>
</div>

';

//==============================================================
//==============================================================
//==============================================================
include("../mpdf.php");

/*p$mpdf=new mPDF('s'); 

$mpdf->SetDisplayMode('fullpage');
*/
$mpdf=new mPDF('en-GB','Legal','','',15,15,0,0,0,0); 

$mpdf->useOnlyCoreFonts = true;
$mpdf->SetDisplayMode('fullpage');

$mpdf->SetTitle('Recibo');

$mpdf->SetAuthor('conpropiedad');

// To add a DRAFT watermark
//$mpdf->setUnvalidatedText('Alcaldia de Villavicencio');
//$mpdf->TopicIsUnvalidated = 1;

$mpdf->AddPage();

// LOAD a stylesheet


$mpdf->WriteHTML($html);	// Separate Paragraphs  defined by font

$mpdf->Output('123.pdf','D'); 

exit;

//==============================================================
//==============================================================
//==============================================================


?>