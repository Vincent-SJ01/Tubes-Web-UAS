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
					<v-list-item-title class="headline"> Kurir </v-list-item-title>
					
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
				:items="dataKurir"
				:search="search"
				item-key="nama"
                show-expand
				class="elevation-1"
                :loading = "loadingState"
			>

                <template v-slot:expanded-item="{headers, item}">
                
                    <td :colspan="headers.length" class="pb-5 mb-5">

                        <div class="row mb-0 mt-0">
                            <div 
                                class="col-12 my-0 py-0 d-flex justify-center"
                                width = "100%">

                                <v-card 
                                    elevation="2" 
                                    class= "col-3 my-4 mx-1 pt-0 float-left"
                                    height="90px"
                                    color="#BBDEFB">

                                    <v-card-text class="mb-0 pb-0 black--text">
                                        Nomor Identitas Pendduk
                                    </v-card-text>

                                    <v-card-title class="mt-0 pt-1 ">
                                        {{ item.nik }}
                                    </v-card-title>

                                </v-card>

                                <v-card 
                                    elevation="2" 
                                    class= "col-3 my-4 mx-1 pt-0 float-left"
                                    height="90px"
                                    color="#BBDEFB">

                                    <v-card-text class="mb-0 pb-0 black--text">
                                        Email Kurir 
                                    </v-card-text>

                                    <v-card-title class="mt-0 pt-1">
                                        {{item.email}}
                                    </v-card-title>
                                    
                                </v-card>

                                <v-card 
                                    elevation="2" 
                                    class= "col-3 my-4 mx-1 pt-0 float-left"
                                    height="90px"
                                    color="#BBDEFB">


                                    <v-card-text class="mb-0 pb-0 black--text">
                                        username  
                                    </v-card-text>

                                    <v-card-title class="mt-0 pt-1">
                                        {{ item.username }}
                                    </v-card-title>
                                    
                                </v-card>

                            </div>

                        </div>
                        
                    </td>
                
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
			
            <v-toolbar color="brown darken-1" dark class="headline"> Edit Kurir </v-toolbar>
				
            <v-card-text>
                <v-container>

                    <v-text-field
                        v-model="formInput.nama"
                        label="Nama Kurir"
                        required
                    ></v-text-field>
                
                    
                    <v-text-field
                        v-model="formInput.noTelp"
                        label="Nomor Telp"
                        required
                    ></v-text-field>

                    <v-textarea
                        v-model="formInput.alamat"
                        label="Alamat"
                        required
                    ></v-textarea>

                    <v-menu
                        v-model="showDatePicker"
                        :close-on-content-click="false"
                        transition="scale-transition"
                        offset-y
                        max-width="290px"
                        min-width="auto"
                        >

                        <template v-slot:activator="{ on, attrs }">

                            <v-text-field
                                v-model="formInput.tanggalLahir"
                                label="Tanggal Lahir"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                            ></v-text-field>

                        </template>

                        <v-date-picker
                            v-model="formInput.tanggalLahir"
                            no-title
                            @input="showDatePicker = false"
                        ></v-date-picker>
                    
                    </v-menu>

                    
                    <v-select
                        v-model="formInput.gender"

                        :items="dataGender"
                        item-text="namaGender"
                        item-value="id"

                        label="Jenis Kelamin"
                        required
                    ></v-select>

                    <v-select
                        v-model="formInput.idStatus"

                        :items="dataStatus"
                        item-text="namaStatus"
                        item-value="id"

                        label="Status"
                        required
                    ></v-select>




                </v-container>
            
            </v-card-text>
				
            <v-card-actions>
                <v-spacer></v-spacer>
                
                <v-btn color="blue darken-1" text @click="cancelConfirmation()">
                    Cancel
                </v-btn>
                
                <v-btn color="green darken-1" text @click="saveUpdate()">
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
						>Apakah Yakin Ingin Menghapus Kurir</span
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


    //nanti diganti pake cookies yaaa.. :")
    let token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYjllMzM1NDNkNWUxMGVkMzhlYzEyZmRhYmI1ZWI2Njk2OTYxZmFmMjhlYzEyY2RkYmQ5NGUwZmExMzVjZWI2NmVmMGI3MzkxYTM1MjQ2Y2UiLCJpYXQiOjE2NzEwMTA4NDIuOTAyNDgyLCJuYmYiOjE2NzEwMTA4NDIuOTAyNDg0LCJleHAiOjE3MDI1NDY4NDIuODk5ODY0LCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.JT2dTphq413dmwjjWzjlLucLflRGHZK2LI_TMpCKwBZbLFEIBCxrzTG5f0aJo5BtYpzeYdwP_ePJpJWBEBZTqmEMLkW3Ax5LEwsnmD-_Lb6s6alLIe2YV_8fUQUlWus1-o7HQqQA5vDyiCkUXlIEi-WjJ6RMmCrvmBvEWpLkg4xuSe0JOS75CiVZe36w_dE3WGdocfCoBK1zDuVfW_v2tTCFA3KD9Vdm-0GZuPL_ayG-HYAfSyQ6GKKU0wWoTQ8Z2dVi42ZuQ8zuPxYAbfP9yU82cEcL5SZ9Rc7SM7GFuonBp1fSQUy3jpuSZjRDOYterD7OMGHDkiCIkltg_YAvLHd3iowfMPVP7K5ccqcmt9rRPP2dmJ6F_z-h994bqwq8eil9KrjjIo3zWuX_QzeWEE443akZfVw-jT35tCTUjuhwtA9ribUWCHuyv6hPXw6n6WFtVZFBkMUTMjnZ0d8Qzkx6znwnXM9_g1JDBMfa4Nj8i02Qr5rfh3xsBw-EWlVA6k1706-6JwAGFHRdKuuw8CS-J16YRqZHvbRtIHDU7RQzB5edifHgAEngGmWoVBkS03SFdy8Jxw5RBVGXkmQb80WQgJjTte-HkePfz02S678yPy8llqGWK6Vp266mCEmuN-YYiCa_2cWgAFadu0lvKtTPKbGu9SjCcW2sU9IRJtY';

    let axiosConfig = {
        headers : {
            'Authorization': "Bearer " + token,
        }
    } 


	export default {
		name: "KotaList",
		data() {
			return {

                //data utama kita
                dataKurir: [],

                dataGender : [],
                dataStatus : [], 

            
                //object untuk dialog
                formInput: {},
                indexData : null,

                loadingState : true,

                dialog : false,
                dialogMessage : "",
                
                dialogDelete: false,


                showDatePicker : false,


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
						text: "Nama Kurir",
						sortable: true,
						value: "nama",
					},

                    {
                        text : "No Telp",
                        sortable : false,
                        value : "noTelp",
                    },

                    {
                        text : "Alamat",
                        sortable : false,
                        value : "alamat",
                    },

                    {
                        text : "Tanggal Lahir",
                        sortable : true,
                        value : "tanggalLahir",
                    },
                    {
                        text : "Gender",
                        sortable : true,
                        value : "gender.namaGender"
                    },

                    {
                        text : "Status",
                        sortable : true,
                        value : "status.namaStatus"
                    },
                    { 
                        text: "Actions", 
                        value: "actions", 
                        sortable: false,
                    },
				],

				


			};
		},

        mounted(){
            this.getData();
            this.getGender();
            this.getStatus();
        },

		methods: {

            getGender(){
                axios.get('https://henryyg.com/ngurir/public/api/gender', axiosConfig)
                    .then(response => {
                        this.dataGender = response.data.data;
                    })

                    .catch(error => {

                        let option = {
                            color : "error", 
                            icon : "mdi-alert-circle",
                            title : "Error",
                            text : ['Gagal Mengambil Data Gender', `Code Error : ${error.response.status}`],
                        };

                        this.openSnackbar(option);
                    })
            },

            getStatus(){
                axios.get('https://henryyg.com/ngurir/public/api/status', axiosConfig)
                    .then(response => {
                        this.dataStatus = response.data.data;
                    })

                    .catch(error => {

                        let option = {
                            color : "error", 
                            icon : "mdi-alert-circle",
                            title : "Error",
                            text : ['Gagal Mengambil Data Status', `Code Error : ${error.response.status}`],
                        };

                        this.openSnackbar(option);
                    })
            },


            getData(){
                this.setLoading(true);

                axios.get('https://henryyg.com/ngurir/public/api/kurir', axiosConfig)
                    .then(response => {
                        this.dataKurir = response.data.data;
                        this.setLoading(false);

                        console.log(this.dataKurir);
                    })

                    .catch(error => {

                        let option = {
                            color : "error", 
                            icon : "mdi-alert-circle",
                            title : "Error",
                            text : ['Gagal Mengambil Data Kurir', `Code Error : ${error.response.status}`],
                        };

                        console.log(error); 

                        this.openSnackbar(option);
                        this.setLoading(false);
                    })
            },

            setLoading(value){
                this.loadingState = value;
            },

            
            openDialog(message){
                this.dialog = true;
                this.dialogMessage = message;
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


            getDataDialog(item){
                //copy item withour pointer to formTodo
                this.formInput = Object.assign({}, item);
                this.formInput.idStatus = parseInt(this.formInput.idStatus)
                
                this.openDialog("Edit Kurir");
            },

            saveUpdate() {

                axios.put(`https://henryyg.com/ngurir/public/api/kurir/${this.formInput.id}`, this.formInput, axiosConfig)
                    .then(() => {

                        let option = {
                            color : "success",
                            icon : "mdi-check",
                            title : "Success", 
                            text : ['Kurir Berhasil Diupdate!'],
                        }

                        this.openSnackbar(option);

                        this.closeDialog();

                        this.getData();
                    })

                    .catch(error => {
                        let option = {
                            color : "warning", 
                            icon : "mdi-alert-circle",
                            title : "warning",
                            text : ['Gagal Mengubah Data Kurir'],
                        };

                        for(let errorAttribute in error.response.data.message){
                            option.text.push(`${error.response.data.message[errorAttribute]}`);
                        }

                        this.openSnackbar(option);
                    })
            },


			//tambahkan code untuk delete data

            deleteItem(value){
                this.indexData = value
                this.dialogDelete = true
            },  

            confirmDelete(){
                
                axios.delete(`https://henryyg.com/ngurir/public/api/kurir/${this.indexData}`, axiosConfig)
                    .then(() => {

                        let option = {
                            color : "success",
                            icon : "mdi-check",
                            title : "Success", 
                            text : ['Kurir Berhasil Dihapus!'],
                        }

                        this.openSnackbar(option);

                        this.getData();

                    })

                    .catch(error => {

                        let option ={
                            color : "error",
                            icon : "mdi-alert-circle",
                            title : "Error",
                            text : ['Gagal Menghapus Data Kurir', `Code Error : ${error.response.status}`],
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
