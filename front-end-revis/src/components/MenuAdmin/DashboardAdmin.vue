<template>
	<div class="dashboard">
		<v-navigation-drawer
			class="fullheight"
			widht="256"
			v-model="drawer"
			absolute
			temporary
			color="grey lighten-5"
            position="fixed">
            
			<v-list-item>
				<v-list-item-content>
					<v-list-item-title class="title">Ngurir</v-list-item-title>
					<v-list-item-subtitle>Admin Page</v-list-item-subtitle>
				</v-list-item-content>
			</v-list-item>

			<v-divider></v-divider>

			<v-list dense nav>
				<v-list-item
					v-for="item in items"
					:key="item.title"
					color="light-blue darken-4"
					link
                    tag="router-link"
                    :to="{name : item.name}"
                >

					<v-list-item-content>
						<v-list-item-title>{{ item.title }}</v-list-item-title>
					</v-list-item-content>

				</v-list-item>
			</v-list>

            <template v-slot:append>

                <div class="pa-2">
                
                    <v-btn 
                        block
                        
                        tag="router-link"
                        :to="{name : 'Beranda'}"
                        color="red lighten-3"
                        dark
                    >
                    Logout</v-btn>
                
                </div>

            </template>


		</v-navigation-drawer>


        <v-app-bar color="red lighten-3" dark>

            <v-app-bar-nav-icon 
                @click="drawer = true"
                color="white">
            </v-app-bar-nav-icon>

            <v-spacer></v-spacer>

        </v-app-bar>

        <div class="fullheight pa-5">

            <router-view height="90vh"></router-view>

        </div>

	</div>
</template>

<script>
    export default {
        name: "DashboardIndex",
        data() {
            return {
                drawer: false,
                group : null, 
                items: [
                    { 
                        title: "Kota", 
                        name: "Admin.Kota",
                    },
    
                    { 
                        title: "Drop Point", 
                        name: "Admin.DropPoint", 
                    },
					
                    { 
                        title: "Kurir", 
                        name: "Admin.Kurir" 
                    },
					
                    { 
                        title: "Paket", 
                        name: "Admin.Paket" 
                    },

                    //logout path, position bottom


                ],
            };
        },
    };
</script>



<style scoped>
    .fullheight {
        min-height: 100vh !important;
    }
</style>