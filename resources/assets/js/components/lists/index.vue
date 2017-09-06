<template>
    <div>

    <form @submit.prevent="saveList" class="modal" id="creatList">
        <div class="thumbnail" >
            <div class="caption">
                <div class="form-group" :class="{'has-danger': form.errors.has('name')}">
                    <label>Name </label>
                    <input type="text" class="form-control" name="name" id="name" v-model="form.name" placeholder="Name">
                </div>
                <label class="error" v-if="form.errors.has('name')" v-text="errors.get('name')"></label>

                <div class="form-group"  >
                    <button class="btn btn-primary btn-md" style=" margin-left:45%; " >
                        Save
                        <i class="fa fa-spinner fa-spin" v-if="loading"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>

        <button type="submit"  class="btn btn-primary" data-toggle="modal" data-target="#creatList" style=" margin-left:300px; margin-bottom:20px; " >creat list
        </button>

        <form @submit.prevent="update" v-if="Editing" class="modal" id="myModal">
        <div class="thumbnail" >
            <div class="caption">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" v-model="formname" class="form-control" id="name">
                </div>
                <button type="submit"  class="btn btn-primary" >Submit</button>
                <button type="submit" @click="this.Editing = false" class="btn btn-default" style="float:right;">Close
                </button>

            </div>
        </div>
        </form>

        <ul class="list-group">
            <li class="list-group-item" v-for="list in lists">
                <a :href="'/list/' + list.key">{{ list.name }}</a>
                <button class="btn btn-xs btn-danger pull-right" @click="deleteList(list)">
                    Delete &nbsp;
                    <i class="fa fa-spinner fa-spin" v-if="list.loading"></i>
                </button>
                <button class="btn btn-xs btn-info pull-right" data-toggle="modal" data-target="#myModal" @click="editList(list)">
                    Update &nbsp;
                    <i class="fa fa-spin fa-spinner" v-if="list.loading"></i>
                </button>
                <small class="pull-right">{{ list.getCreatedDateFormatted() }} &nbsp;</small>
                <small class="pull-right">todo's {{ lists.items_count }} &nbsp;</small>
                 
            </li>
        </ul>

    </div>
</template>

<script>
    import List from '../../models/list';
    import Form from '../../utilities/form';

    export default {

        data() {
            return {
                lists: [],
                Editing: false,
                loading: false,
                editingList: null,
                formname: '',
                form: new Form({
                    name: ''
                }),
            }
        },

        mounted() {
            this.getLists();
        },

        methods: {
            
            //get method 
            getLists() {
                List.all().then(lists => {
                    this.lists = lists;
                    this.loading = false;
                });
            },

            // delete button action 
            deleteList(list) {
                list.loading = true;
                let form = new Form();
                form
                    .delete('/api/list/' + list.key)
                    .then(() => {
                        this.lists = _.remove(this.lists, function (listItem) {
                            return listItem.key != list.key;
                        });
                        list.loading = false;
                    });
                    this.Editing = false;
                    
            },

            //button save action
            saveList() {
                this.form.post('/api/list')
                    .then(data => {
                        this.lists.unshift(new List(data.data));
                    });
                    $('#creatList').modal('hide');
            },

            //action update button
            editList(list){
                this.Editing = true;
                this.formname = list.name;
                this.editingList = list;
               
            },

            //apply action submit update
            update() {
                
                axios.patch('/api/list/' + this.editingList.key, {name: this.formname})
                .then( response=> {
                    this.getLists();
                })
                $('#myModal').modal('hide');
                
            },

        }
    }

</script>

<style>
    .yellow {
        color: #096b6f;
    }
    .modal {
        
        padding-top: 90px;
        margin-right: 250px;
        margin-left: 250px;
    }
    
</style>