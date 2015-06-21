<?php
class Assign extends BaseModel  {
	
	protected $table = 'assigned_to';
	protected $primaryKey = 'id';

	public function __construct() {
		parent::__construct();
		
	}

	public static function querySelect(  ){
		
		
		return "  SELECT assigned_to.* FROM assigned_to  ";
	}
	public static function queryWhere(  ){
		if (Session::get('lvl') > 5){
			return " WHERE assigned_to.user_id =".Session::get('uid')."";
		} elseif(Session::get('lvl') > GLOBAL_USER){
			return " WHERE assigned_to.site_id =".Session::get('sid')."";
		} else {
			return " WHERE assigned_to.id IS NOT NULL";
		}

	}
	
	public static function queryGroup(){
		return "  ";
	}
	

}
