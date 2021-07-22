<?php

  

function changeDateFormate($date,$date_format){

    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);    

}

   

function productImagePath($image_name)

{

    return public_path('images/products/'.$image_name);

}



function pr($data)

{

	echo "<pre>"; print_r($data); echo "</pre>";

}



function get_location($location_id)

{

    

}



function send_notification($notification){

        // API access key from Google API's Console

    $android_key = "AAAA0DP6Qjg:APA91bGJ-4YhbvTTRzehcynW_EVHJg5wLId5Q1CPhhobZViERA22eP4FUMNEpVa4fmschbUmfRxYIA--rNuaNmgLEqbGB2X0AdGkC-E9HpjThJs6YOKTd_ELNKJHvKO0pAhsJW1e8mft";

    $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

    $notification_page = @$notification['notification_page'] ?  $notification['notification_page'] : "Notification";

    $fcmNotification = '{

          "to": "'.$notification['device_id'].'",

           "notification": {

           "body": "'.$notification['description'].'",

           "title": "'.$notification['title'].'"

          },

          "priority": "high",

            "data": {

               

                 "body": "'.$notification['description'].'",

           "title": "'.$notification['title'].'"

                 "click_action": "FLUTTER_NOTIFICATION_CLICK",

                 "status": "/'.$notification_page.'",

                 "sound" : "default",

                 "id" :"56",

                 "image": "",

           }

         }

       ';

    //pr($fcmNotification);die;

    $headers = [

       'Authorization: key=' .$android_key,

       'Content-Type: application/json'

    ];

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,$fcmUrl);

    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $fcmNotification);

    $result = curl_exec($ch);

    curl_close($ch);

    return $result;

}



function time_elapsed_string($datetime, $full = false) {

    $now = new DateTime;

    $ago = new DateTime($datetime);

    $diff = $now->diff($ago);



    $diff->w = floor($diff->d / 7);

    $diff->d -= $diff->w * 7;



    $string = array(

        'y' => 'year',

        'm' => 'month',

        'w' => 'week',

        'd' => 'day',

        'h' => 'hour',

        'i' => 'minute',

        's' => 'second',

    );

    foreach ($string as $k => &$v) {

        if ($diff->$k) {

            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');

        } else {

            unset($string[$k]);

        }

    }



    if (!$full) $string = array_slice($string, 0, 1);

    return $string ? implode(', ', $string) . ' ago' : 'just now';

}



function get_price($amount, $symbol = false) {

	return "KWD ".$amount;

}