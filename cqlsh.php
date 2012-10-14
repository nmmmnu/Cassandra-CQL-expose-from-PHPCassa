!/usr/local/bin/php
<?
require_once(__DIR__.'/../lib/autoload.php');

use phpcassa\Connection\ConnectionPool;

if ($argc < 2){
        echo "Usage {$argv[0]} keyspace cql\n";
        exit;
}

$space = $argv[1];
$cql = $argv[2];

$pool = new ConnectionPool($space, array("127.0.0.1"));
$raw  = $pool->get();
$rows = $raw->client->execute_cql_query($cql, 2);
$pool->return_connection($raw);
unset($raw);
$pool->close();

print_r($rows);
//print_r($rows["rows"]); // result data only


