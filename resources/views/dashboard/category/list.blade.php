@extends('dashboard.master')
@section('content')
    <div class="index p-4 lg:p-8">
        <h1 class="lg:my-3 text-[14px] lg:text-[16px]">لیست دسته بندی ها</h1>
        <ul class="px-[20px] py-[15px]">
            @foreach($categories as $index=>$categoryMain)
                <li class="main-category-filter cursor-pointer py-[10px] px-[10px]" data-id="list-sub-category-filter-{{$index}}">
                    <i class="fa fa-folder-open font-bold text-orange-500"></i>
                    <span class="font-bold">{{$categoryMain->name}}</span>
                </li>
                <ul class="list-sub-category-filter flex flex-col gap-3 h-0 overflow-hidden transition-all duration-500 px-[10px] pr-5" id="list-sub-category-filter-{{$index}}">
                    @foreach($categoryMain->children as $child)
                        <li class="category-filter px-[5px] py-[3px] cursor-pointer">
                            <i class="fa fa-folder-open font-bold text-orange-500"></i>
                            <span class="font-bold"> {{$child->name}}</span>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </ul>
    </div>
@endsection
