(function ($) {
    Sidebar = {
        init: function (cnfg) {
            this.config = cnfg;
            this.bindEvents();
            this.btnSidebar();
        },

        bindEvents: function () {
            this.config.btnDropdown.on('click', this.openDropdown)
            this.config.btnSidebar.on('click', this.sidebar)
            this.config.body.on('click', this.closeSide)


        },

        openDropdown:function (){
            let self = Sidebar;
            let icon = $(this).children().children('.fa-angle-left')
            let ul = $(this).parent().children("ul")
            let scroll = ul.prop('scrollHeight')
            if (ul.height() == 0){
                $('.fa-angle-left').css('rotate' , '0deg')
                icon.css('rotate' , '90deg')
                self.config.dropdownMenu.height(0);
                ul.height(scroll + "px")
            }else {
                ul.height(0)
                icon.css('rotate' , '0deg')
            }
        },
        sidebar:function (){
            let self = Sidebar
            self.config.sidebarMenu.css('width', '100%')
            document.body.style.overflow = 'hidden'
        },
        closeSide:function (e){
            let self = Sidebar
            if (e.target.matches('#sidebar-menu')){
                self.config.sidebarMenu.css('width', '0')
            }
        },
        btnSidebar:function (){

            let path = location.pathname
            switch (path){
                case '/':
                    $('.dashboard').addClass('active')
                    break;
                case '/categories':
                    $('.category').addClass('active')
                    $('.list-category').height($('.list-category').prop('scrollHeight'))
                    $('.icon-left-category').css('rotate' , '90deg')
                    break;
                case '/tags':
                    $('.tag').addClass('active')
                    $('.list-category').height($('.list-category').prop('scrollHeight'))
                    $('.icon-left-category').css('rotate' , '90deg')
                    break;
                case '/list-category':
                    $('.list').addClass('active')
                    $('.list-category').height($('.list-category').prop('scrollHeight'))
                    $('.icon-left-category').css('rotate' , '90deg')
                    break;
                case '/notes':
                    $('.note').addClass('active')
                    break;
                case '/profile/edit':
                    $('.profile').addClass('active')
                    break;
            }
        }

    };




    Sidebar.init({
        btnDropdown:$('.btn-dropdown'),
        dropdownMenu:$('.dropdown-menu'),
        btnSidebar:$('.btn-sidebar'),
        sidebarMenu:$('#sidebar-menu'),
        body:$('body')

    });

})(window.jQuery);
