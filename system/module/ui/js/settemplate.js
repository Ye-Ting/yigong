$(document).ready(function()
{
    $('.theme-img').hover(function()
    {
        var $this = $(this);
        var $img = $this.closest('.card-template').find('.template-img img');
        $img.attr('src', $this.find('img').attr('src'));
    }, function()
    {
        var $this = $(this);
        var $img = $this.closest('.card-template').find('.template-img img');
        $img.attr('src', $this.closest('.themes-list').find('.theme.current .theme-img img').attr('src'));
    });

    $('.theme').click(function()
    {
        var $this = $(this);
        var $tpl  = $this.closest('.card-template');
        if($this.hasClass('current') && $tpl.hasClass('current')) return;

        $.getJSON($this.data('url'), function(response)
        {
            if(response.result == 'success')
            {
                messager.success(response.message);

                if(!$tpl.hasClass('current'))
                {
                    var $oldTpl       = $('.card-template.current').removeClass('current');
                    var $oldTplBtn    = $oldTpl.find('.btn-apply-template');
                    $oldTplBtn.removeClass('btn-success disabled').html($oldTplBtn.data('default'));

                    $tplBtn = $tpl.find('.btn-apply-template');
                    $tplBtn.addClass('btn-success disabled').html($tplBtn.data('current'));
                    $tpl.addClass('current');
                }

                var $themes = $this.closest('.themes-list');
                $themes.attr('data-theme', $this.data('theme'))
                       .find('.theme.current').removeClass('current');
                $this.addClass('current');

                $tpl.find('.current-theme-tip strong').text($this.find('.theme-name strong').text());
                $tpl.find('.template-img img').attr('src', $this.find('.theme-img img').attr('src'));
            }
            else
            {
                bootbox.alert(data.message);
            }
        });
    });

    $('.btn-apply-template').click(function()
    {
        var $this = $(this);
        var $tpl  = $this.closest('.card-template');
        if($this.hasClass('disabled')) return;

        var $themes = $tpl.find('.themes-list');
        if($themes.length)
        {
            var defaultTheme = $themes.data('theme') || 'default';
            var $theme = $themes.find('.theme[data-theme="' + defaultTheme + '"]');
            if($theme == null || (!$theme.length))
            {
                $theme = $themes.find('.theme').first();
            }
            $theme.click();
        }
        else
        {
            $.getJSON($tpl.data('url'), function(response)
            {
                if(response.result == 'success')
                {
                    messager.success(response.message);

                    var $oldTpl       = $('.card-template.current').removeClass('current');
                    var $oldTplBtn    = $oldTpl.find('.btn-apply-template');
                    $oldTplBtn.removeClass('btn-success disabled').html($oldTplBtn.data('default'));

                    $tplBtn = $tpl.find('.btn-apply-template');
                    $tplBtn.addClass('btn-success disabled').html($tplBtn.data('current'));
                    $tpl.addClass('current');
                }
            });
        }
    });
});

function ajustModalSize()
{
    var $modal = $('#ajaxModal');
    var $dialog = $('#ajaxModal .modal-dialog');
    var height = Math.max($dialog.height(), $modal.data('min-height') || 400);
    $dialog.css('min-height', height);
    $modal.data('min-height', height);
}
