<?php require_once('lib/atz.php');?>
<?php 
class comment_controller extends atz{

	public function __construct() { 

		$this->post = array(
			'com_desc'=>'',
			'tenkhach'=>'',
			'dienthoai'=>'',
			'email'=>'',
			'gioitinh'=>'',
			'tensp'=>'',
			
			'danhgia'=>''
			
		);
	}
public function update_comment(){

		
		if(isset($_POST['id']) && !empty($_POST['id'])){

			
			$comment = $this->select('comment',array('com_id' => $_POST['id']),'com_id, com_desc, tenkhach, dienthoai, email, gioitinh, tensp, hinhanh, danhgia    ');

			if(!empty($comment)){
				
				$comment = $comment[0];

				$_SESSION['comment'][$comment['com_id']] = $comment;
				
				return $_SESSION['comment'];
			}
		}


		
		
		
		
	}

	
	public function confirm_comment(){
		
		if(isset( $_POST['submit']) && !empty($_POST)){

			foreach ($_POST as $k => $v) {
				if(isset($this->post[$k])){
					$this->post[$k] =$v;
				}
			}

			

			if(!empty($_POST['com_id'])){

				foreach ($_POST['com_id'] as $v) {
					$rs = $this->select('comment',array('com_id' => $v),'com_id, com_desc, tenkhach, dienthoai, email, gioitinh, tensp, hinhanh, danhgia ');
					if(!empty($rs)){
						$comment[] = $rs[0];
						
					}
				}
			}
			
			

			$error = array();

			if(empty($_SESSION['comment'])){
				$error['main'] = 'Không có bình luận nào';
			}
			if(!$this->post['com_desc']){
				$error['com_desc'] = 'Chưa nhập bình luận';
			}
			if(!$this->post['tenkhach']){
				$error['tenkhach'] = 'Chưa nhập tên khách hàng';
			}
			if(!$this->post['dienthoai']){
				$error['dienthoai'] = 'Chưa nhập số điện thoại';
			}
			if(!$this->post['email']){
				$error['email'] = 'Chưa nhập email';
			}
			if(!$this->post['gioitinh']){
				$error['gioitinh'] = 'Chưa nhập giới tính';
			}
            if(!$this->post['tensp']){
				$error['tensp'] = 'Chưa nhập tên sản phẩm';
			}
			if(!$this->post['danhgia']){
				$error['danhgia'] = 'Chưa chọn đánh giá';
			}
			
			if(empty($error)){
				
				$rs = $this->insert('comment', $this->post);

				if($rs==1){
					$success['main'] = 'gửi thành công!';
					$rs = array('success' => $success);

					unset($_POST);
					unset($_SESSION['comment']);

				}else{
					$error['main'] = 'Có lỗi xảy ra. Vui lòng thử lại sau';
					$rs = array('error' => $error);
				}
				return $rs;

			}else{
				$rs = array('error' => $error);
				return $rs;	
			}
		}
		
	}
}
?>