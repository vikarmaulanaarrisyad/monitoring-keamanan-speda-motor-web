<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Relay;
use Illuminate\Http\Request;

class ApiRelayController extends Controller
{
    public function data()
    {
        $query = Relay::all();

        return response()->json(['data' => $query]);
    }

    public function update($id)
    {
        $relay = Relay::findOrfail($id);

        if ($relay->status == 1) {
            // return response()->json(['message' =>  $user->name . ' status aktif.'], 401);
            $relay->update(['status' => 0]);
            return response()->json(['message' =>  $relay->name_relay . ' berhasil disimpan.'], 200);
        } else {
            $relay->update(['status' => 1]);
            return response()->json(['message' =>  $relay->name_relay . ' berhasil disimpan.'], 200);
        }
    }

    public function proses_upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required',
            'keterangan' => 'required',
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');

        // nama file
        echo 'File Name: ' . $file->getClientOriginalName();
        echo '<br>';

        // ekstensi file
        echo 'File Extension: ' . $file->getClientOriginalExtension();
        echo '<br>';

        // real path
        echo 'File Real Path: ' . $file->getRealPath();
        echo '<br>';

        // ukuran file
        echo 'File Size: ' . $file->getSize();
        echo '<br>';

        // tipe mime
        echo 'File Mime Type: ' . $file->getMimeType();

        // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'data_file';

        // upload file
        $file->move($tujuan_upload, $file->getClientOriginalName());
    }
}
