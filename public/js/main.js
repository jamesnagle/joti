;(function($) {
    function getUrlVars() {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for (var i = 0; i < hashes.length; i++) {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }
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
        handle_ajax_draft($(this).val(), 'title');
    });
    $('#editor__body').on('keyup', function (e) {
        e.preventDefault();
        handle_ajax_draft($(this).val(), 'body');
    });
    var delayTimer;
    function handle_ajax_draft(value, type) {
        clearInterval(delayTimer);
        setTimeout(function() {
            $('#control-saving').show();
            $.post('/api/document/draft', {
                document_id: $('input[name="doc_id"]').val(),
                type: type,
                data: value
            }).done(function (res) {
                console.log(res);
                setTimeout(function() {
                    $('#control-saving').hide();
                }, 1000)
            });            
        }, 2000);
    }
    $('#control-commit').on('click', function(e) {
        e.preventDefault();

        var document_id = $('input[name="doc_id"]').val();
        var status = $('#control-status').val();
        var title = $('#editor__title').val();
        var body = $('#editor__body').val();
        var slug = $('#ontrol-slug').val();
        var type = $('input[name="doc_type"]').val();
        var seo_title = $('#seo__title').val();
        var seo_description = $('#seo__description').val();
        var index = $('input[name="seo_index"]').val();
        var nofollow = $('input[name="seo_nofollow"]').val();

        var icon = $(this).children('i');

        icon.removeClass('far fa-check-circle');
        icon.addClass('fas fa-spinner');
        icon.addClass('fa-spin');

        $.post('/api/document/update', {
            document_id: document_id,
            status: status,
            title: title,
            body: body,
            slug: slug,
            type: type,
            seo_title: seo_title,
            seo_description: seo_description,
            index: index,
            nofollow: nofollow
        }).done(function (res) {
            setTimeout(function() {
                icon.removeClass('fa-spin');
                icon.removeClass('fas fa-spinner');
                icon.addClass('far fa-check-circle');
            }, 1000);

            var query_str = getUrlVars();
            
            if(!query_str.hasOwnProperty('id')) {
                window.location.href = '/admin/?action=edit&type='+type+'&id='+document_id+'#editor';
            }
        }).fail(function(res) {
            console.log(res);
        }); 
    });
})(jQuery);