<?php
namespace App\Http\AWS;

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\S3\Exception\S3Exception;
use Mockery\Exception;

class AwsS3
{
    private $region = 'eu-west-1';
    private $version = 'latest';
    private $s3Client;
    private $bucketName = 'aws-axway-bucket';

    public function __construct()
    {
        $this->s3Client = new S3Client([
            'profile' => 'default',
            'region' => $this->region,
            'version' => $this->version
        ]);
    }

    /**
     * Create S3 bucket
     * @return boolean
     */
    public function createBucket()
    {
        // Creating S3 Bucket
        try {
            $exists = $this->s3Client->headBucket([
                'Bucket' => $this->bucketName
            ]);

            if (!$exists) {
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