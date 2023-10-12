<?php

session_start();

$recepient = "";
$sitename = " ";

$name = trim($_POST["name"]);
// $email = trim($_POST["email"]);
$phone = trim($_POST["phone"]);
// $mess = trim($_POST["mess"]);
$comment = trim($_POST["comment"]);

$date = new DateTime();

$message = "Phone: $phone \nName: $name \n";

$pagetitle = "New order \"$sitename\"";

mail("", $pagetitle, $message, "Content-type: text/plain; charset=\"utf-8\"\n From: $recepient");


// Telegram Mail

$token = '5023581824:AAGDVsHVdHXWze9_K5qZC_uq7aWkzxFC4CM';


$telegram_text = array(
    'site'            => $_SERVER['SERVER_NAME'],'<br />',  // ñàéò îòïðàâëÿþùèé çàïðîñ
    'bayer_name'      => $name,'<br />',             // ïîêóïàòåëü (Ô.È.Î)
    'phone'           => $phone,'<br />',           // òåëåôîí
    'comment'           => $comment,'<br />',           // òåëåôîí
    'utm_source'      => $_SESSION['utms']['utm_source'],'<br />',  // utm_source 
    'utm_medium'      => $_SESSION['utms']['utm_medium'],'<br />',  // utm_medium 
    'utm_term'        => $_SESSION['utms']['utm_term'],'<br />',    // utm_term   
    'utm_content'     => $_SESSION['utms']['utm_content'],'<br />', // utm_content    
    'utm_campaign'    => $_SESSION['utms']['utm_campaign'] // utm_campaign
);

$data = [
    'text' => "New Order: $sitename \nName: $name \nPhone: $phone \nTerm: ".$telegram_text['utm_term']."\nCampaign: ".$telegram_text['utm_campaign']."\nContent: ".$telegram_text['utm_content']."\nSite: ".$telegram_text['site']."",
  
    'chat_id' => '613750076'
];

file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data) );




// ôîðìèðóåì ìàññèâ ñ òîâàðàìè â çàêàçå (åñëè òîâàð îäèí - îñòàâëÿéòå òîëüêî ïåðâûé ýëåìåíò ìàññèâà)
$products_list = array(
    1 => array( 
            'product_id' => '',    // ЗМІНИТИ КАТАЛОГ-ТОВАРИ-ЦІНА
            'price'      => '', //ЗМІНИТИ КАТАЛОГ-ТОВАРИ-ID
            'count'      => '1'                      //êîëè÷åñòâî òîâàðà 1
    )
);
$products = urlencode(serialize($products_list));
 
// ïàðàìåòðû çàïðîñà
$data = array(
    'key'             => '', //Âàø ñåêðåòíûé òîêåí
    'order_id'        => number_format(round(microtime(true)*10),0,'.',''), //èäåíòèôèêàòîð (êîä) çàêàçà (*àâòîìàòè÷åñêè*)
    'country'         => 'UA',                      // Ãåîãðàôè÷åñêîå íàïðàâëåíèå çàêàçà
    'office'          => '1',                   // Îôèñ (id â CRM)
    'products'        => $products,                 // ìàññèâ ñ òîâàðàìè â çàêàçå
    'bayer_name'      => $name,             // ïîêóïàòåëü (Ô.È.Î)
    'email'           => $email,  
    'phone'           => $phone,           // òåëåôîí
    'site'            => $_SERVER['SERVER_NAME'],  // ñàéò îòïðàâëÿþùèé çàïðîñ
    'ip'              => $_SERVER['REMOTE_ADDR'],  // IP àäðåñ ïîêóïàòåëÿ
    'delivery'        => $_GET['delivery'],        // ñïîñîá äîñòàâêè (id â CRM)
    'delivery_adress' => $_GET['delivery_adress'], // àäðåñ äîñòàâêè
    'payment'         => 'ñïîñîá îïëàòû',          // âàðèàíò îïëàòû (id â CRM)
    'utm_source'      => $_SESSION['utms']['utm_source'],  // utm_source 
    'utm_medium'      => $_SESSION['utms']['utm_medium'],  // utm_medium 
    'utm_term'        => $_SESSION['utms']['utm_term'],    // utm_term   
    'utm_content'     => $_SESSION['utms']['utm_content'], // utm_content    
    'utm_campaign'    => $_SESSION['utms']['utm_campaign'] // utm_campaign
);
 
// çàïðîñ
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, '/api/addNewOrder.html');
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$out = curl_exec($curl);
curl_close($curl);



?>







<!DOCTYPE html>
<html>
<head>
<!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '333750852397048');
fbq('track', 'Lead');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=333750852397048&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->

<meta content="text/html; charset=UTF-8" http-equiv="Content-Type">
   <meta name="viewport" content="width=device-width">
	        <link rel="shortcut icon" href="favicon.ico"/>
		<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
		<link media="all" href="/css/index1.css?v=1" type="text/css" rel="stylesheet">

		<link href="/css/demo.css" rel="stylesheet">
		


 <div class="block_success">					
            <h2 style="text-transform: uppercase;">Поздравляем! Ваш заказ принят!</h2>
            
            <h3 class="success">
                Пожалуйста, проверьте правильность введенной Вами информации.
                
            </h3>
            <div class="success">
                <ul class="list_info">
				
                   
                    <li><span>Ф.И.О: </span><span id="tel"><?print($_REQUEST['name']);?></span></li>  
                    <li><span>Телефон: </span><span id="tel"><?print($_REQUEST['phone']);?></span></li>  
					    
				 </ul>
                <br/><span id="submit"></span>
            </div>
            <p class="fail success">Если вы ошиблись при заполнении формы, пожалуйста, <a href="javascript: history.back(-1);">заполните заявку еще раз</a></p>
		</div>

       

<br>
	<title>Поздравляем! Ваш заказ принят!</title>



	    <style type="text/css">
            body {
                line-height: 1;
                height: 100%;
                font-family: Arial;
                font-size: 15px;
                color: #313e47;
                width: 100%;
                height: 100%;
                padding: 0;
                margin: 0;
                
            }
            h2 {
                margin: 0;
                padding: 0;
                font-size: 36px;
                line-height: 44px;
                color: #313e47;
                text-align: center;
                font-weight: bold;
            }
            a {
                color: #69B9FF;
            }
            .list_info li span {
                width: 150px;
                display: inline-block;
                font-weight: bold;
                font-style: normal;
            }
            .list_info {
               text-align: left;
               display: inline-block;
               list-style: none;
               margin-top: -10px;
               margin-bottom: -11px;
            }
            .list_info li {
                margin: 11px 0px;
            }
            .fail {
                margin: 10px 0 20px 0px;
                text-align: center;
            }
            .email {
                position: relative;
                text-align: center;
                margin-top: 40px;
            }
            .email input {
                height: 30px;
                width: 200px;
                font-size: 14px;
                padding-right: 10px;
                padding-left: 10px;
                outline: none;
                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
                border: 1px solid #B6B6B6;
                margin-bottom: 10px;
            }
            .block_success {
                max-width: 960px;
                padding: 70px 30px 70px 30px;
                margin: -50px auto;
				
            }
    .success {
                text-align: center;
            }
            .man .block-1 .top-title>div {
        background: url(success/phone-icon-2-lighter.png) center bottom no-repeat;
    }
    .dashed_frame {
        border: 1px dashed grey;
        border-radius: 10px;
        opacity: 1;
        background: none;
        top: 0;
        height: auto;
        padding: 15px 20px;
        width: 90%;
        margin-bottom: 20px;
    }
    .dashed_frame h2 {
        font-weight: 900;
        text-align: center;
        text-transform: uppercase;
    }
    .present {
        background-color: #eff2fa;
        border-radius: 10px;
        padding: 20px !important;
        height: 510px !important;
        border: 1px solid #e2dfe9;
    }
    .offer-head {
        left: -40px;
        position: relative;
    }
    .mail-box .head {
        font-family: sans-serif;
        font-size: 18px;
        font-style: italic;
        text-align: center;
        margin: 20px 0;
    }
    .mail-box .email_ss_holder {
        float: none;
        width: 100%;
        padding: 45px 10px 15px;
        text-align: center;
    }
    .mail-box .email_cc_input {
        border: 1px solid #dcdada;
        background-color: rgba(204, 204, 204, 0.16);
        width: 258px;
        color: #000;
    }
    .mail-box .btn_ss_holder {
        float: none;
        margin: 0;
        width: 100%;
        text-align: center;
    }
    .mail-box .desc_cc_desc {
        margin: 45px 0px 0;
        color: #7b7b7b;
        font-size: 14px;
    }
    .present-descr {
        width: 58%;
        float: left;
    }
    .present1 {
        float: left;
        text-align: center;
        width: 30%;
        margin: 0 5px;
    }
    .present1.last:after {
        clear: both;
    }
    .mail-box {
        background: url("//static.best-gooods.ru/upsells/img/mail-box.png") center top no-repeat;
        width: 42%;
        float: left;
        padding: 1px 45px;
        height: 375px;
    }
    .tov-gal-big {
        margin-top: 45px !important;
        border: 1px solid lightgrey;
    }
    .tov-gal-list {
        margin-top: 45px !important;
    }
    .tov-left-cont {
        width: 420px !important;
    }
    .thanks {
        margin: 43% auto;
        font-size:28px;
        text-align:center;
        line-height:36px
    }
    .thanks span {
        font-size:20px;
    }
    @media (max-width: 960px){
        .mail-box, .present-descr {
            float: none;
            width: 100%;
        }
        .present {
            height: 100% !important;
        }
        .present-descr {
            height: 375px;
        }
        .offer-head {
            left: -40px;
        }
        .thanks {
            width: 55%;
            margin: 25% auto;
        }
    }
    @media (max-width: 640px){
        .present1 {
            margin: 0 3px;
        }
        .present, .mail-box .head, .mail-box .desc_cc_desc {
            font-size: 80%;
        }
        .present-descr {
            height: 300px;
        }
        .mail-box .email_ss_holder {
            padding: 45px 0 15px;
        }
        .mail-box .email_cc_input {
            width: 100%;
        }
        .mail-box {
            height: 330px;
            background-size: contain;
        }
        .mail-box .head {
            margin: 15px 0;
        }
        .top-title-c {
            top: 0 !important;
        }
        .thanks {
            font-size: 18px;
            line-height: 30px;
            width: 100%;
            margin: 55% auto;
        }
        .thanks span {
            font-size: 14px;
        }
    }
        </style>  
	
		
		<script
  			src="https://code.jquery.com/jquery-2.2.4.min.js"
  			integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  			crossorigin="anonymous"></script>
		
	


</head>
</body></html>


