<?php
/**
 * Demo Google Cloud Translate Console App
 * Tory Chadwick
 * torychadwick@icloud.com
 * 2023
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__ . '/../vendor/autoload.php';

use Google\Cloud\Translate\V3\TranslationServiceClient;

/**
 * App Class
 */
class App {

    private $targetLanguage = 'ar';
    private $projectId = 'spring-cab-377313';
    private $resroucePath = null;
    private $keyFilePath = null;
    private $keyFilePathAbs = null;

    /**
     * __construct
     */
    public function __construct()
    {

        $rPath = __DIR__ . '/../resources/test.pdf';
        $absPath = "/Users/finaodev/Projects/Master/Steves/smc-platform/demo-google-cloud-translate/spring-cab-377313-5293968e24ad.json";
        $path = __DIR__ . '/../spring-cab-377313-5293968e24ad.json';
        if(!file_exists($path)){
            throw new \Exception(
                'Can\'t find file: '.$path
            );
        }
        if(!file_exists($absPath)){
            throw new \Exception(
                'Can\'t find file via abs. path: '.$absPath
            );
        }
        if(!file_exists($rPath)){
            throw new \Exception(
                'Can\'t find file via res. path: '.$rPath
            );
        }
        $this->keyFilePath = $path;
        $this->keyFilePathAbs = $absPath;
        $this->resroucePath = $rPath;

    }

    private function _createNewFile($data){
        //Save string to log, use FILE_APPEND to append.
        function guidv4($data)
        {
            assert(strlen($data) == 16);

            $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        }
        file_put_contents('./new_'.date("j.n.Y").guidv4(openssl_random_pseudo_bytes(16)).'.pdf', $data);
    }

    private function _log(string $log){
        //Save string to log, use FILE_APPEND to append.
        file_put_contents('./log_'.date("j.n.Y").'.txt', $log, FILE_APPEND);
    }

    private function _testDocumentTranslation(TranslationServiceClient $translationClient){
        //Translate document
        $config = new \Google\Cloud\Translate\V3\DocumentInputConfig([
            'content' => file_get_contents($this->resroucePath),
            'mime_type' => 'application/pdf'
        ]);

        //View response
        $output = $translationClient->translateDocument(
            TranslationServiceClient::locationName($this->projectId, 'global'),
            $this->targetLanguage,
            $config
        );

        $raw = $output->getDocumentTranslation()->getByteStreamOutputs()[0];
        $this->_createNewFile($raw);
        //$this->_log((string )$output);
    }
    private function _testTextTranslation(TranslationServiceClient $translationClient){
        //Translate text
        $content = ['<div><h4>Hello</h4>Hello World</div>'];

        $response = $translationClient->translateText(
            $content,
            $this->targetLanguage,
            TranslationServiceClient::locationName($this->projectId, 'global')
        );
        //View response
        foreach ($response->getTranslations() as $key => $translation) {
            $separator = $key === 2
                ? '!'
                : ', ';
            $this->_log($translation->getTranslatedText() . $separator);
            echo $translation->getTranslatedText() . $separator;
        }

    }
    /**
     * Run hanlder
     * @return void
     * @throws \Google\ApiCore\ApiException
     */
    private function _run(){

        putenv("GOOGLE_APPLICATION_CREDENTIALS=". $this->keyFilePath);
        //Get client
        $translationClient = new TranslationServiceClient([
            'projectId' => $this->projectId,
            //'keyFilePath' => $this->keyFilePath

        ]);
        //$translationClient->useApplicationDefaultCredentials();

        try {

            //Text
            $this->targetLanguage = 'ar';
            $this->_testTextTranslation($translationClient);
            //$this->_testDocumentTranslation($translationClient);

        } catch (\Exception $exception) {
            //$this->_log($exception->getMessage());
            //echo PHP_EOL. json_encode($exception->getMessage(), JSON_PRETTY_PRINT) . PHP_EOL;
        }

        //echo json_encode($output, JSON_PRETTY_PRINT);


    }

    /**
     * Run app command
     * @return void
     */
    public function run(){
        $this->_run();
    }

}

//## - ===============================

//init
$app = new App();

$app->run();
exit();