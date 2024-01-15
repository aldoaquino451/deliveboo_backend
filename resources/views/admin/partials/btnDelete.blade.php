<form
  class="d-inline-block"
  action="{{ $route }}"
  method="POST"
  onsubmit="return confirm('{{ $message }}')">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">
        <i class="fa-solid fa-trash"></i>
    </button>
</form>
