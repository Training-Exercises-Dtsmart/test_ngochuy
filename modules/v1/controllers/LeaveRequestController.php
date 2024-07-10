<?php 
namespace app\modules\v1\controllers;

use app\modules\v1\models\enum\ProgressStatus;
use Yii;
use app\modules\v1\models\enum\HttpStatus;
use app\modules\v1\models\form\LeaveRequestForm;
use app\controllers\Controller;
use app\modules\v1\models\LeaveRequest;
use app\modules\v1\models\pagination\Pagination;

class LeaveRequestController extends Controller
{
    public function actionIndex()
    {
        $requests = LeaveRequest::find();
        if (!$requests) {
            return $this->json(false, ['errors' => $requests->getErrors()], 'Request not found', HttpStatus::NOT_FOUND);
        }

        $dataProvider = Pagination::getPagination($requests, 10, SORT_DESC);
        return $this->json(true, ['data' => $dataProvider], 'success', HttpStatus::OK);
    }

    public function actionCreate()
    {
        $request = new LeaveRequestForm();
        $request->load(Yii::$app->request->post(), '');
        if (!$request->validate() || !$request->request()) {
            return $this->json(false, $request->getErrors(), 'Request not saved', HttpStatus::NOT_FOUND);
        }
        return $this->json(true, ['data' => $request], 'success', HttpStatus::OK);
    }

    public function actionApprove($id)
    {
        $leaveRequest = LeaveRequestForm::findOne($id);
        if (Yii::$app->user->identity->is_hr && $leaveRequest) {
            $leaveRequest->status = ProgressStatus::APPROVED;
            $leaveRequest->save();
        }
        return $this->json(true, ['data' => $leaveRequest], 'success', HttpStatus::OK);
    }   

    public function actionDisapprove($id)
    {
        $leaveRequest = LeaveRequest::findOne($id);
        if (Yii::$app->user->identity->is_hr && $leaveRequest) {
            $leaveRequest->status = ProgressStatus::DISAPPROVED;
            $leaveRequest->save();
        }

        return $this->json(true, ['data' => $leaveRequest], 'success', HttpStatus::OK);
    }
}
