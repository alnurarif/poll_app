var base_url = $('base').attr('data-base');
$(document).ready(function () {
	var target = $('#compass_hand2'),
        originX = target.offset().left + target.width() / 2,
        originY = target.offset().top + target.height() / 2,
        dragging = false,
        startingDegrees = 0,
        lastDegrees = 0,
        currentDegrees = 0,
        target_left = parseInt(target.css('left'), 10),target_top = parseInt(target.css('top'), 10);
    

    $(target).draggable(
    {   
        start: function(e){
            
            dragging = true;

            mouseX = e.pageX;
            mouseY = e.pageY;
            radians = Math.atan2(mouseY - originY, mouseX - originX),
            startingDegrees = radians * (180 / Math.PI);
                
        }, 
        drag: function(e,ui){
            var data = target.data( 'circle' ); 
            
            var mouseX, mouseY, radians, degrees;
        
            if (!dragging) {
                return;
            }
            mouseX = e.pageX;
            mouseY = e.pageY;
            radians = Math.atan2(mouseY - originY, mouseX - originX),
            degrees = radians * (180 / Math.PI) - startingDegrees + lastDegrees;
            
            currentDegrees = degrees;
            console.log(degrees);
            degrees = (degrees>90 && degrees<100)?90:degrees;
            degrees = (degrees>100)?-90:degrees;

            target.css('-webkit-transform', 'rotate(' + degrees + 'deg)');
            target.css('-ms-transform', 'rotate(' + degrees + 'deg)');
            target.css('transform', 'rotate(' + degrees + 'deg)');
            ui.position.top = target_top;
            ui.position.left = target_left;
        },
        stop: function(e,ui){
            lastDegrees = currentDegrees;
            dragging = false;
        }
    });
});