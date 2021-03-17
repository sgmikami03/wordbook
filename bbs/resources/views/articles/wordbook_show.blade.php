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
      <tr>
        <th scope="row">{{ $key + 1 }}</th>
        <td>{{ $word->ja }}</td>
        <td>{{ $word->en }}</td>
        <td>option</td>
      </tr>
    @endforeach
  </tbody>
</table>