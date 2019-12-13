<?php

	$xml = new DOMDocument();
	$xml->loadHTMLFile('https://myshows.me/higimo/wasted');
	$links = [];

	$main = $xml->getElementsByTagName('main')->item(0);

	function table2Arr($table) {
		$result = [];
		$rows = 0;
		foreach ($table->getElementsByTagName('tr') as $i => $row) {
			$result[$i] = [];
			foreach ($row->getElementsByTagName('td') as $td) {
				$result[$i][] = $td->nodeValue;
			}
		}
		return $result;
	}

	$result = [];

	foreach ($main->childNodes as $child) {
		$isHeader = strpos($child->getNodePath(), '/main/h3') !== false;
		$isTable = strpos($child->getNodePath(), '/main/table') !== false;
		if ($isHeader) {
			$result[] = $child->nodeValue;
		}
		if ($isTable) {
			$result[] = table2Arr($child);
		}
	}

	// echo json_encode($result, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
	echo json_encode($result, JSON_UNESCAPED_UNICODE);
