<?php

$_GET['source'] = '?';
if( isset( $argv ) )
{
    foreach( $argv as $arg ) {
        $e = explode( '=', $arg );
        if( count($e) == 2 )
            $_GET[$e[0]] = $e[1];
        else    
            $_GET[$e[0]] = 0;
    }
}

$date = date("Y-m-d H:i:s");

$input = 'cron-test.txt';
$contents = file_get_contents($input);

$text = $contents."Runnded at: $date Source: $_GET[source]\n";


file_put_contents($input, $text);


?>