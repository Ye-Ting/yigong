$(document).ready(function()
{
    $('#peopleBox').load( createLink('message', 'people', 'objectType=activity&objectID=' + v.activityID) );  
});
$(document).ready(function()
{
    $('.nav-system-activity').addClass('active');
});
