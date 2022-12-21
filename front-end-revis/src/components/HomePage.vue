<template>
    <div class="heroBlock">
        <v-carousel cycle height="800">
            <v-carousel-item v-for="(item, i) in items" :key="i" eager>
                <v-img :src="item.src" height="100%" eager 
          position="absolute"
          top="0"
          left="0"
          min-width="100%"
          min-height="100%"
          size="cover" 
          
          />
                <v-row class="text-left" style="color: black; position: absolute; top: 30%; left: 18%; right: 20% " >{{
                        item.title
                }}</v-row>
            </v-carousel-item>
        </v-carousel>
    </div>
</template>

<style scoped>
.heroBlock {
    height: 200%;
}
</style>

<script>
export default {
    name: "HomePage",
    data() {
        return {
            items: [
                {
                    src: require("../assets/poto2.jpg"),
                    title: "Hello, Selamat datang di website Ngurir"

                },
                {
                    src: require("../assets/homePages.jpg"),
                    title: "Ingin kirim barang anda dalam waktu yang cepat? Jasa pengiriman kami adalah solusinya!"

                },
                {
                    src: require("../assets/poto3.jpg"),
                    title: "Jasa pengiriman barang terpercaya   "
                }
            ]
        };
    }
};
</script>