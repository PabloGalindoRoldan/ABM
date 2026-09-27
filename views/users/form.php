<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="card-title mb-0"><?= isset($usuario) ? 'Editar Usuario' : 'Nuevo Usuario' ?></h4>
            </div>
            <div class="card-body">
                <form action="index.php?action=guardar" method="POST">
                    <?php if (isset($usuario)): ?>
                        <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">
                    <?php endif; ?>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" class="form-control" required value="<?= htmlspecialchars($usuario['nombre'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Apellido</label>
                            <input type="text" name="apellido" class="form-control" required value="<?= htmlspecialchars($usuario['apellido'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nickname (Nombre de Usuario)</label>
                            <input type="text" name="nickname" class="form-control" required value="<?= htmlspecialchars($usuario['nickname'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required value="<?= htmlspecialchars($usuario['email'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Rol de Usuario</label>
                        <select name="rol_id" class="form-select" required>
                            <option value="">-- Seleccionar Rol --</option>
                            <?php foreach ($roles as $rol): ?>
                                <option value="<?= $rol['id'] ?>" <?= (isset($usuario) && $usuario['rol_id'] == $rol['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($rol['nombre']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="index.php" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-success">Guardar Registros</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>