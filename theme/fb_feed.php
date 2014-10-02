<?php
// Facebook Feed
global $alainConfig;
$facebook = new Facebook($alainConfig['facebook']);

function fb_feed() {

	$jsonFilePath = 'fb.json';

	if (file_exists($jsonFilePath)) {

		$jsonFile = fopen($jsonFilePath, 'r');
		$data = fread($jsonFile, filesize($jsonFilePath));
		fclose($jsonFile);

	} else {

		global $facebook;
		
		$request = array(
			'feed'  => $facebook->api('/488298457891169/feed'),
			'about' => $facebook->api('/488298457891169')
		);

		foreach ($request['feed']['data'] as $key => $value) {

			$post = &$request['feed']['data'][$key];
			
			if (isset($post['object_id'])) {

				// Add high res pic if there
				$post['moreData'] = $facebook->api('/'.$post['object_id']);
			}

			// Add like & comment count
			$post['likes']    = $facebook->api('/'.$post['id'].'/likes?limit=10000');
			$post['comments'] = $facebook->api('/'.$post['id'].'/comments?limit=10000');
		}

		// turn data into JSON
		$data = json_encode($request);

		// Write to file
		$jsonFile = fopen($jsonFilePath, "w");
		fwrite($jsonFile, $data);
		fclose($jsonFile);
	}
	return $data;
}