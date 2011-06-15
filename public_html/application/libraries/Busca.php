<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Busca {
	
	function Busca(){
		
	}
	
    function realizarBusca($endSite, $termo){
    	//$url = 'http://ajax.googleapis.com/ajax/services/search/web?rsz=large&v=1.0&q=' . urlencode('site:' . $_SERVER['HTTP_HOST'] . ' ' . $_POST['searchquery']);
    	$url = "http://ajax.googleapis.com/ajax/services/search/web?rsz=large&key=ABQIAAAAUcHQ2ldBNAAr0jS88qEedBT5pVsADBUozNMRnxkx4_knV4ekkxS1zIdLUfHrUTZaRhQ3t1cffwXVng&v=1.0&q=".urlencode("site:$endSite ".$termo)."";
		
		// sendRequest
		// note how referer is set manually
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_REFERER, "http://labcomtotal.com.br/index.php");
		$body = curl_exec($ch);
		curl_close($ch);
		
		// now, process the JSON string
		//$json = new Services_JSON();
		$json = json_decode($body);
		
		return $json->responseData->results;
		
	    /*foreach($json->responseData->results as $searchresult){
			if($searchresult->GsearchResultClass == 'GwebSearch'){
				$formattedresults .= '
				<div class="searchresult">
				<h3><a href="' . $searchresult->unescapedUrl . '">' . $searchresult->titleNoFormatting . '</a></h3>
				<p class="resultdesc">' . $searchresult->content . '</p>
				<p class="resulturl">' . $searchresult->visibleUrl . '</p>
				</div>';
			}
		}*/
    }
}

?>