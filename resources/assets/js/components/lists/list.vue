<template>
    <div>
        <form @submit.prevent="save" class="modal" id="creatItem">
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Creat Item</h5>
                    </div>
                    
                    <div class="modal-body">
                        <form>
                            <div class="form-group" :class="{'has-danger': form.errors.has('title')}">
                                <label class="form-control-label">Title:</label>
                                <input type="text" class="form-control" name="title" id="title" v-model="form.title" placeholder="title">
                            </div>
                            <label class="error" v-if="form.errors.has('title')" v-text="errors.get('title')"></label>
                        </form>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary btn-md" type="submit">
                            Save
                            <i class="fa fa-spinner fa-spin" v-if="loading"></i>
                        </button>
                        <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>

        <button type="submit"  class="btn btn-primary" data-toggle="modal" data-target="#creatItem" style=" margin-left:300px; margin-bottom:20px; " >Creat Item
        </button>

        <form @submit.prevent="update" v-if="editting" class="modal" id="myModal">
            <div class="modal-dialog" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"> Update Item</h5>
                    </div>

                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="title">Name:</label>
                                <input type="text" v-model="formName" class="form-control" id="title">
                            </div>
                        </form>
                    </div>

                    <div class="modal-footer">
                            <button class="btn btn-primary btn-md" type="submit">
                                Update
                                <i class="fa fa-spinner fa-spin" v-if="loading"></i>
                            </button>
                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>

        <ul class="list-group">
            <li class="list-group-item" v-for="item in items">
                <label :value="'/item/' + item.key">{{ item.title }}</label>
                <button class="btn btn-xs btn-danger pull-right" @click="destroy(item)">
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    <i class="fa fa-spinner fa-spin" v-if="item.loading"></i>
                </button>
                <button class="btn btn-xs btn-info pull-right" data-toggle="modal" data-target="#myModal" @click="edit(item)">
                    Update &nbsp;
                </button>
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
                list: null,
                items: [],
                editting: false,
                loading: false,
                editingItem: null,
                formName: '',
                form: new Form({
                    title: '',
                    todo_list_id: '',
                }),
                
            }
        },
        props: {
            listId: null,
        },

        mounted() {
            this.getList();
        },

        methods: {
            
            getList() {
                List.get(this.listId, {include: 'items' }).then(list => {
                    this.list = list;
                    this.items = this.list.items.data;
                    this.loading = false;
                });
            },

            //delete button action 
            destroy(item) {
                item.loading = true;
                let form = new Form();
                form
                .delete('/api/item/' + item.key)
                .then(() => {
                    this.item = _.remove(this.item ,function(itemLs){
                        return itemLs.key = item.key;
                    });
                    this.getList();
                });
            },

            //button Save action
            save() {
                this.form.todo_list_id = this.listId;
                this.form.post('/api/item')
                    .then(({data}) => {
                        this.items.unshift(data);
                    });
                
                    $('#creatItem').modal('hide');
            },

            //action update button
            edit(item){
                this.editting = true;
                this.formName = item.title;
                this.editingItem = item;
               
            },

            //apply action submit update
            update() {

                axios
                .patch('/api/item/' + this.editingItem.key, {todo_list_id: this.listId, title: this.formName})
                .then( respones=> {
                    this.getList();
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
        text-align: center;
    }
    .btn {
        margin-left: 5px;
    }
    
</style>