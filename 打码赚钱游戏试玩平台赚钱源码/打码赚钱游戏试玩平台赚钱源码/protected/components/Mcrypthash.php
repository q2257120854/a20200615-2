<?php

class Mcrypthash{
       private $mAuthkey = 't_test';
       function __construct() {
           if(!function_exists('mcrypt_module_open')){
               exit('Fatal error:no mcrypt module');
           }
           $this->setMd5();
       }
       
       private function setMd5(){
           $this->mAuthkey = md5($this->mAuthkey);
       }
       
       //加密
       public function encrypt($value=null){
           if(null==$value) return false;
           $td = mcrypt_module_open('tripledes', '', 'ecb', '');
           $td_size = mcrypt_enc_get_iv_size($td);
           $iv = mcrypt_create_iv($td_size,MCRYPT_RAND);
           $key = substr($this->mAuthkey, 0, $td_size);
           mcrypt_generic_init($td, $key, $iv);
           $ret = base64_encode(mcrypt_generic($td, $value));
           mcrypt_generic_deinit($td);
           mcrypt_module_close($td);
           return $ret;
       }
       
       //解密
       public function decrypt($value = null){
           if(null==$value) return FALSE;
           $td = mcrypt_module_open('tripledes', '', 'ecb', '');
           $td_size = mcrypt_enc_get_iv_size($td);
           $iv = mcrypt_create_iv($td_size,MCRYPT_RAND);
           $key = substr($this->mAuthkey, 0, $td_size);
           mcrypt_generic_init($td, $key, $iv);
           $ret = trim(mdecrypt_generic($td, base64_decode($value)));
           mcrypt_generic_deinit($td);
           mcrypt_module_close($td);
           return $ret;
       }
}

