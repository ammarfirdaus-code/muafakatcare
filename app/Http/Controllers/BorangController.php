<?php

namespace App\Http\Controllers;

use App\Models\PermohonanBantuan;
use App\Models\Sukarelawan;
use Illuminate\Http\Request;

class BorangController extends Controller
{
    public function mohonBantuan(Request $request)
    {
        abort_if($request->filled('laman_web'), 422); // honeypot spam

        $data = $request->validate([
            'nama' => 'required|string|max:120',
            'telefon' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s]{9,20}$/'],
            'kawasan' => 'required|string|max:120',
            'jenis' => 'required|in:Foodbank,Pinjam katil hospital,Bantuan kecemasan,Lain-lain',
            'tanggungan' => 'nullable|integer|min:0|max:30',
            'keterangan' => 'nullable|string|max:2000',
            'setuju' => 'accepted',
        ]);
        unset($data['setuju']);

        PermohonanBantuan::create($data);

        return redirect()->route('terima-kasih');
    }

    public function sukarelawan(Request $request)
    {
        abort_if($request->filled('laman_web'), 422);

        $data = $request->validate([
            'nama' => 'required|string|max:120',
            'telefon' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s]{9,20}$/'],
            'minat' => 'nullable|string|max:1000',
            'setuju' => 'accepted',
        ]);
        unset($data['setuju']);

        Sukarelawan::create($data);

        return redirect()->route('terima-kasih');
    }
}
