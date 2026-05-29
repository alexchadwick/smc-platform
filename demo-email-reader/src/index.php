<?php
/**
 * Demo EmailReader Console App
 * Tory Chadwick
 * torychadwick@icloud.com
 * 2023
 */

class EmailForwardRequest {

    /**
     * @var array|null
     */
    private array $_groups;

    /**
     * @var string|null
     */
    private string $_content;

    /**
     * @var string|null
     */
    private string $_subject;

    /**
     * Get
     * @return array
     */
    public function get(){
        return [
            'groups' => $this->_groups,
            'content' => $this->_content,
            'subject' => $this->_subject,
        ];
    }

    /**
     * __construct
     * @param array $groups
     * @param string $content
     * @param string $subject
     */
    public function __construct(array $groups, string $content, string $subject)
    {
        $this->_groups = $groups ?? null;
        $this->_content = $content ?? null;
        $this->_subject = $subject ?? null;
    }
}
class EmailForward {

    public function getGroupsFromsubject(string $str) {
        //forward slashes are the start and end delimiters
        //third parameter is the array we want to fill with matches
        $result = preg_match('/"([^"]+)"/', $str, $m);
        if($result) {
            $results = explode(',', $m[1]);
            array_walk_recursive($results, function(&$arrValue, $arrKey){ $arrValue = trim($arrValue);});
            $results = array_filter($results);
            return $results;
        }
        return null;
    }

    private function foward($message, $subject, $groups){
        //
    }



}
class EmailReader {

    // imap server connection
    public $conn;

    // inbox storage and inbox message count
    private $inbox;
    private $msg_cnt;

    // email login credentials
    private $server = 'yourserver.com';
    private $user   = 'email@yourserver.com';
    private $pass   = 'yourpassword';
    private $port   = 143; // adjust according to server settings

    // connect to the server and get the inbox emails
    function __construct() {
        $this->connect();
        $this->inbox();
    }



    // close the server connection
    function close() {
        $this->inbox = array();
        $this->msg_cnt = 0;

        imap_close($this->conn);
    }

    // open the server connection
    // the imap_open function parameters will need to be changed for the particular server
    // these are laid out to connect to a Dreamhost IMAP server
    /**
     * Connect
     * @return void
     */
    function connect() {
        $this->conn = imap_open('{'.$this->server.'/notls}', $this->user, $this->pass);
    }

    /**
     * Move the message to a new folder
     * @param $msg_index
     * @param $folder
     * @return void
     */
    function move($msg_index, $folder='INBOX.Processed') {
        // move on server
        imap_mail_move($this->conn, $msg_index, $folder);
        imap_expunge($this->conn);

        // re-read the inbox
        $this->inbox();
    }

    /**
     * get a specific message (1 = first email, 2 = second email, etc.)
     * @param $msg_index
     * @return array|mixed
     */
    function get($msg_index=NULL) {
        if (count($this->inbox) <= 0) {
            return array();
        }
        elseif ( ! is_null($msg_index) && isset($this->inbox[$msg_index])) {
            return $this->inbox[$msg_index];
        }

        return $this->inbox[0];
    }

    /**
     * read the Inbox
     * @return void
     */
    function inbox() {
        $this->msg_cnt = imap_num_msg($this->conn);

        $in = array();
        for($i = 1; $i <= $this->msg_cnt; $i++) {
            $attachments = $this->_getEmailAttachments($this->conn, $i);
            $in[] = array(
                'index'     => $i,
                'header'    => imap_headerinfo($this->conn, $i),
                'body'      => imap_body($this->conn, $i),
                'structure' => imap_fetchstructure($this->conn, $i),
                'attachments' => $attachments
            );
        }

        $this->inbox = $in;
    }

    private $attachmentStoragePath = "./";

    /**
     * _getEmailAttachments
     * @param $inbox
     * @param $email_number
     * @return array
     */
    private function _getEmailAttachments($inbox, $email_number) {
        //Get Attachments
        /* get mail structure */
        $structure = imap_fetchstructure($inbox, $email_number);

        $attachments = array();

        /* if any attachments found... */
        if(isset($structure->parts) && count($structure->parts))
        {
            for($i = 0; $i < count($structure->parts); $i++)
            {
                $attachments[$i] = array(
                    'is_attachment' => false,
                    'filename' => '',
                    'name' => '',
                    'attachment' => ''
                );

                if($structure->parts[$i]->ifdparameters)
                {
                    foreach($structure->parts[$i]->dparameters as $object)
                    {
                        if(strtolower($object->attribute) == 'filename')
                        {
                            $attachments[$i]['is_attachment'] = true;
                            $attachments[$i]['filename'] = $object->value;
                        }
                    }
                }

                if($structure->parts[$i]->ifparameters)
                {
                    foreach($structure->parts[$i]->parameters as $object)
                    {
                        if(strtolower($object->attribute) == 'name')
                        {
                            $attachments[$i]['is_attachment'] = true;
                            $attachments[$i]['name'] = $object->value;
                        }
                    }
                }

                if($attachments[$i]['is_attachment'])
                {
                    $attachments[$i]['attachment'] = imap_fetchbody($inbox, $email_number, $i+1);

                    /* 3 = BASE64 encoding */
                    if($structure->parts[$i]->encoding == 3)
                    {
                        $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                    }
                    /* 4 = QUOTED-PRINTABLE encoding */
                    elseif($structure->parts[$i]->encoding == 4)
                    {
                        $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
                    }
                }
            }
        }

        /* iterate through each attachment and save it */
        foreach($attachments as $attachment)
        {
            if($attachment['is_attachment'] == 1)
            {
                $filename = $attachment['name'];
                if(empty($filename)) $filename = $attachment['filename'];

                if(empty($filename)) $filename = time() . ".dat";
                $folder = "attachment";
                if(!is_dir($folder))
                {
                    mkdir($folder);
                }

                $fp = fopen($this->attachmentStoragePath. $folder ."/". $email_number . "-" . $filename, "w+");
                fwrite($fp, $attachment['attachment']);
                fclose($fp);
            }
        }

        return $attachments;
        //END -- Get Attachments
    }

}

//!## - ================================

//..
$app = new EmailForward();
$subject = 'test subject "testgroup1, testgroup2, testgroup3"';
$content = 'testing';
$results = $app->getGroupsFromsubject($subject);
preg_match('/"([^"]+)"/', $subject, $m);
//..
$req = new EmailForwardRequest(
    $results ,
    $content,
    trim(str_replace('"'.$m[1].'"', '', $subject))
);
//..
print_r(

    $req->get()
);
print_r([

    $results
]);
exit();