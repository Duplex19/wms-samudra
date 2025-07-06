@props(['id' => '', 'text' => 'Kirim', 'width' => '', 'onclick' => ''])
<button id="{{ $id }}" onclick="{{ $onclick }}" class="btn btn-primary {{ $width }}" type="submit">{{ $text }}</button>