Buenas profesor; este AMB esta desplegado en railway, con MySql. 

El enlace al deploy es este: https://proyecto-software.up.railway.app/; se puede probar ahi.

El modelado de la BDD es el siguiente:

roles(id(PK, AUTO_INCREMENT), nombre(UNIQUE), descripcion);
usuarios(id(PK, AUTO_INCREMENT), nombre, apellido, nickname(UNIQUE), email(UNIQUIE), rol_id(FK));

modelado de las entidades es el siguiente:

```text
+-----------------------+                    +-----------------------+
|          Rol          |                    |        Usuario        |
+-----------------------+                    +-----------------------+
| - id: int             |                    | - id: int             |
| - nombre: string      | 1              *   | - nombre: string      |
| - descripcion: string |--------------------| - apellido: string    |
+-----------------------+                    | - nickname: string    |
| + getId(): int        |                    | - email: string       |
| + getNombre(): string |                    | - rol: Rol            |
| ...                   |                    +-----------------------+
+-----------------------+                    | + getId(): int        |
                                             | + getRol(): Rol       |
                                             | ...                   |
                                             +-----------------------+
```