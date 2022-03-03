/***********animation***************/
wow = new WOW({
	boxClass: 'wow', // default
	animateClass: 'animated', // default
	offset: 0, // default
	mobile: true, // default
	live: true // default
})
wow.init();

/****************data aos*******************/

jQuery("#mainSidebarToggle").click(function() {
	jQuery(".sidemenu").toggleClass("sideshow");
});

function showHint(str) {
	var ele = document.getElementsByName('foreign');
	for (i = 0; i < ele.length; i++) {
		if (ele[i].checked) {
			var foreign = ele[i].value;
		}
	}

	var year = document.getElementById("year").value;
	var buy = document.getElementsByName('buyer');
	for (i = 0; i < buy.length; i++) {
		if (buy[i].checked) {
			var buy1 = buy[i].value;
		}
	}

	var typ = document.getElementsByName('type');
	for (i = 0; i < typ.length; i++) {
		if (typ[i].checked) {
			var typ1 = typ[i].value;
		}
	}

	var purc = document.getElementsByName('purchase');
	for (i = 0; i < purc.length; i++) {
		if (purc[i].checked) {
			var purc1 = purc[i].value;
		}
	}

	// var surcharge = document.getElementById("surcharge").value;
	var purposes = document.getElementById("purposes").value;
	if (purposes.length == 0) {
		document.getElementById("perror").style.display = "block";
		return false;
	}

	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			document.getElementById("txtHint").innerHTML = this.responseText;
		}
	};
	xmlhttp.open("GET", "http://virginradio.local/wp-content/plugins/wp-calculator-plugin/src/assets/cal.php?year=" + year + "&surcharge=" + foreign + "&purposes=" + purposes + "&buy1=" + buy1 + "&typ=" + typ1 + "&purc=" + purc1, true);
	xmlhttp.send();
}

function lets_calculate_stamp_duty() {
	jQuery(".overlay").removeClass('d-none');

	var ele = document.getElementsByName('foreign');
	for (i = 0; i < ele.length; i++) {
		if (ele[i].checked) {
			var foreign = ele[i].value;
		}
	}

	var year = document.getElementById("year").value;
	var buy = document.getElementsByName('buyer');
	for (i = 0; i < buy.length; i++) {
		if (buy[i].checked) {
			var buy1 = buy[i].value;
		}
	}

	var typ = document.getElementsByName('type');
	for (i = 0; i < typ.length; i++) {
		if (typ[i].checked) {
			var typ1 = typ[i].value;
		}
	}

	var purc = document.getElementsByName('purchase');
	for (i = 0; i < purc.length; i++) {
		if (purc[i].checked) {
			var purc1 = purc[i].value;
		}
	}

	// var surcharge = document.getElementById("surcharge").value;
	var purposes = document.getElementById("purposes").value;
	if (purposes.length == 0) {
		document.getElementById("perror").style.display = "block";
		return false;
	}

	jQuery.ajax({
		type: "post",
		dataType: "json",
		url: WPCalc.ajaxurl,
		data: {
			action: "stamp_duty_ajax_function",
			foreign: foreign,
			year: year,
			buy1: buy1,
			typ1: typ1,
			purc1: purc1,
			purposes: purposes
		},
		success: function(response, status) {
			if(status === 'success' && response.success === true) {
				jQuery("#stamp_duty_state").text(response.data.stamp_duty_state);
				jQuery("#stamp_cpurpose").text('$ '+response.data.cpurpose);
				jQuery("#stamp_csurcharge").text('$ '+response.data.csurcharge);
				jQuery("#stamp_fog").text('$ '+response.data.fog);
				jQuery("#stamp_total").text('$ '+response.data.total);

				jQuery("#stamp_cpurpose").addClass('animated fadeIn');
				jQuery("#stamp_csurcharge").addClass('animated fadeIn');
				jQuery("#stamp_fog").addClass('animated fadeIn');
				jQuery("#stamp_total").addClass('animated fadeIn');
				
				jQuery(".overlay").addClass('d-none');
			}
		},
		error: function(response, status, xhr){
			console.log(response);
			console.log(status);
			console.log(xhr);

			jQuery(".overlay").addClass('d-none');
		}
	})
}

function showValue1(newValue) {
	document.getElementById("monday").innerHTML = newValue;
}

function changeRangeValue(val) {
	document.getElementById("range").value = isNaN(parseInt(val, 10)) ? 0 : parseInt(val, 10);
	showValue1(val);
}

function changeInputValue(val) {
	document.getElementById("purposes").value = isNaN(parseInt(val, 10)) ? 0 : parseInt(val, 10);
	showValue1(val);
}

jQuery(document).ready(function() {
	jQuery(".form-radio1").click(function() {
		jQuery(".rd-block1").removeClass("active");
		jQuery(this).parent().toggleClass("active");
	});

	jQuery(".form-radio2").click(function() {
		jQuery(".rd-block2").removeClass("active");
		jQuery(this).parent().toggleClass("active");
	});

	jQuery(".form-radio3").click(function() {
		jQuery(".rd-block3").removeClass("active");
		jQuery(this).parent().toggleClass("active");
	});

	jQuery(".form-radio4").click(function() {
		jQuery(".rd-block4").removeClass("active");
		jQuery(this).parent().toggleClass("active");
	});
});

/*********** Land tax calculator ***************/

function land_radio() {
	jQuery('#surcharge').val(0);
	var ele = document.getElementsByName('foreign');
	for (i = 0; i < ele.length; i++) {
		if (ele[i].checked) {
			var foreign = ele[i].value;
			if (foreign == 'yes') {
				document.getElementById("mscharge").style.display = "block";
			} else {
				document.getElementById("mscharge").style.display = "none";
			}

		}
	}
}

function land_showValue1(newValue) {
	document.getElementById("monday").innerHTML = newValue;
}

function land_changeRangeValue(val) {
	document.getElementById("range").value = isNaN(parseInt(val, 10)) ? 0 : parseInt(val, 10);
	land_showValue1(val);
}

function land_changeInputValue(val) {
	document.getElementById("surcharge").value = isNaN(parseInt(val, 10)) ? 0 : parseInt(val, 10);
	land_showValue1(val);
}

function land_showValue1(newValue) {
	document.getElementById("monday1").innerHTML = newValue;
}

function land_changeRangeValue(val) {
	document.getElementById("range1").value = isNaN(parseInt(val, 10)) ? 0 : parseInt(val, 10);
	land_showValue1(val);
}

function land_changeInputValue1(val) {
	document.getElementById("purposes").value = isNaN(parseInt(val, 10)) ? 0 : parseInt(val, 10);
	land_showValue1(val);
}

function land_showValue1(newValue) {
	document.getElementById("monday2").innerHTML = newValue;
}

function land_changeRangeValue(val) {
	document.getElementById("range2").value = isNaN(parseInt(val, 10)) ? 0 : parseInt(val, 10);
	land_showValue1(val);
}

function land_changeInputValue2(val) {
	document.getElementById("land_value").value = isNaN(parseInt(val, 10)) ? 0 : parseInt(val, 10);
	land_showValue1(val);
}

jQuery(document).ready( function() {
	jQuery(".text-land").click( function(e) {
		e.preventDefault();
		lets_calculate_land_tax();
	});
});

function lets_calculate_land_tax() {
	jQuery(".overlay").removeClass('d-none');

	var surcharge = document.getElementById("surcharge").value;
	var purposes = document.getElementById("purposes").value;
	var taxYear = document.getElementById("taxYear").value;
	var year = document.getElementById("year").value;
	var land_value = document.getElementById("land_value").value;
	if (purposes.length == 0) {
		document.getElementById("perror").style.display = "block";
		return false;
	}

	jQuery.ajax({
		type: "post",
		dataType: "json",
		url: WPCalc.ajaxurl,
		data: {
			action: "land_tax_ajax_function",
			surcharge: surcharge,
			purposes: purposes,
			taxYear: taxYear,
			year: year,
			land_value: land_value
		},
		success: function(response, status) {
			if(status === 'success' && response.success === true) {
				jQuery("#land_tax_state").text(response.data.land_tax_state);
				jQuery("#land_cpurpose").text('$ '+response.data.cpurpose);
				jQuery("#land_csurcharge").text('$ '+response.data.csurcharge);
				jQuery("#land_total").text('$ '+response.data.total);

				jQuery("#land_cpurpose").addClass('animated fadeIn');
				jQuery("#land_csurcharge").addClass('animated fadeIn');
				jQuery("#land_total").addClass('animated fadeIn');
				
				jQuery(".overlay").addClass('d-none');
			}
		},
		error: function(response, status, xhr){
			console.log(response);
			console.log(status);
			console.log(xhr);

			jQuery(".overlay").addClass('d-none');
		}
	})
}