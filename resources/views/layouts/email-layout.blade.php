<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title> Email</title>
   
  </head>
  <body class="" >
    <div  style="background:  #F0F0F0; width: 100%;">
    <table border="0" cellpadding="0" cellspacing="0" style=" background-color: #F0F0F0;  width: 580px;color:#365778" align="center">
      <tr>        
       <td>

              <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;" align="center">
                <tr>
                  	<td  style="padding-bottom: 10px; padding-top: 10px; font-size: 12px; color: #999999;  width: 100%;" align="center">
	                  
	                    	 <img src="{{url('/')}}/public/images/{{$setting->image_name}}" alt="{{$setting->company_name}}"   height="75" width="75"/> 

                  	</td>
                </tr>
              
              </table>
         
          	   @yield('content')


             <table width="100%" style="background:#F0F0F0;padding: 10px">
             <tr>
             <td>                   <br>
					   
					   
              <p>Thank You,</p>
              <p>{{$setting->company_name}}</p>
              <p>Location : {{$setting->company_address}},</p>
              <p> <img src="{{url('/')}}/public/images/whatsapp.png" width="32px" style="vertical-align:middle"> English : <a href="https://wa.me/96566075250">+965-66075250</a> |  Arabic: <a href="https://wa.me/96555544784">+965-55544784</a></p>
                        
                  <p>You can chat with us through WhatsApp or through our student portal.</p>

                </td>
              </tr>
              <tr>
                <td align="center" style="border-top: 1px solid #CCC;">
                 
                  <p class="font-size:12px">
                    <a href="{{$setting->facbook}}"><img src="{{url('/')}}/public/images/facebook.png" width="36px"></a>&nbsp;
                    <a href="{{$setting->twitter}}"><img src="{{url('/')}}/public/images/twitter.png" width="36px"></a>&nbsp;
                    <a href="{{$setting->instrgram}}"><img src="{{url('/')}}/public/images/instagram.png" width="36px"></a></p>
                </td>
              </tr>
            </table>

         
        </td>
       
      </tr>
    </table>
  </div>
  </body>
</html>