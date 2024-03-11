
@if (session('success'))
<div class="alert alert-success" role="alert">
{{ session('success') }}
</div>
<script>
setTimeout(function() {
// Selecionar o elemento e ocultar
document.querySelector('.alert-success').style.display = 'none';
}, 3000); // 5000 milissegundos = 5 segundos
</script>
@endif

@if (session('error'))
<div class="alert alert-danger" role="alert">
{{ session('error') }}
</div>
<script>
setTimeout(function() {
// Selecionar o elemento e ocultar
document.querySelector('.alert-danger').style.display = 'none';
}, 3000); // 5000 milissegundos = 5 segundos
</script>
@endif

@if ($errors->any())
<div class="alert alert-danger" role="alert">
@foreach ($errors->all() as $error)
{{ $error }}<br>
@endforeach
</div>
<script>
setTimeout(function() {
// Selecionar o elemento e ocultar
document.querySelector('.alert-danger').style.display = 'none';
}, 4000); // 5000 milissegundos = 5 segundos
</script>
@endif