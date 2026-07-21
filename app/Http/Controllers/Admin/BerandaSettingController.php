<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BerandaSetting;
use Illuminate\Http\Request;

class BerandaSettingController extends Controller
{
    public function index()
    {
        $settings = BerandaSetting::current();

        return view('admin.beranda-setting.index', compact('settings'));
    }

    public function create()
    {
        return redirect()->route('admin.beranda-setting.index');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.beranda-setting.index');
    }

    public function show($id)
    {
        return redirect()->route('admin.beranda-setting.edit', $id);
    }

    public function edit($id)
    {
        $settings = BerandaSetting::current();

        return view('admin.beranda-setting.edit', compact('settings'));
    }

    public function update(Request $request, $id)
    {
        $settings = BerandaSetting::current();

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
            'catatan_persyaratan' => 'nullable|string',
        ]);
        $settings->update($validated);

        return redirect()
            ->route('admin.beranda-setting.index')
            ->with('success', 'Pengaturan Beranda berhasil diupdate');
    }

    public function destroy($id)
    {
        return redirect()->route('admin.beranda-setting.index');
    }
}