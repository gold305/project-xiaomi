<?php
namespace app\index\model;

use think\Model;
use think\Db;
class Notemodel extends Model
{
    //判断账号是否存在
    public function is_zai($where){
        return Db::name('note')->where($where)->find();
    }

    //注册添加数据
    public function addDenglu($charu){
        return Db::name('note')->insert($charu);
    }
    
}