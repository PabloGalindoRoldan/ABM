<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Listado de Usuarios</h2>
    <a href="index.php?action=crear" class="btn btn-primary">+ Nuevo Usuario</a>
</div>

<div class="table-responsive bg-white shadow-sm rounded">
    <table class="table table-hover align-middle mb-0">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre y Apellido</th>
                <th>Nickname</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($usuarios)): ?>
                <?php foreach ($usuarios as $u): ?>
                    <tr>
                        <td><?= htmlspecialchars($u['id']) ?></td>
                        <td><?= htmlspecialchars($u['nombre'] . ' ' . $u['apellido']) ?></td>
                        <td><code>@<?= htmlspecialchars($u['nickname']) ?></code></td>
                        <td><?= htmlspecialchars($u['email']) ?></td>
                        <td><span class="badge bg-info text-dark"><?= htmlspecialchars($u['rol_nombre']) ?></span></td>
                        <td>
                            <a href="index.php?action=editar&id=<?= $u['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="index.php?action=eliminar&id=<?= $u['id'] ?>" 
                               class="btn btn-sm btn-danger" 
                               onclick="return confirm('¿Confirma que desea eliminar a este usuario?');">
                               Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">No hay usuarios registrados.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>