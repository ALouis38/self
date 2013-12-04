$(document).ready(function() {
	$( ".draggable" ).draggable({
		snap: true,
		revert: "invalid"
	});

	$( ".droppable" ).droppable({
		accept: ".draggable",
		activeClass: "valid-target",
		drop: function( event, ui ) {
			$(this).droppable('option', 'accept', ui.draggable);
		},
		out: function(event, ui){
        	$(this).droppable('option', 'accept', '.draggable');
        }
	});
});