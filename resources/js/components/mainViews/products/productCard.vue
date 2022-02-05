<template>
  <div>
    <div class="loaderDiv" v-if="loading">
      <loadingPage />
    </div>

    <div v-if="!loading" style="width: 100%" class="containerMobileAux mt-0">
      <div v-if="!loading" style="width: 100%" class="mt-0">
        <div class="filtersBar mb-0">
          <div
            style="
              display: flex;
              flex-direction: row;
              justify-content: space-between;
              width: 95%;
              padding: 10px;
            "
          >
          <div><h6 class="fw-bold">{{ categoryFilterValue.toUpperCase()=="ALL" ? 'All categories'.toUpperCase(): categoryFilterValue.toUpperCase() }}</h6>

              <span class="text-dark fw-bold">
                Showing {{ resultQuery.length }} of
                 {{ categoriesCountItems(categoryFilterValue) }} results
              </span>

          </div>
            <div><span v-if="toggleDiv"
              ><i
                @click="toggleDiv = false"
                v-if="toggleDiv"
                style="cursor: pointer; font-size: 20px"
                class="fas fa-window-minimize"
              ></i
            ></span>
            <span
              v-if="!toggleDiv"
              style="cursor: pointer"
              @click="toggleDiv = true"
              class="mr-2"
              >
              <i
                v-if="!toggleDiv"
                style="cursor: pointer; font-size: 17px"
                class="fas fa-filter"
              ></i>
            </span></div>
          </div>

          <div class="toggleD" v-if="toggleDiv">
                        <!-- <div><h5 class="px-2 pt-3 mr-3">Categories</h5></div> -->

            <div class="gridSideBarFilters">


              <ul>
            <li>
              <span
                @click="categorySelectFilterValue('all')"
                :class="categoryFilterValue == 'all' ? 'activeCategory' : ''"
                >All ( {{ products.length }} )</span
              >
            </li>
            <li>
              <span
                @click="categorySelectFilterValue('smartphones')"
                :class="
                  categoryFilterValue == 'smartphones' ? 'activeCategory' : ''
                "

                >Smartphones
                <small>({{ categoriesCountItems("smartphones") }})</small></span
              >
            </li>
            <li>
              <span
                @click="categorySelectFilterValue('laptops')"
                :class="
                  categoryFilterValue == 'laptops' ? 'activeCategory' : ''
                "

                >Laptops
                <small>({{ categoriesCountItems("laptops") }})</small></span
              >
            </li>
            <li>
              <span
                @click="categorySelectFilterValue('desktops')"
                :class="
                  categoryFilterValue == 'desktops' ? 'activeCategory' : ''
                "

                >Desktops
                <small>({{ categoriesCountItems("desktops") }})</small></span
              >
            </li>
            <li>
              <span
                @click="categorySelectFilterValue('tablets')"
                :class="
                  categoryFilterValue == 'tablets' ? 'activeCategory' : ''
                "

                >Tablets
                <small>({{ categoriesCountItems("tablets") }})</small></span
              >
            </li>
            <li>
              <span
                @click="categorySelectFilterValue('monitors')"
                :class="
                  categoryFilterValue == 'monitors' ? 'activeCategory' : ''
                "

                >Monitors
                <small>({{ categoriesCountItems("monitors") }})</small></span
              >
            </li>
          </ul>
          <ul>
            <li>
              <span
                @click="categorySelectFilterValue('printers&Scanners')"
                :class="
                  categoryFilterValue == 'printers&Scanners'
                    ? 'activeCategory'
                    : ''
                "

                >Printers & Scanners
                <small
                  >({{ categoriesCountItems("printers&Scanners") }})</small
                ></span
              >
            </li>
            <li>
              <span
                @click="categorySelectFilterValue('cameras')"
                :class="
                  categoryFilterValue == 'cameras' ? 'activeCategory' : ''
                "

                >Cameras
                <small>({{ categoriesCountItems("cameras") }})</small></span
              >
            </li>

            <li>
              <span
                @click="categorySelectFilterValue('smartphoneAccessories')"
                :class="
                  categoryFilterValue == 'smartphone accessories'
                    ? 'activeCategory'
                    : ''
                "
                >Smartphone Accessories
                <small
                  >({{ categoriesCountItems("smartphoneAccessories") }})</small
                >
              </span>
            </li>

            <li>
              <span
                @click="categorySelectFilterValue('computerAccessories')"
                :class="
                  categoryFilterValue == 'computerAccessories'
                    ? 'activeCategory'
                    : ''
                "

              >
                Computer Accessories
                <small
                  >({{ categoriesCountItems("computerAccessories") }})</small
                ></span
              >
            </li>
          </ul>

            </div>
            <div class="filtersDiv">
              <ul class="firstUl">
                <li class="liLabel displayUlDisplayLimited text-dark">
                  <span>Order by</span>
                </li>

                <li>
                  <span>
                    <select
                      v-on:change="orderByChanged()"
                      v-model="prderBySelectValue"
                      id=""
                    >
                     <option style="display: none" selected disabled value="0">
                        Sort items
                      </option>

                      <option value="az">A-Z</option>
                      <option value="za">Z-A</option>
                      <option value="priceDesc">Price: High to Low</option>
                      <option value="priceAsc">Price: Low to High</option>

                      <option value="avgCustomer">Avg. Customer Review</option>
                      <option value="newest">Newest arrivals</option>
                                            <option value="lastest">Lastest arrivals</option>

                    </select>
                  </span>
                </li>

                <li>
                  <div class="search-wrapper  hideUnder700 panel-heading col-sm-12">
                    <input
                      type="search"
                      placeholder="Search"
                      v-model="searchQuery"
                      @input="queryArrayEqualToResultArray"
                    />
                  </div>
                </li>


              </ul>
              <ul class="secondUl">
                <li v-if="categoryFilterValue=='all'" class="liLabel displayUlDisplayLimited text-dark">
                  <span style="margin-right: 10px">Limited</span>
                </li>
                     <li v-if="categoryFilterValue=='all'">
              <span
                ><select
                @click="queryArrayEqualToResultArray()"
                  v-model="limitedSelectedValue"
                  name=""
                  id=""
                >

        <option :value="i" v-show="i%5==0 && i!=categoriesCountItems(categoryFilterValue) && i!=0 "  v-for="(i,key) in categoriesCountItems(categoryFilterValue)" :key="key">{{i}}</option>
                          <option selected value="all">All</option>




                </select></span
              >
            </li>


              </ul>
            </div>
          </div>
        </div>

        <div
          class="
            row row-cols-sm-2 row-cols-md-3 row-cols-xl-4 row-cols-xs-1
            justify-content-center
            m-0
            p-0
          "
        >
<div class="displayUnder700Aux">
       <div class="" style="display: flex;justify-content: flex-end;">

<ul >
     <li>
                  <span>
                    <select
                      v-on:change="orderByChanged()"
                      v-model="prderBySelectValue"
                      id=""
                    >
                      <option style="display: none" selected disabled value="0">
                        Sort items
                      </option>
                      <option value="az">A-Z</option>
                      <option value="za">Z-A</option>
                      <option value="priceDesc">Price: High to Low</option>
                      <option value="priceAsc">Price: Low to High</option>

                      <option value="avgCustomer">Avg. Customer Review</option>
                      <option value="newest">Newest arrivals</option>
                      <option value="lastest">Lastest arrivals</option>

                    </select>
                  </span>
                </li>

                <li>
                  <div class="search-wrapper  hideUnder700 panel-heading col-sm-12">
                    <input
                      type="search"
                      placeholder="Search"
                      v-model="searchQuery"
                      @input="queryArrayEqualToResultArray"
                    />
                  </div>
                </li>




                     <li v-if="categoryFilterValue=='all'">
              <span
                ><select
                @click="queryArrayEqualToResultArray()"
                  v-model="limitedSelectedValue"
                  name=""
                  id=""
                >

        <option :value="i" v-show="i%5==0 && i!=categoriesCountItems(categoryFilterValue) && i!=0 "  v-for="(i,key) in categoriesCountItems(categoryFilterValue)" :key="key">{{i}}</option>
                          <option selected value="all">{{ resultQuery.length }}</option>




                </select></span
              >
            </li>
</ul>
       </div>
           <div   class="search-wrapper  displayUnder700 panel-heading col-sm-12">
                    <input
                      type="search"
                      placeholder="Search"
                      v-model="searchQuery"
                      @input="queryArrayEqualToResultArray"
                    />
                  </div>

                  </div>
          <div
            style="
              display: flex;
              justify-content: center;
              align-items: center;
              text-align: center;
              flex-direction: column;
              width: 100%;
              height: 33vh;
            "
            v-if="resultQuery.length == 0"
          >
            No result found
          </div>
          <div
            class="col colPc colPcAux p-5"
            v-for="(product, key) in resultQuery"
            :key="key"
          >
            <div class="cardProduct">
              <div class="imgBox">
                <img
                  v-if="product.product_images[0]"
                  :src="'/uploads/' + product.product_images[0].path"
                  alt="Category"
                  class="mouse"
                  @click="getData(product.id)"
                  style="cursor: pointer"
                />
                <img
                  v-if="!product.product_images[0]"
                  src="/uploads/products/123.webp"
                  alt=""
                  class="mouse"
                  @click="getData(product.id)"
                  style="cursor: pointer"
                />
              </div>

              <div class="contentBox" style="padding-top: 40px">
                <h3
                  style="
                    margin-top: 8px;
                    cursor: pointer;
                    word-break: break-all;
                  "
                  @click="getData(product.id)"
                >
                  {{ product.title }}
                </h3>
                <h2 class="priceCard">${{ product.price }}</h2>
                <!-- <rating-stars
                  v-if="config.product.id.ratingCount > 0"
                  :config="config.product.id"
                ></rating-stars> -->

                <a
                  class="buy"
                  @click="getData(product.id)"
                  style="cursor: pointer"
                  data-abc="true"
                  >Buy now
                </a>
              </div>
            </div>
          </div>

          <div
            class="btnShowMoreDiv"
            v-if=" categoriesCountItems(categoryFilterValue) > resultQuery.length && resultQuery.length!=0 "
          >
            <button

              @click="limitedSelectedValueIndex()"
              class="showMoreBtn btn text-white"
            >
              Show more
            </button>
          </div>
        </div>
      </div>
    </div>





    <!-- pc containerrrr heeeeerrrreee  -->

    <div v-if="!loading" style="width: 100%" class="containerPc mt-0">
      <div class="filtersBar mb-0">
        <div class="filtersDiv">
          <ul class="displayUl" style="justify-content: flex-start">
            <li class="liLabel displayUlDisplay text-dark">
              <span>Display</span>
            </li>
            <li class="displayOption1 displayUl">
              <span
                ><img
                  class="filterimg1"
                  @click="displayGrid = false"
                  src="/icons/listDisplay.png"
                  alt=""
              /></span>
            </li>
            <li class="displayOption2 displayUl">
              <span
                ><img
                  class="filterimg2"
                  @click="displayGrid = true"
                  src="/icons/gridDisplay.png"
                  alt=""
              /></span>
            </li>
          </ul>

          <ul>
            <li>
              <span>
                <select
                  v-on:change="orderByChanged()"

                  v-model="prderBySelectValue"
                  id=""
                >
                  <option style="display: none" selected disabled value="0">
                        Sort items
                      </option>
                      <option value="az">A-Z</option>
                      <option value="za">Z-A</option>
                      <option value="priceDesc">Price: High to Low</option>
                      <option value="priceAsc">Price: Low to High</option>

                      <option value="avgCustomer">Avg. Customer Review</option>
                      <option value="newest">Newest arrivals</option>
                      <option value="lastest">Lastest arrivals</option>

                </select>
              </span>
            </li>
            <!-- <li v-if="categoryFilterValue=='all'" class="liLabel displayUlDisplay text-dark">
              <span>Limited</span>
            </li> -->
            <li v-if="categoryFilterValue=='all'">
              <span
                ><select

                @click="queryArrayEqualToResultArray()"
                  v-model="limitedSelectedValue"
                  name=""
                  id=""
                >

        <option :value="i" v-show="i%5==0 && i!=categoriesCountItems(categoryFilterValue) && i!=0 "  v-for="(i,key) in categoriesCountItems(categoryFilterValue)" :key="key">{{i}}</option>
                          <option selected value="all">All</option>




                </select></span
              >
            </li>

            <li class="liLabel text-dark">
              <span class="text-dark">
                Showing {{ resultQuery.length }} of
                 {{ categoriesCountItems(categoryFilterValue) }} results
              </span>
            </li>
          </ul>
        </div>
        <div class="search-wrapper panel-heading col-sm-12">
          <input type="search" placeholder="Search" v-model="searchQuery" @input="queryArrayEqualToResultArray" />
        </div>
      </div>

      <div class="gridSideBar">
        <div class="gridSideBarFilters">
          <h5 class="px-2 pt-3 mr-3">Categories</h5>
          <ul>
            <li>
              <span
                @click="categorySelectFilterValue('all')"
                :class="categoryFilterValue == 'all' ? 'activeCategory' : ''"
                class="firstLi"
                >All ( {{ products.length }} )</span
              >
            </li>
            <li>
              <span
                @click="categorySelectFilterValue('smartphones')"
                :class="
                  categoryFilterValue == 'smartphones' ? 'activeCategory' : ''
                "
                class="childLi"
                >Smartphones
                <small>({{ categoriesCountItems("smartphones") }})</small></span
              >
            </li>
            <li>
              <span
                @click="categorySelectFilterValue('laptops')"
                :class="
                  categoryFilterValue == 'laptops' ? 'activeCategory' : ''
                "
                class="childLi"
                >Laptops
                <small>({{ categoriesCountItems("laptops") }})</small></span
              >
            </li>
            <li>
              <span
                @click="categorySelectFilterValue('desktops')"
                :class="
                  categoryFilterValue == 'desktops' ? 'activeCategory' : ''
                "
                class="childLi"
                >Desktops
                <small>({{ categoriesCountItems("desktops") }})</small></span
              >
            </li>
            <li>
              <span
                @click="categorySelectFilterValue('tablets')"
                :class="
                  categoryFilterValue == 'tablets' ? 'activeCategory' : ''
                "
                class="childLi"
                >Tablets
                <small>({{ categoriesCountItems("tablets") }})</small></span
              >
            </li>
            <li>
              <span
                @click="categorySelectFilterValue('monitors')"
                :class="
                  categoryFilterValue == 'monitors' ? 'activeCategory' : ''
                "
                class="childLi"
                >Monitors
                <small>({{ categoriesCountItems("monitors") }})</small></span
              >
            </li>
          </ul>
          <ul>
            <li>
              <span
                @click="categorySelectFilterValue('printers&Scanners')"
                :class="
                  categoryFilterValue == 'printers&Scanners'
                    ? 'activeCategory'
                    : ''
                "
                class="childLi"
                >Printers & Scanners
                <small
                  >({{ categoriesCountItems("printers&Scanners") }})</small
                ></span
              >
            </li>
            <li>
              <span
                @click="categorySelectFilterValue('cameras')"
                :class="
                  categoryFilterValue == 'cameras' ? 'activeCategory' : ''
                "
                class="childLi"
                >Cameras
                <small>({{ categoriesCountItems("cameras") }})</small></span
              >
            </li>

            <li>
              <span
                @click="categorySelectFilterValue('smartphoneAccessories')"
                :class="
                  categoryFilterValue == 'smartphone accessories'
                    ? 'activeCategory'
                    : ''
                "
                class="childLi"
                >Smartphone Accessories
                <small
                  >({{ categoriesCountItems("smartphoneAccessories") }})</small
                >
              </span>
            </li>

            <li>
              <span
                @click="categorySelectFilterValue('computerAccessories')"
                :class="
                  categoryFilterValue == 'computerAccessories'
                    ? 'activeCategory'
                    : ''
                "
                class="childLi"
              >
                Computer Accessories
                <small
                  >({{ categoriesCountItems("computerAccessories") }})</small
                ></span
              >
            </li>
          </ul>
        </div>

        <div
          class="
            row row-cols-sm-2 row-cols-md-3 row-cols-xl-4 row-cols-xs-1
            justify-content-center
            m-0
            p-0
          "
          :style="
            !displayGrid == true
              ? 'flex-direction:column;'
              : 'flex-direction:row;'
          "
          :class="
            displayGrid == true
              ? 'row row-cols-12'
              : ' row row-cols-sm-2 row-cols-md-3 row-cols-xl-4 row-cols-xs-1 justify-content-center m-0 p-0'
          "
        >
          <div
            style="
              display: flex;
              justify-content: center;
              align-items: center;
              text-align: center;
              flex-direction: column;
              width: 100%;
              height: 33vh;
            "
            v-if="resultQuery.length == 0"
          >
            No result found
          </div>
          <div
            class=""
            v-for="(product, key) in resultQuery"
            :key="key"
            :class="displayGrid == true ? 'col-12 colPc colPcAux p-5' : ''"
            :style="
              displayGrid == false
                ? 'width: 100%;display: flex;justify-content: center;padding: 37px;'
                : ''
            "
          >
            <div
              class="cardProduct"
              :style="displayGrid == false ? 'width: 65%; height:100%' : ''"
            >
              <div class="imgBox">
                <img
                  v-if="product.product_images[0]"
                  :src="'/uploads/' + product.product_images[0].path"
                  alt="Category"
                  class="mouse"
                  @click="getData(product.id)"
                  style="cursor: pointer"
                  :style="displayGrid == false ? 'height: 100%;' : ''"
                />
                <img
                  v-if="!product.product_images[0]"
                  src="/uploads/products/123.webp"
                  alt=""
                  class="mouse"
                  @click="getData(product.id)"
                  style="cursor: pointer"
                  :style="displayGrid == false ? 'height: 100%;' : ''"
                />
              </div>

              <div class="contentBox" style="padding-top: 40px">
                <span
                  class="categorySpan"
                  style="
                    font-size: 86%;
                    color: #797979;
                    position: absolute;
                    top: 5px;
                    left: 9px;
                  "
                  >{{ product.category.toUpperCase() }}</span
                >
                <h3
                  style="
                    margin-top: 8px;
                    cursor: pointer;
                    word-break: break-all;
                  "
                  @click="getData(product.id)"
                >
                  {{ product.title }}
                </h3>
                <h2 class="priceCard">${{ product.price }}</h2>



<div v-if="!product.ratingAverage>0">

</div>



<div style="padding: 10px;display: flex;justify-content: center;text-align: center;margin-left: 17%;" v-if="product.ratingAverage>0">
<star-rating
 v-bind:increment="0.1"
  v-bind:read-only="true"
  v-bind:rating="product.ratingAverage"

             v-bind:max-rating="5"
             inactive-color="#000"
             active-color="#ffce00"
             v-bind:star-size="30">
</star-rating>
</div>


                <a
                  class="buy"
                  @click="getData(product.id)"
                  style="cursor: pointer"
                  data-abc="true"
                  >Buy now
                </a>
              </div>
            </div>
          </div>

          <div
            class="btnShowMoreDiv"
            v-if="products.length > resultQuery.length"
          >
            <button

                v-if="categoriesCountItems(categoryFilterValue) > resultQuery.length "
              @click="limitedSelectedValueIndex()"
              class="showMoreBtn btn text-white"
            >
              Show more
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import ratingStars from "./reviewComponent.vue/ratingStars.vue";
import Swal from "sweetalert2";
import loadingPage from "./loadPage.vue";
import StarRating from 'vue-star-rating'
export default {
  components: { ratingStars, loadingPage,  StarRating },
  data() {
    return {


         bgColor: '#778899',
          position: 'top-right',
          fabActions: [
              {
                  name: 'cache',
                  icon: 'cached'
              },
              {
                  name: 'alertMe',
                  icon: 'add_alert'
              }
          ],


      displayGrid: true,
      products: [],
      searchQuery: "",
      prderBySelectValue: "0",
      currentSort: "price",
      currentSortStatement1: "",
      currentSortStatement2: "",
      currentSortDir: "-",
      config: [],
      loading: true,

      limitedSelectedValue: "all",

      options: [5, 10, 15, 30, 45, 60],

      toggleDiv: false,

      categoryFilterValue: "all",

      categoriesCountItemsArray: [],

      resultArray : [],





    };
  },
  mounted() {
    this.getProducts(); this.resultArray=this.resultQuery
// this.todo();
  },

  computed: {


    resultQuery :function () {

      let categoryFilterValue = this.categoryFilterValue;
      if (this.searchQuery) {
        this.limitedSelectedValue = "all";
        return this.products.filter((item , index) => {
          return this.searchQuery
            .toLowerCase()
            .split(" ")
            .every((v) => {
              if (this.categoryFilterValue != "all") {
                if(this.limitedSelectedValue=='all'){
                return (
                  item.category == categoryFilterValue &&
                  item.title.toLowerCase().includes(v)
                );
              }else{

                    return (
                  item.category == categoryFilterValue &&
                  item.title.toLowerCase().includes(v) //limiiiit
                );
              }
              }
              else{

                  return item.title.toLowerCase().includes(v) //limiit ;
              }
            });
        }).sort(this.orderBy);
      }else{

           return this.products.filter(this.filterTable).sort(this.orderBy);
      }


    },



  },
  methods: {

     filterTable : function (item , index) {

   if (this.categoryFilterValue == "all") {
        if(this.limitedSelectedValue!='all'){
              return item   && index <  parseInt(this.limitedSelectedValue)
                }
        return  item;
   }





              if (this.categoryFilterValue != "all") {
                console.log("hahahaahah");
                if(this.limitedSelectedValue=='all'){
 return (
                  item.category == this.categoryFilterValue
                );
                }else{

                return (

                  item.category == this.categoryFilterValue

                );
                }
              }


      },

      orderBy(a,b){
        let sortFunction = this.orderByChanged();

        if (sortFunction == "ratingAverage") {
          sortFunction = "ratingAverage";
            console.log(b[sortFunction]-a[sortFunction])

            if(b[sortFunction]==null){
                b[sortFunction]=0.0
                console.log('zeeerrrrroooo' , sortFunction)
            }
             if(a[sortFunction]==null){
                a[sortFunction]=0.0
            }
            return  b[sortFunction] - a[sortFunction];

        }

        if (sortFunction == "priceDesc") {
          sortFunction = "price";

            return b[sortFunction] - a[sortFunction];

        }
        if (sortFunction == "priceAsc") {
          sortFunction = "price";

  return a[sortFunction] - b[sortFunction];

        }

        if (sortFunction == "zaDesc") {
          sortFunction = "title";

            a[sortFunction].toUpperCase();
            b[sortFunction].toUpperCase();
            return a[sortFunction][0][0] < b[sortFunction][0][0] ? 1 : -1;

        }

        if (sortFunction == "azAsc") {
          sortFunction = "title";


            a[sortFunction].toUpperCase();
            b[sortFunction].toUpperCase();
            return b[sortFunction][0][0] < a[sortFunction][0][0] ? 1 : -1;

        }


         if (sortFunction == "idAsc") {
          sortFunction = "id";


            a[sortFunction];
            b[sortFunction];
            return b[sortFunction][0][0] < a[sortFunction][0][0] ? 1 : -1;

        }

         if (sortFunction == "idDesc") {
          sortFunction = "id";


            a[sortFunction];
            b[sortFunction];
            return b[sortFunction][0][0] > a[sortFunction][0][0] ? 1 : -1;

        }




        return true;

      },

getProducts() {
      axios
        .get("/api/products")
        .then((response) => {
          this.products = response.data;


          this.loading = false;

          //   console.log(this.products , "ennnnna");
        })
        .catch((error) => {
          console.log(error);
        });
    },

    getData(id) {
      this.idProduct = id;
      console.log(this.products);
      this.$router.push("/oneProduct/?product_id=" + id);
    },

    orderByChanged() {
                        this.resultArray=this.resultQuery;

      switch (this.prderBySelectValue) {

        case "priceAsc":
          return "priceAsc";
        case "priceDesc":
          return "priceDesc";
        case "avgCustomer":
          return "ratingAverage";
        case "newest":
          return "id";
        case "za":
          return "zaDesc";
        case "az":
          return "azAsc";
        case "lastest":
          return "idAsc";
        case "newest":
          return "idDesc";
        default:
          return null;
      }
    },

    limitedSelectedValueIndex() {


       this.limitedSelectedValue = parseInt (this.limitedSelectedValue) + 5
     if(parseInt (this.limitedSelectedValue)>=this.categoriesCountItems(this.categoryFilterValue)){
         console.log('aaaalllll');
         this.limitedSelectedValue='all'
     }
    },

    categorySelectFilterValue(ch) {
        this.limitedSelectedValue='all'
      this.categoryFilterValue = ch;
      console.log("category", ch);
      this.queryArrayEqualToResultArray();
      this.toggleDiv=false;
    },

    categoriesCountItems(ch) {
        if(ch!="all"){
      return this.products.filter((item) => {
        return item.category == ch;
      }).length;
    }else{
        return this.products.length
    }
    },

queryArrayEqualToResultArray(){
    this.resultArray=this.resultQuery;
},



  },
};
</script>



<style>
.cardProduct {
  position: relative;
  width: 250px;
  height: 510px;
  background: #191f25;
  border-radius: 20px;
  overflow: hidden;
  border-radius: 30px;
}

.cardProduct::before {
  content: "";
  position: absolute;
  top: 30%;
  width: 100%;
  height: 100%;
  background: #21272c;
  transform: skewY(404deg);
  transition: 0.5s;
}

.cardProduct:hover::before {
  top: -70%;
  transform: skewY(390deg);
}

.cardProduct::after {
  position: absolute;
  bottom: 0;
  left: 0;
  font-weight: 600;
  font-size: 6em;
  color: rgba(0, 0, 0, 0.1);
}

.cardProduct .imgBox {
  position: relative;
  width: 100%;
  display: flex;

  z-index: 1;
}

.cardProduct .contentBox {
  position: relative;
  padding: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  z-index: 2;
}

.cardProduct .contentBox h3 {
  font-size: 100%;
  color: rgb(255, 255, 255);
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.cardProduct .contentBox .priceCard {
  font-size: 24px;
  color: #ffdd1e;
  font-weight: 700;
  letter-spacing: 1px;
}

.cardProduct .contentBox .buy {
  position: absolute;
top: 0;
opacity: 1;
padding: 10px 30px;
margin-top: 15px;
color: #000000;
text-decoration: none;
background: #ffce00;
border-radius: 30px;
text-transform: uppercase;
letter-spacing: 1px;
transition: 0.5s;
top: 178px;
}

.cardProduct:hover .contentBox .buy {
  opacity: 0.9;
}

.mouse {
  width: 100%;
  height: 250px;
  object-fit: cover;
  background-color: white;
}

.priceCard {
  margin-top: 0px;
  margin-bottom: 5px;
}

@media screen and (max-width: 3768px) {
  .colPc {
    display: flex;
    justify-content: center;
    margin-bottom: 40px;
    width: 100%;
  }
}

.cardProductAux {
  position: relative;
  width: 50%;
  height: 100%;
  background: #191f25;
  border-radius: 20px;
  overflow: hidden;
  border-radius: 30px;
}

.mouseAux {
  width: 100%;
  height: 100%;
  -o-object-fit: cover;
  object-fit: cover;
  background-color: white;
}

.cardProductAux::before {
  content: "";
  position: absolute;
  top: 30%;
  width: 100%;
  height: 100%;
  background: #21272c;
  transform: skewY(390deg);
  transition: 0.5s;
}

.colPcAux {
  display: flex;
  justify-content: center;
  margin-bottom: 40px;
  width: 324px;
}

.rowAux {
  width: 100%;
}
</style>
