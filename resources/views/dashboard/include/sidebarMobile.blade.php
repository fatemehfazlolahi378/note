
<div id="sidebar-menu" class="h-full w-0 overflow-hidden bg-[rgb(32,34,35,37%)] z-[1050] duration-500 fixed top-0 transition-all">
    <div class="w-[250px] 300:w-[280px] 400:w-[320px] h-[100vh] bg-[#326273] absolute overflow-y-scroll">
        <div class="border-b border-[#3a5a40] py-5">
            <div class="w-[90px] h-[90px] rounded-[50%] border m-auto">
                @if(auth()->user()->image)
                    <img width="90px" height="90px" src="{{asset('storage/'. auth()->user()->image)}}" class="w-full h-full rounded-[50%]">
                @else
                    <img width="90px" height="90px" src="{{asset('images/avatar.png')}}" class="w-full h-full rounded-[50%]">
                @endif
            </div>
            <div class="flex flex-col justify-center items-center gap-2 mt-3 text-white text-[14px]">
                <span>{{auth()->user()->mobile}}</span>
                <span>{{auth()->user()->full_name}}</span>
            </div>
        </div>
        <div class="py-5">
            <ul class="flex flex-col gap-3 px-[20px] text-white text-[15px]">
                <li class="dashboard"><a href="{{route('dashboard.index')}}" class="flex gap-3 hover:text-[#ffed66] hover:gap-5 transition-all duration-500 py-3"><span class="fa fa-tachometer text-[20px]"></span>داشبورد</a></li>
                <li class="profile"><a href="{{route('dashboard.profile.edit')}}" class="flex gap-3 hover:text-[#ffed66] hover:gap-5 transition-all duration-500 py-3"><span class="fa fa-user text-[20px]"></span>مشخصات کاربر</a></li>
                <li class="dropdown">
                    <div class="btn-dropdown flex gap-3 hover:text-[#ffed66] hover:gap-5 transition-all duration-500 py-3 cursor-pointer">
                        <span class="fa fa-th-large text-[20px]"></span>
                        <span class="flex-1 flex items-center justify-between">دسته بندی<i class="fa fa-angle-left icon-left-category transition-all duration-500"></i></span>
                    </div>
                    <ul class="dropdown-menu list-category pr-[9px] text-[14px] flex flex-col gap-4 h-0 overflow-hidden transition-all duration-500">
                        <li class="category py-1 hover:text-[#ffed66]"><span class="fa fa-caret-left ml-3 text-[15px]"></span><a href="{{route('dashboard.categories.index')}}">دسته بندی</a></li>
                        <li class="list py-1 hover:text-[#ffed66]"><span class="fa fa-caret-left ml-3 text-[15px]"></span><a href="{{route('dashboard.categories.list')}}">لیست دسته بندی</a></li>
                        <li class="tag py-1 hover:text-[#ffed66]"><span class="fa fa-caret-left ml-3 text-[15px]"></span><a  href="{{route('dashboard.tags.index')}}">برچسب</a></li>
                    </ul>
                </li>
                <li class="note"><a href="{{route('dashboard.notes.index')}}" class="flex gap-3 hover:text-[#ffed66] hover:gap-5 transition-all duration-500 py-3"><span class="fa fa-file text-[20px]"></span>یادداشت</a></li>
                <form action="{{route('logout')}}" method="post" class="w-full">
                    @csrf
                    <button type="submit" class="flex gap-3 hover:text-[#ffed66] hover:gap-5 transition-all duration-500 py-3"><span class="fa fa-sign-out text-[20px]"></span>خروج</button>
                </form>
            </ul>
        </div>
    </div>
</div>

