$(document).ready(function(){
	let items = $(".mask_it");
	if(items.length){
		items.each(function(){
			let item = $(this);
			let m = item.data("vmask");
			if(m){
				item.mask(m, {
				});
			}
		});
	}
});



function showSuccess(msg, title="",html=false){
	Swal.fire(title ||  "Success", msg, "success");
}

function showError(msg, title=""){
	Swal.fire(title ||  "Error", msg, "error");
}

function showLoader(parent=""){
	$(parent).css({position: "relative"});
	$(parent).prepend(`
		<div class='loading'><div class="lds-dual-ring"></div></div>
	`);
}

function hideLoader(){
	$(".loading").remove();
}
