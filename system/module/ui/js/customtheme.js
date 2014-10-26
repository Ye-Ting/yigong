$(function()
{
    var $form = $('#customThemeForm');
    var theme = new Theme($form.data());
    var $css = $('#css');

    $css.height($form.height());

    $('[data-toggle="tooltip"]').tooltip({container: '#ajaxModal'});

    tempColor = new Color();
    $('.color').each(function()
    {
        var $this = $(this);
        var c = $this.attr('data');
        if(!c) return;
        var cc = new Color(c).contrast().toCssStr();

        var $inputColor = ($this.hasClass('input-group') ? $this.find('.input-group-btn .dropdown-toggle') : $this).css({'background': c === 'transparent' ? '' : c, 'color': cc}).find('.caret').css('border-top-color', cc).closest('.input-group').find('.input-color');
        if(!$inputColor.attr('placeholder'))
        {
            $inputColor.attr('placeholder', c);
        }
    }).click(function()
    {
        var $this = $(this);
        if($this.hasClass('input-group')) return;
        var $plate = $this.closest('.colorplate');
        $plate.find('.color.active').removeClass('active');
        if($this.hasClass('color-tile')) $plate.find('.input-color').val($this.attr('data')).change();
        $this.addClass('active');
    });

    $('.input-color').on('keyup change.color', function()
    {
        var $this = $(this);
        var val = $this.val();

        $this.closest('.colorplate').find('.color.active').removeClass('active');

        if(tempColor.isColor(val))
        {
            var ic = (new Color(val)).contrast().toCssStr();
            $this.attr('placeholder', val).closest('.color').removeClass('error').find('.input-group-btn .dropdown-toggle').css({'background': val, 'color': ic}).find('.caret').css('border-top-color', ic);;
        }
        else
        {
            $this.closest('.color').addClass('error');
        }
    });

    $('.input-group-textbox-couple input[data-target]').on('keyup change', function()
    {
        var $this = $(this);
        var name = $this.data('target');
        $('#' + name).val($('[data-sid="' + name + '-1"]').val() + ' ' + $('[data-sid="' + name + '-2"]').val());
    });

    $.setAjaxForm('#customThemeForm', function(response)
    {
    });

    $form.find('input.form-control, select.form-control').on('keyup change', compileLess);

    $form.submit(function(event)
    {
        compileLess();
    });

    compileLess();

    ajustModalSize();
    $('#ajaxModal .modal-dialog').resize(ajustModalSize);

    // Hide tabs
    $('.theme-control-tab-pane').each(function()
    {
        $pane = $(this);
        if(!$pane.find('.table tr').length)
        {
            $('.theme-control-tab[href="#' + $pane.attr('id') +'"]').closest('li').hide();
        }
    });

    $('.nav-tabs li > a').first().trigger('click');

    var $resetThemeBtn = $('#resetTheme');
    $resetThemeBtn.click(function()
    {
        $form.find('input.form-control, select.form-control, input[type="hidden"]').each(function()
        {
            var $this = $(this);
            $this.val($this.data('origin-default') || $this.data('default') || $this.attr('placeholder') || $this.val()).trigger('change.color');
        });

        $resetThemeBtn.popover({trigger:'manual', content: $resetThemeBtn.data('success-tip'), placement:'left'}).popover('show');
        setTimeout(function(){$resetThemeBtn.popover('destroy')},2000);
    });
    
    function compileLess()
    {
        var css = theme.compile(getThemeSettings());
        $css.val(css);
    }

    function getThemeSettings()
    {
        var setting = {},
            $lessTable = $('#lessVarTable tbody').empty();
        $form.find('input.form-control, select.form-control, input[type="hidden"]').each(function()
        {
            var $this = $(this);
            var val = $this.val(),
                type = $this.data('type'),
                name = $this.attr('data-name') || $this.attr('name') || $this.attr('id');
            var desc = $this.attr('data-desc');
            if(name === 'css') return;
            if(!desc)
            {
                var $group = $this.closest('.input-group');
                if($group.hasClass('color'))
                {
                    desc = $group.find('.btn').text();
                }
                else if($group.hasClass('input-group-textbox') || $group.hasClass('input-group-select'))
                {
                    desc = $group.find('.input-group-addon').first().text();
                }
                else if($group.hasClass('input-group-textbox-couple'))
                {
                    desc = $group.find('.input-group-addon').first().text();
                    var label = $this.prev('.input-group-addon').text();
                    if(label != desc)
                    {
                        desc += label;
                    }
                }
                desc = ($('a[href="#' + $group.closest('.tab-pane').attr('id') + '"]').text() + ':' + $group.closest('tr').children('th').first().text() + desc).replace(/\n/, '');
            }

            if(val)
            {
                if(type === 'image' && val != 'inherit' && val != 'none' && val.indexOf('url(') != 0)
                {
                    val = 'url(' + val + ')';
                }
            }
            else
            {
                val = $this.data('default') || $this.attr('placeholder') || null;
            }

            if(val)
            {
                setting[name] = {value: val, desc: desc};
                $lessTable.append('<tr><td class="name w-p40" style="overflow: hidden"><strong title="{0}">{0}</strong></td><td class="w-p20">{1}</td><td><small>{2}</small></td></tr>'.format(name, val, desc));
            }
        });
        return setting;
    }
});

