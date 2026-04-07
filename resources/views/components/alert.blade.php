@if(session('success'))
    <div class="alert alert-success shadow-sm mb-4">
        <strong>Thành công!</strong> {{ session('success') }}
    </div>
@endif