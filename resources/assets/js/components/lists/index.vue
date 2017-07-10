<template>
    <div>
        <form @submit.prevent="saveList()">
            <div class="form-group" :class="{'has-danger': form.errors.has('name')}">
                <label class="" for="">Name </label>
                <input type="text" class="form-control" name="name" id="name" v-model="form.name" placeholder="Name">
            </div>
            <label class="error" v-if="form.errors.has('name')" v-text="errors.get('name')"></label>

            <div class="form-group">
                <button class="btn btn-primary" >
                    Save
                    <i class="fa fa-spinner fa-spin" v-if="loading"></i>
                </button>
            </div>
        </form>

        <ul class="list-group">
            <li class="list-group-item" v-for="list in lists">
                <a :href="'/list/' + list.key">{{ list.name }}</a>
                <button class="btn btn-xs btn-danger pull-right" @click="deleteList(list)">
                    Delete &nbsp;
                    <i class="fa fa-spinner fa-spin" v-if="list.loading"></i>
                </button>

                <small class="pull-right">{{ list.getCreatedDateFormatted() }} &nbsp;</small>
                <small class="pull-right">todo's {{ list.items_count }} &nbsp;</small>
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
                loading: false,
                form: new Form({
                    name: ''
                }),
            }
        },

        mounted() {
            this.getLists();
        },

        methods: {
            /**
             * Get the authenticated user lists.
             */
            getLists() {
                this.loading = true;
                List.all().then(lists => {
                    this.lists = lists;
                    this.loading = false;
                });
            },

            /**
             * Delete list
             *
             * @param list
             */
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
            },

            saveList() {
                this.form.post('/api/list')
                    .then(data => {
                        this.lists.unshift(new List(data.data));
                    });
            }
        }
    }
</script>

<style>
    .yellow {
        color: #096b6f;
    }
</style>