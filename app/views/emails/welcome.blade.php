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
    ({{ $company_name }})
    على ثقتكم بنا ..
    نتمنى بأن موقعكم الراصد ينال إعجابكم
    ويحقق طموحاتكم
    <br/>
    رقم الشركة الذى يستخدم عند تسجيل الدخول هو:
    {{  $co_id }}
    <br/>
اسم المستخدم الذى يستخدم عند تسجيل الدخول:
    {{ $username }}
    <a href="{{ URL::to('register/verify/' . $confirmation_code) }}">إضغط هنا لتفعيل الشركة </a><br/>

</h3>
