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
					<v-list-item-title class="headline"> Pengantaran </v-list-item-title>
					
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
				
			</v-card-title>
		
        </v-card>
		
        <v-card>
			<v-data-table
				:headers="headers"
				:items="dataPengantaran"
				:search="search"
				item-key="created_at"
				class="elevation-1"
                :loading = "loadingState"
			>
				
                <template v-slot:[`item.status.namaStatus`]="{ item }">
                        <v-card
                            large
                            label
                            width="100px"
                            :class="getColorClass(item.idStatus)"
                        >
                            {{ item.status.namaStatus }}
                        </v-card>
            
                </template>


                <template v-slot:[`item.actions`]="{ item }">

                    <v-btn 
                        class="ma-2" 
                        outlined 
                        small 
                        color="success"
                        :disabled="disableDelivery(item.idStatus)"
                        @click=deliveryPaket(item)
                    >
                        
                        <v-icon> mdi-truck-delivery </v-icon>
					</v-btn>


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
                
                <v-toolbar color="brown darken-1" dark class="headline"> Mengantar paket </v-toolbar>
                    
                <v-card-text class="mt-5 mb-0 pb-0">
                    <v-container class="pb-0">

                        <v-text-field
                            v-model="formInput.keterangan"
                            label="Keterangan"
                            class="mb-0 mt-5"
                            outlined 
                            dense
                            clearable
                            required
                        ></v-text-field>

                        <v-radio-group
                            v-model="formInput.idStatus"
                            row
                        >
                            <v-radio
                                label="Gagal"
                                value="0"
                            ></v-radio>

                            <v-radio
                                label="Berhasil"
                                value="1"
                            ></v-radio>
                            </v-radio-group>
                    
                    </v-container>
                </v-card-text>
                    
                <v-card-actions class="mt-0">
                    <v-spacer></v-spacer>
                    
                    <v-btn color="blue darken-1" text @click="cancelConfirmation()">
                        Cancel
                    </v-btn>
                    
                    <v-btn color="green darken-1" text @click="confirmDelivery()">
                        Save
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
		name: "PengantaranList",

		data() {
			return {

                dataPengantaran : [],

                //object untuk penampung data;
                tempObject: {},
                formInput : {}, 
                loadingState : true,

                dialogDelivery : false,
                
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
						text: "No Resi",						
						sortable: true,

						value: "noResi",
					},

                    {
						text: "Drop Point",
						sortable: true,
						value: "drop_point.namaDropPoint",
					},

                    {
						text: "Alamat",
                        //text align middle
						value: "paket.alamatTujuan",
					},

                    {
						text: "Status",
                        //text align middle
						value: "status.namaStatus",
					},

                    {
						text: "Keterangan",
                        //text align middle
						value: "keterangan",
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

        mounted(){
            this.getDataPengantaran();
        },

		methods: {

            getDataPengantaran(){

                this.setLoading(true);

                axios.get(API.BaseRoute + "pengantaranbykurir", axiosConfig)
                    .then(response => {


                        console.log(response.data.data)

                        this.dataPengantaran = response.data.data;
                        this.setLoading(false);
                        
                    })
                    .catch(error => {

                        let option = {
                            color : "error",
                            icon : "mdi-alert-circle",
                            title : "Error",
                            text : ['Gagal Mengambil Data Pengantaran', `Code Error : ${error.response.status}`],
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
            },

            deliveryPaket(value){
                this.tempObject = value;
                this.dialogDelivery = true;
            }, 

            resetForm() {
				this.formInput = {}; 

			},

            openSnackbar(option = null){
                this.snackbarState = true;
                this.snackbarOption = option;
            },

            cancelConfirmation(){
                this.dialogDelivery = false;
                this.closeDialog();
            },


            confirmDelivery(){

                let objectSend = {
                    idStatus : this.formInput.idStatus,
                    keterangan : this.formInput.keterangan,
                }

                //split created_at 
                let dateObject = this.tempObject.created_at.split("T");
                dateObject[1] = dateObject[1].substring(0, 8);

                let dateTemp = dateObject[0].split("-");
                let timeTemp = dateObject[1].split(":");
                
                let datetimeInput = new Date(dateTemp[0], dateTemp[1]-1, dateTemp[2], timeTemp[0], timeTemp[1], timeTemp[2], 0);
                datetimeInput.setHours(datetimeInput.getHours() + 7);

                var tzoffset = (new Date()).getTimezoneOffset() * 60000;
                let requestDate = new Date(datetimeInput - tzoffset).toISOString().slice(0, 19).replace('T', ' ');

    

                axios.put(API.BaseRoute + `updatestatuspengantaran/${this.tempObject.noResi}_${requestDate}`, objectSend, axiosConfig)
                    .then(() => {

                        let option = {
                            color : "success",
                            icon : "mdi-check",
                            title : "Success",
                            text : ["Berhasil Melakukan Tindakan Pengantaran!"],
                        }

                        this.openSnackbar(option);
                        this.closeDialog();
                        this.getDataPengantaran();
                    })
                    .catch(error => {
                        let option = {
                            color : "error",
                            icon : "mdi-alert-circle",
                            title : "Error",
                            text : ['Gagal Mengirim Paket', `Code Error : ${error.response.status}`],
                        }

                        this.openSnackbar(option);
                        this.closeDialog();
                    })


                    let paket = this.tempObject.paket;

                    let id = (this.formInput.idStatus.toString() == "0") ?  //apabila membatalkan, maka ubah menjadi pending
                            1
                        : (paket.idStatus == 2 || paket.idStatus == 7) ?   //kalau dari status dijemput atau dikirim, ubah menjadi diterima 
                            3 
                        :   5;  //kalau bukan semua, maka pasti diantar, kalau diantar, maka ubah menjadi selesai

                    console.log(id);

                    let updateData = {
                        idStatus : id,
                    }

                    axios.put(API.BaseRoute + `updatestatuspaket/${this.tempObject.noResi}`, updateData, axiosConfig)
                        .then((response) => {
                            
                            console.log(response)

                        })

                        .catch((error) => {

                            console.log(error);
                            
                            let option = {
                                color : "error",
                                icon : "mdi-alert-circle",
                                title : "Error",
                                text : ['Gagal Mengubah Data Paket!', `Code Error : ${error.response.status}`],
                            }

                            this.openSnackbar(option);
                        })


            },  

            disableDelivery(value){

                if(value == "2") return false; //hanya enabled kalau status diproses
                else return true;
            }, 

            getColorClass(value){

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
