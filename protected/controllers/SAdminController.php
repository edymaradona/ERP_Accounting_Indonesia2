<?php

class SAdminController extends Controller
{

    public $layout = '//layouts/column1';

    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ],
        ];
    }

    public function filters()
    {
        return [
            'rights',
        ];
    }

    public function actionEmailTemplate()
    {
        if (!in_array('peterjkambey@gmail.com1', require(dirname(__FILE__) . '/../config/blacklistEmail.php'))) {
            $body = EmailComponent::template('template001', 'Peter J. Kambey');
        }
        echo $body;
    }

    public function actionReadExcel()
    {
        $this->render('readExcel', [
        ]);
    }

    public function actionGrid()
    {
        $this->render('grid', [
        ]);
    }

    public function actionSoap() {
        $url = "http://healthcare.panfic.com/hisys/webservice.asmx/claim_status?user_name=priyo.apg&password=apg123&policy_no=201406010600676&member_id=00001354-1&plan=OP";

        $client = new SoapClient("http://www.webservicex.com/globalweather.asmx?wsdl");
        var_dump($client->__getFunctions()); 
        var_dump($client->__getTypes()); 

    }

    public function actionClaimStatus() {
        $url = "http://healthcare.panfic.com/hisys/webservice.asmx/claim_status?user_name=priyo.apg&password=apg123&policy_no=201406010600676&member_id=00001354-1&plan=OP";

       $response_xml_data = file_get_contents($url);
       //libxml_use_internal_errors(true);
       $data = simplexml_load_string($response_xml_data);

        $xmlNode = simplexml_load_file($data);
        $arrayData = $this->xmlToArray($xmlNode);
        echo json_encode($arrayData);
    }

    public function actionNewX() {

        $url = "http://healthcare.panfic.com/hisys/webservice.asmx/claim_status?user_name=priyo.apg&password=apg123&policy_no=201406010600676&member_id=00001354-1&plan=OP";
        $sXML = $this->download_page($url);
        $sXML = str_replace('diffgr:diffgram',"diffgrdiffgram",$sXML);
        $sXML = str_replace(array("\n", "\r", "\t"), '', $sXML);
        $sXML = trim(str_replace('"', "'", $sXML));
        //echo $sXML;
        //die;
        //$oXML = new SimpleXMLElement($sXML);
        $oXML = simplexml_load_string($sXML);

        foreach($oXML->dataset->children() as $oEntry){
            echo $oEntry . "\n";
        }

    }


    public function download_page($path){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$path);
        curl_setopt($ch, CURLOPT_FAILONERROR,1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        $retValue = curl_exec($ch);          
        curl_close($ch);
        return $retValue;
    }

    private function xmlToArray($xml, $options = array()) {
        $defaults = array(
            'namespaceSeparator' => ':',//you may want this to be something other than a colon
            'attributePrefix' => '@',   //to distinguish between attributes and nodes with the same name
            'alwaysArray' => array(),   //array of xml tag names which should always become arrays
            'autoArray' => true,        //only create arrays for tags which appear more than once
            'textContent' => '$',       //key used for the text content of elements
            'autoText' => true,         //skip textContent key if node has no attributes or child nodes
            'keySearch' => false,       //optional search and replace on tag and attribute names
            'keyReplace' => false       //replace values for above search values (as passed to str_replace())
        );
        $options = array_merge($defaults, $options);
        $namespaces = $xml->getDocNamespaces();
        $namespaces[''] = null; //add base (empty) namespace
     
        //get attributes from all namespaces
        $attributesArray = array();
        foreach ($namespaces as $prefix => $namespace) {
            foreach ($xml->attributes($namespace) as $attributeName => $attribute) {
                //replace characters in attribute name
                if ($options['keySearch']) $attributeName =
                        str_replace($options['keySearch'], $options['keyReplace'], $attributeName);
                $attributeKey = $options['attributePrefix']
                        . ($prefix ? $prefix . $options['namespaceSeparator'] : '')
                        . $attributeName;
                $attributesArray[$attributeKey] = (string)$attribute;
            }
        }
     
        //get child nodes from all namespaces
        $tagsArray = array();
        foreach ($namespaces as $prefix => $namespace) {
            foreach ($xml->children($namespace) as $childXml) {
                //recurse into child nodes
                $childArray = xmlToArray($childXml, $options);
                list($childTagName, $childProperties) = each($childArray);
     
                //replace characters in tag name
                if ($options['keySearch']) $childTagName =
                        str_replace($options['keySearch'], $options['keyReplace'], $childTagName);
                //add namespace prefix, if any
                if ($prefix) $childTagName = $prefix . $options['namespaceSeparator'] . $childTagName;
     
                if (!isset($tagsArray[$childTagName])) {
                    //only entry with this key
                    //test if tags of this type should always be arrays, no matter the element count
                    $tagsArray[$childTagName] =
                            in_array($childTagName, $options['alwaysArray']) || !$options['autoArray']
                            ? array($childProperties) : $childProperties;
                } elseif (
                    is_array($tagsArray[$childTagName]) && array_keys($tagsArray[$childTagName])
                    === range(0, count($tagsArray[$childTagName]) - 1)
                ) {
                    //key already exists and is integer indexed array
                    $tagsArray[$childTagName][] = $childProperties;
                } else {
                    //key exists so convert to integer indexed array with previous value in position 0
                    $tagsArray[$childTagName] = array($tagsArray[$childTagName], $childProperties);
                }
            }
        }
     
        //get text content of node
        $textContentArray = array();
        $plainText = trim((string)$xml);
        if ($plainText !== '') $textContentArray[$options['textContent']] = $plainText;
     
        //stick it all together
        $propertiesArray = !$options['autoText'] || $attributesArray || $tagsArray || ($plainText === '')
                ? array_merge($attributesArray, $tagsArray, $textContentArray) : $plainText;
     
        //return node as array
        return array(
            $xml->getName() => $propertiesArray
        );
    }

    public function actionSqlStatement()
    {
        $model = new fSqlStatement;
        if (isset($_POST['fSqlStatement'])) {
            $model->attributes = $_POST['fSqlStatement'];
            if ($model->validate()) {
                $commandD = Yii::app()->db->createCommand($model->sql);
                $commandD->execute();
                Yii::app()->user->setFlash('success', 'SQL statement has been executed');
                $this->refresh();
            }
        }
        $this->render('sqlstatement', ['model' => $model]);
    }

    public function actionBackup()
    {
        Yii::import('SDatabaseDumper');
        $dumper = new SDatabaseDumper;
        // Get path to new backup file
        $file = Yii::getPathOfAlias('webroot.protected.backups') . '/dump.' . Yii::app()->dateFormatter->format("yyyyMMdd", time()) . '.sql';
        // Gzip dump
        if (function_exists('gzencode'))
            file_put_contents($file . '.gz', gzencode($dumper->getDump()));
        else
            file_put_contents($file, $dumper->getDump());
        Yii::app()->user->setFlash('success', '<strong>Great!</strong> backup process finished..');
        $this->redirect(['/menu']);
    }

    public function actionCall1()
    {
        try {
            $api = new PhpSIP('202.153.128.34'); // IP we will bind to
            $api->setMethod('MESSAGE');
            $api->setFrom('sip:peterjkambey@voiprakyat.or.id');
            $api->setUri('sip:sicc1@voiprakyat.or.id');
            $api->setBody('Hi, ....');
            $res = $api->send();
            echo "res1: $res\n";
        } catch (Exception $e) {
            echo $e->getMessage() . "\n";
        }
    }

    public function actionCall2()
    {
        try {
            $api = new PhpSIP(); // IP we will bind to
            $api->setUsername('118338'); // authentication username
            $api->setPassword('55XI8N'); // authentication password
            $api->setProxy('202.153.128.34');
            $api->addHeader('Event: resync');
            $api->setMethod('NOTIFY');
            $api->setFrom('sip:118338@voiprakyat.or.id');
            $api->setUri('sip:118339@voiprakyat.or.id');
            $res = $api->send();
            echo "res1: $res\n";
        } catch (Exception $e) {
            echo $e->getMessage() . "\n";
        }
    }

    public function actionChatFB()
    {
        $obj = new FacebookChat("peterjkambey@yahoo.co.id", ".....");
        $obj->login();
        print_r($obj->buddylist());
        $obj->sendmsg("Hey jhonny, how are u?", "my_friend_id");
    }

    public function actionChatTest() {

        $this->render('chatTest');

    }

    public function actionChat() {

        $this->render('chat');

    }

    public function actionGraph1()
    {
        /* $bars = array(41,52,53,12,85,61,53,8,79,10,92,36);
          $graph = new Chart();
          $graph->addBars($bars, 'ff0000');
          $graph->output();
          $graph->output('filename.png'); */
        $bars = [5, 5, 5, 1, 8, 6, 5, 8, 7, 1, 2, 3];
        $dates = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $graph = new Chart();
        $graph->addBars($bars, 'ff0000');
        $graph->addXLabels($dates, '000000');
        $graph->addYScale('000000');
        $graph->output();
    }

    public function actionGraph2()
    {
        /* Create and populate the pData object */
        $MyData = new pData();
        $MyData->addPoints([13251, 4118, 3087, 1460, 1248, 156, 26, 9, 8], "Hits");
        $MyData->setAxisName(0, "Hits");
        $MyData->addPoints(["Firefox", "Chrome", "Internet Explorer", "Opera", "Safari", "Mozilla", "SeaMonkey", "Camino", "Lunascape"], "Browsers");
        $MyData->setSerieDescription("Browsers", "Browsers");
        $MyData->setAbscissa("Browsers");
        /* Create the pChart object */
        $myPicture = new pImage(500, 500, $MyData);
        $myPicture->drawGradientArea(0, 0, 500, 500, DIRECTION_VERTICAL, ["StartR" => 240, "StartG" => 240, "StartB" => 240, "EndR" => 180, "EndG" => 180, "EndB" => 180, "Alpha" => 100]);
        $myPicture->drawGradientArea(0, 0, 500, 500, DIRECTION_HORIZONTAL, ["StartR" => 240, "StartG" => 240, "StartB" => 240, "EndR" => 180, "EndG" => 180, "EndB" => 180, "Alpha" => 20]);
        $myPicture->setFontProperties(["FontName" => "../fonts/pf_arma_five.ttf", "FontSize" => 6]);
        /* Draw the chart scale */
        $myPicture->setGraphArea(100, 30, 480, 480);
        $myPicture->drawScale(["CycleBackground" => TRUE, "DrawSubTicks" => TRUE, "GridR" => 0, "GridG" => 0, "GridB" => 0, "GridAlpha" => 10, "Pos" => SCALE_POS_TOPBOTTOM]); //
        /* Turn on shadow computing */
        $myPicture->setShadow(TRUE, ["X" => 1, "Y" => 1, "R" => 0, "G" => 0, "B" => 0, "Alpha" => 10]);
        /* Draw the chart */
        $myPicture->drawBarChart(["DisplayPos" => LABEL_POS_INSIDE, "DisplayValues" => TRUE, "Rounded" => TRUE, "Surrounding" => 30]);
        /* Write the legend */
        $myPicture->drawLegend(570, 215, ["Style" => LEGEND_NOBORDER, "Mode" => LEGEND_HORIZONTAL]);
        /* Render the picture (choose the best way) */
        $myPicture->autoOutput("pictures/example.drawBarChart.vertical.png");
    }

    public function actionBarcode()
    {
        $this->render('barcode');
    }

    public function actionHelp()
    { //OK BANGET tapi sayangnya masih Port 25
        $model = new fEmail('help');
        if (isset($_POST['fEmail'])) {
            $model->attributes = $_POST['fEmail'];
            if ($model->validate()) {
                if ($message = EmailComponent::sendEmail('peterjkambey@gmail.com', $model->subject, $model->body)) {
                    Yii::app()->user->setFlash('success', '<strong>Great!</strong> Your Message has been sent...');
                    //echo $message->errorInfo;
                } else
                    //Yii::app()->user->setFlash('error', '<strong>Error Bro!</strong> Your Message has not been sent...');
                    echo $message->errorInfo;

                //$this->redirect(array('/menu'));
            }
        }
        $this->render('help', ['model' => $model]);
    }

    public function actionTableFpdf()
    {
        $pdf = new mc_table();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 14);
        //Table with 20 rows and 4 columns
        $pdf->SetWidths([30, 50, 30, 40]);
        srand(microtime() * 1000000);
        for ($i = 0; $i < 20; $i++)
            $pdf->Row([$this->GenerateSentence(), $this->GenerateSentence(), $this->GenerateSentence(), $this->GenerateSentence()]);
        $pdf->Output();
    }

    private function GenerateWord()
    {
        //Get a random word
        $nb = rand(3, 10);
        $w = '';
        for ($i = 1; $i <= $nb; $i++)
            $w .= chr(rand(ord('a'), ord('z')));
        return $w;
    }

    private function GenerateSentence()
    {
        //Get a random sentence
        $nb = rand(1, 10);
        $s = '';
        for ($i = 1; $i <= $nb; $i++)
            $s .= $this->GenerateWord() . ' ';
        return substr($s, 0, -1);
    }

    public function actionCode39()
    {
        $pdf = new PDF_Code39();
        $pdf->AddPage();
        $pdf->Code39(80, 40, 'PETERKAMBEY', 1, 10);
        $pdf->Output();
    }

    public function actionContact()
    {
        //$model=new ContactForm;
        //if(isset($_POST['ContactForm']))
        //{
        //	$model->attributes=$_POST['ContactForm'];
        //	if($model->validate())
        //	{
        $headers = "From: Peter J. Kambey\r\nReply-To: peterjkambey@gmail.com";
        mail(Yii::app()->params['adminEmail'], 'Testing Subject', 'Testing Body', $headers);
        Yii::app()->user->setFlash('success', '<strong>Great!</strong> Your Message has been sent...');
        $this->redirect(['/menu']);
        //	}
        //}
        //$this->render('contact',array('model'=>$model));
    }

    public function actionFlush()
    {
        Yii::app()->cache->flush();
        $this->redirect(['/menu']);
    }

    public function actionFormWithFile()
    {
        $form = new fPhoto();
        if (Yii::app()->request->getParam('title')) {
            $form->attributes = Yii::app()->request->getParam('title');
            $form->fileField = UploadedFile::getInstanceByName("fPhoto[title]");
            if ($form->validate()) {
                $form->fileField->saveAs(dirname(__FILE__) . '/../files/tmp.txt');
            }
        }
    }


    public function actionMailIndex()
    {

        Yii::import('application.vendors.*');
        require_once('Zend/Mail.php');
        require_once('Zend/Mail/Transport/Smtp.php');
        require_once('Zend/Mail/Protocol/Smtp/Auth/Login.php');

        //$config = array('ssl' => 'tls', 'port' => 587, 'auth' => 'login', 'username' => 'webmaster@mydomain.com', 'password' => 'password');
        //$transport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $config);

        $config = ['port' => 587, 'auth' => 'login', 'username' => 'admin', 'password' => Yii::app()->params['peterPassword']];
        $transport = new Zend_Mail_Transport_Smtp('localhost', $config);

        $mail = new Zend_Mail();
        $mail->setBodyText('This is the text of the mail.');
        $mail->setFrom('admin@agungpodomoro-aphris.com', 'Admin APHRIS');
        $mail->addTo('peter@agungpodomoro.com', 'Peter APL');
        $mail->setSubject('TestSubject');
        $mail->send($transport);

        echo "Sukses";
    }

    private $_indexFiles = 'search';

    public function actionSearchIndex()
    {
        //Yii::import("ext.yiiext.components.zendAutoloader.EZendAutoloader", true);
        //Yii::import('application.vendors.*');
        require_once('Zend/Search/Lucene.php');

        $this->layout = 'column2';
        if (($term = Yii::app()->getRequest()->getParam('q', null)) !== null) {
            $index = Zend_Search_Lucene::open(Yii::app()->basePath . "/runtime/" . $this->_indexFiles);
            $index->setResultSetLimit(5);
            $results = $index->find($term);
            $query = Zend_Search_Lucene_Search_QueryParser::parse($term);
            $this->render('search', compact('results', 'term', 'query'));
        }
    }

    public function actionGlob()
    {
        $path = Yii::app()->basePath . "/../sharedocs/companydocuments";

        $globOut = $this->glob_recursive($path . '/' . '*.docx');
        if (count($globOut) > 0) { // make sure the glob array has something in it
            $files = [];
            foreach ($globOut as $filename) {
                $files[] = $filename;
            }
            echo print_r($files);
        } else {
            echo 'No files found.<br />';
        }

    }

    public function glob_recursive($pattern, $flags = 0)
    {
        $files = glob($pattern, $flags);
        foreach (glob(dirname($pattern) . '/*', GLOB_ONLYDIR | GLOB_NOSORT) as $dir) {
            $files = array_merge($files, $this->glob_recursive($dir . '/' . basename($pattern), $flags));
        }
        return $files;
    }

    public function actionPdfText()
    {
        require_once('Zend/Pdf.php');

        $path = Yii::app()->basePath . "/../sharedocs/companydocuments";
        $pdfParse = new PdfParser;
        $pdf = Zend_Pdf::load($path . '/' . 'mBCA_Tabel Kode Perusahaan.pdf');
        $content = $pdfParse->pdf2txt($pdf->render());
        echo $content;
    }

    /*public function init(){
        Yii::import('application.vendors.*');
        require_once('Zend/Search/Lucene.php');
        require_once('Zend/Mail/Message.php');
        parent::init(); 
    } */

    public function actionSearchCreate()
    {
        require_once('Zend/Search/Lucene.php');

        $index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles), true);
        $posts = sCompanyNews::model()->findAll();
        foreach ($posts as $post) {
            $doc = new Zend_Search_Lucene_Document();
            $doc->addField(Zend_Search_Lucene_Field::Text('title', CHtml::encode($post->title), 'utf-8'));
            $doc->addField(Zend_Search_Lucene_Field::Text('content', CHtml::encode($post->content), 'utf-8'));
            $doc->addField(Zend_Search_Lucene_Field::Text('link', CHtml::encode($post->id), 'utf-8'));
            $index->addDocument($doc);
        }
        $index->commit();
        echo 'Lucene index created';
    }

    public function actionSearchCreate2()
    {
        require_once('Zend/Search/Lucene.php');

        $index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles), true);
        $path = Yii::app()->basePath . "/../sharedocs/companydocuments/google.docx";
        $doc = Zend_Search_Lucene_Document_Docx::loadDocxFile($path);

        $doc->addField(Zend_Search_Lucene_Field::Text('filename', $doc->filename, 'utf-8'));
        $doc->addField(Zend_Search_Lucene_Field::Text('title', $doc->title, 'utf-8'));
        $doc->addField(Zend_Search_Lucene_Field::UnIndexed('indexTime', time()));
        $doc->addField(Zend_Search_Lucene_Field::Text('body', $doc->body, 'utf-8'));
        $index->addDocument($doc);

        $index->commit();
        echo 'Lucene index created';
    }

    public function actionLogging()
    {
        $this->render('logging');
    }

    public function actionMessageManual()
    {
        $conv = new Mailbox();
        $conv->subject = "My Subject";
        $conv->to = "admin";
        $conv->initiator_id = 1;
        $conv->interlocutor_id = "admin";
        $conv->modified = time();
        $conv->bm_read = 0;
        $msg = new Message('admin');
        $msg->text = "Test Message";
        $msg->created = time();
        $msg->sender_id = 1;
        $msg->recipient_id = 1;
        $msg->crc64 = 0;
        $conv->save(false);
        $msg->conversation_id = $conv->conversation_id;
        $msg->save(false);
    }

    public function actionUpdateSso()
    {
        $random = peterFunc::rand_string(16);
        $_time = strtotime("+1 week");
        gPerson::model()->updateByPk($id, ['activation_code' => $random, 'activation_expire' => $_time]);
        $this->redirect(['view', "id" => $id]);
    }

    public function actionYiiLog()
    {
        $rawData = Yii::app()->db->createCommand('SELECT * FROM YiiLog')->queryAll();
        $dataProvider = new CArrayDataProvider($rawData, [
            'id' => 'log',
            'sort' => [
                'attributes' => [
                    'logtime',
                ],
            ],
            'pagination' => [
                'pageSize' => 50,
            ],
            'sort' => [
                'defaultOrder' => 'logtime DESC',
            ]
        ]);
        $this->render('yiiLog', ['dataProvider' => $dataProvider]);
    }

    public function actionProgress()
    {
        $this->render('progress', []);
    }

    public function actionUserHistory()
    {
        $this->render('userHistory', []);
    }

    public function actionEmail($file)
    {
        //mailprocess
        $param1 = "1";
        $param2 = "2";
        $param3 = "3";
        $param4 = "4";
        $param5 = "5";
        $subject = "Testing Subject";

        $body = $this->renderPartial('/zEmails/' . $file, [
            'param1' => $param1,
            'param2' => $param2,
            'param3' => $param3,
            'param4' => $param4,
            'param5' => $param5,
        ], true);

        EmailComponent::sendEmail("peterjkambey@gmail.com", $subject, $body, 'non-ssl');

        Yii::app()->user->setFlash('success', '<strong>Well done!</strong> <strong>' . $param1 . '</strong>.<br/> 
				 
				');

        $this->render('empty', ['body' => $body]);
    }

    public function actionMongo()
    {

        $mongo = new Mongo();
        $db = $mongo->myfiles;

        // GridFS
        $grid = $db->getGridFS();

        // The file's location in the File System
        $path = Yii::app()->basePath . "/../images/";

        $filename = "peter-jk.jpg";

        // Note metadata field & filename field
        $storedfile = $grid->storeFile($path . $filename, ["metadata" => ["filename" => $filename],
            "filename" => $filename]);

        // Return newly stored file's Document ID
        //echo $storedfile;

        Yii::app()->user->setFlash('success', '<strong>Well done!</strong> <strong> Sukses</strong>.<br/> 
		 
		');

        $this->render('empty', ['body' => $storedfile]);
    }

    public function actionMongoBack()
    {

        // Connect to Mongo and set DB and Collection
        $mongo = new Mongo('mongodb://localhost:27017');
        $db = $mongo->myfiles;

        // GridFS
        $gridFS = $db->getGridFS();

        // Find image to stream
        $image = $gridFS->findOne("peter-jk.jpg");

        // Stream image to browser
        header('Content-type: image/jpeg');
        echo $image->getBytes();
        //$this->render('empty',array('body'=>$image));
    }

    public function actionWeeklyReport()
    {
        $pdf = new weeklyReportSample('L', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Arial', '', 12);

        $connection = Yii::app()->db;

        $sql = '
            SELECT * FROM g_person limit 100
                            
        ';

        $command = $connection->createCommand($sql);
        $rows = $command->queryAll();

        $pdf->report($rows);

        $pdf->Output(Yii::app()->basePath.'/../assets/test.pdf','F');

        require_once('Zend/Mail.php');
        require_once('Zend/Mail/Transport/Smtp.php');
        require_once('Zend/Mail/Protocol/Smtp/Auth/Login.php');

        $config = [
            'port'     => '587',
            'auth'     => 'login',
            'username' => 'admin@agungpodomoro-aphris.com',
            'password' => Yii::app()->params['peterPassword']
        ];
        $transport = new Zend_Mail_Transport_Smtp('localhost', $config);

        Zend_Mail::setDefaultFrom('admin@agungpodomoro-aphris.com', 'Admin APHRIS');

        $mail = new Zend_Mail();
        $mail->addTo('peter@agungpodomoro.com', ' ');
     
        $mail->setSubject(
            'Testing Send Email With PDF On the Fly'
        );

        $file = Yii::app()->basePath.'/../assets/test.pdf';
        $at = new Zend_Mime_Part(file_get_contents($file));
        $at->filename = basename($file);
        $at->disposition = Zend_Mime::DISPOSITION_ATTACHMENT;
        $at->encoding = Zend_Mime::ENCODING_8BIT;
        $mail->addAttachment($at);

        $mail->setBodyHtml('testing body');
        $mail->send($transport);

        Zend_Mail::clearDefaultFrom();

    }

    public function actionSolr()
    {


        $options = [
            'hostname' => 'localhost',
            'login' => '',
            'password' => '',
            'port' => '8983',
        ];

        $client = new SolrClient($options);

        $doc = new SolrInputDocument();

        $doc->addField('id', 334455);
        $doc->addField('cat', 'Software');
        $doc->addField('cat', 'Lucene');

        $updateResponse = $client->addDocument($doc);

        print_r($updateResponse->getResponse());


    }

    public function actionZendMail() {

        require_once('Zend/Mail.php');
        require_once('Zend/Mail/Transport/Smtp.php');
        require_once('Zend/Mail/Protocol/Smtp/Auth/Login.php');

        $config = [
            //'ssl'      => 'ssl',
            'port'     => '587',
            'auth'     => 'login',
            'username' => 'admin@agungpodomoro-aphris.com',
            'password' => 'aphris1234qwe'
        ];
        $transport = new Zend_Mail_Transport_Smtp('localhost', $config);
         
        // Set From & Reply-To address and name for all emails to send.
        Zend_Mail::setDefaultFrom('admin@agungpodomoro-aphris.com', 'Admin APHRIS`');
        //Zend_Mail::setDefaultReplyTo('replyto@example.com','Jane Doe');
         
        // Loop through messages
        for ($i = 0; $i < 5; $i++) {
            $mail = new Zend_Mail();
            $mail->addTo('peter@agungpodomoro.com', 'Peter Podomoro');
         
            $mail->setSubject(
                'Demonstration - Sending Multiple Mails per SMTP Connection #'.$i
            );
            $mail->setBodyText('...Your message here...');
            $mail->send($transport);
        }
         
        // Reset defaults
        Zend_Mail::clearDefaultFrom();
        Zend_Mail::clearDefaultReplyTo();

    }

    public function actionGcm() {

        require_once('Zend/Mobile/Push/Message/Gcm.php');
        require_once('Zend/Mobile/Push/Gcm.php');

        $message = new Zend_Mobile_Push_Message_Gcm();
        $message->addToken('TEST123456');
        $message->setData(array(
            'foo' => 'bar',
            'bar' => 'foo',
        ));
         
        $gcm = new Zend_Mobile_Push_Gcm();
        $gcm->setApiKey('AIzaSyBbtougw7PPY9fVIA2c82RVjGI_apyEkbI');
         
        try {
            $response = $gcm->send($message);
        } catch (Zend_Mobile_Push_Exception $e) {
            // exceptions require action or implementation of exponential backoff.
            die($e->getMessage());
        }
         
        // handle all errors and registration_id's
        foreach ($response->getResults() as $k => $v) {
            //if ($v['registration_id']) {
            //    printf("%s has a new registration id of: %s\r\n", $k, $v['registration_id']);
            //}
            if ($v['error']) {
                printf("%s had an error of: %s\r\n", $k, $v['error']);
            }
            //if ($v['message_id']) {
            //    printf("%s was successfully sent the message, message id is: %s", $k, $v['message_id']);
            //}
        }


    }

    public function read_doc_file($filename) {

        if(file_exists($filename))
        {
            if(($fh = fopen($filename, 'r')) !== false ) 
            {
               $headers = fread($fh, 0xA00);

               // 1 = (ord(n)*1) ; Document has from 0 to 255 characters
               $n1 = ( ord($headers[0x21C]) - 1 );

               // 1 = ((ord(n)-8)*256) ; Document has from 256 to 63743 characters
               $n2 = ( ( ord($headers[0x21D]) - 8 ) * 256 );

               // 1 = ((ord(n)*256)*256) ; Document has from 63744 to 16775423 characters
               $n3 = ( ( ord($headers[0x21E]) * 256 ) * 256 );

               // 1 = (((ord(n)*256)*256)*256) ; Document has from 16775424 to 4294965504 characters
               $n4 = ( ( ( ord($headers[0x21F]) * 256 ) * 256 ) * 256 );

               // Total length of text in the document
               $textLength = ($n1 + $n2 + $n3 + $n4);

               $extracted_plaintext = fread($fh, $textLength);

               // simple print character stream without new lines
               //echo $extracted_plaintext;

               // if you want to see your paragraphs in a new line, do this
               return nl2br($extracted_plaintext);
               // need more spacing after each paragraph use another nl2br
            }
        }   
    }


    public function actionErrorOne()
    {

        $connection = Yii::app()->db;
        $sqlRaw = "
            select m.conversation_id, g.email, c.subject, m.text, gg.employee_name, gg.email as email_sender, m.sender_id  from s_mailbox_message m
            inner join s_mailbox_conversation c on  c.conversation_id = m.conversation_id
            inner join s_user u on  m.recipient_id = u.id
            inner join g_person g on  g.userid = u.id
            left join s_user uu on  m.sender_id = uu.id
            left join g_person gg on  gg.userid = uu.id
            where c.bm_sent = 0 and (g.email is not null or length(g.email) <>0)
            order by g.email
        ";

        //FOR TESTING ONLY
        //$sqlRaw = "
        //  select m.conversation_id, 'peterjkambey@gmail.com' as email,'test subject ' 
        //  as subject, m.text from s_mailbox_message m order by conversation_id DESC  limit 1
        //";

        $rawData = $connection->createCommand($sqlRaw)->queryAll();
        Yii::import('EmailComponent');

        foreach ($rawData as $row) {

            $subject = $row['subject'];

            $email = $row['email'];

            if ($row['sender_id'] == 1) {
                $text = "ADMIN APHRIS";
            } else
                $text = $row['employee_name'] . " ( " . $row['email_sender'] . " )";

            $text .= ' has send you a message with this following detail:<br/><br/><br/>';

            $text .= $row['text'];

            $body = EmailComponent::template('template002', $text);

            if (!in_array($email, require(dirname(__FILE__) . '/../config/blacklistEmail.php')) && filter_var($email, FILTER_VALIDATE_EMAIL))
                EmailComponent::sendEmail($email, $subject, $body);

            $sql2 = "UPDATE s_mailbox_conversation SET bm_sent = 1 WHERE conversation_id = " . $row['conversation_id'];
            Yii::app()->db->createCommand($sql2)->execute();

            echo "sukses";
        }

    }

    public function actionOpcode() {
        echo "Hello Bro";
    }
}
