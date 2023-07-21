let a_msj_wsp = document.getElementById('WSP');

const MensajeWsp = () => {
  let nombre = document.getElementById("name").value;
  let mail = document.getElementById("exampleInputEmail1").value;
  let motivo = document.getElementById("exampleInputPassword1").value;
  let mensajeInput = document.getElementById("contenido").value;

  let mensaje_final =
    "Hola!,%20Mi%20Nombre%20es:%20" + nombre + ",%20" +
    "Mi%20Mail%20es:%20" + mail + ",%20" +
    "El%20Motivo%20de%20mi%20contacto%20es%20" + motivo + ",%20" +
    "mensaje%20:%20" + mensajeInput;

  let mensaje = "https://api.whatsapp.com/send?phone=34675071107&text=" + encodeURIComponent(mensaje_final);
  console.log("Mensaje Final:", mensaje_final);
  console.log("Enlace de WhatsApp:", mensaje);

  // Utilizamos window.open() para abrir el enlace en una nueva ventana
  window.open(mensaje, "_blank");
};

a_msj_wsp.addEventListener('click', MensajeWsp);


//mensaje = "https://api.whatsapp.com/send?phone=34675071107&text="+mensaje_final 