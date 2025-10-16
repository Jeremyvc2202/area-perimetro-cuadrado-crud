<?php /** @var array $mensajes */ ?>
<section>
  <h2>Cuadrados</h2>
  <?php if (empty($mensajes)): ?>
    <div class="empty">No hay mensajes aún. Crea el primero.</div>
  <?php else: ?>
    <div class="grid">
      <?php $contador = 1; ?>
      <?php foreach ($mensajes as $m): ?>
        <article class="card">
          <h3>#<?= $contador ?></h3>
          <p>Lado: <?= htmlspecialchars($m['lado']) ?></p>
          <p>Área: <?= htmlspecialchars($m['area']) ?></p>
          <p>Perímetro: <?= htmlspecialchars($m['perimetro']) ?></p>
          <p class="muted">Fecha: <?= htmlspecialchars($m['fecha']) ?></p>
          <div class="row">
            <a class="btn" href="<?= (BASE_URL ? rtrim(BASE_URL,'/') : '') ?>/mensajes/show?id=<?= (int)$m['id'] ?>">Ver</a>
            <a class="btn secondary" href="<?= (BASE_URL ? rtrim(BASE_URL,'/') : '') ?>/mensajes/edit?id=<?= (int)$m['id'] ?>">Editar</a>
            <a class="btn danger" href="<?= (BASE_URL ? rtrim(BASE_URL,'/') : '') ?>/mensajes/delete?id=<?= (int)$m['id'] ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este cuadrado?');">Eliminar</a>
          </div>
        </article>
        <?php $contador++; ?>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</section>

