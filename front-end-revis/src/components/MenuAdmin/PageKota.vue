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
					<v-list-item-title class="headline"> Kota </v-list-item-title>
					
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
                    @click="openDialog('Tambah Kota', 0)"
                >
					Tambah Kota
				</v-btn>
			</v-card-title>
		
        </v-card>
		
        <v-card>
			<v-data-table
				:headers="headers"
				:items="dataKota"
				:search="search"
				item-key="namaKota"
				class="elevation-1"
                :loading = "loadingState"
			>

                <template 
                    v-slot:[`item.namaKota`] ="{ item }"
                >
                    <td class="text-left">{{ item.namaKota }}</td>
                </template>
				
                <template v-slot:[`item.actions`]="{ item }">

                    <v-btn
						class="ma-2"
						outlined
						small
						color="primary"
						@click="getDataDialog(item);"
						><v-icon>mdi-pencil</v-icon>

                    </v-btn>

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
				
            <v-card-text class="mt-5 mb-0 pb-0">
                <v-container class="pb-0">
                    <v-text-field
                        v-model="formInput.namaKota"
                        label="Nama Kota"
                        class="mb-0"
                        outlined 
                        dense
                        clearable
                        required
                    ></v-text-field>
                
                </v-container>
            </v-card-text>
				
            <v-card-actions class="mt-0">
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
					<span class="headline"
						>Apakah Yakin Ingin Menghapus Kota</span
					>
				</v-card-title>

				<v-card-actions>
					<v-spacer></v-spacer>
					<v-btn color="blue darken-1" text @click="cancelConfirmation()"
						>Cancel</v-btn
					>
					<v-btn color="red darken-1" text @click="confirmDelete()"
						>Delete</v-btn
					>
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
    let token = cookiesHandle.getCookies();


    let axiosConfig = {
        headers : {
            'Authorization': "Bearer " + token,
        }
    }

	export default {
		name: "KotaList",

		data() {
			return {

                //data kota dari API diambil dan diinput disini
                dataKota : [],

                //object untuk penampung data;
                formInput: {},
                indexData : null,


                loadingState : true,

                dialog : false,
                dialogMessage : "",
                dialogMode : null,  //0 = tambah ; 1 = edit

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
						text: "Nama Kota",
                        //text align middle
                        align: "center",
						
						sortable: true,
						value: "namaKota",
                        width : "75%",
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
            this.getData();
        },

		methods: {

            getData(){

                this.setLoading(true);

                axios.get(API.BaseRoute + "kota", axiosConfig)
                    .then(response => {

                        this.dataKota = response.data.data;
                        this.setLoading(false);
                        
                    })
                    .catch(error => {

                        let option = {
                            color : "error",
                            icon : "mdi-alert-circle",
                            title : "Error",
                            text : ['Gagal Mengambil Data Kota', `Code Error : ${error.response.status}`],
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
				this.formInput = {}; 

			},

            openSnackbar(option = null){
                this.snackbarState = true;
                this.snackbarOption = option;
            },


			save() {
                //post data yoooo
                axios.post(API.BaseRoute + "kota", this.formInput, axiosConfig)
                    .then(() => {
                        

                        let option = {
                            color : "success",
                            icon : "mdi-check",
                            title : "Success",
                            text : ["Kota Berhasil Ditambahkan!"],
                        }

                        this.openSnackbar(option);

                        //ingat close dialog hanya pada saat sudah berhasil
                        this.closeDialog();

                        //mengambil ulang data setelah kita menambahkan data;
                        this.getData();

                        
                    })

                    .catch(error => {
                        console.log(error.response.data.message);

                        let option = {
                            color : "warning",
                            icon : "mdi-alert-circle",
                            title : "Warning",
                            text : ['Gagal Menambahkan Kota'],
                        }

                        //Ambil semua pesan errornya buat ditampilkan, ini seperti validation di backend
                        for(let errorAttribute in error.response.data.message){
                            option.text.push(`${error.response.data.message[errorAttribute]}`);
                        }

                        this.openSnackbar(option);
                    })
                

                
			},

            getDataDialog(value){
                //copy item withour pointer to formTodo
                this.formInput = Object.assign({}, value);
                this.openDialog("Edit Kota", 1);
            },

			saveUpdate() {

                axios.put(API.BaseRoute + `kota/${this.formInput.id}`, this.formInput, axiosConfig)
                    .then(() => {
                        
                        let option = {
                            color : "success",
                            icon : "mdi-check",
                            title : "Success",
                            text : ["Kota Berhasil Diupdate!"],
                        }

                        this.openSnackbar(option);

                        //ingat close dialog hanya pada saat sudah berhasil
                        this.closeDialog();

                        //mengambil ulang data setelah kita menambahkan data;
                        this.getData();
                        
                    })

                    .catch(error => {
                        console.log(error);

                        let option = {
                            color : "warning",
                            icon : "mdi-alert-circle",
                            title : "Warning",
                            text : ['Gagal Mengupdate Kota'],
                        }

                        //Ambil semua pesan errornya buat ditampilkan, ini seperti validation di backend
                        for(let errorAttribute in error.response.data.message){
                            option.text.push(`${error.response.data.message[errorAttribute]}`);
                        }

                        this.openSnackbar(option);
                    })

			},


            deleteItem(value){
                this.indexData = value;
                this.dialogDelete = true
            },  

            confirmDelete(){

                axios.delete(API.BaseRoute + `kota/${this.indexData}`, axiosConfig)
                    .then(() => {
                        
                        let option = {
                            color : "success",
                            icon : "mdi-check",
                            title : "Success",
                            text : ["Kota Berhasil Dihapus!"],
                        }

                        this.openSnackbar(option);

                        //mengambil ulang data setelah kita menambahkan data;
                        this.getData();
                    })

                    .catch(error => {
                        
                        let option = {
                            color : "error",
                            icon : "mdi-alert-circle",
                            title : "Error",
                            text : ['Gagal Menghapus Kota', `Code Error : ${error.response.status}`],
                        }

                        this.openSnackbar(option);

                    })
                
                this.dialogDelete = false
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
