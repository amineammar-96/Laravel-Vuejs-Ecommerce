<template>
  <div class="container">
    <div class="row justify-content-center my-5">
      <div class="col-md-6 my-5">
        <div class="card">
          <div class="card-header text-center">Register to a new account</div>
          <div class="card-body">
            <div class="emailDiv mb-3">
              <label for="name"> Full-name </label>
              <input
                class="form-control mt-2"
                type="text"
                v-model="user.name"
                name="name"
                id="name"
                :class="hasError('name') ? 'is-invalid' : ''"
              />
              <div
                v-show="errors && errors.name"
                class="alert alert-transparent text-danger p-0 my-1"
              >
                {{ errors.name }}
              </div>
            </div>

            <div class="form-group mb-3">
              <label for="image">Profile image</label>
              <input
                :class="hasError('image') ? 'is-invalid' : ''"
                class="form-control custom-file-input"
                type="file"
                name="image"
                ref="image"
                id="image"
                    v-on:change="onChange"
              />
            </div>

            <div class="emailDiv mb-3">
              <label for="email"> E-mail </label>
              <input
                class="form-control mt-2"
                type="text"
                v-model="user.email"
                name="email"
                id="email"
                :class="hasError('email') ? 'is-invalid' : ''"
              />
              <div
                v-show="errors && errors.email"
                class="alert alert-transparent  text-danger p-0 my-1"
              >
                {{ errors.email }}
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="passwordDiv mb-3">
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
                <div class="passwordDiv mb-3">
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
            <div v-show="errors && errors.password" class="col-12">
              <div class="alert alert-transparent  text-danger p-0 my-1">
                {{ errors.password }}
              </div>
            </div>

            <div class="btnDiv">
              <button @click="register()" class="form-control btn btn-primary">
                Register
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Swal from 'sweetalert2'

export default {
  data() {
    return {
      user: {
        name: "",
        email: "",
        password: "",
        image : "",
        token : "",
      },
      errors: {
        name: "",
        email: "",
        password: "",
        image: "",
      },
    };
  },
  mounted() {

      if(localStorage.getItem('token').length > 0){
        this.$router.push("/")
    }
  },
  methods: {

      onChange(e) {
      this.user.image = e.target.files[0].name;
      console.log(this.user.image);

      let reader = new FileReader();
      let file = e.target.files[0];

      if (file["size"] < 2111775) {
        reader.onloadend = (file) => {
          console.log("RESULT", reader.result);
          this.user.image = reader.result;
        };
        reader.readAsDataURL(file);
        console.log("gdfgfdg : ", reader.readAsDataURL(file));
      } else {
        alert("File size can not be bigger than 2 MB");
      }
      }
      ,
    register() {
        console.log(this.user);
      axios
        .post("api/register", this.user)
        .then((response) => {
          if (response.data.status == "invalid") {
            // this.errors=response.data.errors
            // this.errors = response.data.errors
            //console.log(response.data.errors)
            // this.$router.push({ path: "/" });
            this.errors.name = "";
            this.errors.email = "";

            this.errors.password = "";
            this.errors.image = "";
            console.log("invalid");
          } else {
            console.log("valideeeeee");
            this.errors.name = "";
            this.errors.email = "";
            this.errors.password = "";
            this.errors.image = "";


let that = this ;
Swal.fire({
  title: 'Your account has been created succuessfuly',
  text: "Please activate your account will receive an email shortly",
  icon: 'info',
    confirmButtonColor: "#0370c8",
  confirmButtonText: 'Got it'
}).then((result) => {
  if (result.isConfirmed) {
that.$router.push('/login');

  }
})


//lazemni nkamal mtaa3 profile image w edit w delete mta3 produit
//lazem zeda naamel lazem ken elli connecte khw yenajem yefasakh w yechouf w yebadel fil produitt mta3ou w lazem na3mel admin yenajam ya3malhom lkool


            // this.$router.push({path: '/'})
            console.log("222222222");

            this.login();
            console.log("3333333333");
          }
        })
        .catch((error) => {
            if(error.response){
          if (error.response.data.errors) {
            if (error.response.data.errors.name) {
              this.errors.name = error.response.data.errors.name[0] ?? "";
            } else {
              this.errors.name = "";
            }
            if (error.response.data.errors.email) {

              this.errors.email = error.response.data.errors.email[1] ? error.response.data.errors.email[1] : error.response.data.errors.email[0];
            } else {
              this.errors.email = "";
            }

            if (error.response.data.errors.password) {
              this.errors.password =
                error.response.data.errors.password[0] ?? "";
            } else {
              this.errors.password = "";
            }

            if (error.response.data.errors.image) {
              this.errors.image = error.response.data.errors.image[0] ?? "";
            } else {
              this.errors.image = "";
            }
          }else{
              this.errors.email = "Used address mail , please try another one"
          }
            }
          //   this.errors.name = error.response.data.errors.name[0] ?? "";
          //   this.errors.email = error.response.data.errors.email[0] ?? "";
          //   this.errors.password = error.response.data.errors.password[0] ?? "";
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
