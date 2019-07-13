function toggleSidebar() {
	if (Cookies.get("sidebar_open") == "true") {
	// if ($(".sidebar, main").hasClass("open")) {
		$(".sidebar, main").removeClass("open");
		Cookies.set("sidebar_open", "false");
	} else {
		$(".sidebar, main").addClass("open");
		Cookies.set("sidebar_open", "true");
	}
}

$(window).on("load", function() {
	$("main, aside").removeClass("loading");
});


function copyToClipboard() {
	$("section.other-files textarea").select();
	document.execCommand('copy');
}



// var copyTextareaBtn = document.querySelector('.js-textareacopybtn');
//
// copyTextareaBtn.addEventListener('click', function(event) {
//   var copyTextarea = document.querySelector('.js-copytextarea');
//   copyTextarea.select();
//
//   try {
//     var successful = document.execCommand('copy');
//     var msg = successful ? 'successful' : 'unsuccessful';
//     console.log('Copying text command was ' + msg);
//   } catch (err) {
//     console.log('Oops, unable to copy');
//   }
// });



// function replaceText() {
// 	var xhr = new XMLHttpRequest();
// 	var target = document.getElementById("ajaxchange");
// 	xhr.open("GET", "/admin/artists");
// 	xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
// 	xhr.onreadystatechange = function() {
// 		console.log("readyState: " + xhr.readyState);
// 		if (xhr.readyState == 2) { // Loading
// 			console.log("Loading...");
// 			target.innerHTML = "Loading...";
// 		}
// 		if (xhr.readyState == 4 && xhr.status == 200) { // Success
// 			console.log("Inserting...");
// 			target.innerHTML = xhr.responseText;
// 		}
// 	}
// 	xhr.send();
// }
