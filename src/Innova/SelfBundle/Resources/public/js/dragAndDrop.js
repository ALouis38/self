$(document).ready(function() {
	$( ".draggable" ).draggable({
		revert: "invalid"
	});
	$( ".droppable" ).droppable({
		accept: ".draggable",
		activeClass: "ui-state-hover",
		drop: function( event, ui ) {
			$(this).droppable('option', 'accept', ui.draggable);
		},
		out: function(event, ui){
        	$(this).droppable('option', 'accept', '.draggable');
        }
	});
});