<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BerandaSetting;
use Illuminate\Http\Request;

class BerandaSettingController extends Controller
{
    public function edit()
    {
        $settings = BerandaSetting::current();

        return view('admin.beranda-setting.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = BerandaSetting::current();

        // 1. validasi form dulu
        $validated = $request->validate([
    'hero_badge_text'     => 'required|string',
    'hero_main_title'     => 'required|string',
    'hero_sub_title'      => 'required|string',
    'hero_academic_year'  => 'required|string',
    'hero_date_label'     => 'required|string',
    'hero_date_value'     => 'required|string',
    'hero_logo_sub'       => 'nullable|string',
    'instagram_url'       => 'nullable|url',
    'instagram_handle'    => 'nullable|string',
    'whatsapp_number'     => 'nullable|string',
    'welcome_heading'     => 'required|string',
    'welcome_paragraph_1' => 'required|string',
    'welcome_paragraph_2' => 'required|string',
    'welcome_paragraph_3' => 'required|string',
    'address'             => 'nullable|string',
    'phone'               => 'nullable|string',
    'website_url'         => 'nullable|url',
    'email'               => 'nullable|email',
]);
        // 2. update data ke db
        $settings->update($validated);

        // 3. redirect balik ke halaman edit
        return redirect()
            ->route('admin.beranda-setting.edit')
            ->with('success', 'Pengaturan Beranda berhasil diupdate');
    }
}