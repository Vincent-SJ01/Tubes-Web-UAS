<template>
    <v-main style="height: 100%">
        <img src="../assets/delivery.jpg"  style="width: 100%" />
        <center>
            <div class="d-flex justify-content-center" style=" position: absolute; top: 20%; left: 40%; width: 40%; text-align: center; padding: 5px; padding-top: 3%; padding-bottom: 5%;;" align="center">
                <v-form v-model="valid" ref="form">
                    <v-card persistent min-width="400px" elevation="8">
                        <v-card-title class="mains">
                            <span class="headline"><b>Login</b></span>
                        </v-card-title>
                        <v-card-text>
                            <v-container>
                                <v-text-field label="E-mail" v-model="email" :rules="emailRules"
                                    required></v-text-field>
                                <v-text-field label="Password" v-model="password" type="password" :rules="passwordRules"
                                    required></v-text-field>
                            </v-container>
                        </v-card-text>
                        <v-card-actions class="justify-center" >
                            
                            <v-btn color="red" @click="login"> Login </v-btn>
                        </v-card-actions>
                        
                        <p class="mt-2 mb-0">----------------------------- New Account? ----------------------------- </p>
                        <router-link :to="{ path: '/RegisterUser' }" style="text-decoration: none">
                            <v-btn class="mr-2" color="primary" text> Register User? </v-btn>
                        </router-link>
                        <router-link :to="{ path: '/RegisterKurir' }" style="text-decoration: none">
                            <v-btn class="mr-2" color="primary" text> Register Kurir? </v-btn>
                        </router-link>
                        <br>
                    </v-card>
                </v-form>
            </div>
          
        </center>
    </v-main>
</template>

<style scoped>
.mains {
    background-color: rgb(198, 3, 3);
    justify-content: center;
    text-align: center;



}
.bg {
    background-color: #18191b;
    background-image:url("../assets/delivery.jpg");
    height: 900%; 
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}   
</style>

<script>
export default {
    name: "LoginPage",
    data() {
        return {
            color: "",
            valid: false,
            password: "",
            email: "",
            passwordRules: [(v) => !!v || "Password tidak boleh kosong !!"],
            emailRules: [(v) => !!v || "E-mail tidak boleh kosong !!"],
        };
    },
    methods: {
        login() {

        },
        clear() {
            this.$refs.form.reset(); // clear form login
        },
    },
};
</script>
