<template>
    <v-main style="height: 100%">
        <img src="../assets/delivery.jpg" style="width: 100%" />
        <center></center>

        <div class="d-flex justify-content-center"
            style=" position: absolute; top: 20%; left: 40%; width: 40%; text-align: center; padding: 5px; padding-top: 3%; padding-bottom: 5%;;"
            align="center">
            <v-form v-model="valid" ref="form">
                <v-card persistent min-width="400px" elevation="7">
                    <v-card-title class="mains">
                        <span class="headline"><b>Register</b></span>
                    </v-card-title>
                    <v-card-text>
                        <v-container>
                            <v-text-field label="Nama" v-model="nama" :rules="nameRules" required></v-text-field>
                            <v-text-field label="Username" v-model="username" :rules="usernameRules"
                                required></v-text-field>
                            <v-text-field label="Password" v-model="password" type="password" :rules="passwordRules"
                                required></v-text-field>
                            <v-text-field label="E-mail" v-model="email" :rules="emailRules" required></v-text-field>
                            <v-text-field label="Alamat" v-model="alamat" :rules="alamatRules" required></v-text-field>
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="red" @click="register" style="color: white;"> Register </v-btn>
                        <center></center>
                    </v-card-actions>
                </v-card>
            </v-form>
        </div>

    </v-main>
</template>

<style scoped>
.mains {
    background-color: rgb(198, 3, 3);
    justify-content: center;


}
</style>

<script>
export default {
    name: "Register sterUser",
    data() {
        return {
            color: "",
            valid: false,
            name: "",
            nameRules: [(v) => !!v || "Name tidak boleh kosong !!"],
            username: "",
            usernameRules: [(v) => !!v || "Username tidak boleh kosong !!"], 
            password: "",  
            passwordRules: [(v) => !!v || "Password tidak boleh kosong !!"],
            alamat: "",
            alamatRules: [(v) => !!v || "Alamat tidak boleh kosong !!"],
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
