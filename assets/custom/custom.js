(function($) {
    var AppKPI = {
        init: function() {
            this.init_icheck();
            this.init_datepicker();
            this.init_datatable();
            this.init_confirm_js();
            this.init_select_2();
            this.submit_isi_kpi();
            this.init_print_pdf();
            this.init_select_2_province();
            this.init_chart_rekap();
            this.init_mask_js();
        },

        init_chart_rekap: function() {
            if (!$("#myChart").length) return;

            //ajax to get data and set chart
            url = kpi_data.base_url;
            form = $(".form-filter-rekap").serialize();
            // id_periode = $('.id_periode').val();
            // other_data = { 'id_periode': id_periode }
            console.log(form);

            $.ajax({
                type: "get",
                url: url + "/kpi/rekap/ajax_chart_data?" + form,
                data: "",
                dataType: "json",
                success: function(response) {
                    // set chart
                    // console.log(response)
                    if (!response) return;
                    response.datasets.label = "test";
                    var ctx = document.getElementById("myChart").getContext("2d");
                    $("#myChart").css({ height: "400px" });
                    var options = {
                        scales: {
                            yAxes: [{
                                barPercentage: 0.5,
                                // categoryPercentage:5,
                                // barThickness: 15,
                                maxBarThickness: 10,
                                minBarLength: 5,
                                gridLines: {
                                    offsetGridLines: true
                                }
                            }]
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        ticks: {
                            beginAtZero: true
                        }
                    };
                    // var data_dummmy =
                    var myChart = new Chart(ctx, {
                        type: "horizontalBar",
                        data: response,
                        options: options
                    });
                }
            });
        },

        /**
         * Init icheck for class .iCheck
         */
        init_icheck: function() {
            $(".iCheck").iCheck({
                checkboxClass: "icheckbox_square-blue",
                // radioClass: 'iradio_square-blue',
                increaseArea: "20%" // optional
            });
        },

        /**
         * Init datepicker for class .input-datepicker
         */
        init_datepicker: function() {
            $(".input-datepicker").datepicker({
                format: "yyyy-mm-dd"
            });
        },

        /**
         * Init datatable for class .datatable
         */
        init_datatable: function() {
            $(".datatable").DataTable();
        },

        submit_isi_kpi: function() {
            $(".submit-isi-kpi").click(function(e) {
                e.preventDefault();
                // console.log('click')
                valid = true;
                $(".input-kpi").each(function(index) {
                    // console.log(index);
                    target = parseInt(
                        $(this)
                        .closest("tr")
                        .find(".nilai-target")
                        .html()
                    );
                    nama_indikator = $(this)
                        .closest("tr")
                        .find(".nama-indikator")
                        .html();
                    // console.log(nama_indikator);
                    value = parseInt($(this).val());
                    //                    console.log("value =" + value);

                    //                    console.log("target = " + target)
                    //validate nilai cannot be greater than target
                    check = value > target;
                    //                    console.log(check)
                    if (check) {
                        console.log("realisasi " + nama_indikator);
                        toastr.warning(
                            "Realisasi " +
                            nama_indikator +
                            " Harus lebih kecil dari " +
                            target
                        );
                        valid = false;
                    }
                    //                    console.log('===========')
                });
                if (valid) {
                    $(".form-isi-kpi").submit();
                }
            });
        },

        init_confirm_js: function() {
            //confirm delete
            $(".js-confirm").confirm({
                // 'content': this.$target.data('content'),
                // 'title': this.$target.data('title'),
                icon: "fa fa-warning",
                theme: "supervan",
                onContentReady: function() {
                    self.$content = this.$target.data("content");
                    self.$title = this.$target.data("title");
                },
                buttons: {
                    ok: function() {
                        console.log("yes pressed");
                        location.href = this.$target.data("target");
                    },
                    close: function() {
                        console.log("cancel");
                    }
                }
            });
        },

        init_select_2: function() {
            $(".select2").select2({
                placeholder: $(this).data("placeholder")
            });
        },
        init_select_2_province: function() {
            $(".select-province").select2({
                placeholder: $(this).data("placeholder")
            });
            $(".select-province").on("select2:select", function(e) {
                var data = e.params.data;

                //ajax get regencies
                console.log(data);
                url = kpi_data.base_url;
                $.ajax({
                    type: "get",
                    url: url + "kpi/profile/ajax_get_regencies/" + data.id,
                    // data: "data",
                    dataType: "json",
                    success: function(response) {
                        // var data = {
                        //     id: 1,
                        //     text: 'Barn owl'
                        // };
                        // console.log(response);
                        // console.log(data);
                        if (response) {
                            //clear first
                            $(".select-regencies")
                                .html("")
                                .select2({ data: [{ id: "", text: "" }] });

                            //loop response and append regencies
                            response.forEach(function(item, index) {
                                // console.log(item);
                                var newOption = new Option(item.name, item.id, false, false);
                                $(".select-regencies")
                                    .append(newOption)
                                    .trigger("change");
                            });
                            // response.array.forEach(element => {

                            // });
                        }
                    }
                });
            });
        },
        init_print_pdf: function() {
            var doc = new jsPDF();
            var specialElementHandlers = {
                "#editor": function(element, renderer) {
                    return true;
                }
            };
            margins = {
                top: 80,
                bottom: 60,
                left: 40,
                width: 522
            };

            $(".print-pdf").click(function() {

                console.log('click print')
                var element = document.getElementById("table-rekap");

                // html2pdf(element);


                var opt = {
                    margin: 0.5,
                    filename: "myfile.pdf",
                    image: { type: "jpeg", quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: "in", format: "letter", orientation: "portrait" }
                };

                // New Promise-based usage:
                html2pdf()
                    .set(opt)
                    .from(element)
                    .save();

                console.log('export pdf')

                // var pdf = new jsPDF("p", "pt", "letter");
                // source = $("#table-rekap")[0];

                // pdf.fromHTML(
                //   source, // HTML string or DOM elem ref.
                //   margins.left, // x coord
                //   margins.top,
                //   {
                //     // y coord
                //     width: margins.width, // max width of content on PDF
                //     elementHandlers: specialElementHandlers
                //   },
                //   function(dispose) {
                //     // dispose: object with X, Y of the last line add to the PDF
                //     //          this allow the insertion of new lines after html
                //     pdf.save("Test.pdf");
                //     // var string = doc.output('datauristring');
                //     // var embed = "<embed width='100%' height='100%' src='" + string + "'/>"
                //     // var x = window.open();
                //     // x.document.open();
                //     // x.document.write(embed);
                //     // x.document.close();
                //   },
                //   margins
                // );

            });
            // pdf.output('dataurlnewwindow');
        },
        init_mask_js: function() {
            if (!$('.mask').length) return;

            $('.mask-date').mask('00-00-0000');

            $('.mask-money').mask("#.##0", { reverse: true });


        }
    };
    $(function() {
        // Run on DOM ready
        AppKPI.init();
    });

    // Run right away
})(jQuery);

var AdminLTEOptions = {
    //Enable sidebar expand on hover effect for sidebar mini
    //This option is forced to true if both the fixed layout and sidebar mini
    //are used together
    sidebarExpandOnHover: true,
    //BoxRefresh Plugin
    enableBoxRefresh: true,
    //Bootstrap.js tooltip
    enableBSToppltip: true
};

// function demoFromHTML() {
//     var pdf = new jsPDF('p', 'pt', 'letter');
//     // source can be HTML-formatted string, or a reference
//     // to an actual DOM element from which the text will be scraped.
//     source = $('#table-rekap')[0];
//     // source = $('#customers')[0];

//     // we support special element handlers. Register them with jQuery-style
//     // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
//     // There is no support for any other type of selectors
//     // (class, of compound) at this time.
//     specialElementHandlers = {
//         // element with id of "bypass" - jQuery style selector
//         '#editor': function (element, renderer) {
//             // true = "handled elsewhere, bypass text extraction"
//             return true
//         }
//     };
//     margins = {
//         top: 80,
//         bottom: 60,
//         left: 40,
//         width: 522
//     };
//     // all coords and widths are in jsPDF instance's declared units
//     // 'inches' in this case
//     pdf.fromHTML(
//     source, // HTML string or DOM elem ref.
//     margins.left, // x coord
//     margins.top, { // y coord
//         'width': margins.width, // max width of content on PDF
//         'elementHandlers': specialElementHandlers
//     },

//     function (dispose) {
//         // dispose: object with X, Y of the last line add to the PDF
//         //          this allow the insertion of new lines after html
//         pdf.save('Test.pdf');
//     }, margins);
// }