(function ($) {
    Category = {
        init: function (cnfg) {
            this.config = cnfg;
            this.inputsSelect2();
            this.bindEvents();
        },

        bindEvents: function () {
            this.config.mainCategoryFilter.on('click' ,this.openSubCat);
        },

        openSubCat:function (){
            let id = $(this).attr('data-id');
            let scroll = $('#' + id).prop('scrollHeight');
            if($('#' + id).height() == 0){
                $('.list-sub-category-filter').height(0);
                $('#' + id).height(scroll+"px")
                $('.icon-sub-cat').css('rotate' , '0deg')
                $(this).children('i.icon-sub-cat').css('rotate' , '-90deg')
            }else{
                $('#' + id).height(0)
                $(this).children('i.icon-sub-cat').css('rotate' , '0deg')
            }

        },
        inputsSelect2: function () {
            $.fn.select2.defaults.set("theme", "bootstrap");
            $('.select-multiple').select2({
                dir: 'rtl',
                placeholder: 'انتخاب کنید',
            });
        },
    };
    Category.init({
        mainCategoryFilter:$('.main-category-filter'),
    });

})(window.jQuery);
