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
      <input type="number" id="lado" name="lado" required step="any" min="0" />
    </label>

    <button type="button" id="btnCalcular" class="btn" 
            style="display: inline-block; width: 90px; padding: 4px; font-size: 12px; margin-top: -10px;">
      Calcular
    </button>

    <label>Área
      <input type="number" id="area" name="area" required step="any" min="0" />
    </label>

    <label>Perímetro
      <input type="number" id="perimetro" name="perimetro" required step="any" min="0" />
    </label>

    <label>Fecha
      <input type="date" name="fecha" required />
    </label>

    <button type="submit" class="btn">Guardar</button>

    <a class="btn secondary" href="<?= (BASE_URL ? rtrim(BASE_URL,'/') : '') ?>/mensajes">Cancelar</a>
  </form>
</section>

<script>
document.getElementById('btnCalcular').addEventListener('click', function() {
  const ladoInput = document.getElementById('lado');
  const areaInput = document.getElementById('area');
  const perimetroInput = document.getElementById('perimetro');

  const lado = parseFloat(ladoInput.value);

  if (!isNaN(lado) && lado >= 0) {
    const area = lado * lado;
    const perimetro = 4 * lado;

    areaInput.value = area.toFixed(2);
    perimetroInput.value = perimetro.toFixed(2);
  } else {
    alert('Ingresa un valor válido para el lado.');
  }
});
</script>
