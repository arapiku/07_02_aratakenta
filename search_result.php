<?php
$term = $_POST["search_term"];

$aws_access_key_id = 'AKIAJVWKRVSGIM4PHKEA';
$aws_secret_key = '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';
$AssociateTag='arapiku42007-22';

//URL生成
$endpoint = 'webservices.amazon.co.jp';
$uri = '/onca/xml';

for($i=1; $i<=2; $i++){//2ページ取得、ItemSearchの最大値は10まで
	//パラメータ群
	$params = array(
		'Service' => 'AWSECommerceService',
		'Operation' => 'ItemSearch',
		'AWSAccessKeyId' => $aws_access_key_id,
		'AssociateTag' => $AssociateTag,
		'SearchIndex' => 'Books',
		'ResponseGroup' => 'Medium',
		'Keywords' => $term,
		'ItemPage' => $i
	);

	//timestamp
	if (!isset($params['Timestamp'])) {
		$params['Timestamp'] = gmdate('Y-m-d\TH:i:s\Z');
	}

	//パラメータをソート
	ksort($params);

	$pairs = array();
	foreach ($params as $key => $value) {
		array_push($pairs, rawurlencode($key).'='.rawurlencode($value));
	}

	//リクエストURLを生成
	$canonical_query_string = join('&', $pairs);
	$string_to_sign = "GET\n".$endpoint."\n".$uri."\n".$canonical_query_string;
	$signature = base64_encode(hash_hmac('sha256', $string_to_sign, $aws_secret_key, true));
	$request_url = 'http://'.$endpoint.$uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);

	$amazon_xml=simplexml_load_string(@file_get_contents($request_url));//@はエラー回避
	// もし検索結果があれば
	if($amazon_xml) {
		print '<ul class="book_list">';
		foreach($amazon_xml->Items->Item as $item_a=>$item){
			$image=$item->MediumImage->URL;//画像のURL
			$title=$item->ItemAttributes->Title;//商品名
			$author=$item->ItemAttributes->Author;//著者名

			print '<li>';
			print '<img src="'.$image.'"><br>';
			print $title.'<br>';
			print $author.'<br>';
			print '<form action="book_save.php" method="post" class="save_form">
					<input type="hidden" name="book" class="book" value="'.$title.','.$author.','.$image.'">
					<input type="submit" value="保存"> 
					</form>';
			print '</li>';
			print PHP_EOL;
		}
		print '</ul>';
	}

	//2秒おく
	// sleep(1);
}
?>