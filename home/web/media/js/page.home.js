$(document).ready(function(){
    slide();
    scroll(location.hash);
    NProgress.done();

    $popUp.overlay = $("#overlay");
    $popUp.poupWindow  = $("#popup");
    $popUp.popUp();

    $("div.navigation ul.menu li a").click(function(){
        scroll($(this).attr('href'));
    });

    $("li.signup a").click(function(){
        $popUp.openPopup();
        return false;
    });

    $("input[name=account_name]").keydown(function(e){
        //allow backspace & delete
        if (e.keyCode == 8  || e.keyCode == 46) return true;
        //allow 0-9
        if (e.keyCode >= 48 && e.keyCode <= 57 ) return true;
        //allow a-z
        if (e.keyCode >= 65 && e.keyCode <= 90 ) return true;
        //allow A-Z
        if (e.keyCode >= 65 && e.keyCode <= 90 ) return true;
        //allow "-" and "_"
        if (e.keyCode == 173) return true;

        return false;

    });

    $(".popup-submit").click(function(){
        $("input[name=account_name]").val($("input[name=account_name]").val().toLowerCase());

        var
            account_name    = $("input[name=account_name]").val(),
            company         = $("input[name=company]").val(),
            site            = $("input[name=site]").val(),
            country         = $("select[name=country]").val(),
            user_name       = $("input[name=user_name]").val(),
            user_email      = $("input[name=user_email]").val(),
            passwd          = $("input[name=passwd]").val(),
            timezone        = $("select[name=timezone]").val();

        if (account_name == '') return displayPopupError('Please fill Account Name below');
        if (company == '') return displayPopupError('Please fill Company name below');
        if (site == '') return displayPopupError('Please fill Company Website below');
        if (country == null) return displayPopupError('Please select your Country');
        if (user_name == '') return displayPopupError('Please fill Your name below');
        if (user_email == '') return displayPopupError('Please fill Your email below');
        if (passwd == '') return displayPopupError('Please fill Password below');

        NProgress.start();

        $.ajax({
            url: "/signup",
            method: 'POST',
            data: {
                'company': {
                    'name': account_name,
                    'company': company,
                    'site': site,
                    'country': country,
                    'timezone': timezone
                },
                'user': {
                    'name': user_name,
                    'email': user_email,
                    'passwd': passwd
                }
            },
            error: function() {
                NProgress.done();
            },
            success: function(data) {
                NProgress.done();
                var answer = jQuery.parseJSON( data );

                if (answer.code == '1')
                {
                    $(".form-line").fadeOut("fast", function(){
                        $(".success-msg").fadeIn("fast");
                        $("button[type=submit]").hide();
                    });
                }
                else
                {
                    if (answer.mess == 'empty_fields')      return displayPopupError('Please fill all fields below');
                    if (answer.mess == 'wrong_email')       return displayPopupError('Wrong email');
                    if (answer.mess == 'company_exists')    return displayPopupError('This Account name is already exists. Please choose another Account name');
                }
            }
        })

        return false;
    });

    $("select[name=country").change(function(){
        var countryCode = $(this).val();

        NProgress.start();

        $.ajax({
            url: "/get_time_zone",
            method: 'POST',
            data: { 'countryCode': countryCode },
            error: function() { NProgress.done(); },
            success: function(data) {
                NProgress.done();

                var answer = jQuery.parseJSON( data );
                var options = '';

                $.each( answer.zones, function( index, value ){
                    options += '<option value="'+value.id+'">'+value.zone_name+'</option>';
                });

                $("select[name=timezone]").html(options);

                NProgress.done();
            }
        });
    });
});