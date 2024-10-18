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
        <div class="flex flex-col justify-center items-center">
            <div class="pt-3 pb-3">
                <input class="border-solid border-2 border-zinc-400 rounded w-70 pl-3" type="text"
                    placeholder="Search by book title..." v-model="searchInput">
            </div>
            <div>
                <table class="border-solid border-2">
                    <tr class="border-solid border-2 bg-sky-950 text-white text-left">
                        <th class="border-solid border-2 pl-3">Title</th>
                        <th class="border-solid border-2 pl-3">Author</th>
                        <th class="border-solid border-2 px-3">Rating</th>
                        <th class="border-solid border-2 pl-3"></th>
                    </tr>
                    <tr v-for="(result, index) in filteredResults" :key="index"
                        class="border-solid border-2 items-start bg-gray-300">
                        <td class="border-solid border-2 px-3">{{ result.title }}</td>
                        <td class="border-solid border-2 px-3">{{ result.author }}</td>
                        <td class="border-solid border-2 px-3">{{ result.rating }}</td>
                        <td class="pr-3 border-solid border-2 px-3">
                            <p><a class="underline underline-offset-1 font-semibold"
                                    :href="`/edit/${result.id}`">EDIT</a>
                            </p>
                            <p><a class="underline underline-offset-1 font-semibold"
                                    @click="deleteBook(result.id)">DELETE</a></p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
</template>

<script>
import axios from "axios";

export default {
    name: 'BookListing',
    data() {
        return {
            results: [],
            searchInput: ''
        }
    },
    computed: {
        filteredResults() {
            return this.results.filter(book =>
                book.title.toLowerCase().includes(this.searchInput.toLowerCase())
            );
        }
    },
    methods: {
        async getBooks() {
            try {
                const { data } = await axios.get("/api/books");
                this.results = data.data
            } catch (error) {
                console.error("Error fetching books:", error);
                alert('Error fetching books');
            }
        },
        async deleteBook(id) {
            if (confirm('Are you sure?')) {
                try {
                    const { data } = await axios.delete(`/api/books/${id}`)
                    this.getBooks();
                    alert(data.message)
                } catch (error) {
                    console.error("Error deleting book:", error);
                    alert('Error deleting book');
                }
            }

        }
    },
    beforeMount() {
        this.getBooks();
    }
}
</script>

<style></style>
