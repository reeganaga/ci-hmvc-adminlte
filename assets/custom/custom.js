(function ($) {

    var AppKPI = {
        init: function () {
            this.init_icheck();
            this.init_datepicker();
            this.init_datatable();
            this.init_confirm_js();
            this.init_select_2();
            this.submit_isi_kpi();
            this.init_print_pdf();
        },

        /**
         * Init icheck for class .iCheck
         */
        init_icheck: function () {
            $('.iCheck').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                // radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        },

        /**
         * Init datepicker for class .input-datepicker
         */
        init_datepicker: function () {
            $('.input-datepicker').datepicker({
                format: 'yyyy-mm-dd'
            });
        },

        /**
         * Init datatable for class .datatable
         */
        init_datatable: function () {
            $('.datatable').DataTable();
        },

        submit_isi_kpi: function () {
            $('.submit-isi-kpi').click(function (e) {
                e.preventDefault();
                // console.log('click')
                valid = true;
                $('.input-kpi').each(function (index) {
                    // console.log(index);
                    target = $(this).closest('tr').find('.nilai-target').html();
                    nama_indikator = $(this).closest('tr').find('.nama-indikator').html();
                    // console.log(nama_indikator);
                    value = $(this).val();
                    //validate nilai cannot be greater than target
                    if (value > target) {
                        toastr.warning('Realisasi ' + nama_indikator + " Harus lebih kecil dari " + target)
                        valid = false;
                    }
                    // console.log('check')
                })
                if (valid) {
                    $('.form-isi-kpi').submit();
                }
            })
        },

        init_confirm_js: function () {

            //confirm delete
            $('.js-confirm').confirm({
                // 'content': this.$target.data('content'),
                // 'title': this.$target.data('title'),
                'icon': 'fa fa-warning',
                "theme": 'supervan',
                "onContentReady": function () {
                    self.$content = this.$target.data('content');
                    self.$title = this.$target.data('title');
                },
                "buttons": {
                    ok: function () {
                        console.log('yes pressed')
                        location.href = this.$target.data('target');
                    },
                    close: function () {
                        console.log('cancel')
                    }
                }
            })
        },

        init_select_2: function () {
            $('.select2').select2({
                placeholder: $(this).data('placeholder')
            })
        },
        init_print_pdf: function () {


            var doc = new jsPDF();
            var specialElementHandlers = {
                '#editor': function (element, renderer) {
                    return true;
                }
            };
            margins = {
                top: 80,
                bottom: 60,
                left: 40,
                width: 522
            };


            $('.print-pdf').click(function () {
                var pdf = new jsPDF('p', 'pt', 'letter');
                source = $('#table-rekap')[0];


                pdf.fromHTML(
                    source, // HTML string or DOM elem ref.
                    margins.left, // x coord
                    margins.top, {// y coord
                    'width': margins.width, // max width of content on PDF
                    'elementHandlers': specialElementHandlers
                },
                    function (dispose) {
                        // dispose: object with X, Y of the last line add to the PDF 
                        //          this allow the insertion of new lines after html
                        pdf.save('Test.pdf');
                        // var string = doc.output('datauristring');
                        // var embed = "<embed width='100%' height='100%' src='" + string + "'/>"
                        // var x = window.open();
                        // x.document.open();
                        // x.document.write(embed);
                        // x.document.close();
                    }
                    , margins);
            });
            // pdf.output('dataurlnewwindow');

        }
    }
    $(function () {
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