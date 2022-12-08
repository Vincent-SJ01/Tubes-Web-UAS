<template>
    <v-main style="height: 100%">
        <center></center>

        <div class="d-flex justify-content-center" style="margin-top: 100px">
            <v-form v-model="valid" ref="form">
                <v-card persistent min-width="400px" elevation="8">
                    <v-card-title class="backgroundses">
                        <span class="headline"><b>Register</b></span>
                    </v-card-title>
                    <v-card-text>
                        <v-container>
                            <v-text-field label="Name" v-model="name" :rules="nameRules" required></v-text-field>
                            <v-text-field label="E-mail" v-model="email" :rules="emailRules" required></v-text-field>
                            <v-text-field label="Password" v-model="password" type="password" :rules="passwordRules"
                                required></v-text-field>
                        </v-container>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" @click="register"> Register </v-btn>
                    </v-card-actions>
                </v-card>
            </v-form>
        </div>

    </v-main>
</template>

<style scoped>
.backgroundses {
    background-color: #3ebfe2;
    justify-content: center;


}
</style>

<script>
export default {
    name: "ListItem",
    data() {
        return {
            color: "",
            valid: false,
            password: "",
            email: "",
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
