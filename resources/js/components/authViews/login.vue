<template>
  <div class="container">
    <div class="row justify-content-center my-5">
      <div class="col-md-6 col-xs-10 my-5">
        <div class="card">
          <div class="card-header text-center">Login to your account</div>

          <div class="card-body pb-0">
            <div class="emailDiv mb-3">
              <label for=""> E-mail </label>
              <input
                class="form-control mt-2"
                type="text"
                v-model="user.email"
                name="email"
                id=""
              />
            </div>

              <div v-if="errors.email != ''" class="alert alert-transparent p-0 m-0  text-danger">
              {{ errors.email }}
            </div>

            <div class="passwordDiv mb-3">
              <label for="">Password </label>
              <input
                class="form-control mt-2"
                type="password"
                v-model="user.password"
                name="password"
                id=""
              />
            </div>

              <div v-if="errors.password != ''" class="alert alert-transparent p-0 m-0  text-danger">
              {{ errors.password }}
            </div>

             <div v-if="error != ''" class="alert alert-transparent p-0 m-0 py-2 text-danger">
              Please verify your username and password
            </div>



            <div class="loginGrid" style="display: flex;justify-content: space-between;">
            <div class="togglePlusForgotGrid my-2 mb-4">
                <div>
              <label class="mr-5">Remember me</label
              ><Toggle  class="px-4" v-model="toggleBtnValue" @click="slider.status = !slider.status  && toggleChange()"  />
            </div>
            <div class='my-2'>
                <router-link to='forgotPassword'>Forgot password ? </router-link>
            </div>
            </div>



            <div class="btnDiv">
              <button @click="login()" class="form-control loginBtn rounded-pill btn btn-primary">
                Login
              </button>
            </div>
            </div>



          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Toggle from "@vueform/toggle";

export default {
  components: {
    Toggle,
  },
  data() {
    return {


 slider: {
     id : 1 ,
      status: false
    },

      toggleBtnValue: false,
      user: {
        id: "",
        token: "",
        email: "",
        password: "",
      },
      errors: {
          email : '' ,
          password : ''
      },

      error : ''
    };
  },
  mounted() {
    if (localStorage.getItem("token").length > 0) {
      this.$router.push("/");
    }
  },
  methods: {
    login() {
      axios
        .post("api/login", this.user)
        .then((response) => {
          if (response.data.status == "success") {
            this.errors.password=""
            this.errors.email=""
            localStorage.setItem("token", response.data.token);
            console.log(response.data.token);
            localStorage.setItem("username", response.data.user[0].name);
            localStorage.setItem("useremail", response.data.user[0].email);
            localStorage.setItem("user_id", response.data.user[0].id);
            localStorage.setItem("img", response.data.user[0].image);
            localStorage.setItem("id", response.data.user[0].id);
            localStorage.setItem("emailStatus", response.data.user[0].email_verified_at);
            localStorage.setItem("role", response.data.user[0].role);


            this.error = "";
            this.$router.go();
            this.getUserInfo();
          }
            else if (response.data.status=="invalid"){
                if(response.data.errors.email){
            if(response.data.errors.email[1]){
                this.errors.email=response.data.errors.email[1];
            }else {
                this.errors.email=response.data.errors.email[0];
            }
                }else {
                this.errors.email="";
            }
            if(response.data.errors.password){
            if(response.data.errors.password[0]){
                this.errors.password=response.data.errors.password[0];
            }
            }else {
                this.errors.password="";
            }

          }

          else {
            // this.error=response.data.status
            this.error = response.data.status;
          }
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    getUserInfo() {
      this.user.token = localStorage.getItem("token");
      this.user.id = localStorage.getItem("id");

      let config = {
        headers: {
          Authorization: `Bearer ${this.user.token}`,
        },
      };
      axios
        .post("api/getProfile", this.user, config)
        .then((response) => {
          if (response.data.status == "found") {
            this.$router.push({ path: "/" });
          }
          else {
            this.$router.push({ path: "/profile" });
          }
        })
        .catch((err) => {});
    },

    toggleChange(){
        console.log(this.toggleBtnValue);
      }
  },
};
</script>
<style src="@vueform/toggle/themes/default.css"></style>
