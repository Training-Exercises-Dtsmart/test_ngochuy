<?php

namespace app\modules\v1\models\resource;

use app\models\LeaveRequest;

class LeaveRequestResource extends LeaveRequest
{
     public function fields()
     {
          return ['id', 'content', 'request_date', 'status', 'created_at', 'updated_at', 'created_by'];
     }

}