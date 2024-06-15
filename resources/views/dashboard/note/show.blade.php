@extends('dashboard.master')
@section('content')
    <div class="notes-index p-4 lg:p-8">
        <div class="flex justify-between lg:py-4">
            <ul class="flex items-center text-[12px] lg:text-[16px]">
                <li class="after:content-['/'] after:px-1 lg:after:px-2"><a href="{{route('dashboard.index')}}">صفحه اصلی</a></li>
                <li class="after:content-['/'] after:px-1 lg:after:px-2"><a href="{{route('dashboard.notes.index')}}">لیست یادداشت</a></li>
                <li>{{$note->title}}</li>
            </ul>
        </div>
        <div class="p-4 lg:px-8 lg:py-5 bg-[#F3F7FA] rounded-lg">
            <h1 class="text-[20px] font-bold mb-3">{{$note->title}}</h1>
            <div class="border border-[#C6C6C6] rounded-lg p-3">{!! $note->content !!}</div>
        </div>
    </div>
@endsection
