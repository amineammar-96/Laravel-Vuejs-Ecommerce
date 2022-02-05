<template>
<div class='confirmationClass'>



<div class="wrapperAlert">

  <div class="contentAlert" style="text-align: center;">

    <div class="topHalf">

      <p><svg viewBox="0 0 512 512" width="100" title="check-circle">
        <path d="M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z" />
        </svg></p>
      <h1>Congratulations</h1>

     <ul class="bg-bubbles">
       <li></li>
       <li></li>
       <li></li>
       <li></li>
       <li></li>
       <li></li>
       <li></li>
       <li></li>
       <li></li>
       <li></li>
     </ul>
    </div>

    <div class="bottomHalf">

      <p>
           Well Done! <br>
           Thank you for your order
      </p>


           <router-link to='/products' > <button id="alertMO">See more products</button></router-link>



    </div>

  </div>

</div>



</div>
</template>


<script>

export default {
    data() {

    },

    mounted(){
        setTimeout(()=>{
            this.$router.push('/orders')
        },8000);
    },

    methods : {

    }
}
</script>



<style>

.confirmationClass{
    display: flex;
    justify-content: center;
    width: 50%;
}

.confirmationClass .wrapperAlert {
  width: 100%;
  height: 100%;
  overflow: hidden;
  border-radius: 12px;
  border: thin solid #ddd;
}

.confirmationClass .topHalf {
  width: 100%;
  color: white;
  overflow: hidden;
  min-height: 250px;
  position: relative;
  padding: 40px 0;
  background: rgb(0,0,0);
  background: -webkit-linear-gradient(45deg, #019871, #a0ebcf);
}

.confirmationClass .topHalf p {
  margin-bottom: 30px;
}
.confirmationClass svg {
  fill: white;
}
.confirmationClass .topHalf h1 {
  font-size: 2.25rem;
  display: block;
  font-weight: 500;
  letter-spacing: 0.15rem;
  text-shadow: 0 2px rgba(128, 128, 128, 0.6);
}

/* Original Author of Bubbles Animation -- https://codepen.io/Lewitje/pen/BNNJjo */
.confirmationClass .bg-bubbles{
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1;
}

.confirmationClass li{
  position: absolute;
  list-style: none;
  display: block;
  width: 40px;
  height: 40px;
  background-color: rgba(255, 255, 255, 0.15);/* fade(green, 75%);*/
  bottom: -80px;

  -webkit-animation: square 20s infinite;
  animation:         square 20s infinite;

  -webkit-transition-timing-function: linear;
  transition-timing-function: linear;
}
.confirmationClass li:nth-child(1){
  left: 10%;
}
.confirmationClass li:nth-child(2){
  left: 20%;

  width: 80px;
  height: 80px;

  animation-delay: 0s;
  animation-duration: 17s;
}
.confirmationClass li:nth-child(3){
  left: 25%;
  animation-delay: 0s;
}
.confirmationClass li:nth-child(4){
  left: 40%;
  width: 60px;
  height: 60px;

  animation-duration: 22s;

  background-color: rgba(white, 0.3); /* fade(white, 25%); */
}
.confirmationClass li:nth-child(5){
  left: 70%;
}
.confirmationClass li:nth-child(6){
  left: 80%;
  width: 120px;
  height: 120px;

  animation-delay: 0s;
  background-color: rgba(white, 0.2); /* fade(white, 20%); */
}
.confirmationClass li:nth-child(7){
  left: 32%;
  width: 160px;
  height: 160px;

  animation-delay: 0s;
}
.confirmationClass li:nth-child(8){
  left: 55%;
  width: 20px;
  height: 20px;

  animation-delay: 0s;
  animation-duration: 40s;
}
.confirmationClass li:nth-child(9){
  left: 25%;
  width: 10px;
  height: 10px;

  animation-delay: 0s;
  animation-duration: 40s;
  background-color: rgba(white, 0.3); /*fade(white, 30%);*/
}
.confirmationClass li:nth-child(10){
  left: 90%;
  width: 160px;
  height: 160px;

  animation-delay: 1s;
}

@-webkit-keyframes square {
  0%   { transform: translateY(0); }
  100% { transform: translateY(-500px) rotate(600deg); }
}
@keyframes square {
  0%   { transform: translateY(0); }
  100% { transform: translateY(-500px) rotate(600deg); }
}

.confirmationClass .bottomHalf {
  align-items: center;
  padding: 35px;
}
.confirmationClass .bottomHalf p {
  font-weight: 500;
  font-size: 1.05rem;
  margin-bottom: 20px;
}

.confirmationClass button {
  border: none;
  color: white;
  cursor: pointer;
  border-radius: 12px;
  padding: 10px 18px;
  background-color: #019871;
  text-shadow: 0 1px rgba(128, 128, 128, 0.75);
}
.confirmationClass button:hover {
  background-color: #85ddbf;
}

</style>
