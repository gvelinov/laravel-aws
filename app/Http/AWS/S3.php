<?php
namespace App\Http\AWS;

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\S3\Exception\S3Exception;

class S3
{
    private $s3Client;
    private $bucketName = 'aws-my-bucket-laravel-test';

    public function __construct(S3Client $client)
    {
        $this->s3Client = $client;
    }

    /**
     * @param string $bucketName
     */
    public function setBucketName(string $bucketName): void
    {
        $this->bucketName = $bucketName;
    }

    /**
     * Create S3 bucket
     * @return boolean
     */
    public function createBucket()
    {
        // Creating S3 Bucket
        try {
            try {
                $exists = $this->s3Client->headBucket([
                    'Bucket' => $this->bucketName
                ]);
            } catch (S3Exception $ex) {
                if ($ex->getAwsErrorCode() === 'NotFound' || $ex->getCode() === 404) {
                    $exists = false;
                } else {
                    dd($ex->getMessage());
                }
            }

            if (isset($exists) && !$exists) {
                $this->s3Client->createBucket([
                    'Bucket' => $this->bucketName,
                ]);
            }
        } catch (AwsException $e) {
            // Output error message if fails
            dd($e->getMessage());
        }

        return true;
    }

    /**
     * Upload file to S3 bucket
     * @param $key string name
     * @param $file string file path
     * @return boolean
     */
    public function putInBucket($key, $file)
    {
        try {
            $this->s3Client->putObject([
                'Bucket'     => $this->bucketName,
                'Key'        => $key,
                'SourceFile' => $file,
            ]);
        } catch (S3Exception $e) {
            dd($e->getMessage());
        }

        return true;
    }
}