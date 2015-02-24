$(document).ready(function() {
	// $.setAjaxForm('#peopleBox', function(response)
	// {
	//     if(response.result == 'success')
	//     {
	//         setTimeout(function()
	//         {
	//             var link = createLink('message', 'comment', 'objecType=' + v.objectType + '&objectID=' + v.objectID);
	//              $('#peopleBox').closest('#peopleBox').load(link, location.href="#first");
	//         },  
	//         1000);   
	//     }
	//     else
	//     {
	//         if(response.reason == 'needChecking')
	//         {
	//             $('#captchaBox').html(response.captcha).show();
	//         }
	//     }
	// });

	// $('#pager').find('a').click(function()
	// {
	//     $('#peopleBox').load($(this).attr('href'));
	//     return false;
	// });

	// $('a[id*=reply]').modalTrigger();


	$.setAjaxForm('#create_volunteer', function(response) {
		if (response.result == 'success') {
			// setTimeout(function()
			// {
			//     var link = createLink('message', 'comment', 'objecType=' + v.objectType + '&objectID=' + v.objectID);
			//      $('#peopleBox').closest('#peopleBox').load(link, location.href="#first");
			// },  
			// 1000);   
			var volunteer = response.data;
			console.info('volunteer',volunteer);
			// $("#create_volunteer").collapse();
			$('#create_volunteer').collapse('hide');
			$('#volunteer_select').css('display', 'none');
			$('#volunteer_info').html('<b>义工号:' + volunteer.volunteer_no + ' 身份证号:' + volunteer.id_card + ' 姓名:' + volunteer.name +'</b>');
			$('#volunteer_id').val(volunteer.id);
		} else {
			// if(response.reason == 'needChecking')
			// {
			//     $('#captchaBox').html(response.captcha).show();
			// }
		}
	});
	var volunteers;
	$('.search_volunteer').on('click', function() {
		var link = createLink('volunteer', 'search', 'keyword=' + $('#volunteer_keword').val());
		$.getJSON(link, function(data) {
			// console.log(data);
			$('#volunteer_select').css('display', 'block');
			if (data.length > 0) {
				volunteers = data;
				var html = '';
				for (var i = data.length - 1; i >= 0; i--) {
					html += '<tr>';
					html += '<td class="text-center">' + data[i].volunteer_no + '</td>';
					html += '<td class="text-center">' + data[i].id_card + '</td>';
					html += '<td class="text-center">' + data[i].name + '</td>';
					html += '<td class="text-center">' + data[i].phone + '</td>';
					html += '<td class="text-center"> <a class="volunteer_item btn btn-info btn-sm" data-index="' + i + '" >选中</a> </td>';
					html += '</tr>';
				}
				console.log(html);
				$('#volunteer_result_table').html(html);



			}
		});
		return false;
	});

	$('#volunteer_result_table').on('click', '.volunteer_item', function() {
		// alert('11111');
		// console.log('122221');
		var self = $(this);
		var volunteer = volunteers[self.data('index')];

		$('#volunteer_select').css('display', 'none');
		$('#volunteer_info').html('<b>义工号:' + volunteer.volunteer_no + ' 身份证号:' + volunteer.id_card + ' 姓名:' + volunteer.name +'</b>');
		$('#volunteer_id').val(volunteer.id);
	});

});