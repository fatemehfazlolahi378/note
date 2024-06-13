(function ($) {
    Login = {
        init: function (cnfg) {
            this.config = cnfg;
            this.setAjaxSetup();
            this.bindEvents();
        },

        bindEvents: function () {
            this.config.btnLoginModal.on('click', this.openLoginModal);
            window.document.body.addEventListener('click', this.closeMenu);
            this.config.btnSubmitMobile.on('click', this.checkUser);
            this.config.inputMobile.on('keypress', this.validateInput);
            this.config.inputMobile.on('keyup', this.autoClickToCheckUser);
            this.config.btnRegister.on('click', this.register);
            this.config.btnLoginPassword.on('click', this.loginPassword);
            this.config.showPassword.on('click', this.showPassword);
            this.config.inputLoginPass.on('keypress', this.submitInter);
        },

        getToken: function () {
            return document.querySelector('meta[name="csrf-token"]')['content'];
        },

        setAjaxSetup: function () {
            let self = Login;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': self.getToken()
                }
            });
        },

        openLoginModal: function () {
            let self = Login;
            self.config.MobileBox.removeClass('hidden')
            self.config.loginBox.addClass('hidden')
            self.config.registerBox.addClass('hidden')
            self.config.PasswordBox.addClass('hidden')
            self.config.btnSubmitMobile.prop('disabled', false);
            self.config.btnSubmitMobile.text("ادامه");
            self.config.inputMobile.val("");
            $('#sidebar-menu').removeClass('show-sidebar')
            $('#login-modal').addClass('show-modal');
            $('body').css('overflow','hidden')
        },

        closeMenu: function (e) {
            if (e.target.matches('#login-modal')) {
                $('#login-modal').removeClass('show-modal');
                $('body').css('overflow','visible')
            }
        },

        autoClickToCheckUser: function (e) {
            let self = Login;
            if ($(this).val().length == 11 && self.val != self.config.inputMobile.val()) {
                self.val = self.config.inputMobile.val();
                self.config.btnSubmitMobile.click()
            }
        },


        validateInputCode: function (e) {
            if (e.keyCode < 48 || e.keyCode > 57) {
                $(this).tooltip({
                    title: "کیبورد خود را در حالت انگلیسی قرار دهید و فقط عدد وارد کنید",
                    placement: "top"
                }).tooltip('enable').tooltip("show");
                return false;
            }
        },

        checkUser: function () {
            let self = Login;
            let mobile = $('#input-mobile').val();
            if (mobile.length) {
                $.ajax({
                    'url': '/check-user',
                    'type': 'POST',
                    data: {
                        'mobile': mobile
                    },
                    success: function (res) {
                        if (res.login) {
                            self.config.btnSubmitMobile.prop('disabled', true);
                                $('.mobile-box').addClass('hidden');
                                $('.login-box').removeClass('hidden');

                        } else{
                            $('.mobile-box').addClass('hidden');
                            $('.register-box').removeClass('hidden');
                        }
                    },
                    error: function (err) {
                        if (err.status == '422') {
                            $.each(err.responseJSON.errors, function (i, v) {
                                let el = $(v);
                                izitoast.error({
                                    title: 'خطا',
                                    message: v[0],
                                    position: "center",
                                    timeout: 5000,
                                    rtl: true
                                })
                            });
                        } else if (err.status == '401') {
                            $('.mobile-box').removeClass('hidden');
                            $('.login-box').addClass('hidden');
                        } else if (err.status == '429') {
                            izitoast.error({
                                title: 'خطا',
                                message: 'تعداد درخواست های شما زیاد بوده است.چند دقیقه دیگر امتحان نمایید',
                                position: "center",
                                timeout: 5000,
                                rtl: true
                            })
                        }

                    }
                })
            } else {
                izitoast.error({
                    title: 'خطا',
                    message: 'فیلد تلفن همراه اجباری است.',
                    position: "center",
                    timeout: 5000,
                })
            }
        },

        login: function () {
            let self = Login;
            let mobile = $('#input-mobile').val();
            let form = new FormData(self.config.formCheckUser[0]);
            form.append('mobile', mobile);
            $.ajax({
                'url': '/user-login',
                'type': 'POST',
                'data': form,
                dataType: 'JSON',
                processData: false,
                contentType: false,

                beforeSend: function () {
                    self.config.btnSubmitMobile.prop('disabled', true);
                    self.config.btnSubmitCode1.prop('disabled', true);
                },
                success: function (res) {
                    izitoast.success({
                        title: 'موفقیت',
                        message: 'کد تایید وارد شده درست است',
                        position: 'center',
                        timeout: 2000,
                        rtl: true
                    })
                    setTimeout(function (){
                        $('.password-box').addClass('hidden')
                        $('.register-box').removeClass('hidden')
                    } , 2000)

                },
                error: function (err) {
                    if (err.status == '422') {
                        $.each($('input[name="code[]"]'), function ($i, $v) {
                            $($v).val('');
                        });
                        $.each(err.responseJSON.errors, function ($i, $v) {
                            izitoast.error({
                                title: 'خطا',
                                message: $v,
                                position: "center",
                                timeout: 5000,
                                rtl: true
                            })
                        });
                    } else if (err.status == '401') {
                        $('.mobile-box').removeClass('hidden');
                        $('.password-box').addClass('hidden');
                    } else if (err.status == '403') {
                        izitoast.error({
                            title: 'خطا',
                            message: err.responseJSON.message,
                            position: "center",
                            timeout: 5000,
                            rtl: true
                        });

                    } else if (err.status == '429') {
                        izitoast.error({
                            title: 'خطا',
                            message: 'تعداد درخواست های شما زیاد بوده است.چند دقیقه دیگر امتحان نمایید',
                            position: "center",
                            timeout: 5000,
                            rtl: true
                        })
                    }
                }

            })
        },

        register: function () {
            let self = Login;
            let mobile = $('#input-mobile').val();
            let form = new FormData(self.config.registerBox[0]);
            form.append('mobile', mobile);
            $.ajax({
                'url': '/register-user',
                'type': 'POST',
                data: form,
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function () {
                    izitoast.success({
                        title: 'موفقیت',
                        message: 'باموفقیت وارد شدید',
                        position: 'center',
                        timeout: 5000,
                        rtl: true
                    })
                    setTimeout(function () {
                        location.assign('/dashboard');
                    }, 2000);
                },
                error:function (err){
                    if(err.status == 422){
                        izitoast.error({
                            title: 'خطا',
                            message: 'تایید رمز عبور نادرست است',
                            position: 'center',
                            timeout: 5000,
                            rtl: true
                        })
                    }
                }
            })
        },

        loginPassword: function () {
            let self = Login;
            let mobile = $('#input-mobile').val();
            let form = new FormData(self.config.loginBox[0]);
            form.append('mobile', mobile);
            $.ajax({
                'url': '/login-password',
                'type': 'POST',
                data: form,
                dataType: 'JSON',
                processData: false,
                contentType: false,
                success: function () {
                    izitoast.success({
                        title: 'موفقیت',
                        message: 'باموفقیت وارد شدید',
                        position: 'center',
                        timeout: 5000,
                        rtl: true
                    })
                    setTimeout(function () {
                        location.assign('/dashboard');
                    }, 2000);
                },
                error: function (err) {
                    if (err.status == 422) {
                        $('#password').val('');
                        izitoast.error({
                            title: 'خطا',
                            message: 'رمز عبور وارد شده اشتباه است',
                            position: "center",
                            timeout: 5000,
                            rtl: true
                        })
                    }
                }
            })

        },

        toPersianDigits: function (str) {
            let p = "۰۹۸۷۶۵۴۳۲۱".split("");
            let e = "0987654321".split("");
            let s = String(str);
            for (let i = 0; i < 10; i++) {
                s = s.replaceAll(e[i], p[i]);
            }
            return s;
        },


        validateInput: function (e) {
            let value = '';
            if (e.keyCode < 48 || e.keyCode > 57) {
                $('#tooltip-default').addClass('show-tooltip')
            }


        },

        showPassword:function (e){
            let input = $(e.target.parentElement.children[0])
            let span = $(e.target.parentElement.children[1])
            let span2 = $(e.target.parentElement.children[2])
            if(input.attr('type') == 'password'){
                input.attr('type','text')
                span.addClass('hidden')
                span2.removeClass('hidden')
            }else{
                input.attr('type','password')
                span2.addClass('hidden')
                span.removeClass('hidden')
            }
        },

        submitInter: function (e){
            let self = Login;
            if(e.keyCode == 13){
                e.preventDefault()
                self.config.btnLoginPassword.click()
            }
        }


    };

    Login.init({
        btnLoginModal: $('.btn-login-modal'),
        inputMobile: $('#input-mobile'),
        btnSubmitMobile: $('#btn-submit-mobile'),
        formCheckUser: $('#form-check-user'),
        btnRegister: $('#btn-register'),
        registerBox: $('.register-box'),
        btnLoginPassword: $('#btn-login-password'),
        loginBox: $('.login-box'),
        showPassword:$('.show-password'),
        btnSubmitCode2:$('#btn-submit-code2'),
        PasswordBox:$('.password-box'),
        MobileBox:$('.mobile-box'),
        inputLoginPass:$('.input-login-pass')

    });

})(window.jQuery);
