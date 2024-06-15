(function ($) {
    meili = {
        init: function (cnfg) {
            this.config = cnfg;
            this.bindEvents();
        },

        bindEvents: function () {
            this.config.inputMailiSearch.on('input', this.meilisearch);
            window.document.body.addEventListener('click' , this.closeSearch)
        },

        meilisearch: function () {
            let self = meili;
            if ($(this).val().length >= 3) {
                $.ajax({
                    'url': '/dashboard/meili',
                    'type': 'GET',
                    'data': {
                        value: $(this).val()
                    },
                    dataType: 'JSON',
                    success: function (res) {
                        let value = '';
                        if(res.note.length){
                            $.each(res.note, function ($i, $v) {
                                value += `<div class="px-3">
                                          <a href="${$v.url}" class="card d-flex h-100">
                                               <div class="card-body flex my-2">
                                                  <i class="ag-i-search-normal icon-search-main ml-2" id="archive-tick"></i>
                                                  <div>
                                                        <h5 class="card-title m-0">${$v.title}</h5>
                                                        <p class="card-text text-[12px]">${$v.content}</p>
                                                   </div>
                                               </div>
                                          </a>
                                      </div>`;
                            });
                        }else{
                           value += `<div class="card-text result-null text-[14px] py-5 px-3">برای جستجوی شما نتیجه‌ای یافت نشد.</div>`;
                        }

                        $('.meilisearch-response').removeClass('hidden');
                        $('.meilisearch-response').html(value);
                    },
                })
            }

        },

        closeSearch:function (e){
            if(e.target != $('.meili-search-input')[0] && e.target != $('.meilisearch-response')[0] && e.target != $('.icon-search-main')[0] && e.target != $('.result-null')[0]){
                $('.meilisearch-response').addClass('hidden');
            };

        }
    };
    meili.init({
        inputMailiSearch: $('.meili-search-input'),
    });

})(window.jQuery, window.handlebars);
