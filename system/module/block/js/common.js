$(function()
{
    tempColor = new Color();
    $('.color').each(function()
    {
        var $this = $(this);
        var c = $this.attr('data');
        if(!c) return;
        var cc = new Color(c).contrast().hexStr();

        ($this.hasClass('input-group') ? $this.find('.input-group-btn .dropdown-toggle') : $this).css({'background': c, 'color': cc}).find('.caret').css('border-top-color', cc);
    }).click(function()
    {
        var $this = $(this);
        if($this.hasClass('input-group')) return;
        var $plate = $this.closest('.colorplate');
        $plate.find('.color.active').removeClass('active');
        if($this.hasClass('color-tile')) $plate.find('.input-color').val($this.attr('data')).change();
        $this.addClass('active');
    });

    $('.input-color').on('keyup change', function()
    {
        var $this = $(this);
        var val = $this.val();

        $this.closest('.colorplate').find('.color.active').removeClass('active');

        if(tempColor.isColor(val))
        {
            var ic = (new Color(val)).contrast().hexStr();
            $this.attr('placeholder', val).closest('.color').removeClass('error').find('.input-group-btn .dropdown-toggle').css({'background': val, 'color': ic}).find('.caret').css('border-top-color', ic);;
        }
        else
        {
            $this.closest('.color').addClass('error');
        }
    });

    if(v.type == 'phpcode' && !v.cancreatephp)
    {
        bootbox.alert(v.setOkFile, function()
        {
            location.href = createLink('block', 'create');
        });
    }

    var $panelPreview = $('.panel-preview > .panel');
    $('#title').change(function()
    {
        $panelPreview.find('.title').text($(this).val());
    });

    $('[name="params\\[icon\\]"]').change(function()
    {
        $panelPreview.find('.icon').attr('class', 'icon ' + $(this).val());
    }).change();

    $('[name="params\\[iconColor\\]"]').change(function()
    {
        $panelPreview.find('.icon').css('color', $(this).val());
    }).change();

    $('[name="params\\[titleColor\\]"]').change(function()
    {
        $panelPreview.find('.title').css('color', $(this).val());
    }).change();

    $('[name="params\\[titleBackground\\]"]').change(function()
    {
        $panelPreview.find('.panel-heading').css('background', $(this).val());
    }).change();

    $('[name="params\\[backgroundColor\\]"]').change(function()
    {
        $panelPreview.css('background', $(this).val());
    }).change();

    $('[name="params\\[textColor\\]"]').change(function()
    {
        $panelPreview.find('.panel-body').css('color', $(this).val());
    }).change();

    $('[name="params\\[borderColor\\]"]').change(function()
    {
        $panelPreview.css('border-color', $(this).val());
        $panelPreview.find('.panel-heading').css('border-bottom-color', $(this).val());
    }).change();

    $('[name="params\\[linkColor\\]"]').change(function()
    {
        $panelPreview.find('a').css('color', $(this).val());
    }).change();
});
