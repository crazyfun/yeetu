<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
		private $_id;
		public $permissions_type;
	  const ERROR_ADMIN=10;
	  const ERROR_PERMISSIONS=15;
    public function authenticate(){
    	 
    	  $user=new User('AdminLogin');
        $user_datas=$user->findAll("(user_login=:user_login OR email=:user_login)",array(':user_login'=>$this->username));
        $user_data=$user_datas[0];
        if($user_data===null){
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        }else if($user_data->password!=Util::hc($this->password,$user_data->salt)){//Util::hc($this->password,$user_data->salt)){        		
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        }else
        {
        	if($user_data->status!=2){
        		$this->errorCode=self::ERROR_ADMIN;
        	}else{
  
        		$user_permissions_type=$user_data->permissions_type;
        		if(($this->permissions_type!=$user_permissions_type)&&($user_data->id!='1')){
        			$this->errorCode=self::ERROR_PERMISSIONS;
        		}else{
             $this->_id=$user_data->id;
             //$this->setState('title', $user_data->user_login);
             $this->errorCode=self::ERROR_NONE;
            }
          }
        }
        return !$this->errorCode;
    }
 
    public function getId()
    {
        return $this->_id;
    }

}