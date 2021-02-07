<?php

//use PHP_User_Filter;

class stream extends php_user_filter
{

    public function filter($in, $out, &$consumed, $closing)
    {
        //set filter for unwanted strings => we don't display the line than

        $lineCount = 0;

        while ($bucket = stream_bucket_make_writeable($in)) {
            // set search
            $pattern = "/Tom/m";

                    //replace
                    $str = preg_replace($pattern, 'Unknowen', $bucket->data);
                    $bucket->data = $str;
                    $consumed += $bucket->datalen;
                    stream_bucket_append($out, $bucket);
                    $lineCount++;
                    $_SESSION['lineCount'] += $lineCount;
        }
        
        return PSFS_PASS_ON;
    }
}
