(function(){

	var button = document.getElementById('cn-button'),
    wrapper = document.getElementById('cn-wrapper'),
    overlay = document.getElementById('cn-overlay');


    //open and close menu when the button is clicked
	var open = false;
	button.addEventListener('click', handler, false);
	wrapper.addEventListener('click', cnhandle, false);
	
	function cnhandle(e){
		e.stopPropagation();
	}

	function handler(e){

		if (!e) var e = window.event;

	 	e.stopPropagation();//so that it doesn't trigger click event on document*/
	 	if(!open){
	    	openNav();
	  	}
	 	else{
	    	closeNav();
	  	}
	}
	function openNav(){
		open = true;
	    button.innerHTML = "";
	    
	    console.log("Hello");
	    $(".cn-button").animate({left:"50%", "padding-left":"-1em"}).delay(200);
	    classie.add(overlay, 'on-overlay');
	    classie.add(wrapper, 'opened-nav');
	    $(".cn-button").animate({"opacity":"0"},50);
	    //$(".csstransforms .cn-wrapper").css({"visibility":"visible"});
	}
	function closeNav(){
		open = false;
		console.log("In js :"+open);
		button.innerHTML = "+";
		classie.remove(wrapper, 'opened-nav');
		$(".cn-button").delay(1000).animate({left:"0%", "padding-left":"1em"},200);
		classie.remove(overlay, 'on-overlay');
		$("#event").css("background","rgba(69, 69, 69, 0.85)").text("events");
		$(".cn-button").css("opacity","1");
		
	}
	document.addEventListener('click', closeNav, false);
})();

