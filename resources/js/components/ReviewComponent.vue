<template>
    <div class="container">
        <div class="col-md-12">
                <h3>Add an Item</h3>

            <form>
        <div class="form-group">
            <label for="itemName">Item</label>
            <input v-model="item.itemName" type="text" class="form-control" name="itemName" id="itemName" />
        </div>

        <div class="form-group">
            <label for="itemDescription">Item Description</label>
            <input v-model="item.itemDescription" type="text" class="form-control" name="itemDescription" id="itemDescription" />
        </div>


        <button @click="createItem" type="button" class="btn btn-primary">Add Item</button>
    </form>
            <table>
                <thead>
                <h3>ITEMS</h3>
                </thead>
                <tbody >
                    <tr v-for="(item, index) in items">
                        <td>{{item.id}}</td>
                        <td>{{item.itemName}}</td>
                        <td>{{item.itemDescription}}</td>
                        <td v-for="(review, index) in reviews" v-if="item.id === review.item_id"> <h3>Review</h3>{{review.reviewName}} {{review.item_id}}</td>

                    </tr>
                </tbody>
            </table>
                        <!-- <table>
                <thead>
                <h3>REVIEWS</h3>
                </thead>
                <tbody >
                    <tr v-for="(review, index) in reviews">
                        <td>{{review.reviewName}}</td>
                        <td>{{review.reviewDescription}}</td>

                    </tr>
                </tbody>
            </table> -->
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            item:{
                itemName:'',
                itemDescription:''
            }, 

        items:[],
        reviews:[],
        urlI: 'http://localhost:8000/api/items/',
        urlR: 'http://localhost:8000/api/reviews/', 
        }
    },

    methods:{
        loadItems(){
            axios.get(this.urlI)
                .then((response) =>{
                    this.items = response.data.items;
                            console.log(this.items);

            })  
                .catch(error =>{
                    console.log(error);
                });
        },

        createItem(){
            axios.post(this.urlI, { itemName:this.item.itemName, itemDescription:this.item.itemDescription})
            .then(response=>{
                console.log("created..." + response.data);
                this.items.push(response.data);
                this.loadItems();
            })
            .catch(error =>{
                console.log(error);
            });
        },

        loadReviews(){
            axios.get(this.urlR)
                .then((response) =>{
                    this.reviews = response.data.reviews;
                            console.log(this.reviews);

            })  
                .catch(error =>{
                    console.log(error);
                });
        }
    },

    mounted(){
        this.loadItems();
        this.loadReviews();


        console.log('ReviewComponent Mounted');
    }


}
</script>
