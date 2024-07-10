<?php

namespace app\modules\v1\models\form;

use app\modules\v1\models\LeaveRequest;
use app\modules\v1\models\resource\LeaveRequestResource;

class LeaveRequestForm extends \app\models\LeaveRequest
{

    public $request_date;
    public $content;

    public function rules()
    {
        return [
            [['request_date', 'content'], 'required'],
        ];
    }

    public function request()
    {
        if ($this->validate()) {
            $leaveRequest = new LeaveRequestResource();
            $leaveRequest->request_date = $this->request_date;
            $leaveRequest->content = $this->content;
            $leaveRequest->status = 'Pending';
            return $leaveRequest->save();    
        }

        return false;
    }

}