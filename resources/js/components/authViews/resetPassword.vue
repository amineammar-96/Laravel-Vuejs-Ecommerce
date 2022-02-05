<template>
  <div class="container">
    <div class="row justify-content-center my-5">
      <div class="col-md-6 my-5">
        <div class="card">
          <div class="card-header text-center">Reset your password</div>
          <div class="card-body">
            <div class="emailDiv mb-3">


            <div class="row">
              <div class="col-6">
                <div class="passwordDiv mb-1">
                  <label for="password">Password </label>
                  <input
                    class="form-control mt-2"
                    type="password"
                    v-model="user.password"
                    name="password"
                    id="password"
                    :class="hasError('password') ? 'is-invalid' : ''"
                  />
                </div>
              </div>
              <div class="col-6">
                <div class="passwordDiv mb-1">
                  <label for="password_confirmation">Confirm password </label>
                  <input
                    class="form-control mt-2"
                    type="password"
                    v-model="user.password_confirmation"
                    name="password"
                    id="password_confirmation"
                    :class="hasError('password') ? 'is-invalid' : ''"
                  />
                </div>
              </div>
            </div>
            <div v-show="errors.password" :class="errors.password ? '' : 'mt-3'" class="col-12">
              <div class="alert text-danger p-0 my-1 alert-transparent">
               <span v-if="errors.password=='The password field is required.'">*</span> {{ errors.password }}
              </div>
            </div>

            <div class="btnDiv">
              <button @click="UpdatePassword()" class="form-control btn btn-primary">
                Update password
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
export default {
  data() {
    return {
      user: {
        email: "",
        password: "",
        token : 'xx'
      },
      errors: {
        password: "",
      },
    };
  },
  mounted() {
      this.user.email=this.$route.query.email;
      this.user.token=this.$route.query.token;

      axios.post('api/verifyResetToken' , this.user).then((response) => {
        //   if(response.data.status=='not found'){
        //       this.$router.push('/');
        //   }else if (response.data.status== 'found'){

        //   }
      });

      if(localStorage.getItem('token').length > 0){
        this.$router.push("/")
        }

    this.user.email=localStorage.getItem('resetPasswordEmail');
  },
  methods: {


    UpdatePassword(){
        axios.post('api/resetPassword' , this.user ).then((response) => {
            console.log(response);
            if(response.data.message =='invalid'){
                this.errors.password = response.data.error.password[0];
                console.log('this : ' , response.data.error.password)
            }else {
            this.errors.password = "";
            localStorage.setItem('passwordChangedSuccessMessage' , true)
            this.$router.push('/resetMailSended');

            }
        }).catch((err) => {

        });
      },

    hasError(item) {
      // console.log(this.errors[item]);
      if (this.errors[item] != "") {
        return true;
      } else {
        return false;
      }
    },


  },
};
</script>
