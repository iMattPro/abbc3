<?php
/**
 * Convert Google Fonts metadata from stdin into the ACP font-family catalog.
 * The Phing release build runs this helper on the staged package.
 */

if (PHP_SAPI !== 'cli')
{
	exit;
}

$json = stream_get_contents(STDIN);
$json = preg_replace("/^\)\]\}'[^\n]*\n/", '', $json);
$metadata = json_decode($json, true);
$families = $metadata['familyMetadataList'] ?? null;
if (!is_array($families) || !$families)
{
	fwrite(STDERR, "Could not read the Google Fonts family catalog.\n");
	exit(1);
}

$names = [];
foreach ($families as $family)
{
	if (!isset($family['family']) || !is_string($family['family']) || trim($family['family']) === '')
	{
		fwrite(STDERR, "The catalog contains an invalid family entry.\n");
		exit(1);
	}
	$names[] = $family['family'];
}

$names = array_values(array_unique($names));
sort($names, SORT_NATURAL | SORT_FLAG_CASE);
echo json_encode($names, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT), "\n";
