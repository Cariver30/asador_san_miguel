<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Pop-up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>Crear Pop-up</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.popups.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
            <div class="form-text">Recomendado: formato horizontal. Se mostrará centrada en pantalla.</div>
            <div class="mt-2">
                <img id="imagePreview" src="" alt="Vista previa" class="img-thumbnail d-none" style="max-width: 220px; max-height: 140px;">
            </div>
        </div>
        <div class="mb-3">
            <label for="view" class="form-label">Vista</label>
            <select class="form-control" id="view" name="view" required>
                <option value="" selected disabled>Selecciona una vista</option>
                <option value="cover">Portada</option>
                <option value="menu">Menú</option>
                <option value="cocktails">Cócteles</option>
                <option value="wines">Vinos</option>
            </select>
            <div class="form-text">Define en qué página aparecerá el pop-up.</div>
        </div>
        <div class="row">
            <div class="mb-3 col-md-6">
                <label for="start_date" class="form-label">Fecha de inicio</label>
                <input type="date" class="form-control" id="start_date" name="start_date" required>
            </div>
            <div class="mb-3 col-md-6">
                <label for="end_date" class="form-label">Fecha de fin</label>
                <input type="date" class="form-control" id="end_date" name="end_date" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label d-block">Días de la semana</label>
            <div class="d-flex flex-wrap gap-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="repeat_days[]" id="day0" value="0">
                    <label class="form-check-label" for="day0">Domingo</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="repeat_days[]" id="day1" value="1">
                    <label class="form-check-label" for="day1">Lunes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="repeat_days[]" id="day2" value="2">
                    <label class="form-check-label" for="day2">Martes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="repeat_days[]" id="day3" value="3">
                    <label class="form-check-label" for="day3">Miércoles</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="repeat_days[]" id="day4" value="4">
                    <label class="form-check-label" for="day4">Jueves</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="repeat_days[]" id="day5" value="5">
                    <label class="form-check-label" for="day5">Viernes</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="repeat_days[]" id="day6" value="6">
                    <label class="form-check-label" for="day6">Sábado</label>
                </div>
            </div>
            <div class="form-text">Si no seleccionas días, se mostrará todos los días dentro del rango de fechas.</div>
        </div>

        <div class="mb-3">
            <label for="active" class="form-label">Activo</label>
            <select class="form-control" id="active" name="active" required>
                <option value="1" selected>Sí</option>
                <option value="0">No</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');
    const startDate = document.getElementById('start_date');
    const endDate = document.getElementById('end_date');

    imageInput?.addEventListener('change', (e) => {
        const file = e.target.files?.[0];
        if (!file) {
            imagePreview.classList.add('d-none');
            imagePreview.src = '';
            return;
        }
        imagePreview.src = URL.createObjectURL(file);
        imagePreview.classList.remove('d-none');
    });

    startDate?.addEventListener('change', () => {
        if (startDate.value) {
            endDate.min = startDate.value;
            if (endDate.value && endDate.value < startDate.value) {
                endDate.value = startDate.value;
            }
        }
    });
</script>
</body>
</html>
