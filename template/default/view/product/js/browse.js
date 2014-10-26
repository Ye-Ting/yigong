$(function()
{
    $('.media-placeholder').each(function()
    {
        var $this = $(this);
        $this.attr('style', 'background-color: hsl(' + $this.data('id') * 57 % 360 + ', 80%, 90%)');
    });
});
