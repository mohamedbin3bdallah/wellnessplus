(function ($)
{
    $(document).ready(function ()
    {
        $(window).scroll(function ()
        {
            if ($(this).scrollTop() > 1) {
                $(".header").addClass("sticky");
            } else {
                if ($(this).scrollTop() < 1) {
                    $(".header").removeClass("sticky");
                }
            }
        });
        $(".chat-btn").click(function ()
        {
            $(".show-itemchat").toggleClass("open");
        });
        $(".icon-search").click(function ()
        {
            var w = $(window).width();
            if (w < 1199) {
                $(".formsearch").fadeIn("");
                $(".icon-search").fadeOut("");
                $(".user-det").fadeOut("");
                $(".cancel").fadeIn("");
                $(".icon-cancel").fadeOut("");
                $(".icon-opne").fadeIn("");
            }
        });
        $(".cancel").click(function ()
        {
            var w = $(window).width();
            if (w < 1199) {
                $(".formsearch").fadeOut("");
                $(".icon-search").fadeIn("");
                $(".cancel").fadeOut("");
            }
        });

        $(".icon-opne").click(function ()
        {
            var w = $(window).width();
            if (w < 991) {
                $(".user-det").fadeIn("");
                $(".icon-opne").fadeOut("");
                $(".formsearch").fadeOut("");
                $(".cancel").fadeOut("");
                $(".icon-cancel").fadeIn("");
                $(".icon-search").fadeIn("");
            }
        });

        $(".icon-cancel").click(function ()
        {
            var w = $(window).width();
            if (w < 991) {
                $(".user-det").fadeOut("");
                $(".icon-opne").fadeIn("");
                $(".icon-cancel").fadeOut("");
            }
        });
        $(".bot-show").click(function ()
        {
            $(".bot-show").remove("");
            $(".num-book").addClass("active");
        });
        $(".icons-signup").click(function ()
        {
            var w = $(window).width();
            if (w < 991) {
                $(".signup-btns").toggleClass("open");
                $(".formsearch").fadeOut("");
                $(".cancel").fadeOut("");
                $(".icon-search").fadeIn("");
            }
        });
        $(".viw-rev").click(function ()
        {
            $(".viw-rev").fadeOut("");
            $(".rev-hide").fadeIn("");
            $(".hidemore").slideDown("");
        });
        $(".rev-hide").click(function ()
        {
            $(".rev-hide").fadeOut("");
            $(".viw-rev").fadeIn("");
            $(".hidemore").slideUp("");
        });

        $(function ()
        {
            "use strict";
            $(".fild .form-control").on("focusout", function ()
            {
                if ($(this).val() != "") {
                    $(this).parent().addClass("has-date");
                } else {
                    $(this).parent().removeClass("has-date");
                }
            });
        });
        $(".mobile-number").change(function ()
        {
            var number = $("#mobile").val();
            $.ajax({
                url: "/api/checkMobileNumber",
                type: "POST",
                data: { number: number },
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (data)
                {
                    // console.log(data)

                    if (data != 0) {
                        // alert("Mobile Already Exist")
                    }
                },
            });
        });

        $(window).scroll(function ()
        {
            if ($(this).scrollTop() > 600) {
                $(".scrollToTop").fadeIn();
            } else {
                $(".scrollToTop").fadeOut();
            }
        });
        //Click event to scroll to top
        $(".scrollToTop").click(function ()
        {
            $("html, body").animate(
                {
                    scrollTop: 0,
                },
                800
            );
            return false;
        });

        $(".fas.fa-eye.icon-pass").click(function ()
        {
            $("input.pass").attr("type", "text");
            $(this).hide();
            $(".fas.fa-eye-slash.icon-pass").show();
        });

        $(".fas.fa-eye-slash.icon-pass").click(function ()
        {
            $("input.pass").attr("type", "password");
            $(this).hide();
            $(".fas.fa-eye.icon-pass ").show();
        });
        if (typeof lang_index_start !== 'undefined') var l = lang_index_start;
        else var l = 1;
        var x = 1;
        $(".add").click(function ()
        {
            // console.log(i++);
            $(".col-sm-12.add-fild:last").before(
                '<div class="col-11 col-md-12 add-fild"> <div class="row"> <div class="col-sm-12 fild"><i class="fas fa-chevron-down iconsel"></i> <select class="form-control allLang' + (parseInt(l) + 1) + ' required" name="Languages[' +
                l++ +
                '][language]" autocomplete="off" autofocus="" required="" aria-required="true"> <option> </option>  </select> <label class="floating-label">Language</label> </div></div><div class="bottom icon-erm remove"><span class="fas fa-times"></span></div></div> '
            );
            $.each(lang, function (index, el)
            {
                option =
                    '<option value="' + el.id + '">' + el.isoName + "</option>";
                $(".allLang" + l).append(option);
            });
            // i++;
            // x++;
            // console.log(option)
        });
        $(".optionBox").on("click", ".remove", function ()
        {
            $(this).parent().remove();
        });

        $(".add1").click(function ()
        {
            $(".add-fild1:last").before(
                ' <div class="add-fild1"> <div class="row"> <div class="col-sm-6 fild"><i class="fas fa-chevron-down iconsel"></i> <input type="time" value="09:00" class="form-control timeTable" id="start_time" placeholder="start_time" name="timeTable[{{$day}}][start_time]"  > </div> <div class="text-to">To</div> <div class="col-sm-6 fild"><i class="fas fa-chevron-down iconsel"></i> <input type="time" value="17:00" class="form-control timeTable" id="end_time" placeholder="end_time" name="timeTable[{{$day}}][end_time]"  > </div> </div><div class="bottom icon-erm remove1"><span class="fas fa-times"></span></div> </div>'
            );
        });
        $(".optionBox1").on("click", ".remove1", function ()
        {
            $(this).parent().remove();
        });

        $(".add2").click(function ()
        {
            $(".add-fild2:last").before(
                ' <div class="add-fild1"> <div class="row"> <div class="col-sm-6 fild"><i class="fas fa-chevron-down iconsel"></i> <input type="time" value="09:00" class="form-control timeTable" id="start_time" placeholder="start_time" name="timeTable[{{$day}}][start_time]"  > </div> <div class="text-to">To</div> <div class="col-sm-6 fild"><i class="fas fa-chevron-down iconsel"></i> <input type="time" value="17:00" class="form-control timeTable" id="end_time" placeholder="end_time" name="timeTable[{{$day}}][end_time]"  > </div> </div><div class="bottom icon-erm remove1"><span class="fas fa-times"></span></div> </div>'
            );
        });
        $(".optionBox2").on("click", ".remove2", function ()
        {
            $(this).parent().remove();
        });

        $(".add3").click(function ()
        {
            $(".add-fild3:last").before(
                ' <div class="add-fild1"> <div class="row"> <div class="col-sm-6 fild"><i class="fas fa-chevron-down iconsel"></i> <input type="time" value="09:00" class="form-control timeTable" id="start_time" placeholder="start_time" name="timeTable[{{$day}}][start_time]"  > </div> <div class="text-to">To</div> <div class="col-sm-6 fild"><i class="fas fa-chevron-down iconsel"></i> <input type="time" value="17:00" class="form-control timeTable" id="end_time" placeholder="end_time" name="timeTable[{{$day}}][end_time]"  > </div> </div><div class="bottom icon-erm remove1"><span class="fas fa-times"></span></div> </div>'
            );
        });
        $(".optionBox3").on("click", ".remove3", function ()
        {
            $(this).parent().remove();
        });

        $(".add4").click(function ()
        {
            $(".add-fild4:last").before(
                ' <div class="add-fild1"> <div class="row"> <div class="col-sm-6 fild"><i class="fas fa-chevron-down iconsel"></i> <input type="time" value="09:00" class="form-control timeTable" id="start_time" placeholder="start_time" name="timeTable[{{$day}}][start_time]"  > </div> <div class="text-to">To</div> <div class="col-sm-6 fild"><i class="fas fa-chevron-down iconsel"></i> <input type="time" value="17:00" class="form-control timeTable" id="end_time" placeholder="end_time" name="timeTable[{{$day}}][end_time]"  > </div> </div><div class="bottom icon-erm remove1"><span class="fas fa-times"></span></div> </div>'
            );
        });
        $(".optionBox4").on("click", ".remove4", function ()
        {
            $(this).parent().remove();
        });

        $(".add5").click(function ()
        {
            $(".add-fild5:last").before(
                ' <div class="add-fild1"> <div class="row"> <div class="col-sm-6 fild"><i class="fas fa-chevron-down iconsel"></i> <input type="time" value="09:00" class="form-control timeTable" id="start_time" placeholder="start_time" name="timeTable[{{$day}}][start_time]"  > </div> <div class="text-to">To</div> <div class="col-sm-6 fild"><i class="fas fa-chevron-down iconsel"></i> <input type="time" value="17:00" class="form-control timeTable" id="end_time" placeholder="end_time" name="timeTable[{{$day}}][end_time]"  > </div> </div><div class="bottom icon-erm remove1"><span class="fas fa-times"></span></div> </div>'
            );
        });
        $(".optionBox5").on("click", ".remove5", function ()
        {
            $(this).parent().remove();
        });

        $(".add6").click(function ()
        {
            $(".add-fild6:last").before(
                ' <div class="add-fild1"> <div class="row"> <div class="col-sm-6 fild"><i class="fas fa-chevron-down iconsel"></i> <input type="time" value="09:00" class="form-control timeTable" id="start_time" placeholder="start_time" name="timeTable[{{$day}}][start_time]"  > </div> <div class="text-to">To</div> <div class="col-sm-6 fild"><i class="fas fa-chevron-down iconsel"></i> <input type="time" value="17:00" class="form-control timeTable" id="end_time" placeholder="end_time" name="timeTable[{{$day}}][end_time]"  > </div> </div><div class="bottom icon-erm remove1"><span class="fas fa-times"></span></div> </div>'
            );
        });
        $(".optionBox6").on("click", ".remove6", function ()
        {
            $(this).parent().remove();
        });

        $(".add7").click(function ()
        {
            $(".add-fild7:last").before(
                ' <div class="add-fild1"> <div class="row"> <div class="col-sm-6 fild"><i class="fas fa-chevron-down iconsel"></i> <input type="time" value="09:00" class="form-control timeTable" id="start_time" placeholder="start_time" name="timeTable[{{$day}}][start_time]"  > </div> <div class="text-to">To</div> <div class="col-sm-6 fild"><i class="fas fa-chevron-down iconsel"></i> <input type="time" value="17:00" class="form-control timeTable" id="end_time" placeholder="end_time" name="timeTable[{{$day}}][end_time]"  > </div> </div><div class="bottom icon-erm remove1"><span class="fas fa-times"></span></div> </div>'
            );
        });
        $(".optionBox7").on("click", ".remove7", function ()
        {
            $(this).parent().remove();
        });

        $(".add8").click(function ()
        {
            $(".add-fild8:last").before(
                '<div class="col-sm-12 add-fild8"> <div class="row"> <div class="col-sm-12 fild"> <input class="form-control" type="text" placeholder="Enter" name="Company" autocomplete="off" autofocus="" required=""> <label class="floating-label">Company</label> </div> <div class="col-sm-12 fild"> <input class="form-control" type="text" placeholder="Enter" name="Title" autocomplete="off" autofocus="" required=""> <label class="floating-label">Title</label> </div> <div class="col-sm-6 fild"><i class="fas fa-chevron-down iconsel"></i> <select class="form-control required" name="From" autocomplete="off" autofocus="" required=""> <option> </option> <option>choose</option> <option>choose </option> <option>choose</option> </select> <label class="floating-label">From</label> </div> <div class="col-sm-6 fild"><i class="fas fa-chevron-down iconsel"></i> <select class="form-control required" name="To" autocomplete="off" autofocus="" required=""> <option> </option> <option>choose</option> <option>choose</option> <option>choose</option> </select> <label class="floating-label">To   </label> </div> </div><div class="bottom icon-erm remove8"><span class="fas fa-times"></span></div>  </div>'
            );
        });
        $(".optionBox8").on("click", ".remove8", function ()
        {
            $(this).parent().remove();
        });

        $(".add9").click(function ()
        {
            $(".add-fild9:last").before(
                '<div class="col-sm-12 add-fild9"> <div class="row"> <div class="col-sm-12 fild"> <input class="form-control" type="text" placeholder="Enter" name="Certificate" autocomplete="off" autofocus="" required=""> <label class="floating-label">Certificate</label> </div> <div class="col-sm-12 fild"> <input class="form-control" type="text" placeholder="Enter" name="Description" autocomplete="off" autofocus="" required=""> <label class="floating-label">Description</label> </div> <div class="col-sm-12 fild"> <input class="form-control" type="text" placeholder="Enter" name="Issued By" autocomplete="off" autofocus="" required=""> <label class="floating-label">Issued By</label> </div> <div class="col-sm-6 fild"><i class="fas fa-chevron-down iconsel"></i> <select class="form-control required" name="From" autocomplete="off" autofocus="" required=""> <option> </option> <option>choose</option> <option>choose </option> <option>choose</option> </select> <label class="floating-label">From</label> </div> <div class="col-sm-6 fild"><i class="fas fa-chevron-down iconsel"></i> <select class="form-control required" name="To" autocomplete="off" autofocus="" required=""> <option> </option> <option>choose</option> <option>choose</option> <option>choose</option> </select> <label class="floating-label">To   </label> </div> </div><div class="bottom icon-erm remove9"><span class="fas fa-times"></span></div>  </div>'
            );
        });
        $(".optionBox9").on("click", ".remove9", function ()
        {
            $(this).parent().remove();
        });

        $(".custom-file-input").on("change", function ()
        {
            var fileName = $(this).val().split("\\").pop();
            $(this)
                .siblings(".custom-file-label")
                .addClass("selected")
                .html(fileName);
        });

        //End Item Uplode File

        var maxchars = 1000;

        $("textarea").keyup(function ()
        {
            var tlength = $(this).val().length;
            $(this).val($(this).val().substring(0, maxchars));
            var tlength = $(this).val().length;
            remain = maxchars - parseInt(tlength);
            $("#remain").text(remain);
        });

        $(".setting-menu a").click(function ()
        {
            $(".setting-menu a").removeClass("active");
            $(this).addClass("active");
        });

        //Start  Item language box

        $(".el-lang").click(function (event)
        {
            event.stopPropagation();
            $(".language").fadeIn("");
        });
        $(".language").on("click", function (event)
        {
            event.stopPropagation();
            $(".language").fadeIn("");
        });
        $("body").click(function ()
        {
            $(".language").fadeOut("");
        });

        //End   Item language box

        //star Item text box

        $(".cancel").hide();
        $(".onclick").click(function ()
        {
            $(this).parent().next(".divhidslid").slideToggle();
            $(this).next(".divhidslid").slideToggle(500);
            $(this).find(".more, .cancel").toggle();
        });

        //End Item text box

        var config = {
            ".chosen-select": {},
            ".chosen-select-deselect": {
                allow_single_deselect: true,
            },
            ".chosen-select-no-single": {
                disable_search_threshold: 10,
            },
            ".chosen-select-no-results": {
                no_results_text: "Oops, nothing found!",
            },
        };
        for (var selector in config) {
            $(selector).chosen(config[selector]);
        }

        /////////////////////////////// END Select 2

        //  Start Slider Price
        $(function ()
        {
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: 100,
                //values: [0, 100],
                values: [$("#amount-min").val(), $("#amount-max").val()],
                animate: true,
                step: 5,
                slide: function (event, ui)
                {
                    $("#amount-min").val("" + ui.values[0] + " USD");
                    $("#amount-max").val("" + ui.values[1] + " USD");
                },
            });

            $("#amount-min").val(
                "" + $("#slider-range").slider("values", 0) + " USD"
            );
            $("#amount-max").val(
                "" + $("#slider-range").slider("values", 1) + " USD"
            );
        });


        //     $(
        //         "#specialties, #country_id, #slider-range, #amount-max, #languages, #availability, #sort, #nativeSpeaker, #searchBox"
        //     ).on("click change", function (e) {
        //         var specialties = $("#specialties").val();
        //         var countries = $("#country_id").val();
        //         var from = $("#amount-min").val();
        //         var to = $("#amount-max").val();
        //         var languages = $("#languages").val();
        //         var sort = $("#sort").val();
        //         var availability = $("#availability").val();
        //         var searchWord = $("#searchBox").val();
        //         // console.log(availability)
        //
        //         if ($("#nativeSpeaker").is(":checked")) {
        //             var nativeSpeaker = "on";
        //         }
        //
        //         var times = document.getElementsByName("times[]");
        //         var checkedTimes = "";
        //         for (var i = 0, n = times.length; i < n; i++) {
        //             if (times[i].checked) {
        //                 checkedTimes += "," + times[i].value;
        //             }
        //         }
        //         if (checkedTimes) checkedTimes = checkedTimes.substring(1);
        //
        //         var days = document.getElementsByName("days[]");
        //
        //         var checkedDays = "";
        //         for (var i = 0, n = days.length; i < n; i++) {
        //             if (days[i].checked) {
        //                 checkedDays += "," + days[i].value;
        //             }
        //         }
        //         if (checkedDays) checkedDays = checkedDays.substring(1);
        //
        //         $("#myContent").empty();
        //         e.preventDefault();
        //         $.ajax({
        //             url: "/api/findTutorFilters",
        //             type: "POST",
        //             data: {
        //                 specialties: specialties,
        //                 countries: countries,
        //                 from: from,
        //                 to: to,
        //                 languages: languages,
        //                 checkedTimes: checkedTimes,
        //                 checkedDays: checkedDays,
        //                 sort: sort,
        //                 nativeSpeaker: nativeSpeaker,
        //                 searchWord: searchWord,
        //                 availability: availability,
        //             },
        //             dataType: "json",
        //             headers: {
        //                 "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        //             },
        //             success: function (data) {
        //                 // if (specialties === null && countries === null && languages === null && sort ==='' && searchWord ===''){
        //                 //     location.reload();
        //                 // }
        //                 $("#myContent").empty();
        //                 $.each(data, function (index, tutor) {
        //                     // const activeStudents = (tutor.booked_slots).reduce((acc, value) => {
        //                     //     if (!acc[value.user_id]) {
        //                     //         acc[value.user_id] = [];
        //                     //         acc[value.user_id].push(value);
        //                     //
        //                     //     }
        //                     //
        //                     //     return acc;
        //                     // },);
        //                     // console.log(activeStudents.length)
        //
        //                     if (tutor.user.youtube_url == null) {
        //                         iframeContent =
        //                             '<div class="iframe"> <video class="player-course-chapter-list" loop  width="350"  src="/files/instructor/"' +
        //                             tutor.video +
        //                             '" controls> </video></div>';
        //                     } else {
        //                         iframeContent =
        //                             '<div class="iframe"> <iframe src="' +
        //                             tutor.user.youtube_url +
        //                             '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>';
        //                     }
        //
        //                     $("#myContent").append(
        //                         `<div class="tu-hover">
        //                     <div class="row">
        //                         <div class="col-sm-8 contenuser hoverbox">
        //                             <div class="itemtutor">
        //                                 <div class="tu-photo">
        //                                     <div class="img"><a  class="fas fa-heart makeFav" href="#" id="` +
        //                             tutor.id +
        //                             `"></a><img src="` +
        //                             "/images/user_img/".concat(tutor.user.user_img) +
        //                             `" alt="Arabia" title="Arabia"></div>
        //                                     <div class="price">` +
        //                             tutor.PricePerHour +
        //                             `</div>
        //                                     <div class="price-to">USD/H</div>
        //                                     <div class="fild bot-de bot-card">
        //                                          <a class="bottom"  href="#booktrial` +
        //                             tutor.id +
        //                             `" data-toggle="modal">Book Free Trial</a>
        //                                          <a class="bottom" href="#" record_id="` +
        //                             tutor.id +
        //                             `" tname="` +
        //                             tutor.user.fname +
        //                             tutor.user.lname +
        //                             `" headline="` +
        //                             tutor.user.headline +
        //                             `" timage="` +
        //                             tutor.user.user_img +
        //                             `" data-toggle="modal">Send Message</a>
        //                                     </div>
        //                                 </div>
        //                                 <div class="tu-content">
        //                                     <div class="minhead">
        //                                         <h3 class="title"><a style="color: #af8b62 !important;" href="/tutor/page/` +
        //                             tutor.id +
        //                             `">` +
        //                             tutor.user.fname +
        //                             ` ` +
        //                             tutor.user.lname[0] +
        //                             `.</a></h3>
        //                                         <div class="flag" title="` +
        //                             tutor.country_name +
        //                             `"> ` +
        //                             tutor.country_name +
        //                             `</div>
        // <!--                                                                                <div class="flag" title="\`+tutor.country_name+\`"> country(\`+tutor.iso+\`)getEmoji()</div>-->
        //
        //                                         <div class="safy">
        //                                             <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="16.436" height="19.301" viewBox="0 0 16.436 19.301">
        //                                                 <defs>
        //                                                     <linearGradient id="linear-gradient" x1="0.5" x2="0.5" y2="1" gradientUnits="objectBoundingBox">
        //                                                         <stop offset="0" stop-color="#ba9a74"></stop>
        //                                                         <stop offset="1" stop-color="#877456"></stop>
        //                                                     </linearGradient>
        //                                                 </defs>
        //                                                 <g id="surface1" transform="translate(0 0.001)">
        //                                                     <path id="Path_28769" data-name="Path 28769" d="M124.119,158.457a3.677,3.677,0,1,0,3.677,3.677A3.682,3.682,0,0,0,124.119,158.457Zm2.183,2.985-2.635,2.635a.566.566,0,0,1-.8,0l-1.007-1.007a.566.566,0,1,1,.8-.8l.606.606,2.234-2.234a.566.566,0,0,1,.8.8Zm0,0" transform="translate(-115.901 -152.485)" fill="url(#linear-gradient)"></path>
        //                                                     <path id="Path_28770" data-name="Path 28770" d="M16.417,5.236V5.221c-.008-.185-.014-.382-.017-.6a2.046,2.046,0,0,0-1.926-2A7.938,7.938,0,0,1,9.07.34L9.058.328a1.235,1.235,0,0,0-1.679,0L7.366.34a7.939,7.939,0,0,1-5.4,2.277,2.045,2.045,0,0,0-1.926,2c0,.217-.009.413-.017.6v.035a20.918,20.918,0,0,0,.845,7.635A9.72,9.72,0,0,0,3.2,16.523a12.2,12.2,0,0,0,4.563,2.7,1.413,1.413,0,0,0,.187.051,1.381,1.381,0,0,0,.543,0,1.418,1.418,0,0,0,.188-.051,12.206,12.206,0,0,0,4.558-2.7,9.733,9.733,0,0,0,2.332-3.633A20.949,20.949,0,0,0,16.417,5.236Zm-8.2,9.224a4.81,4.81,0,1,1,4.81-4.81A4.815,4.815,0,0,1,8.218,14.46Zm0,0" transform="translate(0)" fill="url(#linear-gradient)"></path>
        //                                                 </g>
        //                                             </svg>
        //                                         </div>
        //                                         <ul class="rating">
        //                                             <li class="fas fa-star active"></li>
        //                                             <li class="fas fa-star active"></li>
        //                                             <li class="fas fa-star active"></li>
        //                                             <li class="fas fa-star active"></li>
        //                                         </ul>
        //                                     </div>
        //                                     <div class="minhead towhead">
        //                                     </div>
        //                                     <div class="row">
        //                                         <div class="col-sm-4 itemactiv">
        //                                             <div class="mactiv"><img src="/frontAssets/images/mactiv1.png" alt="Arabia" title="Arabia">
        //                                                 <div class="con-item">
        //                                                     <h4 class="title">Active students</h4><span>` +
        //                             tutor.booked_slots.length +
        //                             ` </span>
        //                                                 </div>
        //                                             </div>
        //                                         </div>
        //                                         <div class="col-sm-4 itemactiv">
        //                                             <div class="mactiv"><img src="/frontAssets/images/clock.png" alt="Arabia" title="Arabia">
        //                                                 <div class="con-item">
        //                                                     <h4 class="title">Lessons</h4><span>` +
        //                             tutor.booked_slots.length +
        //                             ` </span>
        //                                                 </div>
        //                                             </div>
        //                                         </div>
        //                                         <div class="col-sm-4 itemactiv">
        //                                             <div class="mactiv"><img src="/frontAssets/images/review.png" alt="Arabia" title="Arabia">
        //                                                 <div class="con-item">
        //                                                     <h4 class="title">Reviews</h4><span>` +
        //                             tutor.reviews.length +
        //                             ` </span>
        //                                                 </div>
        //                                             </div>
        //                                         </div>
        //                                     </div>
        //                                     <div class="headtext">
        //                                         <strong>` +
        //                             tutor.headline +
        //                             `</strong>
        //                                         <p class="textline">` +
        //                             tutor.detail.substr(0, 50) +
        //                             `</p>
        //                                         <div class="onclick"><span class="more">Read More</span><span class="cancel">X hide</span></div>
        //                                           <p class="divhidslid">` +
        //                             tutor.detail.substr(50, 249) +
        //                             `</p>
        //                                     </div>
        //                                 </div>
        //                                 <div class="showitem"></div>
        //                             </div>
        //                         </div>
        //
        //                         <div class="col-sm-4 contenuser showbox">
        //                             <div class="hover-box"><i class="fas fa-caret-left arwoleft"></i>
        //
        //                                 ` +
        //                             iframeContent +
        //                             `
        //                                 <p class="timezone"><i class="fas fa-globe-americas"></i> Times are shown in your local timezone    </p>
        //                                 <div class="calandar-wek">
        //                                     <ul class="nav nav-tabs" id="myTab" role="tablist">
        //                                     </ul>
        //                                     <div class="tab-content" id="myTabContent">
        //
        //                                             <div class="text-center"><a class="bottom" href="/tutor/page/` +
        //                             tutor.id +
        //                             `">View Full Scedule</a></div>
        //                                     </div>
        //                                 </div>
        //                             </div>
        //                         </div>
        //                         </div>
        // </div>`
        //                     );
        //                     $.each(tutor.languages, function (key, language) {
        //                         var speaks =
        //                             `<div class="speaks">
        //                         <p>speaks :</p><span>` +
        //                             language.language.isoName +
        //                             `</span><strong>` +
        //                             language.level.name +
        //                             `</strong></div>`;
        //                         // $('.towhead').append(speaks);
        //                     });
        //
        //                     $.each(tutor.schedule, function (key, schedule) {
        //                         var schedules =
        //                             `<div class="tab-pane fade show active" id="item-1" role="tabpanel" aria-labelledby="item-1-tab">
        //                         <div class="times-day">
        //                         <h3 class="title">` +
        //                             schedule.day +
        //                             `</h3>
        //                     <div class="row">
        //                         <div class="col-sm-2 ch-item">
        //                             <label class="chebox-time">
        //                                 <input type="checkbox" name="checkbox">
        //                                     <div class="label-text">
        //                                         <p>` +
        //                             schedule.start_time +
        //                             `</p>
        //                                     </div>
        //                             </label>
        //                         </div>
        //                         <div class="col-sm-2 ch-item">
        //                             <label class="chebox-time">
        //                                 <input type="checkbox" name="checkbox">
        //                                     <div class="label-text">
        //                                         <p>` +
        //                             schedule.end_time +
        //                             `</p>
        //                                     </div>
        //                             </label>
        //                         </div>
        //                     </div>
        //                 `;
        //                         // $('#myTabContent').append(schedules);
        //                     });
        //                 });
        //             },
        //         });
        //     });

        $(".specialties").chosen({
            buttons: true,
            checkAll: true,
            search: true,
            placeholder: "Specialties",
            selectColor: "lila",
            itemTitle: "Color selected",
            showEachItem: true,
            dropdownMaxHeight: "165px",
            onChange: true,
            onkeyup: true,
            function: true,
        });

        $(".responsive").slick({
            dots: true,
            infinite: false,
            speed: 50,
            slidesToShow: 1,
            slidesToScroll: 1,
            responsive: [{}],
        });
        $(".testmonials-slider").slick({
            centerMode: true,
            centerPadding: '10px',
            dots: true,
            infinite: true,
            speed: 1500,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1500,
            responsive: [],
            arrows: false
        });
        $(".licen-slider").slick({
            dots: false,
            infinite: true,
            speed: 1500,
            slidesToShow: 5,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1500,
            responsive: [],
            arrows: true
        });
        $(".prod-slider").slick({
            dots: false,
            arrows: true,

            infinite: true,
            speed: 3500,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 1500,
            responsive: [],

        });

        $(".instructors-slider").slick({
            dots: true,
            infinite: true,
            speed: 1500,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1500,
            responsive: [],
        });
        if ($("html").attr("lang") == "ar") {
            $(".prod-slider").slick({
                dots: false,
                arrows: true,
                infinite: true,
                speed: 3500,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: false,
                autoplaySpeed: 1500,
                responsive: [],
                rtl: true
            });
            $(".responsive").slick({
                dots: true,
                infinite: false,
                speed: 50,
                slidesToShow: 1,
                slidesToScroll: 1,
                responsive: [{}],
                rtl: true
            });

            $(".instructors-slider").slick({
                dots: true,
                infinite: true,
                speed: 1500,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 1500,
                responsive: [],
                rtl: true
            });


            $(".testmonials-slider").slick({
                dots: true,
                infinite: true,
                speed: 1500,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 1500,
                responsive: [],
                rtl: true
            });
            $(".licen-slider").slick({
                dots: false,
                infinite: true,
                speed: 1500,
                slidesToShow: 5,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 1500,
                responsive: [],
                arrows: true,
                rtl: true

            });
        }
        $(".clickbot .conn-bot").click(function ()
        {
            $(".show-connect").show("");
            $(".clickbot .calen").fadeIn("");
            $(".clickbot .conn-bot").fadeOut("");
        });

        $(".clickbot .calen").click(function ()
        {
            $(".show-connect").hide("");
            $(".clickbot .calen").fadeOut("");
            $(".clickbot .conn-bot").fadeIn("");
        });
        $(".search__block__mobile .btn-search").click(function ()
        {
            $(".searchMobile").toggleClass("open");
        });
        $(".close-search").click(function ()
        {
            $(".searchMobile").removeClass("open");
        });
        // $(".searchInputeasySelect").hide();

        $(".makeFav").click(function (e)
        {
            var tutor_id = e.target.id;
            $.ajax({
                url: "/api/makeFavouriteTutor",
                type: "POST",
                data: { tutor_id: tutor_id },
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (data)
                {
                    location.reload();
                },
            });
        });

        $(".removeFav").click(function (e)
        {
            console.log(e.target.id);
            var tutor_id = e.target.id;
            console.log(tutor_id);

            $.ajax({
                url: "/api/removeFavourite",
                type: "POST",
                data: { tutor_id: tutor_id },
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (data)
                {
                    location.reload();
                },
            });
        });

        $(".country").chosen({
            buttons: false,
            search: true,
            placeholder: "Country of origin",
            itemTitle: "Countrys selected",
            showEachItem: true,
            dropdownMaxHeight: "165px",
            onchange: true,
            function: true,
        });

        $(".langu").chosen({
            buttons: false,
            search: true,
            placeholder: "Also Speaks",
            itemTitle: "Countrys selected",
            showEachItem: true,
            dropdownMaxHeight: "165px",
            onchange: true,
            function: true,
        });

        $(".chebox-time .label-text").click(function ()
        {
            $(this).toggleClass("active");
        });

        //Start  Item language box

        $(".availability").click(function (event)
        {
            event.stopPropagation();
            $(".inner-ava").fadeIn("");
        });
        $(".inner-ava").on("click", function (event)
        {
            event.stopPropagation();
            $(".inner-ava").fadeIn("");
        });
        $("body,.styledSelect").click(function ()
        {
            $(".inner-ava").fadeOut("");
        });
        $(".availability").click(function ()
        {
            $(".options").fadeOut("");
        });

        //End   Item language box

        /* 1. Visualizing things on Hover - See next part for action on click */
        $(".stars li")
            .on("mouseover", function ()
            {
                var onStar = parseInt($(this).data("value"), 10); // The star currently mouse on

                // Now highlight all the stars that's not after the current hovered star
                $(this)
                    .parent()
                    .children("li.star")
                    .each(function (e)
                    {
                        if (e < onStar) {
                            $(this).addClass("hover");
                        } else {
                            $(this).removeClass("hover");
                        }
                    });
            })
            .on("mouseout", function ()
            {
                $(this)
                    .parent()
                    .children("li.star")
                    .each(function (e)
                    {
                        $(this).removeClass("hover");
                    });
            });
        /* 2. Action to perform on click */
        $(".stars li").on("click", function ()
        {
            var onStar = parseInt($(this).data("value"), 10); // The star currently selected
            var stars = $(this).parent().children("li.star");

            for (i = 0; i < stars.length; i++) {
                $(stars[i]).removeClass("selected");
            }

            for (i = 0; i < onStar; i++) {
                $(stars[i]).addClass("selected");
            }

            // JUST RESPONSE (Not needed)
            var ratingValue = parseInt(
                $("#stars li.selected").last().data("value"),
                10
            );
            var msg = "";
            if (ratingValue > 1) {
                msg = "Thanks! You rated this " + ratingValue + " stars.";
            } else {
                msg =
                    "We will improve ourselves. You rated this " +
                    ratingValue +
                    " stars.";
            }
            responseMessage(msg);
        });

        // $(function() {
        //     var top = $('#sidebar').offset().top - parseFloat($('#sidebar').css('marginTop').replace(/auto/, 0));
        //     var footTop = $('#footer').offset().top - parseFloat($('#footer').css('marginTop').replace(/auto/, 0));
        //
        //     var maxY = footTop - $('#sidebar').outerHeight();
        //
        //     $(window).scroll(function(evt) {
        //         var y = $(this).scrollTop();
        //         if (y >= top - $('#fixedHeader').height()) {
        //             if (y < maxY) {
        //                 $('#sidebar').addClass('fixed').removeAttr('style');
        //             } else {
        //                 $('#sidebar').removeClass('fixed').css({
        //                     position: 'absolute',
        //                     top: (maxY - top) + 'px'
        //                 });
        //             }
        //         } else {
        //             $('#sidebar').removeClass('fixed');
        //         }
        //     });
        // });

        $(".mobile-number").intlTelInput({
            //autoFormat: false,
            //autoHideDialCode: false,
            //defaultCountry: "jp",
            //nationalMode: true,
            //numberType: "MOBILE",
            //onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
            //preferredCountries: ['cn', 'jp'],
            //responsiveDropdown: true,
            //utilsScript: "lib/libphonenumber/build/utils.js"
        });

        var maxchars = 1000;

        $("textarea").keyup(function ()
        {
            var tlength = $(this).val().length;
            $(this).val($(this).val().substring(0, maxchars));
            var tlength = $(this).val().length;
            remain = maxchars - parseInt(tlength);
            $("#remain").text(remain);
        });

        $(".setting-menu a").click(function ()
        {
            $(".setting-menu a").removeClass("active");
            $(this).addClass("active");
        });
    });

    $(document).ready(function ()
    {
        var events = [];
        var role = "instructor";
        $.ajax({
            url: "/api/calendarData",
            type: "POST",
            data: { role: role },
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (data)
            {
                $.each(data, function (index, el)
                {
                    // console.log(parseInt(el.date.substring(8, 10)) - 1);

                    var oneEvent = {
                        start: now
                            .startOf("month")
                            .add(parseInt(el.date.substring(8, 10)) - 1, "days")
                            .add(el.start_time.substring(0, 2), "h")
                            .format("X"),
                        end: now
                            .startOf("month")
                            .add(parseInt(el.date.substring(8, 10)) - 1, "days")
                            .add(parseInt(el.start_time.substring(0, 2)) + 1, "h")
                            .format("X"),
                        title: el.fname + " " + el.lname,
                        // content: 'Hello World! <br> <p>Foo Bar</p>',
                        category: "Personnal",
                    };

                    events.push(oneEvent);
                });
            },
        });

        moment.locale("en");
        var now = moment();

        /**
         * Many events
         */

        /**
         * A daynote
         */
        var daynotes = [
            {
                time: now.startOf("week").add(15, "h").add(30, "m").format("X"),
                title: "Leo's holiday",
                content: "yo",
                category: "holiday",
            },
        ];

        /**
         * Init the
         */
        // console.log(events);
        var calendar = $("#calendar")
            .Calendar({
                locale: "en",
                defaultDate: "2020-11-15",
                defaultView: "month",
                weekday: {
                    timeline: {
                        intervalMinutes: 30,
                        fromHour: 9,
                    },
                },
                events: events,
                // daynotes: daynotes
            })
            .init();

        /**
         * Listening for events
         */

        $("#calendar").on(
            "Calendar.daynote-mouseenter",
            function (event, instance, elem)
            {
                console.log("event : Calendar.daynote-mouseenter");
                console.log(instance);
                console.log(elem);
            }
        );
        $("#calendar").on(
            "Calendar.daynote-mouseleave",
            function (event, instance, elem)
            {
                console.log("event : Calendar.daynote-mouseleave");
                console.log(instance);
                console.log(elem);
            }
        );
        $("#calendar").on(
            "Calendar.event-mouseenter",
            function (event, instance, elem)
            {
                console.log("event : Calendar.event-mouseenter");
                console.log(instance);
                console.log(elem);
            }
        );
        $("#calendar").on(
            "Calendar.event-mouseleave",
            function (event, instance, elem)
            {
                console.log("event : Calendar.event-mouseleave");
                console.log(instance);
                console.log(elem);
            }
        );
        $("#calendar").on(
            "Calendar.daynote-click",
            function (event, instance, elem, evt)
            {
                console.log("event : Calendar.daynote-click");
                console.log(instance);
                console.log(elem);
                console.log(evt);
            }
        );
        $("#calendar").on(
            "Calendar.event-click",
            function (event, instance, elem, evt)
            {
                console.log("event : Calendar.event-click");
                console.log(instance);
                console.log(elem);
                console.log(evt);
            }
        );

        $(".loading").fadeIn("slow", function ()
        {
            $("body").addClass("active");
            $(".loading").delay(500).fadeOut();
            setTimeout(function ()
            {
                $("body").removeClass("active");
            }, 500);
        });
    });

    //var blank="http://upload.wikimedia.org/wikipedia/commons/c/c0/Blank.gif";
    function readURL(input)
    {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e)
            {
                $(".img_prev").attr("src", e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            var img = input.value;
            $(".img_prev").attr("src", img);
        }
    }

    // jQuery(function() {
    //     jQuery("a.bla-2").YouTubePopUp({ autoplay: 1 }); // Disable autoplay
    // });

    $(" .book-trial").click(function ()
    {
        var targetModal = $(this).attr("href");
        //alert(targetModal);
        $("div[id=" + targetModal + "]").addClass("active");
        $("body").addClass("active");
    });

    $(" .clo-item").click(function ()
    {
        $(".box-book-trial").removeClass("active");

        $("body").removeClass("active");
    });

    $("#sidebar").stickySidebar({
        sidebarTopMargin: 100,
        footerThreshold: 100,
    });

    // End loop of file input elementsResponse

    $("[data-fancybox]").fancybox({});
    $(document).ready(function ()
    {
        $(".tu-hover").hover(function ()
        {
            $(this).addClass("show").siblings().removeClass("show");
        });
        $(".tu-hover").mouseleave(function ()
        {
            $(this).removeClass("show");
            $(".firstItem").addClass("show");
        });
    });
})(jQuery);
