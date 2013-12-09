function timestamp(){
	return Math.round((new Date()).getTime() / 1000);
}

$(document).ready(function() {

	play_in_progress = false;
	timestampIn = timestamp();
	listening_count = new Array;

	/***
	GESTION AUDIO
	****/
	$("audio").bind("ended", function(){
		play_in_progress = false;
		sound = $(this).attr('id');
		$(".item_audio_button").css("opacity","1");
	});

	$.ajax({
		url: Routing.generate('sessionSituationListenNumber'),
		type: 'GET',
		dataType: 'json'
	})
	.done(function(data) {
		console.log(data.situationListenNumber);
		var number = $("#listening_number").html();
		if (data.situationListenNumber !== null) {
			var limit = $('#listening_number').html()
			var listened = data.situationListenNumber;

			$("#listening_number").html(limit - listened);

			$("#limit_listening_text").html(
				pluralizeListen(limit, listened)
			);
		};

		$('#listens-counter').removeClass('hidden');
	})
	.fail(function() {
		alert('Ajax error');
	});

	function pluralizeListen(limit, listened) {
		if((limit - listened) < 2){
			return 'écoute';
		};

		return 'écoutes';
	}


	$(".item_audio_button").click(function(){

		// Number of possible listens
		var limit = Number($(this).attr("data-limit"));

		// Number of times listened
		//var listened = Number($(this).attr("data-listened"));
		var listened = $("#listening_number").html();

		console.log(listened + " " + limit);

		if((listened === null || listened <= limit) && listened > 0 && !play_in_progress) {
			play_in_progress = true;
			sound = $(this).attr("sound");
			audio = document.getElementById(sound);

/*			listened++;
			$(this).attr("data-listened", listened);
*/

//			if (sound == "situtation"){
//				var reste = limit - $(this).attr("data-listened");
//				$("#limit_listening").html(reste);
//			//
//
			$("#limit_listening_text").html(
				pluralizeListen(limit, listened)
			);

//			}
			$(".item_audio_button").css("opacity","0.5");
			$(this).css("opacity","1");
			audio.play();
			//Increment session
			$.ajax({
				url: Routing.generate('incrementeSessionSituationListenNumber'),
				type: 'PUT',
				dataType: 'json'
			})

			.done(function(data) {
				console.log("done");
				var limitListening = $("#limit_listening").html();
				var reste = $("#limit_listening").html() - data.situationListenNumber;
				$("#listening_number").html(reste);
				if(reste < 2){
					$("#limit_listening_text").html("écoute");
				}

				//console.log(data.situationListenNumber);
			})
			.fail(function() {
				alert('Ajax error');
			});
		}

	});

	/* FORM  */
	$("form").submit(function(){
		totalTime = timestamp() - timestampIn;
		$("#totalTime").val(totalTime);
	});

	/* TOOLTIP */
	$('img').tooltip({placement:'top'});

	$('.reset-listening-number').click(function(event) {
		$.ajax({
			url: Routing.generate('resetSessionSituationListenNumber'),
			type: 'PUT',
			dataType: 'json'
		})
	});
});
