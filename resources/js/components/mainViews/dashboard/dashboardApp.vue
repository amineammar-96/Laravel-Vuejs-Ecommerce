<template>
  <div>
    <div class="gridDashboard">
      <div class="sideBarAccount">
        <div class="main-app">
          <div class="sidebar">
            <nav class="main-nav">
              <ul class="main-menu pt-4">
                <li
                  class="menu-item"
                  :class="dashboardStep == 1 ? 'active' : ''"
                >
                  <a class="menu-a" @click="dashboardStep = 1">
                    <div class="menu-txt-hld">
                      <i class="fas fa-tachometer-alt menu-icon"></i>
                      <!-- <i class="fas fa-user-circle menu-icon"></i> -->
                      <span class="menu-txt">Dashboard</span>
                    </div>
                  </a>
                </li>
                <li
                  class="menu-item"
                  :class="dashboardStep == 2 ? 'active' : ''"
                >
                  <a class="menu-a" @click="dashboardStep = 2">
                    <div class="menu-txt-hld">
                      <i class="fas fa-truck menu-icon"></i>
                      <span class="menu-txt">Products</span>
                    </div>
                  </a>
                </li>
                <li
                  class="menu-item"
                  :class="dashboardStep == 3 ? 'active' : ''"
                >
                  <a @click="dashboardStep = 3" class="menu-a">
                    <div class="menu-txt-hld">
                      <i class="fas fa-shopping-cart menu-icon"></i>
                      <span class="menu-txt">Orders</span>
                    </div>
                  </a>
                </li>
                <li
                  class="menu-item"
                  :class="dashboardStep == 4 ? 'active' : ''"
                >
                  <a class="menu-a">
                    <div class="menu-txt-hld">
                      <i class="fas fa-chart-line menu-icon"></i>
                      <span class="menu-txt">Statistics</span>
                    </div>
                  </a>
                </li>
                <li class="menu-item">
                  <a class="menu-a">
                    <div class="menu-txt-hld">
                      <i class="fas fa-cash-register menu-icon"></i>

                      <span class="menu-txt">Invoices</span>
                    </div>
                  </a>
                </li>
                <li class="menu-item">
                  <a class="menu-a">
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

      <div class="dashboard" v-if="dashboardStep == 1">
        <div class="main-content">
          <header>
            <div class="header-wrapper">
              <label for="menu-toggle"> </label>
              <div class="header-title"></div>
            </div>
            <div class="header-action"></div>
          </header>
          <main>
            <section>
              <h3 class="section-head">Overview</h3>
              <div class="analytics">
                <div class="analytic">
                  <div class="analytic-icon"><i class="far fa-eye"></i></div>
                  <div class="analytic-info">
                    <h4>Total views</h4>
                    <h1>10.3M</h1>
                  </div>
                </div>
                <div class="analytic">
                  <div class="analytic-icon">
                    <i class="fas fa-truck-moving"></i>
                  </div>
                  <div class="analytic-info">
                    <h4>Total Orders</h4>
                    <h1>20.9k</h1>
                  </div>
                </div>
                <div class="analytic">
                  <div class="analytic-icon"><i class="fas fa-wallet"></i></div>
                  <div class="analytic-info">
                    <h4>Products Sold</h4>
                    <h1>1.3k</h1>
                  </div>
                </div>
                <div class="analytic">
                  <div class="analytic-icon"><i class="fas fa-heart"></i></div>
                  <div class="analytic-info">
                    <h4>Total likes</h4>
                    <h1>3.4M</h1>
                  </div>
                </div>
              </div>
            </section>
            <section>
              <div class="block-grid">
                <div class="revenue-card">
                  <h3 class="section-head">Total Revenue</h3>
                  <div class="rev-content">
                    <!-- <img src="https://media-exp1.licdn.com/dms/image/C4D03AQF9R2lxnH4fOw/profile-displayphoto-shrink_200_200/0/1639841285929?e=1645660800&v=beta&t=NAIfG4HpAKNOkf2W5RDHRWQgrFrwqMXjBoS_UwQ4RBw" alt="profile"> -->
                    <div class="rev-info">
                      <!-- <h3>Mohsen Alizade</h3> -->
                      <!-- <h1>3.5M <small>Subscribers</small></h1> -->
                    </div>
                    <div class="rev-sum">
                      <h4>Total income</h4>
                      <h2>$70.859</h2>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </main>
        </div>
      </div>

      <div class="dashboardStep2" v-if="dashboardStep == 2 && loading">
        <loadingPage />
      </div>

      <div class="dashboardStep2" v-if="dashboardStep == 2 && !loading">
        <header class="wrapper createProductHeader p-4">
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

        <nav
          class="navbar navbar-light"
          style="padding: 0; background-color: #e0e1e1"
        >
          <form
            @click="displayGrid = false"
            class="container-fluid justify-content-start"
          >
            <button
              class="btn"
              type="button"
              @click="productStep = 1"
              :class="productStep == 1 ? 'btnActive' : ''"
            >
              Online own annonces
            </button>
            <button
              class="btn"
              type="button"
              @click="productStep = 2"
              :class="productStep == 2 ? 'btnActive' : ''"
            >
              Sold history and tracking
            </button>
          </form>
        </nav>

        <div class="filtersBar2 mb-0" style="border-radius: 0">
          <div
            class="filtersDiv"
            style="padding-left: 22px; justify-content: end"
          >
            <ul class="displayUl py-4" style="justify-content: flex-start">
              <li class="displayOption1 displayUl">
                <span
                  ><img
                    class="filterimg1 iconsHistoryAndTrackingPage"
                    @click="displayGrid = false"
                    src="/icons/table.png"
                    style="width: 60px; margin-right: 19px"
                    alt=""
                /></span>
              </li>
              <li class="displayOption2 displayUl">
                <span
                  ><img
                                   v-if="productStep==2"

                    style="width: 60px; margin-right: 19px"
                    class="filterimg2 iconsHistoryAndTrackingPage"
                    @click="displayGrid = true"
                    src="/icons/fast-delivery.png"
                    alt=""
                />

                 <img
                 v-if="productStep==1"
                    style="width: 100%; margin-right: 19px"
                    class="filterimg2 iconsHistoryAndTrackingPage"
                    @click="displayGrid = true"
                    src="/icons/gridDisplay.png"
                    alt=""
                /> </span>
              </li>
            </ul>

            <ul>
              <li class="liLabel text-dark">
                <span v-if="productStep == 1" class="text-dark">
                  Showing {{ resultQuery.length }} of
                  {{ userProducts.length }} results
                </span>
                <span v-if="productStep == 2" class="text-dark">
                  Showing {{ resultQuerySoldProducts.length }} of
                  {{ soldProducts.length }} results
                </span>
              </li>
            </ul>
          </div>
          <div
            class="search-wrapper2Div"
            style="display: flex; align-items: center"
          >
            <div class="search-wrapper2 panel-heading col-sm-12">
              <input
                style="border-radius: 0; transition: all 0.8s"
                type="search"
                placeholder="Search"
                v-model="searchQuery"
              />
            </div>
          </div>
        </div>

        <div class="allOwnProducts py-4" v-if="productStep == 1">
          <div v-if="displayGrid == false" class="containerOwnProduct">
            <div class="container">
              <div class="row py-5 pt-2">
                <div class="col-12">
                  <table
                    id="DashboardTables"
                    class="table table-hover responsive nowrap"
                    style="width: 100%"
                  >
                    <thead>
                      <tr>
                        <th
                          @click="checkSortingOwnProductsTable('id')"
                          class="mx-4 px-4"
                          style="width: 11%"
                        >
                          <span v-if="verifyWhereIconShouldBe('id')">
                            <i
                              v-if="verifiyedSortIcon('id')"
                              class="fas fa-sort-amount-down"
                            ></i
                            ><i
                              v-if="!verifiyedSortIcon('id')"
                              class="fas fa-sort-amount-up"
                            ></i></span
                          >REF
                        </th>

                        <th @click="checkSortingOwnProductsTable('title')">
                          <span v-if="verifyWhereIconShouldBe('title')">
                            <i
                              v-if="verifiyedSortIcon('title')"
                              class="fas fa-sort-amount-down"
                            ></i
                            ><i
                              v-if="!verifiyedSortIcon('title')"
                              class="fas fa-sort-amount-up"
                            ></i></span
                          >Name
                        </th>
                        <th @click="checkSortingOwnProductsTable('quantity')">
                          <span v-if="verifyWhereIconShouldBe('quantity')">
                            <i
                              v-if="verifiyedSortIcon('quantity')"
                              class="fas fa-sort-amount-down"
                            ></i
                            ><i
                              v-if="!verifiyedSortIcon('quantity')"
                              class="fas fa-sort-amount-up"
                            ></i></span
                          >Quantity in stock
                        </th>
                        <th @click="checkSortingOwnProductsTable('price')">
                          <span v-if="verifyWhereIconShouldBe('price')">
                            <i
                              v-if="verifiyedSortIcon('price')"
                              class="fas fa-sort-amount-down"
                            ></i
                            ><i
                              v-if="!verifiyedSortIcon('price')"
                              class="fas fa-sort-amount-up"
                            ></i></span
                          >Price
                        </th>
                        <th
                          @click="checkSortingOwnProductsTable('ratingAverage')"
                        >
                          <span v-if="verifyWhereIconShouldBe('ratingAverage')">
                            <i
                              v-if="verifiyedSortIcon('ratingAverage')"
                              class="fas fa-sort-amount-down"
                            ></i
                            ><i
                              v-if="!verifiyedSortIcon('ratingAverage')"
                              class="fas fa-sort-amount-up"
                            ></i></span
                          >Rating
                        </th>

                        <th @click="checkSortingOwnProductsTable('updated_at')">
                          <span v-if="verifyWhereIconShouldBe('updated_at')">
                            <i
                              v-if="verifiyedSortIcon('updated_at')"
                              class="fas fa-sort-amount-down"
                            ></i
                            ><i
                              v-if="!verifiyedSortIcon('updated_at')"
                              class="fas fa-sort-amount-up"
                            ></i></span
                          >Last Update
                        </th>

                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody style="border: 0">
                      <tr
                        v-for="(userProduct, key) in userProductsSortedData"
                        :key="key"
                      >
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="avatar mx-4 avatar-blue">
                              {{ userProduct.id }}
                            </div>
                          </div>
                        </td>
                        <td>{{ userProduct.title.toUpperCase() }}</td>

                        <td>
                          <div
                            class="badge badge-success"
                            :class="
                              userProduct.quantity > 0
                                ? 'badge-success-alt'
                                : 'badge-warning-alt'
                            "
                          >
                            {{ userProduct.quantity }}
                          </div>
                        </td>
                        <td>{{ userProduct.price }}</td>
                        <td>{{ userProduct.ratingAverage ?? "" }}</td>
                        <td>{{ userProduct.updated_at }}</td>

                        <!-- <td>
              <div class="badge badge-success " :class="userProduct.paymentStatus=='paid' ? 'badge-success-alt' : 'badge-warning-alt'">{{ userProduct.paymentStatus.toUpperCase() }}</div>
            </td> -->

                        <!-- <td>${{ userProduct.amount }}</td> -->
                        <!-- <td>
              <div class="badge badge-success " :class=" orderItemStatus[key] ? 'badge-success-alt' : 'badge-warning-alt'">{{ orderItemStatus[key] ? 'Shipped' : 'In progress ' }}</div>
            </td> -->
                        <td>
                          <div class="dropdown">
                            <button
                              class="btn rounded-pill"
                              @click="getData(userProduct.id)"
                            >
                              Details
                            </button>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div
            v-if="displayGrid == true"
            class="gridDisplayOwnProductsDashboard"
          >
            <div class="row">
              <div class="col-xs-12 col-md-6 col-xl-4"  v-for="(userProduct, key) in userProductsSortedData"
                        :key="key">
                <div class="product-card">
                  <div class="badge">Hot</div>
                  <div class="product-tumb">
                    <img style="width: 100%;height: 100%;object-fit: cover;" v-if="userProduct.product_images.length>0" :src="'/uploads/'+userProduct.product_images[0].path" alt="" />
                  </div>
                  <div class="product-details">
                    <span class="product-catagory">{{ userProduct.category }}</span>
                    <h4><a href="">{{ userProduct.title }}</a></h4>
                    <p>
                      {{ userProduct.description }}
                    </p>
                    <div class="product-bottom-details">
                      <div class="product-price">
                        <!-- <small>$96.00</small>$230.99 -->
                        ${{ userProduct.price }}
                      </div>
                      <div class="product-links">
                        <a href=""><i class="fa fa-heart"></i></a>
                        <a href=""><i class="fa fa-shopping-cart"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="onlySoldProducts py-4" v-if="productStep == 2">
          <div v-if="displayGrid == true" class="invoicesCardsContainer">
            <div class="row m-0 p-0">
              <div
                class="col-md-12 col-xl-6"
                v-for="(userProduct, key) in resultQuerySoldProducts"
                :key="key"
              >
                <div class="padding-bottom-3x mb-1">
                  <div class="card mb-3">
                    <div
                      class="
                        p-4
                        text-center text-white text-lg
                        bg-dark
                        rounded-top
                      "
                    >
                      <span class="text-uppercase"
                        >Tracking sold product No - </span
                      ><span class="text-medium"
                        >TRACKINGREF{{ userProduct.id }}
                      </span>

                      <div class="divPaidOrNo">
                        <img
                          v-if="
                            userProduct.order['paymentStatus'] == 'Paid' &&
                            userProduct.orderItemStatus != 'Cancelled'
                          "
                          style="
                            width: 7%;
                            margin-top: 17px;
                            position: absolute;
                            top: 0;
                            left: 12px;
                          "
                          src="/icons/paid.png"
                          alt=""
                        />
                        <img
                          v-if="
                            userProduct.order['paymentStatus'] != 'Paid' &&
                            userProduct.orderItemStatus != 'Cancelled'
                          "
                          style="
                            width: 7%;
                            margin-top: 17px;
                            position: absolute;
                            top: 0;
                            left: 12px;
                          "
                          src="/icons/exclamation-mark.png"
                          alt=""
                        />
                        <img
                          v-if="userProduct.orderItemStatus == 'Cancelled'"
                          style="
                            width: 20%;
                            margin-top: 17px;
                            position: absolute;
                            top: -8px;
                            left: 12px;
                          "
                          src="/icons/cancelled.png"
                          alt=""
                        />
                      </div>
                    </div>
                    <div
                      class="
                        d-flex
                        flex-wrap flex-sm-nowrap
                        justify-content-between
                        py-3
                        px-2
                        bg-secondary
                      "
                    >
                      <div class="w-100 text-center py-1 px-2">
                        <span class="text-medium">Shipped Via:</span> UPS Ground
                      </div>
                      <div class="w-100 text-center py-1 px-2">
                        <span class="text-medium">Order ID: </span> #{{
                          userProduct.order_id
                        }}
                      </div>
                      <div class="w-100 text-center py-1 px-2">
                        <span class="text-medium">Ordering Date: </span
                        >{{ userProduct.created_at }}
                      </div>
                    </div>
                    <div class="card-body">
                      <div
                        class="
                          steps
                          d-flex
                          flex-wrap flex-sm-nowrap
                          justify-content-between
                          padding-top-2x padding-bottom-1x
                          mb-5
                        "
                      >
                        <div class="gridForShippingAddressAndProductInfo">
                          <div class="BillingInfo">
                            <span
                              style="
                                font-size: 110%;
                                font-weight: bold;
                                margin-left: -20px;
                              "
                              >Billing address :</span
                            >
                            <span>
                              Client ID : <strong>#</strong
                              >{{ userProduct["userDefaultAddress"].id }}
                            </span>
                            <span>
                              {{ userProduct["userDefaultAddress"].name }}
                            </span>
                            <span>
                              {{ userProduct["userWhoBoughtInfo"].email }}
                            </span>

                            <span>
                              {{ userProduct["userDefaultAddress"].phone }}
                            </span>
                            <span>
                              {{ userProduct["userDefaultAddress"].address }}
                            </span>
                            <span
                              v-if="
                                userProduct['userDefaultAddress'].addressComp
                              "
                            >
                              {{
                                userProduct["userDefaultAddress"].addressComp
                              }}
                            </span>
                            <span>
                              {{ userProduct["userDefaultAddress"].city }} ,
                              {{ userProduct["userDefaultAddress"].postalCode }}
                            </span>
                            <span>
                              {{ userProduct["userDefaultAddress"].country }}
                            </span>
                          </div>

                          <div class="shippingAddress">
                            <span
                              style="
                                font-size: 110%;
                                font-weight: bold;
                                margin-left: -20px;
                              "
                              >Shipping address :</span
                            >
                            <span>
                              {{ userProduct["shippingAddress"].name }}
                            </span>
                            <span>
                              {{ userProduct["shippingAddress"].phone }}
                            </span>
                            <span>
                              {{ userProduct["shippingAddress"].address }}
                            </span>
                            <span
                              v-if="userProduct['shippingAddress'].addressComp"
                            >
                              {{
                                userProduct["userDefaultAddress"].addressComp
                              }}
                            </span>
                            <span>
                              {{ userProduct["shippingAddress"].city }} ,
                              {{ userProduct["userDefaultAddress"].postalCode }}
                            </span>
                            <span>
                              {{ userProduct["shippingAddress"].country }}
                            </span>
                          </div>
                        </div>
                      </div>

                      <div
                        class="
                          steps
                          mb-4
                          d-flex
                          flex-wrap flex-sm-nowrap
                          justify-content-between
                          padding-top-2x padding-bottom-1x
                        "
                      >
                        <div class="gridProductInfo">
                          <div class="productInfoSoldProducts">
                            <span
                              style="
                                font-size: 110%;
                                font-weight: bold;
                                margin-left: -20px;
                              "
                              >Product bought :</span
                            >
                            <span>Pro ID: #{{ userProduct.product_id }} </span>
                            <span> {{ userProduct.name }} </span>
                            <span>Qte: x{{ userProduct.quantity }} </span>
                            <span>PUT : ${{ userProduct.price }} </span>
                            <span
                              >Total : ${{
                                (
                                  userProduct.price * userProduct.quantity
                                ).toFixed(2)
                              }}
                            </span>
                          </div>
                          <div class="productInfoImg">
                            <span>
                              <img
                                class="imgTracker"
                                :src="'uploads/' + userProduct.image"
                                alt=""
                              />
                            </span>
                          </div>
                        </div>
                      </div>
                      <div
                        class="
                          steps
                          d-flex
                          flex-wrap flex-sm-nowrap
                          justify-content-between
                          padding-top-2x padding-bottom-1x
                        "
                      >
                        <div
                          class="step"
                          :class="
                            userProduct.orderItemStatus == 'In Progress' ||
                            userProduct.orderItemStatus == 'Shipped' ||
                            userProduct.orderItemStatus == 'In route' ||
                            userProduct.orderItemStatus == 'Arrived'
                              ? 'completed'
                              : ''
                          "
                        >
                          <div class="step-icon-wrap">
                            <div class="step-icon">
                              <span style=""
                                ><i class="fas fa-cart-arrow-down"></i
                              ></span>
                            </div>
                          </div>
                          <h4 class="step-title">Confirmed Order</h4>
                        </div>
                        <div
                          class="step"
                          :class="
                            userProduct.orderItemStatus == 'Shipped' ||
                            userProduct.orderItemStatus == 'In route' ||
                            userProduct.orderItemStatus == 'Arrived'
                              ? 'completed'
                              : ''
                          "
                        >
                          <div class="step-icon-wrap">
                            <div class="step-icon">
                              <span style=""
                                ><i class="fas fa-truck-loading"></i
                              ></span>
                            </div>
                          </div>
                          <h4 class="step-title">Shipped</h4>
                        </div>
                        <div
                          class="step"
                          :class="
                            userProduct.orderItemStatus == 'Arrived' ||
                            userProduct.orderItemStatus == 'In route'
                              ? 'completed'
                              : ''
                          "
                        >
                          <div class="step-icon-wrap">
                            <div class="step-icon">
                              <span style=""><i class="fas fa-route"></i></span>
                            </div>
                          </div>
                          <h4 class="step-title">In route for your client</h4>
                        </div>
                        <div
                          class="step"
                          :class="
                            userProduct.orderItemStatus == 'Arrived'
                              ? 'completed'
                              : ''
                          "
                        >
                          <div class="step-icon-wrap">
                            <div class="step-icon">
                              <span style=""
                                ><i class="fas fa-house-user"></i
                              ></span>
                            </div>
                          </div>
                          <h4 class="step-title">Product Delivered</h4>
                        </div>
                      </div>

                      <div
                        class="steps mb-4"
                        style="display: grid; grid-template-columns: 50% 50%"
                      >
                        <div
                          style="display: flex; justify-content: flex-start"
                          class="btnDetailsD"
                        >
                          <button
                            v-if="
                              userProduct.order.paymentStatus == 'Paid' &&
                              userProduct.orderItemStatus != 'Cancelled'
                            "
                            @click="updateShippingStatus(key)"
                            style="
                              padding: 15px 25px;
                              color: white;
                              background-color: rgb(13, 169, 239);
                            "
                            class="btn rounded-pill detailsBtn"
                          >
                            Update Shipping status
                          </button>
                        </div>
                        <div
                          style="display: flex; justify-content: flex-end"
                          class="btnDetailsD"
                        >
                          <button
                            @click="setInvoiceOrderId(userProduct.order_id)"
                            style="
                              padding: 15px 25px;
                              color: white;
                              background-color: #212529;
                            "
                            class="btn rounded-pill detailsBtn"
                          >
                            Details
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div v-if="displayGrid == false" class="containerOwnProduct">
            <div class="container">
              <div class="row py-5 pt-2">
                <div class="col-12">
                  <table
                    id="DashboardTables"
                    class="table table-hover responsive nowrap"
                    style="width: 100%"
                  >
                    <thead>
                      <tr>
                        <th
                          @click="checkSortingSoldProductsTable('id')"
                          class="mx-2 px-2"
                        >
                          Track REF
                          <span v-if="verifyWhereIconShouldBe('id')">
                            <i
                              v-if="verifiyedSortIcon('id')"
                              class="fas fa-sort-amount-down"
                            ></i
                            ><i
                              v-if="!verifiyedSortIcon('id')"
                              class="fas fa-sort-amount-up"
                            ></i
                          ></span>
                        </th>
                        <th
                          @click="checkSortingSoldProductsTable('product_id')"
                          class="mx-2 px-2"
                        >
                          Pro ID
                          <span v-if="verifyWhereIconShouldBe('product_id')">
                            <i
                              v-if="verifiyedSortIcon('product_id')"
                              class="fas fa-sort-amount-down"
                            ></i
                            ><i
                              v-if="!verifiyedSortIcon('product_id')"
                              class="fas fa-sort-amount-up"
                            ></i
                          ></span>
                        </th>
                        <th
                          @click="checkSortingSoldProductsTable('name')"
                          class="mx-4 px-4"
                        >
                          name
                          <span v-if="verifyWhereIconShouldBe('name')">
                            <i
                              v-if="verifiyedSortIcon('name')"
                              class="fas fa-sort-amount-down"
                            ></i
                            ><i
                              v-if="!verifiyedSortIcon('name')"
                              class="fas fa-sort-amount-up"
                            ></i
                          ></span>
                        </th>
                        <th
                          @click="checkSortingSoldProductsTable('quantity')"
                          class="mx-4 px-4"
                        >
                          Quantity sold
                          <span v-if="verifyWhereIconShouldBe('quantity')">
                            <i
                              v-if="verifiyedSortIcon('quantity')"
                              class="fas fa-sort-amount-down"
                            ></i
                            ><i
                              v-if="!verifiyedSortIcon('quantity')"
                              class="fas fa-sort-amount-up"
                            ></i
                          ></span>
                        </th>
                        <th
                          @click="checkSortingSoldProductsTable('price')"
                          class="mx-4 px-4"
                        >
                          Price
                          <span v-if="verifyWhereIconShouldBe('price')">
                            <i
                              v-if="verifiyedSortIcon('price')"
                              class="fas fa-sort-amount-down"
                            ></i
                            ><i
                              v-if="!verifiyedSortIcon('price')"
                              class="fas fa-sort-amount-up"
                            ></i
                          ></span>
                        </th>
                        <th
                          @click="checkSortingSoldProductsTable('amount')"
                          class="mx-4 px-4"
                        >
                          Amount
                          <span v-if="verifyWhereIconShouldBe('amount')">
                            <i
                              v-if="verifiyedSortIcon('amount')"
                              class="fas fa-sort-amount-down"
                            ></i
                            ><i
                              v-if="!verifiyedSortIcon('amount')"
                              class="fas fa-sort-amount-up"
                            ></i
                          ></span>
                        </th>

                        <th
                          @click="checkSortingSoldProductsTable('created_at')"
                          class="mx-4 px-4"
                        >
                          Date
                          <span v-if="verifyWhereIconShouldBe('created_at')">
                            <i
                              v-if="verifiyedSortIcon('created_at')"
                              class="fas fa-sort-amount-down"
                            ></i
                            ><i
                              v-if="!verifiyedSortIcon('created_at')"
                              class="fas fa-sort-amount-up"
                            ></i
                          ></span>
                        </th>

                        <th
                          @click="checkSortingSoldProductsTable('order_id')"
                          class="mx-4 px-4"
                        >
                          Order ID
                          <span v-if="verifyWhereIconShouldBe('order_id')">
                            <i
                              v-if="verifiyedSortIcon('order_id')"
                              class="fas fa-sort-amount-down"
                            ></i
                            ><i
                              v-if="!verifiyedSortIcon('order_id')"
                              class="fas fa-sort-amount-up"
                            ></i
                          ></span>
                        </th>

                        <th
                          @click="
                            checkSortingSoldProductsTable('orderItemStatus')
                          "
                          class="mx-4 px-4"
                        >
                          <span
                            v-if="verifyWhereIconShouldBe('orderItemStatus')"
                          >
                            <i
                              v-if="verifiyedSortIcon('orderItemStatus')"
                              class="fas fa-sort-amount-down"
                            ></i
                            ><i
                              v-if="!verifiyedSortIcon('orderItemStatus')"
                              class="fas fa-sort-amount-up"
                            ></i></span
                          >Shipping status
                        </th>

                        <th class="mx-4 px-4">Payment status</th>

                        <th class="mx-4 px-4">Actions</th>
                      </tr>
                    </thead>
                    <tbody style="border: 0">
                      <tr
                        v-for="(userProduct, key) in userSoldProductsSortedData"
                        :key="key"
                      >
                        <td>
                          <div
                            style="justify-content: center"
                            class="d-flex align-items-center"
                          >
                            <div class="avatar mx-4 avatar-blue">
                              {{ userProduct.id }}
                            </div>
                          </div>
                        </td>
                        <td>
                          <div
                            style="justify-content: center"
                            class="d-flex align-items-center"
                          >
                            {{ userProduct.product_id }}
                          </div>
                        </td>
                        <td>{{ userProduct.name }}</td>

                        <td>
                          <div
                            class="badge badge-success"
                            :class="
                              userProduct.quantity > 0
                                ? 'badge-success-alt'
                                : 'badge-warning-alt'
                            "
                          >
                            {{ userProduct.quantity }}
                          </div>
                        </td>
                        <td>${{ userProduct.price }}</td>
                        <td>
                          ${{
                            (userProduct.quantity * userProduct.price).toFixed(
                              2
                            )
                          }}
                        </td>
                        <td>{{ userProduct.created_at }}</td>
                        <td>
                          <div
                            style="justify-content: center"
                            class="d-flex align-items-center"
                          >
                            <div
                              :class="
                                userProduct.order.paymentStatus == 'Paid'
                                  ? 'avatar-green'
                                  : 'avatar-red'
                              "
                              class="avatar mx-4"
                            >
                              {{ userProduct.order_id }}
                            </div>
                          </div>
                        </td>
                        <td>
                          <div
                            class="badge badge-success"
                            :class="
                              userProduct.orderItemStatus == 'Shipped' || userProduct.orderItemStatus == 'Arrived'
                              || userProduct.orderItemStatus == 'In route' || userProduct.orderItemStatus == 'Confirmed'
                                ? 'badge-success-alt'
                                : 'badge-warning-alt'
                            "
                            v-if="
                              userProduct.order.paymentStatus !=
                              'Waiting for payment'
                            "
                          >
                            {{ userProduct.orderItemStatus.toUpperCase() }}
                          </div>
                        </td>

                        <td>
                          <div
                            class="badge badge-success"
                            :class="
                              userProduct.order.paymentStatus == 'Paid'
                                ? 'badge-success-alt'
                                : 'badge-warning-alt'
                            "
                          >
                            {{
                              userProduct.order.paymentStatus == "Paid"
                                ? "Payment confirmed"
                                : userProduct.order.paymentStatus.toUpperCase()
                            }}
                          </div>
                        </td>

                        <td>
                          <div class="dropdown">
                            <!-- lazem namel l valeu par default mta3 l payment en attente
baaed yeji email lil vendeur fih vous avez une nouvelle order olease verify your account
baaed fil dashboard ken payementStatus =="en attente" afficher button bark procces payement (feha valider wela refuser)
wfil facturation hot zeda l payementStatus -->

                            <div
                              v-if="
                                userProduct.order.paymentStatus !=
                                'Waiting for payment'
                              "
                              class="auxDiv"
                            >
                              <div class="dropdownAux">
                                <a href="javascript:void(0);"
                                  ><i class="fas fa-ellipsis-h"></i
                                ></a>
                                <div class="dropdownAux-menu">
                                  <img
                                    style="
                                      width: 50px;
                                      height: 50px;
                                      cursor: pointer;
                                    "
                                    class="mb-3"
                                    src="icons/tracking.png"
                                    @click="
                                      selectOrderTrackingId(
                                        userProduct.order.id
                                      )
                                    "
                                    v-if="
                                      userProduct.order.paymentStatus !=
                                      'Waiting for payment'
                                    "
                                    alt="Track this order"
                                    title="Track this order"
                                  />
                                  <img
                                    style="
                                      width: 40px;
                                      height: 40px;
                                      cursor: pointer;
                                    "
                                    src="/icons/invoices.png"
                                    @click="
                                      setInvoiceOrderId(userProduct.order.id)
                                    "
                                    v-if="
                                      userProduct.order.paymentStatus !=
                                      'Waiting for payment'
                                    "
                                    alt="Check invoice for this order"
                                    title="Check invoice for this order"
                                  />

                                  <!-- <button
                              @click="setInvoiceOrderId(userProduct.order.id)"
                              class="btn rounded-pill my-2"
                                                            v-if=" userProduct.order.paymentStatus!='Waiting for payment'"

                            >
                              Bill
                            </button> -->
                                </div>
                              </div>
                            </div>

                            <button
                              @click="
                                getCreditCardForPaymentBySwal(
                                  userProduct.CreditCard,
                                  userProduct.order.amount,
                                  userProduct.order.id
                                )
                              "
                              class="btn rounded-pill my-2"
                              v-if="
                                userProduct.order.paymentStatus ==
                                'Waiting for payment'
                              "
                              style="background-color: yellowgreen"
                              alt="Payment proccess for this order"
                              title="Payment proccess for this order"
                            >
                              Payment
                            </button>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div v-if="dashboardStep == 3">
        <ordersPage />
      </div>

      <div v-if="dashboardStep == 4">
        <p class="text-black">sdqsd444444444sqdqqsd</p>
      </div>

      <div v-if="dashboardStep == 5">
        <p class="text-black">sdq55555555sdsqdqqsd</p>
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
                    <div
                      class="input-group inline-group"
                      style="justify-content: start"
                    >
                      <div
                        style="
                          display: flex;
                          flex-direction: column;
                          justify-content: center;
                          align-items: center;
                        "
                      >
                        <input
                          v-model="product.quantity"
                          min="1"
                          class="form-control"
                          @keypress="onlyNumber"
                          type="number"
                          maxlength="6"
                          style="
                            height: 76%;
                            background: rgb(236, 236, 236) none repeat scroll 0%
                              0%;
                            border-radius: 10%;
                            border: medium none;
                            width: 100%;
                            text-align: center;
                          "
                        />
                      </div>

                      <div>
                        <div class="input-group-append">
                          <button
                            @click="product.quantity++"
                            style="
                              padding: 0px 12px;
                              height: 35px;
                              background-color: rgba(0, 0, 0, 0);
                              border: medium none;
                              margin: 0;
                            "
                            class=""
                          >
                            <i class="fas fa-chevron-circle-up menu-icon5"></i>
                          </button>
                        </div>

                        <div class="input-group-prepend">
                          <button
                            @click="
                              product.quantity == 1 ? '' : product.quantity--
                            "
                            style="
                              padding: 0px 12px;
                              height: 35px;
                              background-color: rgba(0, 0, 0, 0);
                              border: medium none;
                              margin: 0;
                            "
                            class=""
                          >
                            <i
                              class="fas fa-chevron-circle-down menu-icon5"
                            ></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="selectGrid">
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
                    <option value="tablets ">Tablets</option>
                    <option value="monitors">Monitors</option>
                    <option value="printers&Scanners ">
                      Printers & Scanners
                    </option>
                    <option value="cameras">Cameras</option>
                    <option value="smartphoneAccessories">
                      Smartphone Accessories
                    </option>
                    <option value="computerAccessories">
                      Computer Accessories
                    </option>
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
              <p v-if="errors.title" class="text-danger mx-2">
                {{ errors.title }}
              </p>
              <p v-if="errors.price" class="text-danger mx-2">
                {{ errors.price }}
              </p>
              <p v-if="errors.category" class="text-danger mx-2">
                {{ errors.category }}
              </p>
              <p v-if="errors.description" class="text-danger mx-2">
                {{ errors.description }}
              </p>
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
import ratingStars from "../products/reviewComponent.vue/ratingStars.vue";

import ordersPage from "../products/orders.vue";
import moment from "moment";
import loadingPage from "../products/loadPage.vue";
import Swal from "sweetalert2";

export default {
  components: { ordersPage, ratingStars, loadingPage },
  data() {
    return {
      productStep: 2,
      config: [],

      dashboardStep: 2,
      connected_user: {},

      userProducts: [],
      loading: true,

      soldProducts: [],

      sortOrderSensDescState: true,

      sortField: "id",
      sortFieldSoldProduct: "order_id",
      auxCountForSorting: 0,

      images: [],
      form: new FormData(),

      product: {
        title: "",
        description: "",
        price: "",
        // image: "",
        user_id: "",
        quantity: 1,
        category: "0",
      },

      errors: {
        title: "",
        description: "",
        price: "",
        // image: "",
        quantity: "",
      },

      urls: [],
      idProduct: "",

      searchQuery: "",

      displayGrid: false,

      orderBySoldProductSelectOptionValue: "0",
    };
  },

  mounted() {
    this.connected_user.id = localStorage.getItem("user_id");
    this.connected_user.useremail = localStorage.getItem("useremail");
    this.connected_user.username = localStorage.getItem("username");
    this.connected_user.role = localStorage.getItem("role");

    this.getProductsForUser();
    this.getSoldProductForUser();
    this.connected_user.token = localStorage.getItem("token");
  },

  computed: {
    resultQuery() {
      if (this.searchQuery) {
        return this.userProducts.filter((item) => {
          return this.searchQuery
            .toLowerCase()
            .split(" ")
            .every((v) => {
              return item.title.toLowerCase().includes(v);
            });
        }); //.sort((a,b) => {return  a.currentSortStatement1 -  b.currentSortStatement2;})
      } else {
        return this.userProducts;
      }
    },

    resultQuerySoldProducts() {
      if (this.searchQuery) {
        if (this.displayGrid == true) {
          return this.soldProducts.filter((item) => {
            return this.searchQuery
              .toLowerCase()
              .split(" ")
              .every((v) => {
                return String(item.order_id) == v;
              });
          });
        }
        return this.soldProducts.filter((item) => {
          return this.searchQuery
            .toLowerCase()
            .split(" ")
            .every((v) => {
              return (
                item.name.toLowerCase().includes(v) ||
                String(item.order_id) == v ||
                String(item.order_id) == v
              );
            });
        }); //.sort((a,b) => {return  a.currentSortStatement1 -  b.currentSortStatement2;})
      } else {
        return this.soldProducts;
      }
    },

    userProductsSortedData: function () {
      if (this.sortOrderSensDescState) {
        let that = "";
        if (this.productStep == 2) {
          that = this.sortFieldSoldProduct;
        } else {
          that = this.sortField;
        }
        return this.resultQuery.sort(function (a, b) {
          if (that == "price") {
            a[that] = parseFloat(a[that]);
            b[that] = parseFloat(b[that]);
          }

          if (that == "title") {
            a[that] = a[that].toUpperCase();
            b[that] = b[that].toUpperCase();
          }
          return a[that] < b[that];
        });
      } else if (!this.sortOrderSensDescState) {
        let that = "";
        if (this.productStep == 2) {
          that = this.sortFieldSoldProduct;
        } else {
          that = this.sortField;
        }
        return this.resultQuery.sort(function (a, b) {
          if (that == "price") {
            a[that] = parseFloat(a[that]);
            b[that] = parseFloat(b[that]);
          }

          if (that == "title") {
            a[that] = a[that].toUpperCase();
            b[that] = b[that].toUpperCase();
          }
          return a[that] > b[that];
        });
      } else {
        return this.userProducts;
      }
    },

    userSoldProductsSortedData: function () {
      if (this.sortOrderSensDescState) {
        let that = this.sortField;
        return this.resultQuerySoldProducts.sort(function (a, b) {
          if (that == "price" || that == "amount") {
            a[that] = parseFloat(a[that]);
            b[that] = parseFloat(b[that]);
          }
          return a[that] < b[that];
        });
      } else if (!this.sortOrderSensDescState) {
        let that = this.sortField;
        return this.resultQuerySoldProducts.sort(function (a, b) {
          if (that == "price" || that == "amount") {
            a[that] = parseFloat(a[that]);
            b[that] = parseFloat(b[that]);
          }
          return a[that] > b[that];
        });
      } else {
        return this.resultQuerySoldProducts;
      }
    },
  },

  methods: {
    selectOrderTrackingId(id) {
      this.orderSelectedState = true;
      this.searchQuery = String(id);
      this.displayGrid = true;
    },
    verifyWhereIconShouldBe(where) {
      return this.sortField == where;
    },

    verifiyedSortIcon(field) {
      if (this.sortField == field && this.sortOrderSensDescState) {
        return true;
      }
      console.log("gggggggg");

      return false;
    },

    checkSortingSoldProductsTable(whichSort) {
      if (whichSort == this.sortField && this.auxCountForSorting == 0) {
        this.sortOrderSensDescState = true;
        this.auxCountForSorting++;
      } else {
        this.auxCountForSorting = 0;
        this.sortOrderSensDescState = false;
      }

      this.sortField = whichSort;
      console.log(this.sortOrderSensDescState, "hahah ", this.sortField);
    },
    checkSortingOwnProductsTable(whichSort) {
      if (whichSort == this.sortField && this.auxCountForSorting == 0) {
        this.sortOrderSensDescState = true;
        this.auxCountForSorting++;
      } else {
        this.auxCountForSorting = 0;
        this.sortOrderSensDescState = false;
      }

      this.sortField = whichSort;
      console.log(this.sortOrderSensDescState, "hahah ", this.sortField);
    },
    getData(id) {
      this.idProduct = id;

      let routeNewTab = this.$router.resolve({ name: "product-card" });
      window.open(routeNewTab.href + "/?product_id=" + id, "_blank");
    },

    WithoutTime(dateTime) {
      return moment(String(dateTime)).format("DD/MM/YYYY");
    },
    getProductsForUser() {
      console.log(this.connected_user);

      axios
        .post("api/getProductsForOneUser", this.connected_user)
        .then((response) => {
          response.data.products.forEach((element) => {
            this.userProducts.push(element);
          });

          this.userProducts.forEach((element, key) => {
            this.config.push({
              keyId: key,
              rating: element.ratingAverage,
              ratingCount: element.ratingAverage,
              isIndicatorActive: true,
              style: {
                fullStarColor: "#ed8a19",
                emptyStarColor: "#737373",
                starWidth: 30,
                starHeight: 30,
              },
            });
          });

          this.loading = false;

          console.log("daata", this.config);
        })
        .catch((err) => {});
    },

    setInvoiceOrderId(x) {
      localStorage.setItem("invoiceOrderId", x);
      let routeNewTab = this.$router.resolve({ name: "orderBill" });
      window.open(routeNewTab.href, "_blank");
    },

    getSoldProductForUser() {
      this.soldProducts = [];
      this.loading = true;
      this.connected_user.token = localStorage.getItem("token");

      let config = {
        headers: {
          Authorization: `Bearer ${this.connected_user.token}`,
        },
      };

      axios
        .post("api/getUserSoldProduct", this.connected_user, config)
        .then((response) => {
          console.log("daafdgdfgfdgfdfgta", response.data.soldItems);

          response.data.soldItems.forEach((element) => {
            this.soldProducts.push(element);
          });

          this.soldProducts.forEach((element) => {
            element.amount = (element.quantity * element.price).toFixed(2);
          });

          this.loading = false;
        })
        .catch((err) => {});

      console.log("soldProducts", this.soldProducts);
    },

    hasError(item) {
      // console.log(this.errors[item]);
      if (this.errors[item] != "") {
        return true;
      } else {
        return false;
      }
    },

    addProduct() {
      this.product.user_id = localStorage.getItem("user_id");
      console.log(this.product);
      let config = {
        headers: {
          Authorization: `Bearer ${this.connected_user.token}`,
        },
      };

      axios
        .post("api/products ", this.product, config)
        .then((response) => {
          this.idProduct = response.data.idProductValue.id;
          console.log("adeeeeeeeeed ssuuuccceesss", this.idProduct);
          Swal.fire({
            position: "bottom-end",
            icon: "success",
            title: "Your annonce has been saved",
            showConfirmButton: false,
            timer: 2000,
            customClass: { popup: "swal2-border-radius" },
          });
          this.addImages();
          this.urls = [];
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
                this.errors.category =
                  error.response.data.errors.category[0] ?? "";
              } else {
                this.errors.category = "";
              }
            }
            //console.log(this.errors);
          } //  console.log("error");
        });
    },

    addImages() {
      console.log("aaaaadddddddd");
      for (let i = 0; i < this.images.length; i++) {
        this.form.append("images[]", this.images[i]);
      }

      this.form.append("productName", this.product.title);
      this.form.append("idProduct", this.idProduct);
      let config = {
        headers: {
          Authorization: `Bearer ${this.connected_user.token}`,
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

          this.$refs.images.value = null;
        })
        .catch((error) => {
          if (error.response) {
            if (error.response.data.errors) {
            }
            //console.log(this.errors);
          } //  console.log("error");
        });
    },

    onlyNumber($event) {
      if (String(this.product.price).length > 7) {
        $event.preventDefault();
      }

      console.log($event.keyCode); //keyCodes value
      let keyCode = $event.keyCode ? $event.keyCode : $event.which;
      if ((keyCode < 48 || keyCode > 57) && keyCode !== 46) {
        // 46 is dot
        $event.preventDefault();
      }
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

    updateShippingStatus(orderItemId) {
      this.soldProducts[orderItemId];
      let config = {
        headers: {
          Authorization: `Bearer ${this.connected_user.token}`,
        },
      };
      let that = this;

      let id = orderItemId;
      console.log('fffffff',this.soldProducts[orderItemId].order.user_id);
     let variableAux = {
        user_id: 0,
        orderItemId: this.soldProducts[orderItemId].id,
        orderItemStatus: "",
      };

      variableAux.user_id=this.soldProducts[orderItemId].order.user_id;

      console.log(variableAux, "heeeeerrrre");
      Swal.fire({
        title: "Update shipping status",
        html: `
    <h5>Tracking RFF : TRACKINGREF${id} </h5>
    <select id="shippingStatusValue">
	<option value="In Progress">Not Shipped</option>
	<option value="Shipped">Shipped</option>
	<option value="In route">In route</option>
	<option value="Arrived">Arrived to custumer</option>
    </select>`,
        confirmButtonText: "Save changes",
        confirmButtonColor: "#3085d6",
        cancelButtonText: "close",
        showCancelButton: true,
        cancelButtonColor: "#d33",

        focusConfirm: true,
        preConfirm: () => {
          const shippingStatusValue = Swal.getPopup().querySelector(
            "#shippingStatusValue"
          ).value;
          variableAux.orderItemStatus = shippingStatusValue;
          return shippingStatusValue;
        },
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "Are you update the shipping status for ?",
            html:
              "<p>Tracking Ref : TRACKINGREF" +
              id +
              "</p><p>To : " +
              variableAux.orderItemStatus +
              "</p>",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Update",
          }).then((result) => {
            if (result.isConfirmed) {
              axios
                .post("api/updateOrderItemShippingState", variableAux, config)
                .then((result) => {
                  axios.post(
                    "api/sendEmailShippingStatusChanged",
                    variableAux,
                    config
                  );
                  Swal.fire({
                    title: "Shipping status updated successfuly",
                    html:
                      "<p>Tracking Ref : TRACKINGREF" +
                      id +
                      "</p><p>To : " +
                      variableAux.orderItemId +
                      "</p>",
                    icon: "success",
                    showCancelButton: false,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Got it",
                  }).then((result) => {
                    if (result.isConfirmed) {
                      that.getSoldProductForUser();
                    }
                  });
                });
            }
          });
        }
      });

    },

    getCreditCardForPaymentBySwal(creditCard, order_amount, order_id) {
      console.log(creditCard);
      let nameOfCard = creditCard.nameOfCard;
      let cardNumber = creditCard.cardNumber;
      let cardExpDate = creditCard.cardExpDate;
      let cardType = creditCard.cardType;
      let cardCvvCode = creditCard.cardCvvCode;
      let amount = order_amount;
      let orderId = order_id;

      let that = this;

      let config = {
        headers: {
          Authorization: `Bearer ${this.connected_user.token}`,
        },
      };

      let updateOrderStatus = {
        order_id: orderId,
        paymentStatus: "Paid",
        orderItemStatus: "In progress",
      };
      Swal.fire({
        title: "Credit Card",
        html:
          "<strong>Order ID : " +
          order_id +
          "</strong><br><strong>Amount : $" +
          amount +
          "</strong><br><p>Please proccess to the payment to validate this order<p>Once he is validate you will not be able to cancel it !<br>" +
          cardType +
          "<br>" +
          nameOfCard +
          "<br>" +
          cardNumber +
          "<br>" +
          cardExpDate +
          "<br>" +
          cardCvvCode,
        icon: "info",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Validate payment",
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "Validate payment for this product",
            text: "Please validate for the second time to be sure",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes",
          }).then((result) => {
            if (result.isConfirmed) {
              axios
                .post(
                  "api/updateOrderStatusAndOrderItemStatus",
                  updateOrderStatus,
                  config
                )
                .then((result) => {
                  that.getSoldProductForUser();
                });

              Swal.fire({
                title: "Validated successfuly",
                text: "Validated successfuly",
                icon: "success",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "close",
              });
            }
          });
        }
      });
    },
  },
};
</script>






<style >
</style>
