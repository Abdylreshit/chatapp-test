<?php

namespace App\Http\Controllers;

use App\Excel\MessageImport;
use App\Models\License;
use App\Models\Messenger;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DistributionCreate extends Controller
{
    public function __invoke(Request $request)
    {
        // dd($request->all());
        $user = auth()->user();
        $license = License::find($request->license_id);
        $messenger = Messenger::find($request->messenger_id);

        if(request()->file('excel')) {
            $file = $request->file('excel')->store('temp');
            $path = storage_path('app') . '/' . $file;
            Excel::import(new MessageImport($user, $messenger, $license, $request->cookie('accessToken')), $path);
        }

        return redirect()->back();
    }
}
