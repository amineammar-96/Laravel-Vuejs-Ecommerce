<template>
  <div>
    <div v-if="loading" class="div">
      <loading-page />
    </div>

    <div v-if="!loading" class="holderInvoice">
      <div class="container">
        <div class="row">
          <div class="col-xs-12">
            <div class="invoice-title">
              <h2>Invoice</h2>
              <h6> <strong :class="order.paymentStatus.toLowerCase()!='paid' ? 'text-danger' : 'text-success'">{{order.paymentStatus}}</strong></h6>
              <h3 style="margin-top: -31px;" class="pull-right">Order # {{ order.id }}</h3>
            </div>
            <hr />
            <div class="" style="display: grid; grid-template-columns: 50% 50%">
              <div class="col-xs-6">
                <address>
                  <strong>Billing Address :</strong><br />
                  {{ userFacturationAddress.name }}<br />
                  {{ userFacturationAddress.address }}<br />
                  {{ userFacturationAddress.addressComp ?? ""
                  }}<br v-if="userFacturationAddress.addressComp != null" />

                  {{ userFacturationAddress.country }}

                  , {{ userFacturationAddress.city }}
                  {{ userFacturationAddress.postalCode }}

                  <br>                  {{ connected_user.email }}
                </address>
              </div>
              <div class="col-xs-6 text-right">
                <address>
                  <strong>Shipping Address :</strong><br />
                  {{ userShippingAddress.name }}<br />
                  {{ userShippingAddress.address }}<br />
                  {{ userShippingAddress.addressComp ?? ""
                  }}<br v-if="userShippingAddress.addressComp != null" />

                  {{ userShippingAddress.country }}

                  , {{ userShippingAddress.city }}
                  {{ userShippingAddress.postalCode }}

                  <br>                  {{ connected_user.email }}

                </address>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-6">
                <address>
                  <strong>Payment Method:</strong><br />
                  {{ creditCard.nameOfCard }}  <br />
                  {{ creditCard.cardType }} ending **** {{ creditCardCrytedNumber }}
                </address>
              </div>
              <div class="col-xs-6 text-right">
                <address>
                  <strong>Order Date:</strong><br />
                  {{ order.created_at }}<br /><br />
                </address>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="panel-title"><strong>Order summary</strong></h3>
              </div>
              <div class="panel-body">
                <div class="table-responsive">
                  <table class="table table-condensed">
                    <thead>
                      <tr>
                        <td><strong>Item</strong></td>
                        <td class="text-center"><strong>Price</strong></td>
                        <td class="text-center"><strong>Quantity</strong></td>
                        <td class="text-right"><strong>Totals</strong></td>
                        <td class="text-right"><strong>Status</strong></td>

                      </tr>
                    </thead>
                    <tbody>
                      <!-- foreach ($order->lineItems as $line) or some such thing here -->
                      <tr v-for="(orderItem , key) in order.order_items " :key='key'>
                        <td><span :style="orderItem.orderItemStatus=='Cancelled' ? 'text-decoration: line-through;text-decoration-color: red;' : ''">{{ orderItem.name }}</span></td>
                        <td class="text-center"><span :style="orderItem.orderItemStatus=='Cancelled' ? 'text-decoration: line-through;text-decoration-color: red;' : ''">${{ orderItem.price }}</span></td>
                        <td class="text-center"><span :style="orderItem.orderItemStatus=='Cancelled' ? 'text-decoration: line-through;text-decoration-color: red;' : ''">{{ orderItem.quantity}}</span></td>
                        <td class="text-right"><span :style="orderItem.orderItemStatus=='Cancelled' ? 'text-decoration: line-through;text-decoration-color: red;' : ''">${{ (orderItem.price*orderItem.quantity).toFixed(2)  }}</span></td>
                        <td class="text-left fw-bold" :class="orderItem.orderItemStatus!='Waiting for payment' && orderItem.orderItemStatus!='Cancelled' ? 'text-success': 'text-danger' " >{{ orderItem.orderItemStatus}}</td>

                      </tr>

                      <tr>
                        <td class="thick-line"></td>
                         <td class="thick-line"></td>
                        <td class="thick-line"></td>
                        <td class="thick-line text-center">
                          <strong>Subtotal</strong>
                        </td>
                        <td class="thick-line text-right">${{order.amount}} <span v-if="rembouresementTotal>0" class="text-danger"> - ${{rembouresementTotal.toFixed(2)  }}  = ${{ (order.amount-rembouresementTotal).toFixed(2) }} </span></td>
                      </tr>
                      <tr>
                                                  <td class="no-line"></td>

                        <td class="no-line"></td>
                        <td class="no-line"></td>
                        <td class="no-line text-center">
                          <strong>Shipping</strong>
                        </td>
                        <td class="no-line text-right">$9.99</td>
                      </tr>
                      <tr>
                                                  <td class="no-line"></td>

                        <td class="no-line"></td>
                        <td class="no-line"></td>
                        <td class="no-line text-center">
                          <strong>Total</strong>
                        </td>
                        <td class="no-line text-right">${{((parseFloat(order.amount)+9.99)).toFixed(2)}} <span v-if="rembouresementTotal>0" class="text-danger"> - ${{rembouresementTotal.toFixed(2)  }}  = ${{ (order.amount-rembouresementTotal+9.99).toFixed(2) }} </span>  </td>
                      </tr>

                       <tr v-if="rembouresementTotal!=0" >
                                                  <td class="no-line"></td>

                        <td class="no-line"></td>
                        <td class="no-line"></td>
                        <td class="no-line text-center text-danger">
                          <strong>Repayment Total</strong>
                        </td>
                        <td class="no-line text-right text-danger">+ ${{ rembouresementTotal.toFixed(2) }} </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>



<script>
import loadingPage from "./loadPage.vue";

export default {
  components: { loadingPage },
  data() {
    return {
      loading: true,

      connected_user: {
        user_id: "",
        token: "",
        order_id: "",
        email : "",
      },

      order: {},
      creditCard: {},
      userFacturationAddress: {},
      userShippingAddress: {},

      creditCardCrytedNumber :'',

      rembouresementTotal:0,
    };
  },

  mounted() {
    this.connected_user.order_id = localStorage.getItem("invoiceOrderId");

    console.log(localStorage.getItem("invoiceOrderId"));

    this.getOrders();
  },

  methods: {
    getOrders() {
      this.order = {};
      this.creditCard = {};
      this.userFacturationAddress = {};
      this.userShippingAddress = {};

      this.connected_user.user_id = localStorage.getItem("user_id");
      this.connected_user.token = localStorage.getItem("token");

      let config = {
        headers: {
          Authorization: `Bearer ${this.connected_user.token}`,
        },
      };

      axios
        .post("api/getOrderById", this.connected_user, config)
        .then((response) => {
          console.log("heeeerrrre", response.data.order[0]);

          this.order = response.data.order[0];
          this.creditCard = response.data.payementCard[0];
          this.userFacturationAddress = response.data.userFacturation[0];
          this.userShippingAddress = response.data.shippingAddress[0];
          this.connected_user.email = response.data.user[0].email;


        if(this.order.paymentStatus=="Paid" || this.order.paymentStatus=="Will be reimbursed" ){
          this.order['order_items'].forEach(element => {
              if(element.orderItemStatus=="Cancelled"){
              this.rembouresementTotal+=element.price*element.quantity
              }
          });
        }

          for (
            let i = this.creditCard.cardNumber.length-1;
            i > this.creditCard.cardNumber.length-5;
            i--
          ) {
            const element = this.creditCard.cardNumber[i];
            console.log("dfgdfgfdg", element);

            this.creditCardCrytedNumber=element+this.creditCardCrytedNumber
          }

          console.log(this.creditCardCrytedNumber)

          setTimeout(() => {
            this.loading = false;
          }, 1000);

          console.log("rfdettzertz", this.orders);
        })
        .catch((err) => {
          this.loading = false;
        });
    },
  },
};
</script>
