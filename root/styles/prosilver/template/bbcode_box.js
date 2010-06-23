

var copy_paste ;

var help_line2 = {
	cb_justify : "Texto justificado: [align=justify]texto[/align]",
	cb_right : "Texto alineado a la derecha: [align=right]texto[/align]",
	cb_center : "Texto alineado al centro: [align=center]texto[/align]",
	cb_left : "Texto alineado a la izquierda: [align=left]texto[/align]",

	cb_sup : "Exponente: [sup]texto[/sup]",
	cb_sub : "Subíndice: [sub]texto[/sub]",

	cb_b : "Negrita: [b]texto[/b]",
	cb_i : "Cursiva: [i]texto[/i]",
	cb_u : "Subrayado: [u]texto[/u]",
	cb_strike : "Texto Tachado: [s]texto[/s]",

	cb_fade : "Decolorear Texto: [fade]texto[/fade]", // (Sólo Internet Explorer)",
	cb_grad : "Insertar texto con gradiente", // (Sólo Internet Explorer)",

	cb_rtl : "Haz que el mensaje vaya de derecha a izquierda",
	cb_ltr : "Haz que el mensaje vaya de izquierda a derecha",

	cb_marqd : "Desplazamiento de texto hacia abajo: [marq=down]texto[/marq]",
	cb_marqu : "Desplazamiento de texto hacia arriba: [marq=up]texto[/marq]",
	cb_marqr : "Desplazamiento de texto hacia la derecha: [marq=right]texto[/marq]",
	cb_marql : "Desplazamiento de texto hacia la izquierda: [marq=left]texto[/marq]",

	cb_table : "Insertar una tabla [table=][tr=][td=] texto [/td][/tr][/table]",
	
	cb_quote : "Citar: [quote]texto[/quote]",
	cb_code : "Codigo: [code]codigo[/code]",

	cb_spoil : "Ocultar: [spoil]texto[/spoil]",

	cb_url : "Insertar URL: [url]http://...[/url] or [url=http://...]Nombre Web[/url]",
	cb_mail : "Insertar E-mail: [email]tuemail@phpbb.com[/email]",
	cb_web : "Instar página web en el post: [web]URL página[/web]",

	cb_img : "Insertar Imagen: [img]http://...[/img]",

	cb_flash : "Insertar archivo de flash: [flash width=# height=#]URL Archivo[/flash]",
	cb_video : "Insertar archivo de video: [video width=# height=#]URL Archivo[/video]",
	cb_stream : "Insertar archivo de sonido: [stream]URL Archivo[/stream]",
	cb_ram : "Insertar archivo Real Media: [ram]URL Archivo[/ram]",
	cb_stage6 : "Insertar archivo Stage6: [stage6]Stage6 ID[/stage6]",
	cb_googlevid :  "Insertar archivo de video: [GVideo]URL Archivo[/GVideo]",
	cb_youtube : "Insertar video Youtube: [youtube]URL Archivo[/youtube]",

	cb_listb : "Lista Desordenada: [list]texto[/list] Nota: usted puede usar [*] para insertar puntos",
	cb_listm : "Lista Ordenada: [list=1|a]texto[/list] Nota: usted puede usar [*] para insertar puntos",
	cb_hr : "Insertar Línea Separadora [hr]",

	cb_fc : "Color de Letra: [color=red]texto[/color] Usted puede usar colores HTML color=#FF0000",
	cb_fs : "Tamaño de Letra: [size=10]Texto Pequeño[/size]",
	cb_ft : "Tipo de Letra: [font=Tahoma]texto[/font]",
	cb_hili : "Texto resaltado: [highlight=red]texto[/highlight] Usted puede usar colores HTML color=#FF0000",
	
	cb_cut : "Borrar el texto seleccionado",
	cb_copy : "Copiar el texto seleccionado",
	cb_paste : "Pegar el texto copiado",
	cb_plain : "Borrar BBCodes del texto seleccionado",
	
	cb_symbol : "Insertar símbolo en el post"
}

function helpline2(help)
{
	// document.forms[form_name].helpbox.value = help_line[help];
	if ( !help_line2["cb_" + help] )
	{
	//	document.getElementById('helpline').innerHTML = help_line[help] + '&nbsp;';
		document.forms[form_name].helpbox.value = help_line[help];
	}
	else
	{
	//	document.getElementById('helpline').innerHTML = help_line2["cb_" + help] + '&nbsp;';
		document.forms[form_name].helpbox.value = help_line2["cb_" + help]
	}
}

function bbstyle2(bbcode,ftvalue)
{
	var doc;
	if (document.forms[form_name])
	{
		doc = document;
	}
	else 
	{
		doc = opener.document;
	}
	var txtarea = doc.forms[form_name].elements[text_name];
	
	if ( bbcode == "justify" ) // BBCjustify();
	{
		bbfontstyle("[align=justify]", "[/align]");
	}
	else if ( bbcode == "right" ) // BBCright();
	{
		bbfontstyle("[align=right]", "[/align]");
	}
	else if ( bbcode == "center" ) // BBCcenter();
	{
		bbfontstyle("[align=center]", "[/align]");
	}
	else if ( bbcode == "left" ) // BBCleft();
	{
		bbfontstyle("[align=left]", "[/align]");
	}
	else if ( bbcode == "sup" ) // BBCsup();
	{
		bbfontstyle("[sup]", "[/sup]");
	}
	else if ( bbcode == "sub" ) // BBCsub();
	{
		bbfontstyle("[sub]", "[/sub]");
	}
	else if ( bbcode == "bold" ) // BBCbold();
	{
		bbfontstyle("[b]", "[/b]");
	}
	else if ( bbcode == "italic" ) // BBCitalic();
	{
		bbfontstyle("[i]", "[/i]");
	}
	else if ( bbcode == "under" ) // BBCunder();
	{
		bbfontstyle("[u]", "[/u]");
	}
	else if ( bbcode == "strike" ) // BBCstrike();
	{
		bbfontstyle("[s]", "[/s]");
	}
	else if ( bbcode == "fade" ) // BBCfade();
	{
		bbfontstyle("[fade]", "[/fade]");
	}
	else if ( bbcode == "grad" ) // BBCgrad();
	{
		var clientPC = navigator.userAgent.toLowerCase(); // Get client info
		var clientVer = parseInt(navigator.appVersion); // Get browser version
		
		var is_ie = ((clientPC.indexOf('msie') != -1) && (clientPC.indexOf('opera') == -1));
		var is_win = ((clientPC.indexOf('win') != -1) || (clientPC.indexOf('16bit') != -1));

		var oSelect,oSelectRange,oSelectLength;
		txtarea.focus();
		
		if ((clientVer >= 4) && is_ie && is_win)
		{
			oSelectRange = document.selection.createRange();
			oSelectLength = oSelectRange.text.length
		}
		else if (document.forms[form_name].elements[text_name].selectionEnd && (document.forms[form_name].elements[text_name].selectionEnd - document.forms[form_name].elements[text_name].selectionStart > 0))
		{
			var selLength = txtarea.textLength;
			var selStart = txtarea.selectionStart;
			var selEnd = txtarea.selectionEnd;
			var scrollTop = txtarea.scrollTop;
			
			if (selEnd == 1 || selEnd == 2)
			{
				selEnd = selLength;
			}
			
			var s1 = (txtarea.value).substring(0,selStart);
			var s2 = (txtarea.value).substring(selStart, selEnd);
			var s3 = (txtarea.value).substring(selEnd, selLength);

			oSelectRange = s2;
			oSelectLength = selEnd - selStart;
		}
		if ( (oSelectLength < 1) || (!oSelectLength) )
		{
			alert("Por favor, primero seleccione el texto : " + oSelectLength);
			return;
		}
		if (oSelectLength > 120)
		{
			alert("Solo se permite un tamaño inferior a 120 letras : " + oSelectLength);
			return;
		}
		if (window.showModalDialog)
		{
			showModalDialog("bbcode_box/grad.htm",oSelectRange,"help:no; center:yes; status:no; dialogHeight:100px; dialogWidth:650px");
		}
		else
		{
			initPopUp();
			showPopWin('bbcode_box/modalContent.html', 650, 100, true);
		}
	}
	else if ( bbcode == "dirrtl" ) // BBCdir('rtl');
	{
	//	txtarea.dir=('rtl');
		bbfontstyle("[dir=rtl]", "[/dir]");
	}
	else if ( bbcode == "dirltr" ) // BBCdir('ltr');
	{
	//	txtarea.dir=('ltr');
		bbfontstyle("[dir=ltr]", "[/dir]");
	}
	else if ( bbcode == "marqd" ) // BBCmarqd();
	{
		bbfontstyle("[marq=down]", "[/marq]");
	}
	else if ( bbcode == "marqu" ) // BBCmarqu();
	{
		bbfontstyle("[marq=up]", "[/marq]");
	}
	else if ( bbcode == "marql" ) // BBCmarql();
	{
		bbfontstyle("[marq=left]", "[/marq]");
	}
	else if ( bbcode == "marqr" ) // BBCmarqr();
	{
		bbfontstyle("[marq=right]", "[/marq]");
	}
	else if ( bbcode == "code" ) // BBCcode();
	{
		bbfontstyle("[code]", "[/code]");
	}
	else if ( bbcode == "quote" ) // BBCquote();
	{
		bbfontstyle("[quote]", "[/quote]");
	}
	else if ( bbcode == "spoil" ) // BBCspoil();
	{
		bbfontstyle("[spoil]", "[/spoil]");
	}
	else if ( bbcode == "table" ) // BBCtable();
	{
		bbfontstyle("[table=][tr=][td=]","[/td][/tr][/table]");
	}
	else if ( bbcode == "url" ) // BBCurl();
	{
		var FoundErrors = '';
		var enterURL   = prompt("Introduzca la URL", "http://");
		var enterTITLE = prompt("Introduzca el nombre de la página", "Nombre Página Web");
		if (!enterURL)
		{
			FoundErrors += "Usted no escbribió la URL.";
		}
		if (!enterTITLE)
		{
			FoundErrors += "Usted no escribió el nombre de la página.";
		}
		if (FoundErrors)
		{
			alert("Error:"+FoundErrors);
			return;
		}
		bbfontstyle("[url="+enterURL+"]"+enterTITLE, "[/url]");
	}
	else if ( bbcode == "web" ) // BBCweb();
	{
		var FoundErrors = '';
		var enterURL   = prompt("Introduzca la URL", "http://");
		if (!enterURL)
		{
			FoundErrors += "Usted no escbribió la URL.";
		}
		var enterW   = prompt("Introduzca la anchura ", "99%");
		if (!enterW)
		{
			FoundErrors += "Usted no escribió la anchura.";
		}
		var enterH   = prompt("Introduzca la altura", "500");
		if (!enterH)
		{
			FoundErrors += "Usted no escribió la altura.";
		}
		if (FoundErrors)
		{
			alert("Error:"+FoundErrors);
			return;
		}
		bbfontstyle("[web width="+enterW+" height="+enterH+"]"+enterURL, "[/web]");
	}
	else if ( bbcode == "email" ) // BBCmail();
	{
		var FoundErrors = '';
		var enterMail   = prompt("Introduzca la dirección E-mail","");
		if (!enterMail)
		{
			FoundErrors += "Usted no escribió la dirección E-mail.";
		}
		if (FoundErrors)
		{
			alert("Error:"+FoundErrors);
			return;
		}
		bbfontstyle("[email]"+enterMail, "[/email]");
	}
	else if ( bbcode == "img" ) // BBCimg();
	{
		var FoundErrors = '';
		var enterURL   = prompt("Introduzca la URL de la imagen","http://");
		if (!enterURL)
		{
			FoundErrors += "Usted no escribió la URL de la imagen";
		}
		if (FoundErrors)
		{
			alert("Error :"+FoundErrors);
			return;
		}
		bbfontstyle("[img]"+enterURL, "[/img]");
	}
	else if ( bbcode == "flash" ) // BBCflash();
	{
		var FoundErrors = '';
		var enterURL   = prompt("Introduzca la URL del archivo flash", "http://");
		if (!enterURL)
		{
			FoundErrors += "Usted no escribió la URL del archivo flash.";
		}
		var enterW   = prompt("Introduzca la anchura del archivo flash", "250");
		if (!enterW)
		{
			FoundErrors += "Usted no escribió la anchura del archivo flash.";
		}
		var enterH   = prompt("Introduzca la altura del archivo flash", "250");
		if (!enterH)
		{
			FoundErrors += "Usted no escribió la altura del archivo flash.";
		}
		if (FoundErrors)
		{
			alert("Error:"+FoundErrors);
			return;
		}
		bbfontstyle("[flash width="+enterW+" height="+enterH+"]"+enterURL, "[/flash]");
	}
	else if ( bbcode == "video" ) // BBCvideo();
	{
		var FoundErrors = '';
		var enterURL   = prompt("Por favor introduzca la URL del archivo de video", "http://");
		if (!enterURL)
		{
			FoundErrors += "Usted no escribió la URL del archivo.";
		}
		var enterW   = prompt("Introduzca la anchura del archivo de video", "400");
		if (!enterW)
		{
			FoundErrors += "Usted no introdujo la anchura del archivo de video.";
		}
		var enterH   = prompt("Introduzca la altura del archivo de video", "350");
		if (!enterH)
		{
			FoundErrors += "Usted no instrodujo la altura del archivo de video.";
		}
		if (FoundErrors)
		{
			alert("Error:"+FoundErrors);
			return;
		}
		bbfontstyle("[video width="+enterW+" height="+enterH+"]"+enterURL, "[/video]");
	}
	else if ( bbcode == "stream" ) // BBCstream();
	{
		var FoundErrors = '';
		var enterURL   = prompt("Por favor, escriba la URL del archivo de sonido","http://");
		if (!enterURL)
		{
			FoundErrors += "Usted no escribió la URL del archivo.";
		}
		if (FoundErrors)
		{
			alert("Error:"+FoundErrors);
			return;
		}
		bbfontstyle("[stream]"+enterURL, "[/stream]");
	}
	else if ( bbcode == "ram" ) // BBCram();
	{
		var FoundErrors = '';
		var enterURL   = prompt("Por favor, escriba la URL del archivo real media","http://");
		if (!enterURL)
		{
			FoundErrors += "Usted no escribió la URL del archivo.";
		}
		var enterW   = prompt("Introduzca la anchura del archivo real media", "220");
		if (!enterW)
		{
			FoundErrors += "Usted no introdujo la anchura del archivo real media.";
		}
		var enterH   = prompt("Introduzca la altura del archivo real media", "140");
		if (!enterH)
		{
			FoundErrors += "Usted no introdujo la altura del archivo real media.";
		}
		if (FoundErrors)
		{
			alert("Error:"+FoundErrors);
			return;
		}
		bbfontstyle("[ram width="+enterW+" height="+enterH+"]"+enterURL, "[/ram]");
	}
	else if ( bbcode == "stage" ) // BBCstage();
	{
		var FoundErrors = '';
		var enterURL   = prompt("Ingresa el Stage6 ID","0");
		if (!enterURL)
		{
			FoundErrors += "No has escrito el Stage6 ID";
		}
		var enterW   = prompt("Introduzca la anchura del archivo real media", "704");
		if (!enterW)
		{
			FoundErrors += "Usted no introdujo la anchura del archivo real media.";
		}
		var enterH   = prompt("Introduzca la altura del archivo real media", "496");
		if (!enterH)
		{
			FoundErrors += "Usted no introdujo la altura del archivo real media.";
		}
		if (FoundErrors)
		{
			alert("Error :"+FoundErrors);
			return;
		}
		bbfontstyle("[stage6 width="+enterW+" height="+enterH+"]"+enterURL, "[/stage6]");
	}
	else if ( bbcode == "GVideo" ) // BBCGVideo();
	{
		var FoundErrors = '';
		var enterURL   = prompt("Por favor, escriba la URL del video de Google Video - Ejemplo: http://video.google.com/videoplay?docid=-8351924403384451128","http://");
		if (!enterURL)
		{
			FoundErrors += "Usted no escribió la URL del video Google Video.";
		}
		if (FoundErrors)
		{
			alert("Error:"+FoundErrors);
			return;
		}
		bbfontstyle("[GVideo]"+enterURL, "[/GVideo]");
	}
	else if ( bbcode == "youtube" ) // BBCyoutube();
	{
		var FoundErrors = '';
		var enterURL   = prompt("Por favor, escriba la URL del video de YouTube - Ejemplo: http://www.youtube.com/watch?v=aabbcc12","http://");
		if (!enterURL)
		{
			FoundErrors += "Usted no escribió la URL del video YouTube.";
		}
		if (FoundErrors)
		{
			alert("Error:"+FoundErrors);
			return;
		}
		bbfontstyle("[youtube]"+enterURL, "[/youtube]");
	}
	else if ( bbcode == "listb" ) // BBClist();
	{
		bbfontstyle("[list][*]", "[/list]");
	}
	else if ( bbcode == "listm" ) // BBClist();
	{
		bbfontstyle("[list=1][*]", "[/list]");
	}
	else if ( bbcode == "hr" ) // BBChr();
	{
		bbfontstyle("[hr]", "");
	}
	else if ( bbcode == "plain" ) // BBCplain();
	{
		if ((clientVer >= 4) && is_ie && is_win)
		{
			// Get text selection
			theSelection = doc.selection.createRange().text;
			
			if (theSelection != '')
			{
				temp = theSelection;
				temp = temp.replace(/\[FLASH=([^\]]*)\]WIDTH=[0-9]{0,4} HEIGHT=[0-9]{0,4}\[\/FLASH\]/gi,"$1");
				temp = temp.replace(/\[VIDEO=([^\]]*)\]WIDTH=[0-9]{0,4} HEIGHT=[0-9]{0,4}\[\/VIDEO\]/gi,"$1");
				document.selection.createRange().text = temp.replace(/\[[^\]]*\]/gi,"");
			}
		}
		else if (document.forms[form_name].elements[text_name].selectionEnd && (document.forms[form_name].elements[text_name].selectionEnd - document.forms[form_name].elements[text_name].selectionStart > 0))
		{
			var selLength = txtarea.textLength;
			var selStart = txtarea.selectionStart;
			var selEnd = txtarea.selectionEnd;
			var scrollTop = txtarea.scrollTop;
			
			if (selEnd == 1 || selEnd == 2)
			{
				selEnd = selLength;
			}
			
			var s1 = (txtarea.value).substring(0,selStart);
			var s2 = (txtarea.value).substring(selStart, selEnd);
			var s3 = (txtarea.value).substring(selEnd, selLength);

			temp = s2;
			temp = temp.replace(/\[FLASH=([^\]]*)\]WIDTH=[0-9]{0,4} HEIGHT=[0-9]{0,4}\[\/FLASH\]/gi,"$1");
			temp = temp.replace(/\[VIDEO=([^\]]*)\]WIDTH=[0-9]{0,4} HEIGHT=[0-9]{0,4}\[\/VIDEO\]/gi,"$1");
			temp = temp.replace(/\[[^\]]*\]/gi,"");
			txtarea.value = s1 + temp + s3;

			txtarea.selectionStart = selEnd + open.length + close.length;
			txtarea.selectionEnd = txtarea.selectionStart;
			txtarea.focus();
		}
	}
	else if ( bbcode == "ft" ) //	BBCft(ftvalue);
	{
		bbfontstyle("[font="+ftvalue+"]", "[/font]");
	}
	else if ( bbcode == "cut" )
	{
		if ((clientVer >= 4) && is_ie && is_win)
		{
			// Get text selection
			theSelection = doc.selection.createRange().text;
			
			if (theSelection != '')
			{
				document.selection.createRange().text = '';
			}
		}
		else if (document.forms[form_name].elements[text_name].selectionEnd && (document.forms[form_name].elements[text_name].selectionEnd - document.forms[form_name].elements[text_name].selectionStart > 0))
		{
			var selLength = txtarea.textLength;
			var selStart = txtarea.selectionStart;
			var selEnd = txtarea.selectionEnd;
			var scrollTop = txtarea.scrollTop;
			
			if (selEnd == 1 || selEnd == 2)
			{
				selEnd = selLength;
			}
			
			txtarea.value = (txtarea.value).substring(0,selStart) + (txtarea.value).substring(selEnd, selLength);
			txtarea.focus();
		}
	}
	else if ( bbcode == "copy" )
	{
		if ((clientVer >= 4) && is_ie && is_win)
		{
			// Get text selection
			copy_paste = doc.selection.createRange().text;			
		}
		else if (document.forms[form_name].elements[text_name].selectionEnd && (document.forms[form_name].elements[text_name].selectionEnd - document.forms[form_name].elements[text_name].selectionStart > 0))
		{
			var selLength = txtarea.textLength;
			var selStart = txtarea.selectionStart;
			var selEnd = txtarea.selectionEnd;
			var scrollTop = txtarea.scrollTop;
			
			if (selEnd == 1 || selEnd == 2)
			{
				selEnd = selLength;
			}
			
			copy_paste = (txtarea.value).substring(selStart, selEnd);
			txtarea.focus();
		}
	}
	else if ( bbcode == "paste" )
	{
		bbfontstyle(''+copy_paste, '');
	}
	else
	{
		alert ("Error inesperado al utilizar eiqueta : "+bbcode);
		return;
	}
}

var FadeOut = true
var FadePas = 0;
var FadeMax = 255;
var FadeMin = 0;
var FadeStep = 2;
var FadeInt = 10;
var FadeInterval;

function fade_ontimer()
{
	if (FadeOut)
	{
		FadePas+=FadeStep;
		if (FadePas>FadeMax)
		{
			FadeOut = false;
		}
	}
	else
	{
		FadePas-=FadeStep;
		if (FadePas<FadeMin  )
		{
			FadeOut = true;
			clearInterval(FadeInterval);
		}
	};
	
	if ((FadePas<FadeMax)&&(FadePas>FadeMin))
	{
		elem = getElementsByClassName("fade_link");	//	alert( elem.length );
		for (var i=0;i<elem.length;i++)
		{
			elem[i].style.color="rgb(" + FadePas + "," + FadePas + "," + FadePas + ")";
		}
	};
	
	FadeInterval = setTimeout('fade_ontimer()', FadeInt);
}

function getElementsByClassName(classname)
{
	if (document.getElementsByTagName)
	{
		var els = document.getElementsByTagName("*");
		var c = new RegExp('/b^|' + classname + '|$/b');
		final = new Array();
		var n=0;
		for (var i=0; i < els.length; i++)
		{
			if (els[i].className)
			{
				if(c.test(els[i].className))
				{
					final[n] = els[i];
					n++;
				}
			}
		}
		return final;
	}
	else
	{
		return false;
	}
}

/**
 * COMMON DHTML FUNCTIONS
 * These are handy functions I use all the time.
 *
 * By Seth Banks (webmaster at subimage dot com)
 * http://www.subimage.com/
 *
 * Up to date code can be found at http://www.subimage.com/dhtml/
 *
 * This code is free for you to use anywhere, just keep this comment block.
 */

/**
 * X-browser event handler attachment and detachment
 * TH: Switched first true to false per http://www.onlinetools.org/articles/unobtrusivejavascript/chapter4.html
 *
 * @argument obj - the object to attach event to
 * @argument evType - name of the event - DONT ADD "on", pass only "mouseover", etc
 * @argument fn - function to call
 */
function addEvent(obj, evType, fn){
 if (obj.addEventListener){
    obj.addEventListener(evType, fn, false);
    return true;
 } else if (obj.attachEvent){
    var r = obj.attachEvent("on"+evType, fn);
    return r;
 } else {
    return false;
 }
}
function removeEvent(obj, evType, fn, useCapture){
  if (obj.removeEventListener){
    obj.removeEventListener(evType, fn, useCapture);
    return true;
  } else if (obj.detachEvent){
    var r = obj.detachEvent("on"+evType, fn);
    return r;
  } else {
    alert("Handler could not be removed");
  }
}

/**
 * Code below taken from - http://www.evolt.org/article/document_body_doctype_switching_and_more/17/30655/
 *
 * Modified 4/22/04 to work with Opera/Moz (by webmaster at subimage dot com)
 *
 * Gets the full width/height because it's different for most browsers.
 */
function getViewportHeight() {
	if (window.innerHeight!=window.undefined) return window.innerHeight;
	if (document.compatMode=='CSS1Compat') return document.documentElement.clientHeight;
	if (document.body) return document.body.clientHeight; 

	return window.undefined; 
}
function getViewportWidth() {
	var offset = 17;
	var width = null;
	if (window.innerWidth!=window.undefined) return window.innerWidth; 
	if (document.compatMode=='CSS1Compat') return document.documentElement.clientWidth; 
	if (document.body) return document.body.clientWidth; 
}

/**
 * Gets the real scroll top
 */
function getScrollTop() {
	if (self.pageYOffset) // all except Explorer
	{
		return self.pageYOffset;
	}
	else if (document.documentElement && document.documentElement.scrollTop)
		// Explorer 6 Strict
	{
		return document.documentElement.scrollTop;
	}
	else if (document.body) // all other Explorers
	{
		return document.body.scrollTop;
	}
}
function getScrollLeft() {
	if (self.pageXOffset) // all except Explorer
	{
		return self.pageXOffset;
	}
	else if (document.documentElement && document.documentElement.scrollLeft)
		// Explorer 6 Strict
	{
		return document.documentElement.scrollLeft;
	}
	else if (document.body) // all other Explorers
	{
		return document.body.scrollLeft;
	}
}

/**
 * SUBMODAL v1.5
 * Used for displaying DHTML only popups instead of using buggy modal windows.
 *
 * By Seth Banks
 * http://www.subimage.com/
 *
 * Contributions by:
 * 	Eric Angel - tab index code
 * 	Scott - hiding/showing selects for IE users
 *	Todd Huss - inserting modal dynamically and anchor classes
 *
 * Up to date code can be found at http://www.subimage.com/dhtml/subModal
 * 
 *
 * This code is free for you to use anywhere, just keep this comment block.
 */

// Popup code
var gPopupMask = null;
var gPopupContainer = null;
var gPopFrame = null;
var gReturnFunc;
var gPopupIsShown = false;
var gDefaultPage = "bbcode_box/loading.html";
var gHideSelects = false;
var gReturnVal = null;

var gTabIndexes = new Array();
// Pre-defined list of tags we want to disable/enable tabbing into
var gTabbableTags = new Array("A","BUTTON","TEXTAREA","INPUT","IFRAME");	

// If using Mozilla or Firefox, use Tab-key trap.
if (!document.all) {
	document.onkeypress = keyDownHandler;
}



/**
 * Initializes popup code on load.	
 */
function initPopUp() {
	// Add the HTML to the body
	theBody = document.getElementsByTagName('BODY')[0];
	popmask = document.createElement('div');
	popmask.id = 'popupMask';
	popcont = document.createElement('div');
	popcont.id = 'popupContainer';
	popcont.innerHTML = '' +
		'<div id="popupInner">' +
			'<div id="popupTitleBar">' +
				'<div id="popupTitle">'+
					'<font size="1" color="#cccccc"><a href="http://hvmdesign.com">Advanced BBCode Box MOD v5.0.0</a></font>'+
				'</div>' +
				'<div id="popupControls">' +					
					'<img src="bbcode_box/images/close.gif" onclick="hidePopWin(false);" id="popCloseBox" />' +
				'</div>' +
			'</div>' +
			'<iframe src="'+ gDefaultPage +'" style="width:100%;height:100%;background-color:transparent;" scrolling="auto" frameborder="0" allowtransparency="true" id="popupFrame" name="popupFrame" width="100%" height="100%"></iframe>' +
		'</div>';
	theBody.appendChild(popmask);
	theBody.appendChild(popcont);
	
	gPopupMask = document.getElementById("popupMask");
	gPopupContainer = document.getElementById("popupContainer");
	gPopFrame = document.getElementById("popupFrame");	
	
	// check to see if this is IE version 6 or lower. hide select boxes if so
	// maybe they'll fix this in version 7?
	var brsVersion = parseInt(window.navigator.appVersion.charAt(0), 10);
	if (brsVersion <= 6 && window.navigator.userAgent.indexOf("MSIE") > -1) {
		gHideSelects = true;
	}
/*	
	// Add onclick handlers to 'a' elements of class submodal or submodal-width-height
	var elms = document.getElementsByTagName('a');
	for (i = 0; i < elms.length; i++) {
		if (elms[i].className.indexOf("submodal") == 0) { 
			// var onclick = 'function (){showPopWin(\''+elms[i].href+'\','+width+', '+height+', null);return false;};';
			// elms[i].onclick = eval(onclick);
			elms[i].onclick = function(){
				// default width and height
				var width = 400;
				var height = 200;
				// Parse out optional width and height from className
				params = this.className.split('-');
				if (params.length == 3) {
					width = parseInt(params[1]);
					height = parseInt(params[2]);
				}
				showPopWin(this.href,width,height,null); return false;
			}
		}
	}
*/
}
// addEvent(window, "load", initPopUp);

 /**
	* @argument width - int in pixels
	* @argument height - int in pixels
	* @argument url - url to display
	* @argument returnFunc - function to call when returning true from the window.
	* @argument showCloseBox - show the close box - default true
	*/

function showPopWin(url, width, height, returnFunc, showCloseBox) {
	// show or hide the window close widget
	if (showCloseBox == null || showCloseBox == true) {
		document.getElementById("popCloseBox").style.display = "block";
	} else {
		document.getElementById("popCloseBox").style.display = "none";
	}
	gPopupIsShown = true;
	disableTabIndexes();
	gPopupMask.style.display = "block";
	gPopupContainer.style.display = "block";
	// calculate where to place the window on screen
	centerPopWin(width, height);
	
	var titleBarHeight = parseInt(document.getElementById("popupTitleBar").offsetHeight, 10);


	gPopupContainer.style.width = width + "px";
	gPopupContainer.style.height = (height+titleBarHeight) + "px";
	
	setMaskSize();

	// need to set the width of the iframe to the title bar width because of the dropshadow
	// some oddness was occuring and causing the frame to poke outside the border in IE6
	gPopFrame.style.width = parseInt(document.getElementById("popupTitleBar").offsetWidth, 10) + "px";
	gPopFrame.style.height = (height) + "px";
	
	// set the url
	gPopFrame.src = url;
	
	gReturnFunc = returnFunc;
	// for IE
	if (gHideSelects == true) {
		hideSelectBoxes();
	}
	
//	window.setTimeout("setPopTitle();", 600);
}

//
var gi = 0;
function centerPopWin(width, height) {
	if (gPopupIsShown == true) {
		if (width == null || isNaN(width)) {
			width = gPopupContainer.offsetWidth;
		}
		if (height == null) {
			height = gPopupContainer.offsetHeight;
		}
		
		//var theBody = document.documentElement;
		var theBody = document.getElementsByTagName("BODY")[0];
		//theBody.style.overflow = "hidden";
		var scTop = parseInt(getScrollTop(),10);
		var scLeft = parseInt(theBody.scrollLeft,10);
	
		setMaskSize();
		
		//window.status = gPopupMask.style.top + " " + gPopupMask.style.left + " " + gi++;
		
		var titleBarHeight = parseInt(document.getElementById("popupTitleBar").offsetHeight, 10);
		
		var fullHeight = getViewportHeight();
		var fullWidth = getViewportWidth();
		
		gPopupContainer.style.top = (scTop + ((fullHeight - (height+titleBarHeight)) / 2)) + "px";
		gPopupContainer.style.left =  (scLeft + ((fullWidth - width) / 2)) + "px";
		//alert(fullWidth + " " + width + " " + gPopupContainer.style.left);
	}
}
addEvent(window, "resize", centerPopWin);
addEvent(window, "scroll", centerPopWin);
window.onscroll = centerPopWin;


/**
 * Sets the size of the popup mask.
 *
 */
function setMaskSize() {
	var theBody = document.getElementsByTagName("BODY")[0];
			
	var fullHeight = getViewportHeight();
	var fullWidth = getViewportWidth();
	
	// Determine what's bigger, scrollHeight or fullHeight / width
	if (fullHeight > theBody.scrollHeight) {
		popHeight = fullHeight;
	} else {
		popHeight = theBody.scrollHeight;
	}
	
	if (fullWidth > theBody.scrollWidth) {
		popWidth = fullWidth;
	} else {
		popWidth = theBody.scrollWidth;
	}
	
	gPopupMask.style.height = popHeight + "px";
	gPopupMask.style.width = popWidth + "px";
}

/**
 * @argument callReturnFunc - bool - determines if we call the return function specified
 * @argument returnVal - anything - return value 
 */
function hidePopWin(callReturnFunc) {
	gPopupIsShown = false;
	var theBody = document.getElementsByTagName("BODY")[0];
	theBody.style.overflow = "";
	restoreTabIndexes();
	if (gPopupMask == null) {
		return;
	}
	gPopupMask.style.display = "none";
	gPopupContainer.style.display = "none";
	if (callReturnFunc == true && gReturnFunc != null) {
		// Set the return code to run in a timeout.
		// Was having issues using with an Ajax.Request();
		gReturnVal = window.frames["popupFrame"].returnVal;
		window.setTimeout('gReturnFunc(gReturnVal);', 1);
	}
	gPopFrame.src = gDefaultPage;
	// display all select boxes
	if (gHideSelects == true) {
		displaySelectBoxes();
	}
}

/**
 * Sets the popup title based on the title of the html document it contains.
 * Uses a timeout to keep checking until the title is valid.
 */
function setPopTitle() {
	return;
	if (window.frames["popupFrame"].document.title == null) {
		window.setTimeout("setPopTitle();", 10);
	} else {
		document.getElementById("popupTitle").innerHTML = window.frames["popupFrame"].document.title;
	}
}

// Tab key trap. iff popup is shown and key was [TAB], suppress it.
// @argument e - event - keyboard event that caused this function to be called.
function keyDownHandler(e) {
    if (gPopupIsShown && e.keyCode == 9)  return false;
}

// For IE.  Go through predefined tags and disable tabbing into them.
function disableTabIndexes() {
	if (document.all) {
		var i = 0;
		for (var j = 0; j < gTabbableTags.length; j++) {
			var tagElements = document.getElementsByTagName(gTabbableTags[j]);
			for (var k = 0 ; k < tagElements.length; k++) {
				gTabIndexes[i] = tagElements[k].tabIndex;
				tagElements[k].tabIndex="-1";
				i++;
			}
		}
	}
}

// For IE. Restore tab-indexes.
function restoreTabIndexes() {
	if (document.all) {
		var i = 0;
		for (var j = 0; j < gTabbableTags.length; j++) {
			var tagElements = document.getElementsByTagName(gTabbableTags[j]);
			for (var k = 0 ; k < tagElements.length; k++) {
				tagElements[k].tabIndex = gTabIndexes[i];
				tagElements[k].tabEnabled = true;
				i++;
			}
		}
	}
}


/**
* Hides all drop down form select boxes on the screen so they do not appear above the mask layer.
* IE has a problem with wanted select form tags to always be the topmost z-index or layer
*
* Thanks for the code Scott!
*/
function hideSelectBoxes() {
	for(var i = 0; i < document.forms.length; i++) {
		for(var e = 0; e < document.forms[i].length; e++){
			if(document.forms[i].elements[e].tagName == "SELECT") {
				document.forms[i].elements[e].style.visibility="hidden";
			}
		}
	}
}

/**
* Makes all drop down form select boxes on the screen visible so they do not reappear after the dialog is closed.
* IE has a problem with wanted select form tags to always be the topmost z-index or layer
*/
function displaySelectBoxes() {
	for(var i = 0; i < document.forms.length; i++) {
		for(var e = 0; e < document.forms[i].length; e++){
			if(document.forms[i].elements[e].tagName == "SELECT") {
			document.forms[i].elements[e].style.visibility="visible";
			}
		}
	}
}