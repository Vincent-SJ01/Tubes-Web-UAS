<template>
    <v-main>
        <v-card>
            <v-card-title>Drop Point</v-card-title>

            <v-card-title>
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Search"
                    outlined
                    hide
                    details
                    style="margin-top: 30px">
                </v-text-field>

                <v-spacer></v-spacer>

                <v-btn 
                    color="success" 
                    dark 
                    @click="showDialog()"
                >    
                    Tambah Drop Point
                </v-btn>
                
            </v-card-title>
        </v-card>

        <v-card>
            <v-data-table 
                :headers="headers" 
                :items="dropPoint" 
                :search="search"
            >

                <template v-slot:[`item.actions`]="{ item }">
                    <v-btn small class="mr-2 blue-grey lighten-3" @click="editItem(item)">Edit</v-btn>
                    <v-btn small class="mr-2 blue-grey lighten-3" @click="deleteItem(item)">Delete</v-btn>
                </template>
            </v-data-table>
        </v-card>

        <p>testing</p>

        <v-dialog 
            v-model="dialog" 
            persistent 
            max-width="600px"
        >

            <v-card>
                
                <v-card-title>
                    <span class="headline">Drop Point</span>
                </v-card-title>

                <v-card-text>
                    <v-container>
                        <v-text-field
                            v-model="formInput.dropPoint"
                            label="Task"
                            required>
                        </v-text-field>

                        <v-textarea
                            v-model="formInput.alamat"
                            label="Note"
                            required>
                        </v-textarea>

                        <v-select
                            v-model="formInput.kota"
                            :items="['Belum Selesai', 'Selesai']"
                            label="Status"
                            required>
                        </v-select>

                    </v-container>
                </v-card-text>
                
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="cancel">Cancel</v-btn>
                    <v-btn color="blue darken-1" text @click="save">Save</v-btn>
                </v-card-actions>
                    
            </v-card>
        </v-dialog>

        <p>testing 2s</p>
        
    </v-main>


</template>

<script>
    export default {

        name : "ListDropPoint",

        data(){
            return {
                search : null, 
                dialog : false,
                edit : false,

                headers : [
                    {
                        text : 'DropPoint',
                        align : "start",
                        sortable : true,
                        value : 'dropPoint'
                    }, 
                    { text : 'Alamat', value : 'alamat' },
                    { text : 'Kota', value : 'kota' },
                    { text : 'Actions', value : 'actions'}, 
                ],

                dropPoint : [
                    {
                        dropPoint : "DropPoint 1",
                        alamat : "Jl. Raya Cibubur",
                        kota : "Jakarta Timur",
                    },
                    {
                        dropPoint : "DropPoint 2",
                        alamat : "Jl. Raya Sentani",
                        kota : "Jayapura",

                    },
                    {
                        dropPoint : "DropPoint 3",
                        alamat : "Jl. Raya Rayaan",
                        kota : "Sulawesi Timur",
                        
                    }

                ],

                formInput : {
                    dropPoint : null,
                    alamat : null,
                    kota : null,
                },
            };
        }, 

        methods : {

            showDialog(){
                this.dialog = true;
            },

            save(){

                if(this.edit == false){
                }else{
                    // const index = this.todos.indexOf(this.formTodo);
                    this.edit = false; 
                }
                this.resetForm();
                this.dialog = false;
            },

            cancel(){
                this.resetForm();
                this.dialog = false;
            },
            resetForm(){

                this.formInput = Object.assign({}, {
                    dropPoint : null,
                    alamat : null,
                    kota : null,
                });
            },

            editItem(item){
                this.edit = true;
                this.dialog = true;

            },
            
            deleteItem(item){
                // const index = this.todos.indexOf(item);
                // this.todos.splice(index, 1);
            }
        }
    }
</script>

<style>
.text {
    font-family : 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
    font-size : 40px;
    font-style : italic; 
}

</style>