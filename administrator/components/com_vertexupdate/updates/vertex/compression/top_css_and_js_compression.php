<?php 





$content = ob_get_contents();



ob_clean();



include_once('class_css_and_js_compression.php');



$excludeFilesArray  = $excludeFilesArrayTop;



// js regax



$regex = '/src=\"([^\"]*)\"/i';



$jsfiles = getArray($content,$regex);



foreach($jsfiles as $k=>$jsfile){



	foreach($excludeFilesArray as $excludeFiles){



		if( stristr( $jsfile , $excludeFiles )){



			 $excludejsFilesArray[] = $jsfiles[$k];



			 unset($jsfiles[$k]);



			 break;



		}



	}



}



$regex = '/<link.*?href=\"([^\"]*)\"/i';



$cssfiles = getArray($content,$regex);







foreach($cssfiles as $k=>$cssfile){



	foreach($excludeFilesArray as $excludeFiles){



		if( stristr( $cssfile , $excludeFiles )){



			 $excludecssFilesArray[] = $cssfiles[$k];



			 unset($cssfiles[$k]);



			 break;



		}



		if((strpos($cssfiles[$k],'.ico') > -1 ) || (strpos($cssfiles[$k],'googleapis') > -1 )){



			$excludecssFilesArray[] = $cssfiles[$k];



			unset($cssfiles[$k]);



			break;



		}



	}



}



$arrayTemp = array();



if(isset($usejscompression) && ($usejscompression=="yes")){



	foreach($jsfiles as $jsfile){



		if(!in_array($jsfile,$arrayTemp)) {



			$content = str_replace($jsfile,'',$content);



			$arrayTemp[]  = $jsfile;



		}



	}



	if(isset($excludejsFilesArray)){



		if(is_array($excludejsFilesArray)){



			foreach($excludejsFilesArray as $excludejsFiles){



				if(!in_array($excludejsFiles,$arrayTemp)) {



					$content = str_replace($excludejsFiles,'',$content);



					$arrayTemp[]  = $excludejsFiles;



				}



			}



		}



	}



}



if(isset($usecsscompression) && ($usecsscompression=="yes")){



	foreach($cssfiles as $cssfil){



		if(!in_array($cssfil,$arrayTemp)) {



			$content = str_replace($cssfil,'',$content);



			$arrayTemp[]  = $cssfil;



		}



	}


	if(isset($excludecssFilesArray) && is_array($excludecssFilesArray)){




		foreach($excludecssFilesArray as $excludecssFiles){



			if(!in_array($excludecssFiles,$arrayTemp)) {



				$content = preg_replace('~"<link.*?'.preg_quote($excludecssFiles).'.*?>~', '', $content);



				$arrayTemp[]  = $excludecssFiles;



			}	



		}



	}



}



ob_end_clean();



ob_start();



echo $content = removeblankLinks($content);



/*echo "<pre>";



print_r($jsfiles);



print_r($cssfiles);



exit;*/



$HTTP_HOST =  $_SERVER['HTTP_HOST'];



$SCRIPT_NAME =  $_SERVER['SCRIPT_NAME'];



$scripnameArray = explode("/",$SCRIPT_NAME);



$scripname="";



for($i=0;$i<(count($scripnameArray)-1);$i++){



	if($scripnameArray[$i]==''){continue;}



	$scripname = $scripname."/".$scripnameArray[$i];



}



$serverpath =  JUri::root().$filepath;



$scriptpath = $scripname."/".$filepath;



//echo "</pre>";



$writabledir=$filepath;

jimport( 'joomla.filesystem.folder' );
if (!JFolder::exists(JPATH_ROOT . '/' . $writabledir)) {
	JFolder::create(JPATH_ROOT . '/' . $writabledir);
}



$mybrowser = getBrowser();



$name = 'top_compression_js.php';



$writefile = delete_old_md5s($writabledir,$name,$cachetime);



if(isset($usejscompression) && ($usejscompression=="yes")  && $writefile){



/* 	if(file_exists($writabledir.$name)){



			delete_old_md5s($writabledir,$name,$cachetime);



	}else{*/



			/*temp added */



			/*foreach($jsfiles as $jsfile){



				if(strpos($jsfile,'.js') > -1)



				echo $jsfile."<br>";	



			}*/



			/* end temp added */



			$js = '';
			foreach($jsfiles as $jsfile){

				$jsfile = str_replace(JUri::root(), JPATH_ROOT . '/', $jsfile);
				$content = @file_get_contents($jsfile);
				if($content == ''){

					$handle = fopen($jsfile, "r");

					$content = fread($handle, filesize($jsfile));

					fclose($handle);

				}

				$js .= JSMin::minify($content);



			}



			if($writefile){



				$fh = fopen($writabledir.$name, 'w');



				$js = '<?php ob_clean();header("Content-type: application/javascript",true);header("Cache-Control: no-cache, must-revalidate");ob_start();?>' . $js . '<?php ob_flush();exit();?>' ;



				fwrite($fh, $js);



				fclose($fh);



			}



			



			/*echo "<pre>";



				print_r($jsfiles);



			echo "</pre>";*/



			//file_put_contents($writabledir.$name,$js);



	//}



	echo "\n



			<script type='text/javascript' src='$serverpath"."$name' > </script>" ;



} else if(isset($usejscompression) && ($usejscompression=="yes")  && !$writefile){

	

	echo "\n



			<script type='text/javascript' src='$serverpath"."$name' > </script>" ;	



}



$name = 'top_compression_css.php';



$writefile = delete_old_md5s($writabledir,$name,$cachetime);



if(isset($usecsscompression) && ($usecsscompression=="yes") && $writefile){ 



/*	if(file_exists($writabledir.$name)){



	delete_old_md5s($writabledir,$name,$cachetime);



	}else{*/



	



		/*temp added */



		/*foreach($cssfiles as $cssfile){



			if(strpos($cssfile,'.css') > -1)



			echo $cssfile."<br>";	



		}*/



		/* end temp added */



			



		$css = '';



		$favicon = '';



		foreach($cssfiles as $cssfile){



			if(strpos($cssfil,'.ico') > -1){



				$favicon = $cssfil;



				continue;



			}


			$cssfile = str_replace(JUri::root(), JPATH_ROOT . '/', $cssfile);

			$content = @file_get_contents($cssfile);

			if($content == ''){

				$handle = fopen($cssfile, "r");

				$content = fread($handle, filesize($cssfile));

				fclose($handle);

			}

			$css .= CssMin::minify($content);



		}



		$css = removeblankLinks($css);



		if($writefile){



			$fh = fopen($writabledir.$name, 'w');



			$css = '<?php ob_clean();header("Content-type: text/css",true);header("Cache-Control: no-cache, must-revalidate");ob_start();?>' . $css . '<?php ob_flush();exit();?>' ;



			$css = removepath($css);



			fwrite($fh, $css);



			fclose($fh);



		}



		



		/*echo "<pre>";



			print_r($cssfiles);



		echo "</pre>";*/



		//file_put_contents($writabledir.$name,$css);



	//}



		echo "\n



		<link rel='stylesheet' href='$serverpath"."$name' type='text/css' />



		" ;



} else if(isset($usecsscompression) && ($usecsscompression=="yes") && !$writefile){



	echo "\n



		<link rel='stylesheet' href='$serverpath"."$name' type='text/css' />



		" ;	



}



if(isset($excludejsFilesArray)){



	if(is_array($excludejsFilesArray)){



		foreach($excludejsFilesArray as $excludejsFiles){



				echo "\n<script type='text/javascript' src='$excludejsFiles' ></script>" ;



		}



	}



}



if(isset($excludecssFilesArray)){



	if(is_array($excludecssFilesArray)){



		foreach($excludecssFilesArray as $excludecssFiles){



			if(strpos($excludecssFiles,'.ico') > -1){



				echo "\n<link type='image/x-icon' rel='shortcut icon' href='$excludecssFiles'>";

			}

			else{

				

				echo "\n<link rel='stylesheet' href='$excludecssFiles' type='text/css' />" ;

				

			}



		}



	}



}







?> 

