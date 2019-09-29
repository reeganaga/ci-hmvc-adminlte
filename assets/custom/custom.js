(function ($) {

    var AppKPI = {
        init: function () {
            this.init_icheck();
            this.init_datepicker();
            this.init_datatable();
            this.submit_isi_kpi();
            this.init_confirm_js();
            this.init_select_2();
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
                console.log('click')
                $('.form-isi-kpi').submit();
            })
        },

        init_confirm_js: function () {

            //confirm delete
            $('.js-confirm').confirm({
                // 'content': this.$target.data('content'),
                // 'title': this.$target.data('title'),
                'icon': 'fa fa-warning',
                "theme": 'supervan',
                "onContentReady":function(){
                    self.$content=this.$target.data('content');
                    self.$title=this.$target.data('title');
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
    
        init_select_2: function(){
            $('.select2').select2({
                placeholder: $(this).data('placeholder')
            })
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