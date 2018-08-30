<?php

namespace App\Http\Controllers\AWS;

use App\Http\AWS\S3;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class S3Controller extends Controller
{
    /**
     * The AWS SDK S3 Client.
     */
    private $awsS3;

    /**
     * Create a new controller instance.
     *
     * @param $sdk
     * @return void
     */
    public function __construct(S3 $sdk)
    {
        $this->awsS3 = $sdk;
        $this->awsS3->setBucketName('my-aws-laravel-test-bucket');
    }

    public function index()
    {
        return view('s3.upload');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' => ['required', 'file', 'image', 'max:10000']
        ]);


        if ($request->hasFile('file')) {
            $image = $request->file('file');


            $this->awsS3->createBucket();
            $this->awsS3->putInBucket($image->getClientOriginalName(), $image->getRealPath());
            $request->session()->flash('status', 'File uploaded successfully!');
        }

        return back();
    }

}