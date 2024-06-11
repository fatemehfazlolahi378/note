@extends('desktop.master')
@section('content')
        <div class="modal-body sm:w-[620px] 400:w-[367px] w-[300px] h-fit m-auto bg-white sm:px-[47px] px-[25px] sm:py-[45px] py-[28px] rounded-[10px]">
            <form class="mobile-box flex flex-col sm:gap-y-[56px] gap-y-[32px]">
                <h3 class="font-bold sm:text-[24px] text-[20px] text-center">ورود</h3>
                <div class="flex flex-col gap-y-[13px] relative">
                    <label for="" class="sm:text-[16px] text-[14px]">نام  نام خانوادگی</label>
                    <input name="full_name" class="w-[100%] sm:h-[48px] h-[38px] rounded-[8px] bg-[#fff] sm:p-[20px] p-[10px] border border-[#8A8A8A] focus:border-[#2D6A4F] focus:ring-0">
                    <label class="sm:text-[16px] text-[14px]">شماره موبایل خود را وارد کنید </label>
                    <input name="mobile" id="input-mobile" dir="ltr" class="w-[100%] sm:h-[48px] h-[38px] rounded-[8px] bg-[#fff] sm:p-[20px] p-[10px] border border-[#8A8A8A] sm:text-[16px] text-[14px] focus:border-[#2D6A4F] focus:ring-0 @error('mobile') is-invalid @enderror " placeholder="شماره موبایل : 091xxxxxxxx"
                           value="{{old('mobile')}}" autocomplete="off" maxlength="11" minlength="11" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')">
                    <div id="tooltip-default" role="tooltip" class="flex absolute before:absolute before:content-[''] before:w-[8px] before:h-[8px] before:bg-[#050708] before:top-[65px] 400:before:top-[48px] sm:before:top-[32px] before:right-[73px] 400:before:right-[110px] sm:before:right-[157px] before:rotate-[224deg] right-[90px] sm:top-[-5px] 400:top-[-30px] top-[-42px] text-[12px] text-center z-10 invisible inline-block px-3 py-2 sm:text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                        کیبورد را درحالت انگلیسی قرار دهید
                        و فقط عدد وارد کنید.
                    </div>
                </div>
                <div class="flex justify-center items-center gap-x-[66px]">
                    <button id="btn-submit-mobile" type="button" class="bg-[#52B788] sm:w-[152px] w-[95px] sm:h-[48px] h-[38px] sm:text-[16px] text-[14px] rounded-[8px]">ورود</button>
                    <button class="btn-close border border-[#52B788] sm:w-[152px] w-[95px] sm:h-[48px] h-[38px] sm:text-[16px] text-[14px] rounded-[8px] hover:bg-[#52B788]">انصراف</button>
                </div>
            </form>
        </div>
@endsection
