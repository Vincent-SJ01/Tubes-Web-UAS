<template>
	<v-main class="list">
		<v-card>
			<v-list-item>
				<v-list-item-avatar>
					<img
						src="https://thumbs.dreamstime.com/b/cute-panda-bear-cartoon-chef-vector-cooking-cookie-sweet-bakery-cute-panda-bear-cartoon-chef-vector-cooking-cookie-sweet-bakery-216614619.jpg"
						alt="John"/>
                </v-list-item-avatar>
				
                <v-list-item-content>
					<v-list-item-title class="headline"> Paket </v-list-item-title>
					
                    <v-list-item-subtitle>By Ngurir</v-list-item-subtitle>
				</v-list-item-content>
			</v-list-item>

			<v-card-title>
			
                <v-text-field
					v-model="search"
					append-icon="mdi-magnify"
					label="Search"
					outlined
					hide
					details
					style="margin-top: 30px"
				>
            
                </v-text-field>
			
                <v-spacer></v-spacer>

                <v-btn 
                    color="primary" 
                    dark 
                    @click="openDialog('Tambah Paket', 0)"
                >
                    Tambah Paket
                </v-btn>
			    
				
			</v-card-title>
		
        </v-card>
		
        <v-card>
			<v-data-table
                dense
				:headers="headers"
				:items="dataPaket"
				:search="search"
				item-key="noResi"
                show-expand
				class="elevation-1"
                :loading = "loadingState"
            >
				
                <template v-slot:[`item.actions`]="{ item }">

                    <v-btn 
                        class="ma-2" 
                        outlined 
                        small 
                        color="error"
                        @click=deleteItem(item.id)
                    >
                        
                        <v-icon> mdi-trash-can-outline</v-icon>
						<!-- tambahkan dialog untuk konfirmasi delete agar bisa delete data -->
					</v-btn>

                </template>

                <template v-slot:expanded-item="{ headers, item }">
                    
                    <td :colspan="headers.length" class="pb-5 mb-5">

                        <div class="row mb-0 mt-0">
                            <div 
                                class="col-12 my-0 py-0 d-flex justify-center"
                                width = "100%">

                                <v-card 
                                    elevation="2" 
                                    class= "col-3 my-4 mx-4 pt-0 float-left"
                                    height="90px"
                                    color="#BBDEFB">

                                    <v-card-text class="mb-0 pb-0 black--text">
                                        Nama Penerima
                                    </v-card-text>

                                    <v-card-title class="mt-0 pt-1 ">
                                        {{ item.namaPenerima }}
                                    </v-card-title>

                                </v-card>

                                <v-card 
                                    elevation="2" 
                                    class= "col-3 my-4 mx-4 pt-0 float-left"
                                    height="90px"
                                    color="#BBDEFB">

                                    <v-card-text class="mb-0 pb-0 black--text">
                                        Nomor Telepon Penerima
                                    </v-card-text>

                                    <v-card-title class="mt-0 pt-1">
                                        {{ item.noTelpPenerima }}
                                    </v-card-title>
                                    
                                </v-card>

                                <v-card 
                                    elevation="2" 
                                    class= "col-3 my-4 mx-4 pt-0 float-left"
                                    height="90px"
                                    color="#BBDEFB">


                                    <v-card-text class="mb-0 pb-0 black--text">
                                        Alamat Penerima
                                    </v-card-text>

                                    <v-card-title class="mt-0 pt-1">
                                        {{ item.alamatTujuan }}
                                    </v-card-title>
                                    
                                </v-card>
                            </div>

                        </div>

                        <div class="row mt-0 py-0">
                            <div class="col-12 my-0 py-0">
                                <v-simple-table
                                    fixed-header
                                    height="200px">

                                    <template v-slot:default>
                                        <thead>
                                            <tr>
                                                <th class="text-left">Kurir</th>
                                                <th class="text-left">Drop Point</th>
                                                <th class="text-left">Keterangan</th>
                                                <th class="text-left">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="antar in item.pengantaran"
                                                :key="antar.noResi"
                                            >
                                                    <td>{{ antar.kurir.nama }}</td>
                                                    <td>{{ antar.drop_point.namaDropPoint }}</td>
                                                    <td>{{ antar.keterangan }}</td>
                                                    <td>{{ antar.status_paket.status }}</td>
                                            </tr>
                                        </tbody>

                                    </template>

                                </v-simple-table>
                            </div>
                        </div>
                        
                    </td>      
                

                </template>




            </v-data-table>

        </v-card>

        <v-dialog
			transition="dialog-top-transition"
			v-model="dialog"
			persistent
			max-width="600px"
		>

        <v-card>
			
            <v-toolbar color="brown darken-1" dark class="headline"> {{ dialogMessage }} </v-toolbar>
				
            <v-card-text>
                <v-container>
                    <v-text-field
                        v-model="formInput.namaKota"
                        label="Nama Kota"
                        required
                    ></v-text-field>
                
                </v-container>
            
            </v-card-text>
				
            <v-card-actions>
                <v-spacer></v-spacer>
                
                <v-btn color="blue darken-1" text @click="cancelConfirmation()">
                    Cancel
                </v-btn>
                
                <v-btn color="green darken-1" text @click="(dialogMode == 0) ? save() : saveUpdate()">
                    Save
                </v-btn>
            
            </v-card-actions>   
			
        </v-card>
		
        </v-dialog>
		

		<v-dialog 
            v-model="dialogDelete" 
            persistent max-width="600px">
			<v-card>
				<v-card-title>
					
                    <span class="headline">
                        Apakah Yakin Ingin Menghapus Kota
                    </span>

				</v-card-title>

				<v-card-actions>
					<v-spacer></v-spacer>
					
                    <v-btn color="blue darken-1" text @click="cancelConfirmation()">
                        Cancel
                    </v-btn>
					
                    <v-btn color="red darken-1" text @click="confirmDelete()">
                        Delete
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
<script>

    import axios from "axios";
    import * as API from "../../repository/APIRoute.js";
    import * as cookiesHandle from "../../repository/cookiesHandle.js";


    //nanti diganti pake cookies yaaa.. :")
    let token = cookiesHandle.getCookies("token");


    let axiosConfig = {
        headers : {
            'Authorization': "Bearer " + token,
        }
    }



	export default {
		name: "PaketList",
		data() {
			return {

                //data utama
                dataPaket : [],
                dataJenisPaket : [],

                formInput : {},
                indexData : null,
                
                loadingState : true,
         
                dialog : false,
                dialogMessage : "",
                dialogMode : null,
                
                dialogDelete: false,

                
                snackbarState : false,
                snackbarTimeout : 3000,
                snackbarOption : {
                    color : null,
                    icon : null,
                    title : null,
                    text : [],
                },


				search: null,
	
				headers: [
					{
						text: "Nomor Resi",
						sortable: true,

						value: "noResi",
					},

                    {
                        text : "Pengirim",
                        sortable : true,

                        value : "pengirim.nama",
                    },

                    {
                        text : "Jenis Paket",
                        sortable : true,

                        value : "jenis_paket.namaJenisPaket",
                    },

                    {
                        text : "Berat (Kg)",
                        value : "berat",

                        //add suffix : kg
                        

                    },

                    {
                        text : "Volume (cm³)",
                        value : "volume",
                    }, 

                    { 
                        text: "Actions", 
                        value: "actions", 
                        align : "center",
                        sortable: false,
                    },
				],

                pengantaranHeaders : [
                    {
                        text : "Kurir",
                        value : "kurir",
                    },
                    
                    {
                        text : "Drop Point",
                        value : "dropPoint",
                    }, 
                    
                    {
                        text : "Keterangan",
                        value : "keterangan",
                    },

                    {
                        text : "Status",
                        value : "status",
                    },
                    
                ],
			};
		},


        mounted(){
            this.getDataJenisPaket(); 
            this.getDataPaket();
        },


		methods: {
            
            getDataPaket(){

                this.setLoading(true);

                axios.get(API.BaseRoute + 'paketbyuser', axiosConfig)
                    .then((response) => {

                        this.dataPaket = response.data.data;

                        console.log(this.dataPaket);
                        this.setLoadingState(false);
                    
                    })
                    
                    .catch((error) => {
                        
                        let option = {
                            color : "error",
                            icon : "mdi-alert-circle",
                            title : "Error",
                            text : ['Gagal Mengambil Data Paket!', `Code Error : ${error.response.status}`],
                        }

                        this.openSnackbar(option);
                        this.setLoading(false);

                    })
            },

            getDataJenisPaket(){

                this.setLoading(true);

                axios.get(API.BaseRoute + 'jenispaket', axiosConfig)
                    .then((response) => {

                        this.dataJenisPaket = response.data.data;
                        this.setLoading(false);
                    
                    })
                    
                    .catch((error) => {
                        
                        let option = {
                            color : "error",
                            icon : "mdi-alert-circle",
                            title : "Error",
                            text : ['Gagal Mengambil Data Jenis Paket!', `Code Error : ${error.response.status}`],
                        }

                        this.openSnackbar(option);
                        this.setLoading(false);

                    })

            },

            setLoading(value){
                this.loadingState = value;
            },
            

            openDialog(message, mode){
                this.dialog = true;
                this.dialogMessage = message;
                this.dialogMode = mode;
            },

            closeDialog(){
                this.dialog = false;
                this.resetForm();
            },

			resetForm() {
				this.formInput = {
					namaKota : null,
				};

			},

            openSnackbar(option = null){
                this.snackbarState = true;
                this.snackbarOption = option;
            },


			//tambahkan code untuk delete data

            deleteItem(value){
                this.indexData = value;
                this.dialogDelete = true;
            },  

            confirmDelete(){

                axios.delete(API.BaseRoute + `paket/${this.indexData}`, axiosConfig)
                    .then(() => {

                        let option = {
                            color : "success",
                            icon : "mdi-check-circle",
                            title : "Success",
                            text : ['Berhasil Menghapus Data Paket!'],
                        }

                        this.openSnackbar(option);

                        this.getDataPaket();                    
                    })
                    
                    .catch((error) => {
                        
                        let option = {
                            color : "error",
                            icon : "mdi-alert-circle",
                            title : "Error",
                            text : ['Gagal Menghapus Data Paket!', `Code Error : ${error.response.status}`],
                        }

                        this.openSnackbar(option);

                    })

                this.dialogDelete = false;
            },

            cancelConfirmation(){
                this.dialogDelete = false;
                this.closeDialog();
            },
            
		},
	};
</script>
<style>
	.text {
		font-family: "Franklin Gothic Medium", "Arial Narrow", Arial, sans-serif;
		font-size: 40px;
		font-style: italic;
	}
</style>
