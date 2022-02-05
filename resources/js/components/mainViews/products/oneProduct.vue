<template>
  <div>
    <div class="loaderDiv" v-if="loading">
      <loadingPage />
    </div>

    <div v-if="!loading">
        <div
            v-if="
              (login && product.user_id == connected_user.id) ||
              connected_user.role == 'admin'
            "
            class="btnsDiv floatsbtnsOneProdduct  text-center w-100"
          >
            <!-- <button
              class="editBtn"
              data-bs-toggle="modal"
              data-bs-target="#exampleModal"
            >
              Edit annonce
            </button>
            <button class="deleteBtn" @click="deleteProduct(product.id)">
              Delete annonce
            </button> -->
<!--
            <div class="fab-wrapper">
  <input id="fabCheckbox" type="checkbox" class="fab-checkbox" />
  <label class="fab" for="fabCheckbox">
    <span class="fab-dots fab-dots-1"></span>
    <span class="fab-dots fab-dots-2"></span>
    <span class="fab-dots fab-dots-3"></span>
  </label>
  <div class="fab-wheel">

        <a class="fab-action fab-action-2">
      <i class="fas fa-address-book"></i>
    </a>
        <a class="fab-action fab-action-3">
      <i class="fas fa-info"></i>
    </a>
  </div>
</div> -->
          </div>
      <div class="containerAux">
        <div class="box">
          <div class="gridDev">
            <div class="product-img">
              <span v-if="product.product_images">
                <!-- <img
                  v-if="product.product_images[0]"
                  :src="'/uploads/' + product.product_images[0].path"
                  alt=""
                /> -->
                <div v-if="product.product_images.length>0">

            <Carousel :class=" product.product_images.length==1? 'carouselHideArrows' :'' " class="carouselImagesPreview">
    <Slide v-for="slide in product.product_images" :key="slide">
      <div class="carousel__item">
          <img :src="'uploads/'+slide.path" alt="">
      </div>
    </Slide>

    <template #addons>
      <Navigation />
    </template>
  </Carousel>
                </div>
                <img
                  v-if="product.product_images.length==0"
                  src="/uploads/products/123.webp"
                  alt=""
                />
              </span>
            </div>
            <div class="product-info">
              <h1 style="word-break: break-word">{{ product.title }}</h1>
              <p class="price" style="padding-bottom: 0px">
                ${{ product.price }}
              </p>
              <p class="description">{{ product.description }}</p>

              <div class="productInfoGridCart">
                <div class="selectGrid">
                  <div><span class="quantitySpan">Quantity</span></div>
                  <div>
                      <div class="button-container">
                          <div class="input-group inline-group ">

                              <div style="display: flex;flex-direction: column;justify-content: center;align-items: center;">
                            <input
                              v-model="selecCartQuantity"
                              :max="product.quantity"

                              :min="1"
                              class="form-control"
                              @keypress="onlyNumber"
                              @input="updateValue($event, key)"
                              type="number"


                              style="height: 76%; background: rgb(236, 236, 236) none repeat scroll 0% 0%; border-radius: 10%; border: medium none;width: 50px;text-align: center;"
                            />
                            </div>


                            <div>
                            <div class="input-group-append">
                              <button
                              @click="
                                  selecCartQuantity >= product.quantity ? '' : selecCartQuantity++


                              "
                            style="padding: 0px 12px; height: 35px; background-color: rgba(0, 0, 0, 0); border: medium none;margin: 0;"
                                class=""
                              >
<i class="fas fa-chevron-circle-up menu-icon5"></i>                              </button>
                            </div>




                           <div class="input-group-prepend">
                              <button

                              @click="
                                    selecCartQuantity == 1 ? '' : selecCartQuantity--


                              "
                             style="padding: 0px 12px; height: 35px; background-color: rgba(0, 0, 0, 0); border: medium none;margin: 0;"
                                class="  "
                              >
<i class="fas fa-chevron-circle-down menu-icon5"></i>                              </button>
                            </div>
</div>

                          </div>


                        </div>
                    <!-- <select class="qty" v-model="selecCartQuantity" name="qSelect" id="qSelect">
                  <option v-for="$i in product.quantity" :key="$i" :value="$i">
                    {{ $i }}
                  </option>
                </select> -->


                  </div>
                </div>

                <div><button @click="addToCart">ADD TO CART</button></div>

              </div>

              <div class="ratingAverageDiv">
                <rating-stars
                  style="margin: 0px"
                  :key="averageRatingRender"
                  :config="configAverageRating"
                  v-if="configAverageRating.rating"
                ></rating-stars>
                <span>{{ configAverageRating.rating ? '(': ''  }}{{ configAverageRating.rating }}{{configAverageRating.rating ? ')': ''  }}</span>
              </div>




<div class='likeAndDislikeBtns'>


  <button class="btn btn-transparent" id="green"><i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i></button>
  <button class="btn btn-transparent" id="red"><i class="fa fa-thumbs-down fa-lg" aria-hidden="true"></i></button>
  </div>
            </div>
          </div>

          <div class="imagesPreview w-100 ">


            <span
              v-for="(image, imageIndex) in product.product_images"
              :key="imageIndex"
            >
              <a id="imgDivOneProduct">
                <a
                  data-bs-toggle="modal"
                  data-bs-target="#imageModal"
                  @click="selectImageForModal(image.path)"
                  style="cursor: zoom-in"
                >
                  <img :src="'/uploads/' + image.path" class="imgs mx-3 my-2" />
                </a>
                <span
                  v-if="
                    (login && product.user_id == connected_user.id) ||
                    connected_user.role == 'admin'
                  "
                  @click="deleteImage(image.id)"
                  class="closeIcon"
                >
               <i class="fas fa-trash"></i>
                  <!-- <img class="deleteIcon" src="/icons/closeIcon1.png" alt="" /> -->
                </span>
              </a>
            </span>

            <a
              data-bs-toggle="modal"
              class="addBtnA"
              data-bs-target="#addImageModal"
              v-if="
                (login && product.user_id == connected_user.id) ||
                connected_user.role == 'admin'
              "
            >
              <img class="addIcon" src="/icons/addIcon.png" alt="" />
            </a>

          </div>
          <div
            v-if="
              (login && product.user_id == connected_user.id) ||
              connected_user.role == 'admin'
            "
            class="btnsDiv floatsbtnsOneProd my-3 text-center w-100"
          >
            <button
              class="editBtn"
              data-bs-toggle="modal"
              data-bs-target="#exampleModal"
            >
              Edit annonce
            </button>
            <button class="deleteBtn" @click="deleteProduct(product.id)">
              Delete annonce
            </button>

            <!-- <div class="fab-wrapper">
  <input id="fabCheckbox" type="checkbox" class="fab-checkbox" />
  <label class="fab" for="fabCheckbox">
    <span class="fab-dots fab-dots-1"></span>
    <span class="fab-dots fab-dots-2"></span>
    <span class="fab-dots fab-dots-3"></span>
  </label>
  <div class="fab-wheel">
    <a class="fab-action fab-action-1">
      <i class="fas fa-question"></i>
    </a>
    <a class="fab-action fab-action-2">
      <i class="fas fa-book"></i>
    </a>
        <a class="fab-action fab-action-3">
      <i class="fas fa-address-book"></i>
    </a>
        <a class="fab-action fab-action-4">
      <i class="fas fa-info"></i>
    </a>
  </div>
</div> -->
          </div>
        </div>
      </div>

      <div class="commentDivHeader">
        <h5>{{ commentsCount }} Comment(s)</h5>
      </div>

      <div class="commentsDivOneProduct">
      <div class="oneProductSliderProductsDiv p-5" >
   <h3>Random Annonces : </h3>
   <Carousel class="carouselParent">
    <Slide  v-for="(random,key) in randomProducts" :key="key">
     <!-- <div class="slideDiv">
      <img v-if="random.product_images[0]" class="oneProductSliderProductsImg" :src="'/uploads/'+random.product_images[0].path" alt="">

     <img v-if="!random.product_images[0]" class="oneProductSliderProductsImg" src="/uploads/products/123.webp" alt="">
 <div class=" text-center" style="display: flex;justify-content: center;">
                <rating-stars
                  v-if="configAverageRatingRelatedProducts[configAverageRatingRelatedProducts[key].keyId].ratingCount > 0"
                  :config="configAverageRatingRelatedProducts[configAverageRatingRelatedProducts[key].keyId]"
                ></rating-stars>
              </div>

              <div class="productInfoSlider text-center" style="display: flex;justify-content: center;">
                  <h6>{{random.title}}</h6>
              </div>
</div> -->
<div   class="divCardProductRelatedSlider">
<div class="wrapperdivCardProductRelatedSlider">
  <div class="containerdivCardProductRelatedSlider">
    <div class="top">

         <img @click="getData(random.id)" v-if="random.product_images[0]" class="oneProductSliderProductsImg" :src="'/uploads/'+random.product_images[0].path" alt="">
        <img v-if="random.product_images.length==0" @click="getData(random.id)" style="cursor:pointer;" src="/uploads/products/noImage.png" alt="">


    </div>
    <div class="bottomdivCardProductRelatedSlider">
      <div class="leftdivCardProductRelatedSlider">
        <div class="detailsdivCardProductRelatedSlider">
          <h6>{{random.title}}</h6>
          <p>$ <strong>{{random.price}}</strong></p>
           <div class=" text-center" style="display: flex; justify-content: flex-start; position: absolute; top: -358px;">
                <rating-stars
                  v-if="configAverageRatingRelatedProducts[configAverageRatingRelatedProducts[key].keyId].ratingCount > 0"
                  :config="configAverageRatingRelatedProducts[configAverageRatingRelatedProducts[key].keyId]"
                ></rating-stars>
              </div>
        </div>
        <div @click="getData(random.id)" class="buydivCardProductRelatedSlider"><i class="fas fa-eye"></i></div>
      </div>

    </div>
  </div>
  <div v-if="random.product_images.length>1" class="insidedivCardProductRelatedSlider">
    <div v-if="random.product_images.length>1" class="icondivCardProductRelatedSlider"><i style="font-size: 100%; position: absolute; top: -5px;left: -6px;" class="fas fa-info"></i></div>
    <div v-if="random.product_images.length>1" class="contentsdivCardProductRelatedSlider">
      <table>
        <tr class="text-center">
          <th>Images</th>

        </tr>



      </table>

      <div v-if="random.product_images.length>1" class="infoImagesRelatedProducts">
         <Carousel  :itemsToShow="0" :wrapAround="true" class="carouselChild">
             <!-- {{ random.product_images.splice(0, 1) }} -->
    <Slide  v-for="slideImages,key2 in random.product_images" :key="key2" >
      <div   class="carousel__item">
            <img  @click="getData(random.id)" style="cursor:pointer;" :src="'/uploads/'+slideImages.path" alt="">


      </div>
    </Slide>

    <template #addons>
      <Navigation />
      <Pagination />
    </template>
  </Carousel>

      </div>
    </div>
  </div>
</div>
</div>
    </Slide>

    <template #addons>
      <Navigation />
      <Pagination />
    </template>
  </Carousel>

      </div>

        <div class="commentsPreview">
          <div class="row m-0 p-0">
            <div class="col-md-12">
              <div class="card">
                <ul class="list-unstyled">
                  <li class="media" v-show="noCommentAvailable">
                    <div class="media-body">
                      <div class="row d-flex">
                        <h6 class="">No comments for this product</h6>
                      </div>
                    </div>
                  </li>
                  <li
                    class="media"
                    v-for="(comment, key) in comments"
                    :key="key"
                    v-show="comment.product_id == idProduct"
                  >
                    <span class="round commentAvatar pt-2"
                      ><img
                        :src="'/uploads/avatars/' + comment.image"
                        class="align-self-start mr-3"
                    /></span>
                    <div class="media-body">
                      <div class="row d-flex">
                        <h5 class="user p-2">{{ comment.name }}</h5>
                        <div class="ml-auto">
                          <rating-stars
                            style="margin: 0px"
                            :config="config[config[key].ratingId]"
                            :key="commentRenderStars"
                          ></rating-stars>

                          <h4>{{ comment.body }}</h4>

                          <div class="footerComment">
                            <div class="time">
                              <p class="text">{{ comment.created_at }}</p>
                            </div>

                            <div
                              class="form-group"
                              style="width: 95%; margin-right: 30px"
                            >

                            </div>

                            <div class="commentBtns">







                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr />
                  </li>

                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div
        class="modal fade"
        id="addImageModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="addImageModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="addImageModalLabel">
                Add Images to your product
              </h5>
            </div>
            <div class="modal-body">
              <div class="control-form">
                <input
                  type="file"
                  multiple
                  name="images"
                  ref="images"
                  id="images"
                  class="form-control custom-file-input"
                  v-on:change="onChange"
                />
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
                  data-bs-dismiss="modal"
                  @click="addImages"
                >
                  Add images
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div
        class="modal fade"
        id="imageModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="imageModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content"              @click="openImageInNewTab(modalImagePath)"
>
            <img
              data-bs-dismiss="modal"
              :src="modalImagePath"
              alt="Open in new tab"
                            title="Open in new tab"

              style="cursor: all-scroll"
            />
          </div>
        </div>
      </div>

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
              <h5 class="modal-title" id="exampleModalLabel">Update product</h5>
              <button
                type="button"
                class="close btn btn-transparent"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form
                action="#"
                class="form newtopic"
              >
                <div class="formDiv">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input
                      :class="hasError('title') ? 'is-invalid' : ''"
                      class="form-control"
                      type="text"
                      name="title"
                      id="title"
                      v-model="product.title"
                    />
                  </div>

                  <div
                    class="alert m-0 p-1 text-danger"
                    v-show="errors.title != ''"
                  >
                    {{ errors.title }}
                  </div>
                  <div class="form-group">
                    <label for="price">Price</label>
                    <input
                      :class="hasError('price') ? 'is-invalid' : ''"
                      class="form-control"
                      type="number"
                      step=".01"
                      name="price"
                      id="price"
                      v-model="product.price"
                    />
                  </div>
                  <div
                    class="alert m-0 p-1 text-danger"
                    v-show="errors.price != ''"
                  >
                    {{ errors.price }}
                  </div>

                  <div class="form-group mt-4 mb-2">
                    <label for="title">Quantity</label>
                    <select
                      name="quantity"
                      class="m-4"
                      id="quantity"
                      v-model="product.quantity"
                      @change="onChangeQuantity"
                    >
                      <option
                        v-for="$index in 100"
                        :key="$index"
                        :value="$index"
                      >
                        {{ $index }}
                      </option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea
                      :class="hasError('description') ? 'is-invalid' : ''"
                      class="form-control"
                      type="text"
                      name="description"
                      id="description"
                      rows="6"
                      v-model="product.description"
                    ></textarea>
                  </div>

                  <div
                    class="alert m-0 p-1 text-danger"
                    v-show="errors.description != ''"
                  >
                    {{ errors.description }}
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal"
                v-on:click="getProduct()"
              >
                Close
              </button>

              <button
                type="button"
                @click="updateProduct()"
                class="btn btn-primary"
              >
                Update product
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ratingStars from "./reviewComponent.vue/ratingStars.vue";

import vue3starRatings from "vue3-star-ratings";
import Swal from "sweetalert2";
import loadingPage from "./loadPage.vue";
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';

export default {
  components: { ratingStars, vue3starRatings, loadingPage,Carousel, Slide, Pagination, Navigation },

  data() {
    return {
      loading: true,
      selecCartQuantity: 1,

      ratingStars: [],

      comments: [],

      ratingCount: "",
      //////////////////

      comment: {
        product_id: 0,
        user_id: 0,
        commentBody: "",
        rating_stars: 0,
        comment_id: "",
      },

      Errorcomment: {
        commentBody: "",
        rating_stars: "",
      },

      config: [],


      configAverageRatingRelatedProducts:[],

    //   configStars: {
    //     rating: 5,
    //     ratingCount: 425,
    //     isIndicatorActive: false,
    //     style: {
    //       fullStarColor: "#ed8a19",
    //       emptyStarColor: "#737373",
    //       starWidth: 20,
    //       starHeight: 20,
    //     },
    //   },

      configAverageRating: {
        rating: null,
        ratingCount: 425,
        isIndicatorActive: false,
        style: {
          fullStarColor: "#ed8a19",
          emptyStarColor: "#737373",
          starWidth: 20,
          starHeight: 20,
        },
      },

      errors: {
        title: "",
        description: "",
        price: "",
        quantity: "",
      },
      images: [],
      form: new FormData(),
      product: {},
      idProduct: "",
      modalImagePath: "",

      login: false,

      noCommentAvailable: true,
      commentsCount: 0,
      replayState: false,
      replayDiv: null,

      ratingAverage: 0,
      ratingTotal: 0,
      averageRatingRender: 0,
      vue3StarRatingRenderVariable: 0,
      commentRenderStars: 0,

      connected_user: {
        id: "",
      },

      cartCount: 0,

      cartItem: {
        user_id: localStorage.getItem("user_id"),
      },



      randomProducts:[],
    };
  },
  mounted() {
    this.idProduct = this.$route.query.product_id
    //console.log("oneProduct : ", this.idProduct);
    this.connected_user.id = localStorage.getItem("id");
    this.connected_user.role = localStorage.getItem("role");

    this.todo();
    this.getProduct();
    this.getComments();
  },

  methods: {


      openImageInNewTab(path){
    // let routeNewTab = this.$router.resolve({ name: "product-card" });
          window.open("http://127.0.0.1:8000"+path, "_blank");

    //   window.open(routeNewTab.href+"/?product_id="+id, "_blank");
      },
 getData(id) {
      this.idProduct = id;

      let routeNewTab = this.$router.resolve({ name: "product-card" });
      window.open(routeNewTab.href+"/?product_id="+id, "_blank");
    },
      getRandomProducts(){
          console.log("fdsfdsfs",this.product)
          axios.post('api/getRandomProducts' , this.product).then((response) => {

              response.data.products.forEach(element => {
                  this.randomProducts.push(element);
              });


              this.randomProducts.forEach((element, key) => {
            this.configAverageRatingRelatedProducts.push({
              keyId: key,
              rating: element.ratingAverage,
              ratingCount: element.ratingAverage,
              isIndicatorActive: true,
              style: {
                fullStarColor: "#ed8a19",
                emptyStarColor: "#737373",
                starWidth: 15,
                starHeight: 15,
              },
            });
        });

              console.log('randolmmmm : ' , this.randomProducts)


          }).catch((err) => {

          });
      },

    countConsole() {
      console.log(this.ratingCount);
    },
    todo: function () {
      this.intervalid1 = setInterval(
        function () {
          this.connected_user.token = localStorage.getItem("token");
          this.connected_user.user = localStorage.getItem("user");
          this.connected_user.email = localStorage.getItem("useremail");
          this.connected_user.image = localStorage.getItem("img");

          if (this.connected_user.token != "") {
            this.login = true;
          } else {
            this.login = false;
          }
          //   console.log(this.connected_user.token);
        }.bind(this),
        200
      );
    },

    updateValue(event) {
      let value = event.target.value
      console.log(value, this.product.quantity)
    if(value > this.product.quantity){
        this.selecCartQuantity = this.product.quantity;
    }
    if(value < 1 ){
        this.selecCartQuantity = 1;
    }
    },

    onlyNumber ($event) {

      console.log($event.keyCode); //keyCodes value
         let keyCode = ($event.keyCode ? $event.keyCode : $event.which);
         if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) { // 46 is dot
      $event.preventDefault();
         }
},

    getProduct() {
      axios
        .get("api/products/" + this.idProduct)
        .then((response) => {
          // console.log("success");
          this.product = response.data[0];
          this.configAverageRating.rating = this.product.ratingAverage;
          if (this.configAverageRating.rating == 0.0) {
            this.configAverageRating.rating = 0;
          }

              this.getRandomProducts();


          this.averageRatingRender++;
          //console.log(this.product);
        })
        .catch((error) => {
          //console.log(error);
          // console.log("error");
        });
    },
    deleteProduct(id) {
      let config = {
        headers: {
          Authorization: `Bearer ${this.connected_user.token}`,
        },
      };

      Swal.fire({
        title: "Are you sure to delete this product ?",
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "No",
        cancelButtonColor: "#ee4646",
        confirmButtonColor: "#0370c8",
        confirmButtonText: "Yes",
        cancelButtonClass: " px-4 py-2 rounded-pill ",
        confirmButtonClass: " px-4 py-2 rounded-pill ",
        customClass: { popup: "swal2-border-radius" },
      }).then((res) => {
        if (res.value) {
          this.connected_user.token = localStorage.getItem("token");
          axios
            .post("api/productDelete/" + id, this.connected_user, config)
            .then((response) => {
              //console.log(response.data);
              this.$router.push({ path: "/products" });
            })
            .catch((error) => {
              // console.log(error);
            });
        }
      });
    },


    selectImageForModal(path) {
      return (this.modalImagePath = "/uploads/" + path);
    },

    /////

    onChangeQuantity(event) {
      this.product.quantity = event.target.value;
    },

    hasError(item) {
      if (this.errors[item] != "") {
        return true;
      } else {
        return false;
      }
    },

    updateProduct() {
      this.connected_user.token = localStorage.getItem("token");

      let config = {
        headers: {
          Authorization: `Bearer ${this.connected_user.token}`,
        },
      };
      let id = this.$route.query.product_id;

      Swal.fire({
        title: "Are you sure to update this product ?",
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "No",
        cancelButtonColor: "#ee4646",
        confirmButtonColor: "#0370c8",
        confirmButtonText: "Yes",
        cancelButtonClass: " px-4 py-2 rounded-pill ",
        confirmButtonClass: " px-4 py-2 rounded-pill ",
        customClass: { popup: "swal2-border-radius" },
      }).then((res) => {
        if (res.value) {
          axios
            .put("api/products/" + id, this.product, config)
            .then((response) => {
              //console.log(response.data);
              this.getProduct();
              this.idProduct = "";
            })
            .catch((error) => {
              if (error.response) {
                if (error.response.data.errors) {
                  if (error.response.data.errors.title) {
                    this.errors.title =
                      error.response.data.errors.title[0] ?? "";
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
                    this.errors.price =
                      error.response.data.errors.price[0] ?? "";
                  } else {
                    this.errors.price = "";
                  }
                }
              }
            });
        }
      });
    },

    ///

    deleteImage(id) {
      //console.log(id);

      Swal.fire({
        title: "Are you sure to delete this image ?",
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "No",
        cancelButtonColor: "#ee4646",
        confirmButtonColor: "#0370c8",
        confirmButtonText: "Yes",
        cancelButtonClass: " px-4 py-2 rounded-pill ",
        confirmButtonClass: " px-4 py-2 rounded-pill ",
        customClass: { popup: "swal2-border-radius" },
      }).then((res) => {
        if (res.value) {
          this.connected_user.token = localStorage.getItem("token");
          let config = {
            headers: {
              Authorization: `Bearer ${this.connected_user.token}`,
            },
          };
          axios
            .delete("api/productImages/" + id, config)
            .then((response) => {
              //console.log(response);
              this.getProduct();
            })
            .catch((error) => {
              console.log(error);
            });
        }
      });
    },

    onChange(e) {
      this.images = [];

      let file = e.target.files;

      if (!file.length) {
        return false;
      } else {
        //this.images = file;
        for (let i = 0; i < file.length; i++) {
          this.images.push(file[i]);
        }
        console.log(this.images);
      }

      //console.log(this.images[2].name)
    },

    addImages() {
      for (let i = 0; i < this.images.length; i++) {
        this.form.append("images[]", this.images[i]);
      }

      this.form.append("productName", this.product.title);
      //console.log(this.form);
      this.form.append("idProduct", this.product.id);

      let config = {
        headers: {
          Authorization: `Bearer ${this.connected_user.token}`,
          "content-type": "multipart/form-data",
        },
      };
      //console.log("images array : ", element);
      this.connected_user.token = localStorage.getItem("token");

      axios
        .post("api/uploadProductImages", this.form, config)
        .then((response) => {
          this.images = [];
          //this.getImages();
          //  console.log(response);
          this.$refs.images.value = null;
          this.getProduct();

          Swal.fire({
            position: "bottom-end",
            icon: "success",
            title: "Image(s) has been saved",
            showConfirmButton: false,
            timer: 1500,
            customClass: { popup: "swal2-border-radius" },
          });
        })
        .catch((error) => {
          if (error.response) {
            if (error.response.data.errors) {
            }
            //console.log(this.errors);
          } //  console.log("error");
        });
    },

    addComment() {
      this.comment.product_id = this.idProduct;
      this.comment.rating_stars = this.ratingCount;
      this.comment.comment_id = null;
      let user_idLocal = localStorage.getItem("user_id");
      this.comment.user_id = user_idLocal;

      //console.log(this.comment);
      this.connected_user.token = localStorage.getItem("token");

      let config = {
        headers: {
          Authorization: `Bearer ${this.connected_user.token}`,
        },
      };

      axios
        .post("api/productComment", this.comment, config)
        .then((response) => {
          this.comment = {
            product_id: 0,
            user_id: 0,
            commentBody: "",
            rating_stars: 0,
            comment_id: "",
          };
          this.ratingCount = 0;
          this.averageRatingRender++;
          this.vue3StarRatingRenderVariable++;
          this.commentRenderStars++;
          this.commentsCount = 0;
          this.getComments();
        })
        .catch((error) => {
          this.Errorcomment = error.response.data.errors;
          //console.log(error.response)

          console.log(this.Errorcomment);
        });
    },

    getComments() {
      this.ratingAverage = 0;

      this.commentsCount = 0;
      axios
        .post("api/productComment/" + this.idProduct, this.idProduct)
        .then((response) => {
          this.comments = response.data.comments;

          this.comments.forEach((element, key) => {
            if (element.product_id == this.idProduct) {
              console.log("counnnt");
              this.noCommentAvailable = false;
              this.commentsCount++;
            }

            this.ratingTotal += parseInt(element.rating_stars);

            this.config.push({
              ratingId: key,
              rating: element.rating_stars,
              ratingCount: 425,
              isIndicatorActive: false,
              style: {
                fullStarColor: "#ed8a19",
                emptyStarColor: "#737373",
                starWidth: 20,
                starHeight: 20,
              },
            });
          });
          this.averageRatingRender++;
          this.vue3StarRatingRenderVariable++;
          //console.log(this.config);
          this.commentRenderStars++;


            this.loading = false;

        })
        .catch((error) => {
          // this.Errorcomment=error.response.data.errors;
          //console.log(error.response)
          //console.log(this.Errorcomment)
        });
    },

    deleteComment(id) {
      console.log("iddddd  : ", id);
      this.connected_user.token = localStorage.getItem("token");
      let config = {
        headers: {
          Authorization: `Bearer ${this.connected_user.token}`,
        },
      };
      if (confirm("Are you sure to delete this comment")) {
        axios
          .delete("api/productComment/" + id, config)
          .then((response) => {
            this.getComments();
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },

    showReplayDiv(key) {
      this.replayDiv = null;
      console.log(key);
      this.replayState = true;
      this.replayDiv = key;
    },

    addCommentsrelated(key) {
      console.log(key);
    },

    hideCommentRelatedDiv() {
      this.replayState = false;
    },

    addToCart() {
      let config = {
        headers: {
          Authorization: `Bearer ${this.connected_user.token}`,
        },
      };

      //console.log(this.product)
      this.cartItem = this.product;
      this.cartItem.quantity = this.selecCartQuantity;

      this.cartItem.seller = this.product.user_id;

      this.cartItem.user_id = localStorage.getItem("user_id");

      // console.log("mmeeeeeee noow" , this.cartItem.user_id)

      axios
        .post("api/cart", this.cartItem, config)
        .then((response) => {
          if (response.data.status == "success") {
            let cartItemCountIconValue =
              response.data.cartItemCountIconValue.length;
            //console.log("hnaaaa" , response.data.cartItemCountIconValue)
            localStorage.setItem("countCart", parseInt(cartItemCountIconValue));

            localStorage.setItem("newItemCartWasAdded", "true");
          } else if ((response.data.status = "success2")) {
            localStorage.setItem("newItemCartWasAdded", "true");
          }
          Swal.fire({
            position: "bottom-end",
            icon: "success",
            title: "The product has been added to the cart",
            showConfirmButton: false,
            timer: 2000,
          });
        })
        .catch((error) => {
          Swal.fire({
            icon: "info",
            text: "You must login to start",
            showCancelButton: true,
            cancelButtonText: "Close",
            cancelButtonColor: "#ee4646",
            confirmButtonColor: "#0370c8",
            confirmButtonText:
              '<a href="/#/login" style="color: white;">Login</a>',
            cancelButtonClass: " px-4 py-2 rounded-pill ",
            confirmButtonClass: " px-4 py-2 rounded-pill ",
            customClass: { popup: "swal2-border-radius" },
          });
        });
    },
  },
};
</script>






<style>
.carousel__item {
  min-height: 200px;
  width: 100%;

  font-size: 20px;
  border-radius: 8px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.carousel__slide {
  padding: 10px;
}

.carousel__prev,
.carousel__next {
  box-sizing: content-box;
  border: 5px solid white;
  background-color: #0883d9;
}

.carousel__pagination-button{
    background-color: #1898f3;
}

.carousel__pagination-button--active{
    background-color: #0883d9;

}






</style>
