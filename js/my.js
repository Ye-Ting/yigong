/* Mark module and method of this page by add css class to body tag */
$('html').addClass('m-' + config['currentModule'] + ' m-' + config['currentModule'] + '-' + config['currentMethod']);
$(document).ready(function() 
{
    setRequiredFields();

    $.setAjaxForm('#ajaxForm');
    $.setAjaxDeleter('.deleter');
    $.setReloadDeleter('.reloadDeleter');
    $.setReload('.reload');

    /* Ping for keep login every six minute. */
    if(needPing) setInterval('ping()', 1000 * 360);
    
    /* Load message notify. */
    $('#headNav #msgBox').load(createLink('message', 'notify'), function()
    {
        if($('#headNav #msgBox').find('.label').length > 0) $('#msgBox').removeClass('hide').show();
    });

    /* Set 'go to top' button. */
    setGo2Top();

    /* Slide pictures start.   */
    if($('#slide').length)
    {
        $('#slide').carousel();
        $('#slide .item').first().addClass('active');
        $('#slide .item[data-url]').click(function()
        {
            var url    = $(this).data('url');
            var target = $(this).data('target');
            if(url && url.length) window.open(url, target);
        });
    }

    /* Fixed submenu position for browser which doesn't suppport relative postion in a table cell, like firefox 29. */
    var ua = navigator.userAgent.toLowerCase();
    var ver = (ua.match(/.+(?:rv|it|ra|ie)[\/: ]([\d.]+)/) || [0, '0'])[1];
    if(ua.indexOf('firefox') > -1)
    {
        if(parseFloat(ver) < 30) $('#navbar .dropdown > .dropdown-menu').each(function(){$(this).css('left', $(this).closest('.dropdown').position().left - 2);});
        else $('#navbar .dropdown').css('position', 'relative');
    }

    /* Auto ajust block grid width */
    autoBlockGrid();

    /* Remove empty headNav */
    var headNav = $('#headNav');
    if(!headNav.find('nav a').length) headNav.addClass('hide');

    /* set right docker */
    $('#rightDockerBtn').popover({container: 'body', html:true, trigger:'manual'}).mouseenter(function()
    {
        if($('#rightDockerBtn').hasClass('showed')) return;
        $('#rightDocker img[data-src]').each(function()
        {
            var $this = $(this);
            $this.attr('src', $this.data('src')).removeAttr('data-src');
        });
        $(this).addClass('showed').popover('show');
        $("#rightDockerBtn:not('.showed')").popover('hide');
    });
    $(document).click(function(){$('#rightDockerBtn').popover('hide').removeClass('showed');}).on('click', '.popover', function(event){event.stopPropagation();});
});

