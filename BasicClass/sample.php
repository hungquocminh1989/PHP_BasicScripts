<?php
//Cơ bản các lớp hướng đối tượng trong PHP

/**
* ★★★★★★★★★★
* ABSTRACT CLASS
* ★★★★★★★★★★
*/
abstract class abst_class_A //Lớp kế thừa
{
	protected function fn_A() //Hàm protected chỉ gọi được bên trong class hoặc class kế thừa
	{
		echo "<br>";
		echo "fn_A";
	}
	private function fn_A1() //Hàm private chỉ gọi được bên trong class của chính nó
	{
		echo "<br>";
		echo "fn_A1";
	}
	public function fn_A2() //Ở đâu gọi cũng được (thông qua kế thừa hoặc đối tượng)
	{
		echo "<br>";
		echo "fn_A2";
	}
}
abstract class abst_class_B extends abst_class_A //Lớp kế thừa 
{
	final protected function fn_B() //final function trong abstract class sẽ không cho phép overide
	{
		echo "<br>";
		echo "fn_B";
	}
}
abstract class abst_class_C extends abst_class_B
{
	public function this_C() 
	{
		$this->fn_C_1();
	}
	public function static_C() 
	{
		static::fn_C_1();
	}
	public static function static_C_1() 
	{
		static::fn_C_1();
	}
	public function self_C() 
	{
		self::fn_C_1();
	}
	public function fn_C_1() 
	{
		echo "<br>";
		echo "fn_C_1";
	}
}

/**
* ★★★★★★★★★★
* INTERFACE CLASS
* ★★★★★★★★★★
*/
interface iA //Lớp giao diện
{
	public function interface_A();
}
interface iB //Lớp giao diện
{
	public function interface_B();//Chỗ nào kế thừa lớp giao diện bắt buộc phải overide lại
}

/**
* ★★★★★★★★★★
* NORMAL CLASS
* ★★★★★★★★★★
*/
class sample extends abst_class_C implements iA,iB //1 lớp chỉ kế thừa được duy nhất 1 lớp khác và kế thừa được nhiều lớp giao diện
{
	public function interface_A()
	{
		echo "<br>";
		echo "Overide interface_A";
	}
	public function interface_B()
	{
		echo "<br>";
		echo "Overide interface_B";
	}
	function fn_A()
	{
		echo "<br>";
		echo "Overide fn_A";
	}
	public function fn_C_1() 
	{
		echo "<br>";
		echo "Overide fn_C_1";
	}
	public function exec_A()
	{
		$this->fn_A();
	}
	public function exec_B()
	{
		$this->fn_B();
	}
	
}

/**
* ★★★★★★★★★★
* SAMPLE DEPENDENCY INJECTION
* ★★★★★★★★★★
*/
interface DI_Thong_Bao //Lớp giao diện
{
	public function gui_thong_bao();
}
class sample_dependency_injection
{
	public $obj_di = NULL;
	
	public function __construct (DI_Thong_Bao $di){
		$this->obj_di = $di;
	}
	
	public function change_di(DI_Thong_Bao $di){
		$this->obj_di = $di;
	}
	public function gui(){
		$this->obj_di->gui_thong_bao();
	}
}

class email implements DI_Thong_Bao {
	public function gui_thong_bao(){
		echo "<br>";
		echo "gui thong bao mail";
	}
}

class sms implements DI_Thong_Bao {
	public function gui_thong_bao(){
		echo "<br>";
		echo "gui thong bao sms";
	}
}

/**
* ★★★★★★★★★★
* USE CLASS
* ★★★★★★★★★★
*/
$model = new sample();
$model->exec_A();
$model->exec_B();

//Sự khác biệt giữa self / $this / static
$model->this_C();//This : Truy xuất đến đối tượng hiện tại.
$model->self_C();//Self : Truy xuất đến class khai báo nó.
$model->static_C();//Static: Truy xuất đến đối tượng hiện tại.
sample::static_C_1();//Static: Truy xuất đến đối tượng hiện tại.
abst_class_C::static_C_1();//Static: Truy xuất đến đối tượng hiện tại.

//SAMPLE DEPENDENCY INJECTION
$email = new email();
$sms = new sms();

$thongbao = new sample_dependency_injection($email);
$thongbao->gui();

$thongbao->change_di($sms);
$thongbao->gui();

?>