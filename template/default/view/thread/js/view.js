$(document).ready(function()
{
    $.setAjaxForm('#replyForm', function(response)
    {
        if(response.result == 'success')
        {
            if(response.locate) 
            {
                return setTimeout(function()
                {
                    location.href = response.locate;
                }, 1200);
            }
        }
        else
        {
            if(response.reason == 'needChecking')
            {
                $('#captchaBox').html(response.captcha).show();
            }
        }
    });
    $.setAjaxJSONER('.jsoner', function(response){ bootbox.alert(response.message, function(){location.href = response.locate; return true;});});
    $.setAjaxJSONER('.switcher', function(response){ bootbox.alert(response.message, function(){location.href = response.locate; return false;});});
    $('.nav-system-forum').addClass('active');

    /* remove empty element */
    $('.speaker > ul > li > span:empty').closest('li').remove();
});
