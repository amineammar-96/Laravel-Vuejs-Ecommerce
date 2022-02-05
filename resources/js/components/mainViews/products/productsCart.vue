<template>
  <div class="loaderDiv" v-if="loading">
    <loadingPage />
  </div>

  <div v-if="!loading" class="container2">
    <div class="mb-5">
      <div class="containerBar" v-if="cart.length > 0">
        <ul class="progressbar">
          <li v-bind:class="{ active: isActive(1), focus: isFocused(1) }">
            <span class="text-dark font-weight-bold liProgressBar">Cart</span>
          </li>
          <li v-bind:class="{ active: isActive(2), focus: isFocused(2) }">
            <span class="text-dark font-weight-bold liProgressBar"
              >Profile</span
            >
          </li>
          <li v-bind:class="{ active: isActive(3), focus: isFocused(3) }">
            <span class="text-dark font-weight-bold liProgressBar"
              >Payment</span
            >
          </li>
          <li v-bind:class="{ active: isActive(4), focus: isFocused(4) }">
            <span class="text-dark font-weight-bold liProgressBar"
              >Validation</span
            >
          </li>
        </ul>
      </div>
    </div>

    <div class="steps">
      <br /><br /><br /><br /><br />

      <div class="step1 my-4" v-if="step == 1">
        <div class="container-fluid mt-5">
          <h6 class="my-5 text-center"></h6>
          <div class="row justify-content-center">
            <div class="col-md-12 px-3 py-5">
              <div v-if="cart.length == 0" class="text-center">
                <img src="/icons/emptyCart.png" alt="" />
                <p>Empty cart</p>
              </div>
              <div class="table-responsive" v-if="cart.length > 0">
                <table id="myTable" class="table">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Product</th>
                      <th>Name</th>
                      <th>
                        <span>Quantity</span>
                      </th>
                      <th>Price</th>
                      <th style="display: flex; justify-content: end">
                        <span id="amount" class="amount">Amount</span>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(cartItem, key) in cart" :key="key" class="m-4">
                      <td>
                        <div>
                          <img
                            @click="deleteCartItem(cartItem.id)"
                            class="deletItemCart"
                            src="/icons/delete.png"
                            alt=""
                          />
                        </div>
                      </td>
                      <td>
                        <div class="img-prdct">
                          <img
                            :src="'/uploads/' + cartItem.image"
                            style="cursor: pointer"
                            @click="getData(cartItem.product_id)"
                          />
                        </div>
                      </td>
                      <td>
                        <span>{{ cartItem.name }}</span>
                      </td>
                      <td style="width: 100px;">
                        <div class="button-container">
                          <div class="input-group inline-group" style="justify-content: center;">

                              <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
                            <input
                              v-model="cartItem.quantity"
                              :max="quantities[key]"

                              min="1"
                              class="form-control"
                              @keypress="onlyNumber"
                              @input="updateValue($event, key)"
                              type="number"
                              @change="
                                quantityCartChange(
                                  cartItem.id,
                                  cartItem.quantity,
                                  key
                                )
                              "
                              style="height: 78%; background: rgb(236, 236, 236) none repeat scroll 0% 0%; border-radius: 10%; border: medium none;width: 50px;text-align: center;"
                            />
                            </div>


                            <div>
                            <div class="input-group-append">
                              <button
                              @click="quantityCartChange(
                                  cartItem.id,
                                  cartItem.quantity,
                                  key,
                                  'up'
                                )
                              "
                             style="padding:0px 12px;height:35px;background-color: #0000;border: none;"
                                class=""
                              >
<i class="fas fa-chevron-circle-up menu-icon5"></i>                              </button>
                            </div>




                           <div class="input-group-prepend">
                              <button

                               @click="quantityCartChange(
                                  cartItem.id,
                                  cartItem.quantity,
                                  key,
                                  'down'
                                )
                              "
                             style="padding:0px 12px;height:35px;background-color: #0000;border: none;"
                                class="  "
                              >
<i class="fas fa-chevron-circle-down menu-icon5"></i>                              </button>
                            </div>
</div>

                          </div>


                        </div>
                      </td>
                      <td>
                        <span class="amount"
                          ><small>$</small>{{ cartItem.price }}</span
                        >
                      </td>
                      <td align="right" style="width: 100px">
                        <small>$</small>
                        <span id="amount" class="amount">{{
                          (cartItem.price * cartItem.quantity).toFixed(2)
                        }}</span>
                      </td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr v-if="cart.length > 0">
                      <td colspan="4"></td>
                      <td colspan="2" style="text-align: right">
                        <button @click="passOrder()" class="orderBtnCart">
                          Order

                          <strong>
                            $
                            <span> {{ total.toFixed(2) }}</span></strong
                          >
                        </button>
                      </td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="step2" v-if="step == 2">
        <MakeProfile />
        <div class="text-right stapsBtn" v-if="!inputsChangedState">
          <!-- <button @click="step-- && setStepValue(1)" class="btn btn-secondary">Back</button> -->
          <!-- <button @click="verifyAddress()" class="btn btn-success">Next</button> -->
        </div>
      </div>

      <div class="step3" v-show="step == 3">
        <br /><br />

        <Payement class="mb-5" />
        <div class="text-center stapsBtn mt-5">
          <!-- <button @click="step--" class="btn btn-secondary">Back</button> -->
        </div>
      </div>

      <div class="step4" v-if="step == 4">
        <facturationOrder />
        <div class="text-right stapsBtn">
          <button @click="step++ && setStepValue(5)" class="btn btn-success">
            Next
          </button>
        </div>
      </div>

      <div
        class="step5 py-5"
        v-if="step == 5"
        style="display: flex; justify-content: center"
      >
        <confirmationOrder />
      </div>
    </div>
  </div>
</template>













<script>
import MakeProfile from "../../authViews/MakeProfile.vue";
import Payement from "./payement.vue";
import confirmationOrder from "./confirmationOrder.vue";
import facturationOrder from "./facturationOrder.vue";
import Swal from "sweetalert2";
import loadingPage from "./loadPage.vue";

export default {
  components: {
    MakeProfile,
    Payement,
    confirmationOrder,
    facturationOrder,
    loadingPage,
  },
  data() {
    return {
      loading: true,
      inputsChangedState: false,
      step: 1,
      totalSteps: 4,

      amount: 0,

      cart: [],

      connected_user: {
        user_id: null,
      },
      token: null,

      item: {
        id: null,
      },

      total: 0,

      quantities: [],

      selectedValueQuantity: {
        value: 0,
      },

      OnlyOneTimeCount: 0,

      user: {
        id: "",
      },

      firstTimeOrderStep: true,
    };
  },

  mounted() {
    localStorage.setItem("userAddress_id", "");

    if (localStorage.getItem("token").length == 0) {
      this.$router.push("/");
    } else if (localStorage.getItem("token").length > 0) {
      this.getCartItem();
    }

    localStorage.setItem("paymentStep", 1);
    this.todo();

    this.firstTimeOrderStep = false;
  },
  methods: {
    updateValue($event, key) {

      let value = $event.target.value;
      if (value > this.quantities[key]) {
        this.cart[key].quantity = this.quantities[key];
      }
      if (value == "") {
        this.cart[key].quantity = 1;
      }
    },

    onlyNumber($event) {
      console.log($event.keyCode); //keyCodes value
         let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
         if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) { // 46 is dot
      $event.preventDefault();
         }
    },
    setStepValue(x) {
      localStorage.setItem("paymentStep", x);
      console.log(localStorage.getItem("paymentStep"));
    },

    todo: function () {
      this.intervalid1 = setInterval(
        function () {
          this.step = localStorage.getItem("paymentStep");
          this.inputsChangedState = localStorage.getItem("inputsChangedState");
          if (this.step == 2) {
            localStorage.setItem("paymentStep", 2);
          }

          this.step = localStorage.getItem("paymentStep");

          let newItemCartWasAdded = localStorage.getItem("newItemCartWasAdded");
          console.log("newItemCartWasAdded", newItemCartWasAdded);
          if (
            newItemCartWasAdded != "" &&
            newItemCartWasAdded &&
            this.OnlyOneTimeCount == 0 &&
            localStorage.getItem("token").length > 0
          ) {
            this.getCartItem();
            this.OnlyOneTimeCount++;
          } else {
            this.OnlyOneTimeCount = 0;
            localStorage.setItem("newItemCartWasAdded", "");
          }

          if (
            localStorage.getItem("userAddress_id") &&
            this.step != 1 &&
            this.step == 2
          ) {
            this.step = 3;
          }
        }.bind(this),
        200
      );
    },

    getCartItem() {
      this.cart = [];

      this.connected_user.user_id = localStorage.getItem("user_id");
      this.token = localStorage.getItem("token");

      let config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
      this.total = 0;
      this.quantities = [];
      axios
        .post("api/getCart", this.connected_user, config)
        .then((response) => {
          //console.log(response.data.cartItems);
          response.data.cartItems.forEach((element) => {
            element.amount =
              parseFloat(element.price) * parseInt(element.quantity);
            this.total += element.amount;
            this.cart.push(element);
          });

          console.log(this.cart);
          this.loading = false;

          this.cart.forEach((element) => {
            console.log("dfgdg", element.product_id);

            axios
              .get("api/products/" + element.product_id)
              .then((response) => {
                response.data.forEach((element) => {
                  console.log("elem :", element.quantity);
                  this.quantities.push(element.quantity);
                });
              })
              .catch((err) => {});
          });

          this.quantities.forEach((element) => {
            console.log("this: ", element);
          });
        })
        .catch((err) => {});
    },

    deleteCartItem(id) {
      let config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };

      Swal.fire({
        title: "Delete this item?",
        icon: "warning",
        showCancelButton: true,
        cancelButtonColor: "#ee4646",
        confirmButtonColor: "#0370c8",
        confirmButtonText: "Yes, Delete it!",

        customClass: { popup: "swal2-border-radius" },
        cancelButtonClass: " px-4 py-2 rounded-pill ",
        confirmButtonClass: " px-4 py-2 rounded-pill ",
      }).then((response) => {
        if (response.value) {
          axios
            .post("api/cartDelete/" + id, this.connected_user, config)
            .then((response) => {
              console.log(response);

              localStorage.setItem(
                "countCart",
                parseInt(response.data.cartItemCountIconValue.length)
              );
              this.getCartItem();
            });
        }
      });
    },

    passOrder() {
      localStorage.setItem("paymentStep", 1);
      localStorage.setItem(
        "paymentStep",
        parseInt(localStorage.getItem("paymentStep")) + 1
      );
      console.log("steeeeeeps: ", localStorage.getItem("paymentStep"));
      console.log(
        "steeeeeeps: ",
        localStorage.getItem("headerMakeProfileState")
      );
      localStorage.setItem("headerMakeProfileState", "");
    },

    quantityCartChange(id, value, key , txt) {
      //   this.loading=true;
      let config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };

      if(txt=="up" && value<this.quantities[key]){
          value++;
      }else if(value!=1 && txt=="down") {
          value--;
      }









      this.selectedValueQuantity.value = value;

      this.cart[key].quantity = value;
      console.log(id, " - ", this.cart[key].quantity);

      this.total = 0;

      this.cart.forEach((element) => {
        this.total += element.price * element.quantity;
      });

      setTimeout(()=>{
axios
        .post("api/cartItemQuantity/" + id, this.selectedValueQuantity, config)
        .then((response) => {
          console.log(response);
          //this.getCartItem();
          //   localStorage.setItem("newItemCartWasAdded", "true");
        })
        .catch((err) => {});
      },2000)


    },

    getData(id) {
      this.$router.push('/oneProduct/?product_id='+id);
    },

    isActive(x) {
      return this.step > x;
    },

    isFocused(x) {
      return x == this.step;
    },

    //     verifyAddress(){
    //          let config = {
    //         headers: {
    //           Authorization: `Bearer ${this.token}`,
    //         },
    //       };
    //           this.user.id = localStorage.getItem("user_id");

    //       axios
    //         .post("api/getProfile", this.user, config)
    //         .then((response) => {
    //             if(response.data.status=='not found'){

    //                 Swal.fire({
    //   icon: 'error',
    //   text: 'Please you must complete your profile informations !',
    // customClass: { popup: "swal2-border-radius" }
    //    ,
    //     confirmButtonClass: " px-4 py-2 rounded-pill ",    confirmButtonColor: "#0370c8",

    // })

    //             }else {

    //                  Swal.fire({
    //   title: "Please validate the shipping address ",
    //     icon: "warning",
    //     showCancelButton: true,
    //     cancelButtonText : 'Chose another one',
    //     cancelButtonColor : '#ee4646',
    //     confirmButtonColor: "#0370c8",
    //     confirmButtonText: "Validate",
    //     customClass: { popup: "swal2-border-radius" },
    //      confirmButtonClass: " px-4 py-2 rounded-pill ",
    //       cancelButtonClass: " px-4 py-2 rounded-pill ",

    // }).then(response => {
    // if(response.value) {    localStorage.setItem('paymentStep' , 3 ) } });

    //             }
    //     // if(response.data.userInfoItem){
    //     // this.user = response.data.userInfoItem[0];
    //     // this.user.name = response.data.userInfoItem[0].name;

    //     // }
    //     // this.user.id = localStorage.getItem("user_id");
    //     // this.token = localStorage.getItem("token");
    //     // this.user.image = localStorage.getItem("img");

    //          console.log(this.user);
    //         })
    //         .catch((err) => {});
    //     }
  },
};
</script>



















<style>
input:focus,
button:focus,
.form-control:focus {
  outline: none;
  box-shadow: none;
}
.form-control:disabled,
.form-control[readonly] {
  background-color: #fff;
}
.table tr,
.table tr td {
  vertical-align: middle;
}

table td {
  width: 5px;
}

.button-container {
  display: flex;
  align-items: center;
}
.button-container .form-control {
  max-width: 80px;
  text-align: center;
  display: inline-block;
  margin: 0px 5px;
}
#myTable .form-control {
  width: auto;
  display: inline-block;
}
.cart-qty-plus,
.cart-qty-minus {
  width: 38px;
  height: 38px;
  background-color: #fff;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
}
.cart-qty-plus:hover,
.cart-qty-minus:hover {
  background-color: #5161ce;
  color: #fff;
}
.img-prdct {
  width: 150px;
  height: 150px;
  margin: 50px 0px 50px 50px;
  filter: drop-shadow(0 0 0.75rem rgba(212, 205, 206, 0.472));
  border-radius: 4px;
}
.img-prdct img {
  width: 100%;
  border-radius: 20px;
}

.containerBar {
  width: 100%;
  color: white;
  background: #2979ff;
  font-family: "Roboto", sans-serif;
  margin: 5% 0px;
}

.progressbar {
  counter-reset: step;
}

.progressbar li {
  position: relative;
  list-style: none;
  float: left;
  width: 25%;
  text-align: center;
}

/* Circles */
.progressbar li:before {
  /* content: counter(step); */
  counter-increment: step;
  width: 60px;
  height: 60px;
  text-align: center;
  margin: 0 auto 10px auto;
  border-radius: 50%;
  background-color: #e7e7e7;
  display: flex;
  justify-content: center;
  align-items: center;
  color: black;

  font-weight: bold;
  font-size: 25px;

  /* Center # in circle */
  line-height: 39px;
}

.progressbar li:first-child:before {
  /* content: counter(step); */
  content: url("/icons/cartProgressBar.png");
  counter-increment: step;
}

.progressbar li:nth-child(2):before {
  /* content: counter(step); */
  content: url("/icons/profileProgressBar.png");
  counter-increment: step;
  background-size: 50px 20px;
}

.progressbar li:nth-child(3):before {
  /* content: counter(step); */
  content: url("/icons/payment.png");
  counter-increment: step;
  background-size: 50px 20px;
}

.progressbar li:nth-child(4):before {
  /* content: counter(step); */
  content: url("/icons/validate.png");
  counter-increment: step;
  background-size: 50px 20px;
}

.progressbar li:after {
  content: "";
  position: absolute;
  width: 100%;
  height: 3px;
  background: #2a2a2a;
  top: 30px; /*half of height Parent (li) */
  left: -50%;
  z-index: -1;
}

.progressbar li:first-child:after {
  content: none;
}

.progressbar li.active:before {
  background: #00bb61;
  content: url("/icons/tick.png");
  color: white;
}

.progressbar li.active + li:after {
  background: #00bb61;
}

.progressbar li.focus:before {
  -webkit-box-shadow: 0px 0px 0px 3px #000000;
  box-shadow: 0px 0px 0px 3px #000000;
}

.liProgressBar {
  font-size: 22px;
}

@media screen and (max-width: 770px) {
  .liProgressBar {
    font-size: 15px;
  }
  /* Circles */
  .progressbar li:before {
    width: 50px;
    height: 50px;
    font-size: 18px;
  }

  .progressbar li:after {
    top: 25px; /*half of height Parent (li) */
    left: -50%;
  }
  .progressbar {
    margin-left: -40px;
  }
}

.progressbar {
  margin-left: -40px;
}






.menu-icon5 {
    display: block;
    font-size: 1.1rem;
    color: #000000;
    position: relative;
    z-index: 100;
    transition: 400ms;

}
</style>
