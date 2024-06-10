(function ($) {
    Note = {
        init: function (cnfg) {
            this.config = cnfg;
            this.bindEvents();

            if ($('#content-note').length) {
                this.setupTinyMce();
            }
        },

        bindEvents: function () {
            this.config.subCategoryBox.on('change', '.category_id_advertise', this.getSubCategoryAdvertise);
        },

        getSubCategoryAdvertise: function () {
            let id = $(this).val();
            $(this).nextAll('select').remove();
            $.ajax({
                'url': '/subcategory/get/' + id,
                dataType: 'JSON',
                success: function (res) {
                    let values = '';
                    let options = '<option value="">انتخاب کنید</option>';
                    if (res.categories.length) {
                        if (Object.keys(res.categories).length > 0) {
                            $.each(res.categories, function ($i, $v) {
                                options += `<option value="${$v.id}">${$v.name}</option>`;
                            });
                            values =
                                `<select class="category_id_advertise w-full rounded-lg border border-[#e8e8f7] px-[12px] lg:px-[16px] py-[8px] lg:py-[10px] focus:ring-0 focus:border-[#e8e8f7] text-sm mt-3"   name="category_id">` +
                                `${options}` +
                                '</select>' +
                                '</div>';
                            $('.sub-category-box').append(values);
                        }
                    }
                },
                error: function (err) {
                }
            });
        },
        setupTinyMce: function () {
            tinymce.init({
                selector: '#content-note',
                plugins: 'powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars  image link  mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap tinycomments mentions quickbars linkchecker emoticons advtable',
                toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
                height: 400,
                images_upload_credentials: true,
                target_list: true,
                rel_list: [
                    {title: 'No Referrer', value: 'noreferrer'},
                    {title: 'External Link', value: 'external'},
                    {title: 'No Follow', value: 'nofollow'},
                    {title: 'Follow', value: 'follow'},
                ],
                images_upload_url: '/administrator/tiny-upload-image/mag',
                language: 'fa_IR',
                content_style: 'body {font-family: IRANSansWeb; }'
            });
        },

    };




    Note.init({
        subCategoryBox: $('.sub-category-box'),
    });

})(window.jQuery);
