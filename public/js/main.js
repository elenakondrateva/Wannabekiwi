/*
 * Main JS
 */

$(document).ready( function(){
	drawStars('.posts .post .favourite');
});

// Filled star
function drawStars(selector) {	
	$(selector).each(function(i){
		$(this).css('background', 'none').css('padding', '0');
		
		$('<canvas width="24" height="24" id="canvas'+i+'"></canvas>').appendTo($(this));
		
		var canvas = document.getElementById('canvas'+i);
		
		if (canvas.getContext) {
			var ctx = canvas.getContext("2d");
			
			ctx.beginPath();
			ctx.moveTo(11.8, 0.0);
			ctx.lineTo(14.2, 7.5);
			ctx.lineTo(22.7, 8.3);
			ctx.lineTo(16.8, 13.9);
			ctx.lineTo(17.5, 21.1);
			ctx.lineTo(11.8, 17.1);
			ctx.lineTo(4.2, 21.1);
			ctx.lineTo(5.9, 13.9);
			ctx.lineTo(0.0, 8.3);
			ctx.lineTo(7.5, 7.5);
			ctx.lineTo(11.8, 0.0);
			ctx.closePath();
			
			ctx.fillStyle = "#E29921";
			ctx.fill();
			
			/*
			ctx.lineWidth = 2;
			ctx.strokeStyle = "#D28F31";
			*/
		}
	});
}