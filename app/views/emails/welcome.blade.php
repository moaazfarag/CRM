<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 11/18/2015
 * Time: 2:11 PM
 */
        ?>

<h3 dir="rtl">
  شكراً لكم
    ({{ $name }})
    على ثقتكم بنا ..
    نتمنى بأن موقعكم الراصد ينال إعجابكم
    ويحقق طموحاتكم
    <a href="{{ URL::to('register/verify/' . $confirmation_code) }}">إضغط هنا لتفعيل الشركة </a><br/>

        </h3>