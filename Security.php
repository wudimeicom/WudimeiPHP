<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei;

class Security{
    public $usersGroupModelClass = "App\\Models\\UsersGroupModel";
    public $userGroupPermissionModelClass = "App\\Models\\UserGroupPermissionModel";
    public $permissionModelClass = "App\\Models\\PermissionModel";
    
    public function check( $perm , $url = "" ){
        //echo $perm;
        if( $url == ""){
            $url = url_b();
        }
        $perms =  $this->getMyPermissions();
        //print_r( $perms  );
        $permItem = ArrayHelper::find( $perms ,$perm, "code" );
        //print_r( $permItem );
        if( is_null( $permItem )){
            $p = $this->permissionModelClass::where('code',$perm)->first();
            if( is_null( $p )){
                $p = new \stdClass();
                $p->code = $perm;
                $p->name = $perm;
                $this->permissionModelClass::insert( $p);
            }
           return  \Redirect::to($url)->withWarning(trans("global.permission_required", ['permission_name' => trans($p->name)]));
           // Router::sendResponse( $res );
           // exit();
        }
        return false;
    }
    
    public function getMyPermissions(){
        $myPermissionsLoaded =\Session::get("myPermissionsLoaded");
        $myPermissionsLoaded = false;
        $myPermissions = array();
        if( $myPermissionsLoaded != true ){
            $user = \Auth::user();
            if( is_null( $user )){
                return array();
            }
            $uid = $user->id;
            $gids = $this->usersGroupModelClass::getGroupIds( $uid );
            $permissionIds = array();
            foreach ( $gids as $gid ){
                $permissions = $this->userGroupPermissionModelClass::getPermissions( $gid );
                $permissionIds = array_merge( $permissionIds , $permissions );
            }
            $permissionIds = array_unique($permissionIds);
            $permissionArray = $this->permissionModelClass::all();

            foreach ( $permissionIds as $pid ){
               $myPermissions[] = ArrayHelper::find( $permissionArray, $pid );
            }
            \Session::set("myPermissions" , $myPermissions );
            \Session::set("myPermissionsLoaded",true);
        }
        else{
            //echo "no";
        }
        $myPermissions = \Session::get("myPermissions");
        
        return $myPermissions;
    }
}