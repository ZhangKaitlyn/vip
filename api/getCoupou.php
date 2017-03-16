<?php
include "httpRequest.php";
// include "tao-sdk-php/TopSdk.php";
// include "tao-sdk-php/top/TopClient.php";
// include "tao-sdk-php/top/request/KaitlynTbkItemGetRequest.php";

// $appkey="23689221";
// $secret="6ffc3ac2f96556e992ecb6d79fc9c707";

// $c = new TopClient;
// $c->appkey = $appkey;
// $c->secretKey = $secret;
// $req = new KaitlynTbkItemGetRequest;
// // $req->setPlatform("1");
// // $req->setCat("16,18");
// $req->setPageSize("10");
// // $req->setQ("女装");
// $req->setPageNo("1");
// $req->setPid("mm_119045028_16888897_62308435");
// $resp = $c->execute($req);
$page=$_GET["page"];
$url="http://api.dataoke.com/index.php?r=Port/index";
$type="total";
$appkey="8sfd85v39w";
$version=2;
// $page=2;

//一次请求获取200条数据，分5页显示,1页显示40条，在第4页的时候就请求另外200条数据
if($page % 5 == 4){
	$requestPage=$page/5+2;
	$datas[$requestPage]=getData($url,$type,$appkey,$version,$requestPage);
}
if($page==1){
	$datas[0]=getData($url,$type,$appkey,$version,1);
}
$result=array_slice($datas[$requestPage-1], $page%5);

function getData($url,$type,$appkey,$version,$page){
	$c=new httpRequest($url,$type,$appkey,$version,$page);
	$requestUrl=$c->paramString();
	$resp=$c->curl($requestUrl);
	return $resp;
}


echo $result;