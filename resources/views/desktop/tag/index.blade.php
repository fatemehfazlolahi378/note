@extends('desktop.master')
@section('content')
    <div class="tag-index p-4 lg:p-8">
        <div class="flex justify-between lg:py-4">
            <ul class="flex items-center text-[12px] lg:text-[16px]">
                <li class="after:content-['/'] after:px-1 lg:after:px-2"><a href="{{route('desktop.index')}}">صفحه اصلی</a></li>
                <li> لیست برچسب ها</li>
            </ul>
            <a href="{{route('desktop.tags.create')}}" class="flex items-center justify-center lg:w-[150px] w-[130px] xl:h-[45px] h-[40px] xl:leading-[45px] leading-[40px] bg-[#326273] text-white text-[12px] lg:text-sm rounded-[8px]"><span class="fa fa-plus ml-1"></span>افزودن برچسب جدید</a>
        </div>
        <div class="p-4 lg:px-8 lg:py-5 bg-[#F3F7FA] rounded-lg">
            <h3 class="text-[14px] lg:text-[16px]">لیست برچسب ها</h3>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-right rtl:text-right text-gray-500 my-3">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-4 text-center">
                            #
                        </th>
                        <th scope="col" class="px-6 py-4 text-center">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-4 text-center">
                            نام برچسب
                        </th>
                        <th scope="col" class="px-6 py-4 text-center">
                            عملیات
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tags as $index=>$tag)
                        <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b">
                            <th scope="row" class="px-6 py-4 text-center font-medium text-gray-900 whitespace-nowrap">
                                {{$tags->firstItem() + $index}}
                            </th>
                            <td class="px-6 py-4 text-center">
                                {{$tag->id}}
                            </td>
                            <td class="px-6 py-4 text-center">
                                {{$tag->name}}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown{{$index}}" class="lg:w-[110px] sm:w-[100px] w-[90px] lg:h-[40px] h-[35px] lg:leading-[40px] leading-[35px] bg-[#cdd7d6] border border-lime-700 text-lime-700 text-sm rounded-[8px]"> عملیات <span class="fa fa-caret-down mr-1"></span></button>
                                <!-- Dropdown menu -->
                                <div id="dropdown{{$index}}" class="z-10 hidden absolute bg-white divide-y divide-gray-100 rounded-lg shadow w-44">
                                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdownDefaultButton">
                                        <li>
                                            <a href="{{route('desktop.tags.edit', $tag)}}" class="flex items-center justify-start gap-1 px-4 py-2 hover:bg-gray-100 text-lime-700"><span class="fa fa-edit ml-1"></span>ویرایش</a>
                                        </li>
                                        <li>
                                            <button type="button" data-id="{{$tag->id}}" data-title="{{$tag->name}}" class="delete w-full flex items-center justify-start gap-1 px-4 py-2 hover:bg-gray-100 text-rose-700"><span class="fa fa-trash ml-1"></span>حذف</button>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{$tags->links('desktop.include.pagination')}}
    </div>
@endsection
