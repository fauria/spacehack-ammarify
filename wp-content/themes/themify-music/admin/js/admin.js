 (function($){
     $(document).ready(function(){
        
       // Player display type
        $('.themify_player_types input').change(function(){
            $('.themify_album_tabs.hide').slideUp();
            $('#'+ $(this).attr('id')+'_').slideDown();
        });
        $('.themify_player_types input:checked').trigger('change');
     });

})(jQuery);