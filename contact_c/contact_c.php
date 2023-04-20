<?php require_once('lib/atz.php');?>
<?php 
class contact_controller extends atz{

	public function __construct() { 

		$this->post = array(
			'Contact_Name'=>'',
			'Contact_Subject'=>'',
			'Contact_Email'=>'',
			'Contact_Phone' =>'',
			
			'Contact_Message'=>'',
			
			'Contact_Created'=> date('Y-m-d H:i:s'),
			'Contact_Update'=> date('Y-m-d H:i:s')
			
		);
	}
public function update_contact(){

		
		if(isset($_POST['id']) && !empty($_POST['id'])){

			
			$contact = $this->select('contact',array('Contact_ID' => $_POST['id']),'Contact_ID, Contact_Name, Contact_Subject, Contact_Email, Contact_Phone, Contact_Message ');

			if(!empty($contact)){
				
				$contact = $contact[0];

				$_SESSION['contact'][$contact['Contact_ID']] = $contact;
				
				return $_SESSION['contact'];
			}
		}


		
		
		
		
	}

	
	public function confirm_contact(){
		
		if(isset( $_POST['submit']) && !empty($_POST)){

			foreach ($_POST as $k => $v) {
				if(isset($this->post[$k])){
					$this->post[$k] =$v;
				}
			}

			

			if(!empty($_POST['contact_id'])){

				foreach ($_POST['contact_id'] as $v) {
					$rs = $this->select('contact',array('Contact_ID' => $v),'Contact_ID, Contact_Name, Contact_Subject, Contact_Email, Contact_Phone, Contact_Message ');
					if(!empty($rs)){
						$contact[] = $rs[0];
						
					}
				}
			}
			
			

			$error = array();

			if(empty($_SESSION['contact'])){
				$error['main'] = 'Không có thông tin liên hệ nào';
			}
			if(!$this->post['Contact_Name']){
				$error['Contact_Name'] = 'Chưa nhập họ tên';
			}
			if(!$this->post['Contact_Subject']){
				$error['Contact_Subject'] = 'Chưa nhập nội dung';
			}
			if(!$this->post['Contact_Phone']){
				$error['Contact_Phone'] = 'Chưa nhập số điện thoại của bạn';
			}elseif(!is_numeric($this->post['Contact_Phone'])){
				$error['Contact_Phone'] = 'Chỉ được nhập số';
			}
			if($this->post['Contact_Email'] && !filter_var($this->post['Contact_Email'], FILTER_VALIDATE_EMAIL)){
				$error['Contact_Email'] = 'Email không hợp lệ';
			}if(!$this->post['Contact_Message']){
				$error['Contact_Message'] = 'Chưa nhập tin nhắn';
			}
			
			

			
			if(empty($error)){
				
				$rs = $this->insert('contact', $this->post);

				if($rs==1){
					$success['main'] = 'Liên hệ thành công!';
					$rs = array('success' => $success);

					unset($_POST);
					unset($_SESSION['contact']);

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