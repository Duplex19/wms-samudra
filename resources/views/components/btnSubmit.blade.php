@props(['id' => '', 'text' => 'Submit', 'width' => '', 'onclick' => ''])
<button id="{{ $id }}" onclick="{{ $onclick }}" class="btn btn-primary {{ $width }}" type="submit">{{ $text }}</button>