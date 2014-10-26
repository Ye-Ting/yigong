$(document).ready(function()
{
    var initSortable = function()
    {
        $('#blockList').sortable({trigger: '.sort-handle-1', selector: '.block-item', dragCssClass: ''});
        $('#blockList .children').sortable({trigger: '.sort-handle-2', selector: '.block-item', dragCssClass: ''});
    };

    var hideEmptyChildren = function()
    {
        $('#blockList .block-item .children').each(function()
        {
            var $this = $(this);
            $this.toggleClass('hide', !$this.children('.block-item').length);
        });
    }
    
    hideEmptyChildren();
    computeParent();
    initSortable();

    $('#blockList').on('click', '.plus, .plus-child, .btn-add-child', function()
    {
        setTimeout(hideEmptyChildren, 100);
        setTimeout(initSortable, 200);
    });
})
