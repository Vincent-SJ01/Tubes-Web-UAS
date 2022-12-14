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
                            label="NIK" 
                            v-model="nik" 
                            :rules="nikRules" 
                            required>
                        </v-text-field>

                        <v-text-field 
                            label="Nama" 
                            v-model="nama" 
                            :rules="nameRules" 
                            required>
                        </v-text-field>
                            
                        <v-text-field 
                            label="Username" 
                            v-model="username" 
                            :rules="usernameRules"
                            required>
                        </v-text-field>

                        <v-text-field 
                            label="Password" 
                            v-model="password" 
                            type="password" 
                            :rules="passwordRules"
                            required>
                        </v-text-field>
                            
                        <v-text-field 
                            label="E-mail" 
                            v-model="email" 
                            :rules="emailRules" 
                            required>
                        </v-text-field>
                            
                        <v-text-field 
                            label="Alamat" 
                            v-model="alamat" 
                            :rules="alamatRules" 
                            required>
                        </v-text-field>

                        <v-text-field 
                            label="No Telepon" 
                            v-model="noTelp" 
                            :rules="noTelpRules"
                            required>
                        </v-text-field>
                            
                        <v-text-field 
                            label="Tanggal Lahir" 
                            input 
                            type="date"
                            v-model="tanggalLahir"
                            :rules="tanggalLahirRules" 
                            required>
                        </v-text-field>
                            
                        <v-select 
                            v-model="gender" 
                            :items="dataGender" 
                            label="Gender" 
                            :rules="genderRules" 
                            required>
                        </v-select>
                            
                        <v-select 
                            v-model="status" 
                            :items="dataStatus" 
                            label="Status" 
                            :rules="statusRules" 
                            required>
                        </v-select>

                    </v-container>
                
                </v-card-text>
                
                <v-card-actions class="justify-center">    
                    <v-btn color="red" @click="register"> Register </v-btn>
                </v-card-actions>

            </v-card>
        </v-form>
            
          
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
    export default {
        name: "LoginPage",

        data() {
            return {

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

                dataStatus : [],
                dataGender : [],

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



            
            login() {

            },
            clear() {
                this.$refs.form.reset(); // clear form login
            },
        },
    };
</script>
