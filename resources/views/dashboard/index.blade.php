@extends('dashboard.master')
@section('content')
@php
    $note_count = \App\Models\Note::count();
    $category_count =\App\Models\Category::count();
@endphp
    <div class="index p-4 lg:p-8">
        <h1 class="lg:my-3 text-[14px] lg:text-[16px]">صفحه ی اصلی</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-6 md:gap-8 mt-[30px] lg:mt-[50px]">
            <div class="h-[239px] sm:h-[258px] xl:h-[300px] bg-white lg:bg-[#F3F7FA] rounded-[16px]">
                <div class="border-b border-[#C6C6C6] text-[17px] sm:text-[20px] xl:text-[24px] px-[20px] xl:px-[30px] py-[22px] sm:py-[25px] xl:py-[30px]">یادداشت ها</div>
                <div class="flex justify-between border-b border-[#C6C6C6] px-[20px] xl:px-[30px] pt-[30px] xl:pb-[40px] sm:py-[30px] py-[25px]">
                    <div class="flex flex-col items-center gap-y-4 xl:gap-y-5">
                        <span class=" text-[15px] sm:text-[16px] xl:text-[20px]">مجموع یادداشت ها</span>
                        <span class=" text-[15px] sm:text-[16px] xl:text-[20px]">{{$note_count}}</span>
                    </div>
                    <div class="flex justify-center items-center w-[50px] xl:w-[60px] h-[50px] xl:h-[60px] rounded-[40%] bg-[#F3F7FA] lg:bg-white">
                        <span class="fa fa-book text-[18px] lg:text-[22px]"></span>
                    </div>
                </div>
            </div>
            <div class="h-[239px] sm:h-[258px] xl:h-[300px] bg-white lg:bg-[#F3F7FA] rounded-[16px]">
                <div class="border-b border-[#C6C6C6] text-[17px] sm:text-[20px] xl:text-[24px] px-[20px] xl:px-[30px] py-[22px] sm:py-[25px] xl:py-[30px]">دسته بندی ها</div>
                <div class="flex justify-between border-b border-[#C6C6C6] px-[20px] xl:px-[30px] pt-[30px] xl:pb-[40px] sm:py-[30px] py-[25px]">
                    <div class="flex flex-col items-center gap-y-4 xl:gap-y-5">
                        <span class=" text-[15px] sm:text-[16px] xl:text-[20px]">مجموع دسته بندی</span>
                        <span class=" text-[15px] sm:text-[16px] xl:text-[20px]">{{$category_count}}</span>
                    </div>
                    <div class="flex justify-center items-center w-[50px] xl:w-[60px] h-[50px] xl:h-[60px] rounded-[40%] bg-[#F3F7FA] lg:bg-white">
                        <span class="fa fa-th-large text-[18px] lg:text-[22px]"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
