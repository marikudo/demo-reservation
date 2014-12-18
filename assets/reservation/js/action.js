$(function(){
	$("#arrival").datepicker();
	$("#departure").datepicker();

});

window.onload=function(){
        

/*##########################popup image###########################*/
/*tearoom popup image in specific image*/
	$("#gallery").on('click','.img_small',function(){
		$("#gallery img").removeClass("active");
		$(this).addClass('active');
		var id=$(this).data('index');
		$('#np').val(id);
		if(id==1){
			id=0
		}else{
			id=id-1;
		}
		var left = id*700;

		$("#gallery_large").css({"left":"-"+left+"px"});


		$("#popimage_container, #gallery_container,#tea_next_img,#tea_prev_img").show();
	
	});	

/*hover large image*/
$(".img_large").mouseenter(function(){
	$("#tea_prev_img, #tea_next_img").animate({opacity: 0.3}, 100);
});
$(".img_large").mouseout(function(){
	$("#tea_prev_img, #tea_next_img").animate({opacity: 0}, 100);
});
/*hover arrow image*/
$("#tea_prev_img").mouseenter(function(){
	$("#tea_prev_img").animate({opacity: 1}, 100);
	$("#tea_next_img").animate({opacity: 0.2}, 100);
});
$("#tea_next_img").mouseenter(function(){
	$("#tea_next_img").animate({opacity: 1}, 100);
	$("#tea_prev_img").animate({opacity: 0.2}, 100);
});
$("#tea_next_img").mouseout(function(){
	$("#tea_next_img").animate({opacity: 0}, 100);
	$("#tea_prev_img").animate({opacity: 0}, 100);
});
$("#tea_prev_img").mouseout(function(){
	$("#tea_prev_img").animate({opacity: 0}, 100);
	$("#tea_next_img").animate({opacity: 0}, 100);
});


/*hide the gallery container*/
	$("#popimage_container").on('click',function(){
		$("#popimage_container, #gallery_container, #tea_next_img,#tea_prev_img").hide();
	});


/*(arrow) next and prev button action*/
/*prev*/
$("#tea_prev_img").on("click", function(){	
var total = $("#total").val();
	var id = $('#np').val();
	if(parseInt(id) <= 1){
		parseInt(id) =1;
	}

	var prev = parseInt(id) -1;
	$("#np").val(prev);
	var left = ((id*700)-1400);
			$("#gallery_large").animate({"left":"-"+left+"px"},1000);
});

/*next*/
$("#tea_next_img").on("click", function(){
	var total = $("#total").val();
	var id = $('#np').val();
	if(parseInt(id) >= parseInt(total)){
	parseInt(id) = parseInt(total);
	}

	var next = parseInt(id) + 1;
	$('#np').val(next);
	var left = id*700;
	$("#gallery_large").animate({"left":"-"+left+"px"},1000);
});

/*center div*/
$(window).resize(function(){
  $('#gallery_container').css({
    position:'absolute',
    left: ($(window).width() - $('#gallery_container').outerWidth())/2,
    top: ($(window).height() - $('#gallery_container').outerHeight())/2
  });
});
// To initially run the function:
$(window).resize();

/*animate div image name*/
$("#gallery img").mouseenter(function(){
	$("#gallery div").removeClass("divs");
	$(this).parent().addClass("divs");
	$("div").find(".tea_img_name").css({'opacity':0});
	$("div.divs").find(".tea_img_name").css({'opacity':1});
});

$("#gallery div").mouseout(function(){
	$("#img_border div").css({'opacity':0});
});
/*align last div in small image*/




/*########################################################################################*/

}

