<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	  private $_id;
	  const ERROR_ACTIVE=9;
    public function authenticate()
    {
    	  $user=new User('login');
        $user_datas=$user->findAll("(user_login=:user_login OR email=:user_login)",array(':user_login'=>$this->username));
        $user_data=$user_datas[0];
        if($user_data===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($user_data->password!=Util::hc($this->password,$user_data->salt))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
        	
        	if($user_data->user_active!=2){
        		$this->errorCode=self::ERROR_ACTIVE;
        	}else{
            $this->_id=$user_data->id;
            //$this->setState('title', $user_data->user_login);
            
            $this->errorCode=self::ERROR_NONE;
          }
        }
        
        return !$this->errorCode;
    }
    
    public function getId()
    {
        return $this->_id;
    }



}