<?php
/**
 * Created by PhpStorm.
 * User: lizhiguo
 * Date: 2019/11/26
 * Time: 10:16
 */

// First, include Requests
require_once __DIR__.'/../library/Requests.php';

Requests::register_autoloader();
// Say you need to fake a login cookie
function getHeaders($domain){
	$system_version=mt_rand(0,50)?"6.1":'10.0';
	$useragentrand=mt_rand(0,50);
	switch ($useragentrand){
		case '1':
			$useragent=["user-agent"=>"Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/".mt_rand(61,72).".0.".mt_rand(1111,9999).".".mt_rand(11,109)." Safari/537.36"];
			break;
		default:
			$useragent=["user-agent"=>"Mozilla/5.0 (Windows NT {$system_version}; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/".mt_rand(61,72).".0.".mt_rand(1111,9999).".".mt_rand(11,99)." Safari/537.36"];
			break;
	}
	$acceptlanguageArray=[
		["accept-language"=> "en-US,en;q=0.9,zh;q=0.8,zh-CN;q=0.7,zh-HK;q=0.6,zh-TW;q=0.5,ja;q=0.4"],
		["accept-language"=> "en-US,en;q=0.9,zh-CN;q=0.8,zh;q=0.7,en-AU;q=0.6,en-CA;q=0.5,en-NZ;q=0.4"],
		["accept-language"=> "fr,en;q=0.9,en-US;q=0.8,en;q=0.7,en-AU;q=0.6,en-CA;q=0.5,en-NZ;q=0.4"],
		["accept-language"=> "en-US,en;q=0.5"],
		["accept-language"=> "fr-CH, fr;q=0.9, en;q=0.8, de;q=0.7, *;q=0.5"],
		["accept-language"=> "en,en-US;q=0.9,en-AU;q=0.8"],
		["accept-language"=> "fr,en;q=0.9,en-US;q=0.8"],
		["accept-language"=> "es-ES,es;q=0.9,en;q=0.8,en-US;q=0.7"],
		["accept-language"=> "en-CA,en;q=0.9,en-US;q=0.8"],
		["accept-language"=> "en-IN,en-CA;q=0.9,en;q=0.8,en-US;q=0.7"],
		["accept-language"=> "en-ZA,en-IN;q=0.9,en-CA;q=0.8,en;q=0.7,en-US;q=0.6,en-GB;q=0.5"],
		["accept-language"=> "en-GB,en-ZA;q=0.9,en-IN;q=0.8,en-CA;q=0.7,en;q=0.6,en-US;q=0.5"],
		[],
		[],
		[],
		[],
		[],
		[],
		[],
		[],
		[],
		[],
		[],
		[],
		//                "-H 'accept-language: zh-CN,zh;q=0.9'",
		//                "-H 'accept-language: zh-CN,zh;q=0.9,en;q=0.8'",

	];
	$acceptlanguageArray=$acceptlanguageArray[mt_rand(0,23)];
	$acceptEncodingArray=[
		["accept-encoding"=> "gzip, deflate, br"],
		["accept-encoding"=> "gzip, deflate"],
		["accept-encoding"=> "gzip, deflate, sdch, br"],
		[],
		[],
	];
	$acceptEncoding=$acceptEncodingArray[mt_rand(0,4)];
	$acceptArray=[
		["accept"=> "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8"],
		["accept"=> "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8"],
		["accept"=> "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8"],
		["accept"=> "text/html, application/xhtml+xml, application/xml;q=0.9, */*;q=0.8"],
		[],
		[],
		[],
		[],
		[],
	];
	$accept=$acceptArray[mt_rand(0,8)];
	$authoritys=mt_rand(0,3)?["authority"=>$domain]:[];
	$cacheControl=mt_rand(0,3)?["cache-control"=>"max-age=0"]:[];
	$upgrade_insecure_requests=mt_rand(0,1)?["upgrade-insecure-requests"=>1]:[];
	$scheme=mt_rand(0,2)?["scheme"=>"https"]:[];
	$path=mt_rand(0,2)?[]:["path"=>"/"];
	$headers=array_merge($authoritys,$cacheControl,$upgrade_insecure_requests,$useragent,$accept,$acceptEncoding,$acceptlanguageArray,$scheme,$path);
	return $headers;
}
$headers=getHeaders('www.amazom.com');
$session = new Requests_Session('https://www.amazon.com/');
$session->headers=$headers;
//print_r($headers);
//$session->headers['user-agent'] = 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36';
//$session->headers['referer'] = 'https://www.amazon.com/';
// Now let's make a request!
$options = array(
	'verify' => __DIR__.'/cacert.pem'
);
$asins=[
'B07JJCC96L6',
'B01N2AUPW3',
'B07K46KX84',
'B0052WO106',
'B07R28FYQD',
'B071W85WHR',
'B071HL5JH2',
'B071DPW3K9',
'B07FP5QN4P',
'B01FHCO5LK',
'B01E74HH3M',
'B01E8ADES2',
'B071HL4R2Q',
'B07YDCGFHK',
'B072JB9Q99',
'B07L5M6NNJ',
'B07JKD5JRL',
'B07GD9KC1X',
'B071W2PRG6',
'B07JGLS569',
'B01G20IV5C',
'B01E8HFF1E',
'B07K57CWH7',
'B07G4C442F',
'B07TCK8GQ6',
'B0758972KP',
'B06ZYX3VW1',
'B00932FBUU',
'B00UX6YXN6',
'B07FPPTB2Y'
];
foreach ($asins as $asin){
	$response=$session->get('https://www.amazon.com/dp/'.$asin, array(), $options);
	echo $response->status_code;
	$html=$response->body;
	file_put_contents(__DIR__.'/html/'.$asin.'.html',$html);
}
print_r($response->cookies);
print_r($response->headers);
print_r($response->history);
//print_r($response->raw);
//print_r($response->redirects);