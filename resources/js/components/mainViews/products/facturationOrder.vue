<template>
  <div>

  <div class="loaderDiv" v-if="loading">
         <loadingPage/>
     </div>

    <div v-if="!loading" id="invoiceholder">
      <div id="invoice" class="effect2">
        <div id="invoice-top" style="display: flex;flex-direction: row;justify-content: space-between;align-items: baseline;">
          <div class="logo">
            <img src="icons/logo.png" alt="Logo"  />
          </div>
          <div class="title">
            <h1 style="margin-top:0px">
              Reference: #<span class="invoiceVal invoice_num">{{orderInfo.id ?? ''}}</span>
            </h1>
            <p>
              Ordered at : <span id="invoice_date">{{ orderInfo.created_at ?? '' }}</span><br />

            </p>
          </div>
          <!--End Title-->
        </div>
        <!--End InvoiceTop-->

        <div id="invoice-mid" >
          <div id="message" class="mb-1 p-2" >
            <h2>Name : <span>{{userShippingAddresses.name}}</span></h2>
            <h2>Email : <span>{{userShippingAddresses.email}}</span></h2>
            <h2>Address : <span>{{userShippingAddresses.address}} {{connected_user.addressComp ? ' , '+userShippingAddresses.addressComp : ' '}} {{userShippingAddresses.city}} {{userShippingAddresses.postalCode}} </span> </h2>
            <h2>Phone : <span>{{userShippingAddresses.phone}}</span></h2>
          </div>

          <div class="clearfix mt-5">
            <div class="col-right">
              <div class="clientlogo">
                <img
                  src="https://cdn3.iconfinder.com/data/icons/daily-sales/512/Sale-card-address-512.png"
                  alt="Sup"
                />
              </div>
              <div class="clientinfo">
                <h2 id="supplier">{{ creditCardPayment.cardType ?? '' }}</h2>
                <p>
                  <span id="address">{{ creditCardPayment.nameOfCard ?? ''}}</span><br/>
                  <span id="zip">{{ creditCardPayment.cardExpDate ?? ''}}</span><br />
                  <span id="tax_num">{{ creditCardPayment.cardNumber ?? ''}}</span><br />
                </p>
              </div>
            </div>
          </div>
        </div>
        <!--End Invoice Mid-->

        <div id="invoice-bot">
          <div >
            <table class="table table1" >
              <thead>
                <tr class="tabletitle">
                  <th>Description</th>
                  <th>Unit Price</th>
                  <th>Quantity</th>
                  <th>Tax %</th>
                  <th>Tax Amount</th>
                  <th>TotalHt</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tr class="list-item" v-for="(article,key ) in articles" :key="article">
                <td class="tableitem"> <strong>{{ key+1 }}-</strong>    {{ article.name }}</td>
                <td class="tableitem">
                  {{ article.price }}
                </td>
                <td class="tableitem">{{ article.quantity }}</td>
                <td class="tableitem">20 %</td>
                <td class="tableitem">{{ (((article.quantity)*(article.price))*0.2).toFixed(2)}} $</td>
                <td class="tableitem">{{((article.quantity*article.price)-((article.quantity)*(article.price))*0.2).toFixed(2)}} $</td>
                <td class="tableitem">{{ (article.quantity*article.price).toFixed(2) }} $</td>
              </tr>


            </table>
          </div>



<div class="footerTab">
    <table>
        <tr class="list-item total-row">
                <th colspan="6" class="tableitem">Grand Total</th>
                <td data-label="Grand Total" class="tableitem">{{ globalTotal.toFixed(2) }}$</td>
              </tr>

    </table>
</div>

          <!--End Table-->

          <div id=""  v-for="index in 10" :key="index">
            <table class="table table2">
              <tbody>
                <tr>
                  <th>Description</th>

                  <td>3</td>
                </tr>
                <tr>
                  <th>Unit Price</th>

                  <td>John</td>
                </tr>
                <tr>
                  <th>Quantity</th>

                  <td>Rambo</td>
                </tr>
                <tr>
                  <th>Tax %</th>
                  <td>johnrambo@mail.com</td>
                </tr>

                <tr>
                  <th>Tax Amount</th>
                  <td>johnrambo@mail.com</td>
                </tr>

                <tr>
                  <th>TotalHt</th>

                  <td>johnrambo@mail.com</td>
                </tr>

                <tr>
                  <th>Total</th>

                  <td>johnrambo@mail.com</td>
                </tr>


              </tbody>
            </table>
          </div>



<div class="footerTab2">
    <table>
        <tr class="list-item total-row">
                <th colspan="6" class="tableitem">Grand Total</th>
                <td data-label="Grand Total" class="tableitem">111.84</td>
              </tr>

    </table>
</div>


        </div>
        <!--End InvoiceBot-->
        <footer>
          <div id="legalcopy" class="clearfix">
            <p class="col-right">
              Our mailing address is:
              <span class="email"><a>tunshop@support.com</a></span>
            </p>
          </div>
        </footer>
      </div>
      <!--End Invoice-->
    </div>
    <!-- End Invoice Holder-->
  </div>
</template>







<script>
import loadingPage from './loadPage.vue'

export default {
        components : {loadingPage},

  data() {
    return {
        orderInfo:{},

    globalTotal:0,

    token:'',
    connected_user:{

    },
       order :{
            order_id : '' ,
       },
        articles : [],


        creditCardPayment : {

            nameOfCard : '',
            cardNumber : '',
            cardExpDate : '',
            cardType :'',

        },


        userShippingAddresses : {}
    };
  },
  mounted(){

    this.order.order_id=localStorage.getItem('lastOrderId');
    this.connected_user.id=localStorage.getItem('user_id');
    this.connected_user.useremail=localStorage.getItem('useremail');
    this.connected_user.username=localStorage.getItem('username');

if(localStorage.getItem('lastOrderId')){
      this.getArticles();
      this.getUserInfo();
      this.getOrderInfo();
  }



},

  methods : {

      getOrderInfo(){

           this.token = localStorage.getItem("token");
          let config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
          axios.post('api/orders' , this.order , config ).then((response) => {
              this.orderInfo = response.data.orders1[0];
              this.creditCardPayment = response.data.payementCard[0];
              console.log(this.orderInfo)

            //   this.loading = false;

          }).catch((err) => {

          });
      },
      getUserInfo(){
           this.token = localStorage.getItem("token");
          let config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };

      this.connected_user.userAddress_id = localStorage.getItem('userAddress_id');
          axios.post('api/userShippingAddressesGet' , this.connected_user , config).then((response) => {

              this.userShippingAddresses=response.data.userShippingAddresses[0];
                this.userShippingAddresses.email=localStorage.getItem("useremail");
}).catch((err) => {

          });
      },
      getArticles(){
          this.globalTotal=0;
          this.articles=[];
        this.token = localStorage.getItem("token");
          let config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
          axios.post('api/OrderItems' , this.order , config).then((response) => {

              response.data.orderItems.forEach(element => {
                  this.globalTotal+=element.price*element.quantity;
                  this.articles.push(element);
              });

              console.log("dsfsqdfdfqs",this.articles);

          }).catch((err) => {

          });

      },
  }
};
</script>

















<style>
@import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,900,700,500,300,100);

::selection {
  background: #f31544;
  color: #fff;
}
::moz-selection {
  background: #f31544;
  color: #fff;
}
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}
#invoiceholder .col-left {
  float: left;
}
#invoiceholder .col-right {
  float: right;
}
#invoiceholder h1 {
  font-size: 1.5em;
  color: #444;
}
#invoiceholder h2 {
  font-size: 0.9em;
}
#invoiceholder h3 {
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
#invoiceholder p {
  font-size: 0.75em;
  color: #666;
  line-height: 1.2em;
}
#invoiceholder a {
  text-decoration: none;
  color: #0370c8;
}

#invoiceholder {
  width: 100%;
  height: 100%;
  padding: 50px 0;
}
#invoice {
  position: relative;
  margin: 0 auto;
  width: 700px;
  background: #fff;
}

[id*="invoice-"] {
  /* Targets all id with 'col-' */
  /*  border-bottom: 1px solid #EEE;*/
  padding: 20px;
}

#invoice-top {
  border-bottom: 2px solid #0370c8;
}
#invoice-mid {
  min-height: 110px;
}
#invoice-bot {
  min-height: 240px;
}

#invoiceholder .logo {
  display: inline-block;
  vertical-align: middle;
  width: 40px;
  overflow: hidden;
}
#invoiceholder .info {
  display: inline-block;
  vertical-align: middle;
  margin-left: 20px;
}
#invoiceholder .logo img,
#invoiceholder .clientlogo img {
  width: 100%;
}
#invoiceholder .clientlogo {
  display: inline-block;
  vertical-align: middle;
  width: 50px;
}
#invoiceholder .clientinfo {
  display: inline-block;
  vertical-align: middle;
  margin-left: 20px;
}
#invoiceholder .title {
  float: right;
}
#invoiceholder .title p {
  text-align: right;
}
#message {
  margin-bottom: 30px;
  display: block;
}
#invoiceholder h2 {
  margin-bottom: 5px;
  color: #444;
}
#invoiceholder .col-right td {
  color: #666;
  padding: 5px 8px;
  border: 0;
  font-size: 0.75em;
  border-bottom: 1px solid #eeeeee;
}
#invoiceholder .col-right td label {
  margin-left: 5px;
  font-weight: 600;
  color: #444;
}
#invoiceholder .cta-group a {
  display: inline-block;
  padding: 7px;
  border-radius: 4px;
  background: rgb(196, 57, 10);
  margin-right: 10px;
  min-width: 100px;
  text-align: center;
  color: #fff;
  font-size: 0.75em;
}
#invoiceholder .cta-group .btn-primary {
  background: #00a63f;
}
#invoiceholder cta-group.mobile-btn-group {
  display: none;
}
#invoiceholder table {
  width: 100%;
  border-collapse: collapse;
}
#invoiceholder td {
  padding: 10px;
  border-bottom: 1px solid #cccaca;
  font-size: 0.7em;
  text-align: left;
}

#invoiceholder .tabletitle th {
  border-bottom: 2px solid #ddd;
  text-align: center;
}
#invoiceholder .tabletitle th:nth-child(2) {
  text-align: left;
}
#invoiceholder th {
  font-size: 0.7em;
  text-align: left;
  padding: 5px 10px;
}
#invoiceholder .item {
  width: 50%;
}
#invoiceholder .list-item td {
  text-align: center;
}
#invoiceholder .list-item td:nth-child(2) {
  text-align: left;
}
#invoiceholder .total-row th,
#invoiceholder .total-row td {
  text-align: right;
  font-weight: 700;
  font-size: 0.75em;
  border: 0 none;
}
#invoiceholder footer {
  border-top: 1px solid #eeeeee;
  padding: 15px 20px;
}
#invoiceholder .effect2 {
  position: relative;
}









#invoice-top {
  height: 100px;
}
@media screen and (max-width: 767px) {
  #invoice-top {
    display: flex;
    justify-content: center;
  }

  #invoiceholder h1 {
    font-size: 0.9em;
  }
  #invoice {
    width: 100%;
  }
  #message {
    margin-bottom: 20px;
  }
  [id*="invoice-"] {
    padding: 20px 10px;
  }

  #invoiceholder .title {
    float: none;
    display: inline-block;
    vertical-align: middle;
    margin-left: 40px;
  }
  #invoiceholder .title p {
    text-align: left;
  }

  #invoiceholder .table1 {
    margin-top: 20px;
  }
  #table {
    white-space: nowrap;
    overflow: auto;
  }
  #invoiceholder td {
    white-space: normal;
  }
  #invoiceholder .cta-group {
    text-align: center;
  }
  #invoiceholder .cta-group.mobile-btn-group {
    display: block;
    margin-bottom: 20px;
  }
  /*==================== Table ====================*/
  #invoiceholder .table-main {
    border: 0 none;
  }
  #invoiceholder .table-main thead {
    border: none;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
  }

  #invoiceholder .total-row td {
    text-align: left;
  }
  #invoiceholder footer {
    text-align: center;
  }
}

@media screen and (max-width: 546px) {
  #invoiceholder .table1 {
    display: none;
  }

  .footerTab2{
      display: none;
  }
}

@media screen and (min-width: 546px) {
  #invoiceholder .table2 {
    display: none;
  }
  .footerTab2{
      display: none;
  }



}
</style>
