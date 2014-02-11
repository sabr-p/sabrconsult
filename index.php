<?php
# extraordinay lenghts for a simple cv demo
# does a simple fetch & run of a php script to show the curriculum

interface dataHandler {
    public function storeStuff ($key, $data = null);
    public function getStuff ($key);

}


class internalHandler implements dataHandler {
    private $dataContainer;
    public function internalHandler(){
        $this->dataContainer = array ();
    }

    public function storeStuff($key, $data = null) {
        if ($data !== null) {
            array_merge($this->dataContainer, array( $key => $data));
            return true;
        };
        return false;
    }


    public function getStuff($key){
        if (array_key_exists ($key, $this->dataContainer)) return $this->dataContainer[$key];
        return false; //TODO: what if the value is false itself? should be an exception, leave it for a rainy day
    }


}

class fsHandler {

    static function fileDirectServe( $file, $path = null ) {
        //direct to output, quick and dirty!!!  :D
        $filePath = '';
        $filePath = $path ? $path.'/'.$file : dirname(__FILE__).'/'.$file;
        readfile( $filePath );
    }

    static function fileStore() {

    }


}

class httpRouter {

    //the response parameter should not really be used, just future-proofing
    static function reqHandler( $request, &$response = null ) {
        $status = 126;
//        print( "GOT THIS:" . $request);
        if (preg_match('/\.(?:html|js|css|png|jpeg|gif|doc|odt|pdf)$/', $request)) {
            // deliver file, exit 0 to system
            $reqBits = preg_split('/\./', $request);
            self::setHeaders( $reqBits[1] );
            fsHandler::fileDirectServe( $request );
            $status = 0;
        } else {

            self::setHeaders( 'html' );
            fsHandler::fileDirectServe( 'index.html' );
            $status = 0;
        }
        return $status;
    }

    static function setHeaders( $type ) {
        $headers = array();
        switch ( $type) {
            case 'html':
                $headers += array('text/html');
                break;
            case 'css':
                $headers += array('text/css');
                break;
            case 'js':
                $headers += array('application/javascript');
                break;
            case 'doc':
            case 'odt':
            case 'pdf':
            case 'zip':
                $headers += array('application/octet-stream');
                break;
            default:
                $headers += array('text/plain');
        }
        foreach ($headers as $key => $header) {
            header("Content-Type: $header");
        }

    }

}

class appKernel {
    protected $insideRouter = null,
            $dataHandler = null;

    function __construct() {
        $this->insideRouter = new httpRouter();
        $this->dataHandler = new internalHandler();
    }

    function kernelRun() {
        $responseStatus = 126;
        if( !isset($_SERVER["REQUEST_URI"]) ) {
            print("not a valid request!!");
            return $responseStatus; //abnormal exit, cuts off any other execution
        }

        $response =  '';
        $responseStatus = $this->insideRouter->reqHandler($_SERVER["REQUEST_URI"], $response);
        print $response;
        return $responseStatus;
    }
}

//print(dirname(__FILE__));
$kernel = new appKernel();
$kernel->kernelRun();

?>