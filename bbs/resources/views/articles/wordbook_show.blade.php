<table id="wordbook-show" class="table text-muted">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">日本語</th>
      <th scope="col">英語</th>
      <th scope="col">{{ isset($correct_answer_rate) ? '正解率' : ''}}</th>
    </tr>
  </thead>
  <tbody>
    @if(isset($article->words))
     @foreach($article->words as $key => $word)
      <tr 
        @if($result)
          class="{{ $corrects[$key] ? 'correct' : 'incorrect' }}"
        @endif>
        <th scope="row">{{ $key + 1 }}</th>
        <td>{{ $word->ja }}</td>
        <td>{{ $word->en }}</td>
        @if($result)
        <td>{{ $corrects[$key] ? '正解!' : '不正解!' }}</td>
        @endif
      </tr>
     @endforeach
    @endif

    @if(isset($reviewWords))
     @foreach($reviewWords as $key => $word)
     <tr 
        @if($result)
          class="{{ $corrects[$key] ? 'correct' : 'incorrect' }}"
        @endif>
        <th scope="row">{{ $key + 1 }}</th>
        <td>{{ $word->ja }}</td>
        <td>{{ $word->en }}</td>
        @if(isset($correct_answer_rate[$key]["rate"]))
        <td>{{ $correct_answer_rate[$key]["rate"] }}</td>
        @endif
      </tr>
     @endforeach
    @endif
  </tbody>
</table>