<?php
namespace app\common\model;

use think\facade\Log;

class OperationLog extends Common
{
    protected $autoWriteTimestamp = true;
    protected $createTime = 'ctime';
    protected $updateTime = false;
    /**
     * 保存操作日志信息
     * @param array $data
     * @return int|string
     */
    public function doAdd($data = [])
    {
        $result = $this->save($data);
        if ($result) {
            return $this->getLastInsID();
        }
        return $result;
    }

    protected function tableWhere($post)
    {
        $where = [];
        $result['where'] = $where;
        $result['field'] = "*";
        $result['order'] = "id desc";
        return $result;
    }

    protected function tableFormat($list)
    {
        if(!$list->isEmpty()){
            foreach($list as $key=>$val){
                $list[$key]['ctime'] = getTime($val['ctime']);
                $list[$key]['username'] = get_user_info($val['manage_id']);
            }
        }
        return parent::tableFormat($list); // TODO: Change the autogenerated stub
    }

}