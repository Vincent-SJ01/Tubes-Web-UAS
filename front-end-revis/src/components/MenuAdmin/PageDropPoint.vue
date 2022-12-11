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
                    @click="openDialog('Tambah Drop Point')"
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
                    v-slot:[`item.kota`] ="{ item }"
                >
                    <td class="text-left">{{ item.kota }}</td>
                </template>
				
                <template v-slot:[`item.actions`]="{ item }">

                    <v-btn
						class="ma-2"
						outlined
						small
						color="primary"
						@click="getItemUpdate(item);"
						><v-icon>mdi-pencil</v-icon>

                    </v-btn>

                    <v-btn 
                        class="ma-2" 
                        outlined 
                        small 
                        color="error"
                        @click=deleteItem(item)
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
                        v-model="formInput.idKota"
                        label="Kota"
                        required
                    ></v-select>
                
                </v-container>
            
            </v-card-text>
				
            <v-card-actions>
                <v-spacer></v-spacer>
                
                <v-btn color="blue darken-1" text @click="cancelConfirmation()">
                    Cancel
                </v-btn>
                
                <v-btn color="green darken-1" text @click="(dialogMessage == 'Tambah Drop Point') ? save() : saveUpdate()">
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


	</v-main>

    
</template>
<script>
	export default {
		name: "KotaList",
		data() {
			return {
                
                dialogDelete: false,
                itemIndex : -1,

                dialog : false,
                dialogMessage : "",


				search: null,
				timeout: 1000,

				indexItem: null,
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
                        value : "idKota",

                        sortable : true,
                    },

                    { 

                        text: "Actions", 
                        value: "actions", 
                        align : "center",
                        sortable: false,
                    },
				],

				dataDropPoint: [
					{
						id : 0,
                        namaDropPoint : "Drop Point A",
                        alamat : "Alamat 1",
                        idKota : 0,
					},

                    {
                        id : 1, 
                        namaDropPoint : "Drop Point B",
                        alamat : "Alamat 2",
                        idKota : 1,
                    },

                    {
                        id : 2,
                        namaDropPoint : "Drop Point C",
                        alamat : "Alamat 3",
                        idKota : 2,

                    }
                    
				],

                dataKota: [
                    {
                        id: 0,
                        namaKota: "Jakarta",
                    },

                    {
                        id: 1,
                        namaKota: "Bandung",
                    },

                    {
                        id: 2,
                        namaKota: "Surabaya",
                    },
                ],

				formInput: {
					id : null,
                    namaDropPoint : "",
                    alamat : "",
                    idKota : null,
				},
			};
		},
		methods: {
            
            openDialog(message){
                this.dialog = true;
                this.dialogMessage = message;
            },

			save() {
				// tambahkan code untuk dapat menyimpan data yang ingin ditambah
                this.dataDropPoint.push(this.formInput);
                
                this.dialog = false;
                this.resetForm();
			},

			saveUpdate() {

                this.dataDropPoint[this.itemIndex].namaDropPoint = this.formInput.namaDropPoint;
                this.dataDropPoint[this.itemIndex].alamat = this.formInput.alamat;
                this.dataDropPoint[this.itemIndex].idKota = this.formInput.idKota;
                
                this.dialog = false;
                this.resetForm();
			},

            getItemUpdate(item){
                //copy item withour pointer to formTodo
                this.formInput = Object.assign({}, item);
                this.itemIndex = this.dataDropPoint.indexOf(item);
                
                this.openDialog("Edit Data");
            },

			resetForm() {
				this.formInput = {
                    id : null,
					namaDropPoint : null,
                    alamat : null,
                    idKota : null,
				};

			},
			//tambahkan code untuk delete data

            deleteItem(item){
                this.itemIndex = this.dataDropPoint.indexOf(item)
                this.dialogDelete = true
            },  

            confirmDelete(){
                this.dataDropPoint.splice(this.itemIndex, 1)
                this.dialogDelete = false
            },

            cancelConfirmation(){
                this.dialogDelete = false;
                this.dialog = false;
                this.resetForm();
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
