<template>
    <div id='app'>
            <!--input-->
            <div class="bg-light contents">
                <div class="form-group">
                    <label for="ja" class="text-muted">日本語</label>
                    <input type="text" id="ja" placeholder="日本語を入力してください" class="form-control" v-model="nextWord.ja">
                </div>
                <div class="form-group">
                    <label for="en" class="text-muted">英語</label>
                    <input type="text" id="en" placeholder="英語を入力してください" class="form-control" v-model="nextWord.en">
                </div>

                <a class="btn btn-primary" @click="addWord">追加する</a>
                <p class="text-danger small">注意:単語の上限は、20単語まで<br>日本語・英語必須</p>
            </div>

            <!--list-->
            <div class="">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">id</th>
                        <th scope="col">日本語</th>
                        <th scope="col">英語</th>
                        <th scope="col">オプション</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(word, key) in wordList" :key=key>
                          <th scope="col">{{key + 1}}</th>
                          <td>
                              <input type="text" v-if="word.wordEditMode" v-model="word.ja" class="form-control">
                              <p v-else>{{word.ja}}</p>
                          </td>
                          <td>
                            <input type="text" v-if="word.wordEditMode" v-model="word.en" class="form-control">
                            <p v-else>{{word.en}}</p>
                          </td>
                          <td>
                              <a class="text-info" v-if="word.wordEditMode" @click="turnOnFalseWordEditMode(word)">完了</a>
                              <a class="text-info" v-else @click="turnOnTrueWordEditMode(word)">編集</a>
                              <a class="text-danger">削除</a>
                          </td>
                          <input type="hidden" name="wordList_ja[]" :value="word.ja">
                          <input type="hidden" name="wordList_en[]" :value="word.en">
                      </tr>
                    </tbody>
                </table>

                <button type="button" @click="checkSubmit" class="btn btn-primary">単語帳を作成</button>
            </div>
    </div>
</template>
            
    <script>
      export default{
          props: 
          {
              "initialWordList": {
                  default: ""
              }
          },
          data(){
            return{
                nextWord :{
                    "ja": "",
                    "en": ""
                },
                wordList :this.initialWordList,
            }
          },
          computeds:{
          },
          methods: {
              addWord(){
                  if(this.nextWord.ja !== "" && this.nextWord.en){
                      this.wordList.unshift({
                          "ja": this.nextWord.ja,
                          "en": this.nextWord.en,
                          "wordEditMode": false
                      })
                      this.nextWord.ja = "";
                      this.nextWord.en = "";
                  }
              },

              turnOnFalseWordEditMode(word){
                word.wordEditMode = false;
                  const targetWord = event.target.closest('tr');
                  this.$nextTick(() => {
                    targetWord.querySelector('input').focus();
                  })
              },

              turnOnTrueWordEditMode(word){
                  for (let i = 0; i < this.wordList.length; i++) {
                      this.wordList[i].wordEditMode = false;
                  }
                  word.wordEditMode = true;
                  const targetWord = event.target.closest('tr');
                  this.$nextTick(() => {
                    targetWord.querySelector('input').focus()
                  })
              },
              checkSubmit(){
                if (this.wordList.length <= 0 || this.wordList.length == null) {
                    alert('少なくとも1つは入力してください')
                    return
                }else if(this.wordList.length > 20){
                    alert('上限オーバー(20単語までにしてください)')
                    return
                }

                for (let i = 0; i < this.wordList.length; i++) {
                    if (this.wordList[i].ja === "" || this.wordList[i].en === "") {
                        alert('未入力があります')
                        return
                    }
                }
                wordbook.submit();
              }
          }
      }
    </script>

    <style>
        .contents{
            padding: 20px 20px 5px 20px;
            margin-bottom: 15px;
        }
        .word{
            padding: 20px;
            margin-bottom: 5px;
        }
    </style>