<?php
/**
 * @author yangqingrong@wudimei.com
 * @copyright yangqingrong@wudimei.com
 * @link http://www.wudimei.com
 * @license The MIT license(MIT)
 */
namespace Wudimei;
class Alert{
     public function display()
     {
         $message = \Session::get("message");
         $message_type = \Session::get("message_type");
         
         if( isset( $message ))
         {
             $icons = [
                    'success' => 'check',
                     'warning' => 'warning',
                     'info' => 'info',
                     'danger' => 'ban'
             ];
             $icon = $icons[$message_type];
             $html = '<div class="alert alert-'. $message_type.' alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-'.$icon.'"></i> '.trans('global.alert_title_' . $message_type).'</h4>
                    '. $message.'
                  </div>';
             return $html;
         }
         else{
             return '';
         }
     }
}