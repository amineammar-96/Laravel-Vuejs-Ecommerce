<template>
<div>


    <div v-if="loading" class="div">
      <loading-page />
    </div>


<div v-if="!loading">


<div v-if="alreadyConfirmed==true">
<div style="display: flex;align-items: center;height: 80vh;" :key="conRender">



<div class="funds-success-message-container">
  <div class="funds-checkmark-text-container">
    <div class="funds-checkmark-container">
      <svg class="funds-checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="funds-checkmark-circle" cx="26" cy="26" r="25" fill="none"/><path class="funds-checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg>

     <div class="funds-display-on-ie">
       <!-- <svg class="funds-ie-checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="funds-ie-checkmark-circle" cx="26" cy="26" r="25" fill="none"/><path class="funds-ie-checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg> -->
      </div>
    </div>

  </div>

  <div class="funds-success-message">



    <h1 class="funds-success-done-text">Already confirmed</h1>

    <h2 >Please check your orders history</h2>
        <button type="button" data-bs-toggle="modal" data-bs-target="#noteOrderItemModal" style="background-color: #0883d9; color:white;" class="btn  rounded-pill">Note the product here !</button>

  </div>

</div>
</div>
</div>





<div v-if="alreadyConfirmed==false">
<div style="display: flex;align-items: center;height: 80vh;" :key="conRender">



<div class="funds-success-message-container">
  <div class="funds-checkmark-text-container">
    <div class="funds-checkmark-container">
      <svg class="funds-checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="funds-checkmark-circle" cx="26" cy="26" r="25" fill="none"/><path class="funds-checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg>

     <div class="funds-display-on-ie">
       <svg class="funds-ie-checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="funds-ie-checkmark-circle" cx="26" cy="26" r="25" fill="none"/><path class="funds-ie-checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/></svg>
      </div>
    </div>

    <h1 class="funds-success-done-text">Well done !</h1>
  </div>

  <div class="funds-success-message">




    <h2 >Product has been delivered successfuly</h2>
   <p >Thank you for the validation</p>
    <button type="button" data-bs-toggle="modal" data-bs-target="#noteOrderItemModal" style="background-color: #0883d9; color:white;" class="btn  rounded-pill">Note the product here !</button>

  </div>

</div>
</div>
</div>







<!-- Modal -->
<div v-show="modalOpen" class="modal  fade" id="noteOrderItemModal" tabindex="-1" aria-labelledby="noteOrderItemModalLabel" aria-hidden="true">
  <div class="modal-dialog ">
    <div class="modal-content" style="background-color: rgb(236, 233, 233);border-radius: 24px;">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="noteOrderItemModalLabel">Give us your opinion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="addCommentForm p-3 " style="height: 100%;">

            <div class="productModal">



                <div class="prodcutImgComment">
                    <!-- v-if="product" :src="'/uploads/'+product.product_images[0].path ?? '' " -->
                   <img @click="getData(product.id)" v-if="image!=''" :src="'/uploads/'+ image ?? '' " style="cursor:pointer;"  :alt="product.title" :title="product.title">
                </div>
            </div>


<div class="starRatingDivCommentProduct " style="    text-align: center; margin-top: 30px;margin-left: 28%;">
<star-rating
v-bind:show-rating="false"
@click="countConsole"
v-model:rating="rating"
 v-bind:increment="0.2"
             v-bind:max-rating="5"
             inactive-color="#000"
             active-color="#ffdd00"
             v-bind:star-size="35">
</star-rating>
</div>



            <div style="display: flex;"><caption class="text-dark" >Comment here</caption></div>
          <div class="form-group mt-3 px-5">
            <textarea
              wrap="physical"
              rows="5"
              cols="50"
              style="border: none"
              name="comment_body"
              class="form-control"
              v-model="comment.commentBody"
            ></textarea>

            <div
              v-if="Errorcomment.commentBody"
              class="m-0 py-1 text-danger "
            >
              {{ Errorcomment.commentBody[0] }}
            </div>
 <div
            v-if="Errorcomment.rating_stars"
            class="m-0 py-1  text-danger "
          >
            Please rate the product
          </div>
            <input type="hidden" name="product_id" value="{{ idProduct }}" />
          </div>



        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn rounded-pill" data-bs-dismiss="modal" style="background-color: #161616;color: white;">Close</button>
        <button type="button" @click="addComment" class="btn rounded-pill" style="background-color: rgb(46, 88, 255);color: white;" >Save comment</button>
      </div>
    </div>
  </div>
</div>
</div>
</div>

</template>


<script>
import loadingPage from "./loadPage.vue";
import vue3starRatings from "vue3-star-ratings";
import { defineComponent } from "vue";
import StarRating from 'vue-star-rating'
import Swal from "sweetalert2";

export default defineComponent({
  components: {
    vue3starRatings,loadingPage,StarRating
  },
    data() {
        return {
        orderItem : {
            id : ""
        },

        alreadyConfirmed :false,
        loading:false,

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

      connected_user: {
        id: "",
      },

    rating:0,
    product:{},

    image:"",
    modalOpen: true,
        }
    },

    mounted(){
        this.loading=true;
                 this.orderItem.id = this.$route.query.orderItem_id;
                 this.orderItem.user_id=this.$route.query.user_id;
                console.log("hahahassss" ,this.orderItem.id)

                this.confirmOrderItemReveive();

                this.rating=0;
                this.getProduct();
    },

    methods:{
        getProduct() {
      axios
        .get("api/products/" + this.$route.query.product_id)
        .then((response) => {
          // console.log("success");
          this.product = response.data[0];
            this.image=this.product.product_images[0].path
          console.log(this.product.product_images[0].path);

          this.loading=false;
        })

    },


 countConsole() {
     console.log(this.rating)
    },
        addComment() {
      this.comment.product_id = this.$route.query.product_id;
      this.comment.rating_stars = this.rating;
      this.comment.comment_id = null;
      let user_idLocal = this.orderItem.user_id ;
      this.comment.user_id = user_idLocal;


      let idPro = this.$route.query.product_id;
Swal.fire({
  title: 'Send this comment ?',
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes'
}).then((result) => {
  if    (result.isConfirmed) {
       axios
        .post("api/productComment", this.comment)
        .then((response) => {
             this.Errorcomment ={
        commentBody: "",
        rating_stars: "",
             }
          this.comment = {
            product_id: 0,
            user_id: 0,
            commentBody: "",
            rating_stars: 0,
            comment_id: "",
          };
        this.rating=0


    let routeNewTab = this.$router.resolve({ name: "product-card" });
      window.open(routeNewTab.href+"/?product_id="+idPro, "_blank");
        })
        .catch((error) => {
          this.Errorcomment = error.response.data.errors;
          //console.log(error.response)

        });

  }
})

         },



getData(id) {
let routeNewTab = this.$router.resolve({ name: "product-card" });
window.open(routeNewTab.href+"/?product_id="+id, "_blank");
    //   this.$router.push('/oneProduct/?product_id='+id);
    },




        confirmOrderItemReveive(){
            axios.post('api/confirmOrderItemReceive/'+this.orderItem.id).then((response) => {
                        if(response.data.status.toUpperCase()=="confirmed"){
                            this.alreadyConfirmed=false;
                        }else {
                             this.alreadyConfirmed=false;
                        }
            }).catch((err) => {

            });
        },
    }
});
</script>




<style>

.funds-success-message-container {
  font-family: Roboto, "Segoe UI", "Helvetica Neue", sans-serif !important;
  color: #333;
  margin-top: 100px;
  max-width: 500px;
  margin: 0 auto;
}

.funds-checkmark-text-container {
  display: block;
  width: auto !important;
  max-width: 500px;
  margin: 0 auto;
  text-align: center;
}

.funds-checkmark-container {
  height: 40px;
  padding: 0 4px 0 0px;
  display: inline-block;
  width: 70px;
  margin: 0 auto;
}

.funds-checkmark-container:after {
  clear: both;
}

.funds-success-done-text {
  vertical-align: middle;
  margin: 0;
  display: inline;
}

.funds-success-message {
  text-align: center;
  margin-top: 2em;
}

.funds-success-message h2 {
  margin-top: 0px;
}

h1,
h2 {
  font-weight: 700;
  margin-top: 0px;
}

h1 {
  font-size: 28pt;
  margin-top: 45px;
}

h2 {
  font-size: 18pt;
  margin-top: 25px;
}

p {
  font-size: 12pt;
  padding-bottom: 1em;
  line-height: 27.2px;
}

/* CHECKMARK */
.funds-checkmark-circle {
  stroke-dasharray: 166;
  stroke-dashoffset: 166;
  stroke-width: 5;
  stroke-miterlimit: 10;
  stroke: #33bb11;
  fill: none;
  -webkit-animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
  animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
}

.funds-checkmark {
  width: 56px;
  height: 56px;
  border-radius: 50%;
  display: block;
  stroke-width: 5;
  stroke: #ffffff;
  stroke-miterlimit: 10;
  margin: 10% auto;
  -webkit-box-shadow: inset 0px 0px 0px #33bb11;
  box-shadow: inset 0px 0px 0px #33bb11;
  -webkit-animation: fill 0.4s ease-in-out 0.4s forwards,
    scale 0.3s ease-in-out 0.9s both;
  animation: fill 0.4s ease-in-out 0.4s forwards,
    scale 0.3s ease-in-out 0.9s both;
}

.funds-checkmark-check {
  -webkit-transform-origin: 50% 50%;
  -ms-transform-origin: 50% 50%;
  transform-origin: 50% 50%;
  stroke-dasharray: 48;
  stroke-dashoffset: 48;
  -webkit-animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
  animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
}

.funds-display-on-ie {
  display: none;
}

@media screen and (-ms-high-contrast: active), (-ms-high-contrast: none) {
  .funds-display-on-ie {
    display: block;
  }

  .funds-checkmark {
    display: none;
  }

  .funds-ie-checkmark-circle {
    stroke-dasharray: 166;
    stroke-dashoffset: 166;
    stroke-width: 5;
    stroke-miterlimit: 10;
    stroke: #33bb11;
    fill: none;
    -webkit-animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
    animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
  }

  .funds-ie-checkmark {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    display: block;
    stroke-width: 5;
    stroke: #ffffff;
    stroke-miterlimit: 10;
    margin: 10% auto;
    -webkit-box-shadow: inset 0px 0px 0px #33bb11;
    box-shadow: inset 0px 0px 0px #33bb11;
    -webkit-animation: fill 0.4s ease-in-out 0.4s forwards,
      scale 0.3s ease-in-out 0.9s both;
    animation: fill 0.4s ease-in-out 0.4s forwards,
      scale 0.3s ease-in-out 0.9s both;
  }

  .funds-ie-checkmark-check {
    -webkit-transform-origin: 50% 50%;
    -ms-transform-origin: 50% 50%;
    transform-origin: 50% 50%;
    -webkit-animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
    animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
  }
}

@-webkit-keyframes stroke {
  100% {
    stroke-dashoffset: 0;
  }
}

@keyframes stroke {
  100% {
    stroke-dashoffset: 0;
  }
}

@-webkit-keyframes scale {
  0%,
  100% {
    -webkit-transform: none;
    transform: none;
  }
  50% {
    -webkit-transform: scale3d(1.1, 1.1, 1);
    transform: scale3d(1.1, 1.1, 1);
  }
}

@keyframes scale {
  0%,
  100% {
    -webkit-transform: none;
    transform: none;
  }
  50% {
    -webkit-transform: scale3d(1.1, 1.1, 1);
    transform: scale3d(1.1, 1.1, 1);
  }
}

@-webkit-keyframes fill {
  100% {
    -webkit-box-shadow: inset 0px 0px 0px 30px #33bb11;
    box-shadow: inset 0px 0px 0px 30px #33bb11;
  }
}

@keyframes fill {
  100% {
    -webkit-box-shadow: inset 0px 0px 0px 30px #33bb11;
    box-shadow: inset 0px 0px 0px 30px #33bb11;
  }
}

@media only screen and (max-width: 768px) {
  .funds-checkmark-text-container {
    display: block;
  }
  .funds-checkmark-container {
    height: auto;
    padding: 0;
    display: block;
    width: 100%;
  }
}


</style>
