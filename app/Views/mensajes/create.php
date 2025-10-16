<?php /** @var string|null $error */ ?>
<section>
  <h2>Nuevo Mensaje</h2>

  <?php if (!empty($error)): ?>
    <div class="alert"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <?php if (isset($nextId)): ?>
    <h3>Mensaje #<?= (int)$nextId ?></h3>
  <?php endif; ?>

  <form method="post"
      action="<?= (BASE_URL ? rtrim(BASE_URL,'/') : '') ?>/mensajes/store"
      enctype="multipart/form-data"
      class="form">

    <label>Lado
      <input type="number" name="lado" required step="any" min="0" />
    </label>
    <label>Área
      <input type="number" name="area" required step="any" min="0" />
    </label>
    <label>Perímetro
      <input type="number" name="perimetro" required step="any" min="0" />
    </label>
    <label>Fecha
      <input type="date" name="fecha" required />
    </label>

    <button type="submit" class="btn">Guardar</button>
    <a class="btn secondary" href="/mensajes">Cancelar</a>
  </form>
</section>
