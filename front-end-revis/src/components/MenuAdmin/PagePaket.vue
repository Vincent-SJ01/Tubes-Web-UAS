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
				
			</v-card-title>
		
        </v-card>
		
        <v-card>
			<v-data-table
				:headers="headers"
				:items="dataPaket"
				:search="search"
				item-key="noResi"
                show-expand
				class="elevation-1"
			>

            
				
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

                <template v-slot:expanded-item="{ headers, item }">
                    <td :colspan="headers.length">
                        {{item.noResi}}
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
                
                <v-btn color="green darken-1" text @click="(dialogMessage == 'Tambah Kota') ? save() : saveUpdate()">
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
		name: "PaketList",
		data() {
			return {
                
                dialogDelete: false,
                itemIndex : -1,

                dialog : false,
                dialogMessage : "",


				search: null,
				timeout: 1000,
				itemContent: [],
				indexItem: null,
				headers: [
					{
						text: "Nomor Resi",
						sortable: true,

						value: "noResi",
                        width : "15%"
					},

                    {
                        text : "Pengirim",
                        sortable : true,

                        value : "idPengirim",
                        width : "20%"
                    },

                    {
                        text : "Jenis Paket",
                        sortable : true,

                        value : "jenisPaket",
                        width : "15%"
                    },

                    {
                        text : "Berat",
                        value : "berat",
                        width : "8%"
                    },

                    {
                        text : "Volume",
                        value : "volume",
                        width : "8%"
                    }, 

                    { 
                        text: "Actions", 
                        value: "actions", 
                        align : "center",
                        sortable: false,
                    },
				],

				dataPaket: [
					{
						noResi : "000000000",
                        idPengirim : "0",
                        jenisPaket : "Express", 
                        berat : 12,
                        volume : 14, 
                        penerima : "0",
					},
                    
                    {
                        noResi : "111111111",
                        idPengirim : "1",
                        jenisPaket : "Reguler",
                        berat : 12,
                        volume : 14,
                        penerima : "1",
                    },

                    {
                        noResi : "222222222",
                        idPengirim : "2",
                        jenisPaket : "Express",
                        berat : 12,
                        volume : 14,
                        penerima : "2",
                    }
				],

				formInput: {
					noResi : "",
                    idPengirim : "",
                    jenisPaket : "",
                    berat : "",
                    volume : "",
                    penerima : "",
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
                this.dataPaket.push(this.formInput);
                
                this.dialog = false;
                this.resetForm();
			},

			saveUpdate() {

                this.dataPaket[this.itemIndex].noResi = this.formInput.namaKota;
                
                this.dialog = false;
                this.resetForm();
			},

            getItemUpdate(item){
                //copy item withour pointer to formTodo
                this.formInput = Object.assign({}, item);
                this.itemIndex = this.dataKota.indexOf(item);
                
                this.openDialog("Edit Data");
            },

			resetForm() {
				this.formInput = {
					namaKota : null,
				};

			},
			//tambahkan code untuk delete data

            deleteItem(item){
                this.itemIndex = this.dataKota.indexOf(item)
                this.dialogDelete = true
            },  

            confirmDelete(){
                this.dataKota.splice(this.itemIndex, 1)
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
