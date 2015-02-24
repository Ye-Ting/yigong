$(document).ready(function() {
	$('.nav-system-activity').addClass('active');
	$('.join-activity-btn').on('click', function() {
		// alert($(this).data('a'));
		alert(createLink('activity', 'join', 'objectID=')  + $(this).data('a'));
		// $.ajax({

		// 	　　
		// 	type: 'GET',

		// 	　　url: this.data('herf'),

		// 	// 　　data: '',

		// 	　　success: success,

		// 	　　dataType: 'json'

		// 	　　
		// });
	});
});
// $(document).ready(function()
// {
//     $.setAjaxForm('#peopleBox', function(response)
//     {
//         if(response.result == 'success')
//         {
//             setTimeout(function()
//             {
//                 var link = createLink('message', 'comment', 'objecType=' + v.objectType + '&objectID=' + v.objectID);
//                  $('#peopleBox').closest('#peopleBox').load(link, location.href="#first");
//             },  
//             1000);   
//         }
//         else
//         {
//             if(response.reason == 'needChecking')
//             {
//                 $('#captchaBox').html(response.captcha).show();
//             }
//         }
//     });

//     $('#pager').find('a').click(function()
//     {
//         $('#peopleBox').load($(this).attr('href'));
//         return false;
//     });

//     $('a[id*=reply]').modalTrigger();
// });