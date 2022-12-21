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

                <v-select
					:items="dataStatusPaket"
                    item-text="status"
                    item-value="status"
                    outlined
                    style="margin-top: 30px"
					v-model="filterStatus"
					class="ms-5"
					label="Status Paket">
				</v-select>
			
                <v-spacer></v-spacer>
				
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
                        color="success"
                        :disabled="disableDelivery(item.idStatus)"
                        @click=deliveryItem(item)
                    >
                        
                        <v-icon> mdi-truck-delivery </v-icon>
						<!-- tambahkan dialog untuk konfirmasi delete agar bisa delete data -->
					</v-btn>

                    <v-btn 
                        class="ma-2" 
                        outlined 
                        small 
                        color="error"
                        :disabled="disableDelivery(item.idStatus)"
                        @click=cancelItem(item.noResi)
                    >
                        
                        <v-icon> mdi-trash-can-outline</v-icon>
					</v-btn>

                </template>


                <template
                    v-slot:[`item.status_paket.status`]="{ item }"
                >
                    <v-card
                        large
                        label
                        width="100px"
                        :class="getColorClass(item.idStatus)"
                    >
                        {{ item.status_paket.status }}
                    </v-card>
            
            
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
                                                :key="antar.created_at"
                                            >
                                                    <td>{{ antar.kurir.nama }}</td>
                                                    <td>{{ (antar.drop_point)? antar.drop_point.namaDropPoint : " " }}</td>
                                                    <td>{{ antar.keterangan }}</td>

                                                    <td>
                                                        <v-card
                                                            large
                                                            label
                                                            width="100px"
                                                            :class="getColorStatus(antar.idStatus)"
                                                        >
                                                            {{ getPengantaranStatus(antar.idStatus) }}
                                                        </v-card>
                                                    </td>
                                                        
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
			v-model="dialogDelivery"
			persistent
			max-width="600px"
		>

            <v-card>
                
                <v-toolbar color="brown darken-1" dark class="headline"> Delivery Paket </v-toolbar>
                    
                <v-card-text>
                    <v-container>
                        <v-select
                            v-model="formDelivery.nikKurir"
                            label="Kurir"
                            class="mb-0"
                            outlined 
                            dense
                            required
                            :items="filteredDataKurir"
                            item-text="nama"
                            item-value="nik"
                        ></v-select>

                        <v-select
                            v-model="formDelivery.idDropPoint"
                            label="Drop Point"
                            class="mb-0"
                            outlined 
                            dense
                            required
                            :items="dataDropPoint"
                            :disabled="checkAntar"
                            item-text="namaDropPoint"
                            item-value="id"
                        ></v-select>

                        <v-checkbox
                            v-model="checkAntar"
                            :disabled="(tempPaket.idStatus == 1)"
                            label="Antar ke Penerima?">
                        </v-checkbox>
                    
                    </v-container>
                
                </v-card-text>
                    
                <v-card-actions>
                    <v-spacer></v-spacer>
                    
                    <v-btn color="blue darken-1" text @click="cancelConfirmation()">
                        Cancel
                    </v-btn>
                    
                    <v-btn color="green darken-1" text @click="save()">
                        Save
                    </v-btn>
                
                </v-card-actions>   
                
            </v-card>
		
        </v-dialog>
		

		<v-dialog 
            v-model="dialogCancel" 
            persistent 
            max-width="625px">
			<v-card>
				<v-card-title>
					
                    <span class="headline">
                        Apakah Yakin Ingin Membatalkan Pengiriman Paket?
                    </span>

				</v-card-title>

				<v-card-actions>
					<v-spacer></v-spacer>
					
                    <v-btn color="blue darken-1" text @click="cancelConfirmation()">
                        Cancel
                    </v-btn>
					
                    <v-btn color="red darken-1" text @click="confirmCancel()">
                        Confirm
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
                dataKurir : [],
                dataDropPoint : [],
                dataJenisPaket : [],
                dataStatusPaket : [],

                tempPaket : {}, 
                formInput : {},
                formDelivery : {},
                indexData : null,

                filterStatus : "All",
                checkAntar : false, //untuk cek apakah paket antar atau tidak
                
                loadingState : true,
                
                dialogDelivery : false,
                dialogCancel: false,

                
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
                        text : "Status",
                        value : "status_paket.status",

                        filter : value => {
							if(this.filterStatus == "" || this.filterStatus == "All"){
								return true;
							}

							return value == this.filterStatus;
						} 
                    },

                    { 
                        text: "Actions", 
                        value: "actions", 
                        align : "center",
                        sortable: false,
                    },
				],
			};
		},

        computed : {

            filteredDataKurir(){
                return this.dataKurir.filter((item) => item.idStatus == 1)
            }

        },
        


        mounted(){
            this.getDataKurir(); 
            this.getDataDropPoint();
            this.getDataJenisPaket(); 
            this.getDataPaket();
            this.getDataStatusPaket();
        },


		methods: {

            getDataKurir(){
                axios.get(API.BaseRoute + 'kurir', axiosConfig)
                    .then((response) => {

                        this.dataKurir = response.data.data;
                        this.setLoading(false);
                    
                    })
                    
                    .catch((error) => {
                        
                        let option = {
                            color : "error",
                            icon : "mdi-alert-circle",
                            title : "Error",
                            text : ['Gagal Mengambil Data Kurir!', `Code Error : ${error.response.status}`],
                        }

                        this.openSnackbar(option);
                        this.setLoading(false);

                    })
            },

            getDataDropPoint(){
                axios.get(API.BaseRoute + 'droppoint', axiosConfig)
                    .then((response) => {

                        this.dataDropPoint = response.data.data;
                        this.setLoading(false);
                    
                    })
                    
                    .catch((error) => {
                        
                        let option = {
                            color : "error",
                            icon : "mdi-alert-circle",
                            title : "Error",
                            text : ['Gagal Mengambil Data Drop Point!', `Code Error : ${error.response.status}`],
                        }

                        this.openSnackbar(option);
                        this.setLoading(false);

                    })
            }, 
            
            getDataPaket(){

                this.setLoading(true);

                axios.get(API.BaseRoute + 'paket', axiosConfig)
                    .then((response) => {

                        this.dataPaket = response.data.data;

                        console.log(this.dataPaket);
                        this.setLoading(false);
                    
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

            getDataStatusPaket(){
                    
                    this.setLoading(true);
    
                    axios.get(API.BaseRoute + 'statuspaket', axiosConfig)
                        .then((response) => {
    
                            this.dataStatusPaket = response.data.data;

                            this.dataStatusPaket.unshift({
                                id : 0,
                                status : "All",
                            })

                            this.setLoading(false);
                        
                        })
                        
                        .catch((error) => {
                            
                            let option = {
                                color : "error",
                                icon : "mdi-alert-circle",
                                title : "Error",
                                text : ['Gagal Mengambil Data Status Paket!', `Code Error : ${error.response.status}`],
                            }
    
                            this.openSnackbar(option);
                            this.setLoading(false);
    
                        })
    
            },
            

            setLoading(value){
                this.loadingState = value;
            },
            

            closeDialog(){
                this.dialogDelivery = false;
                this.resetForm();
                this.resetDelivery();
            },

			resetForm() {
				this.formInput = {}

			},

            resetDelivery(){
                this.formDelivery = {};
            },

            openSnackbar(option = null){
                this.snackbarState = true;
                this.snackbarOption = option;
            },


			//tambahkan code untuk delete data
            cancelItem(value){
                this.indexData = value;
                this.dialogCancel = true;
            },  


            deliveryItem(value){
                this.tempPaket = value; 
                this.indexData = value.noResi; 
                this.dialogDelivery = true;
            },

            save(){

                this.formDelivery.noResi = this.indexData;
                this.formDelivery.keterangan = "-";

                //route 2 artinya diproses yaaa... 
                this.formDelivery.idStatus = 2; 

                axios.post(API.BaseRoute + "pengantaran", this.formDelivery, axiosConfig)
                    .then(() => {

                        let option = {
                            color : "success",
                            icon : "mdi-check-circle",
                            title : "Success",
                            text: ['Berhasil Menambahkan Data Pengantaran!'],
                        }   

                        this.openSnackbar(option);
                        this.getDataPaket();
                        this.closeDialog();
                    })

                    .catch((error) => {
                        
                        let option = {
                            color : "error",
                            icon : "mdi-alert-circle",
                            title : "Error",
                            text : ['Gagal pengantaran', `Code Error : ${error.response.status}`],
                        }

                        for(let errorAttribute in error.response.data.message){
                            option.text.push(`${error.response.data.message[errorAttribute][0]}`);
                        }

                        this.openSnackbar(option);
                        this.closeDialog();
                    })


                
                let id = (this.tempPaket.idStatus.toString() == "1") ? 2 : (this.checkAntar == true) ? 4 : 7;

                let updateData = {
                    idStatus : id,
                }

                axios.put(API.BaseRoute + `updatestatuspaket/${this.indexData}`, updateData, axiosConfig)
                    .then(() => {
                        this.getDataPaket();
                    })

                    .catch((error) => {
                        
                        let option = {
                            color : "error",
                            icon : "mdi-alert-circle",
                            title : "Error",
                            text : ['Gagal Mengubah Data Paket!', `Code Error : ${error.response.status}`],
                        }

                        this.openSnackbar(option);
                    })
                
                
            },

            confirmCancel(){

                //idStatus 6 artinya batal
                let updateData = {
                    idStatus : 6,
                } 

                axios.put(API.BaseRoute + `updatestatuspaket/${this.indexData}`, updateData,  axiosConfig)
                    .then(() => {

                        let option = {
                            color : "success",
                            icon : "mdi-check-circle",
                            title : "Success",
                            text : ['Berhasil Membatalkan Pengiriman Paket'],
                        }

                        this.openSnackbar(option);
                        this.getDataPaket();                    
                    })
                    
                    .catch((error) => {
                        
                        let option = {
                            color : "error",
                            icon : "mdi-alert-circle",
                            title : "Error",
                            text : ['Gagal Membatalkan Pengiriman Paket', `Code Error : ${error.response.status}`],
                        }

                        this.openSnackbar(option);

                    })

                this.dialogCancel = false;
                this.setLoading(false);
            },

            cancelConfirmation(){
                this.dialogCancel = false;
                this.closeDialog();
            },

            getColorClass(value){

                value = parseInt(value);

                switch(value){

                    //pending
                    case 1 : 
                        return "amber lighten-1 text-center pa-1";

                    //dijemput, dikirim, ataupun diantar
                    case 2 : 
                    case 4 : 
                    case 7 : 
                        return "blue lighten-1 text-center pa-1";

                    //diteirma atau selesai
                    case 3 : 
                    case 5 : 
                        return "green lighten-1 text-center pa-1";

                    //batal
                    case 6 : 
                        return "red lighten-1 text-center pa-1";
                        
                }
                
            },

            getColorStatus(value){
                switch(value){
                    //gagal
                    case "0" : 
                        return "red lighten-1 text-center pa-1";

                    //Selesai
                    case "1" : 
                        return "green lighten-1 text-center pa-1";

                    //dijemput, dikirim, ataupun diantar
                    case "2" : 
                        return "blue lighten-1 text-center pa-1";
                }
            },

            getPengantaranStatus(value){

                switch(value){
                    //gagal
                    case "0" : 
                        return "Gagal";

                    //Selesai
                    case "1" : 
                        return "Berhasil";

                    //dijemput, dikirim, ataupun diantar
                    case "2" : 
                        return "Diproses";
                    }
            },

            disableDelivery(value){
                
                //apabila statusnya pending atau diterima, baru deh bisa dikirim
                if(value == "1" || value == "3") return false; 

                return true;

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
