--TEST--
Decimal128: [basx508] The 'baddies' tests from DiagBigDecimal, plus some new ones (Conversion_syntax)
--DESCRIPTION--
Generated by scripts/convert-bson-corpus-tests.php

DO NOT EDIT THIS FILE
--FILE--
<?php

require_once __DIR__ . '/../utils/tools.php';

throws(function() {
    new MongoDB\BSON\Decimal128('12e++');
}, 'MongoDB\Driver\Exception\InvalidArgumentException');

?>
===DONE===
<?php exit(0); ?>
--EXPECT--
OK: Got MongoDB\Driver\Exception\InvalidArgumentException
===DONE===