<template>
    <div>
        <app-navbar :yours="yours"></app-navbar>
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
    </div>
</template>

<script>
import Book from './Book'
import BookListPagination from './BookListPagination'
import RegisterInput from './RegisterInput'
import AppNavbar from './AppNavbar'
export default {
    name: 'book-list',
    components: {
        Book,
        BookListPagination,
        RegisterInput,
        AppNavbar
    },
    data() {
        return {
            books: [],
            page: 1,
            lastPage: 1,
            yours: true
        }
    },
    watch: {
        '$route' (to, from) {
            this.show()
            console.log(this.$route.query.yours)
            console.log(typeof this.$route.query.yours)
        }
    },
    methods: {
        show: function () {
            //もし指定されていて数値であればその値にする
            if(this.$route.query.page && !isNaN(this.$route.query.page)){
                this.page = parseInt(this.$route.query.page)
            }

            if (this.$route.query.yours !== undefined) {
                //指定されたyoursの型がブーリアンだったらそのまま代入する
                if (typeof this.$route.query.yours === 'boolean') {
                    this.yours = this.$route.query.yours
                } else {
                    //文字列とかだったら、その文字列に応じてブーリアンにして格納する
                    if (this.$route.query.yours === 'true') {
                        this.yours = true
                    } else if (this.$route.query.yours === 'false') {
                        this.yours = false
                    }
                } 
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