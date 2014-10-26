$(document).ready(function()
{
    $.setAjaxForm('#uploadForm', function(response) { if(response.result == 'success') $('#ajaxModal').attr('rel', response.locate).load(response.locate); });
});

