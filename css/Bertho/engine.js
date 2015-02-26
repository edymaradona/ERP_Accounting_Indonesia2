$(document).ready(function() {
	DataProvide2();
    ManipulationHere();
	
	$('table').delegate('input[type=text].onlyDate', 'focusin', function(event) {
		$(this).datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
     		changeYear: true,
			yearRange: '1972:2020',
		});
    });
	
	$('table').delegate('input[type=text].onlyMonth', 'focusin', function(event) {
		$(this).monthpicker();
    });

}); //Tutup Document Ready


function ManipulationHere(){
	
var count = 1;
$(".button").click(function(){
	count += 1;
	var $row = $('<tr>' 
	+ '<td>' + '</td>'
		+ '<td>' + '<input id="data2_' + count + '" type="text" name="data2_' + count + '" class="data2" />' + '</td>'
		+ '<td>' + '<input id="rows_' + count + '" name="rows[]" value="'+ count +'" type="hidden">'
		+ '<a href="javascript:void(0);" class="remCF">Remove</a>' + '</td>'
	+ '</tr>').appendTo("#customFields");
	var copyData = $("#data1_1").clone();
	var repID = copyData.attr('id', 'data1_' + count + '');
	var repName = copyData.attr('name', 'data1_' + count + '');
	
	$row.find('td:first').append(repID)
	var check = $row.find('td:first').html();
	var get = $(check).attr('id')
});

    $("#customFields").on('click','.remCF',function(){
        $(this).parent().parent().remove();
		count -= 1;
    });

    $("#customFields").on('change', '.tabelBaru', function() {
		
		var validator = $("#signupForm").validate();
		validator.resetForm();

		var $this = $(this),
		nilai = $this.val();
		console.log(nilai);
		
		if(nilai=='gender'){
			$this.closest("tr").find(".data2").replaceWith(
				'<select name="data2_' + count + '" class="data2">'
					+ '<option value="man" selected >Man</option>'
					+ '<option value="woman">Woman</option>'
				+ '</select>'
			)
		}
		else if(nilai=='religion'){
			$this.closest("tr").find(".data2").replaceWith(
				'<select name="data2[]" class="data2">'
					+ '<option value="protestan" selected >Protestan</option>'
					+ '<option value="khatolik">Khatolik</option>'
					+ '<option value="islam">Islam</option>'
					+ '<option value="budha">Budha</option>'
					+ '<option value="hindu">Hindu</option>'
				+ '</select>'
			)
		}
		else if(nilai=='blood'){
			$this.closest("tr").find(".data2").replaceWith(
				'<select name="data2_' + count + '" class="data2">'
					+ '<option value="gol_a" selected >A</option>'
					+ '<option value="gol_b">B</option>'
					+ '<option value="gol_ab">AB</option>'
					+ '<option value="gol_o">O</option>'
				+ '</select>'
			)
		}
		else if(nilai=='birth_date'){
			$this.closest("tr").find(".data2").replaceWith(
				'<input type="text" id="data2_' + count + '" name="data2_' + count + '" value="" placeholder="Date Format" class="onlyDate"/>'
			)
		}
		else if(nilai=='start_date'){
			$this.closest("tr").find(".data2").replaceWith(
				'<input type="text" id="data2_' + count + '" name="data2_' + count + '" value="" placeholder="Date Format" class="onlyDate"/>'
			)
		}
		else if(nilai=='end_date'){
			$this.closest("tr").find(".data2").replaceWith(
				'<input type="text" id="data2_' + count + '" name="data2_' + count + '" value="" placeholder="Date Format" class="onlyDate"/>'
			)
		}
		else if(nilai=='join_date'){
			$this.closest("tr").find(".data2").replaceWith(
				'<input type="text" id="data2_' + count + '" name="data2_' + count + '" value="" placeholder="Date Format" class="onlyDate"/>'
			)
		}
		else if(nilai=='los_month'){
			$this.closest("tr").find(".data2").replaceWith(
				'<input type="text" id="data2_' + count + '" name="data2_' + count + '" value="" placeholder="Month Format" class="onlyMonth"/>'
			)
		}
		else{
			$this.closest("tr").find(".onlyDate").replaceWith(
				'<input type="text" id="data2_' + count + '" name="data2_' + count + '" value="" class="data2"/>'
			)
		}
		
    });
}

function DataProvide2(){
	$.ajax({ 
		type: 'GET', 
		url: '<?php echo Yii::app()->createAbsoluteUrl("testing/ambiltrigger"); ?>', 
		dataType: 'json',
		cache: false,
		success: function (result) {
			$.each(result, function() {
				$('#data1_1')
				 .append($("<option></option>")
				 .attr("value",result.key)
				 .text(result.value)); 
			});
		},
		error: function(jqXHR, exception){
			alert('Koneksi Error');
		}
	});
}

function DataProvide(){
	selectValues = { 
		"pilih"			: "-Pilih-",
		"id"			: "ID",
		"emp_name"		: "Employee Name",
		"photo_path"	: "Photo Path",
		"emp_id"		: "Employee ID",
		"birth_place"	: "Birth Place",
		"birth_date"	: "Birth Date",
		"age"			: "Age",
		"gender"		: "Gender",
		"religion"		: "Religion",
		"address"		: "Address",
		"identity_add"	: "Identity Address",
		"blood"			: "Blood",
		"acc_num"		: "Account Number",
		"acc_name"		: "Account Name",
		"bank_name"		: "Bank Name",
		"email"			: "Email",
		"Email2"		: "Email 2",
		"home_phone"	: "Telp",
		"hp"			: "Handphone",
		"hp2"			: "Handphone 2",
		"comp_name"		: "Company Name",
		"comp_id"		: "Company ID",
		"dept_name"		: "Departement Name",
		"level"			: "Level",
		"job_title"		: "Job Title",
		"career"		: "Carrer Status",
		"status"		: "Status",
		"start_date"	: "Status Start Date",
		"end_date"		: "Status End Date",
		"join_date"		: "Join Date",
		"los_year"		: "LoS Year",
		"los_month"		: "LoS Month",
		"education"		: "Education",
		"experience"	: "Experience"
	};
	
	$.each(selectValues, function(key, value) {   
		 $('#data1_1')
			 .append($("<option></option>")
			 .attr("value",key)
			 .text(value)); 
	});	
}