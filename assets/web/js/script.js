$( document ).ajaxStart(function() {
	$(".theme-layout").css({ opacity: 0.5 });
	$( "#loader" ).show();
});
$( document ).ajaxComplete(function() {
	$(".theme-layout").css({ opacity: 1 });
	$( "#loader" ).hide();
});
$("#frmlogin").submit(function(e) {
	funlogin($(this));
    e.preventDefault();
});
$("#frmlogin2").submit(function(e) {
	funlogin($(this));
    e.preventDefault();
});
$("#frmsignin").submit(function(e) {
	funlogin($(this));
    e.preventDefault();
});

function funlogin(f) {	
	var data = f.serializeArray();
	data.push({name: "a", value: 'login'});
	
    $.ajax({
		type: "POST",
		url: "script.php",
		data: $.param(data),
		success: function(data) {
			var objres = JSON.parse(data);
			if (objres.status=="failed") {
				$("[name='namdivlogin']").css({ display: "none" });
				$("[name='namdivloginerror']").fadeIn("slow");
				$("[name='namspanloginerror']").html(objres.message);
				$("#divstatuslogin").html(objres.message);
			} else if (objres.status=="success") {
				var n = window.location.href.search("aktivasiakun.php");
				if (n == -1) {
					var arr = window.location.href.split('#');
					window.location.href = arr[0];
				}
				else { window.location.href="index.php"; }
			}
	   }
	 });
}

function funloginulangi() {
	$("[name='namdivloginerror']").css({ display: "none" });
	$("[name='namdivlogin']").fadeIn("slow");
	document.getElementById('frmlogin').reset();
	document.getElementById('frmlogin2').reset();
}

$("#frmlupakatasandi").submit(function(e) {
    var form = $(this);
	var data = form.serializeArray();
	data.push({name: "a", value: 'lupakatasandi'});

    $.ajax({
		type: "POST",
		url: "script.php",
		data: $.param(data),
		success: function(data) {
			var objres = JSON.parse(data);
			$("#divstatuslupakatasandi").html(objres.message);
			if (objres.status=="success") {
				var inputs=document.getElementById('frmlupakatasandi').getElementsByTagName('input');
				for( i in inputs) {
					inputs[i].disabled=true;
				}
				$("#frmlupakatasandi").css({ opacity: 0.5 });
				$("#frmlupakatasandiganti").fadeIn("slow");
				document.getElementById('frmlupakatasandiganti').scrollIntoView();
			}
	   }
	});

    e.preventDefault();
});

$("#frmlupakatasandiganti").submit(function(e) {
    var form = $(this);
	var data = form.serializeArray();
	data.push({name: "a", value: 'lupakatasandiganti'});
	data.push({name: "namtextlupapesertaalamatemail", value: document.getElementById('namtextlupapesertaalamatemail').value});

    $.ajax({
		type: "POST",
		url: "script.php",
		data: $.param(data),
		success: function(data) {
			var objres = JSON.parse(data);
			$("#divstatuslupakatasandiganti").html(objres.message);
			if (objres.status=="success") { $("#frmlupakatasandiganti").hide(); }
	   }
	});

    e.preventDefault();
});

$("#frmdaftar").submit(function(e) {
    var form = $(this);
    var url = form.attr('action');
	var data = form.serializeArray();
	data.push({name: "a", value: 'reg'});

    $.ajax({
		type: "POST",
		url: "script.php",
		data: $.param(data),
		success: function(data) {
			var objres = JSON.parse(data);
			$("#divstatusreg").html(objres.message);
		}
	});

    e.preventDefault();
});

$("#frmdaftarsubbdg").submit(function(e) {
	var confirmsubmit=confirm("Apakah Anda yakin ingin melanjutkan ke langkah berikutnya? Anda tidak bisa kembali lagi.");
	if (confirmsubmit) {
		var form = $(this);
		var data = form.serializeArray();
		data.push({name: "a", value: 'regsubbdg'});
		data.push({name: "l", value: l});
		data.push({name: "pelatjenis", value: pelatjenis});

		$.ajax({
			type: "POST",
			url: "script.php",
			data: $.param(data),
			success: function(data) {
				var objres = JSON.parse(data);
				if (objres.status=="failed") { $("#divstatussubbdg").html(objres.message); }
				else if (objres.status=="success") {
					var arr = window.location.href.split('#');
					window.location.href = arr[0];
				}
			}
		});
	}
    e.preventDefault();
});

$("#nambutdaftarsyaratselesai").click(function() {
	var confirmsubmit=confirm("Apakah Anda yakin ingin melanjutkan ke langkah berikutnya? Anda tidak bisa kembali lagi.");
	if (confirmsubmit) {
		var data = [];
		data.push({name: "a", value: 'regsyaratselesai'});
		data.push({name: "l", value: l});
		
		$.ajax({
			type: "POST",
			url: "script.php",
			data: $.param(data),
			success: function(data) {
				var objres = JSON.parse(data);
				if (objres.status=="failed") { $("#divstatussyarat").html(objres.message); }
				else if (objres.status=="success") {
					var arr = window.location.href.split('#');
					window.location.href = arr[0];
				}
		   }
		 });
	}
});

$("#frmubahpassword").submit(function(e) {
    var form = $(this);
	var data = form.serializeArray();
	data.push({name: "a", value: 'ubahpassword'});

    $.ajax({
		type: "POST",
		url: "script.php",
		data: $.param(data),
		success: function(data) {
			var objres = JSON.parse(data);
			funshowdivstatus('divstatuspassword',objres);
	   }
	});

    e.preventDefault();
});

$("#frmubahprofil").submit(function(e) {
    var form = $(this);
	var data = form.serializeArray();
	data.push({name: "a", value: 'ubahprofil'});

    $.ajax({
		type: "POST",
		url: "script.php",
		data: $.param(data),
		success: function(data) {
			var objres = JSON.parse(data);
			funshowdivstatus('divstatusprofil',objres);
	   }
	});

    e.preventDefault();
});

$("#frmubahcatpend").submit(function(e) {
    var form = $(this);
	var data = [];
	data.push({name: "a", value: 'ubahcatpend'});
	data.push({name: "catpend", value: JSON.stringify(clacatpend.arrcatpend)});

    $.ajax({
		type: "POST",
		url: "script.php",
		data: $.param(data),
		success: function(data) {
			var objres = JSON.parse(data);
			funshowdivstatus('divstatuscatpend',objres);
	   }
	});

    e.preventDefault();
});

$("#frmubahcatkerja").submit(function(e) {
    var form = $(this);
	var data = [];
	data.push({name: "a", value: 'ubahcatkerja'});
	data.push({name: "catkerja", value: JSON.stringify(clacatkerja.arrcatkerja)});

    $.ajax({
		type: "POST",
		url: "script.php",
		data: $.param(data),
		success: function(data) {
			var objres = JSON.parse(data);
			funshowdivstatus('divstatuscatkerja',objres);
	   }
	});

    e.preventDefault();
});

function funshowdivstatus(namdiv,obj) {
	$("#"+namdiv).removeClass();
	if (obj.status=="failed") { $("#"+namdiv).addClass("alert alert-danger"); }
	else if (obj.status=="success") { $("#"+namdiv).addClass("alert alert-success"); }
	$("#"+namdiv).html(obj.message);
}

$(function() {
	$('a[href*="#"]:not([href="#"])').click(function() {
		if (this.hash == '#frmdaftar') {
			document.getElementById('frmsignin').style.display = "none";
			$("#frmdaftar").fadeIn("slow");
		} else if (this.hash == '#frmsignin') {
			document.getElementById('frmdaftar').style.display = "none";
			$("#frmsignin").fadeIn("slow");
		}
		
		if (this.hash == '#frmubahpassword' || this.hash == '#frmubahfoto' || this.hash == '#frmubahprofil' || this.hash == '#frmubahcatpend' || this.hash == '#frmubahcatkerja' || this.hash == '#frmubahcatlatih') {
			$("#frmubahpassword, #frmubahfoto, #frmubahprofil, #frmubahcatpend, #frmubahcatkerja, #frmubahcatlatih").hide();
			$("[name='namaprofilku']").removeClass("selected");
			$(this).addClass("selected");
			$(this.hash).fadeIn("slow");
		}
	});
});

$(window).on("load", function() {
    "use strict";

    /*=================== Dropdown Class ===================*/
    $("nav li ul").parent().addClass("has-children");

    /*=================== Responsive Menu ===================*/
    $(".menu-button").on("click",function(){
        $(".responsive-menu").addClass("slidein");
        return false;
    });  
    $(".close-menu").on("click",function(){
        $(".responsive-menu").removeClass("slidein");
        return false;
    });
	// $(".responsive-menu ul li a").on("click", function () {
		// var parent = this.parentElement;
		// if (!$(parent).hasClass("menu-item-has-children")) {
			// $(".responsive-menu").removeClass("slidein");
			// return false;
		// }
	// });


    /*================== Responsive Menu Dropdown =====================*/
    $(".responsive-menu ul ul").parent().addClass("menu-item-has-children");
    $(".responsive-menu ul li.menu-item-has-children > a").on("click", function() {
        $(this).parent().toggleClass("active").siblings().removeClass("active");
        $(this).next("ul").slideToggle();
        $(this).parent().siblings().find("ul").slideUp();
        return false;
    });


    /*================== Search =====================*/
    $(".search-btn").on("click", function() {
        $(this).parent().toggleClass("active");
        return false;
    });


    /*=================== Accordion ===================*/
    $(".toggle").each(function(){
        $(this).find('.content').hide();
        $(this).find('h2:first').addClass('active').next().slideDown(500).parent().addClass("activate");
        $('h2', this).click(function() {
            if ($(this).next().is(':hidden')) {
                $(this).parent().parent().find("h2").removeClass('active').next().slideUp(500).parent().removeClass("activate");
                $(this).toggleClass('active').next().slideDown(500).parent().toggleClass("activate");
            }
        });
    });


    /* ============ Logos Carousel ================*/
    // $('.logos-carousel').owlCarousel({
        // autoplay:true,
        // smartSpeed:1000,
        // loop:true,
        // dots:false,
        // nav:true,
        // margin:0,
        // mouseDrag:true,
        // items:5,
        // autoplayHoverPause:true,                
        // autoHeight:false,
        // responsive:{
            // 1200:{items:5},
            // 980:{items:4},
            // 767:{items:3},
            // 480:{items:2},
            // 0:{items:1}
        // }
    // });

    /* ============ Tabs Carousel ================*/
    // $('.tab-carousel').owlCarousel({
        // autoplay:false,
        // smartSpeed:1000,
        // loop:false,
        // dots:false,
        // nav:false,
        // margin:0,
        // mouseDrag:true,
        // items:1,
        // singleItem:true,
        // URLhashListener:true,        
        // autoplayHoverPause:true,                
        // autoHeight:false,
        // animateIn:"fadeIn",
        // animateOut:"fadeOut"
    // }); 


    $(".tabs-selectors a").on("click",function(){
        $(this).addClass("active").siblings().removeClass("active");
    });

});