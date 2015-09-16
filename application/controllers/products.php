<?php
class Products extends CI_Controller {

	 function products(){
		parent::__construct();
		$this->load->database();
		$this->load->model('product');

	}

	function lists()
	{
		$this->load->library('pagination');
		$uri_segment = 5;
		$search_word = '';
		$config['base_url'] = 'http://localhost/shop/index.php/products/lists/';
		$config['total_rows'] = 1700;
		$config['per_page'] = 10;
		$config['uri_segment'] = 3;
		$configp['num_links'] =0;
		$this->pagination->initialize($config);
		//주소중에서 q(검색어) 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환
		$uri_array = $this->segment_explode($this->uri->uri_string());
		#var_dump($uri_array);
		$uri_array[3] = isset($uri_array[3])? $uri_array[3]:0 ;

		// if( in_array('q', $uri_array) ) {
		// 	//주소에 검색어가 있을 경우의 처리. 즉 검색시
		// 	$search_word = urldecode($this->url_explode($uri_array, 'q'));
		//
		// 	//페이지네이션용 주소
		// 	$page_url = '/q/'.$search_word;
		// 	$uri_segment = 7;
		// }

		//게시판 목록을 불러오기 위한 offset, limit 값 가져오기
		$data['page'] = $page = $this->uri->segment(3,1);

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
		$data['pagination'] = $this->pagination->create_links();
		$data['list'] = $this->product->get_list('products', '', $start, $limit, $search_word);




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

				$result = $this->product->gets();
				#var_dump($result);

				$this->load->library('pagination');


				// echo "<Br><Br><Br><Br><Br><Br><Br><Br>";
				// echo($data['pagination']);
				$this->load->view('header');
				$this->load->view('product', array('result'=>$result));
				$this->load->view('footer');

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
