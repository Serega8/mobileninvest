//INITIALIZES FLEXSLIDER
$(document).ready(function() {
	      
    $(".target_blank").click(
          function(){
            return !window.open(this.href);
      });

    $('.flexslider').flexslider({
        animation: "fade",
        directionNav: true,
        controlNav: false, 
        easing: "swing", 
        direction: "horizontal",
        controlsContainer: ".flex-container"
    });

    // YMaps.jQuery(function () {
    //     // Создание первой карты с центром в Москве
    //     var mapMsc = new YMaps.Map(YMaps.jQuery("#ymaps-msc")[0]);
    //     mapMsc.setCenter(new YMaps.GeoPoint(27.448801,53.862714), 13);

    //     // Создание второй карты с центром в Санкт-Петербурге
    //     var mapSpb = new YMaps.Map(YMaps.jQuery("#ymaps-spb")[0]);
    //     mapSpb.setCenter(new YMaps.GeoPoint(30.313,59.938), 10);

    // });
});
$(window).load(function(){
    $(".switch").click(function(){
        var hidden = $(".hidden");
        for (var i = 0; i < hidden.length; i++) {
            if ($(hidden[i]).hasClass("active")){
                $(hidden[i]).removeClass("active");
            }
            else{
                $(hidden[i]).addClass("active");   
            }
        };
    });
});
