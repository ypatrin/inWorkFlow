function slide(cls)
{
    var time = 6000;
    var timeEff = 1300;

    if (!cls) {
        $(".text-1").fadeIn(timeEff, function(){
            setTimeout(function(){
                slide(".text-2")
            }, time);
        });
    }

    if (cls == ".text-1") {
        $(".text-2").fadeOut(timeEff, function(){
            $(".block-one").fadeOut("fast", function(){
                $(".block-one").css('backgroundImage', 'url(/media/img/bg-1.jpg)');
                $(".block-one").fadeIn("fast", function(){
                    $(".text-1").fadeIn(timeEff, function(){
                        setTimeout(function(){ slide(".text-2") }, time);
                    });
                });
            });

        });
    }
    if (cls == ".text-2") {
        $(".text-1").fadeOut(timeEff, function(){
            $(".block-one").fadeOut("fast", function(){
                $(".block-one").css('backgroundImage', 'url(/media/img/bg-2.jpg)');
                $(".block-one").fadeIn("fast", function(){
                    $(".text-2").fadeIn(timeEff, function(){
                        setTimeout(function(){ slide(".text-1") }, time);
                    });
                });
            });
        });
    }
}

function scroll($target)
{
    if ($target == '#home')
        $('body').scrollTo('0',{duration:1000});

    if ($target == '#features')
        $('body').scrollTo('div.features',{duration:1000, offset: -100});

    if ($target == '#why-users-choose-us')
        $('body').scrollTo('div.wucu',{duration:1000, offset: -100});
}

var timer;

function displayPopupError($message)
{
    if (timer)
    {
        clearTimeout(timer);
        $(".error").hide("fast");
    }

    $(".error").html($message);
    $(".error").show("fast");

    timer = setTimeout(function(){
        $(".error").hide("fast");
    }, 5000);

    return false;
}