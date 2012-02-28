
/**
 * The main function to be run on start up
 */

var name = "";
function widget_load_init() {
	//add logo and link to home page in the center of the header
	var center = document.getElementById( 'center' );
	var logo = document.createElement( 'a' );
	//logo.setAttribute("href", "#foo");
	logo.setAttribute("id", "logo");
	var logo_img = document.createElement( 'img' );
	//logo_img.setAttribute("src", "images/logo1_trans.png");
	//This started redirecting to m.cip.gatech.edu/images with jqueryMobile
	logo_img.setAttribute("src", "http://m.cip.gatech.edu/~mailsense/base_widget/images/mailsense 4.png");	
	logo.appendChild( logo_img );
	center.innerHTML = "";
	center.appendChild( logo );

	//var home = document.getElementById( 'left' );
	//home.setAttribute("href", "#mainon");
	$('#left').find('a').attr('href', 'http://m.cip.gatech.edu/fportal.php?k=mailsense/base_widget/index.xml');
	//$('#left').find('a').removeAttr('href');
	//$('#left').find('a').bind("click",function(){
//$.mobile.changePage($('#mainon'), 'slideup', false, false);
//});

	/*$("#portal_header #left a").click(function() {
        //showPlaceListPage();
        //return false;
				$.mobile.changePage($('#mainon'), 'slideleft', false, false);
    });*/



/*	


		loadbuzzlist();
	});

	$("#find_place").bind("pageshow", function() {
		findplace();
	});

	$("#match_loc").bind("pageshow", function() {
		matchloc();
	});

	$("#match_loc").bind("pagecreate", function() {
		matchloc();
	});*/

	logolink(); 

	var url  = "http://m.cip.gatech.edu/~mailsense/base_widget/checkname.php?uname=" + PORTAL_CLIENT.getUsername();
	name = PORTAL_CLIENT.getUsername();
	$.getJSON(url, function(data){
		if(data.exists == "no"){
			alert("You do not exist in our database. Please fill in your Box Number and Combination. Click Save Settings after you are finished.");
		}
		if(data.exists.exist == "yes"){
			//alert("You are in the database");
			if(data.exists.notify == "1"){
				$('#radio-on').attr("checked", true).checkboxradio("refresh");
			}
			if(data.exists.notify == "0"){
				$('#radio-off').attr("checked", true).checkboxradio("refresh");
				document.getElementById("boxn").value = data.exists.boxn;
				document.getElementById("combo").value = data.exists.combo;
				hide("expandoptions");
			}	
			//document.getElementById("boxn").value = "box number";
			document.getElementById("boxn").value = data.exists.boxn;
			document.getElementById("combo").value = data.exists.combo;
		}
	});	
} // function widget_load_init()

function logolink()
{
	var logo = document.getElementById( 'logo');
	logo.setAttribute("href", "#mainon");
	//logo.setAttribute("href", "javascript:window.location='http://m.cip.gatech.edu/fportal.php?k=mailsense/base_widget/index.xml'");
	//logo.setAttribute("href", "javascript:$.mobile.changePage($('#mainon'), 'slide', false, false)");
	logo.setAttribute("data-transition", "slide");
	logo.setAttribute("data-back", "true");
	//logo.setAttribute("onclick", "nologolink()");
}


function placeholder()
{
	alert("placeholder function!");
	//$("div#options").slideToggle("fast");
}

function show(id)
{	
	$("div#"+ id).slideDown("fast");
	setNotify("True");
}

function hide(id)
{	
	$("div#"+ id).slideUp("fast");
	setNotify("False");
}

function updateSettings()
{
	//alert("Settings updated! Now set your notifications.");
	//document.forms["updateform"].submit();
	//$.post("http://m.cip.gatech.edu/~mailsense/base_widget/update.php?radio-flip=");

	var url = "";
		
	//name = PORTAL_CLIENT.getUsername();
	var box = document.getElementById("boxn").value;
	var combo = document.getElementById("combo").value;
	//document.getElementById("demo2").innerHTML = name;

	if (document.getElementById("radio-on").checked == true)
	{
		url = "http://m.cip.gatech.edu/~mailsense/base_widget/update.php?radio-flip=" + "1" + "&name=" + name + "&boxn=" + box + "&combo=" + combo;
		alert("Settings updated! Now set your notifications.");
	}
	else
	{
		url = "http://m.cip.gatech.edu/~mailsense/base_widget/update.php?radio-flip=" + "0" + "&name=" + name + "&boxn=" + box + "&combo=" + combo;
		alert("Settings updated!");
	}

	//$.getJSON(url, function(data) {
	//	} );
	$.get(url);
	

	
}

function setEmailPage(){
	var url  = "http://m.cip.gatech.edu/~mailsense/base_widget/checkname.php?uname=" + name;
	$.getJSON(url, function(data){
		if(data.exists.exist == "yes"){
			//alert("You are in the database");
			if(data.exists.email == "1"){
				$('#radio-on-2').attr("checked", true).checkboxradio("refresh");
				if(data.exists.eremind == "r_never"){
					$('#r_never').attr("checked", true).checkboxradio("refresh");
				}
				if(data.exists.eremind == "r_daily"){
					$('#r_daily').attr("checked", true).checkboxradio("refresh");
				}
				if(data.exists.eremind == "r_max"){
					$('#r_max').attr("checked", true).checkboxradio("refresh");
				}
			}
			if(data.exists.email == "0"){
				$('#radio-off-2').attr("checked", true).checkboxradio("refresh");
				hide("expandemail");
			}	
		}
	});	
}

function updateEmailSet()
{
	//var notificationspg = document.getElementById('notifications_page');
	//var div =  document.createElement("div");
	//var p = document.createElement( "p" );
	//p.innerHTML = "Email: " + document.getElementById( 'emailtxt' ).value;
	//div.appendChild(p)
	//notificationspg.appendChild(div); 

	
	
	//Yakira 
	var eurl = "";
	if (document.getElementById("radio-on-2").checked == true)
	{
		eurl = "http://m.cip.gatech.edu/~mailsense/base_widget/update.php?radio-email=" + "1" + "&name=" + name;
	}
	else
	{
		eurl = "http://m.cip.gatech.edu/~mailsense/base_widget/update.php?radio-email=" + "0" + "&name=" + name;
	}
	$.get(eurl);

	//var email = document.getElementById('emailtxt').value;
	//var email = PORTAL_CLIENT.getUsername();
	//var uname = document.getElementById("demo").innerHTML;
	if(document.getElementById("r_never").checked == true){
		eurl = "http://m.cip.gatech.edu/~mailsense/base_widget/addCellEmail.php?email=" + name + "&ereminders=" + "r_never";
		$.post(eurl);
	}
	if(document.getElementById("r_daily").checked == true){
		eurl = "http://m.cip.gatech.edu/~mailsense/base_widget/addCellEmail.php?email=" + name + "&ereminders=" + "r_daily";
		$.post(eurl);
	}
	if(document.getElementById("r_max").checked == true){
		eurl = "http://m.cip.gatech.edu/~mailsense/base_widget/addCellEmail.php?email=" + name + "&ereminders=" + "r_max";
		$.post(eurl);
	}

}//function updateEmail() 

function updateMail(){
	var url  = "http://m.cip.gatech.edu/~mailsense/base_widget/mailStatus.php?uname=" + name;
	var mail = "You have mail!!";
	var nomail = "You do not have mail at this time";

	$.getJSON(url, function(data){
		if(data.mail.havemail == "no"){
			document.getElementById("havemail").innerHTML = nomail;
			document.getElementById("msdate").innerHTML = "";		
		}
		if(data.mail.havemail == "yes"){
			document.getElementById("havemail").innerHTML = mail;			
			document.getElementById("msdate").innerHTML = data.mail.timestamp;
		}
	});

}

function setTextPage(){
	var url  = "http://m.cip.gatech.edu/~mailsense/base_widget/checkname.php?uname=" + name;
	$.getJSON(url, function(data){
		if(data.exists.exist == "yes"){
			//alert("You are in the database");
			if(data.exists.text == "1"){
				$('#radio-on-3').attr("checked", true).checkboxradio("refresh");
				if(data.exists.tremind == "r_never"){
					$('#t_never').attr("checked", true).checkboxradio("refresh");
				}
				if(data.exists.tremind == "r_daily"){
					$('#t_daily').attr("checked", true).checkboxradio("refresh");
				}
				if(data.exists.tremind == "r_max"){
					$('#t_max').attr("checked", true).checkboxradio("refresh");
				}
				if(data.exists.carrier == "att"){
					$('#att').attr("checked", true).checkboxradio("refresh");
				}
				if(data.exists.carrier == "verizon"){
					$('#verizon').attr("checked", true).checkboxradio("refresh");
				}
				if(data.exists.carrier == "tmobile"){
					$('#tmobile').attr("checked", true).checkboxradio("refresh");
				}
				if(data.exists.carrier == "sprint"){
					$('#sprint').attr("checked", true).checkboxradio("refresh");
				}
			}
			if(data.exists.text == "0"){
				$('#radio-off-3').attr("checked", true).checkboxradio("refresh");
				hide("expandtext");
			}	
		}
	});	

}

//Yakira
function updateTextSet()
{
	
	var turl = "";
	if (document.getElementById("radio-on-3").checked == true)
	{
		turl = "http://m.cip.gatech.edu/~mailsense/base_widget/update.php?radio-cell=" + "1" + "&name=" + name;
	}
	else
	{
		turl = "http://m.cip.gatech.edu/~mailsense/base_widget/update.php?radio-cell=" + "0" + "&name=" + name;
	}
	$.get(turl);

	var cell = document.getElementById('texttxtbox').value;
	//var url = "http://m.cip.gatech.edu/~mailsense/base_widget/addCellEmail.php?cell=" + cell + "&email=" + name;
	//$.post(url); 

	if(document.getElementById("t_never").checked == true){
		//var cell = document.getElementById('texttxtbox').value;
		turl = "http://m.cip.gatech.edu/~mailsense/base_widget/addCellEmail.php?cell=" + cell + "&email=" + name + "&treminders=" + "r_never";
		//$.post(turl);
	}
	if(document.getElementById("t_daily").checked == true){
		turl = "http://m.cip.gatech.edu/~mailsense/base_widget/addCellEmail.php?cell=" + cell + "&email=" + name + "&treminders=" + "r_daily";
		//$.post(turl);
	}
	if(document.getElementById("t_max").checked == true){
		turl = "http://m.cip.gatech.edu/~mailsense/base_widget/addCellEmail.php?cell=" + cell + "&email=" + name + "&treminders=" + "r_max";
		//$.post(turl);
	}
	if(document.getElementById("att").checked == true){
		turl = turl + "&carrier=att";
		//alert(turl);
		$.post(turl);
	}
	if(document.getElementById("verizon").checked == true){
		turl = turl + "&carrier=verizon";
		//alert(turl);
		$.post(turl);
	}
	if(document.getElementById("tmobile").checked == true){
		turl = turl + "&carrier=tmobile";
		//alert(turl);
		$.post(turl);
	}
	if(document.getElementById("sprint").checked == true){
		turl = turl + "&carrier=sprint";
		//alert(turl);
		$.post(turl);
	}




}

function setFacebookPage(){
	var url  = "http://m.cip.gatech.edu/~mailsense/base_widget/checkname.php?uname=" + name;
	$.getJSON(url, function(data){
		if(data.exists.exist == "yes"){
			//alert("You are in the database");
			if(data.exists.fb == "1"){
				$('#radio-on-4').attr("checked", true).checkboxradio("refresh");
				if(data.exists.fbremind == "r_never"){
					$('#f_never').attr("checked", true).checkboxradio("refresh");
				}
				if(data.exists.fbremind == "r_daily"){
					$('#f_daily').attr("checked", true).checkboxradio("refresh");
				}
				if(data.exists.fbremind == "r_max"){
					$('#f_max').attr("checked", true).checkboxradio("refresh");
				}
			}
			if(data.exists.fb == "0"){
				$('#radio-off-4').attr("checked", true).checkboxradio("refresh");
				hide("expandfb");
			}	
		}
	});	

}

function updateFacebookSet()
{
	var furl = "";
	if (document.getElementById("radio-on-4").checked == true)
	{
		furl = "http://m.cip.gatech.edu/~mailsense/base_widget/update.php?radio-fb=" + "1" + "&name=" + name;
		//alert(furl);
	}
	else
	{
		furl = "http://m.cip.gatech.edu/~mailsense/base_widget/update.php?radio-fb=" + "0" + "&name=" + name;
		//alert(furl);
	}
	
	if(document.getElementById("f_never").checked == true){
		furl = furl + "&fbreminders=" + "r_never";
		//alert(furl);
		$.get(furl);
	}
	if(document.getElementById("f_daily").checked == true){
		furl = furl + "&fbreminders=" + "r_daily";
		//alert(furl);
		$.get(furl);
	}
	if(document.getElementById("f_max").checked == true){
		furl = furl + "&fbreminders=" + "r_max";
		//alert(furl);
		$.get(furl);
	}
	else{
		//alert(furl);
		$.get(furl);
	}
	
}

