<table id="wordbook-show" class="table text-muted">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">日本語</th>
      <th scope="col">英語</th>
      <th scope="col">option</th>
    </tr>
  </thead>
  <tbody>
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
  </tbody>
</table>