<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Search extends CI_Controller {
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * http://example.com/index.php/welcome
	 * - or -
	 * http://example.com/index.php/welcome/index
	 * - or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 *
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		$data ['page'] = 'search/main';
		$data ['name'] = 'Scraping';
		$this->load->view ( 'template/template', $data );
	}
	public function search_site_url() {
		$this->form_validation->set_rules ( 'url', 'url', 'required' );
		
		if ($this->form_validation->run () == FALSE) {
			redirect ( 'Search' );
		} else {
			$this->load->Library ( 'searchLib' );
			
			$data ['page'] = 'search/search_site';
			$data ['name'] = 'Search Results';
			// $data ['scrap'] = $this->searchlib->search_site ( $this->input->post ( 'url' ) );
			$data ['scrap'] = $this->searchlib->scrap2 ( $this->input->post ( 'url' ) );
			$this->load->view ( 'template/template', $data );
		}
	}
	public function scrap2() {
		require_once "support/http.php";
		
		require_once "support/simple_html_dom.php";
		
		$html = new simple_html_dom ();
		
		$url = "http://www.somesite.com/something/";
		
		$options = array (
				
				"headers" => array (
						
						"User-Agent" => HTTP::GetWebUserAgent ( "Firefox" ),
						
						"Accept" => "text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8",
						
						"Accept-Language" => "en-us,en;q=0.5",
						
						"Accept-Charset" => "ISO-8859-1,utf-8;q=0.7,*;q=0.7",
						
						"Cache-Control" => "max-age=0" 
				) 
		)
		;
		
		$result = HTTP::RetrieveWebpage ( $url, $options );
		
		if (! $result ["success"])
			echo "Error retrieving URL.  " . $result ["error"] . "\n";
		
		else if ($result ["response"] ["code"] != 200)
			echo "Error retrieving URL.  Server returned:  " . $result ["response"] ["code"] . " " . $result ["response"] ["meaning"] . "\n";
		
		else {
			
			echo "All the URLs:\n";
			
			$html->load ( $result ["body"] );
			
			$rows = $html->find ( "a[href]" );
			
			foreach ( $rows as $row ) 

			{
				
				echo "\t" . $row->href . "\n";
			}
		}
	}
}
