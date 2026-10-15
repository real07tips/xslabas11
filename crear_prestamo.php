<?php
require 'conexion.php';

class Prestamo {
    private $id;
    private $libroId;
    private $socioId;
    private $fechaSolicitud;
    private $fechaDevolucion;

    public function __construct($libroId, $socioId, $fechaSolicitud, $fechaDevolucion, $id = null) {
        $this->libroId = $libroId;
        $this->socioId = $socioId;
        $this->fechaSolicitud = $fechaSolicitud;
        $this->fechaDevolucion = $fechaDevolucion;
        $this->id = $id;
    }

    public function getId() { return $this->id; }
    public function getLibroId() { return $this->libroId; }
    public function getSocioId() { return $this->socioId; }
    public function getFechaSolicitud() { return $this->fechaSolicitud; }
    public function getFechaDevolucion() { return $this->fechaDevolucion; }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $libroId = $_POST['libro_id'] ?? '';
    $socioId = $_POST['socio_id'] ?? '';
    $fechaSolicitud = $_POST['fecha_solicitud'] ?? '';
    $fechaDevolucion = $_POST['fecha_devolucion'] ?? '';

    if ($libroId !== '' && $socioId !== '' && $fechaSolicitud !== '' && $fechaDevolucion !== '') {
        $prestamo = new Prestamo((int)$libroId, (int)$socioId, $fechaSolicitud, $fechaDevolucion);
        $stmt = $pdo->prepare(
            "INSERT INTO prestamos (libro_id, socio_id, fecha_solicitud, fecha_devolucion)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([
            $prestamo->getLibroId(),
            $prestamo->getSocioId(),
            $prestamo->getFechaSolicitud(),
            $prestamo->getFechaDevolucion()
        ]);
        header('Location: prestamos.php');
        exit;
    }
    $error = 'Todos los campos son obligatorios.';
}

$libros = $pdo->query('SELECT * FROM libros ORDER BY titulo')->fetchAll(PDO::FETCH_ASSOC);
$socios = $pdo->query('SELECT * FROM socios ORDER BY nombre')->fetchAll(PDO::FETCH_ASSOC);

require 'views/header.php';
?>
<div class="mx-auto" style="max-width: 600px;">
    <h1 class="h3 mb-4">Nuevo préstamo</h1>
    <?php if (isset($error)): ?><div class="alert alert-danger"><?= $error ?></div><?php endif; ?>
    <form action="crear_prestamo.php" method="POST" class="card shadow-sm p-4 bg-white">
        <div class="mb-3">
            <label class="form-label">Libro *</label>
            <select name="libro_id" class="form-select" required>
                <option value="">Seleccionar libro</option>
                <?php foreach ($libros as $libro): ?>
                    <option value="<?= $libro['id'] ?>"><?= htmlspecialchars($libro['titulo']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Socio *</label>
            <select name="socio_id" class="form-select" required>
                <option value="">Seleccionar socio</option>
                <?php foreach ($socios as $socio): ?>
                    <option value="<?= $socio['id'] ?>"><?= htmlspecialchars($socio['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha de solicitud *</label>
            <input type="date" name="fecha_solicitud" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha de devolución *</label>
            <input type="date" name="fecha_devolucion" class="form-control" required>
        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Crear préstamo</button>
            <a href="prestamos.php" class="btn btn-outline-secondary">Cancelar</a>
        </div>
    </form>
</div>
<?php require 'views/footer.php'; ?>
