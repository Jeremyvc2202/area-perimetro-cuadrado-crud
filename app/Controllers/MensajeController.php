<?php
// app/Controllers/MensajeController.php
class MensajeController extends Controller {
    public function index() {
        $mensajes = Mensaje::all();
        $this->view('mensajes/index', compact('mensajes'));
    }
    public function create() { 
        $this->view('mensajes/create'); 
    }
    private function handleUpload(?array $file): ?string {
        if (!$file || ($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) return null;
        if (($file['error'] ?? 0) !== UPLOAD_ERR_OK) throw new RuntimeException('Error al subir la imagen.');
        if ($file['size'] > MAX_IMAGE_BYTES) throw new RuntimeException('La imagen excede 2MB.');
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        if (!in_array($ext, ALLOWED_EXT, true)) throw new RuntimeException('Extensión no permitida.');
        
        $basename = bin2hex(random_bytes(8)) . '.' . $ext;
        $dest = rtrim(UPLOAD_DIR, '/\\') . DIRECTORY_SEPARATOR . $basename;
        if (!move_uploaded_file($file['tmp_name'], $dest)) throw new RuntimeException('No se pudo guardar la imagen.');
        //eturn '/uploads/' . $name;
        return (BASE_URL ? rtrim(BASE_URL,'/') : '') . '/imagenes/' . $basename;
    }
    public function store() {
        try {
            $lado = trim($_POST['lado'] ?? '');
            $area = trim($_POST['area'] ?? '');
            $perimetro = trim($_POST['perimetro'] ?? '');
            $fecha = trim($_POST['fecha'] ?? '');
            if ($lado === '' || $area === ''|| $perimetro === '' || $fecha === '') throw new RuntimeException('Todos los campos son obligatorios.');
            $imagenPath = $this->handleUpload($_FILES['imagen'] ?? null);
            $id = Mensaje::create(['lado'=>$lado,'area'=>$area,'perimetro'=>$perimetro,'fecha'=>$fecha]);
            $this->redirect('/mensajes/show?id=' . $id);
        } catch (Throwable $e) {
            $error = $e->getMessage();
            $this->view('mensajes/create', compact('error'));
        }
    }
    public function show() {
        $id = (int)($_GET['id'] ?? 0);
        $mensaje = $id ? Mensaje::find($id) : null;
        if (!$mensaje) { http_response_code(404); echo 'Mensaje no encontrado'; return; }
        $this->view('mensajes/show', compact('mensaje'));
    }
    public function edit() {
        $id = (int)($_GET['id'] ?? 0);
        $mensaje = $id ? Mensaje::find($id) : null;
        if (!$mensaje) { http_response_code(404); echo 'Mensaje no encontrado'; return; }
        $this->view('mensajes/edit', compact('mensaje'));
    }
    public function update() {
        try {
            $id = (int)($_POST['id'] ?? 0);
            $orig = Mensaje::find($id);
            if (!$orig) throw new RuntimeException('Mensaje no existe.');
            $lado = trim($_POST['lado'] ?? '');
            $area = trim($_POST['area'] ?? '');
            $perimetro = trim($_POST['perimetro'] ?? '');
            $fecha = trim($_POST['fecha'] ?? '');
            if ($lado === '' || $area === ''|| $perimetro === '' || $fecha === '') throw new RuntimeException('Todos los campos son obligatorios.');
            $new = $this->handleUpload($_FILES['imagen'] ?? null);
            $imagenPath = ($new !== null) ? $new : ($orig['imagen'] ?? null);
            Mensaje::updateById($id, ['lado'=>$lado,'area'=>$area,'perimetro'=>$perimetro,'fecha'=>$fecha]);
            $this->redirect('/mensajes/show?id=' . $id);
        } catch (Throwable $e) {
            $error = $e->getMessage();
            $mensaje = ['id'=>$_POST['id'] ?? 0, 'lado'=>$_POST['lado'] ?? '', 'area'=>$_POST['area'] ?? '','perimetro'=>$_POST['perimetro'] ?? '','fecha'=>$_POST['fecha'] ?? ''];
            $this->view('mensajes/edit', compact('mensaje','error'));
        }
    }
    public function destroy() {
        $id = (int)($_POST['id'] ?? 0);
        if ($id) Mensaje::deleteById($id);
        $this->redirect('/mensajes');
    }
}
