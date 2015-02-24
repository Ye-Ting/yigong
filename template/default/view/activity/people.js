$(document).ready(function()
{
    $.setAjaxForm('#peopleForm', function(response)
    {
        if(response.result == 'success')
        {
            setTimeout(function()
            {
                var link = createLink('message', 'people', 'objecType=' + v.objectType + '&objectID=' + v.objectID);
                 $('#peopleForm').closest('#peopleBox').load(link, location.href="#first");
            },  
            1000);   
        }
        else
        {
            if(response.reason == 'needChecking')
            {
                $('#captchaBox').html(response.captcha).show();
            }
        }
    });

    $('#pager').find('a').click(function()
    {
        $('#peopleBox').load($(this).attr('href'));
        return false;
    });

    $('a[id*=reply]').modalTrigger();
});
