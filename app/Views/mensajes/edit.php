<?php /** @var array $mensaje */ ?>
<section>
  <h2>Editar Mensaje</h2>
  
  <?php if (!empty($error)): ?>
    <div class="alert"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>
  
  <form method="post" action="<?= (BASE_URL ? rtrim(BASE_URL,'/') : '') ?>/mensajes/update" enctype="multipart/form-data" class="form">
    <input type="hidden" name="id" value="<?= (int)$mensaje['id'] ?>"/>
    
    <label>Lado
      <input type="number" id="lado" name="lado" required step="any" min="0" 
             value="<?= isset($mensaje['lado']) ? htmlspecialchars($mensaje['lado']) : '' ?>" />
    </label>

    <button type="button" id="btnCalcular" class="btn" 
            style="display: inline-block; width: 60px; padding: 4px; font-size: 12px; margin-top: -10px;">
      Calcular
    </button>

    <label>Área
      <input type="number" id="area" name="area" required step="any" min="0" 
             value="<?= isset($mensaje['area']) ? htmlspecialchars($mensaje['area']) : '' ?>" />
    </label>
    <label>Perímetro
      <input type="number" id="perimetro" name="perimetro" required step="any" min="0" 
             value="<?= isset($mensaje['perimetro']) ? htmlspecialchars($mensaje['perimetro']) : '' ?>" />
    </label>
    <label>Fecha
      <input type="date" name="fecha" required value="<?= isset($mensaje['fecha']) ? htmlspecialchars($mensaje['fecha']) : '' ?>" />
    </label>

    <button type="submit" class="btn">Actualizar</button>
    <a class="btn secondary" href="<?= (BASE_URL ? rtrim(BASE_URL,'/') : '') ?>/mensajes/show?id=<?= (int)$mensaje['id'] ?>">Cancelar</a>
  </form>
</section>


<script>
document.getElementById('btnCalcular').addEventListener('click', function() {
  const ladoInput = document.getElementById('lado');
  const areaInput = document.getElementById('area');
  const perimetroInput = document.getElementById('perimetro');

  const lado = parseFloat(ladoInput.value);

  if (!isNaN(lado) && lado >= 0) {

    areaInput.value = (lado * lado).toFixed(2);
    perimetroInput.value = (4 * lado).toFixed(2);
  } else {
    alert('Ingresa un valor válido para el lado.');
  }
});
</script>
