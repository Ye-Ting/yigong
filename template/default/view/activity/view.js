$(document).ready(function()
{
    $('#commentBox').load( createLink('message', 'comment', 'objectType=activity&objectID=' + v.activityID) );  
});
