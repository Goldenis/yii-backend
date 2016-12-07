<?php

namespace api\modules\v1\controllers;

use yii\rest\ActiveController;
use Yii;
use api\modules\v1\models\User;
/**
 * User Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class UserController extends ActiveController
{
    public $modelClass = 'api\modules\v1\models\User';

    public function actionInfo(){
    $pass['success'] = true;
    $pass['data']['info'] = "Some information about the <b>company</b>";
    echo json_encode($pass,JSON_PRETTY_PRINT);
 
    }
    public function actionRegister(){

        $params = Yii::$app->request->post();
                

        $model = new User();
        $model->email = $params['email'];        
        $model->info = $params['info'];

        $CheckExistingUser = $model->findOne(['email' => $params['email']]);

        if(!$CheckExistingUser) {            
            $model->password = md5($params['password']);
            
            if ($model->save(false)){  //mail sending
                $response['success'] = true;
                $response['data'] = [];
            }
            else
            {
                $response['success'] = false ;             
                $response['data'] = 'Error';
            }
        }else{
            $response['success'] = false ;             
            $response['data'] = 'Existing User';
        }
        echo json_encode($response,JSON_PRETTY_PRINT);
 
    }   

    public function behaviors(){
        $behaviors = parent::behaviors();
        
        $behaviors['contentNegotiator'] = [
                    'class' => 'yii\filters\ContentNegotiator',
                    'formats' => [
                        'application/json' => \yii\web\Response::FORMAT_JSON,
                    ],
        ];
        

              
        return $behaviors;
    }
}


