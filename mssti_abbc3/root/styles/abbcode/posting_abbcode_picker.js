// Title: Tigra Color Picker
// URL: http://www.softcomplex.com/products/tigra_color_picker/
// Version: 1.1
// Date: 06/26/2003 (mm/dd/yyyy)
// Note: Permission given to use this script in ANY kind of applications if
//    header lines are left unchanged.
// Note: Script consists of two files: picker.js and picker.html

// Note: Script Updated for phpbb 3.0.7-PL1 by leviatan21

var TCP = new TColorPicker();

function TCPopup(url, field, palette) {
	this.field = field;
	this.initPalette = !palette || palette > 3 ? 0 : palette;
	var w = 200, h = 240,
	move = screen ? ',left=' + ((screen.width - w) >> 1) + ',top=' + ((screen.height - h) >> 1) : '', 
	o_colWindow = window.open(url.replace(/&amp;/g, '&') + '&field=' + field, null, "help=no,status=no,scrollbars=no,resizable=no" + move + ",width=" + w + ",height=" + h + ",dependent=yes", true);
	o_colWindow.opener = window;
	o_colWindow.focus();
}

function TCBuildCell (R, G, B, w, h) {
	return '<td bgcolor="#' + this.dec2hex((R << 16) + (G << 8) + B) + '"><a href="javascript:P.S(\'' + this.dec2hex((R << 16) + (G << 8) + B) + '\')" onmouseover="P.P(\'' + this.dec2hex((R << 16) + (G << 8) + B) + '\')"><img src="./styles/abbcode/pixel.gif" width="' + w + '" height="' + h + '" border="0"></a></td>' + '\n';
}

function TCSelect(c) {
	if (this.field == 'color')
	{
		bbfontstyle('[color=' + '#' + c.toLowerCase() + ']', "[/color]");
	}
	else if (this.field == 'highlight')
	{
		bbfontstyle('[highlight=' + '#' + c.toLowerCase() + ']', "[/highlight]");
	}
//	this.field.value = '#' + c.toUpperCase();
	this.win.close();
}

function TCPaint(c, b_noPref) {
	c = (b_noPref ? '' : '#') + c.toUpperCase();
	if (this.o_samp) 
		this.o_samp.innerHTML = '<font face=Tahoma size=2>' + c +' <font color=white>' + c + '</font></font>'
	if(this.doc.layers)
		this.sample.bgColor = c;
	else { 
		if (this.sample.backgroundColor != null) this.sample.backgroundColor = c;
		else if (this.sample.background != null) this.sample.background = c;
	}
}

function TCGenerateSafe() {
	var s = '';
	for (j = 0; j < 12; j ++) {
		s += "<tr>";
		for (k = 0; k < 3; k ++)
			for (i = 0; i <= 5; i ++)
				s += this.bldCell(k * 51 + (j % 2) * 51 * 3, Math.floor(j / 2) * 51, i * 51, 8, 10);
		s += "</tr>" + '\n';
	}
	return s;
}

function TCGenerateWind() {
	var s = '';
	for (j = 0; j < 12; j ++) {
		s += "<tr>";
		for (k = 0; k < 3; k ++)
			for (i = 0; i <= 5; i++)
				s += this.bldCell(i * 51, k * 51 + (j % 2) * 51 * 3, Math.floor(j / 2) * 51, 8, 10);
		s += "</tr>" + '\n';
	}
	return s	
}
function TCGenerateMac() {
	var s = '';
	var c = 0,n = 1;
	var r,g,b;
	for (j = 0; j < 15; j ++) {
		s += "<tr>";
		for (k = 0; k < 3; k ++)
			for (i = 0; i <= 5; i++){
				if(j<12){
				s += this.bldCell( 255-(Math.floor(j / 2) * 51), 255-(k * 51 + (j % 2) * 51 * 3),255-(i * 51), 8, 10);
				}else{
					if(n<=14){
						r = 255-(n * 17);
						g=b=0;
					}else if(n>14 && n<=28){
						g = 255-((n-14) * 17);
						r=b=0;
					}else if(n>28 && n<=42){
						b = 255-((n-28) * 17);
						r=g=0;
					}else{
						r=g=b=255-((n-42) * 17);
					}
					s += this.bldCell( r, g,b, 8, 10);
					n++;
				}
			}
		s += "</tr>" + '\n';
	}
	return s;
}

function TCGenerateGray() {
	var s = '';
	for (j = 0; j <= 15; j ++) {
		s += "<tr>";
		for (k = 0; k <= 15; k ++) {
			g = Math.floor((k + j * 16) % 256);
			s += this.bldCell(g, g, g, 9, 7);
		}
		s += '</tr>' + '\n';
	}
	return s
}

function TCDec2Hex(v) {
	v = v.toString(16);
	for(; v.length < 6; v = '0' + v);
	return v;
}

function TCChgMode(v) {
	for (var k in this.divs) this.hide(k);
	this.show(v);
}

function TColorPicker(field) {
	this.build0 = TCGenerateSafe;
	this.build1 = TCGenerateWind;
	this.build2 = TCGenerateGray;
	this.build3 = TCGenerateMac;
	this.show = document.layers ? function (div) { this.divs[div].visibility = 'show' } : function (div) { this.divs[div].visibility = 'visible' };
	this.hide = document.layers ? function (div) { this.divs[div].visibility = 'hide' } : function (div) { this.divs[div].visibility = 'hidden' };
	// event handlers
	this.C       = TCChgMode;
	this.S       = TCSelect;
	this.P       = TCPaint;
	this.popup   = TCPopup;
	this.draw    = TCDraw;
	this.dec2hex = TCDec2Hex;
	this.bldCell = TCBuildCell;
	this.divs = [];
}

function TCDraw(o_win, o_doc, txt) {
	this.txt = txt;
	this.win = o_win;
	this.doc = o_doc;
	var s_tag_openT = o_doc.layers ? 'layer visibility=hidden top=54 left=5 width=182' : 'div style=visibility:hidden;position:absolute;left:6px;top:54px;width:182px;height:0',
	s_tag_openS  = o_doc.layers ? 'layer top=32 left=6' : 'div',
	s_tag_close  = o_doc.layers ? 'layer' : 'div'
		
	this.doc.write('<' + s_tag_openS + ' id="sam" name="sam">' + '\n' + '<table cellpadding="0" cellspacing="0" border="1" width="181px" class="bd">' + '\n' + '<tr>' + '\n' + '<td height="18px">' + '\n' + '<div id="samp"><font face=Tahoma size=2>' + this.txt + '<font color=white>' + this.txt + '</font></font></div>' + '\n' + '</td>' + '\n' + '</tr>' + '\n' + '</table></' + s_tag_close + '>' + '\n');
	this.sample = o_doc.layers ? o_doc.layers['sam'] : o_doc.getElementById ? o_doc.getElementById('sam').style : o_doc.all['sam'].style

	for (var k = 0; k < 4; k ++) {
		this.doc.write('<' + s_tag_openT + ' id="p' + k + '" name="p' + k + '">' + '\n' + '<table cellpadding="0" cellspacing="0" border="1" class="bd">' + '\n' + this['build' + k]() + '\n' + '</table></' + s_tag_close + '>' + '\n');
		this.divs[k] = o_doc.layers ? o_doc.layers['p' + k] : o_doc.all ? o_doc.all['p' + k].style : o_doc.getElementById('p' + k).style
	}
	if (!o_doc.layers && o_doc.body.innerHTML) 
		this.o_samp = o_doc.all ? o_doc.all.samp : o_doc.getElementById('samp');
	this.C(this.initPalette);
//	if (this.field.value) this.P(this.field.value, true)
}
