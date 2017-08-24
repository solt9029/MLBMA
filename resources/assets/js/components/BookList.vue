<template>
    <div class="container">
        <register-input @showEvent="show"></register-input>
        <table class="table">
            <tr>
                <th>ISBN</th><th>書籍名</th><th>状態（中野図書館）</th><th></th>
            </tr>
            <book 
                v-for="book in books" 
                :isbn="book.isbn" 
                :name="book.name" 
                :state="book.state" 
                :id="book.id"
                :key="book.id"
                @showEvent="show">
            </book>
        </table>
        <book-list-pagination :page="page" :lastPage="lastPage"></book-list-pagination>
    </div>
</template>

<script>
import Book from './Book'
import BookListPagination from './BookListPagination'
import RegisterInput from './RegisterInput'
export default {
    name: 'book-list',
    components: {
        Book,
        BookListPagination,
        RegisterInput
    },
    data() {
        return {
            books: [],
            page: 1,
            lastPage: 1
        }
    },
    watch: {
        '$route' (to, from) {
            this.show()
        }
    },
    methods: {
        show: function () {
            //もし指定されていて数値であればその値にする
            if(this.$route.query.page && !isNaN(this.$route.query.page)){
                this.page = parseInt(this.$route.query.page)
            }

            axios.post('/books/show', {
                page: this.page
            }).then(res => {
                this.lastPage = res.data.last_page
                this.books = res.data.data

                //引数に関してはhttps://developer.mozilla.org/ja/docs/Web/JavaScript/Reference/Global_Objects/Array/reduce
                this.getCopiedBooks().reduce((previous, current, index, array) => {
                    return previous.then(() => {
                        return this.getState(current, index, array)
                    })
                }, Promise.resolve())
            })
        },
        //本の状態を取得する
        getState: function (book, index, array) {
            return new Promise ((resolve, reject) => {
                axios.post('/books/state', {
                    isbn: book.isbn
                }).then(res => {
                    //booksが状態を取得しようとした時から変更していた時にはストップしてあげる
                    if (array.toString() !== this.books.toString()) {
                        reject()
                    }
                    //オブジェクトに対してプロパティを追加するときは$setを使わないとviewに反映されない
                    this.$set(this.books[index], 'state', res.data)
                    resolve()
                })
            })
        },
        //図書館での本の状態を受け取るための配列を生成する
        getCopiedBooks: function () {
            return JSON.parse(JSON.stringify(this.books))//値渡しにするためにJSON文字列に一回変換している
        }
    },
    created: function () {
        this.show()
    }
}
</script>

<style>
</style>