<template>
  <div>
    <div class="loaderDiv" v-if="loading">
      <loadingPage />
    </div>
    <div
      v-if="!loading"
      class="container p-sm-0 m-sm-0"
      style="display: contents"
    >
      <div class="OrdersDashboard">
        <nav class="navbar navbar-light bg-light">
          <form class="container-fluid justify-content-start">
            <button
              class="btn"
              type="button"
              @click="resetVariables()"
              :class="orderStep == 1 ? 'btnActive' : ''"
            >
              Orders history
            </button>
            <button
              class="btn"
              type="button"
              @click="orderStep = 2"
              :class="orderStep == 2 ? 'btnActive' : ''"
            >
              Orders Tracking
            </button>
          </form>
        </nav>
      </div>
      <div class="container-fluid mt-5">
        <div class="row w-100">
          <div class="col-md-12 colOrders px-3 px-sm-0 orderTable">
            <div class="container">
              <div class="row py-5 pt-2">
                <div class="col-12">
                  <table
                    v-if="orderStep == 1"
                    id="DashboardTables"
                    class="table table-hover responsive nowrap"
                    style="width: 100%"
                  >
                    <thead>
                      <tr>
                        <th
                          @click="checkSortingOrdersOrder('id')"
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
                          >ID Order
                        </th>
                        <th
                          @click="checkSortingOrdersOrder('paymentId')"
                          class="mx-2 px-2"
                        >
                          <span v-if="verifyWhereIconShouldBe('paymentId')">
                            <i
                              v-if="verifiyedSortIcon('paymentId')"
                              class="fas fa-sort-amount-down"
                            ></i
                            ><i
                              v-if="!verifiyedSortIcon('paymentId')"
                              class="fas fa-sort-amount-up"
                            ></i></span
                          >PaymentID
                        </th>

                        <th @click="checkSortingOrdersOrder('created_at')">
                          <span v-if="verifyWhereIconShouldBe('created_at')">
                            <i
                              v-if="verifiyedSortIcon('created_at')"
                              class="fas fa-sort-amount-down"
                            ></i
                            ><i
                              v-if="!verifiyedSortIcon('created_at')"
                              class="fas fa-sort-amount-up"
                            ></i></span
                          >Date
                        </th>
                        <th @click="checkSortingOrdersOrder('paymentStatus')">
                          <span v-if="verifyWhereIconShouldBe('paymentStatus')">
                            <i
                              v-if="verifiyedSortIcon('paymentStatus')"
                              class="fas fa-sort-amount-down"
                            ></i
                            ><i
                              v-if="!verifiyedSortIcon('paymentStatus')"
                              class="fas fa-sort-amount-up"
                            ></i></span
                          >Payement
                        </th>

                        <th @click="checkSortingOrdersOrder('amount')">
                          <span v-if="verifyWhereIconShouldBe('amount')">
                            <i
                              v-if="verifiyedSortIcon('amount')"
                              class="fas fa-sort-amount-down"
                            ></i
                            ><i
                              v-if="!verifiyedSortIcon('amount')"
                              class="fas fa-sort-amount-up"
                            ></i></span
                          >Amount
                        </th>
                        <th @click="checkSortingOrdersOrder('created_at')">
                          <span v-if="verifyWhereIconShouldBe('created_at')">
                            <i
                              v-if="verifiyedSortIcon('created_at')"
                              class="fas fa-sort-amount-down"
                            ></i
                            ><i
                              v-if="!verifiyedSortIcon('created_at')"
                              class="fas fa-sort-amount-up"
                            ></i></span
                          >Shipping Status
                        </th>
                        <th @click="checkSortingOrdersOrder('orderStatus')">
                          <span v-if="verifyWhereIconShouldBe('orderStatus')">
                            <i
                              v-if="verifiyedSortIcon('orderStatus')"
                              class="fas fa-sort-amount-down"
                            ></i
                            ><i
                              v-if="!verifiyedSortIcon('orderStatus')"
                              class="fas fa-sort-amount-up"
                            ></i></span
                          >Order Status
                        </th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody style="border: 0">
                      <tr v-for="(order, key) in ordersSorted" :key="key">
                        <td>
                          <div class="d-flex align-items-center">
                            <div
                              :class="
                                order.paymentStatus == 'Paid'
                                  ? 'avatar-blue'
                                  : 'avatar-pink'
                              "
                              class="avatar mx-4"
                            >
                              {{ order.id }}
                            </div>
                          </div>
                        </td>
                        <td>{{ order.paymentId }}</td>

                        <td>{{ order.created_at }}</td>

                        <td>
                          <div
                            class="badge badge-success"
                            :class="
                              order.paymentStatus == 'Paid'
                                ? 'badge-success-alt'
                                : 'badge-warning-alt'
                            "
                          >
                            {{ order.paymentStatus.toUpperCase() }}
                          </div>
                        </td>

                        <td>${{ order.amount }}</td>
                        <td>
                          <div
                            class="badge badge-success"
                            :class="
                              order.orderStatus != 'Cancelled' &&
                              order.orderStatus != 'Wainting for payment'
                                ? 'badge-success-alt'
                                : 'badge-warning-alt'
                            "
                          >
                            {{ order.orderStatus.toUpperCase() }}
                          </div>
                        </td>

                        <td>
                          <div
                            class="badge badge-success"
                            :class="
                              order.orderStatus != 'Cancelled' &&
                              order.orderStatus != 'Wainting for payment'
                                ? 'badge-success-alt'
                                : 'badge-warning-alt'
                            "
                          >
                            {{ order.orderStatus.toUpperCase() }}
                          </div>
                        </td>
                        <td>
                          <div class="dropdown">
                            <div class="auxDiv">
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
                                    @click="selectOrderTrackingId(order.id)"
                                    alt="Track your order"
                                    title="Track your order"
                                  />
                                  <br />
                                  <img
                                    style="
                                      width: 40px;
                                      height: 40px;
                                      cursor: pointer;
                                    "
                                    class="mb-3"
                                    src="/icons/invoices.png"
                                    @click="setInvoiceOrderId(order.id)"
                                    alt="Check invoice for this order"
                                    title="Check invoice for this order"
                                  />
                                  <br />
                                  <img
                                    style="
                                      width: 40px;
                                      height: 40px;
                                      cursor: pointer;
                                    "
                                    alt="Cancel this order"
                                    title="Cancel this order"
                                    src="/icons/cancelIcon2.png"
                                    @click="
                                      cancelAnOrderBeforeShipping(order.id)
                                    "
                                    v-if="order.orderStatus != 'Cancelled'"
                                  />

                                  <br />
                                </div>
                              </div>
                            </div>

                            <!-- <button
                              @click="selectOrderTrackingId(order.id)"
                              class="btn  rounded-pill my-2"
                              style="background-color:rgb(33 37 41);"
                            >
                              Track order
                            </button>
                            <button
                              @click="setInvoiceOrderId(order.id)"
                              class="btn rounded-pill my-2"
                            >
                              Bill details
                            </button>

                             <button
                              @click="cancelAnOrderBeforeShipping(order.id)"
                              class="btn btn-danger rounded-pill my-2"
                              style="background-color:#f44336;"
                            >
                              Cancel
                            </button> -->
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>

                  <div
                    v-if="orderStep == 2"
                    class="phoneResponsiveCardsOrders text-dark"
                  >
                    <div class="containerCardsOrders">
                      <div>
                        <div class="wrapper">
                          <div class="label">Search for an order by REF</div>
                          <div class="searchBar">
                            <input
                              @input="resetVariables2()"
                              id="searchQueryInput"
                              v-model="orderSearchValue"
                              type="text"
                              name="searchQueryInput"
                              placeholder="Search"
                            />
                            <button
                              id="searchQuerySubmit"
                              type="submit"
                              name="searchQuerySubmit"
                            >
                              <svg
                                style="width: 24px; height: 24px"
                                viewBox="0 0 24 24"
                              >
                                <path
                                  fill="#666666"
                                  d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z"
                                />
                              </svg>
                            </button>
                          </div>
                        </div>
                      </div>
                      <div class="row w-100 m-0 p-0">
                        <div
                          v-if="searchResult.length == 0"
                          class="col-12 py-5 text-center"
                        >
                          No Result found
                        </div>
                        <div
                          v-if="searchResult.length > 0 && orderSelectedState"
                          style="
                            display: flex;
                            justify-content: flex-end;
                            width: 93%;
                          "
                          class="col-12 p-3 text-right"
                        >
                          <span
                            style="
                              background-color: #b7b7b7;
                              color: white;
                              padding: 9px 30px;
                            "
                            >{{ searchResult.length }} item(s) in this
                            order</span
                          >
                        </div>

                        <div class="invoicesCardsContainer">
                          <div class="row m-0 p-0">
                            <div
                              class="col-md-12 col-xl-6"
                              v-for="(userProduct, key) in searchResult"
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
                                      >Tracking No - </span
                                    ><span class="text-medium"
                                      >TRACKINGREF{{ userProduct.id }}
                                    </span>
                                    <div class="divPaidOrNo">
                                      <img
                                        v-if="
                                          userProduct.order['paymentStatus'] ==
                                          'Paid'
                                            &&
                                             userProduct.orderItemStatus !=
                                          'Cancelled'
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
                                          userProduct.order['paymentStatus'] !=
                                          'Paid'
                                            &&
                                             userProduct.orderItemStatus !=
                                          'Cancelled'
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
                                        v-if="
                                          userProduct.orderItemStatus ==
                                          'Cancelled'
                                        "
                                       style="width: 27%;margin-top: 17px;position: absolute;top: -8px;left: 12px;"
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
                                      <span class="text-medium"
                                        >Shipped Via:</span
                                      >
                                      UPS Ground
                                    </div>
                                    <div class="w-100 text-center py-1 px-2">
                                      <span class="text-medium"
                                        >Order ID:
                                      </span>
                                      #{{ userProduct.order_id }}
                                    </div>
                                    <div class="w-100 text-center py-1 px-2">
                                      <span class="text-medium"
                                        >Ordering Date: </span
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
                                      <div
                                        class="
                                          gridForShippingAddressAndProductInfo
                                        "
                                      >
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
                                            >{{
                                              userProduct["userDefaultAddress"]
                                                .id
                                            }}
                                          </span>
                                          <span>
                                            {{
                                              userProduct["userDefaultAddress"]
                                                .name
                                            }}
                                          </span>
                                          <span>
                                            {{
                                              userProduct["userWhoBoughtInfo"]
                                                .email
                                            }}
                                          </span>

                                          <span>
                                            {{
                                              userProduct["userDefaultAddress"]
                                                .phone
                                            }}
                                          </span>
                                          <span>
                                            {{
                                              userProduct["userDefaultAddress"]
                                                .address
                                            }}
                                          </span>
                                          <span
                                            v-if="
                                              userProduct['userDefaultAddress']
                                                .addressComp
                                            "
                                          >
                                            {{
                                              userProduct["userDefaultAddress"]
                                                .addressComp
                                            }}
                                          </span>
                                          <span>
                                            {{
                                              userProduct["userDefaultAddress"]
                                                .city
                                            }}
                                            ,
                                            {{
                                              userProduct["userDefaultAddress"]
                                                .postalCode
                                            }}
                                          </span>
                                          <span>
                                            {{
                                              userProduct["userDefaultAddress"]
                                                .country
                                            }}
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
                                            {{
                                              userProduct["shippingAddress"]
                                                .name
                                            }}
                                          </span>
                                          <span>
                                            {{
                                              userProduct["shippingAddress"]
                                                .phone
                                            }}
                                          </span>
                                          <span>
                                            {{
                                              userProduct["shippingAddress"]
                                                .address
                                            }}
                                          </span>
                                          <span
                                            v-if="
                                              userProduct['shippingAddress']
                                                .addressComp
                                            "
                                          >
                                            {{
                                              userProduct["shippingAddress"]
                                                .addressComp
                                            }}
                                          </span>
                                          <span>
                                            {{
                                              userProduct["shippingAddress"]
                                                .city
                                            }}
                                            ,
                                            {{
                                              userProduct["shippingAddress"]
                                                .postalCode
                                            }}
                                          </span>
                                          <span>
                                            {{
                                              userProduct["shippingAddress"]
                                                .country
                                            }}
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
                                          <span
                                            >Pro ID: #{{
                                              userProduct.product_id
                                            }}
                                          </span>
                                          <span> {{ userProduct.name }} </span>
                                          <span
                                            >Qte: x{{ userProduct.quantity }}
                                          </span>
                                          <span
                                            >PUT : ${{ userProduct.price }}
                                          </span>
                                          <span
                                            >Total : ${{
                                              (
                                                userProduct.price *
                                                userProduct.quantity
                                              ).toFixed(2)
                                            }}
                                          </span>
                                        </div>
                                        <div class="productInfoImg">
                                          <span>
                                            <img
                                              class="imgTracker"
                                              :src="
                                                'uploads/' + userProduct.image
                                              "
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
                                          userProduct.orderItemStatus ==
                                            'In progress' ||
                                          userProduct.orderItemStatus ==
                                            'Shipped' ||
                                          userProduct.orderItemStatus ==
                                            'In route' ||
                                          userProduct.orderItemStatus ==
                                            'Arrived'
                                            ? 'completed'
                                            : ''
                                        "
                                      >
                                        <div class="step-icon-wrap">
                                          <div class="step-icon">
                                            <span style=""
                                              ><i
                                                class="fas fa-cart-arrow-down"
                                              ></i
                                            ></span>
                                          </div>
                                        </div>
                                        <h4 class="step-title">
                                          Confirmed Order
                                        </h4>
                                      </div>
                                      <div
                                        class="step"
                                        :class="
                                          userProduct.orderItemStatus ==
                                            'Shipped' ||
                                          userProduct.orderItemStatus ==
                                            'In route' ||
                                          userProduct.orderItemStatus ==
                                            'Arrived'
                                            ? 'completed'
                                            : ''
                                        "
                                      >
                                        <div class="step-icon-wrap">
                                          <div class="step-icon">
                                            <span style=""
                                              ><i
                                                class="fas fa-truck-loading"
                                              ></i
                                            ></span>
                                          </div>
                                        </div>
                                        <h4 class="step-title">Shipped</h4>
                                      </div>
                                      <div
                                        class="step"
                                        :class="
                                          userProduct.orderItemStatus ==
                                            'In route' ||
                                          userProduct.orderItemStatus ==
                                            'Arrived'
                                            ? 'completed'
                                            : ''
                                        "
                                      >
                                        <div class="step-icon-wrap">
                                          <div class="step-icon">
                                            <span style=""
                                              ><i class="fas fa-route"></i
                                            ></span>
                                          </div>
                                        </div>
                                        <h4 class="step-title">
                                          In route for your client
                                        </h4>
                                      </div>
                                      <div
                                        class="step"
                                        :class="
                                          userProduct.orderItemStatus ==
                                          'Arrived'
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
                                        <h4 class="step-title">
                                          Product Delivered
                                        </h4>
                                      </div>
                                    </div>

                                    <div
                                      class="steps mb-4"
                                      style="display: flex"
                                    >
                                      <div
                                        class="productInfoSoldProducts"
                                        style="
                                          display: flex;
                                          flex-direction: column;
                                        "
                                      >
                                        <span
                                          style="
                                            font-size: 110%;
                                            font-weight: bold;
                                            margin-left: -20px;
                                          "
                                          >Seller info :</span
                                        >
                                        <span
                                          >User ID: #{{
                                            userProduct["sellerUser"].id
                                          }}
                                        </span>
                                        <span
                                          >{{ userProduct["sellerUser"].email }}
                                        </span>
                                        <span>
                                          {{ userProduct["sellerUser"].name }}
                                        </span>
                                        <span>
                                          {{
                                            userProduct["sellerUserAddress"]
                                              .phone
                                          }}
                                        </span>
                                        <span>
                                          {{
                                            userProduct["sellerUserAddress"]
                                              .address
                                          }}
                                        </span>
                                        <span
                                          v-if="
                                            userProduct['sellerUserAddress']
                                              .addressComp
                                          "
                                        >
                                          {{
                                            userProduct["sellerUserAddress"]
                                              .addressComp
                                          }}
                                        </span>
                                        <span>
                                          {{
                                            userProduct["sellerUserAddress"]
                                              .city
                                          }}
                                          ,
                                          {{
                                            userProduct["sellerUserAddress"]
                                              .postalCode
                                          }}
                                        </span>
                                        <span>
                                          {{
                                            userProduct["sellerUserAddress"]
                                              .country
                                          }}
                                        </span>
                                      </div>
                                    </div>

                                    <div
                                      class="steps mb-4"
                                      style="
                                        display: grid;
                                        grid-template-columns: 50% 50%;
                                      "
                                    >
                                      <div
                                        style="
                                          display: flex;
                                          justify-content: flex-start;
                                        "
                                        class="btnDetailsD"
                                      >
                                        <button
                                          v-if="
                                            userProduct.orderItemStatus !=
                                            'Cancelled'
                                          "
                                          @click="
                                            cancelAnOrderBeforeShipping(
                                              userProduct.id,
                                              userProduct.order_id
                                            )
                                          "
                                          style="
                                            padding: 15px 25px;
                                            color: white;
                                            background-color: #f44336;
                                          "
                                          class="btn rounded-pill detailsBtn"
                                        >
                                          Cancel this order item
                                        </button>
                                      </div>
                                      <div
                                        style="
                                          display: flex;
                                          justify-content: flex-end;
                                        "
                                        class="btnDetailsD"
                                      >
                                        <button
                                          @click="
                                            setInvoiceOrderId(
                                              userProduct.order_id
                                            )
                                          "
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

                        <!-- <div
                          v-for="(order, key) in searchResult"
                          :key="key"
                          style="display: flex; justify-content: center"
                          class="col-12"
                        >
                          <div class="container px-1 px-md-4 pb-4 mx-auto">
                            <div class="card">
                              <div
                                class="
                                  row
                                  d-flex
                                  justify-content-between
                                  px-3
                                  top
                                "
                              >
                                <div class="d-flex">
                                  <h5>
                                    ORDER
                                    <span class="text-primary font-weight-bold"
                                      >#{{ order.order_id }}</span
                                    >
                                  </h5>
                                </div>
                                <div class="d-flex flex-column text-sm-right">
                                  <p class="mb-0">
                                    Confirmation date
                                    <span>: {{ order.created_at }}</span>
                                  </p>
                                  <p class="mb-0">
                                    Expected Arrival <span>01/12/19</span>
                                  </p>
                                  <p class="mb-0">
                                    Product :<span
                                      >{{ order.name.toUpperCase() }} / #{{
                                        order.product_id
                                      }}</span
                                    >
                                  </p>
                                  <p class="mb-0 imgTrackerProduct">
                                    <img
                                      v-if="
                                        order.image != 'products/default.png'
                                      "
                                      :src="'uploads/' + order.image"
                                      alt=""
                                    />
                                  </p>
                                </div>
                              </div>
                              <div class="row d-flex justify-content-center">
                                <div class="col-12">
                                  <ul id="progressbar" class="text-center">
                                    <li class="active step0"></li>
                                    <li
                                      :class="
                                        order.orderItemStatus != 'Not shipped'
                                          ? 'active'
                                          : ''
                                      "
                                      class="step0"
                                    ></li>
                                    <li
                                      :class="
                                        order.orderItemStatus != 'Not shipped'
                                          ? 'active'
                                          : ''
                                      "
                                      class="step0"
                                    ></li>
                                    <li
                                      :class="
                                        order.orderItemStatus == 'Shipped'
                                          ? 'active'
                                          : ''
                                      "
                                      class="step0"
                                    ></li>
                                  </ul>
                                </div>
                              </div>
                              <div
                                class="row m-0 p-4 row-cols-sm-2 row-cols-md-4"
                                style="
                                  display: flex;
                                  align-items: baseline;
                                  justify-content: space-between;
                                "
                              >
                                <div class="row d-flex icon-content">
                                  <img
                                    class="icon"
                                    src="icons/orderConfirmed.png"
                                  />
                                  <div class="d-flex flex-column">
                                    <p
                                      style="text-align: center"
                                      class="pLabel font-weight-bold"
                                    >
                                      Confirmed
                                    </p>
                                  </div>
                                </div>
                                <div class="row d-flex icon-content">
                                  <img class="icon" src="/icons/shipped.png" />
                                  <div class="d-flex flex-column">
                                    <p
                                      class="pLabel font-weight-bold"
                                      style="text-align: center"
                                    >
                                      Shipped
                                    </p>
                                  </div>
                                </div>
                                <div class="row d-flex icon-content">
                                  <img class="icon" src="/icons/map.png" />
                                  <div class="d-flex flex-column">
                                    <p
                                      style="text-align: center"
                                      class="pLabel font-weight-bold"
                                    >
                                      In Route
                                    </p>
                                  </div>
                                </div>
                                <div class="row d-flex icon-content">
                                  <img class="icon" src="/icons/arrived.png" />
                                  <div class="d-flex flex-column">
                                    <p
                                      style="text-align: center"
                                      class="pLabel font-weight-bold"
                                    >
                                      Arrived
                                    </p>
                                  </div>
                                </div>

                                <div class="text-center dropdown w-100">
                                  <button
                                    @click="setInvoiceOrderId(order.order_id)"
                                    class="btn rounded-pill"
                                  >
                                    Order invoice
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
 -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!--

            <div class="table-responsive">
              <table id="myTable" class="table">
                <thead
                  style="background-color: #33a889 !important; color: white"
                  v-if="orders.length > 0"
                >
                  <tr>
                    <th>Date</th>

                    <th>Order ID</th>

                    <th>Ref payment</th>
                    <th>
                      <span style="margin-left: 38px">Status</span>
                    </th>
                    <th>Number Of Products</th>
                    <th style="display: flex; justify-content: end">
                      <span id="amount" class="amount">Amount</span>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="order in orders" :key="order.id" class="m-4">
                    <td>
                      {{ order.created_at }}
                    </td>

                    <td>
                      <span>{{ order.id }}</span>
                    </td>
                    <td>
                      <span>{{ order.paymentId }}</span>
                    </td>
                    <td>
                      <div class="button-container">
                        <span type="text" class="px-5">
                          {{ order.paymentStatus.toUpperCase() }}
                        </span>
                      </div>
                    </td>
                    <td>
                      <span class="amount"
                        >{{ order["order_items"].length }}
                      </span>
                    </td>
                    <td align="right">
                      $
                      <span id="amount" class="amount">{{ order.amount }}</span>
                    </td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr v-if="orders.length > 0">
                    <td colspan="4"></td>
                    <td colspan="2" style="text-align: center">
                      <strong>
                        $
                        <span id="total" class="total">
                          {{ total.toFixed(2) }}</span
                        ></strong
                      >
                    </td>
                  </tr>

                  <tr v-if="orders.length == 0" style="height: 20vw">
                    <td align="center" colspan="5" class="p-5">
                      <strong>No product bought</strong>
                    </td>
                  </tr>
                  <tr v-if="orders.length == 0">
                    <td align="center" colspan="5" class="p-5">
                      <router-link to="/products"
                        ><button class="btn btn-dark">
                          Find product to buy ?
                        </button>
                      </router-link>
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>













<script>
import loadingPage from "./loadPage.vue";
import Swal from "sweetalert2";

export default {
  components: {
    loadingPage,
  },
  data() {
    return {
      orderSearchValue: "",
      loading: true,
      orders: [],
      connected_user: {
        user_id: "",
      },
      sortOrderSensDescState: false,

      sortField: "id",
      orderItemStatus: [],

      arrayForSorting: [],
      searchOrderArray: [],
      orderStep: 1,

      orderSelectedState: false,
    };
  },
  mounted() {
    if (localStorage.getItem("token").length == 0) {
      this.$router.push("/");
    } else {
      this.getOrders();
    }
  },

  computed: {
    searchResult: function () {
      if (this.orderSearchValue) {
        if (!this.orderSelectedState) {
          return this.searchOrderArray.filter((item) => {
            return this.orderSearchValue
              .toLowerCase()
              .split(" ")
              .every((v) => String(item.order_id).includes(String(v)));
          }); //.sort((a,b) => {return  a.currentSortStatement1 -  b.currentSortStatement2;})
        } else {
          return this.searchOrderArray.filter((item) => {
            return this.orderSearchValue
              .toLowerCase()
              .split(" ")
              .every((v) => String(item.order_id) == String(v));
          });
        }
      } else {
        return this.searchOrderArray;
      }
    },
    ordersSorted: function () {
      if (this.sortOrderSensDescState) {
        let that = this.sortField;
        return this.arrayForSorting.sort(function (a, b) {
          if (that == "price") {
            a[that] = parseFloat(a[that]);
            b[that] = parseFloat(b[that]);
          }
          return a[that] < b[that];
        });
      } else if (!this.sortOrderSensDescState) {
        let that = this.sortField;
        return this.arrayForSorting.sort(function (a, b) {
          if (that == "price") {
            a[that] = parseFloat(a[that]);
            b[that] = parseFloat(b[that]);
          }
          return a[that] > b[that];
        });
      } else {
        return this.arrayForSorting;
      }
    },
  },
  methods: {
    resetVariables() {
      this.orderStep = 1;
      this.orderSelectedState = false;
      this.orderSearchValue = "";
    },

    resetVariables2() {
      this.orderSelectedState = false;
    },
    selectOrderTrackingId(id) {
      this.orderSelectedState = true;
      this.orderSearchValue = String(id);
      this.orderStep = 2;
    },

    setInvoiceOrderId(x) {
      localStorage.setItem("invoiceOrderId", x);
      let routeNewTab = this.$router.resolve({ name: "orderBill" });
      window.open(routeNewTab.href, "_blank");
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

    checkSortingOrdersOrder(whichSort) {
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

    getOrders() {
      this.orders = [];

      this.connected_user.user_id = localStorage.getItem("user_id");
      this.token = localStorage.getItem("token");

      let config = {
        headers: {
          Authorization: `Bearer ${this.token}`,
        },
      };

      axios
        .post("api/orders", this.connected_user, config)
        .then((response) => {
          //console.log(response.data.cartItems);
          response.data.orders.forEach((order) => {
            this.orders.push(order);
            this.arrayForSorting.push(order);

            axios
              .post("api/OrderItems", order, config)
              .then((response) => {
                response.data.orderItems.forEach((element) => {
                  this.searchOrderArray.push(element);
                  this.loading = false;
                });
              })
              .catch((err) => {});

            let state = false;
            order.order_items.forEach((order_item) => {
              //   if (order_item.orderItemStatus == "Shipped") {
              //     state = true;
              //   } else {
              //     return (state = false);
              //   }
            });
            console.log(this.orders, "gfdgfdgg");
            // this.orderItemStatus.push(state);
          });
          this.loading = false;

          console.log("rfdettzertz", this.orders);
        })
        .catch((err) => {
          this.loading = false;
        });
    },

    cancelAnOrderBeforeShipping(orderItemId, orderId) {
      console.log("orderItemId = ", orderItemId);

      let that = this;

      this.connected_user.token = localStorage.getItem("token");

      let config = {
        headers: {
          Authorization: `Bearer ${this.connected_user.token}`,
        },
      };

      let updateOrderItemStatus = {
        orderItem_id: orderItemId,
        orderItemStatus: "Cancelled",
        action: "cancel",
        order_id: orderId,
      };

      Swal.fire({
        title: "Are you sure to cancel this product ordering?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes cancel it!",
      }).then((result) => {
        if (result.isConfirmed) {
          axios
            .post(
              "api/updateOrderStatusAndOrderItemStatus",
              updateOrderItemStatus,
              config
            )
            .then((result) => {});
        }
      });
    },
  },
};
</script>



















<style>
input:focus,
button:focus,
.form-control:focus {
  outline: none;
  box-shadow: none;
}
.form-control:disabled,
.form-control[readonly] {
  background-color: #fff;
}
.table tr,
.table tr td {
  vertical-align: middle;
}

table td {
  width: 5px;
}

.button-container {
  display: flex;
  align-items: center;
}
.button-container .form-control {
  max-width: 80px;
  text-align: center;
  display: inline-block;
  margin: 0px 5px;
}
#myTable .form-control {
  width: auto;
  display: inline-block;
}
.cart-qty-plus,
.cart-qty-minus {
  width: 38px;
  height: 38px;
  background-color: #fff;
  border: 1px solid #ced4da;
  border-radius: 0.25rem;
}
.cart-qty-plus:hover,
.cart-qty-minus:hover {
  background-color: #5161ce;
  color: #fff;
}
.img-prdct {
  width: 150px;
  height: 150px;
  margin: 50px 0px 50px 50px;
  filter: drop-shadow(0 0 0.75rem rgba(212, 205, 206, 0.472));
  border-radius: 4px;
}
.img-prdct img {
  width: 100%;
}
</style>
