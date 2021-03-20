<template>
            <div class="card">
                <div class="card-body">
                    <h3 class="text-muted">第{{ number + 1 }}問<small>/{{ numberOfQuestions }}問中</small></h3>
                    <p class="text-muted">{{ isEnglishToJapanese ? '英和' : '和英'}}</p>
                    <br>
                    <h3>{{ isEnglishToJapanese ? wordList[number].en : wordList[number].ja }}</h3>
                    <hr>

                    <div v-for="n in 4" :key="n">
                        <a 
                        @click="check(number, n-1)" type="button" 
                        v-bind:class="{'btn-danger': !correct_choise[n-1], 'btn-primary': correct_choise[n-1], 'btn-light': !isResults}" 
                        class="btn btn-lg btn-block text-left">
                            {{ isEnglishToJapanese ? wordList[questions[number][n-1]].ja : wordList[questions[number][n-1]].en }}
                        </a>
                    </div>
                </div>

                <form v-bind:action="url" method="post" name="result">
                    <input type="hidden" name="_token" v-bind:value="csrf">
                    <div v-for="n in numberOfQuestions" :key="n">
                        <input type="hidden" name="word_id[]" :value="wordList[n-1].id">
                        <input type="hidden" name="ja[]" :value="wordList[n-1].ja">
                        <input type="hidden" name="en[]" :value="wordList[n-1].en">
                        <input type="hidden" name="corrects[]" :value="corrects[n-1]">
                    </div>
                </form>
            </div>
</template>

<script>
export default {
        props: {
            "initialWordList": {
                require: true,
            },
            "initialIsEnglishToJapanese": {
                default: 1,
            },
            csrf: {
                type: String,
                required: true,
            }
        },
        data(){
        return{
            wordList : this.initialWordList,
            /*[
                {ja: 'いちご', en: 'strawberry'},
                {ja: '赤', en: 'red'},
                {ja: '青', en: 'blue'},
                {ja: 'ペン', en: 'pen'},
                {ja: 'りんご', en: 'apple'},
                {ja: '男', en: 'men'},
                {ja: '女', en: 'women'},
                {ja: '単語', en: 'word'},
                {ja: '単語帳', en: 'wordbook'},
                {ja: 'ノート', en: 'notebook'},
            ],*/
            dummyWordList: [
                {ja: 'ダミー1', en: 'dummy1'},
                {ja: 'ダミー2', en: 'dummy2'},
                {ja: 'ダミー3', en: 'dummy3'},
                {ja: 'ダミー4', en: 'dummy4'},
                {ja: 'ダミー5', en: 'dummy5'},
                {ja: 'ダミー6', en: 'dummy6'},
                {ja: 'ダミー7', en: 'dummy7'},
                {ja: 'ダミー8', en: 'dummy8'},
                {ja: 'ダミー9', en: 'dummy9'},
                {ja: 'ダミー10', en: 'dummy10'},
            ],
            questions: [],
            answers: [],
            corrects: [],
            correct_choise: [],
            id: 2,
            number: 0,
            numberOfQuestions: 0,//すぐ変更
            isResults: false,
            isEnglishToJapanese: this.initialIsEnglishToJapanese,
            url: '/articles/result/' + this.id + '/' + this.isEnglishToJapanese,
          }},
          created: function(){
              this.numberOfQuestions = this.wordList.length;

              if (this.numberOfQuestions < 10) {
                  var arrayDummy = [];
                  for (let i = 0; i < 10 - this.numberOfQuestions; i++) {
                    while(true){
                        var num = intRandom(0, 10-1);
                        if(!arrayDummy.includes(num)){
                            arrayDummy.push(num);
                            break;
                        }
                    }
                    this.wordList.push(this.dummyWordList[num]);
                  }
              }

              for (let i = 0; i < this.wordList.length; i++) {
                this.questions[i] = [];
                for(let k = 0; k < 3; k++){
                  while(true){
                    var num = intRandom(0, this.wordList.length - 1);
                    if(!this.questions[i].includes(num) && num != i){
                      this.questions[i].push(num);
                      break;
                    }
                  }
                }
                var num_answaer = intRandom(0, 3);
                this.questions[i].splice(num_answaer, 0, i);
                this.answers.push(num_answaer);
              }

              function intRandom(min, max){
                return Math.floor( Math.random() * (max - min + 1)) + min;
              }
          },
          computeds:{
              
          },
          methods: {
                check: function(number, choice){
                    if (this.isResults) {
                        return;
                    }
                    
                    if (this.answers[number] == choice) {
                        this.corrects[number] = true;
                    }else{
                        this.corrects[number] = false;
                    }

                    this.showResult(number);
                    setTimeout(this.showNextWord,500);
                },
                showResult: function(number){
                    this.correct_choise = [];
                    this.isResults = true;
                    for (let i = 0; i < 4; i++) {
                        this.correct_choise.push((this.answers[number] == i)? true: false);
                    }
                },
                showNextWord: function() {
                    this.number++;
                    this.isResults = false;
                    if (this.number >= this.numberOfQuestions) {
                        result.submit();

                        /*$.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'POST',
                            url: '/articles/result/' + this.id + '/' + this.isEnglishToJapanese,
                            addType: 'json',
                            data: { 
                                id: this.id,
                                numberOfQuestions: this.numberOfQuestions,
                                wordList: JSON.stringify(this.wordList),
                                corrects: JSON.stringify(this.corrects),
                            },
                            async: false,
                            cache: false,
                            success: function(result){
                              console.debug("result" + result);
                            },
                            error: function(jqxhr, status, exception) {
                              console.debug('jqxhr', jqxhr);
                              console.debug('status', status);
                              console.debug('exception', exception);
                            }
                        }).done(function (results) {
                            location.href = '/articles/result/' + this.id + '/' + this.isEnglishToJapanese;
                        }).fail(function (jqXHR, textStatus, errorThrown) {
                            alert('eroor!');
                            console.log(jqXHR);
                            console.log(textStatus);
                            console.log(errorThrown);
                        });*/
                    }
                }
          }
      }

</script>

<style>
  .card{
      max-width: 80%;
      width: 800px;
      margin: 30px;
  }
</style>