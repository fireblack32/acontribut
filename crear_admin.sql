-- Crear usuario administrador: Admin / qazxsw1234
-- Ejecutar en HeidiSQL conectado a la base acontrib_optimals

-- 1. Actualizar password si Admin ya existe
UPDATE usuario_web SET 
  password = '$2y$10$SIq7mpe76ItOgH3Bt2hqj.fVId/PRfoKA1fwkBAtjz2rZJCQV21LO',
  estado = 1
WHERE usuario = 'Admin';

-- 2. Insertar Admin solo si no existe
INSERT INTO usuario_web (documento, nombre, apellidos, telefono, email, usuario, password, fecha_ven, perfil_idperfil, area_usuario_idarea_usuario, estado, Comunicado)
SELECT '79941192', 'jadmin', 'Duarte', '', 'j.duarte.sanchez@gmail.com', 'Admin',
  '$2y$10$SIq7mpe76ItOgH3Bt2hqj.fVId/PRfoKA1fwkBAtjz2rZJCQV21LO',
  '2099-12-31', 1, 1, 1, 0
FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM usuario_web WHERE usuario = 'Admin');

-- 3. Asignar rol 1 al usuario Admin (si no lo tiene)
INSERT INTO usuario_rol (rol_id, usuario_id)
SELECT 1, u.id FROM usuario_web u
WHERE u.usuario = 'Admin'
  AND NOT EXISTS (SELECT 1 FROM usuario_rol ur WHERE ur.usuario_id = u.id AND ur.rol_id = 1);
