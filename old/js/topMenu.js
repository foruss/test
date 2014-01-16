$(document).ready(function(){
    $("#menu a").mouseover(function(){
        $(this).stop();
        $(this).animate({ opacity: 0 }, 300);
    });
    $("#menu a").mouseout(function(){
        $(this).stop();
        $(this).animate({ opacity: 1.0 }, 300);
    });
});

/*
 * Image preview script 
 * powered by jQuery (http://www.jquery.com)
 * 
 * written by Alen Grakalic (http://cssglobe.com)
 * 
 * for more info visit http://cssglobe.com/post/1695/easiest-tooltip-and-image-preview-using-jquery
 *
 */
 
this.imagePreview = function(){	
	/* CONFIG */
		
		xOffset = 400;
		yOffset = 250;
		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result
		
	/* END CONFIG */
	$("a.preview").hover(function(e){
		this.t = this.title;
		this.title = "";	
		var c = (this.t != "") ? "<br/>" + this.t : "";
		$("body").append("<p id='preview'><img src='"+ this.href +"' alt='Image preview' />"+ c +"</p>");								 
		$("#preview")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");						
    },
	function(){
		this.title = this.t;	
		$("#preview").remove();
    });	
	$("a.preview").mousemove(function(e){
		$("#preview")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});			
};


// starting the script on page load
$(document).ready(function(){
	imagePreview();
});

/*
 * Tooltip script 
 * powered by jQuery (http://www.jquery.com)
 * 
 * written by Alen Grakalic (http://cssglobe.com)
 * 
 * for more info visit http://cssglobe.com/post/1695/easiest-tooltip-and-image-preview-using-jquery
 *
 */
 


this.tooltip = function(){	
	/* CONFIG */		
		xOffset = 10;
		yOffset = 20;		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result		
	/* END CONFIG */		
	$("a.tooltip").hover(function(e){											  
		this.t = this.title;
		this.title = "";									  
		$("body").append("<p id='tooltip'>"+ this.t +"</p>");
		$("#tooltip")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");		
    },
	function(){
		this.title = this.t;		
		$("#tooltip").remove();
    });	
	$("a.tooltip").mousemove(function(e){
		$("#tooltip")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});			
};



// starting the script on page load
$(document).ready(function(){
	tooltip();
});

/*
 * 
 * 
 * 'id=' +id
 * */
 function GetPart(part) {
 $.get('/ajax.php?mode=getpart&part='+part,  function(data){
  //alert("Data Loaded: " + data);
  document.getElementById('choosepart2').innerHTML = data;
  });
};
 function GetPrice(part) {
 $.get('/ajax.php?mode=getprice&part='+part,  function(data){
  //alert("Data Loaded: " + data);
  document.getElementById('partprice').style.display="block";
  document.getElementById('partprice').innerHTML = data;
  });
};
/*************/
function changemake(id) {
 $.post('/auto/getmodel/', {'id': id},  function(data){
  //alert("Data Loaded: " + data);
  document.getElementById('modelselect').innerHTML = data;
  
  });

}
function LoadMainSearchModels(part) {
	 $.get('/ajax.php?mode=getmodel&part='+part,  function(data){
  document.getElementById('mainsearchmodel').style.display="block";
  document.getElementById('mainsearchmodel').innerHTML = data;
  });
}
function UpdateYears() {
	document.getElementById('year1').disabled=false;
	document.getElementById('year2').disabled=false;
	
}

//
function Expand(id)
{
var $state = document.getElementById('splitter'+id).style.display;
if ($state =='none') document.getElementById('splitter'+id).style.display = 'inline';
else document.getElementById('splitter'+id).style.display = 'none';
}

function checkregisterform()
{
if ( (document.forms.register.name.value == null) || (document.forms.register.name.value.length < 3) )
{
alert("Представьтесь пожалуйста :)");
document.forms.register.name.focus();
return false;
}

if ( (document.forms.register.email.value == null) || (document.forms.register.email.value.length < 7) )
{
alert("Введите ваш e-mail!");
document.forms.register.email.focus();
return false;
}
if (! (/\w+@\w+\.[a-z]{2,4}/.test(document.forms.register.email.value)) )
{
alert("Вы ошиблись при вводе e-mail!");
document.forms.register.email.focus();
return false;
}
if ( (document.forms.register.login2.value == null) || (document.forms.register.login2.value.length < 3) )
{
alert("Выберите логин!");
document.forms.register.login2.focus();
return false;
}
if (document.getElementById('isloginok').value == "0") {
	alert("Выберите логин!");
	document.forms.register.login.focus();
	return false; 
}
if (document.forms.register.pass1.value.length <3)
{
alert("Пароли слишком короткий!");
document.forms.register.pass1.focus();
return false;
}

if ( (document.forms.register.pass1.value != document.forms.register.pass2.value) )
{
alert("Пароли не совпадают!");
document.forms.register.pass1.focus();
return false;
}


return true;
}