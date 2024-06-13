@extends('desktop.master')
@section('content')
    <div class="flex flex-col items-center justify-center h-[100vh]">
        <h1 class="text-center text-[30px] py-3">یادداشت نویسی</h1>
        <div class="w-[700px] h-[500px] mx-auto">
            <img src="{{asset('./images/background.jpg')}}" class="w-full h-full">
        </div>
        <button class="btn-login-modal flex justify-center items-center xl:w-[146px] w-[125px] xl:h-[42px] h-[40px] xl:text-[16px] text-[14px] bg-[#D8F3DC] rounded-[10px] border-2 border-[#2D6A4F] text-[#1B4332] hover:bg-[#2D6A4F] hover:text-[#fff] my-5"> ثبت نام / ورود</button>
    </div>
@endsection
