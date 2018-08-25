<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\AWS\AwsS3;

class IndexController extends Controller
{

    public function index(Request $request)
    {
        $this->validate($request, [
            'file' => ['required', 'file', 'image', 'max:10000']
        ]);


        if ($request->hasFile('file')) {
            $image = $request->file('file');

            $s3 = new AwsS3();
            $s3->createBucket();
            $s3->putInBucket($image->getClientOriginalName(), $image->getRealPath());
            $request->session()->flash('status', 'File uploaded successfully!');
        }

        return back();
    }

}