<template>
    <v-main style="height: 20   %" >
        <img src="../assets/delivery.jpg" style="width: 100%"  />
        <center></center>

        <div class="d-flex justify-content-center"
            style=" position: absolute; top: -5%; left: 40%; width: 40%; text-align: center; padding: 5px; padding-top: 3%; padding-bottom: 5%;;"
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
                            <v-text-field label="NIK" v-model="nik" :rules="nikRules" required></v-text-field>
                            <v-text-field label="No Telepon" v-model="noTelp" :rules="noTelpRules"
                                required></v-text-field>
                            <v-text-field label="Tanggal Lahir" input type="date"> v-model="tanggalLahir"
                                :rules="tanggalLahirRules" required></v-text-field>
                            <v-select v-model="gander" :items="[`Pria`, `Wanita`]" label="Gander" :rules="GanderRules" required>
                            </v-select>
                            <v-select v-model="status" :items="[`Aktif`, `Tidak Aktif`]" label="Status" :rules="statusRules" required>
                            </v-select>
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="red" @click="register"> Register </v-btn>
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
    name: "RegisterKurir",
    data() {
        return {
            color: "",
            valid: false,
            name: "",
            nameRules: [(v) => !!v || "Name tidak boleh kosong !!"],
            password: "",
            passwordRules: [(v) => !!v || "Password tidak boleh kosong !!"],
            email: "",
            emailRules: [(v) => !!v || "E-mail tidak boleh kosong !!"],
            alamat: "",
            alamatRules: [(v) => !!v || "Alamat tidak boleh kosong !!"],
            username: "",
            usernameRules: [(v) => !!v || "Username tidak boleh kosong !!"],
            nik: "",
            nikRules: [(v) => !!v || "NIK tidak boleh kosong !!"],
            noTelp: "",
            noTelpRules: [(v) => !!v || "No Telepon tidak boleh kosong !!"],
            tanggalLahir: "",
            tanggalLahirRules: [(v) => !!v || "Tanggal Lahir tidak boleh kosong !!"],
            gander: "",
            GanderRules: [(v) => !!v || "Gander tidak boleh kosong !!"],
            status: "",
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
