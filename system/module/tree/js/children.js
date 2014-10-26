$(document).ready(function()
{
    var initSortable = function()
    {
        $('#childList').sortable({trigger: '.sort-handle', selector: '.category', dragCssClass: ''});
    }

    initSortable();

    $.setAjaxForm('#childForm');
});
