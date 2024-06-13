(function ($) {
    Delete = {
        init: function (cnfg) {
            this.config = cnfg;
            this.bindEvents();
        },

        bindEvents: function () {
            this.config.Delete.on('click', this.delete);
            this.config.ForceDelete.on('click', this.forceDelete);
            this.config.softDelete.on('click', this.SoftDelete);
        },

        getToken: function () {
            return document.querySelector('meta[name="CSRF-TOKEN"]')['content'];
        },

        setAjaxSetup: function () {
            let self = Delete;
            axios.defaults.headers = {
                "X-Requested-With": "XMLHttpRequest",
            }
        },

        delete: function () {
            let self = Delete;
            let $this = $(this);
            izitoast.question({
                timeout: 20000,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: 'question',
                zindex: 999,
                title: 'هشدار!',
                message: 'آیا از حذف آیتم ' + $this.attr('data-title') + ' اطمینان دارید؟',
                position: 'center',
                rtl: true,
                buttons: [
                    ['<button><b>بله</b></button>', function (instance, toast) {
                        instance.hide({transitionOut: 'fadeOut'}, toast, true);
                    }],
                    ['<button>خیر</button>', function (instance, toast) {
                        instance.hide({transitionOut: 'fadeOut'}, toast, false);
                    }, true],
                ],
                onClosing: function (instance, toast, closedBy) {
                    if (closedBy) {
                        axios.delete(location.origin + location.pathname + `/${$this.attr('data-id')}`)
                            .then(
                                function (res) {
                                    $this.parent().parent().parent().parent().parent().remove();
                                    izitoast.success({
                                        title: 'آیتم',
                                        message: 'با موفقیت حذف شد',
                                        position: "center",
                                        timeout: 5000,
                                        rtl: true
                                    })
                                }
                            )
                            .catch(function (error) {
                                if (error.response.status === 403) {
                                    izitoast.error({
                                        title: error.response.data.title,
                                        message: error.response.data.message,
                                        position: "center",
                                        timeout: 5000,
                                        rtl: true
                                    })
                                }
                            });
                    }
                },
            });
        },


        forceDelete: function () {
            let self = Delete;
            let $this = $(this);
            izitoast.question({
                timeout: 20000,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: 'question',
                zindex: 999,
                title: 'هشدار!',
                message: 'آیا از حذف آیتم ' + $this.attr('data-title') + ' اطمینان دارید؟',
                position: 'center',
                rtl: true,
                buttons: [
                    ['<button><b>بله</b></button>', function (instance, toast) {
                        instance.hide({transitionOut: 'fadeOut'}, toast, true);
                    }],
                    ['<button>خیر</button>', function (instance, toast) {
                        instance.hide({transitionOut: 'fadeOut'}, toast, false);
                    }, true],
                ],
                onClosing: function (instance, toast, closedBy) {
                    if (closedBy) {
                        axios.delete(location.origin + location.pathname +'/delete'+`/${$this.attr('data-id')}`)
                            .then(
                                function (res) {
                                    console.log($this.parent().parent().parent().parent().parent())
                                    $this.parent().parent().parent().parent().parent().remove();
                                    izitoast.success({
                                        title: 'آیتم',
                                        message: 'با موفقیت حذف کامل شد',
                                        position: "bottomLeft",
                                        timeout: 5000,
                                        rtl: true
                                    })
                                }
                            )
                            .catch(function (error) {
                                if (error.response.status === 403) {
                                    izitoast.error({
                                        title: error.response.data.title,
                                        message: error.response.data.message,
                                        position: "bottomLeft",
                                        timeout: 5000,
                                        rtl: true
                                    })
                                }
                            });
                    }
                },
            });
        },



        SoftDelete: function () {
            let self = Delete;
            let $this = $(this);
            izitoast.question({
                timeout: 20000,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: 'question',
                zindex: 999,
                title: 'هشدار!',
                message: 'آیا از حذف آیتم ' + $this.attr('data-title') + ' اطمینان دارید؟',
                position: 'center',
                rtl: true,
                buttons: [
                    ['<button><b>بله</b></button>', function (instance, toast) {
                        instance.hide({transitionOut: 'fadeOut'}, toast, true);
                    }],
                    ['<button>خیر</button>', function (instance, toast) {
                        instance.hide({transitionOut: 'fadeOut'}, toast, false);
                    }, true],
                ],
                onClosing: function (instance, toast, closedBy) {

                    if (closedBy) {
                        axios.delete(location.origin + location.pathname + `/${$this.attr('data-id')}`)
                            .then(
                                function (res) {
                                    $this.parent().parent().parent().parent().parent().css('background-color', '#fad0864a');
                                    izitoast.success({
                                        title: 'آیتم',
                                        message: 'به طور موقت حذف شد',
                                        position: "bottomLeft",
                                        timeout: 2000,
                                        rtl: true
                                    })
                                    setTimeout(function (){
                                        window.location.reload();
                                    },2000)
                                }
                            )
                            .catch(function (error) {
                                if (error.response.status === 403) {
                                    izitoast.error({
                                        title: error.response.data.title,
                                        message: error.response.data.message,
                                        position: "bottomLeft",
                                        timeout: 5000,
                                        rtl: true
                                    })
                                }
                            });
                    }
                },
            });
        },
    };

    Delete.init({
        Delete: $('.delete'),
        ForceDelete: $('.force-delete'),
        softDelete: $('.soft-delete'),
    });

})(window.jQuery);

