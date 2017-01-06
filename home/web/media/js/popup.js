var $popUp = {
    overlay: '',
    poupWindow : '',

    openPopup: function(){
        $($popUp.overlay).fadeIn('fast', function(){
            $($popUp.poupWindow).fadeIn('slow');
        });
    },

    closePopup: function(){
        $($popUp.poupWindow).fadeOut('fast', function(){
            $($popUp.overlay).fadeOut('fast');
        });
    },

    popUp: function(){
        $($popUp.overlay).click(function() { $popUp.closePopup() });
        $('.popup-close').click(function() { $popUp.closePopup() });
    }

};