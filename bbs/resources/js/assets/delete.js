var deleteBtn = document.getElementById('deleteBtn');

deleteBtn.addEventListener('click', function() {
  var result = window.confirm('この記事を削除しますか?');

if( result ) {
    deleteForm.submit();
}
})