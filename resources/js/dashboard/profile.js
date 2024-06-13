(function ($) {
    Profile = {
        init: function (cnfg) {
            this.config = cnfg;
            this.bindEvents();
        },


        bindEvents: function () {
            this.config.inputFile.on('change', this.uplodeImage);
            this.config.iconDelete.on('click', this.remove);

        },

        uplodeImage:function (e){
            let self = Profile;
            let files = e.target.files[0]
            let parent = $(e.target).parent().children('label')
            let reader = new FileReader(files)
            reader.onload = function (e){
                let result = e.target.result
                let img = `<img src="${result}" class="w-full h-full rounded-[50%]">`
                parent.html(img)
            }
            reader.readAsDataURL(files)
            self.config.iconEdit.addClass('hidden');
            self.config.iconDelete.removeClass('hidden');
            $( '.form-profile input[name="remove"]').remove()
        },
        remove:function (e){
            let self = Profile;
            let input = `<input name="remove" type="hidden">`
            self.config.formProfile.append(input);
            let parent = $(e.target).parent().children('label')
            let icon = `<span class="fa fa-user text-white text-[50px]"></span>`
            parent.html(icon)
            self.config.iconEdit.removeClass('hidden');
            self.config.iconDelete.addClass('hidden');
        },


    };
    Profile.init({
        inputFile:$('#input-file'),
        iconEdit:$('.icon-edit'),
        iconDelete:$('.icon-delete'),
        formProfile:$('.form-profile'),

    });

})(window.jQuery);
