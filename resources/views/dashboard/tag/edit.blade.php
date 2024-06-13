@extends('dashboard.master')
@section('content')
    <div class="tag-edit p-4 lg:p-8">
        <ul class="flex items-center text-[12px] lg:text-[16px]">
            <li class="after:content-['/'] after:px-1 lg:after:px-2"><a href="{{route('dashboard.index')}}">صفحه اصلی</a></li>
            <li>فرم ویرایش برچسب</li>
        </ul>
        <div class="p-4 lg:px-8 lg:py-5 bg-[#F3F7FA] rounded-lg my-4">
            <h3 class="text-[14px] lg:text-[16px] py-3 border-b mb-4">ویرایش برچسب</h3>
            <form action="{{route('dashboard.tags.update',$tag)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm">نام برچسب<span class="text-rose-700">*</span></label>
                        <div class="text-rose-700 float-left text-[12px]">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </div>
                        <input name="name" value="{{$tag->name}}" class="w-full rounded-lg border border-[#e8e8f7] px-[12px] lg:px-[16px] py-[8px] lg:py-[10px] focus:ring-0 focus:border-[#e8e8f7] text-sm mt-2" type="text" placeholder="برچسب">
                    </div>
                </div>
                <div class="flex justify-center sm:justify-end items-center gap-2 mt-6">
                    <button type="submit" class="lg:w-[110px] sm:w-[100px] w-[90px] lg:h-[40px] h-[35px] lg:leading-[40px] leading-[35px] border border-lime-700 text-lime-700 lg:text-sm text-[12px] rounded-[8px] hover:bg-lime-700 hover:text-white">ثبت</button>
                    <a href="{{route('dashboard.tags.index')}}" class="lg:w-[110px] sm:w-[100px] w-[90px] lg:h-[40px] h-[35px] lg:leading-[40px] leading-[35px] border border-rose-700 text-red-700 lg:text-sm text-[12px] rounded-[8px] text-center  hover:bg-red-700 hover:text-white">انصراف</a>
                </div>
            </form>
        </div>
    </div>
@endsection
