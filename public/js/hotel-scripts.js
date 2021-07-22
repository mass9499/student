$( function() {
    var availableTags = [
      "Dubai",
      "Riyah",
      "Makkah",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $( "#city_search" ).autocomplete({
      source: availableTags,
      min:1
    });
  } );

		 // check if element is available to bind ITS ONLY ON HOMEPAGE
    var currentDate = moment().format("DD-MM-YYYY");

    $('#search_checkin, #search_checkout').daterangepicker({
        locale: {
              format: 'DD-MM-YYYY'
        },
        "alwaysShowCalendars": true,
        "minDate": currentDate,

        autoApply: true,
        autoUpdateInput: false
    }, function(start, end, label) {
      // console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
      // Lets update the fields manually this event fires on selection of range
      var selectedStartDate = start.format('DD-MM-YYYY'); // selected start
      var selectedEndDate = end.format('DD-MM-YYYY'); // selected end

      $checkinInput = $('#search_checkin');
      $checkoutInput = $('#search_checkout');

      // Updating Fields with selected dates
      $checkinInput.val(selectedStartDate);
      $checkoutInput.val(selectedEndDate);

      // Setting the Selection of dates on calender on CHECKOUT FIELD (To get this it must be binded by Ids not Calss)
      var checkOutPicker = $checkoutInput.data('daterangepicker');
      checkOutPicker.setStartDate(selectedStartDate);
      checkOutPicker.setEndDate(selectedEndDate);

      // Setting the Selection of dates on calender on CHECKIN FIELD (To get this it must be binded by Ids not Calss)
      var checkInPicker = $checkinInput.data('daterangepicker');
      checkInPicker.setStartDate(selectedStartDate);
      checkInPicker.setEndDate(selectedEndDate);

    });


	$("body").on("click",".hotel_room_add",function(){
		var room_slection = $("#room_slection").clone();
		var total_sel = $(".room_slection").length;
		var new_total_sel = total_sel + 1;
		
		if( new_total_sel <5){
			room_slection.find(".hotel_room_title span").html(new_total_sel);
			room_slection.find(".hidden_default").hide();
			$(".room_slection_append").append(room_slection);
		}
		
		if( new_total_sel >= 2){
			$(".hotel_room_minus").show();
		}
		else{
			$(".hotel_room_minus").hide();
		}

	});

	$(".hotel_room_minus").click(function(){
		$(".room_slection_append .room_slection:last").remove();
		var total_sel = $(".room_slection").length;
		alert();
		if( total_sel  <2){
			$(".hotel_room_minus").hide();
		}

		
	});

	$(".hotel_rooms").click(function(){
		var hotel_rooms_count = $(this).val();
		$(".hotel_extra_rooms").hide();
		if(hotel_rooms_count == 'a'){
			$(".room_slection_append .room_slection").remove();
			$(".room_slection .hotel_adult").val(2);
			$(".room_slection .hotel_child").val(0);
		}
		else if(hotel_rooms_count == 'b'){
			$(".room_slection_append .room_slection").remove();
			$(".room_slection .hotel_adult").val(1);
			$(".room_slection .hotel_child").val(0);
		}

		else if(hotel_rooms_count == 'c'){
			$(".room_slection .hotel_adult").val(2);
			$(".room_slection .hotel_child").val(0);
			$(".hotel_extra_rooms").show();
		}
	});

	$("body").on("change",".hotel_child",function(){
		
		var hotel_child_count = $(this).val();
		
		if(hotel_child_count ==1){
			$(this).parents(".room_slection").find(".hotel_age").show();
			$(this).parents(".room_slection").find(".chilage_"+ 1).show();
			$(this).parents(".room_slection").find(".chilage_"+ 2).hide();
		}
		else if(hotel_child_count ==2){
			$(this).parents(".room_slection").find(".hotel_age").show();
			$(this).parents(".room_slection").find(".chilage_"+ 1).show();
			$(this).parents(".room_slection").find(".chilage_"+ 2).show();	
		}
		else{
			$(this).parents(".room_slection").find(".hotel_age").hide();
			$(this).parents(".room_slection").find(".chilage_"+ 1).hide();
			$(this).parents(".room_slection").find(".chilage_"+ 2).hide();
		}
	});