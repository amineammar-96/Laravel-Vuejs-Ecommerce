<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order item shipping status</title>
    <link href='//fonts.googleapis.com/css?family=Roboto:200,400,600' rel='stylesheet' type='text/css'>


    <style>
        body {
            line-height: 1.3em;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .history-tl-container {
            font-family: "Roboto", sans-serif;
            width: 100%;
            margin: auto;
            display: flex;
            position: relative;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .history-tl-container ul.tl {
            margin: 20px 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-content: center;
            justify-content: center;
            text-align: start;

        }

        .history-tl-container ul.tl li {
            list-style: none;
            margin-left: 200px;
            min-height: 60px;
            border-left: 1px dashed #86D6FF;
            padding: 0px 0 50px 30px;
            position: relative;
        }

        .history-tl-container ul.tl li:last-child {
            border-left: 0;
        }

        .history-tl-container ul.tl li::before {
            position: absolute;
            left: -20px;
            top: -5px;
            content: " ";
            border: 8px solid rgba(255, 255, 255, 0.74);
            border-radius: 500%;
            background: #258CC7;
            height: 25px;
            width: 25px;
            transition: all 500ms ease-in-out;

        }

        .history-tl-container ul.tl .active::before {
            border-color: #4bc725;
            background: #3dc725;
            content: "✓";
            display: flex;
            flex-direction: row;
            justify-content: center;
            text-align: center;
            align-items: center;
            color: white;
            transition: all 1000ms ease-in-out;
        }

        ul.tl li .item-title {}

        ul.tl li .item-detail {
            color: rgba(0, 0, 0, 0.5);
            font-size: 12px;
        }

        ul.tl li .timestamp {
            color: #8D8D8D;
            position: absolute;
            width: 100px;
            left: -50%;
            text-align: right;
            font-size: 12px;
            top: 0;
        }

        .jumbotron {
  padding: 1rem 1rem;
  background-color: #fff;
  color: black;
  display: flex;
  text-align: center;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  line-height: 0;
  margin-top: 51px;
}




        .jumbotron2 {
            padding: 0.5rem 0.5rem;
            margin-bottom: 1rem;
            background-color: #ffffff;
            color: #2573c7;
            display: flex;
            text-align: center;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            line-height: 0;

        }

        @media screen and (max-width:580px) {

            ul.tl li .timestamp {
                color: #8D8D8D;
                position: absolute;
                width: 100px;
                left: 61px;
                text-align: right;
                font-size: 12px;
                top: 46px;
            }

            .history-tl-container ul.tl li {
                list-style: none;
                margin-left: 0;
                min-height: 60px;
                border-left: 1px dashed #86D6FF;
                padding: 0px 0 50px 30px;
                position: relative;

            }
        }






        .jumbotron3 {
            line-height: 0;
            padding: 0.5rem 0.5rem;
            margin-bottom: 1rem;
            background-color: #ffffff;
            color: #000000;
            display: flex;
            text-align: center;
            flex-direction: column;
            justify-content: center;
            align-items: center;


        }


        .divBtns{
            display: grid;
            grid-template-columns: 50% 50%;
            padding: 20px 0px;

        }


        .btn {
  padding: 40px;
  height: 50px;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50px;
  border: none;
  cursor: pointer;
  font-weight: bold;
  color: white;
}

a{
    text-decoration: none;
    color: white;
}

    </style>
</head>

<body>



    <div class="jumbotron ">
        <h1 class="display-4">Hello</h1>

        <h1 class="display-4"> {{ $details['userWhoBought']->name }}</h1>

        <p class="lead">New message from a seller please check order shipping </p>

    </div>



    @if ($details['orderItem']->orderItemStatus == "Arrived")
    <div  class="jumbotron ">
        <h1 class="display-4">Please confirm that you receive your order</h1>

        <div class="divBtns">
<div>
    <a href="{{ $details['confirmLink'] }}"><button style="background-color: #22d172;" class="btn">Confirm</button></a>
</div>

<div>
    <a href="{{ $details['denyLink'] }}"><button style="background-color: #fb5151;" class="btn">You dont receive your order please click here  ?</button></a>
</div>

</div>



    </div>
    @endif




    <div class="jumbotron2 ">
        <h1 class="display-4">Notification</h1>
        <p class="lead">The Seller <strong> {{ $details['seller']->name }} </strong> has changed
            the shipping status </p>
        <p class="lead">Shipping status is : {{ $details['orderItem']->orderItemStatus }} </p>
    </div>



    <div class="jumbotron3">
        <h5>Order item</h5>
        <p class="lead">- {{ $details['orderItem']->name }}</p>
        <p class="lead">Qte: x{{ $details['orderItem']->quantity }}</p>
        <p class="lead">Price : ${{ $details['orderItem']->price }}</p>
        <p class="lead">Total : ${{ $details['orderItem']->price * $details['orderItem']->quantity }}</p>

    </div>




    <div class="history-tl-container">
        <ul class="tl">
            <li @if ($details['orderItem']->orderItemStatus == 'In Progress' || $details['orderItem']->orderItemStatus == 'In route' || $details['orderItem']->orderItemStatus == 'Shipped' || $details['orderItem']->orderItemStatus == 'Arrived')

                class="tl-item active"
            @else
                class="tl-item"
                @endif >
                <div class="timestamp">
                    @if ($details['orderItem']->orderItemStatus == 'In Progress' )
                        {{ $details['orderItem']->updated_at ?? '' }}
                    @endif
                </div>
                <div class="item-title">Order confirmed by the seller</div>
                <div class="item-detail">payment was validated successfuly</div>
            </li>
            <li @if ($details['orderItem']->orderItemStatus == 'In route' || $details['orderItem']->orderItemStatus == 'Shipped' || $details['orderItem']->orderItemStatus == 'Arrived')

                class="tl-item active"
            @else
                class="tl-item"
                @endif >
                <div class="timestamp">
                    @if ($details['orderItem']->orderItemStatus == 'Shipped')
                        {{ $details['orderItem']->updated_at ?? '' }}
                    @endif


                </div>
                <div class="item-title">Product was shipped</div>
                <div class="item-detail">The delivery company has charged your order item</div>
            </li>
            <li @if ($details['orderItem']->orderItemStatus == 'In route' || $details['orderItem']->orderItemStatus == 'Arrived')

                class="tl-item active"
            @else
                class="tl-item"
                @endif >
                <div class="timestamp">
                    @if ($details['orderItem']->orderItemStatus == 'In route' )
                        {{ $details['orderItem']->updated_at ?? '' }}
                    @endif
                </div>
                <div class="item-title">Your product is in route for you</div>
                <div class="item-detail">Please check your email constantly</div>
            </li>
            <li @if ($details['orderItem']->orderItemStatus == 'Arrived')

                class="tl-item active"
            @else
                class="tl-item"
                @endif >
                <div class="timestamp">
                    @if ($details['orderItem']->orderItemStatus == 'Arrived')
                        {{ $details['orderItem']->updated_at ?? '' }}
                    @endif
                </div>
                <div class="item-title">Your order has been delivered for you</div>
                <div class="item-detail">Thank you for your confidence</div>
            </li>


        </ul>

    </div>



    <div class="jumbotron2 ">
        <h1 class="display-4">Seller info :</h1>

        <p class="lead">{{ $details['seller']->name }}</p>
        <p class="lead">{{ $details['seller']->email }}</p>
        <p class="lead">{{ $details['sellerInfo']->address }}</p>
        <p class="lead">{{ $details['sellerInfo']->addressComp ?? '' }}</p>
        <p class="lead">{{ $details['sellerInfo']->postalCode }} , {{ $details['sellerInfo']->city }} </p>
        <p class="lead">{{ $details['sellerInfo']->country ?? '' }}</p>


    </div>



    {{-- <div class="history-tl-container">
        <ul class="tl">
            <li
                class="tl-item active"
                >
                <div class="timestamp">
                  hgfdhgfhgfhdgfhghf
                </div>
                <div class="item-title">Order confirmed by the seller</div>
                <div class="item-detail">payment was validated successfuly</div>
            </li>
            <li
                class="tl-item active"
           >
                <div class="timestamp">
                    etertretretert


                </div>
                <div class="item-title">Product was shipped</div>
                <div class="item-detail">The delivery company has charged your order item</div>
            </li>
            <li
                class="tl-item"
                >
                <div class="timestamp">
                  dfgfdg
                </div>
                <div class="item-title">Your product is in route for you</div>
                <div class="item-detail">Please check your email constantly</div>
            </li>
            <li )


                class="tl-item"
              >
                <div class="timestamp">
                   sdfdfsdsfdsfdsf
                </div>
                <div class="item-title">Your order has been delivered for you</div>
                <div class="item-detail">Thank you for your confidence</div>
            </li>


        </ul>

    </div> --}}


    {{-- <p>
        {{ $details["userWhoBought"] }}
    </p>

    <p>
        {{ $details["wichOrder"] }}
    </p> --}}
    {{-- <p>
        {{ $details['orderItem']->orderItemStatus }}
    </p> --}}

</body>

</html>
