
<div class="sidebar hidden lg:block w-[250px] h-[100vh] bg-[#326273] fixed">
    <div class="border-b border-[#3a5a40] py-5">
        <div class="w-[90px] h-[90px] rounded-[50%] border m-auto">
            <img width="90px" height="90px" src="{{asset('images/avatar.png')}}" class="w-full h-full rounded-[50%]">
        </div>
        <div class="flex flex-col justify-center items-center gap-2 mt-3 text-white text-[14px]">
            <span>09371281576</span>
            <span>فاطمه فضل الهی</span>
        </div>
    </div>
    <div class="py-5">
        <ul class="flex flex-col gap-3 px-[20px] text-white text-[15px]">
            <li class="dashboard"><a href="{{route('desktop.index')}}" class="flex gap-3 hover:text-[#ffed66] hover:gap-5 transition-all duration-500 py-3"><span class="fa fa-tachometer text-[20px]"></span>داشبورد</a></li>
            <li class="category"><a href="{{route('desktop.categories.index')}}" class="flex gap-3 hover:text-[#ffed66] hover:gap-5 transition-all duration-500 py-3"><span class="fa fa-tachometer text-[20px]"></span>دسته بندی</a></li>
            <li class="note"><a href="{{route('desktop.notes.index')}}" class="flex gap-3 hover:text-[#ffed66] hover:gap-5 transition-all duration-500 py-3"><span class="fa fa-file text-[20px]"></span>یادداشت</a></li>
            <form action="{{--route('logout')--}}" method="post" class="w-full">
                @csrf
                <button type="submit" class="flex gap-3 hover:text-[#ffed66] hover:gap-5 transition-all duration-500 py-3"><span class="fa fa-sign-out text-[20px]"></span>خروج</button>
            </form>
        </ul>
    </div>
</div>
<div class="lg:hidden p-4 border-b">
    <span class="btn-sidebar fa fa-bars"></span>
</div>
