<?php
	class Product extends CI_Model{

		function __construct(){
			parent::__construct();
		}

		function gets(){
			return $this->db->query("select * from products")->result();
		}

		function get_two(){
			return $this->db->query("select * from products limit 2")->result();
		}

		function get_list($table = 'products', $type='', $offset='',$limit='',$search_word=''){

				// $sword= ' where 1=1';
				//검색어가 있을경우 검색구현시 다시 구현할 예정
				// if($search_word!= '')
					// {
						#$sword = ' where 검색하고자하는 필드명  like "% ' .$search_word . '%" or 검색하고자하는 필드명2  like "%' .$search_word. '%" ';
					// }
				$limit_query ='';

				//페이징 처리를 해야하는 경우
				if($limit != '' OR $offset != ''){

					$limit_query = ' LIMIT ' . $offset . ', '. $limit;
				}

				#$table = 'products';

				$sql = " select * from " . $table . $limit_query ;

				var_dump($sql);

				$query = $this->db->query($sql);

				//개시물 수만 반환 하는경우
				// if($type == 'count'){
				// 	$result = $query-> num_rows();
				// }else{
				$result = $query-> result();
				// }
				return $result;
		}
	}
?>
