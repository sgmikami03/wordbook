import './bootstrap'
import Vue from 'vue'
import CreateWordbook from './components/CreateWordbook'
import Question from './components/Question.vue'

const app = new Vue({
  el: '#app',
  components: {
    CreateWordbook,
    Question
  }
})