@extends('dashboard.master')
@section('content')
    <div class="flex items-center h-[100vh]">
        <form action="{{route('dashboard.profile.update' , ['profile' => auth()->id()])}}" method="post" enctype="multipart/form-data" class="form-profile m-auto box-left flex flex-col gap-[30px] lg:w-[74%] w-[100%] bg-[#fff] rounded-[20px] 1150:py-[50px] py-[40px] 1150:px-[48px] sm:px-[25px] px-[20px]">
            @csrf
            @method('PUT')
            <div class="flex items-center gap-x-5 pb-[30px]">
                <div class="relative">
                    <input type="file" id="input-file" class="hidden" name="profile_img">
                    <label for="input-file" class="label-file flex items-center justify-center lg:w-[150px] sm:w-[130px] w-[110px] lg:h-[150px] sm:h-[130px] h-[110px] rounded-[50%] bg-[#F3F7FA] border-[4px] border-white">
                        @if(auth()->user()->image)
                            <img src="{{asset('storage/'. auth()->user()->image)}}" width="150px" height="150px" class="h-full w-full rounded-[50%]" alt="{{auth()->user()->full_name}}" title="{{auth()->user()->full_name}}">
                        @else
                            <span class="fa fa-user text-white text-[50px]"></span>
                        @endif
                    </label>
                    <span class="icon-delete fa fa-trash text-[25px] sm:text-[30px] absolute bottom-[7px] sm:bottom-[6px] right-[8px] sm:right-[17px]" data-id="{{auth()->id()}}"></span>
                    <span class="icon-edit fa fa-edit text-[25px] sm:text-[30px] absolute bottom-[7px] sm:bottom-[6px] right-[8px] sm:right-[17px] hidden"></span>
                </div>
                <span class="text-[14px] sm:text-[15px] lg:text-[16px] font-bold">آپلود عکس جدید</span>
            </div>
            <div class="flex flex-col md:flex-row justify-center gap-[20px] md:gap-[20%]">
                <div class="flex flex-col gap-[15px] md:w-[40%] w-[100%]">
                    <label class="lg:text-[16px] text-[14px] font-bold">نام نام خانوادگی:</label>
                    <div class="relative">
                        <input  type="text" name="name" value="{{auth()->user()->full_name}}" class="w-[100%] 1150:h-[48px] sm:h-[43px] h-[40px] border border-[#c7c7c7] rounded-[8px] p-[10px] lg:text-[16px] text-[14px] focus:border-[#2D6A4F] focus:ring-0">
                        <i class="ag-i-edit-2 absolute 1150:top-[16px] sm:top-[13px] top-[11px] left-[14px] text-[18px] text-[#1B4332]"></i>
                    </div>
                </div>
                <div class="flex flex-col gap-[15px] md:w-[40%] w-[100%]">
                    <label class="lg:text-[16px] text-[14px] font-bold">شماره تلفن:</label>
                    <input type="text" dir="ltr" value="{{auth()->user()->mobile}}" disabled class="w-[100%] 1150:h-[48px] sm:h-[43px] h-[40px] border border-[#c7c7c7] rounded-[8px] p-[10px] lg:text-[16px] text-[14px] focus:border-[#2D6A4F] focus:ring-0" placeholder="۰۹۰۳۷۲۲۹۶۱">
                </div>
            </div>
            <div class="flex flex-col-reverse md:flex-row justify-center gap-[20px] md:gap-[20%]">
                <div class="flex flex-col gap-[15px] md:w-[40%] w-[100%]">
                    <label class="lg:text-[16px] text-[14px] font-bold">ایمیل:</label>
                    <div class="relative">
                        <input type="email" dir="ltr" name="email" value="{{auth()->user()->email}}" class="w-[100%] 1150:h-[48px] sm:h-[43px] h-[40px] border border-[#c7c7c7] rounded-[8px] p-[10px] lg:text-[16px] text-[14px] focus:border-[#2D6A4F] focus:ring-0" placeholder="ali@yourdimain.com">
                        <i class="ag-i-edit-2 absolute 1150:top-[16px] sm:top-[13px] top-[11px] left-[14px] text-[18px] text-[#1B4332]"></i>
                    </div>
                </div>
            </div>
            <div class="flex justify-center md:justify-end">
                <button type="submit" class="400:w-[150px] w-[123px] 1150:h-[48px] 400:h-[43px] h-[40px] bg-[#40916C] text-[#fff] 400:text-[18px] text-[17px] rounded-[8px]">ثبت</button>
            </div>
        </form>
    </div>
@endsection
