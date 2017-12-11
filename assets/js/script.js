;(function($) {

    var WPSM_Main = {

        init: function() {

            this.initiate();
        },

        initiate: function() {
            $( '.wpsm-select2' ).select2();
        }
    }

    $(document).ready(function(){
        WPSM_Main.init();
    });

})(jQuery);