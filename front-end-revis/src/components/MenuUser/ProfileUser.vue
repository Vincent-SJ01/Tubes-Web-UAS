<template>
    <v-main class="profil" style="height: 100%">
        <div >
            <v-card persistent min-width="400px" elevation="8">
                <v-card-title class="backgroundhead">
                    <span class="headline"><b> Profile</b></span>
                </v-card-title>
                <v-card-text>
                    <v-container >
                        <v-row>
                            <v-col>
                                <v-text-field v-model="formInput.name" readonly label="Nama" type="text" prepend-icon="mdi-account"> </v-text-field>
                                <v-text-field v-model="formInput.username" readonly label="Username" type="text" prepend-icon="bx bx-user-pin"></v-text-field>
                                <v-text-field v-model="formInput.password" readonly label="Password" prepend-icon="bx bx-low-vision"></v-text-field>
                                <v-text-field v-model="formInput.name" readonly label="Email" type="text" prepend-icon="bx bx-envelope"></v-text-field>
                                <v-textarea v-model="formInput.alamat" readonly label="Alamat" required>
                                </v-textarea>
                            </v-col>
                            <v-col cols="12" sm="6" md="4">
                                <div class="text-center">
                                    <img :src="this.photo" style="
                                        margin-top: 60px;
                                        border-radius: 20px;
                                        max-width: 256px;
                                        max-height: 256px;
                                        min-width: 256px;
                                        min-height: 256px;
                                        object-fit: cover;" />
                        
                                </div>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="red" style="color: aliceblue;" @click="open"> Edit </v-btn>
                </v-card-actions>
            </v-card>
        </div>
        <v-dialog v-model="dialog" persistent width="400px">
            <v-card>
                <v-card-title>
                    <span class="headLine">Edit Password</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-text-field v-model="form_password.old" label="Old Password" type="password" required></v-text-field>
                        <v-text-field v-model="form_password.new" label="New Password" type="password" required></v-text-field>
                        <v-text-field v-model="form_password.confirm" label="Confirm Password" type="password" required></v-text-field>

                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="cancel"> Cancel </v-btn>
                    <v-btn color="blue darken-1" text @click="ganti"> Ubah </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
       
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


export default {
    name: "ProfileUser",

    data() {
        return {
            dialog: false, 
            load: false,
            snackbarState: false,
            snackbarTimeout: 3000,
            snackbarOption: {
                color: null,
                icon: null,
                title: null,
                text: [],
            
            },

            formInput: {
                nama: null,
                username: null,
                password: null,
                email: null,
                alamat: null,
            },
            form_password: {
                old: null,
                new: null,
                confirm: null,
            },

      

            
        };
    },

    methods: {

        readData() {

            axios.post(API.BaseRoute + 'ProfileUser', this.formInput)
                .then((response) => {

                    this.form.name = response.data.data.name;
                    this.form.username = response.data.data.username;
                    this.form.password = response.data.data.password;
                    this.form.email = response.data.data.email;
                    this.form.alamat = response.data.data.alamat;
                });

                
            

        },
        cancel() {
            this.resetFormPassword();
            this.readData();
            this.dialog = false;
        },

        resetForm() {
            this.formInput();
        },

        openSnackbar(option = null) {
            this.snackbarState = true;
            this.snackbarOption = option;
        },
        resetFormPassword() {
            this.form_password = {
                old: null,
                new: null,
                confirm: null,
            };
        },
        open() {
            this.dialog = true;
        },
        ganti() {
            let newData = {
                old: this.form_password.old,
                new: this.form_password.new,
                confirm: this.form_password.confirm,
            };
            axios.post(API.BaseRoute + 'ProfileUser', this.formInput)
            this.load = true;
            this.$http
                .put(API.BaseRoute + "ProfileUser", newData)
                .then((response) => {
                    this.error_message = response.data.message;
                    this.color = "green";
                    this.snackbar = true;
                    this.load = false;
                    this.dialog = false;
                    this.resetFormPassword();
                })
                .catch((error) => {
                    this.error_message = error.response.data.message;
                    this.color = "red";
                    this.snackbar = true;
                    this.load = false;
                });
        },


    },
};
</script>

 
    


