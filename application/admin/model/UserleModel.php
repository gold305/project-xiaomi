<?php
    namespace app\admin\model;
    
    use think\Model;
    use think\Db;
    
    class UserleModel extends Model
    {
        public function showfan($where)
        {
            return Db::name('note')->where($where)->select();
        }
    }
