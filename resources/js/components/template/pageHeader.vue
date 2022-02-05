<template>
  <div class="main m-0 p-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
      <div class="container px-4 px-lg-4">
        <a class="navbar-brand"> <router-link class="text-warning" to="/"><img src="icons/logo.png" alt=""></router-link></a>
        <button
          class="navbar-toggler bg-light"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul  class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
            <li class="nav-item">
              <a class="nav-link active"  aria-current="page">
                <router-link to="/" class="text-white"> Home </router-link></a
              >
            </li>

            <li class="nav-item">
              <a class="nav-link active" aria-current="page">
                <router-link  class="text-white" to="/products" > Products </router-link></a
              >
            </li>



            <li v-show="!login" class="nav-item">
              <a class="nav-link active" aria-current="page">
                <router-link  class="text-white" v-if="!login" to="/login"> Login</router-link></a
              >
            </li>

            <li v-show="!login" class="nav-item">
              <a class="nav-link active" aria-current="page">
                <router-link  class="text-white" to="/register"> Register</router-link></a
              >
            </li>

            <li v-show="login " class="nav-item">
              <a class="nav-link active" aria-current="page">
                <router-link  class="text-white" to="/dashboard"> Dashboard </router-link></a
              >
            </li>

            <li v-if="login" class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle text-white"
                id="navbarDropdown"
                href="#"
                role="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                >Account</a
              >
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="margin-top: 16px;border-radius: 0px 0px 14px 14px;width: 279px;">


                <li v-if="login">
                  <a class="dropdown-item bg-transparent" style="padding: 7px;">
                    <div v-show="login" class="emailD text-white">
                      {{ email }}
                    </div>
                  </a>
                </li>

                <li v-if="login">
                  <a class="dropdown-item bg-transparent">
                    <div :style="email_verified_at=='Activited' ? '' : 'cursor:pointer;'" @click="email_verified_at!='Activited' ? emailVerification() : ''" :class="email_verified_at=='Activited' ? 'text-success' : 'text-danger'">

                     <span v-if="email_verified_at!='Activited'"><i class="fas fa-exclamation-circle"></i></span> {{ email_verified_at }}
                    </div>
                  </a>
                </li>

                <li v-if="login"><hr class="dropdown-divider " /></li>

                <li>
                  <a @click="headerMakeProfileStateReset()" class="dropdown-item bg-transparent"
                    ><router-link to="/profile" class="text-white">


                        <span class="mr-3" style=" font-size: 1em; margin-right: 8px; color: white;">
<i class="fas fa-user-alt"></i></span>

                    Profile </router-link></a
                  >
                </li>

                <li>
                  <a class="dropdown-item bg-transparent" v-if="login" @click="logout()" style="display: flex;flex-direction: row;justify-content: flex-start;align-items: center;">
                      <span class="mr-3" style=" font-size: 1em; margin-right: 8px; color: rgb(228, 83, 83);">
    <i class="fas fa-sign-out-alt "></i>
</span>


                    <router-link class="text-danger" to="">
                      Logout
                    </router-link>
                  </a>
                </li>
              </ul>
            </li>
          </ul>


<router-link @click="setStepValueCart(1)" to="/cart" v-if="login" >
            <button class="btn btn-outline-light text-white bg-transparent" type="submit">
              <i class=""> <img style="width: 20px;margin-top: -3px;" src="/icons/cart.png" alt=""> </i>

              <span class="badge bg-dark text-white ms-1 rounded-pill">{{ countCart }}</span>
            </button>

</router-link>


        </div>
      </div>
    </nav>







  </div>
</template>

<script>
export default {
  data() {
    return {

        connected_user:{
            user_id : ''
            ,email: "",
            role :"",
        },
      user: "",
      email: "",
      token: "",
      image: "",
      login: false,


     countCart : 0 ,

    //  get countCart() {
    //     return localStorage.getItem('countCart') || 0;
    //   },
    //   set countCart(value) {
    //     localStorage.setItem('countCart', value);
    //   },


      email_verified_at : '',
    };
  },









  mounted() {


      localStorage.setItem("newItemCartWasAdded" , '');
           this.connected_user.email = localStorage.getItem("useremail");
    this.token=localStorage.getItem('token');
if(this.token.length>0){
      axios.post('api/showUser' , this.connected_user).then((response) => {
    this.email_verified_at= response.data.user[0].email_verified_at ? 'Activited' : 'Please verifiy your email';
        console.log('haha , ' , response.data.user[0].role )
        this.connected_user.role = response.data.user[0].role ;
        console.log('thiiiis ' , this.connected_user.role)
        this.connected_user.id = response.data.user[0].id;
      })
}

    this.todo();

    if (localStorage.getItem("token").length > 0) {
    this.getCartItem();
    }
  },
  methods: {
      headerMakeProfileStateReset(){
          localStorage.setItem('headerMakeProfileState' , 'true')
              localStorage.setItem('paymentStep' , 1);

      },
      setStepValueCart(x){
          localStorage.setItem('paymentStep' , 1 );
      },


    todo: function () {
      this.intervalid1 = setInterval(
        function () {
          this.token = localStorage.getItem("token");
          this.user = localStorage.getItem("user");
          this.email = localStorage.getItem("useremail");
          this.connected_user.email = localStorage.getItem("useremail");
          this.image = localStorage.getItem("img");
          this.countCart = localStorage.getItem("countCart");
          this.connected_user.id = localStorage.getItem("useremail");


          if (this.token != "") {
            this.login = true;
          } else {
            this.login = false;
          }
          //   console.log(this.token);
        }.bind(this),
        200
      );
    },



    logout() {

         axios.get('api/lastLogin' , this.connected_user)
        .then((response) => {
                console.log(response);
        }).catch((err) => {

        });

      localStorage.setItem("token", "");
      localStorage.setItem("username", "");
      localStorage.setItem("useremail", "");
      localStorage.setItem("img", "");
      localStorage.setItem("countCart", 0);
      localStorage.setItem("user_id", "");
      localStorage.setItem("role", "");




      this.login = false;
      this.$router.go();
    },



    getCartItem() {

      this.connected_user.user_id = localStorage.getItem("user_id");
      this.token = localStorage.getItem("token");

      let config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
      axios.post('api/getCart' , this.connected_user , config )
        .then(response => {
            if(response.data.status=='success'){
            let cartItemCountIconValue = response.data.cartItems.length;
            localStorage.setItem('countCart' , parseInt(cartItemCountIconValue));
            }






        })
        .catch((err) => {});
    },




    emailVerification(){
        this.token = localStorage.getItem("token");

      let config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };
        axios.post('api/sendEmailVerificationMail' , this.connected_user ,config).then((response) => {
            setTimeout(()=>{
                this.$router.push('/');

            },5000)
        }).catch((err) => {

        });
        this.$router.push('/emailVerificationRequest');
    },
  },
};
</script>




