<?php
if (!isset($_SESSSION)) {
    session_start();
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/styles/main.css" />
    <title>Document</title>
</head>
<body>
  <div class="content">
    <h1>Home Work</h1>
      <?php

        $_SESSION['lineCount'] = 0;
        
        //search from
        //$searchURL = "txt/test2.txt";
        $searchURL = "https://cs.wikipedia.org/wiki/Tom_Hanks";

        $result = function () use ($searchURL) {
          
            include "includes/autoload.inc.php";
            $totalLines = "";
            $content = "";
            // register the stream filter
            stream_filter_register('stream_ilter', 'stream')
            or die("Failed to register filter");

            // Open the stream
            $handle = fopen($searchURL, "r");

            // Append the filter to the stream.
            stream_filter_append($handle, 'stream_ilter');

            //get the lines
            while (1) {
                $data = fgets($handle);
    
                if (!$data) {
                    break;
                }
    
                $totalLines++;
                $content .= $data;
            }

            return array("content"=>$content, "totalLines"=>$totalLines);
            fclose($handle);
        };

        $result = $result();
        //output
        echo "<div class='new'>There has been " . $_SESSION["lineCount"] . " out of " . $result["totalLines"] . " lines changed.</div>";
        echo $result["content"];


        ?>
  </div>    
</body>
</html>