<div class="p-4 lg:px-8 lg:py-5 bg-[#F3F7FA] rounded-lg my-4">
    <h3 class="text-[14px] lg:text-[16px] mb-3"><span class="fa fa-search ml-1 text-[14px] lg:text-[16px] font-bold"></span>جستجو</h3>
    <form action="{{route('dashboard.notes.index')}}" id="panel-form-search">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm">عنوان</label>
                <input name="title" id="title" class="w-full rounded-lg border border-[#e8e8f7] px-[12px] lg:px-[16px] py-[8px] lg:py-[10px] focus:ring-0 focus:border-[#e8e8f7] text-sm mt-2" type="text" placeholder="عنوان"  value="{{Request()->get('title')}}">
            </div>
        </div>
        <div class="flex justify-center sm:justify-end items-center gap-2 mt-6">
            <button type="submit" class="lg:w-[110px] sm:w-[100px] w-[90px] lg:h-[40px] h-[35px] lg:leading-[40px] leading-[35px] border border-lime-700 text-lime-700 lg:text-sm text-[12px] rounded-[8px] hover:bg-lime-700 hover:text-white"> جستجو</button>
            <a href="{{route('dashboard.notes.index')}}" class="lg:w-[110px] sm:w-[100px] w-[90px] lg:h-[40px] h-[35px] lg:leading-[40px] leading-[35px] border border-rose-700 text-red-700 lg:text-sm text-[12px] rounded-[8px] text-center hover:bg-red-700 hover:text-white">حذف جستجو</a>
        </div>
    </form>
</div>
