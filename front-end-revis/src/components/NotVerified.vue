<template>

    <v-main fluid class="pa-0 ma-0 LoginBackground">
       
        <v-form 
            v-model="valid" 
            ref="form"
            :style = "{height: '100%'}"
            class="d-flex justify-center align-center"
            >
            
            <v-card 
                persistent 
                max-width="50%"
                elevation="8"
                class="justify-center">
                
                <v-card-title class="mains">
                    <span 
                        class="headline text-center">
                        <b>USER NOT VIRIFIED</b>
                    </span>
                </v-card-title>
                
                <v-img 
                    :src="require('../assets/NotVerifiedUser.jpg')" 
                    alt="Not Verified" 
                    max-width="48%"
                    max-height="77%"
                    class="mx-auto"
                    
                    >
                    
                </v-img>

                <v-card-text class="text-center text-h6" >

                    <b>Please kindly check your email to verify your account :)</b>
                
                </v-card-text>

            </v-card>
        </v-form>

        <v-snackbar
            v-model="snackbarState"
            :timeout="snackbarTimeout"
            auto-height
            multi-line
            top
            right
            :color="snackbarOption.color"
        >
            <v-layout align-center pr-4>
                
                <v-icon class="pr-3" dark large>{{ snackbarOption.icon }}</v-icon>

                <v-layout column>
                    <div>
                        <strong>{{ snackbarOption.title }}</strong>
                    </div>
                    
                    <div>
                        <span v-for="(message, index) in snackbarOption.text" :key="index">
                            {{ message }} <br/>
                        </span>
                        
                    </div>
                
                </v-layout>

            </v-layout>
            
        </v-snackbar>
            
          
    </v-main>
</template>

<style scoped>
    .mains {
        background-color: rgb(233, 77, 77);
        justify-content: center;

    }
    .LoginBackground {
        background: url("../assets/delivery.jpg");
        height: 88.5vh; 
        background-size: cover;
    }   
</style>

<script>

    import axios from "axios";
    import * as API from "../repository/APIRoute.js";
    import * as cookiesHandle from "../repository/cookiesHandle";

    export default {
        name: "LoginPage",

        data() {
            return {

                snackbarState : false,
                snackbarTimeout : 3000,
                snackbarOption : {
                    color : null,
                    icon : null,
                    title : null,
                    text : null,
                },

                formInput : {
                    email : null,
                    password : null,
                },

                valid: false,

                passwordRules: [(v) => !!v || "Password tidak boleh kosong !!"],
                emailRules: [(v) => !!v || "E-mail tidak boleh kosong !!"],
            };
        },
        methods: {
            login() {
                
                let pattern = /^[\w-.]+@([\w-]+.)+[\w-]{2,4}$/;
                let sendObject = {};

                if(pattern.test(this.formInput.email)) {
                    
                    sendObject = {
                        email : this.formInput.email,
                        password : this.formInput.password,
                    }

                }else{
                    sendObject = {
                        username : this.formInput.email,
                        password : this.formInput.password,
                    }
                }



                axios.post(API.BaseRoute + 'login', sendObject)
                    .then(response => {
                        console.log(response);

                        //delete cookies

                        cookiesHandle.deleteAllCookies();  

                        cookiesHandle.setCookies("token", response.data.access_token, 30);

                        let option = {
                            color : "success",
                            icon : "mdi-check-circle",
                            title : "Success",
                            text : ['Berhasil Login'],
                        }

                        
                        this.switchPage(response.data.user.idRole);
                        
                        this.openSnackbar(option);

                    })

                    .catch(error => {
                        console.log(error.response.data);

                        console.log(sendObject)
                    
                        let option = {
                            color : "error",
                            icon : "mdi-alert-circle",
                            title : "Error",
                            text : ['Gagal Login'],
                        }

                        this.openSnackbar(option);
                    
                    });

            },

            openSnackbar(option = null){
                this.snackbarState = true;
                this.snackbarOption = option;
            }, 

            resetForm() {
                this.formInput();
            },

            switchPage(role){

                role = parseInt(role);

                switch(role){
                    case 1:
                        this.$router.push({ name: 'Admin.Home' });
                        break;
                    case 3:
                        this.$router.push({ name: 'User' });
                        break;
                    case 2:
                        this.$router.push({ name: 'Kurir' });
                        break;
                    default:
                        this.$router.push({ name: 'Login' });
                        break;
                }

            }

        },
    };

</script>
