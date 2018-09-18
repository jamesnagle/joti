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

    $('.menu-btn').on('click', function(e) {
        var href = $(this).attr('href');

        var editor_btn = $('a[href="#editor"]');
        var seo_btn = $('a[href="#seo"]');
        var revisions_btn = $('a[href="#revisions"]');

        var editor      = $('#editor');
        var seo         = $('#seo');
        var revisions   = $('#revisions');

        if (href === '#editor') {
            editor_btn.addClass('active');
            seo_btn.removeClass('active');
            revisions_btn.removeClass('active');

            editor.show();
            seo.hide();
            revisions.hide();
        }
        if (href === '#seo') {
            editor_btn.removeClass('active');
            seo_btn.addClass('active');
            revisions_btn.removeClass('active');

            editor.hide();
            seo.show();
            revisions.hide();
        }
        if (href === '#revisions') {
            editor_btn.removeClass('active');
            seo_btn.removeClass('active');
            revisions_btn.addClass('active');

            editor.hide();
            seo.hide();
            revisions.show();
        }
    });
    $('#editor__title').on('keyup', function(e) {
        e.preventDefault();
        handle_ajax_save($(this).val());
    });
    $('#editor__body').on('keyup', function (e) {
        e.preventDefault();
        handle_ajax_save($(this).val());
    });
    var delayTimer;
    function handle_ajax_save(data) {
        clearInterval(delayTimer);
        setTimeout(function() {
            $('#control-saving').show();
            $.post('/api/document/update', {
                body: data
            }).done(function (res) {
                console.log(res);
                setTimeout(function() {
                    $('#control-saving').hide();
                }, 1000)
            });            
        }, 2000);
    }
})(jQuery);