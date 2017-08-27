<template>
    <div>
        <app-navbar :loginUser="loginUser"></app-navbar>
        <app-user-header :paramUser="paramUser" v-if="this.$route.params.id"></app-user-header>
        <div class="container">
            <register-input @showEvent="show" v-if="!this.$route.params.id"></register-input>
            <table class="table table-striped table-responsive table-bordered">
                <tr>
                    <th class="user-handle" v-if="!this.$route.params.id">ユーザ名</th>
                    <th class="isbn">ISBN</th>
                    <th class="name">書籍名</th>
                    <th class="state">状態（中野図書館）</th>
                </tr>
                <book 
                    v-for="book in books" 
                    :book="book"
                    :key="book.id"
                    :loginUser="loginUser"
                    @showEvent="show"
                    @modalEvent="setModal">
                </book>
            </table>

            <detail-modal :modal="modal" :loginUser="loginUser" @showEvent="show">
            </detail-modal>

            <book-list-pagination  
                :lastPage="lastPage">
            </book-list-pagination>
            
        </div>
        <app-footer></app-footer>
    </div>
</template>

<script>
import Book from './Book'
import BookListPagination from './BookListPagination'
import RegisterInput from './RegisterInput'
import AppNavbar from './AppNavbar'
import AppFooter from './AppFooter'
import DetailModal from './DetailModal'
import AppUserHeader from './AppUserHeader'
export default {
    name: 'book-list',
    components: {
        Book,
        BookListPagination,
        RegisterInput,
        AppNavbar,
        AppFooter,
        DetailModal,
        AppUserHeader
    },
    data() {
        return {
            books: [],
            lastPage: 1,
            modal: {},
            loginUser: {},
            paramUser: {}
        }
    },
    watch: {
        '$route' (to, from) {
            this.show()
            this.getParamUser()
        }
    },
    methods: {
        show: function () {
            axios.post('/books/show', {
                page: this.$route.query.page,
                user_id: this.$route.params.id,
                keyword: this.$route.query.keyword
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
        },
        setModal: function (book) {
            this.modal = book
        },
        getParamUser: function () {
            if (!this.$route.params.id) {
                return
            }

            axios.post('/users/info', {
                id: this.$route.params.id
            }).then(res => {
                this.paramUser = res.data
            })
        }
    },
    created: function () {
        this.show()

        //ログインしているユーザの情報を取得する
        axios.post('/users/loginInfo').then(res => {
            this.loginUser = res.data
            //console.log(res.data.id)
        })

        this.getParamUser()
    }
}
</script>

<style scoped>
table {
    border-collapse: separate;
    border-spacing: 20px;
    border: #000;
}
table tr {
    height: 60px;
}
table tr .name {
    width:65%;
}
</style>