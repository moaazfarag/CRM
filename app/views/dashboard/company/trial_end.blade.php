<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>

    {{ HTML::style('dashboard/css/style.css') }}


    <title>click for data </title>
    <style>
        @import url(http://fonts.googleapis.com/earlyaccess/droidarabickufi.css);

        body{
            font-family: 'Droid Arabic Kufi', sans-serif;
            background-image: url({{ URL::asset('dashboard/img/bg.png') }});
            background-repeat: repeat;
        }
        .wrap{
            width: 90%;
            min-height: 550px;
            background: #FFFFFF;


            padding:5px;

            margin: 3% auto;

            color: rgb(25,25,25);
            font-size: inherit;
            font-weight: inherit;
            font-family: inherit;
            font-style: inherit;
            text-decoration: inherit;
            text-align: center;

            line-height: 1.3em;
            -webkit-box-shadow: -8px -5px 29px -10px rgba(0,0,0,0.75);
            -moz-box-shadow: -8px -5px 29px -10px rgba(0,0,0,0.75);
            box-shadow: -8px -5px 29px -10px rgba(0,0,0,0.75);

        }
        .logo{
            background: #FFFFFF;

            padding: 5px;

            margin: 20px;

            color: rgb(25,25,25);
            font-size: inherit;
            font-weight: inherit;
            font-family: inherit;
            font-style: inherit;
            text-decoration: inherit;
            text-align: center;

            line-height: 1.3em;


        }
        .logo img{
            width: 20%;
            height: 120px;


        }
        hr{

            border: 0;
            height: 1px;
            background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
        }
        .title{
            color:  #407d9c;
        }


        #red{
            width:220px;
            height:40px;
            text-align:center;
            color:#FFF;
            text-decoration:none;
            line-height:43px;
            font-family:'Oswald', Helvetica;
            text-shadow:-1px -1px 0 #A84155;
            display:block;
            background: #D25068;
            border:1px solid #D25068;
            -webkit-border-radius:5px;
            -webkit-box-shadow:0 1px 0 rgba(255, 255, 255, .5) inset, 0 -1px 0 rgba(255, 255, 255, .1) inset, 0 4px 0 #AD4257, 0 4px 2px rgba(0, 0, 0, .5);
        }

        #red:hover{
            background: #F66C7B;
            background-image:-webkit-gradient(linear, 0% 0%, 0% 100%, from(#D25068), to(#F66C7B));
        }

        #red:active{
            -webkit-box-shadow:0 1px 0 rgba(255, 255, 255, .5) inset, 0 -1px 0 rgba(255, 255, 255, .1) inset;  position:relative;
            top:5px;
        }

        #blue{
            width:220px;
            height:40px;
            text-align:center;
            color:#000;
            text-decoration:none;
            line-height:43px;
            font-family:'Oswald', Helvetica;
            text-shadow:-1px -1px 0 #00aa0a;
            display:block;
            /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#299a0b+0,299a0b+100;Green+Flat+%231 */
            /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#63b6db+0,309dcf+100;Blue+3D+%234 */
            background: rgb(99,182,219); /* Old browsers */
            background: -moz-linear-gradient(top,  rgba(99,182,219,1) 0%, rgba(48,157,207,1) 100%); /* FF3.6-15 */
            background: -webkit-linear-gradient(top,  rgba(99,182,219,1) 0%,rgba(48,157,207,1) 100%); /* Chrome10-25,Safari5.1-6 */
            background: linear-gradient(to bottom,  rgba(99,182,219,1) 0%,rgba(48,157,207,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#63b6db', endColorstr='#309dcf',GradientType=0 ); /* IE6-9 */

            border:1px solid #62aaa2;
            -webkit-border-radius:5px;
            -webkit-box-shadow:0 1px 0 rgba(255, 255, 255, .5) inset, 0 -1px 0 rgba(255, 255, 255, .1) inset, 0 4px 0 #1157aa, 0 4px 2px rgba(0, 0, 0, .5);
        }

        #blue:hover{
            background: #ffc120;
        }

        #blue:active{
            /*-webkit-box-shadow:0 1px 0 rgba(255, 255, 255, .5) inset, 0 -1px 0 rgba(255, 255, 255, .1) inset;  position:relative;*/
            top:5px;
        }
        .buttons{

            width:100%;
            height: auto;

        }
        .right{
            width:49%;
            margin-left:1%;
            float: right;
            text-align: left;

        }
        .left{
            width:50%;
            float:left;

            text-align: right;

        }
        @media screen and (max-width: 660px) {
            .logo img{
                width: 45%;
                height: 100px;


            }

            #blue {
                width: 110px;
            }
        }


    </style>
</head>
<body>
<div class="wrap">
    <div class="logo">
        <img src="{{ URL::asset('dashboard/assets/_con/images/logo2.png') }}">
        <h3>شركة كليك فور داتا</h3>
        <hr/>
        <h4> <span class="title">!! نأسف لإبلاغكم أن الفترة المجانية قد أنتهت </span>
            <br/>
            <br/>
               <span>
                   للإشتراك فى موقع الراصد  يرجى مراسلتنا من خلال الرابط التالى
               </span>
        </h4>
        <a href="http://www.clickfordata.net/contact-us/" class="click_here_button darkred"> إضغط هنا </a>

    </div>








</div>
</body>
<html>