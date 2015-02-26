<?php

/*

Copyright (c) 2009 Anant Garg (anantgarg.com | inscripts.com)

This script may be used for non-commercial purposes only. For any
commercial purposes, please contact the author at 
anant.garg@inscripts.com

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.

*/

define ('DBPATH','localhost');
define ('DBUSER','root');
define ('DBPASS','');
define ('DBNAME','test');

//session_start();
$session=new CHttpSession;
$session->open();

global $dbh;
$dbh = mysql_connect(DBPATH,DBUSER,DBPASS);
mysql_selectdb(DBNAME,$dbh);

if ($_GET['action'] == "chatheartbeat") { chatHeartbeat(); } 
if ($_GET['action'] == "sendchat") { sendChat(); } 
if ($_GET['action'] == "closechat") { closeChat(); } 
if ($_GET['action'] == "startchatsession") { startChatSession(); } 

if (!isset($session['chatHistory'])) {
	$session['chatHistory'] = array();	
}

if (!isset($session['openChatBoxes'])) {
	$session['openChatBoxes'] = array();
}

function chatHeartbeat() {
	
	$sql = "select * from chat where (chat.to = '".mysql_real_escape_string($session['username'])."' AND recd = 0) order by id ASC";
	$query = mysql_query($sql);
	$items = '';

	$chatBoxes = array();

	while ($chat = mysql_fetch_array($query)) {

		if (!isset($session['openChatBoxes'][$chat['from']]) && isset($session['chatHistory'][$chat['from']])) {
			$items = $session['chatHistory'][$chat['from']];
		}

		$chat['message'] = sanitize($chat['message']);

		$items .= <<<EOD
					   {
			"s": "0",
			"f": "{$chat['from']}",
			"m": "{$chat['message']}"
	   },
EOD;

	if (!isset($session['chatHistory'][$chat['from']])) {
		$session['chatHistory'][$chat['from']] = '';
	}

	$session['chatHistory'][$chat['from']] .= <<<EOD
						   {
			"s": "0",
			"f": "{$chat['from']}",
			"m": "{$chat['message']}"
	   },
EOD;
		
		unset($session['tsChatBoxes'][$chat['from']]);
		$session['openChatBoxes'][$chat['from']] = $chat['sent'];
	}

	if (!empty($session['openChatBoxes'])) {
	foreach ($session['openChatBoxes'] as $chatbox => $time) {
		if (!isset($session['tsChatBoxes'][$chatbox])) {
			$now = time()-strtotime($time);
			$time = date('g:iA M dS', strtotime($time));

			$message = "Sent at $time";
			if ($now > 180) {
				$items .= <<<EOD
{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;

	if (!isset($session['chatHistory'][$chatbox])) {
		$session['chatHistory'][$chatbox] = '';
	}

	$session['chatHistory'][$chatbox] .= <<<EOD
		{
"s": "2",
"f": "$chatbox",
"m": "{$message}"
},
EOD;
			$session['tsChatBoxes'][$chatbox] = 1;
		}
		}
	}
}

	$sql = "update chat set recd = 1 where chat.to = '".mysql_real_escape_string($session['username'])."' and recd = 0";
	$query = mysql_query($sql);

	if ($items != '') {
		$items = substr($items, 0, -1);
	}
header('Content-type: application/json');
?>
{
		"items": [
			<?php echo $items;?>
        ]
}

<?php
			exit(0);
}

function chatBoxSession($chatbox) {
	
	$items = '';
	
	if (isset($session['chatHistory'][$chatbox])) {
		$items = $session['chatHistory'][$chatbox];
	}

	return $items;
}

function startChatSession() {
	$items = '';
	if (!empty($session['openChatBoxes'])) {
		foreach ($session['openChatBoxes'] as $chatbox => $void) {
			$items .= chatBoxSession($chatbox);
		}
	}


	if ($items != '') {
		$items = substr($items, 0, -1);
	}

header('Content-type: application/json');
?>
{
		"username": "<?php echo $session['username'];?>",
		"items": [
			<?php echo $items;?>
        ]
}

<?php


	exit(0);
}

function sendChat() {
	$from = $session['username'];
	$to = $_POST['to'];
	$message = $_POST['message'];

	$session['openChatBoxes'][$_POST['to']] = date('Y-m-d H:i:s', time());
	
	$messagesan = sanitize($message);

	if (!isset($session['chatHistory'][$_POST['to']])) {
		$session['chatHistory'][$_POST['to']] = '';
	}

	$session['chatHistory'][$_POST['to']] .= <<<EOD
					   {
			"s": "1",
			"f": "{$to}",
			"m": "{$messagesan}"
	   },
EOD;


	unset($session['tsChatBoxes'][$_POST['to']]);

	$sql = "insert into chat (chat.from,chat.to,message,sent) values ('".mysql_real_escape_string($from)."', '".mysql_real_escape_string($to)."','".mysql_real_escape_string($message)."',NOW())";
	$query = mysql_query($sql);
	echo "1";
	exit(0);
}

function closeChat() {

	unset($session['openChatBoxes'][$_POST['chatbox']]);
	
	echo "1";
	exit(0);
}

function sanitize($text) {
	$text = htmlspecialchars($text, ENT_QUOTES);
	$text = str_replace("\n\r","\n",$text);
	$text = str_replace("\r\n","\n",$text);
	$text = str_replace("\n","<br>",$text);
	return $text;
}