
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
