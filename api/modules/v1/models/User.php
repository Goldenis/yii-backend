<?php
namespace api\modules\v1\models;
use \yii\db\ActiveRecord;
/**
 * User Model
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class User extends ActiveRecord
{
	/**
	 * @inheritdoc
	 */
    public $rememberMe;
    public $confirm_password;
    public $_user = false;
	public static function tableName()
	{
		return 'user';
	}

    /**
     * @inheritdoc
     */
    public static function primaryKey()
    {
        return ['id'];
    }

    /**
     * Define rules for validation
     */
    public function rules()
    {
        return [
            [['id', 'email', 'password'], 'required']
        ];
    }
    public function register(){
        $response["success"] =  true;
        $response["data"] =  array();
        return json_encode($response);
    }
    public static function getConfirmationLink() {
        $characters = 'abcedefghijklmnopqrstuvwxyzzyxwvutsrqponmlk';
        $confirmLinkID = '';
        for ($i = 0; $i < 10; $i++) {
          $confirmLinkID .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $confirmLinkID = md5($confirmLinkID);
      }
}
