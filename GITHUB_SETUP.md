# Configuración del repositorio en GitHub

El commit inicial ya está creado. Sigue estos pasos para crear el repositorio en GitHub y subir el código.

---

## Paso 1: Crear el repositorio en GitHub

1. Abre **https://github.com/new**
2. **Repository name:** `acontribut` (o el nombre que prefieras)
3. **Description:** (opcional) Sistema de gestión de obligaciones - Laravel con AdminLTE
4. **Visibility:** Elige *Public* o *Private*
5. **IMPORTANTE:** No marques "Add a README file" ni "Add .gitignore" (ya existen en el proyecto)
6. Haz clic en **Create repository**

---

## Paso 2: Conectar el proyecto local con GitHub

Cuando GitHub te muestre la URL del repositorio (algo como `https://github.com/TU_USUARIO/acontribut.git`), ejecuta estos comandos en la terminal, **reemplazando** `TU_USUARIO` y `acontribut` por los valores correctos:

```powershell
cd "d:\my\TRABAJO\Desarrollo 2026\DTRUESTAR\Acontribut\acontribut"

# Agregar el remoto (usa la URL que GitHub te mostró)
git remote add origin https://github.com/TU_USUARIO/acontribut.git

# Opcional: renombrar rama de master a main (GitHub usa main por defecto)
git branch -M main

# Subir el código
git push -u origin main
```

**Si mantienes la rama `master`** en lugar de `main`:

```powershell
git push -u origin master
```

---

## Paso 3: Verificación

Tras el push, verifica en https://github.com/TU_USUARIO/acontribut que el código se subió correctamente.

---

## Notas

- El archivo `.env` está en `.gitignore` y **no** se subirá (correcto por seguridad).
- Asegúrate de tener `.env.example` configurado para que otros desarrolladores puedan crear su `.env` local.
- Si usas HTTPS y te pide credenciales, GitHub recomienda usar un **Personal Access Token** en lugar de la contraseña.
