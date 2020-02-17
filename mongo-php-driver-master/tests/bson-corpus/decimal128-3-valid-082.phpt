--TEST--
Decimal128: [basx662] Zeros
--DESCRIPTION--
Generated by scripts/convert-bson-corpus-tests.php

DO NOT EDIT THIS FILE
--FILE--
<?php

require_once __DIR__ . '/../utils/tools.php';

$canonicalBson = hex2bin('1800000013640000000000000000000000000000003A3000');
$canonicalExtJson = '{"d" : {"$numberDecimal" : "0.000"}}';
$degenerateExtJson = '{"d" : {"$numberDecimal" : "0.0E-2"}}';

// Canonical BSON -> Native -> Canonical BSON 
echo bin2hex(fromPHP(toPHP($canonicalBson))), "\n";

// Canonical BSON -> Canonical extJSON 
echo json_canonicalize(toCanonicalExtendedJSON($canonicalBson)), "\n";

// Canonical extJSON -> Canonical BSON 
echo bin2hex(fromJSON($canonicalExtJson)), "\n";

// Degenerate extJSON -> Canonical BSON 
echo bin2hex(fromJSON($degenerateExtJson)), "\n";

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
1800000013640000000000000000000000000000003a3000
{"d":{"$numberDecimal":"0.000"}}
1800000013640000000000000000000000000000003a3000
1800000013640000000000000000000000000000003a3000
===DONE===