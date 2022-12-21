<template>
    <v-main class="profil" style="height: 100%">
        <div class="d-flex justify-center">
            <v-card 
                persistent 
                width="50%" 
                elevation="8">
                
                <v-card-title class="backgroundhead">
                
                    <span class="headline"><b> Profile</b></span>
                
                </v-card-title>
                
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col>
                                <v-text-field 
                                    v-model="userObject.nama" 
                                    readonly 
                                    label="Nama" 
                                    type="none" 
                                    prepend-icon="mdi-account">
                                </v-text-field>
                                
                                <v-text-field 
                                    v-model="userObject.username" 
                                    readonly 
                                    label="Username" 
                                    type="none" 
                                    prepend-icon="bx bx-user-pin">
                                </v-text-field>
                            
                                
                                <v-text-field 
                                    v-model="userObject.email" 
                                    readonly 
                                    label="Email" 
                                    type="none" 
                                    prepend-icon="bx bx-envelope">
                                </v-text-field>
                                
                                <v-textarea 
                                    v-model="userObject.alamat" 
                                    readonly 
                                    type="none"
                                    label="Alamat" >

                                </v-textarea>
                            </v-col>

                        </v-row>
                    </v-container>
                </v-card-text>

                <v-layout justify-center>
                    <v-card-actions>
                
                        <v-btn 
                            color="primary"  
                            @click="openDialog(0); getDataProfile()"> 
                            Edit Profile 
                        </v-btn>

                        <v-btn 
                            color="secondary"  
                            @click="openDialog(1)"> 
                            Edit Password
                        </v-btn>
                    
                    </v-card-actions>
                </v-layout>


            </v-card>
        </div>

        <v-dialog 
            v-model="dialogPassword" 
            persistent 
            width="400px">
            
            <v-card>
                <v-card-title>
                    <span class="headLine">Edit Password</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-text-field 
                            v-model="formPassword.oldPassword" 
                            label="Old Password" 
                            type="password" 
                            required>
                        </v-text-field>
                        
                        <v-text-field 
                            v-model="formPassword.newPassword" 
                            label="New Password" 
                            type="password" 
                            required>
                        </v-text-field>
                        
                        <v-text-field 
                            v-model="formPassword.newPasswordConfirm" 
                            label="Confirm Password" 
                            type="password" 
                            required>
                        </v-text-field>

                    </v-container>

                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    
                    <v-btn 
                        color="error" 
                        text 
                        @click="confirmCancel()"> 
                        Cancel 
                    </v-btn>
                    
                    <v-btn 
                        color="success" 
                        text 
                        @click="confirmEditPassword()"> 
                        Edit 
                    </v-btn>

                </v-card-actions>

            </v-card>
        </v-dialog>

        <v-dialog 
            v-model="dialogEdit" 
            persistent 
            width="600px">
            
            <v-card>
                <v-card-title>
                    <span class="headLine">Edit Profile</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-text-field 
                            v-model="formInput.nama" 
                            label="Name" 
                            type="text" 
                            required>
                        </v-text-field>
                        
                        <v-text-field 
                            v-model="formInput.username" 
                            label="Username" 
                            required>
                        </v-text-field>
                        
                        <v-textarea
                            v-model="formInput.alamat" 
                            label="Alamat" 
                            required>
                        </v-textarea>

                    </v-container>

                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    
                    <v-btn 
                        color="error" 
                        text 
                        @click="confirmCancel()"> 
                        Cancel 
                    </v-btn>
                    
                    <v-btn 
                        color="success" 
                        text 
                        @click="confirmEditProfile()"> 
                        Edit 
                    </v-btn>

                </v-card-actions>

            </v-card>
        </v-dialog>

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
    .backgroundhead {
        background-color: #ebeaea;
        justify-content: center;
        text-align: center;

    }
</style>

<script>

    import axios from "axios";
    import * as API from "../../repository/APIRoute.js";
    import * as cookiesHandle from "../../repository/cookiesHandle";

    let token = cookiesHandle.getCookies("token");

    let axiosConfig = {
        headers : {
            'Authorization': "Bearer " + token,
        }
    }
    


    export default {
        name: "ProfileUser",

        data() {
            return {
                dialogPassword: false, 
                dialogEdit : false,
                
                load: false,

                snackbarState: false,
                snackbarTimeout: 3000,
                snackbarOption: {
                    color: null,
                    icon: null,
                    title: null,
                    text: [],
                
                },

                userObject : {},

                formInput: {},

                formPassword: {},

        

                
            };
        },

        mounted() {
            this.readData();
        },

        methods: {

            readData() {

                axios.get(API.BaseRoute + 'userprofile', axiosConfig)
                    .then((response) => {

                        this.userObject = response.data.data;    
                        this.formInput = Object.assign({}, this.userObject);
                    
                    })
                    .catch((error) => {
                    
                        let option = {
                            color: "error",
                            icon: "mdi mdi-close-circle",
                            title: "Error",
                            text: [
                                "Gagal mengambil data user", 
                                `Code Error : ${error.response.status}`
                            ],
                        };

                        this.openSnackbar(option);
                    })

            },

            confirmCancel(){
                this.closeDialog();
            },

            resetForm(){
                this.formInput = {};
                this.formPassword = {};
            },

            closeDialog(){
                this.dialogPassword = false; 
                this.dialogEdit = false;
                this.resetForm();
            },

            openSnackbar(option = null) {
                this.snackbarState = true;
                this.snackbarOption = option;
            },

            openDialog(mode) {
                //mode 0 == edit profiel keselluruhan
                if(mode == 0){
                    this.dialogEdit = true;
                }else{
                    this.dialogPassword = true;
                }
            },

            getDataProfile(){
                this.formInput = Object.assign({}, this.userObject);
            },
            
            confirmEditProfile(){
                axios.put(API.BaseRoute + 'user', this.formInput, axiosConfig)
                    .then(() =>{

                        let option = {
                            color: "success",
                            icon: "mdi mdi-check-circle",
                            title: "Success",
                            text: [
                                "Berhasil mengubah Profile", 
                            ],
                        };

                        this.openSnackbar(option);
                        this.closeDialog();
                        this.readData();
                    })
                    .catch((error) => {
                        let option = {
                            color: "warning",
                            icon: "mdi-alert-circle",
                            title: "Warning",
                            text: [
                                "Gagal mengubah Profile", 
                                `Code Error : ${error.response.status}`
                            ],
                        };
                        for(let errorAttribute in error.response.data.message){
                            option.text.push(`${error.response.data.message[errorAttribute]}`);
                        }

                        this.openSnackbar(option);
                    })
            },

            confirmEditPassword(){

                axios.put(API.BaseRoute + 'userpassword', this.formPassword, axiosConfig)
                    .then(() =>{

                        let option = {
                            color: "success",
                            icon: "mdi mdi-check-circle",
                            title: "Success",
                            text: [
                                "Berhasil mengubah password", 
                            ],
                        };

                        this.openSnackbar(option);
                        this.closeDialog();
                    })
                    .catch((error) => {
                        let option = {
                            color: "error",
                            icon: "mdi mdi-close-circle",
                            title: "Error",
                            text: [
                                "Gagal mengubah password", 
                            ],
                            
                        };

                        if(Array.isArray(error.response.data.message)){
                            for(let errorAttribute in error.response.data.message)
                                option.text.push(`${error.response.data.message[errorAttribute]}`);
                        }else{
                            option.text.push(`${error.response.data.message}`);
                        }
                        


                        


                        this.openSnackbar(option);
                    })
                    
                
            },



        },
    };
</script>

 
    


