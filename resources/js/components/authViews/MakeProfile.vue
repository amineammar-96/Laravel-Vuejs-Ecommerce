<template>
<div>
    <div class="loaderDiv" v-if="loading">
         <loadingPage/>
     </div>

  <div v-if="!loading">
    <div class="profileHeader" v-if="headerMakeProfileState">
      <header v-if="login" class="wrapper createProductHeader p-4">
        <span @click="step = 1" class="m-2 text-white" style="cursor: pointer"
          >Profile</span
        >
        <span @click="step = 2" class="m-2 text-white" style="cursor: pointer"
          >Shipping addresses</span
        >
        <span @click="step = 3" class="m-2 text-white" style="cursor: pointer"
          >Credit Cards</span
        >

        <span @click="step = 4" class="m-2 text-white" style="cursor: pointer"
          >Account</span
        >
      </header>
    </div>

    <div v-if="step == 2"  class="newProfileFormDiv w-100">
 <div v-if="headerMakeProfileState && userShippingAddresses.length > 1" style="width: 100%;" class="img3 bg-white">
            <img style="width: 35px;" src="/icons/choseDefaultAddressClick.png" alt=""><span class='pl-2'>Click your select default address</span>
        </div>
      <div class="containerDivs">

        <div class="row  rowAux">
            <h4 v-if="!headerMakeProfileState" style="text-align: center;" >Please select a shipping address</h4>
          <div class="col p-5"  v-for="(userShippingAddress,key) in userShippingAddresses" :key="key">

<div class="container" @click="selectDefaultAddress(userShippingAddress.id , key)">
        <div v-if="headerMakeProfileState" class="img">
            <img @click="userShippingAddressesDelete(userShippingAddress.id)" src="/icons/minimize.png" alt="">
        </div>
        <p class="name">{{ userShippingAddress.name }}</p>
        <p class="text">{{ userShippingAddress.address }}</p>
        <p class="text">{{ userShippingAddress.phone }}</p>

        <p class="text">{{ userShippingAddress.city }}, {{ userShippingAddress.country }}</p>

        <div v-if="userShippingAddress.defaultAddress=='true'" class="img2">
            <img  src="/icons/defaultAddress.png" alt="Default address">
</div>

    </div>
          </div>



          <div class="addAddressImgDiv"  style="display:flex;align-items:center;flex-direction: column; margin-bottom:20px">
              <img data-bs-toggle="modal" data-bs-target="#exampleModal"  src="/icons/addAddress.png" alt="">
          </div>

        </div>
      </div>
    </div>






<div class="inline creditCards" v-if="step==3">

    <div class="row p-0 m-0">
        <div class=" col-lg-6 col-md-6  col-sm-12 py-5" style="display: flex;justify-content: center;" v-for="(creditCard , key) in creditCards" :key="key"  >
                <div class="wrapper" style="cursor:pointer;" @click="setCreditCardInfo(key)">
  <div class="cc visa">
    <svg width="295" height="87">
      <path d="M 0 0 C 50 50 250 0 300 87"></path>
    </svg>
    <div class="container">
      <div class="type">

        {{ creditCard.cardType.toUpperCase() }}
      </div>
      <!-- <div class="circuit">
       <i class="fab fa-cc-visa fa-2x"></i>
      </div> -->
    </div>
    <div class="holder">
      <span class="name">{{creditCard.nameOfCard}}</span>
      <span class="number">{{ creditCardsDashedNumber[key]}}</span>
      <span>{{creditCard.cardExpDate}}</span>
    </div>

  </div>
</div>
        </div>

<div class="text-center my-5">
          <button  class="btn fw-bold rounded-circle text-white  btn-dark">+</button>
        </div>




    </div>















</div>








    <div class="profileBody " v-if="step == 1">

<div class="container">
    <div :class="!headerMakeProfileState ? 'text-center' : ''">
  <h1 v-if="headerMakeProfileState">Profile</h1>
  <p v-if="headerMakeProfileState">Please make sure to update your profile.</p>
  <h1 v-if="!headerMakeProfileState">Shipping address</h1>
  <p v-if="!headerMakeProfileState">Please make sure of your address.</p>

  </div>
  <div class="form">

  <div class="fields fields--2">
    <label class="field">
      <span class="field__label" for="firstname">Full name</span>
      <input @change="inputChanged()" class="field__input" v-model="user.name" type="text" id="firstname" />
    </label>

     <label class="field">
      <span class="field__label" for="phone">Phone</span>
      <input @change="inputChanged()" class="field__input" v-model="user.phone" type="text" id="firstname" />

    </label>

  </div>
  <label class="field">
    <span class="field__label" for="address">Address</span>
    <input  @change="inputChanged()" class="field__input" v-model="user.address"  type="text" id="address" />

  </label>
  <label class="field">
    <span class="field__label" for="address">completement address</span>
    <input  @change="inputChanged()" class="field__input" v-model="user.addressComp"  type="text" id="addressComp" />
  </label>
  <label class="field">
    <span class="field__label"  for="country">Country</span>
    <select  @change="inputChanged()" class="field__input" v-model="user.country" id="country">
      <option value=""></option>
      <option value="unitedstates">United States</option>
    </select>

  </label>
  <div class="fields fields--2">
    <label class="field">
      <span class="field__label" for="zipcode">Zip code</span>
      <input  @change="inputChanged()" class="field__input" v-model="user.postalCode" type="text" id="zipcode" />

    </label>
    <label class="field">
      <span class="field__label" for="city">City</span>
      <input  @change="inputChanged()" class="field__input" v-model="user.city" type="text" id="city" />

    </label>

  </div>
   <p v-if="errors.phone" class="m-0 p-0  text-danger">
             <small> {{ errors.phone }} </small>
            </p>
   <p  v-if="errors.address" class="m-0 p-0  text-danger">
             <small> {{ errors.address }} </small>
            </p>
             <p v-if="errors.country" class="m-0 p-0  text-danger">
             <small> {{ errors.country }} </small>
            </p>
             <p v-if="errors.postalCode" class="m-0 p-0  text-danger">
             <small> {{ errors.postalCode }} </small>
            </p>
             <p  v-if="errors.city" class="m-0 p-0  text-danger">
             <small> {{ errors.city }} </small>
            </p>
  </div>

  <div class="gridBtnsProfile mb-5" >
      <button
            @click="routePush"
            v-if="updateLaterBtn"
            class="button rounded-pill"

          >
            Update later
          </button>
          <span v-if="updateLaterBtn" ></span>
  <button class="button rounded-pill"  v-if="!updateLaterBtn && inputsChangedState"            @click="getUserInfo()">Cancel</button>
  <span  v-if="!updateLaterBtn && inputsChangedState"  ></span>
  <button class="btn2Profile rounded-pill"  v-if="!updateLaterBtn && inputsChangedState"            @click="updateProfile">Save changes</button>

          </div>
</div>


    </div>






    <div class="accountStep" v-if="step == 4">

        <div class="gridAccountDetails">

            <div class="sideBarAccount">


                <div class="main-app">
  <div class="sidebar">
    <nav class="main-nav">
      <ul class="main-menu">
        <li class="menu-item " :class="accountListStep==1 ? 'active' : ''">
          <a class="menu-a" @click='accountListStep=1' >
            <div class="menu-txt-hld">
              <i class="fas fa-user-circle menu-icon"></i>
              <span class="menu-txt">General Information</span>
            </div>
          </a>
        </li>
         <li class="menu-item" :class="accountListStep==2 ? 'active' : ''" >
          <a  class="menu-a" @click='accountListStep=2'>
            <div   class="menu-txt-hld">
              <i class="fas fa-user-cog menu-icon"></i>
              <span class="menu-txt">Email and password</span>
            </div>
          </a>
        </li>
        <li class="menu-item" :class="accountListStep==3 ? 'active' : ''">
          <a  class="menu-a">
            <div   class="menu-txt-hld">
              <i class="fas fa-bell menu-icon"></i>
              <span class="menu-txt">Notifications</span>
            </div>
          </a>
        </li>
        <li class="menu-item" :class="accountListStep==4 ? 'active' : ''">
          <a  class="menu-a" >
            <div class="menu-txt-hld">
              <i class="fas fa-envelope menu-icon"></i>
              <span class="menu-txt">Messages</span>
            </div>
          </a>
        </li>
        <li class="menu-item">
          <a  class="menu-a" >
            <div class="menu-txt-hld">
                <i class="fas fa-minus-circle menu-icon"></i>

              <span class="menu-txt">Delete account</span>
            </div>
          </a>
        </li>
        <li class="menu-item">
          <a class="menu-a" >
            <div class="menu-txt-hld">
               <i class="fas fa-sign-out-alt menu-icon menu-iconAux"></i>

              <span class="menu-txt text-danger">Logout</span>
            </div>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</div>
            </div>

            <div class="contentAccount profileInfoDiv2" v-if='accountListStep==1'>
                <div class="wrapper">
  <div class="profile-card js-profile-card">
    <div class="profile-card__img">

<div class="profile-pic">
  <label class="-label" for="file">
    <span class="glyphicon glyphicon-camera"></span>
    <span>Change avatar</span>
  </label>
  <input id="file" type="file" onchange="loadFile(event)"/>
  <img :src="'/uploads/avatars/'+user.image" id="output" width="200" />
</div>
    </div>

    <div class="profile-card__cnt js-profile-cnt">
      <div class="profile-card__name">{{ user.name.toUpperCase() }}</div>
      <div class="profile-card__txt"><strong>Admin</strong></div>
      <div class="profile-card__txt"><strong>{{ user.email }}</strong></div>

      <div class="profile-card-loc">
        <span class="profile-card-loc__icon">
          <svg class="icon"><use xlink:href="#icon-location"></use></svg>
        </span>

        <span class="profile-card-loc__txt">
          {{ user.city  }},  France
        </span>
      </div>

      <div class="profile-card-inf">
        <div class="profile-card-inf__item">
          <div class="profile-card-inf__title">1598</div>
          <div class="profile-card-inf__txt">Annonce</div>
        </div>

        <div class="profile-card-inf__item">
          <div class="profile-card-inf__title">65</div>
          <div class="profile-card-inf__txt">Orders</div>
        </div>

        <div class="profile-card-inf__item">
          <div class="profile-card-inf__title">123</div>
          <div class="profile-card-inf__txt">Likes</div>
        </div>

        <div class="profile-card-inf__item">
          <div class="profile-card-inf__title">85</div>
          <div class="profile-card-inf__txt">Followers</div>
        </div>


      </div>




    </div>



  </div>

</div>


            </div>



            <div class="contentAccount" v-if='accountListStep==2'>
password @ email
            </div>









        </div>

    </div>




  </div>











  <div class="modal fade" ref="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-body modal-bodyContainer  pt-2">
        <div class="container pt-4">
    <div :class="!headerMakeProfileState ? 'text-center' : ''">

  </div>
  <div class="form">

  <div class="fields fields">
    <label class="field">
      <span class="field__label" for="firstname">Full name</span>
      <input @change="inputChanged()" class="field__input" v-model="userShippingAddress.name" type="text" id="firstname" />
    </label>

     <label class="field">
      <span class="field__label" for="phone">Phone</span>
      <input @change="inputChanged()" class="field__input" v-model="userShippingAddress.phone" type="text" id="firstname" />

    </label>

  </div>
  <label class="field">
    <span class="field__label" for="address">Address</span>
    <input  @change="inputChanged()" class="field__input" v-model="userShippingAddress.address"  type="text" id="address" />

  </label>
  <label class="field">
    <span class="field__label" for="address">completement address</span>
    <input  @change="inputChanged()" class="field__input" v-model="userShippingAddress.addressComp"  type="text" id="addressComp" />
  </label>


  <label class="field">
    <span class="field__label" for="address">Bulding Code</span>
    <input  @change="inputChanged()" class="field__input" v-model="userShippingAddress.buldingCode"  type="text" id="addressComp" />
  </label>
  <label class="field">
    <span class="field__label"  for="country">Country</span>
    <select  @change="inputChanged()" class="field__input" v-model="userShippingAddress.country" id="country">
      <option value=""></option>
      <option value="unitedstates">United States</option>
    </select>

  </label>
  <div class="fields fields--2">
    <label class="field">
      <span class="field__label" for="zipcode">Zip code</span>
      <input  @change="inputChanged()" class="field__input" v-model="userShippingAddress.postalCode" type="text" id="zipcode" />

    </label>
    <label class="field">
      <span class="field__label" for="city">City</span>
      <input  @change="inputChanged()" class="field__input" v-model="userShippingAddress.city" type="text" id="city" />

    </label>

  </div>

  <p v-if="userShippingAddressErrors.phone" class="m-0 p-0  text-danger">
             <small> {{ userShippingAddressErrors.name }} </small>
            </p>
   <p v-if="userShippingAddressErrors.phone" class="m-0 p-0  text-danger">
             <small> {{ userShippingAddressErrors.phone }} </small>
            </p>
   <p  v-if="userShippingAddressErrors.address" class="m-0 p-0  text-danger">
             <small> {{ userShippingAddressErrors.address }} </small>
            </p>
             <p v-if="userShippingAddressErrors.country" class="m-0 p-0  text-danger">
             <small> {{ userShippingAddressErrors.country }} </small>
            </p>
             <p v-if="userShippingAddressErrors.postalCode" class="m-0 p-0  text-danger">
             <small> {{ userShippingAddressErrors.postalCode }} </small>
            </p>
             <p  v-if="userShippingAddressErrors.city" class="m-0 p-0  text-danger">
             <small> {{ userShippingAddressErrors.city }} </small>
            </p>
  </div>
</div>


      </div>
      <div class="modal-footer">
       <button class="btn btn-dark rounded-pill" data-bs-dismiss="modal" @click="getUserInfo()">Cancel</button>

  <button class=" btn btn-success rounded-pill" @click="addNewShippingAddressForUser()">Save</button>

      </div>
    </div>
  </div>
</div>
  </div>
</template>

<script>
import Swal from "sweetalert2";
import loadingPage from '../mainViews/products/loadPage.vue'

import ordersPage from '../mainViews/products/orders.vue'

export default {
     components: {
    loadingPage ,
    ordersPage
  },
  data() {
    return {
        accountListStep : 1 ,
            loading : true,
      errors: {},

      user: {
        id: "",
        token: "",
        name: "",
        image: "",
        phone: "",
        address: "",
        addressComp: " ",
        postalCode: "",
        buldingCode: "",
        user_id : '',
        country : ''

      },


      userShippingAddressErrors: {},

       userShippingAddress: {
        name: '',
        id: "",
        phone: "",
        address: "",
        addressComp: " ",
        postalCode: "",
        buldingCode: "",
        user_id : ''
      },

      updateLaterBtn: false,

      login: false,

      step: 4,


      creditCards : [],
      inputsChangedState : false,
      headerMakeProfileState : false ,



        creditCardsDashedNumber:[],


      userShippingAddresses : [],




      getProfileCountForStoping : 0,


    };
  },
  mounted() {
    if (localStorage.getItem("token").length == 0) {
      this.$router.push("/");
    }
        this.user.user_id = localStorage.getItem("user_id");
    this.user.id = localStorage.getItem("user_id");
    this.user.token = localStorage.getItem("token");
    this.user.name = localStorage.getItem("username");
    this.user.image = localStorage.getItem("img");
    this.user.email = localStorage.getItem("useremail");
    this.userShippingAddress.user_id = localStorage.getItem("user_id");

    if (localStorage.getItem("token").length > 0) {
      this.login = true;
    }
    this.todo();
    this.getCreditCardForUser();
    this.getUserShippingAddresses();


  },
  methods: {
      selectDefaultAddress(id , key){
          console.log(id)


            let config = {
        headers: {
          Authorization: `Bearer ${this.user.token}`,
        },
      };

        console.log(this.userShippingAddresses);
            if(this.headerMakeProfileState){
          this.userShippingAddress = {
        name: this.userShippingAddresses[key].name,
        id: this.userShippingAddresses[key].id,
        phone: this.userShippingAddresses[key].phone,
        address:this.userShippingAddresses[key].address,
        addressComp: this.userShippingAddresses[key].addressComp,
        postalCode: this.userShippingAddresses[key].postalCode,
        buldingCode: this.userShippingAddresses[key].buldingCode,
        user_id : this.userShippingAddresses[key].user_id,
          }



          Swal.fire({
  title: "Are you sure to select this address as default shipping address  ?",
    icon: "info",
    showCancelButton: true,
    cancelButtonText : 'No',
    cancelButtonColor : '#ee4646',
    confirmButtonColor: "#0370c8",
    confirmButtonText: "Yes" ,
    cancelButtonClass: " px-4 py-2 rounded-pill ",
    confirmButtonClass: " px-4 py-2 rounded-pill ",
   customClass: { popup: "swal2-border-radius" }


}).then(res => {
if(res.value) {
      axios.post('api/userShippingAddressesUpdate/' , this.userShippingAddress , config);
      this.getUserShippingAddresses();
}});

        console.log(this.userShippingAddress);
            }







             if(!this.headerMakeProfileState){
        //   this.userShippingAddress = {
        // name: this.userShippingAddresses[key].name,
        // id: this.userShippingAddresses[key].id,
        // phone: this.userShippingAddresses[key].phone,
        // address:this.userShippingAddresses[key].address,
        // addressComp: this.userShippingAddresses[key].addressComp,
        // postalCode: this.userShippingAddresses[key].postalCode,
        // buldingCode: this.userShippingAddresses[key].buldingCode,
        // user_id : this.userShippingAddresses[key].user_id,
        //   }

          Swal.fire({
  title: "Are you sure to select this address as  shipping address for this order ?",
    icon: "info",
    showCancelButton: true,
    cancelButtonText : 'No',
    cancelButtonColor : '#ee4646',
    confirmButtonColor: "#0370c8",
    confirmButtonText: "Yes" ,
    cancelButtonClass: " px-4 py-2 rounded-pill ",
    confirmButtonClass: " px-4 py-2 rounded-pill ",
   customClass: { popup: "swal2-border-radius" }


}).then(res => {
if(res.value) {
      localStorage.setItem('userAddress_id' , this.userShippingAddresses[key].id )

console.log(this.userShippingAddresses[key].id  , 'idddd')
}});

        console.log(this.userShippingAddress);
            }
      },

      userShippingAddressesDelete(id){
            let config = {
        headers: {
          Authorization: `Bearer ${this.user.token}`,
        },
      };

                 Swal.fire({
  title: "Are you sure to delete this address ?",
    icon: "warning",
    showCancelButton: true,
    cancelButtonText : 'No',
    cancelButtonColor : '#ee4646',
    confirmButtonColor: "#0370c8",
    confirmButtonText: "Yes" ,
    cancelButtonClass: " px-4 py-2 rounded-pill ",
    confirmButtonClass: " px-4 py-2 rounded-pill ",
         customClass: { popup: "swal2-border-radius" }


}).then(res => {
if(res.value) {
      axios.delete('api/userShippingAddressesDelete/'+id , config);
      this.getUserShippingAddresses();
}});
      },
      getUserShippingAddresses(){
          this.userShippingAddresses=[];
          this.loading=true;
           let config = {
        headers: {
          Authorization: `Bearer ${this.user.token}`,
        },
      };
        this.userShippingAddresses=[];
      axios.post('api/userShippingAddresses' , this.user , config)
      .then((response) => {
          if(response.data.userShippingAddresses.length>0){
                response.data.userShippingAddresses.forEach((element,key) => {
                    this.userShippingAddresses.push(element);
                    if(element.defaultAddress=='true'){
                        let aux = this.userShippingAddresses[key];
                        this.userShippingAddresses[key] = this.userShippingAddresses[0]
                        this.userShippingAddresses[0] = aux;
                    }
              });
              this.loading=false;
          }
      }).catch((err) => {

      });
      },

      addNewShippingAddressForUser(){

           let config = {
        headers: {
          Authorization: `Bearer ${this.user.token}`,
        },
      };

    axios.post('api/userShippingAddressesStore' , this.userShippingAddress , config )
    .then((reponse) => {
              console.log("gdsgdfgsdgfvvvvv" , reponse.data);


        if (reponse.data.status == "invalid") {
              if (reponse.data.errors.address)
                this.userShippingAddressErrors.address = reponse.data.errors.address[0];
              else this.userShippingAddressErrors.address = "";
              if (reponse.data.errors.city)
                this.userShippingAddressErrors.city = reponse.data.errors.city[0];
              else this.userShippingAddressErrors.city = "";
              if (reponse.data.errors.phone)
                this.userShippingAddressErrors.phone = reponse.data.errors.phone[0];
              else this.userShippingAddressErrors.phone = "";
              if (reponse.data.errors.postalCode)
                this.userShippingAddressErrors.postalCode = reponse.data.errors.postalCode[0];
              else this.userShippingAddressErrors.postalCode = "";

              if (reponse.data.errors.country)
                this.userShippingAddressErrors.country = reponse.data.errors.country[0];
              else this.userShippingAddressErrors.country = "";

              if (reponse.data.errors.name)
                this.userShippingAddressErrors.name = reponse.data.errors.name[0];
              else this.userShippingAddressErrors.name = "";

              console.log(this.userShippingAddressErrors.address);
            }else {
                this.getUserShippingAddresses();
                // userShippingAddresses.splice( reponse.data.userShippingAddressesRes.id , 1)

              this.userShippingAddressErrors = {

              };
              this.userShippingAddress = {
                  name: '',
        id: "",
        phone: "",
        address: "",
        addressComp: " ",
        postalCode: "",
        buldingCode: "",
        user_id : ''
              }
              Swal.fire({
                position: "bottom-end",
                icon: "success",
                title: "Shipping address has been added successfuly",
                showConfirmButton: false,
                timer: 1500,
              });
            }




    }).catch((err) => {

    });

      },


      todo: function () {
      this.intervalid1 = setInterval(
        function () {
            this.headerMakeProfileState=localStorage.getItem("headerMakeProfileState");

            if(this.step==1 && this.getProfileCountForStoping==0){
                this.getUserInfo();
                this.getProfileCountForStoping++
            }else if (this.step !=1){
                this.getProfileCountForStoping=0;
            }


            if (!this.headerMakeProfileState){
                this.step=2;
            }

        }.bind(this),
        200
      );
    },


      inputChanged(){
            this.inputsChangedState = true ;
            localStorage.setItem('inputsChangedState' , 'true')
            console.log('changeeeed')
      },
 logout() {

      axios.get('api/lastLogin' , this.user)
        .then((response) => {
                console.log(response)
                });

      localStorage.setItem("token", "");
      localStorage.setItem("username", "");
      localStorage.setItem("useremail", "");
      localStorage.setItem("img", "");
      localStorage.setItem("cartCount", 0);

      this.login = false;
      this.$router.go();
    },

      setCreditCardInfo(key){
          console.log(key)
      },


      getCreditCardForUser(){
        let config = {
        headers: {
          Authorization: `Bearer ${this.user.token}`,
        },
      };


      axios.post('api/getCreditCardUser' , this.user , config )
      .then((response) => {
          if(response.data.status=="found"){
              this.addNewCreditCard=false;


              response.data.creditCard.forEach(element => {
                  this.creditCards.push(element);
                  this.loading=false;
              });

              this.creditCards.forEach(element => {
                                     console.log(element , ' rtezrtzerrtt')

                this.creditCardsDashedNumber.push(element.cardNumber);
              });

                 this.creditCardsDashedNumber.forEach((element , key) => {
                     this.creditCardsDashedNumber[key] = element.replace(/\s+/g, '');
                     this.creditCardsDashedNumber[key] = this.creditCardsDashedNumber[key].replace(/.(?=.{4})/g, "*");
                     this.creditCardsDashedNumber[key] = this.creditCardsDashedNumber[key].replace(/(.{4})/g, '$1 ').trim();


                 });

                 console.log('ennnna' , this.creditCardsDashedNumber);


                }else {
            this.addNewCreditCard=true;
                              this.loading=false;

          }
      })

      },

    getUserInfo() {
      this.updateLaterBtn = false;

      let config = {
        headers: {
          Authorization: `Bearer ${this.user.token}`,
        },
      };
      axios
        .post("api/getProfile", this.user, config)
        .then((response) => {
          if (response.data.userInfoItem) {
            this.user = response.data.userInfoItem[0];
            this.user.name = response.data.userInfoItem[0].name;
          } else if(!response.data.userInfoItem && this.step==1 && this.headerMakeProfileState) {
            this.updateLaterBtn = true;
            Swal.fire({
              customClass: { popup: "swal2-border-radius" },
              icon: "warning",
              text: "Please you must update your profile informations !",
              confirmButtonColor: "#0370c8",
              confirmButtonText: "Got it !",
              confirmButtonClass: " px-4 py-2 rounded-pill ",
            });
          }
          this.user.id = localStorage.getItem("user_id");
          this.user.token = localStorage.getItem("token");
          this.user.image = localStorage.getItem("img");
                this.user.email = localStorage.getItem("useremail");
            this.inputsChangedState = false ;
                        localStorage.setItem('inputsChangedState' , '')

          //console.log(this.user);
        })
        .catch((err) => {});
    },
    updateProfile() {
      let config = {
        headers: {
          Authorization: `Bearer ${this.user.token}`,
        },
      };

      // console.log(this.user)

      Swal.fire({
        title: "Are you sure to update your profile ?",
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "No",
        cancelButtonColor: "#ee4646",
        confirmButtonColor: "#0370c8",
        confirmButtonText: "Yes",
        customClass: { popup: "swal2-border-radius" },
        cancelButtonClass: " px-4 py-2 rounded-pill ",
        confirmButtonClass: " px-4 py-2 rounded-pill ",
      }).then((response) => {
        if (response.value) {

          axios.post("api/profile", this.user, config).then((reponse) => {


            if (reponse.data.status == "invalid") {
              if (reponse.data.errors.address)
                this.errors.address = reponse.data.errors.address[0];
              else this.errors.address = "";
              if (reponse.data.errors.city)
                this.errors.city = reponse.data.errors.city[0];
              else this.errors.city = "";
              if (reponse.data.errors.phone)
                this.errors.phone = reponse.data.errors.phone[0];
              else this.errors.phone = "";
              if (reponse.data.errors.postalCode)
                this.errors.postalCode = reponse.data.errors.postalCode[0];
              else this.errors.postalCode = "";

              if (reponse.data.errors.country)
                this.errors.country = reponse.data.errors.country[0];
              else this.errors.country = "";

              console.log(this.errors.address);
            } else {
              this.updateLaterBtn = false;
              this.errors = {};
              Swal.fire({
                position: "bottom-end",
                icon: "success",
                title: "Profile has been updated successfuly",
                showConfirmButton: false,
                timer: 2000,
              });
            }
          });
        }
      });
    },

    routePush() {
      this.$router.push("/");
      // setTimeout(()=>{
      //     this.$router.go();
      // },2000)
    },
  },
};
</script>




