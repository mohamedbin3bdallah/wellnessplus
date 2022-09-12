(function($){
$('#availability_warning').hide();

var form = $("#contact");
form.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
        confirm: {
            equalTo: "#password"
        },
		mobile: {
			required: true,
			digits: true,
			minlength: 9,
			maxlength: 15
		},
		HourRate: {
			required: true,
			number: true,
			min: 1,
			max: 9000000000000000000
		},
		headline: {
			required: true,
			maxlength: 191,
		},
		detail: {
			required: true,
			minlength: 250,
			maxlength: 1000,
		}
    }
});
form.children("div").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",



    onStepChanging: function (event, currentIndex, newIndex)
    {
        /*if(currentIndex == 4 && newIndex == 5 ){
            // console.log($('input[name="Sunday[]"]:checked').length);
            if ( ($('input[name="Sunday[]"]:checked').length == 0) &&  ($('input[name="Monday[]"]:checked').length == 0) &&  ($('input[name="Tuesday[]"]:checked').length == 0) &&  ($('input[name="Wednesday[]"]:checked').length == 0) &&  ($('input[name="Thursday[]"]:checked').length == 0) &&  ($('input[name="Friday[]"]:checked').length == 0) &&  ($('input[name="Saturday[]"]:checked').length == 0)) {
                $('#availability_warning').show();
                return false;
            } else {
                $('#availability_warning').hide();
                return true;
            }
            
        }*/
        Filevalidation = () => {
            const fi = document.getElementById('photo');
            // Check if any file is selected.
            if (fi.files.length > 0) {
                for (const i = 0; i <= fi.files.length - 1; i++) {

                    const fsize = fi.files.item(i).size;
                    const file = Math.round((fsize / 1024));
                    // The size of the file.
                    if (file >= 2048) {
                        alert(
                            "File too Big, please select a file less than 2mb");
                        $("#photo").click();

                    } else {
                        document.getElementById('photo').innerHTML = '<b>'
                            + file + '</b> KB';
                    }
                }
            }



        } 
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#tab_index").val(currentIndex);
		var form = $("#contact").closest("form");
        var formData = new FormData(form[0]);
        event.stopImmediatePropagation();
        event.preventDefault();

            $.ajax({
                url: "/api/registrationSteps",
                type: "POST",
                data: formData,
                dataType: "json",
                processData: false,
                contentType: false,
                success: function (data) {

                }
            });
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function (event, currentIndex)
    {
        //alert(333341);

        // form.validate().settings.ignore = ":disabled";
        // return form.valid();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var form = $("#contact").closest("form");
        var formData = new FormData(form[0]);
        event.stopImmediatePropagation();
        // event.preventDefault();

        $.ajax({
            url: "/api/saveTutorFile",
            type: "POST",
            data: formData,
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (data) {

            }
        });
        window.location.href = "/tutor/profile";

    },
    onFinished: function (event, currentIndex)
    {
        // event.preventDefault();
        // alert(333341);
        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        //
        // var form = $("#contact").closest("form");
        // var formData = new FormData(form[0]);
        // event.stopImmediatePropagation();
        // // event.preventDefault();
        //
        // $.ajax({
        //     url: "/api/saveTutorFile",
        //     type: "POST",
        //     data: formData,
        //     dataType: "json",
        //     processData: false,
        //     contentType: false,
        //     success: function (data) {
        //
        //     }
        // });
        // window.location.href = "/tutor/profile";

        // alert("Submitted!");
    }
});
})(jQuery);