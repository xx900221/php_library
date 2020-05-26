<?
/**
 *
此為session類別
功能為 每日更換新的通行證 並且檢查
需要一個常駐頁面運行 EVECHange()

session 寫入 sessionin()
session 讀取 check_pass()
 */
class sesion_library 
{


	public $file_  = "pass.xml" ;
	function __construct()
	{
		session_start();
	}
	private function passwordcreate() //更換密碼
	{
		$str =	rand(5, 15000);
		$file = fopen($this->file_,"w"); //開啟檔案 (複寫)
	    fwrite($file,$str);
	    fclose($file);
	}

	private function md5inutput($name) //加密
	{
		return md5_file($name);
	}

	public function sessionin() //寫入session
	{
		$password = $this->md5inutput($this->file_);
		$_SESSION['pass'] = $password;
	}

	public function EVECHange()   //每日更換密碼
	{
		$this->passwordcreate();
		$this->sessionin();
	}

	public function check_pass()   // 檢查通行證
	{
		if(isset($_SESSION['pass']))
		{
		    $f =  $this->md5inutput($this->file_) ;
			$b =  $_SESSION['pass'];
			if($f === $b){
				return true;
			}
			else
			{
				return false;
			}

		}
		else
		{
			return false;
		}
	}

}

 
/*******範例*******************************
$a = new sesion_library();
// $a->file_ = 123.xml; //設定存密碼的檔案
// $a->EVECHange();  //每日更換
// $a->md5inutput();
if ($a->check_pass()){
	echo 'pass';
	//......通過
}else{
	echo 'refuse';
	//......不通過
}
*******************************************/
?>