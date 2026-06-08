<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Laboratorios AgroLab — Boleta de Solicitud</title>
<link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="styles/solicitud_formulario.css"/>
</head>
<body>

<!-- NAV -->
<nav>
  <div class="nav-brand">Laboratorios AgroLab</div>
  <div class="nav-links">
    <a class="nav-link back" href="index.html" title="Volver al inicio">Inicio</a>
    <a class="nav-link back" href="menu_formulario.php" title="Elegir otro formulario">Cambiar de Formulario</a>
    <a class="nav-link" href="#">Dashboard</a>
    <a class="nav-link active" href="#">Análisis Nuevos</a>
    <a class="nav-link" href="#">Historial</a>
  </div>
  <div class="nav-icons">
    <span class="material-symbols-outlined" title="Notificaciones">notifications</span>
    <span class="material-symbols-outlined" title="Configuración">settings</span>
    <span class="material-symbols-outlined" title="Cuenta">account_circle</span>
  </div>
</nav>

<!-- MAIN -->
<main>

  <?php if (!empty($message)): ?>
    <div style="padding:12px;margin-bottom:14px;border-radius:8px;background:#e9f7e7;border:1px solid #c7e5c8;color:#184d12">
      <?php echo htmlspecialchars($message); ?>
    </div>
  <?php endif; ?>

  <form id="solicitud-form" method="post">
  <?php
    $getTypes = $_GET['tipo'] ?? [];
    if (!is_array($getTypes) && !empty($getTypes)) {
        $getTypes = [$getTypes];
    }
    if (is_array($getTypes)) {
        foreach ($getTypes as $t) {
            echo '<input type="hidden" name="tipo[]" value="' . htmlspecialchars($t) . '"/>';
        }
    }
  ?>

  <!-- ENCABEZADO -->
  <header class="doc-header">
    <div class="doc-header-left">
      <div class="logo-circle">
        <span class="material-symbols-outlined">eco</span>
      </div>
      <div>
        <div class="doc-title">Laboratorio Agroindustrial</div>
        <div class="doc-subtitle">
          Boleta de solicitud de análisis de <strong id="tipo-label-header">Suelos Físico</strong>
        </div>
      </div>
    </div>
    <div class="doc-header-right">
      <div class="meta-badge"><span>VF</span> 005</div>
      <div class="meta-badge">
        <span>Lote</span>
        <input class="lote-input" type="text" placeholder="Ej. 185" aria-label="Número de lote"/>
      </div>
    </div>
  </header>

  <!-- TIPO DE ANÁLISIS --->
  <div class="tipo-btns" id="tipo-btns">
    <button type="button" class="tipo-btn active" data-tipo="suelo-fisico">Suelos Físico</button>
    <button type="button" class="tipo-btn" data-tipo="suelo-quimico">Suelo Químico</button>
    <button type="button" class="tipo-btn" data-tipo="foliares">Foliares</button>
    <button type="button" class="tipo-btn" data-tipo="cana">Caña</button>
    <button type="button" class="tipo-btn" data-tipo="miel">Miel</button>
    <button type="button" class="tipo-btn" data-tipo="agua">Agua</button>
  </div>

  <!-- DATOS DEL MUESTREO -->
  <div class="section-title">Datos del muestreo</div>
  <div class="field-grid">
    <div class="field">
      <label for="codigo-muestreo">Código del muestreo</label>
      <input id="codigo-muestreo" name="codigo" type="text" placeholder="MUE-00000"/>
    </div>
    <div class="field">
      <label for="fecha-muestreo">Fecha de muestreo</label>
      <input id="fecha-muestreo" name="fecha_muestreo" type="date"/>
    </div>
    <div class="field">
      <label for="num-muestras">Número de muestras</label>
      <input id="num-muestras" name="num_muestras" type="number" placeholder="0" min="0"/>
    </div>
    <div class="field">
      <label for="num-lab">Número de laboratorio</label>
      <input id="num-lab" name="num_lab" type="text" placeholder="LAB-0000"/>
    </div>
    <div class="field">
      <label for="fecha-entrega">Fecha estimada de entrega</label>
      <input id="fecha-entrega" name="fecha_entrega" type="date"/>
    </div>
    <div class="field">
      <label for="institucion">Institución</label>
      <input id="institucion" name="institucion" type="text" placeholder="Nombre de la institución"/>
    </div>
    <div class="field full">
      <label for="responsable">Responsable del envío</label>
      <input id="responsable" name="responsable" type="text" placeholder="Nombre completo del responsable"/>
    </div>
  </div>

  <!-- ANÁLISIS SOLICITADOS -->
  <div class="section-title">Análisis solicitados</div>
  <div class="analisis-wrap">
    <table class="analisis-table">
      <thead>
        <tr>
          <th>Análisis</th>
          <th class="center" style="width:80px">Solicitar</th>
        </tr>
      </thead>
      <tbody id="analisis-body"></tbody>
    </table>
  </div>

  <!-- MÉTODO DE ANÁLISIS -->
  <div class="section-title" style="margin-top:24px">Método de análisis</div>
  <div class="metodo-box" id="metodo-box"></div>

  <!-- OBSERVACIONES -->
  <div class="section-title">Observaciones</div>
  <div class="field">
    <textarea id="observaciones" name="observaciones" rows="4"
      placeholder="Detalles adicionales sobre las muestras o el envío..."></textarea>
  </div>

  <!-- FIRMAS -->
  <div class="section-title">Responsables y firmas</div>
  <div class="firma-grid">
    <div class="firma-card">
      <span class="firma-label">Ingresado por</span>
      <input class="firma-name-input" type="text" placeholder="Nombre del analista" aria-label="Nombre del analista"/>
      <canvas class="firma-canvas" id="canvas-ingreso" aria-label="Campo de firma — ingresado por"></canvas>
      <div class="firma-actions">
        <button class="btn-clear" onclick="clearCanvas('canvas-ingreso')">
          <span class="material-symbols-outlined">ink_eraser</span> Limpiar
        </button>
        <span class="firma-hint">Firme con el cursor o el dedo</span>
      </div>
    </div>
    <div class="firma-card">
      <span class="firma-label">Recibido por</span>
      <input class="firma-name-input" type="text" placeholder="Nombre del receptor" aria-label="Nombre del receptor"/>
      <canvas class="firma-canvas" id="canvas-recibe" aria-label="Campo de firma — recibido por"></canvas>
      <div class="firma-actions">
        <button class="btn-clear" onclick="clearCanvas('canvas-recibe')">
          <span class="material-symbols-outlined">ink_eraser</span> Limpiar
        </button>
        <span class="firma-hint">Firme con el cursor o el dedo</span>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer class="doc-footer">
    <div class="footer-info">
        <span class = "footer-title">AgroLab</span>
      <span>
        <span class="material-symbols-outlined">location_on</span>
        Km 92.5 Carretera a 
    </span>
    <span>
        <span class="material-symbols-outlined">call</span>
            +50 &nbsp;|&nbsp; , C. A.
        </span>
    <span>
        <span class="material-symbols-outlined">mail</span>
            laboratoriocg@AgroLab.org &nbsp;|&nbsp; diaboratorio@AgroLab.org
        </span>
      <span class="footer-meta">Generado por TecnoBoris v2.1</span>
    </div>
  </footer>
</main>

<!-- FAB -->
<div class="fab-group">
  <button type="button" class="fab secondary" title="Guardar borrador" onclick="alert('Borrador guardado')">
    <span class="material-symbols-outlined">save</span>
  </button>
  <button type="button" class="fab primary" title="Finalizar solicitud" onclick="document.getElementById('solicitud-form').submit()">
    <span class="material-symbols-outlined">send</span>
  </button>
</div>

  </form>

<script>
  /* ── DATOS POR TIPO ── */
  const ANALISIS = {
    "suelo-fisico": {
      label: "Suelos Físico",
      items: [
        { nombre: "Textura"},
        { nombre: "Densidad aparente"},
        { nombre: "Densidad real"},
        { nombre: "Humedad gravimétrica"},
        { nombre: "Porosidad total"},
      ],
      metodo: "Los análisis físicos de suelo se ejecutan conforme a los protocolos ASTM D422 para textura y métodos gravimétricos normalizados para densidades y humedad. Cada muestra es identificada y trazada desde su recepción hasta la entrega de resultados, con controles de calidad dobles por lote.",
    },
    "suelo-quimico": {
      label: "Suelo Químico",
      items: [
        { nombre: "pH"},
        { nombre: "Materia orgánica" },
        { nombre: "Nitrógeno total"},
        { nombre: "Fósforo disponible"},
        { nombre: "Potasio intercambiable"},
        { nombre: "CIC (capacidad de intercambio catiónico)"},
      ],
      metodo: "Análisis químico bajo normas AOAC y métodos Walkley-Black, Kjeldahl y extracción con acetato de amonio. Los reactivos son de grado analítico certificado y el laboratorio opera con control de temperatura a 20 ± 2°C.",
    },
    "foliares": {
      label: "Foliares",
      items: [
        { nombre: "Nitrógeno foliar"},
        { nombre: "Fósforo foliar"},
        { nombre: "Potasio foliar"},
        { nombre: "Calcio y Magnesio"},
        { nombre: "Micronutrientes (Fe, Mn, Zn, Cu)"},
      ],
      metodo: "Las muestras foliares deben presentarse limpias, previamente secadas a 65°C por 48 horas y molidas a malla 40. Los análisis siguen los protocolos del Instituto Internacional de Nutrición de Plantas (IPNI) y la norma AOAC 965.09 para digestión de tejidos.",
    },
    "cana": {
      label: "Caña",
      items: [
        { nombre: "Brix (jugo)"},
        { nombre: "Pol (sacarosa)"},
        { nombre: "Pureza"},
        { nombre: "Fibra bruta"},
        { nombre: "Humedad del bagazo"},
        { nombre: "Jugo extraído (%)"},
      ],
      metodo: "Análisis de caña conforme a los métodos ICUMSA y las normas de la industria azucarera guatemalteca. Las muestras deben procesarse dentro de las 4 horas posteriores al corte para evitar la inversión enzimática de la sacarosa.",
    },
    "miel": {
      label: "Miel",
      items: [
        { nombre: "Humedad"},
        { nombre: "HMF (Hidroximetilfurfural)"},
        { nombre: "Actividad diastásica"},
        { nombre: "Sólidos solubles (°Brix)"},
        { nombre: "pH y acidez libre"},
      ],
      metodo: "Análisis de mieles bajo la norma CODEX STAN 12-1981 y métodos AOAC International. Se verifica el cumplimiento del Reglamento Técnico Centroamericano RTCA 67.04.40:07. Las muestras deben entregarse en frascos de vidrio ámbar sellados.",
    },
    "agua": {
      label: "Agua",
      items: [
        { nombre: "pH"},
        { nombre: "Conductividad eléctrica (CE)"},
        { nombre: "Sólidos totales disueltos (STD)"},
        { nombre: "Dureza total (CaCO₃)"},
        { nombre: "Coliformes totales y fecales"},
        { nombre: "Nitratos / Nitritos"},
      ],
      metodo: "Análisis de agua para uso agrícola conforme a las normas COGUANOR NGO 29001 y métodos estándar APHA-AWWA-WEF (Standard Methods for the Examination of Water and Wastewater, 23ª edición). Las muestras deben recolectarse en frascos estériles y entregarse refrigeradas (4°C) en un máximo de 6 horas.",
    },
  };

  /* ── RENDERIZAR TABLA ── */
  function renderAnalisis(tipo) {
    const data = ANALISIS[tipo];
    const body = document.getElementById("analisis-body");
    body.innerHTML = data.items.map((item, i) => `
      <tr>
        <td class="name">${item.nombre}</td>
        <td class="center check-cell">
          <input type="checkbox" checked id="chk-${tipo}-${i}" aria-label="Solicitar ${item.nombre}"/>
        </td>
      </tr>
    `).join("");
    document.getElementById("metodo-box").textContent = data.metodo;
    document.getElementById("tipo-label-header").textContent = data.label;
  }

  document.getElementById("tipo-btns").addEventListener("click", function(e) {
    const btn = e.target.closest(".tipo-btn");
    if (!btn) return;
    document.querySelectorAll(".tipo-btn").forEach(b => b.classList.remove("active"));
    btn.classList.add("active");
    renderAnalisis(btn.dataset.tipo);
  });

  // Si se recibe el tipo por query string (desde el menú), preseleccionar y ocultar la lista
  (function() {
    const params = new URLSearchParams(window.location.search);
    const q = params.get('tipo');
    if (q && ANALISIS[q]) {
      // ocultar controles de selección
      const tiposCont = document.getElementById('tipo-btns');
      if (tiposCont) tiposCont.style.display = 'none';
      // marcar botón activo si existe
      const btn = document.querySelector(`.tipo-btn[data-tipo="${q}"]`);
      if (btn) {
        document.querySelectorAll('.tipo-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
      }
      renderAnalisis(q);
    } else {
      renderAnalisis("suelo-fisico");
    }
  })();

  /* ── CANVAS DE FIRMA ── */
  function makeDrawable(canvasId) {
    const canvas = document.getElementById(canvasId);
    if (!canvas) return;

    function resize() {
      const rect = canvas.parentElement.getBoundingClientRect();
      const ratio = window.devicePixelRatio || 1;
      const snapshot = canvas.toDataURL();
      canvas.width = rect.width * ratio;
      canvas.height = 90 * ratio;
      canvas.style.width = rect.width + "px";
      canvas.style.height = "90px";
      const ctx = canvas.getContext("2d");
      ctx.scale(ratio, ratio);
      ctx.strokeStyle = "#27500A";
      ctx.lineWidth = 2;
      ctx.lineCap = "round";
      ctx.lineJoin = "round";
      const img = new Image();
      img.onload = () => ctx.drawImage(img, 0, 0, rect.width, 90);
      img.src = snapshot;
    }

    resize();
    window.addEventListener("resize", resize);

    const ctx = canvas.getContext("2d");
    let drawing = false, lx = 0, ly = 0;

    function getPos(e) {
      const r = canvas.getBoundingClientRect();
      const ratio = window.devicePixelRatio || 1;
      const src = e.touches ? e.touches[0] : e;
      return {
        x: (src.clientX - r.left),
        y: (src.clientY - r.top)
      };
    }

    canvas.addEventListener("pointerdown", e => {
      drawing = true;
      const p = getPos(e);
      lx = p.x; ly = p.y;
      canvas.setPointerCapture(e.pointerId);
    });
    canvas.addEventListener("pointermove", e => {
      if (!drawing) return;
      const p = getPos(e);
      ctx.beginPath();
      ctx.moveTo(lx, ly);
      ctx.lineTo(p.x, p.y);
      ctx.stroke();
      lx = p.x; ly = p.y;
    });
    canvas.addEventListener("pointerup", () => drawing = false);
    canvas.addEventListener("pointercancel", () => drawing = false);
  }

  function clearCanvas(id) {
    const canvas = document.getElementById(id);
    if (!canvas) return;
    canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);
  }

  window.clearCanvas = clearCanvas;

  makeDrawable("canvas-ingreso");
  makeDrawable("canvas-recibe");
</script>
</body>
</html>