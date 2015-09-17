<?php
class Products extends CI_Controller {

	 function products(){
		parent::__construct();
		$this->load->database();
		$this->load->model('product');

	}

	function lists()
	{
		$search_word = $page_url = '';
		$uri_segment = 4;
		$uri_array = $this->segment_explode($this->uri->uri_string());

		if(in_array('q', $uri_array)){
			$search_word = urldecode($this->url_explode($uri_array,'q'));

			//페이지네이션용 주소
			 $page_url = '/q/'.$search_word;
			 $uri_segment =6;
		}
		$this->load->library('pagination');

		$config['base_url'] = 'http://localhost/shop/index.php/products/lists/'.$page_url.'/page/';
		#게시물의 전체 갯수 지금은 몇개인지 알고있다 추후 주석대로 변경.
		$config['total_rows'] = 1700; # $this->modelName->get_list($this->uri->segment(1),'count','','',$search_word);
		$config['per_page'] = 10;
		$config['uri_segment'] = $uri_segment;

		$this->pagination->initialize($config);
		//주소중에서 q(검색어) 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환

		#var_dump($this->uri->uri_string());
		#$uri_array[3] = isset($uri_array[3])? $uri_array[3]:0 ;


		$data['pagination'] = $this->pagination->create_links();
		//게시판 목록을 불러오기 위한 offset, limit 값 가져오기
		$data['page'] = $page = $this->uri->segment( $uri_segment,1);

		var_dump($page);

		if ( $page > 1 )
		{
			$start = (($page/$config['per_page'])) * $config['per_page'];
		}
		else
		{
			$start = ($page-1) * $config['per_page'];
		}

		$limit = $config['per_page'];
		#$data['pagination'] = $this->pagination->create_links();
		$data['list'] = $this->product->get_list($this->uri->segment(1), '', $start, $limit, $search_word);

		// var_dump($this->uri->segment(0));

		$this->load->view('header');
		$this->load->view('product', $data);
		$this->load->view('footer');
	}



	//필요한 양만큼 리스트에 넣어준다.
	function list_mount($mount){
		$start = 0; $limit = $mount; $search_word='';
		$data['list'] = $this->product->get_list('products', '', $start, $limit, $search_word);
	}

	 function index()
	{

				// $result = $this->product->gets();
				// $this->load->view('header');
				// $this->load->view('product', array('result'=>$result));
				// $this->load->view('footer');

	}

	/**
 * url중 키값을 구분하여 값을 가져오도록.
 *
 * @param Array $url : segment_explode 한 url값
 * @param String $key : 가져오려는 값의 key
 * @return String $url[$k] : 리턴값
 */
function url_explode($url, $key)
{
	$cnt = count($url);
	for($i=0; $cnt>$i; $i++ )
	{
		if($url[$i] ==$key)
		{
			$k = $i+1;
			return $url[$k];
		}
	}
}


	/**
 * HTTP의 URL을 "/"를 Delimiter로 사용하여 배열로 바꾸어 리턴한다.
 *
 * @param	string	대상이 되는 문자열
 * @return	string[]
 */
function segment_explode($seg)
{
	//세크먼트 앞뒤 '/' 제거후 uri를 배열로 반환
	$len = strlen($seg);
	if(substr($seg, 0, 1) == '/')
	{
		$seg = substr($seg, 1, $len);
	}
	$len = strlen($seg);
	if(substr($seg, -1) == '/')
	{
		$seg = substr($seg, 0, $len-1);
	}
	$seg_exp = explode("/", $seg);
	return $seg_exp;
}
}
?>
