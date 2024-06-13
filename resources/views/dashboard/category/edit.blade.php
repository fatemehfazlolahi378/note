@extends('dashboard.master')
@section('content')
    <div class="category-edit p-4 lg:p-8">
        <ul class="flex items-center text-[12px] lg:text-[16px]">
            <li class="after:content-['/'] after:px-1 lg:after:px-2"><a href="{{route('dashboard.index')}}">صفحه اصلی</a></li>
            <li>فرم ویرایش دسته</li>
        </ul>
        <div class="p-4 lg:px-8 lg:py-5 bg-[#F3F7FA] rounded-lg my-4">
            <h3 class="text-[14px] lg:text-[16px] py-3 border-b mb-4">ویرایش دسته</h3>
            <form action="{{route('dashboard.categories.update',$category)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="text-sm">نام دسته<span class="text-rose-700">*</span></label>
                        <div class="text-rose-700 float-left text-[12px]">
                            @error('name')
                            {{ $message }}
                            @enderror
                        </div>
                        <input name="name" value="{{$category->name}}" class="w-full rounded-lg border border-[#e8e8f7] px-[12px] lg:px-[16px] py-[8px] lg:py-[10px] focus:ring-0 focus:border-[#e8e8f7] text-sm mt-2" type="text" placeholder="دسته">
                    </div>
                    <div>
                        <label class="text-sm">دسته والد <span class="text-rose-700">*</span></label>
                        <div class="text-rose-700 float-left text-[12px]">
                            @error('parent_id')
                            {{ $message }}
                            @enderror
                        </div>
                        <select name="parent_id" class="w-full rounded-lg border border-[#e8e8f7] px-[12px] lg:px-[16px] py-[8px] lg:py-[10px] focus:ring-0 focus:border-[#e8e8f7] text-sm mt-2">
                            <option value="0">دسته اصلی</option>
                            @foreach($categories as $parentCategory)
                                <option
                                    @if($parentCategory->id == $category->parent_id)
                                        selected
                                    @endif
                                    value="{{$parentCategory->id}}">{{$parentCategory->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="text-sm">slug<span class="text-rose-700">*</span></label>
                        <div class="text-rose-700 float-left text-[12px]">
                            @error('slug')
                            {{ $message }}
                            @enderror
                        </div>
                        <input name="slug" value="{{$category->slug}}" class="w-full rounded-lg border border-[#e8e8f7] px-[12px] lg:px-[16px] py-[8px] lg:py-[10px] focus:ring-0 focus:border-[#e8e8f7] text-sm mt-2" type="text" placeholder="slug">
                    </div>
                    <div>
                        <label class="block text-sm">ایکن</label>
                        <input name="icon" value="{{$category->icon}}" class="w-full rounded-lg border border-[#e8e8f7] px-[12px] lg:px-[16px] py-[8px] lg:py-[10px] focus:ring-0 focus:border-[#e8e8f7] text-sm mt-2" type="text">
                    </div>
                    <div>
                        <label class="block text-sm">نام برچسب</label>
                        <select name="tags[]" multiple="multiple" class="select-multiple w-full rounded-lg border border-[#e8e8f7] px-[12px] lg:px-[16px] py-[8px] lg:py-[10px] focus:ring-0 focus:border-[#e8e8f7] text-sm mt-2">
                            @foreach($tags as $tag)
                                <option value="{{$tag->id}}" @if(in_array($tag->id, $category->tags->pluck('id')->toArray())) selected @endif>{{$tag->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex justify-center sm:justify-end items-center gap-2 mt-6">
                    <button type="submit" class="lg:w-[110px] sm:w-[100px] w-[90px] lg:h-[40px] h-[35px] lg:leading-[40px] leading-[35px] border border-lime-700 text-lime-700 lg:text-sm text-[12px] rounded-[8px] hover:bg-lime-700 hover:text-white">ثبت</button>
                    <a href="{{route('dashboard.categories.index')}}" class="lg:w-[110px] sm:w-[100px] w-[90px] lg:h-[40px] h-[35px] lg:leading-[40px] leading-[35px] border border-rose-700 text-red-700 lg:text-sm text-[12px] rounded-[8px] text-center  hover:bg-red-700 hover:text-white">انصراف</a>
                </div>
            </form>
        </div>
    </div>
@endsection
