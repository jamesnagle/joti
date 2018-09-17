;(function($) {
    $('.expander').on('click', function(e) {
        e.preventDefault();

        var skill_id    = $(this).attr('data-id');
        var expanded    = $(this).attr('aria-expanded');
        var icon        = $(this).children('i');
        var lesson_rows = $('.skill-' + skill_id); 

        icon.removeClass((expanded === 'false') ? 'fa-plus' : 'fa-minus');
        icon.addClass((expanded === 'true') ? 'fa-plus' : 'fa-minus');
        $(this).attr('aria-expanded', (expanded === 'false') ? 'true' : 'false'); 
        
        lesson_rows.css({
            display: (expanded === 'false') ? 'table-row' : 'none' 
        });
    });

})(jQuery);