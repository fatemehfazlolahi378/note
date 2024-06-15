<div class="p-4 lg:px-8 lg:py-5 bg-[#F3F7FA] rounded-lg my-4">
    <h3 class="text-[14px] lg:text-[16px] mb-3"><span class="fa fa-search ml-1 text-[14px] lg:text-[16px] font-bold"></span>جستجو</h3>
    <form action="{{route('dashboard.notes.index')}}" id="panel-form-search">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <div class="relative box-search">
                    <input name="query" class="meili-search-input w-[301px] xl:h-[42px] h-[40px] xl:text-[16px] text-[14px] bg-[#F0F0F0] rounded-[10px] border-2 border-[#2D6A4F] px-[19px] placeholder-[#1B4332] focus:ring-0 focus:border-[#2D6A4F]" type="text" placeholder="جستجوکنید..."/>
                    <i class="ag-i-search-normal icon-search-main absolute xl:text-[19px] left-[10px] top-[10px]" id="archive-tick"></i>
                    <div class="absolute meilisearch-response  bg-white rounded-[5px] mt-1 top-[40px] right-0 left-0 hidden py-3 max-h-[400px]"></div>
                </div>
            </div>
        </div>
        <div class="flex justify-center sm:justify-end items-center gap-2 mt-6">
            <button type="submit" class="lg:w-[110px] sm:w-[100px] w-[90px] lg:h-[40px] h-[35px] lg:leading-[40px] leading-[35px] border border-lime-700 text-lime-700 lg:text-sm text-[12px] rounded-[8px] hover:bg-lime-700 hover:text-white"> جستجو</button>
            <a href="{{route('dashboard.notes.index')}}" class="lg:w-[110px] sm:w-[100px] w-[90px] lg:h-[40px] h-[35px] lg:leading-[40px] leading-[35px] border border-rose-700 text-red-700 lg:text-sm text-[12px] rounded-[8px] text-center hover:bg-red-700 hover:text-white">حذف جستجو</a>
        </div>
    </form>
</div>
