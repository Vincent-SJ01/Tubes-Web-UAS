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
                width="30%"
                class="justify-center">
                
                <v-card-title class="mains">
                    <span class="headline text-center"><b> Register </b></span>
                </v-card-title>
                
                <v-card-text class="pb-0">

                    <v-container>

                        <v-text-field 
                            label="NIK" 
                            v-model="formInput.nik" 
                            :rules="nikRules" 
                            required>
                        </v-text-field>

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
                            
                        <v-container class="pa-0 ">
                            <v-row>
                                <v-col
                                    cols="12"
                                    md="6"
                                    class="px-1 py-0"
                                >
                                    <v-text-field 
                                        label="No Telepon" 
                                        v-model="formInput.noTelp"
                                        :rules="noTelpRules"
                                        required>
                                    </v-text-field>
                                </v-col>

                                <v-col
                                    cols="12"
                                    md="6"
                                    class="px-1 py-0"
                                >
                                    <v-menu
                                        v-model="showDatePicker"
                                        :close-on-content-click="false"
                                        transition="scale-transition"
                                        offset-y
                                        max-width="290px"
                                        min-width="auto"
                                    >

                                        <template v-slot:activator="{ on, attrs }">

                                            <v-text-field
                                                v-model="formInput.tanggalLahir"
                                                label="Tanggal Lahir"
                                                readonly
                                                v-bind="attrs"
                                                v-on="on"
                                            ></v-text-field>

                                        </template>

                                        <v-date-picker
                                            v-model="formInput.tanggalLahir"
                                            no-title
                                            @input="showDatePicker = false"
                                        ></v-date-picker>
                                
                                    </v-menu>
                                </v-col>
                            </v-row>
                        </v-container>

                        <v-container class="pa-0">
                            <v-row>
                                <v-col
                                    cols="12"
                                    md="6"
                                    class="px-1 py-0"
                                >
                                    <v-select 
                                        v-model="formInput.gender" 
                                        :items="dataGender"
                                        item-text="namaGender" 
                                        item-value="id"

                                        label="Gender" 
                                        :rules="genderRules" 
                                        required>
                                    </v-select>
                                </v-col>

                                <v-col
                                    cols="12"
                                    md="6"
                                    class="px-1 py-0"
                                >
                                    <v-select 
                                        v-model="formInput.idStatus" 
                                        :items="dataStatus"
                                        item-text="namaStatus"
                                        item-value="id"
                                        
                                        label="Status" 
                                        :rules="statusRules" 
                                        required>
                                    </v-select>
                                </v-col>
                            </v-row>
                        </v-container>
                            
                    </v-container>
                
                </v-card-text>
                
                <v-card-actions class="justify-center pt-0 pb-4 ma-0">    
                    <v-btn color="red" @click="registerKurir()"> Register </v-btn>
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
        height: 88.5vh; 
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

                showDatePicker : false, 
                
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
                    nik : null,
                    noTelp : null,
                    alamat : null,

                    tanggalLahir : null,
                    gender : null,
                    idStatus : null, 
                    idRole : 2,
                },

                dataStatus : [
                    {
                        id : 1,
                        namaStatus : "Aktif"
                    },
                    {
                        id : 0,
                        namaStatus : "Tidak Aktif"
                    }
                ],
                dataGender : [
                    {
                        id : 1,
                        namaGender : "Laki-Laki"
                    },
                    {
                        id : 0,
                        namaGender : "Perempuan"
                    }
                ],

                valid: false,

                nikRules: [(v) => !!v || "NIK tidak boleh kosong !!"],
                nameRules: [(v) => !!v || "Name tidak boleh kosong !!"],
                usernameRules: [(v) => !!v || "Username tidak boleh kosong !!"],
                passwordRules: [(v) => !!v || "Password tidak boleh kosong !!"],
                emailRules: [(v) => !!v || "E-mail tidak boleh kosong !!"],
                alamatRules: [(v) => !!v || "Alamat tidak boleh kosong !!"],
                noTelpRules: [(v) => !!v || "No Telepon tidak boleh kosong !!"],

                tanggalLahirRules: [(v) => !!v || "Tanggal Lahir tidak boleh kosong !!"],
                genderRules: [(v) => !!v || "Gander tidak boleh kosong !!"],
                statusRules: [(v) => !!v || "Status tidak boleh kosong !!"],
            };
        },
        
        methods: {

            registerKurir(){

                axios.post(API.BaseRoute + 'registerKurir', this.formInput)
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
