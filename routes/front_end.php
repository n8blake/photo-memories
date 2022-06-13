<?php

    if( isset($_REQUEST['path']) && file_exists(dirname(__FILE__) . '/'.APP_NAME.'/dist/'.APP_NAME.'/' . $_REQUEST['path'])){
        	$file = dirname(__FILE__) . '/'.APP_NAME.'/dist/'.APP_NAME.'/' . $_REQUEST['path'];	
        	if(strpos($_REQUEST['path'], '.js')){
        		header('Content-type: text/javascript');
        	} else if(strpos($_REQUEST['path'], '.css')){
        		header('Content-type: text/css');
        	} else {
        		$mimeType = mime_content_type($file);
        		header('Content-type: ' . $mimeType);
        	}
        	readfile($file);
        } else {
        	include(dirname(__FILE__) . '/'.APP_NAME.'/dist/'.APP_NAME.'/index.html');
        }

?>