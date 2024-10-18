<template>
    <div>
        <div class="bg-gray-800 pt-8 pb-20">
            <div class="w-9/12 text-center mr-auto ml-auto -mt-0 mb-0">
                <h1 class="text-orange text-5xl p-10">Book Shop</h1>
                <p class="w-9/12 mr-auto ml-auto -mt-0 mb-0 text-white">Cupcake ipsum dolor sit amet croissant. I love
                    topping candy canes sweet roll croissant caramels. Soufflé macaroon liquorice chocolate tart I love.
                </p>
            </div>
        </div>
        <div class="w-1/5 text-left mr-auto ml-auto -mt-0 mb-0">
            <form @submit.prevent="submit()">
                <div class="pt-10">
                    <h2 class="text-center text-3xl pb-10">Edit Book</h2>
                    <div class="pb-10">
                        <label class="w-20 inline-block">Title: </label>
                        <input type="text" placeholder="Title" v-model="title"
                            class="rounded-md border-gray-400 border-solid border-[1px] p-2 w-96">
                    </div>
                    <div class="pb-10">
                        <label class="w-20 inline-block">Author: </label>
                        <input type="text" placeholder="Author" v-model="author"
                            class="rounded-md border-gray-400 border-solid border-[1px] p-2 w-96">
                    </div>
                    <div class="pb-10">
                        <label class="w-20 inline-block">Rating: </label>
                        <input type="number" min="0" max="10" placeholder="5" v-model="rating"
                            class="rounded-md border-gray-400 border-solid border-[1px] p-2 w-96">
                    </div>
                </div>
                <div class="text-center">
                    <button class="text-white bg-orange py-2 px-4 rounded" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'EditBook',
    data() {
        return {
            id: null,
            title: '',
            author: '',
            rating: ''
        }
    },
    computed: {
    },
    methods: {
        async submit() {
            try {
                const response = await axios.put(`/api/books/${this.id}`, {
                    title: this.title,
                    author: this.author,
                    rating: Number(this.rating)
                });
                alert('Book updated successfully');
            } catch (error) {
                console.error('Error updating book:', error);
                alert('Failed to update the book');
            }
        },
        async getBook() {
            try {
                const bookId = this.getBookIdFromUrl();
                const { data } = await axios.get(`/api/books/${bookId}`);

                const { id, title, author, rating } = data.data;
                this.id = id;
                this.title = title;
                this.author = author;
                this.rating = rating;
            } catch (error) {
                console.error('Error fetching book details:', error);
                alert('Failed to fetch book details');
            }
        },
        getBookIdFromUrl() {
            const urlSegments = window.location.pathname.split("/");
            return urlSegments[urlSegments.length - 1];
        }
    },
    beforeMount() {
        this.getBook();
    }
}
</script>
