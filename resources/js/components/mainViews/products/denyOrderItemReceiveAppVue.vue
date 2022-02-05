<template>
<div>
    <h1>Denieeeed successfuly</h1>
</div>
</template>


<script>
export default {
    data() {
        return {
        orderItem : {
            id : ""
        },


        }
    },

    mounted(){
                this.orderItem.id = this.$route.query.orderItem_id;
                console.log("hahahassss" ,this.orderItem.id)
    },

    methods:{

    }
}
</script>
