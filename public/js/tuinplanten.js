var $ = jQuery.noConflict();

$(document).ready(function() {

    $("#tuinplanten-datatables")
            .tablesorter({
        theme: 'tuinplanten',
        widthFixed: true,
        widgets: ['zebra'],
        headers: {
            1: {sorter: false},
            7: {sorter: false},
            8: {sorter: false},
            9: {sorter: false},
            10: {sorter: false}
        }
    })
            .tablesorterPager({
        container: $("#pager"),
        size: 10
    });

    /**
     * Ajax call for showing features and habitats for each plant.
     * Including caching for already loaded data.
     */
    var data = [];

    $('.plant').hover(function() {
        var id = $(this).attr('id');
        var url = $(this).find('a').attr('href');

        if (data[id] !== undefined)
        {
            // show cached data
            $('#popupdata').html(data[id].response);
            $("#plant_overlay").fadeIn(500);
            positionPopup("#plant_overlay");
        }
        else
        {
            // load new data and store in data array
            $.ajax({
                type: "post",
                url: url,
                data: {'id': id},
                //dataType: "json",
                success: function(response) {
                    // cache reponse for this id
                    data[id] = {'response': response};
                    $('#popupdata').html(response);
                    $("#plant_overlay").fadeIn(500);
                    positionPopup("#plant_overlay");
                },
                error: function() {
                    console.log('there was an error');
                }
            });
        }
    }, function() {
        $("#plant_overlay").fadeOut(200);
    }).trigger('mouseleave');

    $(document).mousemove(function(event) {
        if ($('#plant_overlay').is(':visible')) {
            $('#plant_overlay').css({'top': currentMousePos.y, 'left': currentMousePos.x});
        }
    });

    /**
     * Ajax call for uploading images

     $('.photo').on('click', function(event) {
     event.preventDefault();
     var url = $(this).attr("href");

     $.ajax({
     type: "post",
     url: url,
     success: function(data) {
     $('#popupdata').html(data);
     $("#photo_overlay").fadeIn(500);
     positionPopup("#photo_overlay");
     },
     error: function() {
     console.log('there was an error');
     }
     });
     });

     $(document).on("submit", "form#Upload", function(event) {
     var wait = "<img src='/img/loader.gif' />";
     $('form#Upload').empty().html(wait);
     });
     */

    var currentMousePos = {x: -1, y: -1};
    $(document).mousemove(function(event) {
        currentMousePos.x = event.pageX;
        currentMousePos.y = event.pageY;
    });

    //position the popup at the center of the page
    function positionPopup(theDiv) {
        if (!$(theDiv).is(':visible')) {
            return;
        }
//        $(theDiv).css({
//            left: ($(window).width() - $(theDiv).width()) / 2,
//            top: ($(window).width() - $(theDiv).width()) / 7,
//            position: 'absolute'
//        });

        $(theDiv).css({'top': currentMousePos.y, 'left': currentMousePos.x});

        $("#btnDone").click(function() {
            $(theDiv).fadeOut(200);
        });
    }

    //maintain the popup at center of the page when browser resized
    $(window).bind('resize', positionPopup);

    $('.planting_date').datepicker({dateFormat: 'dd/mm/yyyy', defaultDate: new Date()});
    $('.planting_date').focus(function() {
        $(this).datepicker("show");
        setTimeout(function() {
            $('.planting_date').datepicker("hide");
            $('.planting_date').blur();
        }, 2000);
    });

    // display photo for plants
    $('.firstPhoto').each(function() {
        var firstphoto = $(this);
        var photo_id = firstphoto.val();
        var img = "";
        $.ajax({
            type: "post",
            url: 'photo/thumb/' + photo_id,
            success: function(src) {
                img = "<img src='" + src + "' />";
                firstphoto.after(img);
            },
            error: function() {
                console.log('there was an error');
            }
        });



    });
});
