<template>
  <div class="main">

    <!-- <header v-if="login" class="wrapper createProductHeader p-4">
      <a
        class="addProductLink"
        id="addBtn"
        data-bs-toggle="modal"
        data-bs-target="#exampleModal"
      >
        <span class="m-2 text-white">Add new product</span>
        <svg
          xmlns="http://www.w3.org/2000/svg"
          width="16"
          height="16"
          fill="white"
          class="bi bi-bag-plus-fill"
          viewBox="0 0 16 16"
        >
          <path
            fill-rule="evenodd"
            d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zM8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5V8z"
          />
        </svg>
      </a>
    </header>
 -->




    <section class="">
              <cardProduct :key="cardProductRender"/>
    </section>

    <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add new product</h5>
          </div>
          <div class="modal-body">
            <div class="mb-2">
              <label for="title">Title</label>
              <input
                type="text"
                class="form-control"
                v-model="product.title"
                name="title"
                id="title"
                :class="hasError('title') ? 'is-invalid' : ''"
              />
            </div>



            <div class="mb-2">
              <label for="price">Price</label>
              <input
                type="number"
                step="0.01"
                placeholder="0.00"
                class="form-control"
                v-model="product.price"

                name="price"
                id="price"
                @keypress="onlyNumber"
                :class="hasError('price') ? 'is-invalid' : ''"
              />
            </div>



            <div class="globalGrid">
            <div class="selectGrid">
              <div><label for="quantity">Quantity</label></div>
              <div>
                <!-- <select
                  v-model="product.quantity"
                  name="quantity"
                  id="quantity"
                >
                  <option v-for="$i in 100" :value="$i" :key="$i">
                    {{ $i }}
                  </option>
                </select> -->


                  <div class="button-container">
                          <div class="input-group inline-group" style="justify-content: start;">

                              <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
                            <input

 v-model="product.quantity"
                              min="1"
                              class="form-control"
                              @keypress="onlyNumber"

                              type="number"
                              maxlength="6"


                              style="height: 76%; background: rgb(236, 236, 236) none repeat scroll 0% 0%; border-radius: 10%; border: medium none;width: 100%;text-align: center;"
                            />
                            </div>


                            <div>
                            <div class="input-group-append">
                              <button
                              @click="
                                  product.quantity++


                              "
                            style="padding: 0px 12px; height: 35px; background-color: rgba(0, 0, 0, 0); border: medium none;margin: 0;"
                                class=""
                              >
<i class="fas fa-chevron-circle-up menu-icon5"></i>                              </button>
                            </div>




                           <div class="input-group-prepend">
                              <button

                              @click="
                                    product.quantity == 1 ? '' : product.quantity--


                              "
                             style="padding: 0px 12px; height: 35px; background-color: rgba(0, 0, 0, 0); border: medium none;margin: 0;"
                                class="  "
                              >
<i class="fas fa-chevron-circle-down menu-icon5"></i>                              </button>
                            </div>
</div>

                          </div>


                        </div>
              </div>
            </div>

             <div class="selectGrid  ">
              <div><label for="category">Category</label></div>
              <div class="select">
                <select
                v-model="product.category"
                name="category"
                id="category"
                >
                  <option style="display: none" selected disabled value="0">
                    ......
                  </option>
                  <option value="smartphones">Smartphones</option>
                <option value="laptops">Laptops</option>
                  <option value="desktops">Desktops</option>
                  <option value="tablets ">Tablets </option>
                  <option value="monitors">Monitors</option>
                  <option value="printers & scanners ">Printers & Scanners </option>
                  <option value="cameras">Cameras</option>
                  <option value="smartphone accessories">Smartphone Accessories </option>
                  <option value="computer accessories">Computer Accessories</option>

                </select>
              </div>
              </div>



            </div>



             <div class="mb-2">
              <label for="images">Images</label>
              <input
                :key="imagesInputRender"
                type="file"
                @change="onChange"
                class="form-control"
                multiple
                name="images"
                id="image"
                ref="image"
                accept="image/png, image/gif,image/webp, image/jpeg "
              />
            </div>

            <div v-if="urls" class="gridImagesPreview mb-3">
              <img v-for="url in urls" :key="url" :src="url" alt="" />
            </div>


            <div class="my-4">
              <label for="price">Description</label>
              <textarea
                class="form-control"
                v-model="product.description"
                name="description"
                id="description"
                :class="hasError('description') ? 'is-invalid' : ''"
              >
              </textarea>
            </div>


             <div class="errorsModalAddProductForm" v-if="errors">
              <p  v-if="errors.title" class="text-danger mx-2">{{ errors.title }}</p>
              <p v-if="errors.price" class="text-danger mx-2">{{ errors.price }}</p>
              <p  v-if="errors.category" class="text-danger mx-2">{{ errors.category }}</p>
              <p v-if="errors.description" class="text-danger mx-2">{{ errors.description }}</p>
            </div>

            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
              >
                Close
              </button>

              <button
                type="button"
                class="btn btn-primary"
                @click="addProduct()"
              >
                Add product
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import cardProduct from './productCard.vue'
import Swal from 'sweetalert2'
import loadingPage from './loadPage.vue'

export default {
    components:{
cardProduct ,loadingPage
    },
  data() {
    return {
      urls: [],
      idProduct: "",

      products: [],

      images: [],
      form: new FormData(),

      product: {
        title: "",
        description: "",
        price: "",
        // image: "",
        user_id: "",
        quantity: 1,
        category : '0',
      },

      errors: {
        title: "",
        description: "",
        price: "",
        // image: "",
        quantity: "",
      },

      token: "",

      updateState: false,
      updateImageState: false,

      login: false,

      cardProductRender : 0 ,
      imagesInputRender:0,


      searchQuery: null,

      loading : true,

    };
  },
  mounted() {

    this.getProducts();
    this.loginState();
  },




  methods: {
      onlyNumber ($event) {

          if(String(this.product.price).length>7){
                    $event.preventDefault();

          }

      console.log($event.keyCode); //keyCodes value
         let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
         if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) { // 46 is dot
      $event.preventDefault();
         }
      },
    loginState: function () {
      this.intervalid1 = setInterval(
        function () {
          this.token = localStorage.getItem("token");
          this.user = localStorage.getItem("user");
          this.email = localStorage.getItem("useremail");
          this.image = localStorage.getItem("img");

          if (this.token != "") {
            this.login = true;
          } else {
            this.login = false;
          }
        }.bind(this),
        200
      );
    },

    onChangeQuantity(event) {
      this.product.quantity = event.target.value;
    },

    onChange(e) {
      this.images = [];
      this.urls = [];

      let file = e.target.files;

      if (!file.length) {
        return false;
      } else {
        for (let i = 0; i < file.length; i++) {
          this.images.push(file[i]);
          this.urls.push(URL.createObjectURL(file[i]));
        }

}

    },

    deletePost(id) {
      if (confirm("Are you sure to delete this product ? ")) {
        axios
          .delete("api/products/" + id)
          .then((response) => {

this.getProducts();
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },

    getProducts() {
      axios
        .get("/api/products")
        .then((response) => {
          this.products = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    addProduct() {


      this.product.user_id = localStorage.getItem("user_id");
      this.token = localStorage.getItem("token");
        console.log(this.product);
      let config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };

      axios
        .post("api/products ", this.product, config)
        .then((response) => {
          this.idProduct = response.data.idProductValue.id;

Swal.fire({
  position: 'bottom-end',
  icon: 'success',
  title: 'Your annonce has been saved',
  showConfirmButton: false,
  timer: 2000,
       customClass: { popup: "swal2-border-radius" }

})
          this.addImages();
          this.getProducts();
           this.cardProductRender=0;
          this.imagesInputRender=0;
          this.cardProductRender++;
          this.imagesInputRender++;

            this.urls=[];
            this.product = {
            title: "",
            description: "",
            price: "",
            category: "0",
            quantity: 1,
          };

          this.errors = {
            title: "",
            description: "",
            price: "",
            quantity: 1,

          };


          this.$refs.images.value = null;

            this.$router.go();

        })
        .catch((error) => {
          if (error.response) {
            if (error.response.data.errors) {
              if (error.response.data.errors.title) {
                this.errors.title = error.response.data.errors.title[0] ?? "";
              } else {
                this.errors.title = "";
              }

              if (error.response.data.errors.description) {
                this.errors.description =
                  error.response.data.errors.description[0] ?? "";
              } else {
                this.errors.description = "";
              }

              if (error.response.data.errors.price) {
                this.errors.price = error.response.data.errors.price[0] ?? "";
              } else {
                this.errors.price = "";
              }


                if (error.response.data.errors.category) {
                this.errors.category = error.response.data.errors.category[0] ?? "";
              } else {
                this.errors.category = "";
              }

            }
            //console.log(this.errors);
          } //  console.log("error");
        });
    },

    addImages() {
      for (let i = 0; i < this.images.length; i++) {
        this.form.append("images[]", this.images[i]);
      }

      this.form.append("productName", this.product.title);
      this.form.append("idProduct", this.idProduct);
      let config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
          "content-type": "multipart/form-data",
        },
      };

      // this.idProduct = localStorage.getItem("idProduct");
      //this.form.append("idProduct", this.product.id);

      //console.log("images array : ", element);

      this.token = localStorage.getItem("token");

      axios
        .post("api/uploadProductImages", this.form, config)
        .then((response) => {
          this.images = [];
          //this.getImages();
          //  console.log(response);
          this.$refs.images.value = null;
          this.getProducts();
        })
        .catch((error) => {
          if (error.response) {
            if (error.response.data.errors) {
            }
            //console.log(this.errors);
          } //  console.log("error");
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
