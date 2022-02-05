<template>
  <div class="container">
    <div class="row justify-content-center my-5">
      <div class="col-md-6 col-xs-10 my-5">
        <div class="card">
          <div class="card-header text-center">Reset your password</div>

          <div class="card-body">
            <div class="emailDiv mb-1">
              <label for=""> E-mail </label>
              <input
                class="form-control mt-2"
                type="text"
                v-model="user.email"
                name="email"
                id=""
              />
            </div>

                <div v-if="error"  class=" h-25 alert alert-transparent p-0 pt-1 text-danger">
                    <span v-if="error!='Email address not found' && error!='The email must be a valid email address.'">*</span> <span>{{error}}</span>

                    <span v-if="error=='Email address not found'"> , Please verify your email</span>
                </div>



            <div class="btnDiv" :class="!error ? 'mt-3' : ''">
              <button @click="submitResetPassword" class="form-control btn btn-primary">
                Send
              </button>
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
      },
      error: "",
    };
  },
  mounted() {
    if (localStorage.getItem("token").length > 0) {
      this.$router.push("/");
    }
  },
  methods: {
    submitResetPassword() {
      axios
        .post("api/forgotPasswordEmailStatus", this.user)
        .then((response) => {
          if (response.data.message == "success") {
           console.log(response.data.message);
            this.error = "";
            localStorage.setItem('resetPasswordEmail' , this.user.email)
            localStorage.setItem('passwordChangedSuccessMessage' , false)
             this.$router.push('/resetMailSended');

          } else if (response.data.message == 'invalid') {
            console.log(response.data.error.email);
            if(response.data.error.email[1]){
                 this.error = response.data.error.email[1];
            }else{
                this.error = response.data.error.email[0];

            }
          }
          else if (response.data.message == 'Email address not found') {
            console.log(response.data.message);
            this.error = response.data.message;
          }
        })
    },


  },
};
</script>
