@extends('layouts.admin')
@section('content')
<div class="list-group list-group-flush blue-grey">
      <a href="/privada" class="list-group-item list-group-item-action waves-effect blue-grey white-text">
        <i class="fas fa-chart-pie mr-3"></i>Estadisticas</a>
      <a href="/bovinos/reg" class="list-group-item active waves-effect white-text">
        <i class="fas fa-user mr-3"></i>Especies</a>
      <a href="/unidad_de_produccion" class="list-group-item list-group-item-action waves-effect blue-grey white-text">
        <i class="fas fa-map mr-3"></i>U. de Produccion</a>
      <a href="/pruebas/pruebas" class="list-group-item list-group-item-action waves-effect blue-grey white-text">
        <i class="fas fa-table mr-3"></i>Pruebas</a>
      <a href="/perfil" class="list-group-item list-group-item-action waves-effect blue-grey white-text">
        <i class="fas fa-user mr-3"></i>Perfil</a>
    </div>
  </div>
</header>
<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">
        <h2>Editar Bovino</h2>
        <form method="POST" action="{{ route('bovinos.update', $bovino->id) }}" enctype="multipart/form-data" autocomplete="off">
            @csrf
            @method('PUT')
            <input type="text" placeholder="Numero de coqueta" name="no_coqueta" value="{{ old('no_coqueta', $bovino->no_coqueta) }}" required><br>
            <input type="text" placeholder="Nombre" name="nombre" value="{{ old('nombre', $bovino->nombre) }}" required><br>
            <input type="date" placeholder="Fecha de nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', $bovino->fecha_nacimiento) }}" required>
            <select id="raza" placeholder="Raza" name="raza">
                <option disabled selected>Elige una opcion...<option>
                <option value="charolais">Charolais</option>
                <option value="hereford">Hereford</option>
                <option value="brahman">Brahman</option>
                <option value="simmental">Simmental</option>
                <option value="angus">Angus</option>
                <option value="limousin">Limousin</option>
                <option value="guzerat">Guzerat</option>
                <option value="simental">Simental</option>
                <option value="sahiwal">Sahiwal</option>
                <option value="beefmaster">Beefmaster</option>
                <option value="senepol">Senepol</option>
                <option value="buelingo">Buelingo</option>
                <option value="blanco_orejinegro">Blanco Orejinegro</option>
                <option value="canchim">Canchim</option>
                <option value="charbray">Charbray</option>
                <option value="indubrasil">Indubrasil</option>
                <option value="santa_gertrudis">Santa Gertrudis</option>
                <option value="brangus">Brangus</option>
                <option value="romagnola">Romagnola</option>
                <option value="limia">Limia</option>
                <option value="chianina">Chianina</option>
                <option value="nelore">Nelore</option>
                <option value="gyr">Gyr</option>
                <option value="pardo_suizo">Pardo Suizo</option>
                <option value="holstein">Holstein</option>
                <option value="maine_anjou">Maine-Anjou</option>
                <option value="murray_grey">Murray Grey</option>
                <option value="nelore_mocho">Nelore Mocho</option>
                <option value="normando">Normando</option>
                <option value="pinzgauer">Pinzgauer</option>
            </select>
            <select name="sexo" placeholder="Sexo" required>
                <option disabled selected>Elige una opcion...<option>
                <option value="Macho">Macho</option>
                <option value="Hembra">Hembra</option>
            </select><br>
            <select name="tipo" placeholder="Tipo" required>
                <option disabled selected>Elige una opcion...<option>
                <option value="Vientre">Vientre</option>
                <option value="Cria">Cria</option>
                <option value="Semental">Semental</option>
                <option value="Vaquilla">Vaquilla</option>
                <option value="Novillo">Novillos</option>
                <option value="Engorda">Engorda</option>
                <option value="Otra">Otra</option>
            </select>
            <input type="hidden" name="id_propietario" value="{{ auth()->user()->id }}"><br>
            <input type="file" placeholder="Foto" id="foto" name="foto" accept="image/*">
            <img id="selectedImage" src="{{ asset('storage/' . $bovino->foto) }}" alt="Vista Previa" style="max-width: 250px;">
            <button type="submit" class="btn btn-primary">Actualizar</button><br>
            <script>
              async function loadAndPredict() {
                  const model = await tf.loadLayersModel('modelos/bovinos/model.json');
                  return model;
              }
              const imageInput = document.getElementById('foto');
              const selectedImage = document.getElementById('selectedImage');
              const predictionResult = document.getElementById('predictionResult');
              imageInput.addEventListener('change', function(event) {
                  const file = event.target.files[0];
                  if (file) {
                      selectedImage.src = URL.createObjectURL(file);
                      predictionResult.textContent = "";
                  }
              });
              async function predict() {
                  const model = await loadAndPredict();
                  if (!model) {
                      predictionResult.textContent = 'El modelo no se pudo cargar.';
                      return;
                  }
                  const tensor = tf.browser.fromPixels(selectedImage);
                  const resizedTensor = tf.image.resizeBilinear(tensor, [128, 128]).toFloat().div(255.0);
                  const expandedTensor = resizedTensor.expandDims(0);
                  const predictions = model.predict(expandedTensor);
                  const predictionValue = predictions.dataSync()[0];
                  if (predictionValue < 0.5) {
                      predictionResult.textContent = 'Es un bovino.';
                  } else {
                      window.location.href = '"{{ route('bovinos.create') }}"';
                  }
              }
          </script>
        </form>
    </div>
</main>
@endsection