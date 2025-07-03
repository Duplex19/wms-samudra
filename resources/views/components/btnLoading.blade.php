@props(['id' => '', 'width' => ''])
<button id="{{ $id }}" class="btn btn-primary {{ $width }} d-none" type="button" disabled>
  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
  <span class="visually-hidden">Loading...</span>
</button>