<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public $pathStore = 'public/profile/images';
    public function edit()
    {
        return view('dashboard.profile.edit');
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $user->full_name = $request->get('name');
        $user->email = $request->get('email');

        if ($request->hasFile("profile_img")) {
            $user->image = $this->handleUrlStorage([$request->file('profile_img')], $this->pathStore)[0]['source'];
        }
        if ($request->has('remove')){
            $user->image = null;
        }
        $user->save();
        toast('پروفایل با موفقیت بروز رسانی شد','success');
        return redirect()->back();

    }
}
