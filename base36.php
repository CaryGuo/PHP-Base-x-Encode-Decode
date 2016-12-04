<?php


/**
 * convert a decimal number into a string using $base
 * 将2-36位数字转换为字符串
 * @param $decimal string
 * @param $base int(2-36)
 * @return string
 **/
function base_decode($decimal, $base)
{
   $string = null;
   $base = (int)$base;
   if ($base < 2 | $base > 36 | $base == 10 | !preg_match('/(^[0-9]{1,50}$)/', $decimal)) {
      return false;
   }
   $charset = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $charset = substr($charset, 0, $base);
   do {
      $remainder = bcmod($decimal, $base);
      $char      = substr($charset, $remainder, 1);  
      $string    = $char.$string;                 
      $decimal   = bcdiv(bcsub($decimal, $remainder), $base);
   } while ($decimal > 0);
   return $string;
}


/**
 * convert a string into a decimal number using $base
 * 将字符串转换为2-36位数字
 * @param $string int
 * @param $base int(2-36)
 * @return string
 **/
function base_encode($string, $base)
{
   $decimal = 0;
   $base = (int)$base;
   if ($base < 2 | $base > 36 | $base == 10 | !$string) {
      return false;
   } 
   $charset = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
   $charset = substr($charset, 0, $base);
   do {
      $char   = substr($string, 0, 1); 
      $string = substr($string, 1);   
      $pos = strpos($charset, $char);  
      if ($pos === false) {
         return false;
      }
      $decimal = bcadd(bcmul($decimal, $base), $pos);
   } while($string);
   return $decimal;
}
?>