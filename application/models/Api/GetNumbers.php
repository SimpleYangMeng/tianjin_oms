<?php
class GetNumber
{
    private $applicationCode,  $customerCode, $time, $prefix;

    public function __construct($applicationCode = '', $customerCode = '',$prefix = 'E')
    {
        $this->prefix = $prefix;
        $this->time = $this->timeSlice();
        $this->customerCode = $customerCode;
        //$this->warehouseId = $warehouseId;
        $this->applicationCode = $applicationCode;
    }

    public function getCode()
    {
    	if($this->applicationCode=='order') $this->time = '';
        return strtoupper($this->prefix . $this->customerCode . $this->time . $this->getSequence());
    }

    private function getOrderCnt()
    {
        $condition = array(
            'application_code' => $this->applicationCode,
            //'warehouse_id' => $this->warehouseId
        );
        if ($this->customerCode != '') {
            $condition['customer_code'] = $this->customerCode;
            $customerRow = Service_Customer::getByField($this->customerCode, 'customer_code');
        }
        $application = Service_Application::getByCondition($condition, '*');
        $date = date('Ymd');
        if($this->applicationCode=='order') $date = '';
        $time = date('Y-m-d H:i:s');
        if (empty($application)) {
            $row = array(
                //'warehouse_id' => $this->warehouseId,
                'application_code' => $this->applicationCode,
                'current_number' => $date . '-1',
                'app_add_time' => $time
            );
            $row['customer_id'] = isset($customerRow['customer_id']) ? $customerRow['customer_id'] : 0;
            $row['customer_code'] = isset($customerRow['customer_code']) ? $customerRow['customer_code'] : '';
            Service_Application::add($row);
            return '1';
        } else {
            if (!empty($application[0]['current_number']) && isset($application[0]['current_number'])) {
                $arr = explode('-', $application[0]['current_number']);
                if ($date == $arr[0]) {
                    $count = $arr[1] + 1;
                } else {
                    $count = 1;
                }
            } else {
                $count = 1;
            }
            $update = array('current_number' => $date . '-' . $count, 'app_update_time' => $time);
            Service_Application::update($update, $application[0]['application_id']);
        }
        return $count;
    }

    private function getSequence()
    {
        return sprintf('%07s', $this->getOrderCnt());
    }

    public function timeSlice()
    {
        return date('ymd');
    }


}

class Common_GetNumbers
{
    public static function getCode($applicationCode = '', $customerCode = '', $prefix = 'E')
    {
        $obj = new GetNumber($applicationCode, $customerCode, $prefix);
        return $obj->getCode();
    }
}