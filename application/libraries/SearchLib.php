<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No permitir el acceso directo al script' );
	
	// Validaciones para el modelo de usuarios (login, cambio clave, CRUD Usuario)
class SearchLib {
	function __construct() {
		$this->CI = & get_instance (); // Esto para acceder a la instancia que carga la librería
	}
	public function search_site($url) {
		require_once "support/http.php";
		require_once "support/web_browser.php";
		require_once "support/simple_html_dom.php";
		
		$html = new simple_html_dom ();
		$url = 'http://' . $url;
		$web = new WebBrowser ();
		$result = $web->Process ( $url );
		if (! $result ["success"]) {
			echo "Error retrieving URL.  " . $result ["error"] . "\n";
		} else if ($result ["response"] ["code"] != 200) {
			echo "Error retrieving URL.  Server returned:  " . $result ["response"] ["code"] . " " . $result ["response"] ["meaning"] . "\n";
		} else {
			
			$html->load ( $result ["body"] );
			$rows = $html->find ( "a[href]" );
			
			return $rows;
			
		}
	}
	public function scrap2($url) {
		require_once "support/http.php";
		require_once "support/simple_html_dom.php";
		
	
		$html = new simple_html_dom ();
		
		$url = 'http://' . $url;
		$options = array (
				"headers" => array (
						"User-Agent" => HTTP::GetWebUserAgent ( "Chrome" ),
						"Accept" => "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
						"Accept-Language" => "en-us,en;q=0.5",
						"Accept-Charset" => "ISO-8859-1,utf-8;q=0.7,*;q=0.7",
						"Cache-Control" => "max-age=0" 
				) 
		);
		$result = HTTP::RetrieveWebpage ( $url, $options );
		if (! $result ["success"])
			echo "Error retrieving URL.  " . $result ["error"] . "\n";
		else if ($result ["response"] ["code"] != 200)
			echo "Error retrieving URL.  Server returned:  " . $result ["response"] ["code"] . " " . $result ["response"] ["meaning"] . "\n";
		else {
			echo "All the URLs:\n";
			$html->load ( $result ["body"] );
			$rows = $html->find ( "a[href]" );
			return $rows;
		}
	}
	public function scrap3() {
		require_once "support/http.php";
		require_once "support/web_browser.php";
		require_once "support/simple_html_dom.php";
		
		$url = "http://www.pisapapeles.net";
		$web = new WebBrowser ( array (
				"extractforms" => true 
		) );
		$result = $web->Process ( $url );
		
		if (! $result ["success"])
			echo "Error retrieving URL.  " . $result ["error"] . "\n";
		else if ($result ["response"] ["code"] != 200)
			echo "Error retrieving URL.  Server returned:  " . $result ["response"] ["code"] . " " . $result ["response"] ["meaning"] . "\n";
		else if (count ( $result ["forms"] ) != 1)
			echo "Was expecting one form.  Received:  " . count ( $result ["forms"] ) . "\n";
		else {
			$form = $result ["forms"] [0];
			
			$form->SetFormValue ( "q", "barebones cms" );
			
			$result2 = $form->GenerateFormRequest ( "btnK" );
			$result = $web->Process ( $result2 ["url"], "auto", $result2 ["options"] );
			
			if (! $result ["success"])
				echo "Error retrieving URL.  " . $result ["error"] . "\n";
			else if ($result ["response"] ["code"] != 200)
				echo "Error retrieving URL.  Server returned:  " . $result ["response"] ["code"] . " " . $result ["response"] ["meaning"] . "\n";
			else {
				// Do something with the results page here...
			}
		}
	}
	public function scrap4() {
		require_once "support/http.php";
		require_once "support/web_browser.php";
		require_once "support/simple_html_dom.php";
		require_once "support/multi_async_helper.php";
		
		// The URLs we want to load.
		$urls = array (
				"http://www.barebonescms.com/",
				"http://www.cubiclesoft.com/",
				"http://www.pisapeles.net" 
		);
		
		// Build the queue.
		$helper = new MultiAsyncHelper ();
		$helper->SetConcurrencyLimit ( 3 );
		
		// Mix in a regular file handle just for fun.
		$fp = fopen ( __FILE__, "rb" );
		stream_set_blocking ( $fp, 0 );
		$helper->Set ( "__fp", $fp, "MultiAsyncHelper::ReadOnly" );
		
		// Add the URLs to the async helper.
		$pages = array ();
		foreach ( $urls as $url ) {
			$pages [$url] = new WebBrowser ();
			$pages [$url]->ProcessAsync ( $helper, $url, NULL, $url );
		}
		
		// Run the main loop.
		$result = $helper->Wait ();
		while ( $result ["success"] ) {
			// Process the file handle if it is ready for reading.
			if (isset ( $result ["read"] ["__fp"] )) {
				$fp = $result ["read"] ["__fp"];
				$data = fread ( $fp, 500 );
				if ($data === false || feof ( $fp )) {
					echo "End of file reached.\n";
					
					$helper->Remove ( "__fp" );
				}
			}
			
			// Process everything else.
			foreach ( $result ["removed"] as $key => $info ) {
				if ($key === "__fp")
					continue;
				
				if (! $info ["result"] ["success"])
					echo "Error retrieving URL (" . $key . ").  " . $info ["result"] ["error"] . "\n";
				else if ($info ["result"] ["response"] ["code"] != 200)
					echo "Error retrieving URL (" . $key . ").  Server returned:  " . $info ["result"] ["response"] ["line"] . "\n";
				else {
					echo "A response was returned (" . $key . ").\n";
					
					// Do something with the data here...
				}
				
				unset ( $pages [$key] );
			}
			
			// Break out of the loop when nothing is left.
			if ($result ["numleft"] < 1)
				break;
			
			$result = $helper->Wait ();
		}
		
		// An error occurred.
		if (! $result ["success"])
			var_dump ( $result );
	}
	public function scrap5() {
		
		// Requires both the WebBrowser and HTTP classes to work.
		require_once "support/websocket.php";
		require_once "support/web_browser.php";
		require_once "support/http.php";
		
		$ws = new WebSocket ();
		
		// The first parameter is the WebSocket server.
		// The second parameter is the Origin URL.
		$result = $ws->Connect ( "ws://ws.something.org/", "http://www.pisapapeles.net" );
		if (! $result ["success"]) {
			var_dump ( $result );
			exit ();
		}
		
		// Send a text frame (just an example).
		$result = $ws->Write ( "Testtext", WebSocket::FRAMETYPE_TEXT );
		
		// Send a binary frame (just an example).
		$result = $ws->Write ( "Testbinary", WebSocket::FRAMETYPE_BINARY );
		
		// Main loop.
		$result = $ws->Wait ();
		while ( $result ["success"] ) {
			do {
				$result = $ws->Read ();
				if (! $result ["success"])
					break;
				if ($result ["data"] !== false) {
					// Do something with the data.
					var_dump ( $result ["data"] );
				}
			} while ( $result ["data"] !== false );
			
			$result = $ws->Wait ();
		}
		
		// An error occurred.
		var_dump ( $result );
	}
	public function scrap6() {
		require_once "support/http.php";
		require_once "support/web_browser.php";
		require_once "support/simple_html_dom.php";
		
		// Customize options.
		$basepath = str_replace ( "\\", "/", dirname ( __FILE__ ) ) . "/html";
		$baseurl = "http://www.pisapapeles.net/";
		$rootdomains = array (
				"http://www.mysite.com/",
				"http://mysite.com/" 
		);
		$rootdocs = array (
				"index.html",
				"index.php" 
		);
		$livescan = false;
		function LoadURLs(&$urls, $baseurl, $basepath) {
			if (substr ( $baseurl, - 1 ) != "/")
				$baseurl .= "/";
			
			$dir = @opendir ( $basepath );
			if ($dir) {
				while ( ($file = readdir ( $dir )) !== false ) {
					if ($file != "." && $file != "..") {
						if (is_dir ( $basepath . "/" . $file ))
							LoadURLs ( $urls, $baseurl . $file, $basepath . "/" . $file );
						else
							$urls [HTTP::ConvertRelativeToAbsoluteURL ( $baseurl, $file )] = $basepath . "/" . $file;
					}
				}
				
				closedir ( $dir );
			}
		}
		
		$html = new simple_html_dom ();
		$urls = array ();
		LoadURLs ( $urls, $baseurl, $basepath );
		
		// Find the root file.
		$processurls = array ();
		foreach ( $rootdocs as $file ) {
			$url = HTTP::ConvertRelativeToAbsoluteURL ( $baseurl, $file );
			if (isset ( $urls [$url] )) {
				$processurls [] = $url;
				
				break;
			}
		}
		
		// Process all URLs.
		while ( count ( $processurls ) ) {
			$url = array_shift ( $processurls );
			if (isset ( $urls [$url] )) {
				$filename = $urls [$url];
				unset ( $urls [$url] );
				
				if (! $livescan)
					$data = ( string ) @file_get_contents ( $filename );
				else {
					$web = new WebBrowser ();
					$result = $web->Process ( $url );
					$data = "";
					
					if (! $result ["success"])
						echo "Error retrieving URL.  " . $result ["error"] . "\n";
					else if ($result ["response"] ["code"] != 200)
						echo "Error retrieving URL.  Server returned:  " . $result ["response"] ["code"] . " " . $result ["response"] ["meaning"] . "\n";
					else
						$data = $result ["body"];
				}
				
				$html->load ( $data );
				$rows = $html->find ( "a[href]" );
				foreach ( $rows as $row ) {
					$url2 = ( string ) $row->href;
					foreach ( $rootdomains as $domain ) {
						if (strtolower ( substr ( $url2, 0, strlen ( $domain ) ) ) == strtolower ( $domain ))
							$url2 = substr ( $url2, strlen ( $domain ) - 1 );
					}
					$url2 = HTTP::ConvertRelativeToAbsoluteURL ( $url, $url2 );
					
					$processurls [] = $url2;
				}
			}
		}
		
		// Output files not referenced anywhere.
		echo "Orphaned files:\n\n";
		foreach ( $urls as $url => $file ) {
			echo $file . "\n";
		}
	}
	public function scrap7() {
	}
	public function scrap8() {
	}
}


