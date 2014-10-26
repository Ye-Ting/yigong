$(document).ready(function()
{
    /* Set current active topNav. */
    if(v.path && v.path.length)
    {
        var hasActive = false;
        $.each(v.path, function(index, category) 
        { 
            if(!hasActive)
            {
                if($('.nav-article-' + category).length >= 1) hasActive = true;
                $('.nav-article-' + category).addClass('active');
            }
        });
        if(!hasActive) $('.nav-article-0').addClass('active');
    }

    if(v.categoryID !== 0) $('#category' + v.categoryID).parent().addClass('active');
});
