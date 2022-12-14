<template>

    <v-main fluid class="pa-0 ma-0 RegisterBackground">
       
        <v-form 
            v-model="valid" 
            ref="form"
            :style = "{height: '100%'}"
            class="d-flex justify-center align-center"
            >
            
            <v-card 
                persistent 
                min-width="400px" 
                elevation="8"
                class="justify-center">
                
                <v-card-title class="mains">
                    <span class="headline text-center"><b> Register </b></span>
                </v-card-title>
                
                <v-card-text>

                    <v-container>

                        <v-text-field 
                            label="Nama" 
                            v-model="formInput.nama" 
                            :rules="nameRules" 
                            required>
                        </v-text-field>
                        
                        <v-text-field 
                            label="Username" 
                            v-model="formInput.username" 
                            :rules="usernameRules"
                            required>
                        </v-text-field>
                        
                        <v-text-field 
                            label="Password" 
                            v-model="formInput.password" 
                            type="password" 
                            :rules="passwordRules"
                            required>
                        </v-text-field>

                        <v-text-field 
                            label="E-mail" 
                            v-model="formInput.email" 
                            :rules="emailRules" 
                            required>
                        </v-text-field>
                        
                        <v-textarea 
                            label="Alamat" 
                            v-model="formInput.alamat" 
                            :rules="alamatRules" 
                            required>
                        </v-textarea>

                    </v-container>
                
                </v-card-text>
                
                <v-card-actions class="justify-center">    
                    <v-btn color="red" @click="registerUser()"> Register </v-btn>
                </v-card-actions>

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
        background-color: rgb(235, 71, 71);
        justify-content: center;

    }
    .RegisterBackground {
        background: url("../assets/delivery.jpg");
        height: 100vh; 
        background-size: cover;
    }   
</style>

<script>

    import axios from "axios";
    import * as API from "../repository/APIRoute.js";


    export default {
        name: "RegisterKurir",

        data() {
            return {
                
                snackbarState : false,
                snackbarTimeout : 3000,
                snackbarOption : {
                    color : null,
                    icon : null,
                    title : null,
                    text : [],
                },

                formInput : {
                    nama : null,
                    username : null,
                    password : null,
                    email : null,
                    alamat : null,

                    idStatus : 0,
                },


                valid: false,

                nameRules: [(v) => !!v || "Name tidak boleh kosong !!"],
                usernameRules: [(v) => !!v || "Username tidak boleh kosong !!"],         
                passwordRules: [(v) => !!v || "Password tidak boleh kosong !!"],
                alamatRules: [(v) => !!v || "Alamat tidak boleh kosong !!"],
            };
        },
        
        methods: {

            registerUser(){

                axios.post(API.BaseRoute + 'registerUser', this.formInput)
                    .then(() => {
                        
                        let option = {
                                color : "success",
                                icon : "mdi-check-circle",
                                title : "Success",
                                text : ['Register Berhasil'],
                            }

                        this.openSnackbar(option);
                        this.resetForm();

                        this.$router.push({name : 'Beranda.Login'});
                    })

                    .catch((error) => {
                        console.log(error);

                        let option = {
                                color : "warning",
                                icon : "mdi-alert-circle",
                                title : "Warning",
                                text : ['Register Gagal'],
                            }

                        for(let errorAttribute in error.response.data.message){
                            option.text.push(`${error.response.data.message[errorAttribute]}`);
                        }

                        this.openSnackbar(option);

                    });


            },

            resetForm() {
                this.formInput();
            },

            openSnackbar(option = null) {
                this.snackbarState = true;
                this.snackbarOption = option;
            },


        },
    };
</script>
