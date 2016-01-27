$(function(){
	$(document).on('click','#modalButtom',function(){
		$('#modal')
			.modal('show')
			.find('#modalContent')
			.load($(this).attr('value'));
	});
});