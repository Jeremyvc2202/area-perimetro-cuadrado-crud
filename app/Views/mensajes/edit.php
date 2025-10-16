<?php /** @var array $mensaje */ ?>
<section>
  <h2>Editar Mensaje</h2>
  <?php if (!empty($error)): ?>
    <div class="alert"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>
  <form method="post" action="<?= (BASE_URL ? rtrim(BASE_URL,'/') : '') ?>/mensajes/update" enctype="multipart/form-data" class="form">
    <input type="hidden" name="id" value="<?= (int)$mensaje['id'] ?>"/>
    
    <label>Lado
      <input type="number" name="lado" required step="any" min="0" value="<?= htmlspecialchars($mensaje['lado'] ?? '') ?>" />
    </label>
    <label>Área
      <input type="number" name="area" required step="any" min="0" value="<?= htmlspecialchars($mensaje['area'] ?? '') ?>" />
    </label>
    <label>Perímetro
      <input type="number" name="perimetro" required step="any" min="0" value="<?= htmlspecialchars($mensaje['perimetro'] ?? '') ?>" />
    </label>
    <label>Fecha
      <input type="date" name="fecha" required value="<?= htmlspecialchars($mensaje['fecha'] ?? '') ?>" />
    </label>

    <button type="submit" class="btn">Actualizar</button>
    <a class="btn secondary" href="<?= (BASE_URL ? rtrim(BASE_URL,'/') : '') ?>/mensajes/show?id=<?= (int)$mensaje['id'] ?>">Cancelar</a>
  </form>
</section>
