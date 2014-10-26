$(document).ready(function()
{
    $("a[href*='f=upload']").modalTrigger({type:'ajax'});

    $('a.loadInModal').click(function()
    {
        $('#ajaxModal').load($(this).attr('href'));  
        return false;
    });
})
