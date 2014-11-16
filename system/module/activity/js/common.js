$(document).ready(function()
{
    /* Set the orginal and copySite, copyURL fields. */
    $('#source').change(function()
    {
        $('#copyBox').hide().find(':input').attr('disabled', true);
        if($(this).val() != 'original') $('#copyBox').show().find(':input').attr('disabled', false);
    });

    $('#isLink').change(function()
    {   
        if($(this).prop('checked'))
        {   
            $('.activityInfo').hide();
            $('.link').show();
        }   
        else
        {   
            $('.activityInfo').show();
            $('.link').hide();
        }   
    }); 
    
    /* Set current active topNav. */
    if(v.path && v.path.length)
    {
        var hasActive = false;
        $.each(v.path, function(index, category) 
        { 
            if(!hasActive)
            {
                if($('.nav-activity-' + category).length >= 1) hasActive = true;
                $('.nav-activity-' + category).addClass('active');
            }
        });
        if(!hasActive) $('.nav-activity-0').addClass('active');
    }

    if(v.categoryID !== 0) $('.tree #category' + v.categoryID).addClass('active');
});
