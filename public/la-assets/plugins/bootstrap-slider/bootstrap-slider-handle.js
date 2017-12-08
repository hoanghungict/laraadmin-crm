$(function () {
	@role("SUPER_ADMIN")
	/* ================== Access Control ================== */

	$('.slider').slider();

	$(".slider.slider-horizontal").each(function(index) {
		var field = $(this).next().attr("name");
		var value = $(this).next().val();
		console.log(""+field+" ^^^ "+value);
		switch (value) {
			case '0':
				$(this).removeClass("orange");
				$(this).removeClass("green");
				$(this).addClass("gray");
				break;
			case '1':
				$(this).removeClass("gray");
				$(this).removeClass("green");
				$(this).addClass("orange");
				break;
			case '2':
				$(this).removeClass("gray");
				$(this).removeClass("orange");
				$(this).addClass("green");
				break;
		}
	});

	$('.slider').bind('slideStop', function(event) {
		if($(this).next().attr("name")) {
			var field = $(this).next().attr("name");
			var value = $(this).next().val();
			console.log(""+field+" = "+value);
			if(value == 0) {
				$(this).removeClass("orange");
				$(this).removeClass("green");
				$(this).addClass("gray");
			} else if(value == 1) {
				$(this).removeClass("gray");
				$(this).removeClass("green");
				$(this).addClass("orange");
			} else if(value == 2) {
				$(this).removeClass("gray");
				$(this).removeClass("orange");
				$(this).addClass("green");
			}
		}
	});

	$("#module_select_all,  #view_all").on("change", function() {
		$(".module_checkb").prop('checked', this.checked);
		$(".view_checkb").prop('checked', this.checked);
		$(".edit_checkb").prop('checked', this.checked)
		$(".create_checkb").prop('checked', this.checked);
		$(".delete_checkb").prop('checked', this.checked);
		$("#module_select_all").prop('checked', this.checked);
		$("#view_all").prop('checked', this.checked);
		$("#create_all").prop('checked', this.checked);
		$("#edit_all").prop('checked', this.checked);
		$("#delete_all").prop('checked', this.checked);
	});

	$(".module_checkb,  .view_checkb").on("change", function() {
		var val = $(this).attr( "module_id" );
		$("#module_"+val).prop('checked', this.checked)
		$("#module_view_"+val).prop('checked', this.checked);
		$("#module_create_"+val).prop('checked', this.checked)
		$("#module_edit_"+val).prop('checked', this.checked);
		$("#module_delete_"+val).prop('checked', this.checked);
	});

	$(".create_checkb,  .edit_checkb, .delete_checkb").on("change", function() {
		var val = $(this).attr( "module_id" );
		$(this).prop('checked', this.checked);
		if(!$("#module_"+val).is(':checked')){
			$("#module_"+val).prop('checked', this.checked);
		}
		if(!$("#module_view_"+val).is(':checked')){
			$("#module_view_"+val).prop('checked', this.checked);
		}
	});

	$("#create_all").on("change", function() {
		$(".create_checkb").prop('checked', this.checked);
		if($('#create_all').is(':checked')){
			$(".module_checkb").prop('checked', this.checked);
			$(".view_checkb").prop('checked', this.checked);
			$("#module_select_all").prop('checked', this.checked);
			$("#view_all").prop('checked', this.checked);
		}
	});

	$("#edit_all").on("change", function() {
		$(".edit_checkb").prop('checked', this.checked);
		if($('#edit_all').is(':checked')){
			$(".module_checkb").prop('checked', this.checked);
			$(".view_checkb").prop('checked', this.checked);
			$("#module_select_all").prop('checked', this.checked);
			$("#view_all").prop('checked', this.checked);
		}
	});

	$("#delete_all").on("change", function() {
		$(".delete_checkb").prop('checked', this.checked);
		if($('#delete_all').is(':checked')){
			$(".module_checkb").prop('checked', this.checked);
			$(".view_checkb").prop('checked', this.checked);
			$("#module_select_all").prop('checked', this.checked);
			$("#view_all").prop('checked', this.checked);
		}
	});

	$(".hide_row").on("click", function() {
		var val = $(this).attr( "module_id" );
		var $icon = $(".hide_row[module_id="+val+"] > i");
		if($('.module_fields_'+val).hasClass('hide')) {
			$('.module_fields_'+val).removeClass('hide');
			$icon.removeClass('fa-chevron-down');
			$icon.addClass('fa-chevron-up');
		} else {
			$('.module_fields_'+val).addClass('hide');
			$icon.removeClass('fa-chevron-up');
			$icon.addClass('fa-chevron-down');
		}
	});
	@endrole
});
