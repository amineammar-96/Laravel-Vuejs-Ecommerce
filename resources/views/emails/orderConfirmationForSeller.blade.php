<!doctype html>
<html lang="en-US">

<head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Order Bill</title>
    <meta name="description" content="Reset Password Email Template.">
    <style type="text/css">

.orderEmailDiv .red {
  color: #0370c8;
}
.orderEmailDiv .strong {
  font-weight: bold;
}
.orderEmailDiv .dark {
  color: black;
}
.orderEmailDiv .light {
  color: rgb(251, 251, 251);
}
.orderEmailDiv .container {
  width: 90%;
  height: 100%;
  margin: 10px auto;
  background-color: #f1f1f1;
  position: relative;
}
.orderEmailDiv .red-box {
  width: 85%;
  height: 100%;
  margin: 0px auto;
  background-color: transparent;
}
.orderEmailDiv .receipt {
  position: absolute;
  z-index: 999;
  width: 90%;
  top: 70px;
  left: 5%;
  box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
}
.orderEmailDiv .receipt_header {
  height: 80px;
}
.orderEmailDiv .receipt_header_top {
  background-color: #080808;
  display: flex;
  justify-content: space-between;
  align-items: center;
  height: 35px;
  padding: 0 20px;
  font-size: 0.6rem;
}
.orderEmailDiv .receipt_header_top p {
  color: rgba(233, 233, 233, 0.2);
}
.orderEmailDiv .receipt_header_bottom {
  background-color: #0370c8;
  height: calc(100% - 35px);
  padding-top: 10px;
}
.orderEmailDiv .receipt_header_bottom_logo {
  width: 135px;
  height: 135px;
  border-radius: 180px;
  border: 2px solid rgba(0, 0, 0, 0.2);
  margin: auto;
  color: #F4f4f4;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 4em;
}
.orderEmailDiv .receipt_receipt {
  height: 100%;
  background-color: #F4f4f4;
  display: flex;
  flex-direction: column;
  padding: 20px 40px;
}
.orderEmailDiv .receipt_receipt h1, .orderEmailDiv .receipt_receipt .h1, .orderEmailDiv .receipt_receipt h4, .orderEmailDiv .receipt_receipt .h4 {
  text-transform: uppercase;
  text-align: center;
}
.orderEmailDiv .receipt_receipt h1, .orderEmailDiv .receipt_receipt .h1 {
  line-height: 110%;
  margin: 0;
}
.orderEmailDiv .receipt_receipt > p {
  text-align: center;
  margin: 5px 0 0 0;
  font-size: 0.7rem;
}
.orderEmailDiv .receipt_receipt_shipping {
  display: flex;
  justify-content: space-around;
  font-size: 0.7rem;
  padding-bottom: 15px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.2);
  margin-top: 20px;
}
.orderEmailDiv .receipt_receipt_shipping a {
  font-size: 0.6rem;
}
.orderEmailDiv .receipt_receipt_shipping h4, .orderEmailDiv .receipt_receipt_shipping .h4 {
  text-align: left;
  font-weight: bold;
  margin: 0;
  text-align: left;

}
.orderEmailDiv .receipt_receipt_shipping_left {
  flex: 1;

}
.orderEmailDiv .receipt_receipt_shipping_left_to {
  display: flex;
  flex-direction: column;
  font-size: 0.7rem;
  line-height: 22px;
  text-align: left;

}
.orderEmailDiv .receipt_receipt_shipping_right {
flex-direction: column;
  justify-content: flex-start;
  flex: 1;
  text-align: left;
}
.orderEmailDiv .receipt_receipt_shipping_right p {
  margin-top: 0;
  font-size: 0.7rem;
  line-height: 22px;

}
.orderEmailDiv .receipt_receipt_items {
  font-size: 0.7rem;
  width: 100%;
  margin-top: 10px;
}
.orderEmailDiv .receipt_receipt_items h4, .orderEmailDiv .receipt_receipt_items .h4 {
  text-align: left;
}
.orderEmailDiv .receipt_receipt_items_item {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}
.orderEmailDiv .receipt_receipt_items_item_desc {
  flex: 2;
  width: 95%;
  margin-left: 10px;
}
.orderEmailDiv .receipt_receipt_items_item_desc p {
  margin: 0;
  width: 90%;
}
.orderEmailDiv .receipt_receipt_total {
  font-size: 0.7rem;
  font-weight: 900;
  width: 200px;
  align-self: flex-end;
}
.orderEmailDiv .receipt_receipt_total_separator {
  width: 190px;
  height: 1px;
  background-color: rgba(0, 0, 0, 0.2);
  margin: auto;
}
.orderEmailDiv .receipt_receipt_total_sub {
  padding-top: 12px;
}
.orderEmailDiv .receipt_receipt_total > div {
  display: flex;
  justify-content: space-between;
  margin: 3px;
}
.orderEmailDiv .receipt_receipt_total > div p {
  margin: 0;
}


@media screen and (min-width:720px){
    .orderEmailDiv .receipt_receipt_shipping {
  font-size: 1rem;
}

.orderEmailDiv .receipt_receipt_shipping_left_to {
  font-size: 0.9rem;
  line-height: 22px;
}
.orderEmailDiv .receipt_receipt_shipping_right p {
  margin-top: 0;
  font-size: 0.9rem;
}



.orderEmailDiv .receipt_receipt_items {
  font-size: 1rem;
}
.receipt_receipt_items {
  font-size: 1rem;
}

.orderEmailDiv .receipt_receipt_total {
  font-size: 1rem;
  font-weight: bold;

}
}





@media screen and (max-width:500px){

    .orderEmailDiv .receipt_receipt {
  height: 100%;
  background-color: #F4f4f4;
  display: flex;
  flex-direction: column;
  padding: 20px 10px;
}
    .orderEmailDiv .receipt_receipt_shipping {
  display: flex;
  flex-direction: column;
}

.orderEmailDiv .receipt_receipt_shipping_right , .orderEmailDiv .receipt_receipt_shipping_left_to{
  flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  align-items: center;

}
.orderEmailDiv .receipt_receipt_shipping h4, .orderEmailDiv .receipt_receipt_shipping .h4 {
  text-align: center;
  font-weight: bold;
  margin: 0;
}

.orderEmailDiv .receipt_receipt_shipping_left {
  flex: 1;
  margin-bottom: 45px;
}

.orderEmailDiv .receipt_receipt_shipping {

  text-align: center;
}
.orderEmailDiv .receipt_receipt h1, .orderEmailDiv .receipt_receipt .h1 {
  line-height: 110%;
  margin: 0;
  font-size: 22px;
}
}



@media screen and (max-width:600px){
    .orderEmailDiv .receipt_receipt h1, .orderEmailDiv .receipt_receipt .h1 {
  line-height: 110%;
  margin: 0;
  font-size: 25px;
}
}

@media screen and (min-width:1300px){

    .orderEmailDiv .receipt_receipt_total {
  font-size: 1.2rem;
  font-weight: bold;

}
    .receipt_receipt_items {
  font-size: 1.2rem;
}

.orderEmailDiv .receipt_receipt_items {
  font-size: 1.2rem;
}
    .orderEmailDiv .receipt_receipt_shipping {
  font-size: 1.1rem;
}

.orderEmailDiv .receipt_receipt_shipping_left_to {
  font-size: 1.2rem;
  line-height: 26px;
}
.orderEmailDiv .receipt_receipt_shipping_right p {
  margin-top: 0;
  font-size: 1.2rem;
}
.orderEmailDiv .receipt_receipt h1, .orderEmailDiv .receipt_receipt .h1 {
  line-height: 110%;
  margin: 0;
  font-size: 30px;
}
}


.orderEmailDiv .receipt_receipt_shipping_right {
  text-align: left;
  line-height: 26px;
}
.orderEmailDiv .receipt_receipt h1, .orderEmailDiv .receipt_receipt .h1 {
  line-height: 110%;
  margin: 0;
  font-size: 22px;
}

.prices{
    display: flex;
    flex-direction: row;
    justify-content: space-between;
}

.separate{
    width: 10vw;
}
    </style>

</head>


<body>
    <div class="orderEmailDiv">
        <div class="container">
            <div class="red-box"></div>
            <div class="receipt">
              <header class="receipt_header">
                <header class="receipt_header_top">
                  <h4 class="light">Tunshop</h4>
                  <p style="color:white"> Can't see the email? View it in the browser</p>
                </header>
                <header class="receipt_header_bottom">

                </header>
              </header>
              <div class="receipt_receipt">
                <h1 class="red">An order has been saved <span>for you</span></h1>
                <p>Please make sure to contact the client in every step about his order</p>
                <div class="receipt_receipt_shipping">
                  <div class="receipt_receipt_shipping_left">
                    <h4 class="dark">billing Address:</h4>
                    <div class="receipt_receipt_shipping_left_to">
                      <span>{{ $details2['userProfile']->name }}</span>
                      <span>{{ $details2['userProfile']->email }}</span>
                      <span>{{ $details2['userDefaultAddress']->phone  }}</span>
                      <span>{{ $details2['userDefaultAddress']->address  }}</span>
                      <span>{{ $details2['userDefaultAddress']->addressComp ?? ''  }}</span>
                      <span>{{ $details2['userDefaultAddress']->country }}
,
                     {{ $details2['userDefaultAddress']->city }} {{ $details2['userDefaultAddress']->postalCode }}</span>

                    </div>
                  </div>
                  <div class="receipt_receipt_shipping_right">
                    <h4 class="dark">Shipping To:</h4>
                    <span> {{ $details2['shippingInfo']->name }} </span>
                    <span> {{ $details2['shippingInfo']->address }} </span>
                    <span> {{ $details2['shippingInfo']->addressComp ?? '' }} </span>
                    <span> {{ $details2['shippingInfo']->country }} , {{ $details2['shippingInfo']->city }}
                        {{ $details2['shippingInfo']->postalCode }} </span>

                    <h4 class="dark">notes:</h4>
                    <p>No comments</p>
                  </div>
                </div>
                <div class="receipt_receipt_items">
                  <h4 class="dark">items:</h4>
                  @foreach ($details2['orderItemForSeller'] as $item)
                  <div class="receipt_receipt_items_item">
                    <div class="receipt_receipt_items_item_nb">{{ $item->quantity }}<span>x</span></div>
                    <div class="receipt_receipt_items_item_desc">
                      <p class="strong dark">{{ $item->name }}</p>
                      <p>#{{ $item->product_id }}</p>
                    </div>
                    <div class="prices">
                        <div class="receipt_receipt_items_item_price strong dark "><span>$</span>{{ $item->price }}</div>
                        <span class="separate"></span>
                        <div class="receipt_receipt_items_item_price strong dark"><span>$</span>{{ number_format(((float)$item->price) * ($item->quantity), 2, '.', ''); }}</div>
                    </div>
                 </div><!--close item-->
                 @endforeach
                </div><!--close items-->
                <div class="receipt_receipt_total dark">
                  <div class="receipt_receipt_total_separator"></div>

                  <div class="receipt_receipt_total_fee">
                    <p>Shipping cost:</p><p>$9.99</p>
                  </div>
                  <div class="receipt_receipt_total_tax">
                    <p>Tax:</p><p>${{ (($details2['orderInfo']->amount)/100)*20 }}</p>
                  </div>

                  <div class="receipt_receipt_total_total">
                    <p>TOTAL HT:</p><p>${{  $details2['orderInfo']->amount-((($details2['orderInfo']->amount)/100)*20) }}</p>
                  </div>
                  <div class="receipt_receipt_total_total">
                    <p>TOTAL:</p><p>${{ $details2['orderInfo']->amount }}</p>
                  </div>
                </div><!--close total-->
              </div>
            </div>
          </div>

    </div>
</body>

<!--100% body table-->

{{--
<body
    style="background-color:#e2e1e0;font-family: Open Sans, sans-serif;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
    <table
        style="max-width:1100px; width: 100%; margin:50px 10px;background-color:#fff;padding:30px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px rgb(38, 123, 233);">
        <thead>
            <tr>
            <th style="text-align:center;font-weight:700;width: 100%;padding-bottom: 50px; display: contents;">Thank you for your order</th>
            </tr>
            <tr>

                <th style="text-align:left;font-weight:400;">{{ $details22['orderInfo']->created_at }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="height:35px;"></td>
            </tr>
            <tr>
                <td colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
                    <p style="font-size:14px;margin:0 0 6px 0;"><span
                            style="font-weight:bold;display:inline-block;min-width:150px">Order status</span><b
                            style="color:green;font-weight:normal;margin:0">Success</b></p>
                    <p style="font-size:14px;margin:0 0 6px 0;"><span
                            style="font-weight:bold;display:inline-block;min-width:146px">Transaction ID</span>
                        {{ $details22['orderInfo']->paymentId }}</p>
                    <p style="font-size:14px;margin:0 0 0 0;"><span
                            style="font-weight:bold;display:inline-block;min-width:146px">Order amount</span>
                        ${{ $details22['orderInfo']->amount }}</p>
                </td>
            </tr>
            <tr>
                <td style="height:35px;"></td>
            </tr>
            <tr class="responsiveTr">
                <td style="width:50%;padding:20px;vertical-align:top">
                    <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span
                            style="display:block;font-weight:bold;font-size:13px">Name</span>
                        {{ $details22['userProfile']->name }}</p>
                    <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span
                            style="display:block;font-weight:bold;font-size:13px;">Email</span>
                        {{ $details22['userProfile']->email }}</p>
                    <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span
                            style="display:block;font-weight:bold;font-size:13px;">Phone</span>
                        {{ $details22['userDefaultAddress']->phone }} </p>
                    <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span
                            style="display:block;font-weight:bold;font-size:13px;">ID Cl.</span>
                        {{ $details22['userProfile']->id }}</p>
                </td>
                <hr clas="hrResponsive">
                <td style="width:50%;padding:20px;vertical-align:top">
                    <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span
                            style="display:block;font-weight:bold;font-size:13px;">Shipping Address</span>
                        {{ $details22['shippingInfo']->name }} <br>
                        {{ $details22['shippingInfo']->address }} ,
                        {{ $details22['shippingInfo']->addressComp ?? '' }} <br>
                        {{ $details22['shippingInfo']->country }} , {{ $details22['shippingInfo']->city }}
                        {{ $details22['shippingInfo']->postalCode }}
                    </p>

                </td>
            </tr>
            <tr>
                <td colspan="2" style="font-size:20px;padding:30px 15px 0 15px;">Order items</td>
            </tr>
            <tr>
                <td colspan="2" style="padding:15px;">


@foreach ($details22['orderInfo']->order_items as $item)

                    <p  style="font-size:16px;margin:0;padding:10px;border:solid 1px #ddd;">
                        <span style="display:block;font-size:14px;font-weight:normal;">
                            - {{ $item->name }} <br>
                           </span>
                          PU: ${{ $item->price }} <br> Qte :  {{ $item->quantity }}
                           <br>PT:  ${{ $item->price * $item->quantity }}
                    </p>
@endforeach

                  </td>
            </tr>
        </tbody>
        <tfooter>
            <tr>
                <td colspan="2" style="font-size:14px;padding:50px 15px 0 15px;">

                    <b>Phone:</b> 0139548659<br>
                    <b>Email:</b> tunshop@contact.tn
                </td>
            </tr>
        </tfooter>
    </table>
</body> --}}



</html>
