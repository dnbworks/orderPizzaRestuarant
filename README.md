
$('img').each(function(){
    var img = new Image();
    img.onload = function() {
        console.log($(this).attr('src') + ' - done!');
    }
    img.src = $(this).attr('src');
});

clientHeight