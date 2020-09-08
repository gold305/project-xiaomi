<?php
namespace app\index\model;

use think\Db;
use think\Model;
//验证登录
class Dengmodel extends Model{
	public function mylogin($where){
		return Db::name('note')->where($where)->select();
	}
}
?>