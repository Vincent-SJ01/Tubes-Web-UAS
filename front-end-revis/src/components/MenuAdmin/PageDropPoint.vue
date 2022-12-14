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
					<v-list-item-title class="headline"> Drop Point </v-list-item-title>
					
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
                    @click="openDialog('Tambah Drop Point', 0)"
                >
					Tambah Drop Point
				</v-btn>
			</v-card-title>
		
        </v-card>
		
        <v-card>
			<v-data-table
				:headers="headers"
				:items="dataDropPoint"
				:search="search"
				item-key="namaDropPoint"
				class="elevation-1"
                :loading = "loadingState"
			>

                <template 
                    v-slot:[`item.namaDropPoint`] ="{ item }"
                >
                    <td class="text-left">{{ item.namaDropPoint }}</td>
                </template>


                <template 
                    v-slot:[`item.alamat`] ="{ item }"
                >
                    <td class="text-left">{{ item.alamat }}</td>
                </template>


                <template 
                    v-slot:[`item.kota.namaKota`] ="{ item }"
                >
                    <td class="text-left">{{ item.kota.namaKota }}</td>
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
				
            <v-card-text>
                <v-container>
                    <v-text-field
                        v-model="formInput.namaDropPoint"
                        label="Nama Drop Point"
                        required
                    ></v-text-field>


                    <v-text-field
                        v-model="formInput.alamat"
                        label="Alamat Lengkap"
                        required
                    ></v-text-field>

                    <v-select
                        :items="dataKota"
                        item-text="namaKota"
                        item-value="id"
                        label="Kota"
                        
                        v-model="formInput.idKota"
                        required


                    ></v-select>
                
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
                        Apakah Yakin Ingin Menghapus Drop Point?
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


    //nanti diganti pake cookies yaaa.. :")
    let token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYTBkMmQ0YWFkM2RkMTE2ZGZjYmZiZDFlN2ZiZjg3Y2E3MjUxZmEzZWVjMzI0ZmFmYzkyNjRkNGYwODIxM2U1MGY5MjM4M2RmMDI5MmYxYjUiLCJpYXQiOjE2NzA4NDIwOTcuMjUxOTc4LCJuYmYiOjE2NzA4NDIwOTcuMjUxOTgsImV4cCI6MTcwMjM3ODA5Ny4yNDU2Mywic3ViIjoiMiIsInNjb3BlcyI6W119.nSe1jHHpRZJwBubRUvZXgDQZCaFVkIS4Zt6MWtMQpqqxcj2aH4BIEX0bAMtCd1-JWUFZAC04rQfBwW0dFKRHDcLAxOrECk4cukEXuFReoF8bKjGUTDJT4GaGzUHHRhxmPotr0A36aKkmk9EAD4HNktEvb4ELQWSDqahzXXYTCSbBwvR-Vg4yvJfLXzxz_YM07qUWJ88Qzl-T3-FYFZNxFfsdLdonrDYom-ooeYIgcT5ZM2UNPQgclwvPTz7-wefgE0NHICdUZXhYiuKfWUsNZqw44JOBEpPffxoVYxSTKJQhE-apKRQla1jGqfGvVOMp1zmrrNtbBD2QIYX4n-HoSxLFxNWrvu6qpR46A5lZvHXtYbzeFBilXhrpR4pwEVTs8Df7xYk6daohiDqXuQtNMqJBtgHC9N1rHVN-JkbNFSXXwCig24PxwU7roOYK8CxLxqfYOu9r0aZL_9CbxjkwHvYBSwsiaskF1WDs4v38Bp4SW-CZ1CR21zqSBNaW0YIYTyIZl22s-YrKOy8fYgXRYh2NCudfxflQwj9MiAEoAmgmdY2EVI2-HbQBQNRJcFRLmtQuPWEriCY3L1Ir4T3eXl1qWVvz1danjmAPPPbufMcfntgdQOQo8KQSmXnq-zwy-8__QMWeimLWXJ2ei_0b4jxxn0_J7uUcHv6h9vDbiDg';

    let axiosConfig = {
        headers : {
            'Authorization': "Bearer " + token,
        }
    }


	export default {
		name: "DropPointList",

		data() {
			return {

                //data dropPoint dari API
                dataDropPoint: [],

                //sebagai dropDown-nya nanti;
                dataKota : [],

                //object untuk penampung data;
                formInput: {},
                indexData : null,


                loadingState : false,

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
				timeout: 1000,

				headers: [
					{
						text: "Drop Point",
						value: "namaDropPoint",

						sortable: true,
					},

                    {
                        text : "Alamat",
                        value : "alamat", 

                        sortable : true,
                    },

                    {
                        text : "Kota",
                        value : "kota.namaKota",

                        sortable : true,
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
            this.getDataDropPoint();
            this.getDataKota();
        },
    

		methods: {

            getDataKota(){

                axios.get('https://henryyg.com/ngurir/public/api/kota', axiosConfig)
                    .then((response) => {
                        this.dataKota = response.data.data;
                    })
                    .catch((error) => {

                        let option = {
                            color : "error",
                            icon : "mdi-alert-circle",
                            title : "Error",
                            text : ["Gagal Mengambil Data Kota", `Code Error : ${error.response.status}`],
                        }

                        this.openSnackbar(option);
                    })            
            },
    
            getDataDropPoint(){

                this.setLoading(true);

                axios.get('https://henryyg.com/ngurir/public/api/droppoint', axiosConfig)
                    .then((response) => {

                        this.dataDropPoint = response.data.data;
                        this.setLoading(false);

                    })
                    .catch((error) => {
                        console.log(error);

                        let option = {
                            color : "error",
                            icon : "mdi-alert-circle",
                            title : "Error",
                            text : ["Gagal Mengambil Data Drop Point", `Code Error : ${error.response.status}`],
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

                axios.post('https://henryyg.com/ngurir/public/api/droppoint', this.formInput, axiosConfig)
                    .then(() => {

                        let option = {
                            color : "success",
                            icon : "mdi-check-circle",
                            title : "Success",
                            text : ["Berhasil Menambahkan Data Drop Point"],
                        }

                        this.openSnackbar(option);

                        this.closeDialog();

                        this.getDataDropPoint();

                    })

                    .catch((error) => {

                        let option = {
                            color : "warning",
                            icon : "mdi-alert-circle",
                            title : "Warning",
                            text : ["Gagal Menambahkan Data Drop Point"],
                        }

                        for(let errorAttribute in error.response.data.message){
                            option.text.push(error.response.data.message[errorAttribute][0]);
                        }

                        this.openSnackbar(option);
                    })
                
			},

            getDataDialog(value){
                //copy item withour pointer to formTodo
                this.formInput = Object.assign({}, value);

                this.formInput.idKota = parseInt(this.formInput.idKota);
                
                this.openDialog("Edit Drop Point", 1);
            },

			saveUpdate() {

                axios.put(`https://henryyg.com/ngurir/public/api/droppoint/${this.formInput.id}`, this.formInput, axiosConfig)
                    .then(() => {

                        let option = {
                            color : "success",
                            icon : "mdi-check-circle",
                            title : "Success",
                            text : ["Berhasil Mengubah Data Drop Point"],
                        }

                        this.openSnackbar(option);

                        this.closeDialog();

                        this.getDataDropPoint();

                    })

                    .catch((error) => {
                        console.log(error);

                        let option = {
                            color : "warning",
                            icon : "mdi-alert-circle",
                            title : "Warning",
                            text : ["Gagal Mengubah Data Drop Point"],
                        }

                        for(let errorAttribute in error.response.data.message){
                            option.text.push(error.response.data.message[errorAttribute][0]);
                        }

                        this.openSnackbar(option);
                    })


			},

			
            deleteItem(value){
                this.indexData = value;
                this.dialogDelete = true
            },  

            confirmDelete(){

                axios.delete(`https://henryyg.com/ngurir/public/api/droppoint/${this.indexData}`, axiosConfig)
                    .then(() => {

                        let option = {
                            color : "success",
                            icon : "mdi-check-circle",
                            title : "Success",
                            text : ["Berhasil Menghapus Data Drop Point"],
                        }

                        this.openSnackbar(option);

                        this.getDataDropPoint();

                    })

                    .catch((error) => {

                        let option = {
                            color : "warning",
                            icon : "mdi-alert-circle",
                            title : "Warning",
                            text : ["Gagal Menghapus Data Drop Point", `Code Error : ${error.response.status}`],
                        }

                    
                        this.openSnackbar(option);
                    })

                this.dialogDelete = false;

            },

            cancelConfirmation(){
                console.log(this.formInput);
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
