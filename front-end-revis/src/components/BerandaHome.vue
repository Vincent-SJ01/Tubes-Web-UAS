<template>
    <div class="navbar">
        <nav class="navbar fixed-top navbar-dark navbar-expand-md justify-content-md-center justify-content-start">
            <div class="container-fluid">
                <img src="" alt="" width="30" height="30"   />
                <a class="navbar-brand judul"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                    aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav mx-auto my-2 my-lg-0 navbar-nav-scroll"
                        style="--bs-scroll-height: 100px; padding-right: 3.5rem" link>

                    </ul>
                    <ul class="nav navbar-nav flex-row justify-content-md-center justify-content-start flex-nowrap">
                        <div>
                            <router-link class="router" :to="{ path: '/login' }">
                                <button type="button" class="btn btn-outline-primary"
                                    style="color: #f0f0f0; margin-left: 79rem" >LOGIN</button>
                            </router-link>
                            <router-link class="router" :to="{ path: '/RegisterKurir' }">
                                <button type="button" class="btn btn-outline-primary"
                                    style="color: #f0f0f0; margin-left: 0.5rem">/ REGISTER KURIR</button>
                            </router-link>
                            <router-link class="router" :to="{ path: '/RegisterUser' }">
                                <button type="button" class="btn btn-outline-primary"
                                    style="color: #f0f0f0; margin-left: 0.5rem">/ REGISTER USER</button>
                                    <br>
                            </router-link>
                        </div>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="bg">
            <div class="container min-vh-100 d-flex align-items-center">
                <div class="text-left" style="color: #fff; position: absolute; top: 30%; left: 20%; right: 20%">
                    <h1>Yok Ngurir</h1>
                    <br />
                    <h4>Kami akan siap mengantar barang anda</h4>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "BeranadHome",
    data() {
        return {
            load: false,
            error_message: "",
            color: "",
        };
    },

    methods: {
        cekLogin() {
            
        },
        logout() {
            
        },
    },
};
</script>

<style scoped>
nav {
    background-color: #18191b;
}

a.router-link-exact-active {
    color: white !important;
}


button {
    font-size: 14px;
}
.bg {
    background-color: #f8f9fa;
    background-image: url("../assets/delivery.jpg");
    height: 900%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
</style>