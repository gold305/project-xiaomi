<?php
    namespace app\admin\model;
    
    use think\Model;
    use think\Db;
    
    class UserleModel extends Model
    {
        //模糊查询加分页
        public function showfan($where,$limit)
        {
            return Db::name('note')->where($where)->limit($limit)->select();
        }
        
        //查询数据结果总数
        public function countfan($where)
        {
            return Db::name('note')->where($where)->select();
        }
    }
