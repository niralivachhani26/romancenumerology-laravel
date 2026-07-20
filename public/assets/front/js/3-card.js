$(document).ready(function(e){
    alert('here 1');
    $('.start').click(function () {
        $('.start').fadeOut();
        alert('here 2');
        $(".list").animate({ minHeight: '380' }, 50, false);
        $(".card-tarot").animate({ top: '200' }, 100, false);
        setTimeout(function () {
            $(".card-tarot").each(function (e) {
                setTimeout(function () {
                    $(".card-tarot").eq(e).attr("class", "card-tarot hover card" + e);
                    $(".card" + e).css("top", "0px");
                }, e * 150);
                setTimeout(function () {
                    $("#card-msg").animate({ opacity: '1' }, 1000, false);
                    $('.card-tarot').removeClass("not-active");
                }, 3500);
            });
        }, 700);
    });
    var card = 0;
    var cl0 = ""; var cl1 = ""; var cl2 = "";
    $("body").on("click", ".card-tarot", function () {
        if ($("#card-msg").is(':visible') && card == 0) {
            // alert(0);
            $(this).removeClass("hover");
            $(this).css("right", "calc(50% - -61px)");
            $(this).css("top", "200px");
            $("#card-msg").html("Select 2 Cards...");
            $(this).css("z-index", "100");
            card++;
            cl0 = $(this).attr("class");
            cl0 = cl0.split(" ");
            // $("." + cl0[1] + " .back").attr('src', site_url + "assets/img/tarot/" + type + "/" + s1 + ".jpg");
            setTimeout(function () {
                $("." + cl0[1]).addClass("flip");
            }, 500);

        } else if (card == 1) {
            $(this).removeClass("hover");
            $(this).css("z-index", "101");
            $(this).css("right", "calc(50% - 54px)");
            $(this).css("top", "200px");
            $("#card-msg").html("Select 1 Card...");
            card++;
            cl1 = $(this).attr("class");
            cl1 = cl1.split(" ");
            // $("." + cl1[1] + " .back").attr('src', site_url + "assets/img/tarot/" + type + "/" + s2 + ".jpg");
            setTimeout(function () {
                $("." + cl1[1]).addClass("flip");
            }, 500);
        } else if (card == 2) {
            $('.card-tarot').removeClass("hover");
            $(this).css("z-index", "102");
            $(this).css("right", "calc(50% - 169px)");
            $(this).css("top", "200px");
            card++;
            $("#card-msg").html("&nbsp;");
            //remove cards
            cl2 = $(this).attr("class");
            cl2 = cl2.split(" ");
            // $("." + cl2[1] + " .back").attr('src', site_url + "assets/img/tarot/" + type + "/" + s3 + ".jpg");
            setTimeout(function () {
                $("." + cl2[1]).addClass("flip");
            }, 500);

            setTimeout(function () {
                $('.get-result').fadeIn();
            }, 1000);
        }
    });
});
