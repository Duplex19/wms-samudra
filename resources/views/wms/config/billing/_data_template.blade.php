@forelse ($data as $key => $dt)
<div class="col-md-4 g-3">
    <div class="card" style="border-top: 2px solid #2563eb">
        <div class="card-body">
            <h5 class="card-title">{{ $dt['name'] }}</h5>
            <p class="card-text">{!! $dt['content'] !!}</p>
            <a href="#" class="btn btn-primary">Gunakan</a>
            <a href="#" class="btn btn-primary">Salin</a>
        </div>
    </div>
</div>
@empty
    <x-dataNotFound colspan="9" />
@endforelse