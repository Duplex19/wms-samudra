<style>
    .section-header {
            background: linear-gradient(135deg, #2563eb 0%, #0891b2 100%);
            color: white;
            padding: 8px 20px;
            margin: 0;
            font-weight: 600;
            font-size: 1.1rem;
            /* border-radius: 8px 8px 0 0; */
            display: flex;
            align-items: center;
            gap: 10px;
        }
</style>
@forelse ($users as $item)
    <div class="col-md-6 col-lg-4">
      <div class="card mb-3">
        <div style="max-height: 250px; overflow: hidden;">
            <img class="card-img-top" src="{{ $item['foto'] }}" alt="Card image cap" style="width: 100%; object-fit: cover;">
        </div>
        <ul class="list-group list-group-flush">
            <div class="section-header">
                <i class="fas fa-user field-icon"></i>
                Biodata
            </div>
           <li class="list-group-item d-flex justify-content-between align-items-center">
                Nama
                <span>{{ $item["name"] }}</span>
            </li>
           <li class="list-group-item d-flex justify-content-between align-items-center">
                Email
                <span>{{ $item["email"] }}</span>
            </li>
           <li class="list-group-item d-flex justify-content-between align-items-center">
                Role
                <span>{{ $item["role"] }}</span>
            </li>
           <li class="list-group-item d-flex justify-content-between align-items-center">
                WhatsApp
                <a href="https://wa.me/{{ $item["whatsapp"] }}" class="badge bg-success" target="_blank">{{ $item["whatsapp"] }}</a>
            </li>
           <li class="list-group-item d-flex justify-content-between align-items-center">
                Jabatan
                <span>{{ $item["jabatan"] }}</span>
            </li>
           <li class="list-group-item d-flex justify-content-between align-items-center">
                Tim
                <span>{{ $item["team"] }}</span>
            </li>
            <div class="section-header">
                Akun bank   
            </div>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Nama pemilik
                <span>{{ $item["bank"]["name"] }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Nomor rekening
                <span>{{ $item["bank"]["norek"] }}</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                Nama bank
                <span>{{ $item["bank"]["bank_code"] }}</span>
            </li>
        </ul>
        <div class="card-body">
          <button class="btn btn-warning btn-sm">Edit</button>
          <button class="btn btn-danger btn-sm">Hapus</button>
        </div>
      </div>
    </div>
@empty
    
@endforelse