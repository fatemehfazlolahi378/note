<div class="grid grid-cols-12 items-center text-center paginate_items bg-[#F3F7FA] py-3 shadow w-100 mt-4 text-sm rounded-lg">
    <div class="">
        @if ($paginator->lastPage() != $paginator->currentPage())
            <a href="{{$paginator->nextPageUrl()}}">
                <i class="fa fa-angle-right"></i>
            </a>
        @else
            <a disabled class="dis-arrow">
                <i class="fa fa-angle-right"></i>
            </a>
        @endif
    </div>
    <div class="col-span-2">
        <p> صفحه : {{ $paginator->currentPage() }} </p>
    </div>
    <div class="">
        @if ($paginator->currentPage() > 1)
            <a href="{{$paginator->previousPageUrl()}}">
                <i class="fa fa-angle-left"></i>
            </a>
        @else
            <a disabled class="dis-arrow">
                <i class="fa fa-angle-left"></i>
            </a>
        @endif
    </div>
    <div class="col-span-2">
        <p>صفحات : {{$paginator->lastPage()}}</p>
    </div>
    <div class="col-span-3">
        <p>تعداد : {{$paginator->total()}}</p>
    </div>
    <div class="col-span-3">
        <label for="">تعداد نمایش : </label>
        <select class="perPage_item w-[60px] rounded-lg focus:ring-0 focus:border-black" id="perPage"
                onchange="location.assign(location.pathname + '?' + 'perPage=' + $(this).val())">
            <option @if (request()->has('perPage') && request()->get('perPage') == 10) selected
                    @endif value="10">{{10}}</option>
            <option @if (request()->has('perPage') && request()->get('perPage') == 20) selected
                    @endif value="20">{{20}}</option>
            <option @if (request()->has('perPage') && request()->get('perPage') == 50) selected
                    @endif value="50">{{50}}</option>
        </select>
    </div>
</div>
