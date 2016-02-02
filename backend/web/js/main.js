$(function(){
	$(document).on('click','#modalButtom',function(){
		$('#modal')
			.modal('show')
			.find('#modalContent')
			.load($(this).attr('value'));
	});
});



$(function(){

  $(document).on('click','.fc-day',function(){

    var url = "index.php?r=event/create";

    $('#modal')
    	.modal('show')
    	.find('#modalContent')
    	.load(url);
  });

});
